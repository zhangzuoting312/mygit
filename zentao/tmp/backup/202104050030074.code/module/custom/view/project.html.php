<?php
/**
 * The project view file of custom module of ZenTaoPMS.
 * @copyright   Copyright 2009-2020 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Liyuchun <liyuchun@cnezsoft.com>
 * @package     custom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include 'header.html.php';?>
<div id='mainContent' class='main-content'>
  <form class="load-indicator main-form form-ajax" method='post'>
    <table class='table table-form'>
      <tr>
        <th class='w-150px'><?php echo $lang->custom->closedProject;?></th>
        <td class='w-300px text-left'>
          <?php $checkedKey = isset($config->CRProject) ? $config->CRProject : 0;?>
          <?php foreach($lang->custom->CRProject as $key => $value):?>
          <label class="radio-inline"><input type="radio" name="project" value="<?php echo $key?>"<?php echo $key == $checkedKey ? " checked='checked'" : ''?> id="project<?php echo $key;?>"><?php echo $value;?></label>
          <?php endforeach;?>
        </td>
        <td><span class='alert alert-info no-margin'><?php echo $lang->custom->notice->readOnlyOfProject;?></span></td>
      </tr>
      <tr>
        <th></th>
        <td class='form-actions'>
          <?php echo html::submitButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<script>
$(function()
{
    $('#mainMenu #projectTab').addClass('btn-active-text');
})
</script>
<?php include '../../common/view/footer.html.php';?>
