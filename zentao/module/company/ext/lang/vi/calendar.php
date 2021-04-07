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
$lang->company->calendar    = 'Chấm công';
$lang->company->todo     = 'Việc làm';
$lang->company->selectDept  = 'Chọn department';
$lang->company->date     = 'Ngày';
$lang->company->allDept  = 'Tất cả';
$lang->company->to    = 'to';
$lang->company->user     = 'Người dùng';
$lang->company->dept     = 'Dept';
$lang->company->effortCalendar = 'Chấm công';
$lang->company->todoCalendar   = 'Lịch làm việc';
$lang->company->beginDate   = 'Bắt đầu';
$lang->company->endDate  = 'Kết thúc';
$lang->company->companyTodo = 'Company việc làm';
$lang->company->todoList    = 'Company việc';
$lang->company->effortList  = 'Company Efforts';
$lang->company->showAll  = 'Hiện all members of the department';
$lang->company->allTodo  = 'Tất cả việc';

if(!isset($lang->company->effort)) $lang->company->effort = new stdclass();
$lang->company->effort->selectDate = 'Ngày';
$lang->company->effort->projectSelect = $lang->projectCommon;
$lang->company->effort->productSelect = $lang->productCommon;
$lang->company->effort->userSelect = 'Người dùng';
$lang->company->effort->view    = 'Xem';

$lang->company->currentDept = 'Current Dept';
