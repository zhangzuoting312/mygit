<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\task\model.php');
helper::cd();
class exttaskModel extends taskModel 
{
/**
 * Add task estimate.
 *
 * @param  object   $data
 * @access public
 * @return void
 */
public function addTaskEstimate($data)
{
    return $this->loadExtension('effort')->addTaskEstimate($data);
}public function setListValue($projectID)
{
    return $this->loadExtension('excel')->setListValue($projectID);
}

public function createFromImport($projectID)
{
    return $this->loadExtension('excel')->createFromImport($projectID);
}public function start($taskID)
{
    return $this->loadExtension('gantt')->start($taskID);
}

public function finish($taskID)
{
    return $this->loadExtension('gantt')->finish($taskID);
}

public function checkDepend($taskID, $action = 'begin')
{
    return $this->loadExtension('gantt')->checkDepend($taskID, $action);
}
//**//
}