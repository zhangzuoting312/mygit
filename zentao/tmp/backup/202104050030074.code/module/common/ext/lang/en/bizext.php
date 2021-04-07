<?php
$lang->proVersion   = "";
$lang->donate       = '';
$lang->try          = ' Trial';
$lang->proName      = 'Pro';
$lang->expireDate   = "Expiration: %s";
$lang->forever      = "Permanent";
$lang->unlimited    = "Unlimited";
$lang->licensedUser = "User Licensed: %s";

$lang->noticeLimited = "<div style='float:left;color:red' id='userLimited'>The number of pro users has exceeded that of the licensed. Please contact Renee at Renee@cnezsoft.com, or delete users.</div>"; 

$lang->admin->subMenu->system->license = 'License|admin|license';
$lang->admin->subMenuOrder->system[20] = 'license';

global $config;
if(!empty($config->URAndSR))
{
    $URCommon = zget($lang, 'URCommon', "Requirement");
    $SRCommon = zget($lang, 'SRCommon', "Story");
    $lang->my->menu->requirement = array('link' => "$URCommon|my|requirement|", 'subModule' => 'story');
    $lang->my->menu->story       = array('link' => "$SRCommon|my|story|", 'subModule' => 'story');
    $lang->my->menuOrder[29]     = 'requirement';

    if($config->global->flow != 'onlyTask')
    {
        $lang->product->menu->requirement = array('link' => "$URCommon|product|browse|productID=%s&branch=&browseType=unclosed&param=0&storyType=requirement", 'alias' => 'batchedit', 'subModule' => 'story');
        $lang->product->menu->story       = array('link' => "$SRCommon|product|browse|productID=%s", 'alias' => 'batchedit', 'subModule' => 'story');
        $lang->product->menuOrder[1]      = 'requirement';
    }
}
