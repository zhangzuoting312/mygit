<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\extension\model.php');
helper::cd();
class extextensionModel extends extensionModel 
{
public function expireCheck()
{
    $this->loadExtension('bizext')->expireCheck();
}
//**//
}