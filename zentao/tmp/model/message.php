<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\message\model.php');
helper::cd();
class extmessageModel extends messageModel 
{
public function send($objectType, $objectID, $actionType, $actionID, $actor = '')
{
$this->loadExtension('xuanxuan')->send($objectType, $objectID, $actionType, $actionID, $actor);
    return $this->loadExtension('sms')->send($objectType, $objectID, $actionType, $actionID, $actor);
}
//**//
}