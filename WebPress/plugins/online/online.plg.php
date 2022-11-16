<?php defined('WEBPRESS') or die('WebPress Community');
function online_install(){
		$out = '';
	$plugin = 'online';
	!WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::makeDB('PLUGINS', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
	'name'=>array('en'=>'Online'),
	'active'=>'',
	'version'=>'0.1.0', 
	'desc'=>array('en'=>'Shows who is online by configuration and displays and circle on top of the account image on the forum, and in the footer.'), 
	'config'=>array(
		'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
		'color'=>'',
		'display'=>''
	),
	'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),  
	'usedLang'=>array('en-US')));
	$out.= WebDB::saveDB('Plugins', $plugin.'/plugin', $data) ? '' : 'Error';
	WebDB::makeDB('plugins', $plugin.'/online_hit');
	$online=array();
	$online[Users::getRealIP()] = time();
	$out.= WebDB::saveDB('Plugins', $plugin.'/online_hit', $online) ? '' : 'Error';
	return $out; 
}
function online_config(){
	global $lang, $BASEPATH;
	$out='';
	$plugin = 'online';
	$color = array('primary'=>$lang['blue'], 'secondary'=>$lang['gray'], 'success'=>$lang['green'], 'warning'=>$lang['yellow'], 'danger'=>$lang['red'], 'dark'=>$lang['black'], 'light'=>$lang['white']);
	$display =   $display = array('icon'=> $lang['icon'], 'text'=> $lang['text']);
	$d = WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$type = array('success'=>'success', 'warning'=>'warning', 'info'=>'info', 'danger'=>'danger', 'dark'=>'dark', 'light'=>'light');
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::select('online_color', $color, $d['config']['color']).'
	</div>
	<div class="col">
	'.HTMLForm::select('online_display', $display, $d['config']['display']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('online_submit', 'online_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	
	return $out;
}
function online_onSubmit(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'online';
		if(isset($_POST['online_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$color = $_POST['online_color'];
			$display = $_POST['online_display'];
			
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['color'] = $color;
			$d['config']['display'] = $display;
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
}

function online_footer(){
	global $lang, $lang;
	$plugin = 'online';
	$out = '';
	$data = WebDB::getDB('plugins', $plugin.'/plugin');
	if($data['active']){
		$crawler = Users::crawler_handler($_SERVER['HTTP_USER_AGENT']);
		$online = WebDB::getDB('plugins',$plugin.'/'.$plugin.'_hit');
		foreach((array)$online as $ip=>$time){
			if(time() - $time > 300)
				unset($online[$ip]);
		}
		$online[Users::getRealIP()] = time();
		WebDB::saveDB('plugins', $plugin.'/'.$plugin.'_hit', $online);
		/*check if bot*/
		$out .= '&nbsp;<span class="badge text-bg-' .$data['config']['color']. '">' .($data['config']['display']=='icon' ? '<i class="fa fa-user"></i> ': $lang['online']).intval($online);
		if ($crawler) return '<button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="' .$crawler. '">Bots</button>';	
		/*realy Users*/
		$sessionRole = isset($_SESSION['role']) ? count(array($_SESSION['role'])) : '';
  	if(isset($_SESSION['role'])&&$_SESSION['role']!==''&&$_SESSION['role']==='admin'||isset($_SESSION['role'])&&$_SESSION['role']==='moderator')
  		$out .= ' - <a data-toggle="tooltip" data-placement="top" title="' .$lang['staff_online']. ': ' .intval($sessionRole). '"><i class="fa fa-user-plus"></i></a>';			  		
	$out .= '</span>';
	}
	return $out;
}
function checkOnline($username){
	global $session;
	!defined('IS_ONLINE') ? define('IS_ONLINE', true) : '';
	$plugin = 'online';
	$out = '';
	$grabber = WebDB::getDB('users', 'users');
		$users=array();
		$data = WebDB::getDB('plugins', $plugin.'/plugin');
		if($data['active']){
			$online = WebDB::getDB('plugins', $plugin.'/'.$plugin.'_hit');
			foreach((array)$online as $ip => $time)
			{
				
				# On check si c'est une IP
				$validIP  = filter_var($ip, FILTER_VALIDATE_IP);
				# Mais on ne filtrera que les membres
				if($validIP)
					$users[$ip] = $ip;						
				# Online mode	
				if($session!==''&&isset($users[$validIP])&&$username === $users[$validIP]&&$username===$grabber[$session]['ip'])
				    $usersStat = '<span class="avatar-status green"></span>';
				else
					$usersStat = '<span class="avatar-status red"></span>';	
			}
			$currentUsers = IS_ONLINE ? $usersStat : '';
			return $currentUsers;
		}
	
	
}
?>