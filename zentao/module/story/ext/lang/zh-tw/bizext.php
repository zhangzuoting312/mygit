<?php
$lang->story->typeList['story'] = $lang->storyCommon;

$lang->story->moveSRTips = "";
if(!empty($lang->URCommon)) $lang->story->moveSRTips = "修改{$lang->URCommon}的所屬產品會將其下的{$lang->SRCommon}也移動到所選產品下。";

global $config;
if(!empty($config->URAndSR))
{
    $lang->story->UR                = zget($lang, 'URCommon', "用戶{$lang->storyCommon}");
    $lang->story->SR                = zget($lang, 'SRCommon', "研發{$lang->storyCommon}");
    $lang->story->createStory       = '添加' . $lang->story->SR;
    $lang->story->createRequirement = '添加' . $lang->story->UR;
    $lang->story->affectedStories   = "影響的{$lang->story->SR}";

    $lang->story->typeList['requirement'] = $lang->story->UR;
    $lang->story->typeList['story']       = $lang->story->SR;
}
