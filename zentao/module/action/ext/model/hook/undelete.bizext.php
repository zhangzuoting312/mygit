<?php
$action = $this->getById($actionID);
if($action->objectType == 'user')
{
    $user = $this->dao->select('*')->from(TABLE_USER)->where('id')->eq($action->objectID)->fetch();
    if(empty($user->feedback) and $this->loadModel('user')->checkUserLimit()) die(js::alert($this->lang->user->noticeUserLimit));
}
