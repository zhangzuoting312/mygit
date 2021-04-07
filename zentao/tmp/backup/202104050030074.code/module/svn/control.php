<?php
/**
 * The control file of svn currentModule of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     svn
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class svn extends control
{
    /**
     * Sync svn. 
     * 
     * @access public
     * @return void
     */
    public function run()
    {
        $this->svn->run();
    }

    /**
     * Diff a file.
     * 
     * @param  string $url 
     * @param  int    $revision 
     * @access public
     * @return void
     */
    public function diff($url, $revision)
    {
        if(isset($_GET['repoUrl'])) $url = $this->get->repoUrl;

        $url = helper::safe64Decode($url);
        if(common::hasPriv('repo', 'diff'))
        {
            $svnRepos = $this->loadModel('repo')->getListBySCM('Subversion', 'haspriv');
            foreach($svnRepos as $repo)
            {
                if(strpos(strtolower($url), strtolower($repo->path)) === 0) 
                {
                    $entry = $this->repo->encodePath(str_ireplace($repo->path, '', $url));
                    $oldRevision = $revision - 1;
                    $this->locate($this->repo->createLink('diff', "repoID=$repo->id&entry=$entry&oldRevision=$oldRevision&revision=$revision", 'html', true));
                }
            }
        }

        $this->view->url      = $url;
        $this->view->revision = $revision;
        $this->view->diff     = $this->svn->diff($url, $revision);

        $this->display();
    }

    /**
     * Cat a file.
     * 
     * @param  string $url 
     * @param  int    $revision 
     * @access public
     * @return void
     */
    public function cat($url, $revision)
    {
        if(isset($_GET['repoUrl'])) $url = $this->get->repoUrl;

        $url = helper::safe64Decode($url);
        if(common::hasPriv('repo', 'view'))
        {
            $repos = $this->loadModel('repo')->getListBySCM('Subversion', 'haspriv');
            foreach($repos as $repo)
            {
                if(strpos(strtolower($url), strtolower($repo->path)) === 0)
                {
                    $entry = $this->repo->encodePath(str_ireplace(strtolower($repo->path), '', $url));
                    $this->locate($this->repo->createLink('view', "repoID=$repo->id&entry=$entry&revision=$revision", 'html', true));
                }
            }
        }

        $this->view->url      = $url;
        $this->view->revision = $revision;
        $this->view->code     = $this->svn->cat($url, $revision);

        $this->display(); 
    }

    /**
     * Sync from the syncer by api.
     * 
     * @access public
     * @return void
     */
    public function apiSync()
    {
        if($this->post->logs)
        {
            $repoRoot = $this->post->repoRoot;
            $logs = stripslashes($this->post->logs);
            $logs = simplexml_load_string($logs);
            foreach($logs->logentry as $entry)
            {
                $parsedLogs[] = $this->svn->convertLog($entry);
            }
            $this->loadModel('repo');
            $parsedObjects = array('stories' => array(), 'tasks' => array(), 'bugs' => array());
            foreach($parsedLogs as $log)
            {
                $objects = $this->repo->parseComment($log->msg);

                if($objects)
                {
                    $this->repo->saveAction2PMS($objects, $log, $repoRoot);
                    if($objects['stories']) $parsedObjects['stories'] = array_merge($parsedObjects['stories'], $objects['stories']);
                    if($objects['tasks'])   $parsedObjects['tasks'  ] = array_merge($parsedObjects['tasks'],   $objects['tasks']);
                    if($objects['bugs'])    $parsedObjects['bugs']    = array_merge($parsedObjects['bugs'],    $objects['bugs']);
                }
            }
            $parsedObjects['stories'] = array_unique($parsedObjects['stories']);
            $parsedObjects['tasks']   = array_unique($parsedObjects['tasks']);
            $parsedObjects['bugs']    = array_unique($parsedObjects['bugs']);
            $this->view->parsedObjects = $parsedObjects;
            $this->display();
            exit;
        }
    }

    /**
     * Ajax save log.
     * 
     * @access public
     * @return void
     */
    public function ajaxSaveLog()
    {
        $repoUrl  = trim($this->post->repoUrl);
        $repoRoot = str_replace('\\', '/', trim($this->post->repoRoot));
        $message  = trim($this->post->message);
        $revision = trim($this->post->revision);
        $files    = $this->post->files;

        /* Ignore git. */
        if(strpos($repoUrl, '://') === false) die();

        $parsedFiles = array();
        $repoDirs    = explode('/', trim($repoUrl, '/'));
        foreach($files as $file)
        {
            $file = trim($file);
            if(empty($file)) continue;
            $action = '';
            if(preg_match('/^[\w][ \t]/', $file))
            {
                $action = $file[0];
                $file   = trim(substr($file, 2));
            }
            $fileDirs = explode('/', trim($file, '/'));
            $diffDirs = array_diff($fileDirs, $repoDirs);

            foreach($fileDirs as $i => $dir)
            {
                if(isset($diffDirs[$i])) break;
                if(!isset($diffDirs[$i])) unset($fileDirs[$i]);
            }
            $path = '/' . join('/', $fileDirs);
            $parsedFiles[$action][] = $path;
        }

        $objects = $this->loadModel('repo')->parseComment($message);

        if($objects)
        {
            $log = new stdclass();
            $log->author   = $this->app->user->account;
            $log->date     = helper::now();
            $log->msg      = $message;
            $log->revision = $revision;
            $log->files    = $parsedFiles;
            $this->repo->saveAction2PMS($objects, $log, $repoUrl);
        }
        die();
    }

    /**
     * Ajax get repos.
     * 
     * @access public
     * @return void
     */
    public function ajaxGetRepos()
    {
        $repos = $this->svn->getRepos();
        die(json_encode($repos));
    }
}
