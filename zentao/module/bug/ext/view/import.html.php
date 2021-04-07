<?php include '../../../common/view/header.lite.html.php';?>
<main>
  <div class="container">
    <div id="mainContent" class='main-content'>
      <div class='main-header'>
        <h2><?php echo $lang->bug->importCase;?></h2>
      </div>
      <form enctype='multipart/form-data' method='post' target='hiddenwin' style='padding: 20px 0 15px'>
        <table class='table table-form w-p100'>
          <tr>
            <td><input type='file' name='file' class='form-control'/></td>
            <td class='w-150px'><?php echo html::submitButton('', '', 'btn btn-primary');?></td>
          </tr>
          <tr>
            <td class='text-left' colspan='2'><span class='label label-info'><?php echo $lang->bug->importNotice;?></span></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</main>
<?php include '../../../common/view/footer.lite.html.php';?>
