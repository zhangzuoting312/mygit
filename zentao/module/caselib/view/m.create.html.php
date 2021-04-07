<?php
/**
 * The create lib view file of caselib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     caselib
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<div class='heading'>
  <div class='title'><?php echo $lang->caselib->create;?></div>
</div>
<form class='content box' data-form-refresh='#page' method='post' id='createLibForm' action='<?php echo $this->createLink('caselib', 'create', http_build_query($this->app->getParams()));?>'>
  <div class="control">
    <label for='name'><?php echo $lang->caselib->name;?></label>
    <?php echo html::input('name', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->caselib->desc;?></label>
    <?php echo html::textarea('desc', '', "rews='5' class='textarea'");?>
  </div>
  <div class='control'>
    <button type='submit' class='btn primary'><?php echo $lang->save;?></button>
  </div>
</form>
<?php include '../../common/view/m.footer.html.php';?>
