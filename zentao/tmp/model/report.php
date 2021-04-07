<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\report\model.php');
helper::cd();
class extreportModel extends reportModel 
{
public function __construct()
{
    parent::__construct();
    $this->loadExtension('crystal');
}

public function getReportByID($reportID)
{
    return $this->crystalReport->getReportByID($reportID);
}

public function getReportList($module = '', $orderBy = 'id_desc', $pager = null)
{
    return $this->crystalReport->getReportList($module, $orderBy, $pager);
}

public function checkBlackList($sql)
{
    return $this->crystalReport->checkBlackList($sql);
}

public function getTables($sql)
{
    return $this->crystalReport->getTables($sql);
}

public function mergeFields($dataFields, $sqlFields, $moduleNames)
{
    return $this->crystalReport->mergeFields($dataFields, $sqlFields, $moduleNames);
}

public function getCellData($data, $dataCols, $condition, $initStaticData = false)
{
    return $this->crystalReport->getCellData($data, $dataCols, $condition, $initStaticData);
}

public function checkSqlVar($sql)
{
    return $this->crystalReport->checkSqlVar($sql);
}

public function getHeaderNames($fields, $moduleNames, $condition)
{
    return $this->crystalReport->getHeaderNames($fields, $moduleNames, $condition);
}

public function getGroupLang($field, $sqlFields, $moduleNames)
{
    return $this->crystalReport->getGroupLang($field, $sqlFields, $moduleNames);
}

public function replaceTableNames($sql)
{
    return $this->crystalReport->replaceTableNames($sql);
}

public function processSqlVar($sqlVar)
{
    return $this->crystalReport->processSqlVar($sqlVar);
}

public function processData($dataList, $condition)
{
    return $this->crystalReport->processData($dataList, $condition);
}

public function replace4Workflow($title)
{
    return $this->crystalReport->replace4Workflow($title);
}public function getUserYearEfforts($accounts, $year)
{
    return $this->loadExtension('effort')->getUserYearEfforts($accounts, $year);
}public function getTestcases($productID)
{
    return $this->loadExtension('report')->getTestcases($productID);
}

public function getBuildBugs($productID)
{
    return $this->loadExtension('report')->getBuildBugs($productID);
}

public function getWorkSummary($begin, $end, $dept, $type)
{
    return $this->loadExtension('report')->getWorkSummary($begin, $end, $dept, $type);
}

public function getRoadmaps($conditions = '')
{
    return $this->loadExtension('report')->getRoadmaps($conditions);
}

public function getBugSummary($dept, $begin, $end, $type)
{
    return $this->loadExtension('report')->getBugSummary($dept, $begin, $end, $type);
}

public function getCasesRun($productID)
{
    return $this->loadExtension('report')->getCasesRun($productID);
}

public function getStoryBugs($moduleID)
{
    return $this->loadExtension('report')->getStoryBugs($moduleID);
}

public function getModule($productID)
{
    return $this->loadExtension('report')->getModule($productID);
}
//**//
}