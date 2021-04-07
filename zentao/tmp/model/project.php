<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\project\model.php');
helper::cd();
class extprojectModel extends projectModel 
{
/**
 * The model file of calendar module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function getTasks4Calendar($projectID, $status = 'all', $orderBy = 'status_asc, id_desc', $pager = null)
{
    return $this->loadExtension('calendar')->getTasks4Calendar($projectID, $status, $orderBy, $pager);
}

public function getEfforts4Calendar($projectID, $account = '', $year = '')
{
    return $this->loadExtension('calendar')->getEfforts4Calendar($projectID, $account, $year);
}/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function computeTaskEffort()
{
    return $this->loadExtension('effort')->computeTaskEffort();
}

public function getTaskEffort($project = '')
{
    return $this->loadExtension('effort')->getTaskEffort($project);
}/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function createRelationOfTasks($projectID)
{
    $this->loadExtension('gantt')->createRelationOfTasks($projectID);
}

public function editRelationOfTasks($projectID)
{
    $this->loadExtension('gantt')->editRelationOfTasks($projectID);
}

public function getRelationsOfTasks($projectID)
{
    return $this->loadExtension('gantt')->getRelationsOfTasks($projectID);
}

public function getDataForGantt($projectID, $type)
{
    return $this->loadExtension('gantt')->getDataForGantt($projectID, $type);
}

public function deleteRelation($id)
{
    $this->loadExtension('gantt')->deleteRelation($id);
}public function setMenu($projects, $projectID, $buildID = 0, $extra = '')
{
    return $this->loadExtension('web')->setMenu($projects, $projectID, $buildID, $extra);
}
//**//
}