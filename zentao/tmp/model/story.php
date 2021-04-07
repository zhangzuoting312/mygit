<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\story\model.php');
helper::cd();
class extstoryModel extends storyModel 
{
public function update($storyID)
{
    return $this->loadExtension('bizext')->update($storyID);
}

public function subdivide($storyID, $stories) 
{
    return $this->loadExtension('bizext')->subdivide($storyID, $stories);
}

public function getRelation($storyID, $storyType, $fields = array()) 
{
    return $this->loadExtension('bizext')->getRelation($storyID, $storyType, $fields);
}

public function getAffectedScope($story)
{
    return $this->loadExtension('bizext')->getAffectedScope($story);
}

public function getEmptySR($productID = 0, $branch = 0, $moduleIdList = 0, $status = 'all', $type = 'story', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('bizext')->getEmptySR($productID, $branch, $moduleIdList, $status, $type, $orderBy, $pager);
}/**
 * The model file of calendar module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Memory <lvtao@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function getUserStoryPairs($account = '', $limit = 0, $type = 'story', $skipProductIDList = array())
{
    return $this->loadExtension('calendar')->getUserStoryPairs($account, $limit, $type, $skipProductIDList);
}public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0, $type = 'story')
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch, $type);
}
//**//
}