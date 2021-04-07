<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\action\model.php');
helper::cd();
class extactionModel extends actionModel 
{
public function create($objectType, $objectID, $actionType, $comment = '', $extra = '', $actor = '', $autoDelete = true)
{
if(strtolower($actionType) == 'reconnectxuanxuan' or strtolower($actionType) == 'loginxuanxuan')
{
    $ip   = helper::getRemoteIp();
    $last = $this->server->request_time;
    $this->dao->update(TABLE_USER)->set('visits = visits + 1')->set('ip')->eq($ip)->set('last')->eq($last)->where('account')->eq($actor)->exec();
}
    $actionID = parent::create($objectType, $objectID, $actionType, $comment, $extra, $actor, $autoDelete);
    $this->loadExtension('search')->saveIndex($objectType, $objectID, $actionType);
    return $actionID;
}/**
 * Get actions since last two xxd poll.
 *
 * @param  string $objectType
 * @param  int    $objectID
 * @param  string $action
 * @access public
 * @return array
 */
public function getListSinceLastPoll($objectType = null, $objectID = null, $action = '')
{
    $lastPoll = date(DT_DATETIME1, strtotime($this->config->xxd->lastPoll . ' - ' . $this->config->xuanxuan->pollingInterval . ' second'));
    $actions = $this->dao->select('*')->from(TABLE_ACTION)
        ->where('date')->gt($lastPoll)
        ->beginIF($objectType)->andWhere('objectType')->eq($objectType)->fi()
        ->beginIF($objectID)->andWhere('objectID')->eq($objectID)->fi()
        ->beginIF($action)->andWhere('action')->eq($action)->fi()
        ->orderBy('`date`_desc')
        ->fetchAll('id');

    $histories = $this->getHistory(array_keys($actions));

    foreach($actions as $actionID => $action)
    {
        if(isset($histories[$actionID]))
        {
            $action->history = $histories[$actionID];
            $actions[$actionID] = $action;
        }
    }

    return $actions;
}
    public function undelete($actionID)
    {
$action = $this->getById($actionID);
if($action->objectType == 'user')
{
    $user = $this->dao->select('*')->from(TABLE_USER)->where('id')->eq($action->objectID)->fetch();
    if(empty($user->feedback) and $this->loadModel('user')->checkUserLimit()) die(js::alert($this->lang->user->noticeUserLimit));
}
        $action = $this->getById($actionID);
        if($action->action != 'deleted') return;
        if($action->objectType == 'product')
        {
            $product = $this->dao->select('id,name,code,acl')->from(TABLE_PRODUCT)->where('id')->eq($action->objectID)->fetch();
            $count   = $this->dao->select('COUNT(*) AS count')->from(TABLE_PRODUCT)->where('deleted')->eq('0')->andWhere("(`name`='{$product->name}' OR `code`='{$product->code}')")->fetch('count');
            if($count > 0)
            {
                echo js::alert(sprintf($this->lang->action->needEdit, $this->lang->action->objectTypes['product']));
                die(js::locate(helper::createLink('product', 'edit', "productID=$action->objectID&action=undelete&extra=$actionID"), 'parent'));
            }
            if($product->acl != 'open') $this->loadModel('user')->updateUserView($product->id, 'product');
        }
        elseif($action->objectType == 'project')
        {
            $project = $this->dao->select('id,name,code,acl')->from(TABLE_PROJECT)->where('id')->eq($action->objectID)->fetch();
            $count   = $this->dao->select('COUNT(*) AS count')->from(TABLE_PROJECT)->where('deleted')->eq('0')->andWhere("(`name`='{$project->name}' OR `code`='{$project->code}')")->fetch('count');
            if($count > 0)
            {
                echo js::alert(sprintf($this->lang->action->needEdit, $this->lang->action->objectTypes['project']));
                die(js::locate(helper::createLink('project', 'edit', "projectID=$action->objectID&action=undelete&extra=$actionID"), 'parent'));
            }
            if($project->acl != 'open') $this->loadModel('user')->updateUserView($project->id, 'project');
        }
        elseif($action->objectType == 'module')
        {
            $module     = $this->dao->select('*')->from(TABLE_MODULE)->where('id')->eq($action->objectID)->fetch();
            $repeatName = $this->loadModel('tree')->checkUnique($module);
            if($repeatName) die(js::alert(sprintf($this->lang->tree->repeatName, $repeatName)));
        }

        /* Update deleted field in object table. */
        $table = $this->config->objectTables[$action->objectType];
        $this->dao->update($table)->set('deleted')->eq(0)->where('id')->eq($action->objectID)->exec();

        /* Revert userView products when undelete project. */
        if($action->objectType == 'project')
        {
            $products = $this->loadModel('project')->getProducts($project->id, $withBranch = false);
            if(!empty($products)) $this->loadModel('user')->updateUserView(array_keys($products), 'product');
        }

        /* Revert doclib when undelete product or project. */
        if($action->objectType == 'project' or $action->objectType == 'product')
        {
            $this->dao->update(TABLE_DOCLIB)->set('deleted')->eq(0)->where($action->objectType)->eq($action->objectID)->exec();
        }

        /* Revert productplan parent status. */
        if($action->objectType == 'productplan') $this->loadModel('productplan')->changeParentField($action->objectID);

        /* Update task status when undelete child task. */
        if($action->objectType == 'task') $this->loadModel('task')->updateParentStatus($action->objectID);

        /* Update action record in action table. */
        $this->dao->update(TABLE_ACTION)->set('extra')->eq(ACTIONMODEL::BE_UNDELETED)->where('id')->eq($actionID)->exec();
        $this->create($action->objectType, $action->objectID, 'undeleted');
    }

//**//
}