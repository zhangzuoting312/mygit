<?php
/**
 * The control file of report module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     report
 * @version     $Id: control.php 4622 2013-03-28 01:09:02Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
class report extends control
{
    /**
     * The index of report, goto project deviation.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->locate(inlink('productSummary'));
    }

    /**
     * Project deviation report.
     *
     * @access public
     * @return void
     */
    public function projectDeviation($begin = 0, $end = 0)
    {
        $begin = $begin ? date('Y-m-d', strtotime($begin)) : '';
        $end   = $end   ? date('Y-m-d', strtotime($end))   : '';

        $this->view->title      = $this->lang->report->projectDeviation;
        $this->view->position[] = $this->lang->report->projectDeviation;

        $this->view->projects = $this->report->getProjects($begin, $end);
        $this->view->begin    = $begin;
        $this->view->end      = $end;
        $this->view->submenu  = 'project';
        $this->display();
    }

    /**
     * Product information report.
     *
     * @access public
     * @return void
     */
    public function productSummary($conditions = '')
    {
        $this->app->loadLang('product');
        $this->app->loadLang('productplan');
        $this->app->loadLang('story');
        $this->view->title      = $this->lang->report->productSummary;
        $this->view->position[] = $this->lang->report->productSummary;
        $this->view->products   = $this->report->getProducts($conditions);
        $this->view->users      = $this->loadModel('user')->getPairs('noletter|noclosed');
        $this->view->submenu    = 'product';
        $this->view->conditions = $conditions;
        $this->display();
    }

    /**
     * Bug create report.
     *
     * @param  int    $begin
     * @param  int    $end
     * @access public
     * @return void
     */
    public function bugCreate($begin = 0, $end = 0, $product = 0, $project = 0)
    {
        $this->app->loadLang('bug');
        $begin = $begin == 0 ? date('Y-m-d', strtotime('last month', strtotime(date('Y-m',time()) . '-01 00:00:01'))) : date('Y-m-d', strtotime($begin));
        $end   = $end == 0   ? date('Y-m-d', strtotime('now')) : $end = date('Y-m-d', strtotime($end));

        $this->view->title      = $this->lang->report->bugCreate;
        $this->view->position[] = $this->lang->report->bugCreate;
        $this->view->begin      = $begin;
        $this->view->end        = $end;
        $this->view->bugs       = $this->report->getBugs($begin, $end, $product, $project);
        $this->view->users      = $this->loadModel('user')->getPairs('noletter|noclosed|nodeleted');
        $this->view->projects   = array('' => '') + $this->loadModel('project')->getPairs();
        $this->view->products   = array('' => '') + $this->loadModel('product')->getPairs();
        $this->view->project    = $project;
        $this->view->product    = $product;
        $this->view->submenu    = 'test';
        $this->display();
    }

    /**
     * Bug assign report.
     *
     * @access public
     * @return void
     */
    public function bugAssign()
    {
        $this->view->title      = $this->lang->report->bugAssign;
        $this->view->position[] = $this->lang->report->bugAssign;
        $this->view->submenu    = 'test';
        $this->view->assigns    = $this->report->getBugAssign();
        $this->view->users      = $this->loadModel('user')->getPairs('noletter|noclosed|nodeleted');
        $this->display();
    }

    /**
     * Workload report.
     *
     * @param string $begin
     * @param string $end
     * @param int    $days
     * @param int    $workday
     * @param int    $dept
     * @param int    $assign
     *
     * @access public
     * @return void
     */
    public function workload($begin = '', $end = '', $days = 0, $workday = 0, $dept = 0, $assign = 'assign')
    {
        if($_POST)
        {
            $data    = fixer::input('post')->get();
            $begin   = $data->begin;
            $end     = $data->end;
            $dept    = $data->dept;
            $days    = $data->days;
            $assign  = $data->assign;
            $workday = $data->workday;
        }

        $this->app->loadConfig('project');
        $begin  = $begin ? strtotime($begin) : time();
        $end    = $end   ? strtotime($end)   : time() + (7 * 24 * 3600);
        $end   += 24 * 3600;
        $beginWeekDay = date('w', $begin);
        $begin  = date('Y-m-d', $begin);
        $end    = date('Y-m-d', $end);

        if(empty($workday))$workday = $this->config->project->defaultWorkhours;
        $diffDays = helper::diffDate($end, $begin);
        if($days > $diffDays) $days = $diffDays;
        if(empty($days))
        {
            $weekDay = $beginWeekDay;
            $days    = $diffDays;
            for($i = 0; $i < $diffDays; $i++,$weekDay++)
            {
                $weekDay = $weekDay % 7;
                if(($this->config->project->weekend == 2 and $weekDay == 6) or $weekDay == 0) $days --;
            }
        }

        $this->view->title      = $this->lang->report->workload;
        $this->view->position[] = $this->lang->report->workload;

        $this->view->workload = $this->report->getWorkload($dept, $assign);
        $this->view->users    = $this->loadModel('user')->getPairs('noletter|noclosed|nodeleted');
        $this->view->depts    = $this->loadModel('dept')->getOptionMenu();
        $this->view->begin    = $begin;
        $this->view->end      = date('Y-m-d', strtotime($end) - 24 * 3600);
        $this->view->days     = $days;
        $this->view->workday  = $workday;
        $this->view->dept     = $dept;
        $this->view->assign   = $assign;
        $this->view->allHour  = $days * $workday;
        $this->view->submenu  = 'staff';
        $this->display();
    }

    /**
     * Send daily reminder mail.
     *
     * @access public
     * @return void
     */
    public function remind()
    {
        $bugs = $tasks = $todos = $testTasks = array();
        if($this->config->report->dailyreminder->bug)      $bugs  = $this->report->getUserBugs();
        if($this->config->report->dailyreminder->task)     $tasks = $this->report->getUserTasks();
        if($this->config->report->dailyreminder->todo)     $todos = $this->report->getUserTodos();
        if($this->config->report->dailyreminder->testTask) $testTasks = $this->report->getUserTestTasks();

        $reminder = array();

        $users = array_unique(array_merge(array_keys($bugs), array_keys($tasks), array_keys($todos), array_keys($testTasks)));
        if(!empty($users)) foreach($users as $user) $reminder[$user] = new stdclass();

        if(!empty($bugs))  foreach($bugs as $user => $bug)   $reminder[$user]->bugs  = $bug;
        if(!empty($tasks)) foreach($tasks as $user => $task) $reminder[$user]->tasks = $task;
        if(!empty($todos)) foreach($todos as $user => $todo) $reminder[$user]->todos = $todo;
        if(!empty($testTasks)) foreach($testTasks as $user => $testTask) $reminder[$user]->testTasks = $testTask;

        $this->loadModel('mail');

        /* Check mail turnon.*/
        if(!$this->config->mail->turnon)
        {
            echo "You should turn on the Email feature first.\n";
            return false;
        }

        foreach($reminder as $user => $mail)
        {
            /* Reset $this->output. */
            $this->clear();

            $mailTitle  = $this->lang->report->mailTitle->begin;
            $mailTitle .= isset($mail->bugs)  ? sprintf($this->lang->report->mailTitle->bug,  count($mail->bugs))  : '';
            $mailTitle .= isset($mail->tasks) ? sprintf($this->lang->report->mailTitle->task, count($mail->tasks)) : '';
            $mailTitle .= isset($mail->todos) ? sprintf($this->lang->report->mailTitle->todo, count($mail->todos)) : '';
            $mailTitle .= isset($mail->testTasks) ? sprintf($this->lang->report->mailTitle->testTask, count($mail->testTasks)) : '';
            $mailTitle  = rtrim($mailTitle, ',');

            /* Get email content and title.*/
            $this->view->mail      = $mail;
            $this->view->mailTitle = $mailTitle;

            $oldViewType = $this->viewType;
            if($oldViewType == 'json') $this->viewType = 'html';
            $mailContent = $this->parse('report', 'dailyreminder');
            $this->viewType == $oldViewType;

            /* Send email.*/
            echo date('Y-m-d H:i:s') . " sending to $user, ";
            $this->mail->send($user, $mailTitle, $mailContent, '', true);
            if($this->mail->isError())
            {
                echo "fail: \n" ;
                a($this->mail->getError());
            }
            echo "ok\n";
        }
    }

    /**
     * Show annual data
     *
     * @param  string $year 
     * @param  string $dept 
     * @param  string $userID 
     * @access public
     * @return void
     */
    public function annualData($year = '', $dept = '', $userID = '')
	{
		$this->app->loadLang('story');
		$this->app->loadLang('task');
		$this->app->loadLang('bug');
		$this->app->loadLang('testcase');

        $firstAction = $this->dao->select('*')->from(TABLE_ACTION)->orderBy('id')->limit(1)->fetch();
        $currentYear = date('Y');
        $firstYear   = empty($firstAction) ? $currentYear : substr($firstAction->date, 0, 4);

        /* Get years for use zentao. */
        $years = array();
        for($thisYear = $firstYear; $thisYear <= $currentYear; $thisYear ++) $years[$thisYear] = $thisYear;

        /* Init year when year is empty. */
        if(empty($year))
        {
            $year  = date('Y');
            $month = date('n');
            if($month <= $this->config->report->annualData['minMonth'])
            {
                $year -= 1;
                if(!isset($years[$year])) $year += 1;
            }
        }

        /* Get users and depts. */
        $users     = $this->loadModel('user')->getPairs('noletter|useid|noclosed');
        $users[''] = $this->lang->report->annualData->allUser;

        $depts = $this->loadModel('dept')->getOptionMenu();
        $depts = array('' => $this->lang->report->annualData->allDept) + $depts;
        if(empty($userID)) unset($depts[0]);

        $accounts = array();
        if($dept)
        {
            $accounts = $this->loadModel('dept')->getDeptUserPairs($dept);
        }
        if($userID)
        {
            $user = $this->loadModel('user')->getById($userID, 'id');
			$dept = $user->dept;
            $accounts = array($user->account => ($user->realname ? $user->realname : $user->account));
        }
        if($accounts) $accounts = array_keys($accounts);

        if($dept)
        {
            $users = $this->loadModel('dept')->getDeptUserPairs($dept, 'useid');
            $users = array('' => $this->lang->report->annualData->allUser) + $users;
        }

        /* Get annual data. */
        $data = array();
        if(!$userID)
        {
            $data['users'] = $dept ? count($accounts) :  (count($users) - 1);
        }
        else
        {
            $data['logins'] = $this->report->getUserYearLogins($accounts, $year);
        }
        $data['actions']       = $this->report->getUserYearActions($accounts, $year);
        $data['todos']         = $this->report->getUserYearTodos($accounts, $year);
        $data['contributions'] = $this->report->getUserYearContributions($accounts, $year);
        $data['projectStat']   = $this->report->getUserYearProjects($accounts, $year);
        $data['productStat']   = $this->report->getUserYearProducts($accounts, $year);
        $data['storyStat']     = $this->report->getYearObjectStat($accounts, $year, 'story');
        $data['taskStat']      = $this->report->getYearObjectStat($accounts, $year, 'task');
        $data['bugStat']       = $this->report->getYearObjectStat($accounts, $year, 'bug');
        $data['caseStat']      = $this->report->getYearCaseStat($accounts, $year);

        $yearEfforts = $this->report->getUserYearEfforts($accounts, $year);
        $data['consumed'] = $yearEfforts->consumed;

        if(empty($dept) and empty($userID)) $data['statusStat'] = $this->report->getAllTimeStatusStat();

        $this->view->title  = sprintf($this->lang->report->annualData->title, ($userID ? $users[$userID] : ($dept ? substr($depts[$dept], strrpos($depts[$dept], '/') + 1) : $depts[''])), $year);
        $this->view->data   = $data;
        $this->view->year   = $year;
        $this->view->users  = $users;
        $this->view->depts  = $depts;
        $this->view->years  = $years;
        $this->view->dept   = $dept;
        $this->view->userID = $userID;
        $this->view->months = $this->report->getYearMonths($year);
        die($this->display());
    }
}
