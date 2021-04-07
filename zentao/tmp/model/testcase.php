<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\testcase\model.php');
helper::cd();
class exttestcaseModel extends testcaseModel 
{
public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}
//**//
}