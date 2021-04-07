<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\bug\model.php');
helper::cd();
class extbugModel extends bugModel 
{
public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0)
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch);
}
//**//
}