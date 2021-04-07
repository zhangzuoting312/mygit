<?php
$lang->proVersion   = "";
$lang->donate    = '';
$lang->try    = ' Trial';
$lang->proName   = 'Pro';
$lang->expireDate   = "Hết hạn: %s";
$lang->forever   = "Vĩnh viễn";
$lang->unlimited = "Không giới hạn";
$lang->licensedUser = "User Licensed: %s";

$lang->noticeLimited = "<div style='float:left;color:red' id='userLimited'>The number of pro users has exceeded that of the licensed. Vui lòng contact Renee at Renee@cnezsoft.com, or xóa users.</div>"; 

$lang->admin->subMenu->system->license = 'License|admin|license';
$lang->admin->subMenuOrder->system[20] = 'license';

global $config;
if(!empty($config->URAndSR))
{
    $URCommon = zget($lang, 'URCommon', "Điều kiện");
    $SRCommon = zget($lang, 'SRCommon', "Câu chuyện");
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
