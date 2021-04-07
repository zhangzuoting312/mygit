<?php
/**
 * The lang file of calendar module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license  business(商业软件) 
 * @author   Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package  calendar 
 * @version  $Id$
 * @link  http://www.zentao.net
 */
$lang->project->menu->list['alias'] .= ',calendar';

$lang->project->subMenu->list->calendar = array('link' => 'Calendar|project|calendar|projectID=%s', 'alias' => 'calendar');

$lang->project->menu->effort = array('link' => 'Chấm công|project|effortcalendar|projectID=%s', 'alias' => 'effort');

$lang->company->menu->todo = 'Việc làm|company|todo|';
$lang->company->menu->effort  = array('link' => 'Chấm công|company|calendar|', 'alias' => 'effort');

if(!isset($lang->effort))$lang->effort = new stdclass();
if(!isset($lang->effort->menuOrder))$lang->effort->menuOrder = new stdclass();
$lang->my->menuOrder[11]   = 'effort';
$lang->company->menuOrder[16] = 'todo';
$lang->company->menuOrder[17] = 'effort';
$lang->dept->menuOrder  = $lang->company->menuOrder;
$lang->group->menuOrder    = $lang->company->menuOrder;
$lang->todo->menuOrder  = $lang->my->menuOrder;
$lang->effort->menuOrder   = $lang->my->menuOrder;
$lang->task->menuOrder  = $lang->project->menuOrder;
$lang->build->menuOrder    = $lang->project->menuOrder;
$lang->user->menuOrder  = $lang->company->menuOrder;

$lang->dept->menu   = $lang->company->menu;
$lang->group->menu  = $lang->company->menu;
$lang->todo->menu   = $lang->my->menu;
$lang->effort->menu = $lang->my->menu;
$lang->task->menu   = $lang->project->menu;
$lang->build->menu  = $lang->project->menu;
$lang->user->menu   = $lang->company->menu;

$lang->today = 'Hôm nay';
$lang->textNetworkError = 'Network Error';
$lang->textHasMoreItems = 'Có {0} items...';

$lang->my->menu->calendar = array('link' => 'Lịch|my|calendar|', 'subModule' => 'todo,effort', 'alias' => 'todo,effort', 'class' => 'dropdown dropdown-hover');

$lang->my->subMenu = new stdclass();
$lang->my->subMenu->calendar = new stdclass();
$lang->my->subMenu->calendar->todo   = array('link' => 'Việc làm|todo|calendar|', 'alias' => 'todo');
$lang->my->subMenu->calendar->effort = array('link' => 'Chấm công|effort|calendar|', 'alias' => 'effort');
