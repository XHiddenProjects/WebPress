<?php defined('WEBPRESS') or die('WebPress Community');
function botchat_install(){
	$out = '';
	$plugin = 'botchat';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'2.0.3', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'position'=>'bottom-left',
	'senderColor'=>'primary',
	'receiverColor'=>'secondary',
	'playSound'=>'on',
	'cmds'=>['hello>Hello, {{SESSION}}!', 'hi>Hello, {{SESSION}}!']
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function botchat_config(){
		global $lang, $BASEPATH;
	$out='';
	$plugin = 'botchat';
	$color = array('primary'=>$lang['blue'], 'secondary'=>$lang['gray'], 'success'=>$lang['green'], 'warning'=>$lang['yellow'], 'danger'=>$lang['red'], 'dark'=>$lang['black'], 'light'=>$lang['white']);
	$position = array('bottom-left'=>$lang['bottom-left'], 'bottom-right'=>$lang['bottom-right'], 'top-left'=>$lang['top-left'], 'top-right'=>$lang['top-right']);
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$type = array('success'=>'success', 'warning'=>'warning', 'info'=>'info', 'danger'=>'danger', 'dark'=>'dark', 'light'=>'light');
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::select('botchat_sendercolor', $color, $d['config']['senderColor']).'
	</div>
	<div class="col">
	'.HTMLForm::select('botchat_receivercolor', $color, $d['config']['receiverColor']).'
	</div>
	<div class="col">
	'.HTMLForm::select('botchat_position', $position, $d['config']['position']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::checkBox('botchat_playSound', $d['config']['playSound']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::textarea('botchat_cmds', implode(PHP_EOL,$d['config']['cmds']), '', 'botchat_cmdsdesc').'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('botchat_submit', 'botchat_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);

	return $out;
}
function botchat_onSubmit(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'botchat';
		if(isset($_POST['botchat_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$sendercolor = $_POST['botchat_sendercolor'];
			$receivercolor = $_POST['botchat_receivercolor'];
			$position =  $_POST['botchat_position'];
			$playSound = isset($_POST['botchat_playSound']) ? $_POST['botchat_playSound'] : '';
			$cmds = $_POST['botchat_cmds'];
			
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['senderColor'] = $sendercolor;
			$d['config']['receiverColor'] = $receivercolor;
			$d['config']['position'] = $position;
			$d['config']['playSound'] = $playSound;
			$d['config']['cmds'] = @explode(PHP_EOL,$cmds);
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
}
function botchat_head(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'botchat';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$out.=' <style>
  {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  padding: 16px 20px;
  border: none;
  width: 100%;
  margin-bottom:10px;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
[data-name="botchat-box"] .dropdown-menu.show {
    width: 180%;
}
[data-name="botchat-box"] button{
	width: 180%;
}
.botBubble {
    position: relative;
    background: #2ce858;
    color: #e1e3e8;
    font-family: Arial;
    font-size: 18px;
	width:50%;
    text-align: center;
    border-radius: 10px;
    padding: 2px;
	margin-left:1px;
	margin-top:7px;
	word-break: break-all;
	float: left;
}
.userbubble {
    position: relative;
    background: #006cf0;
    color: #e1e3e8;
    font-family: Arial;
    font-size: 18px;
	width:50%;
	float:right;
    text-align: center;
    border-radius: 10px;
    padding: 2px;
	margin-left:1px;
	margin-top:7px;
	word-break: break-all;
}
.chatroom{
	overflow:auto;
	height: 100px;
}
  </style>';
		}
		return $out;
}
function botchat_afterPage(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'botchat';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			if(@explode('-',$d['config']['position'])[0]==='bottom'){
				$out.='<div data-name="botchat-box" style="z-index:100;'.(@explode('-',$d['config']['position'])[1]==='left' ? 'bottom:20%;left:0;' : 'bottom:20%;right:0;').'" class="btn-group dropup position-fixed">
  <button type="button" class="btn btn-secondary dropdown-toggle btn-lg" data-bs-toggle="dropdown" aria-expanded="false">
    '.$lang['botchat_boxlabel'].'
  </button>
 
  <ul class="dropdown-menu">
    <div class="chat-popup" id="myForm">
  <form class="form-container" onsubmit="sentBack(); return false;">
    <h1>'.$lang['botchat_boxlabel'].'</h1> 
	<div class="chatroom mt-2 mb-2">
	<div class="botBubble text-bg-'.$d['config']['receiverColor'].'">Enter Message to reply...</div>
	</div>
<hr class="border border-3 border-secondary rounded"/>
    <label class="form-label" for="msg"><b>Message</b></label>
    <textarea class="form-control userbotmsg" placeholder="Type message.." name="msg" required></textarea>

    <input type="submit" class="btn btn-success botchatsubmit" value="Submit"/>
  </form>
</div>
  </ul>
</div>';
		}elseif(@explode('-',$d['config']['position'])[0]==='top'){
				$out.='<div data-name="botchat-box" style="z-index:100;'.(@explode('-',$d['config']['position'])[1]==='left' ? 'top:8%;left:0;' : 'top:8%;right:0;').'" class="btn-group position-fixed">
  <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    '.$lang['botchat_boxlabel'].'
  </button>
  <ul class="dropdown-menu">
    ...
  </ul>
</div>';
			}
			
		}
		return $out;
}
function botchat_addquotes($str) {
    return sprintf("'%s'", $str);
}
function botchat_footer(){
			global $lang, $BASEPATH, $session;
		$out='';
		$plugin = 'botchat';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$out.='<script>var botconfig = {"playSound": '.($d['config']['playSound'] ? 'true' : 'false').',"cmds": ['.implode(',',array_map('botchat_addquotes',$d['config']['cmds'])).'],"sentAudio": "'.$BASEPATH.'/plugins/'.$plugin.'/assets/sent.wav'.'","receivedAudio": "'.$BASEPATH.'/plugins/'.$plugin.'/assets/received.mp3","failedAudio":"'.$BASEPATH.'/plugins/'.$plugin.'/assets/failed.mp3","senderColor":"'.$d['config']['senderColor'].'","receivedColor":"'.$d['config']['receiverColor'].'","session":"'.$session.'"}</script><script src="'.$BASEPATH.DS.'plugins'.DS.$plugin.'/js/'.$plugin.'.min.js?v='.$d['version'].'"></script>';
		}
		return $out;
}
?>