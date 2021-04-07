<?php
/**
 * The control file of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     effort
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2>
        <span class='label label-id'><?php echo $effort->id;?></span>
        <?php echo $lang->effort->view;?>
        <?php if($effort->deleted):?>
        <span class='label label-danger'><?php echo $lang->effort->deleted;?></span>
        <?php endif;?>
      </h2>
    </div>
    <table class='table table-form' id='effort'> 
      <tbody>
        <tr>
          <th class='w-80px'><?php echo $lang->effort->account;?></th>
          <td><?php echo zget($users, $effort->account);?></td>
        </tr>  
        <tr>
          <th class='rowhead'><?php echo $lang->effort->date;?></th>
          <td><?php echo date(DT_DATE1, strtotime($effort->date));?></td>
        </tr>  
        <tr>
          <th class='rowhead'><?php echo $lang->effort->consumed;?></th>
          <td>
            <?php
            if(isset($effort->consumed)) echo $effort->consumed . ' ' . $lang->effort->hour;
            ?>
          </td>
        </tr>  
        <?php if($effort->objectType == 'task'):?>
        <tr>
          <th class='rowhead'><?php echo $lang->effort->left;?></th>
          <td>
            <?php
            if(isset($effort->consumed)) echo $effort->left . ' ' . $lang->effort->hour;
            ?>
          </td>
        </tr>
        <?php endif;?>
        <tr>
          <th class='rowhead'><?php echo $lang->effort->objectType;?></th>
          <td>
            <?php
            echo zget($lang->effort->objectTypeList, $effort->objectType, '');
            if($work) echo html::a($this->createLink($effort->objectType, 'view', "objectID={$effort->objectID}"), ' #' . $effort->objectID . ' ' .$work[$effort->objectID]);
            ?>
          </td>
        </tr>  
        <tr>
          <th class='rowhead'><?php echo $lang->effort->work;?></th>
          <td>
            <?php echo $effort->work;?>
          </td>
        </tr>  
      </tbody>
    </table>
    <?php if(common::canBeChanged('effort', $effort)) $actionFormLink = $this->createLink('action', 'comment', "objectType=effort&objectID=$effort->id");?>
    <?php include '../../common/view/action.html.php';?>
  </div>
</div>
<?php if(!isonlybody()):?>
<div id='mainActions' class='main-actions'>
  <nav class='container'></nav>
  <div class='btn-toolbar'>
    <?php
    if($this->session->effortList)
    {
        $browseLink = $this->session->effortList;
    }
    elseif($effort->account == $app->user->account)
    {
        $browseLink = $this->createLink('my', 'effort');
    }
    else
    {
        $browseLink = $this->createLink('user', 'effort', "userID=$user->id");
    }
    ?>
    <?php common::printBack($browseLink);?>
    <div class='divider'></div>
    <?php
    if($effort->account == $app->user->account)
    {
        common::printIcon('effort', 'edit', "effortID=$effort->id");
        common::printIcon('effort', 'delete', "effortID=$effort->id", '', 'button', '', 'hiddenwin');
    }
    ?>
  </div>
</div>
<?php endif;?>
<script>
$(function()
{
    parent.$('body.hide-modal-close').removeClass('hide-modal-close');
})
</script>
<?php include '../../common/view/footer.html.php';?>
