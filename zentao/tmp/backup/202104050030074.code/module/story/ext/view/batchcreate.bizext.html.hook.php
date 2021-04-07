<?php if(!empty($config->URAndSR) and $type == 'requirement'):?>
<?php
$storyName = $type == 'requirement' ? $lang->URCommon : $lang->SRCommon;
$lang->story->source = str_replace($lang->storyCommon, $storyName, $lang->story->source);
$lang->story->title  = str_replace($lang->storyCommon, $storyName, $lang->story->title);
$lang->story->spec   = str_replace($lang->storyCommon, $storyName, $lang->story->spec);
?>
<script>
$(function()
{
    $('th.col-name').html('<?php echo $lang->story->title;?>');
    $('#batchCreateForm table thead tr:first').find('th').eq(5).html('<?php echo $lang->story->spec;?>');
    $('#batchCreateForm table thead tr:first th.col-plan').remove();
    $('#batchCreateForm table thead tr:first').find('th').eq(6).html('<?php echo $lang->story->source;?>');
    if($('#footer .breadcrumb li').length > 0) $('#footer .breadcrumb li').eq(3).html($('#footer .breadcrumb li').eq(3).html().replace('<?php echo $lang->storyCommon;?>', '<?php echo $storyName;?>'));
    $('#batchCreateForm table tbody tr').each(function(){ $(this).find('[id^=plan]').closest('td').remove();});
    var colspan = $('#batchCreateForm table tfoot tr:first td:first').attr('colspan');
    $('#batchCreateForm table tfoot tr:first td:first').attr('colspan', colspan - 1);
})
</script>
<?php endif;?>
