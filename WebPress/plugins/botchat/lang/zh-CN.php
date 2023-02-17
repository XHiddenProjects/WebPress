<?php
$plugin='botchat';
$lang[$plugin.'_name'] = '機器人聊天';
$lang[$plugin.'_desc'] = '進行自定義自定義幫助聊天，讓任何人都能在您的頁面上獲得幫助。';
$lang[$plugin.'_author'] = 'SurveyBuilderTeams';
$lang[$plugin.'_updated'] = '16-02-2023';
$lang[$plugin.'_homepage'] = 'https://github.com/surveybuilderteams/webpress';
$lang[$plugin.'_submit'] = '提交';
$lang[$plugin.'_sendercolor'] = '發件人顏色';
$lang[$plugin.'_receivercolor'] = '接收器顏色';
$lang[$plugin.'_position'] = '位置';
$lang[$plugin.'_playSound'] = '播放聲音？';
$lang[$plugin.'_help'] = '使用：{{SESSION}} - 對於選定的用戶;';
$lang[$plugin.'_cmds'] = '輸入命令 '.Users::helpPrompt($plugin.'_help');
$lang[$plugin.'_cmdsdesc'] = '格式："{input_text}>{output_text}"<br/><b>新命令換行</b>';
$lang['bottom-left']  = '左下方';
$lang['bottom-right'] = '右下角';
$lang['top-left']     = '左上方';
$lang['top-right']    = '右上';
$lang[$plugin.'_boxlabel'] = '打開聊天';
?>