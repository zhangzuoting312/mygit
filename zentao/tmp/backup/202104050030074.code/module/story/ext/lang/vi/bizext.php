<?php
$lang->story->typeList['story'] = $lang->storyCommon;

$lang->story->moveSRTips = "";
if(!empty($lang->URCommon)) $lang->story->moveSRTips = "Its {$lang->SRCommon} will be moved to the selected product when editing the linked product of {$lang->URCommon}.";;

global $config;
if(!empty($config->URAndSR))
{
    $lang->story->UR                = zget($lang, 'URCommon', "Yêu cầu");
    $lang->story->SR                = zget($lang, 'SRCommon', "Câu chuyện");
    $lang->story->createStory       = 'Tạo ' . $lang->story->SR;
    $lang->story->createRequirement = 'Tạo ' . $lang->story->UR;
    $lang->story->affectedStories   = $lang->story->SR;

    $lang->story->typeList['requirement'] = $lang->story->UR;
    $lang->story->typeList['story']       = $lang->story->SR;
}
