<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\block\model.php');
helper::cd();
class extblockModel extends blockModel 
{
public function getCalendarParams()
{
    return $this->loadExtension('calendar')->getCalendarParams();
}

public function printCalendarBlock($module, $param)
{
    return $this->loadExtension('calendar')->printCalendarBlock($module, $param);
}
//**//
}