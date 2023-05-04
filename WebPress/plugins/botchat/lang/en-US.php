<?php
$plugin='botchat';
$lang[$plugin.'_name'] = 'Bot Chat';
$lang[$plugin.'_desc'] = 'Make custom custom help chat, for anyone to get help your page.';
$lang[$plugin.'_author'] = 'SurveyBuilderTeams';
$lang[$plugin.'_updated'] = '16-02-2023';
$lang[$plugin.'_homepage'] = 'https://github.com/surveybuilderteams/webpress';
$lang[$plugin.'_submit'] = 'Submit';
$lang[$plugin.'_sendercolor'] = 'Sender Color';
$lang[$plugin.'_receivercolor'] = 'Receiver Color';
$lang[$plugin.'_position'] = 'Position';
$lang[$plugin.'_playSound'] = 'Play Sound?';
$lang[$plugin.'_help'] = 'Use:{{SESSION}} - for selected user;';
$lang[$plugin.'_cmds'] = 'Enter Commands '.Users::helpPrompt($plugin.'_help');
$lang[$plugin.'_cmdsdesc'] = 'Format:"{input_text}>{output_text}"<br/><b>Enter new line for new commands</b>';
$lang['bottom-left']  = 'Bottom-Left';
$lang['bottom-right'] = 'Bottom-Right';
$lang['top-left']     = 'Top-Left';
$lang['top-right']    = 'Top-Right';
$lang[$plugin.'_boxlabel'] = 'Open Chat';
?>