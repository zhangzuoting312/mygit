<?php
/**
 * Extends execute method for zentaopro.
 * 
 * @param  string $fromVersion 
 * @access public
 * @return bool
 */
public function execute($fromVersion)
{
    return $this->loadExtension('bizext')->execute($fromVersion);
}

/**
 * Extends getConfirm method for zentaopro.
 * 
 * @param  string $fromVersion 
 * @access public
 * @return string
 */
public function getConfirm($fromVersion)
{
    return $this->loadExtension('bizext')->getConfirm($fromVersion);
}

/**
 * Upgrade to zentaopro from free.
 * 
 * @access public
 * @return void
 */
public function upgradeFreeToPro()
{
    return $this->loadExtension('bizext')->upgradeFreeToPro();
}

/**
 * Record finished task effort.
 * 
 * @access public
 * @return bool
 */
public function recordFinished()
{
    return $this->loadExtension('bizext')->recordFinished();
}

/**
 * Fix repo prefix.
 * 
 * @access public
 * @return void
 */
public function fixRepo()
{
    return $this->loadExtension('bizext')->fixRepo();
}

/**
 * Fix report for add unique key.
 * 
 * @access public
 * @return bool
 */
public function fixReport()
{
    return $this->loadExtension('bizext')->fixReport();
}

public function checkURAndSR()
{
    return $this->loadExtension('bizext')->checkURAndSR();
}

/**
 * Check need process when after execute.
 * 
 * @access public
 * @return array
 */
public function checkProcess()
{
    return $this->loadExtension('bizext')->checkProcess();
}
