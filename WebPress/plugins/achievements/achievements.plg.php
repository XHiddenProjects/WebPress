<?php defined('WEBPRESS') or die('WebPress Community');
function achievements_install(){
	$out = '';
	$plugin = 'achievements';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'1.2.2', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN),
	'users'=>array()
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function achievements_dblist(){
	global $lang, $BASEPATH;
		$out = '';
	$plugin = 'achievements';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : ['active'=>''];

	if($d['active']){
				$out.='<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_listItem'].'</a>';
	}
	return $out;
}
function checkAchievements(){
	global $session;
	
	$plugin = 'achievements';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : '';
	#otherDB
	$reaction = WebDB::dbExists('plugins','reactions/plugin') ? WebDB::getDB('plugins', 'reactions/plugin') : '';
	$users = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	
	# topics
	if(Forum::usersData($session, 'topics')==1&&!in_array('first_post',$d['config']['users'][$session])){
		$d['config']['users'][$session][] = 'first_post';
		WebDB::saveDB('plugins', $plugin.'/plugin',$d);
	}
	if(Forum::usersData($session, 'topics')==100&&!in_array('100_posts',$d['config']['users'][$session])){
		$d['config']['users'][$session][] = '100_posts';
		WebDB::saveDB('plugins', $plugin.'/plugin',$d);
	}
	# reply
	if(Forum::usersData($session, 'replys')==1&&!in_array('first_reply',$d['config']['users'][$session])){
		$d['config']['users'][$session][] = 'first_reply';
		WebDB::saveDB('plugins', $plugin.'/plugin',$d);
	}
	if(Forum::usersData($session, 'replys')==100&&!in_array('100_replies',$d['config']['users'][$session])){
		$d['config']['users'][$session][] = '100_replies';
		WebDB::saveDB('plugins', $plugin.'/plugin',$d);
	}
	
	# first reaction
	$rI=0;
	foreach($reaction['config']['replies'] as $reply=>$count){
		if($rI<1){
			if(array_key_exists($session,$count['users'])&&!in_array('first_reaction',$d['config']['users'][$session])){
				$d['config']['users'][$session][] = 'first_reaction';
				WebDB::saveDB('plugins', $plugin.'/plugin',$d);
				$rI++;
			}
		}
	}
	# promote
	if(Users::isMod()||Users::isAdmin()&&!in_array('promoted',$d['config']['users'][$session])){
		$d['config']['users'][$session][] = 'promoted';
		WebDB::saveDB('plugins', $plugin.'/plugin',$d);
	}
	# report
	if(preg_match('/mail\?report=[\w\d]+/',$_SERVER['REQUEST_URI'])&&!in_array('reporter',$d['config']['users'][$session])){
		$d['config']['users'][$session][] = 'reporter';
		WebDB::saveDB('plugins', $plugin.'/plugin',$d);
	}
	# year old
	if(isset($session)&&$session!==''){
		$dateTime = str_replace('+',' ',$users[$session]['created']);
		$date = DateTime::createFromFormat('m-d-Y h:i:sa',$dateTime);
		$setDate = strtotime($date->format('Y-m-d H:i:s'));
		$currDate = strtotime(date('Y-m-d H:i:s', strtotime('+1 year', $setDate)));
		if(strtotime(date('Y-m-d H:i:s'))>=$currDate&&!in_array('yearOld',$d['config']['users'][$session])){
			$d['config']['users'][$session][] = 'yearOld';
			WebDB::saveDB('plugins', $plugin.'/plugin',$d);
		}
	}
	# 40 years
	if(isset($session)&&$session!==''){
		$dateTime = str_replace('+',' ',$users[$session]['created']);
		$date = DateTime::createFromFormat('m-d-Y h:i:sa',$dateTime);
		$setDate = strtotime($date->format('Y-m-d H:i:s'));
		$currDate = strtotime(date('Y-m-d H:i:s', strtotime('+40 year', $setDate)));
		if(strtotime(date('Y-m-d H:i:s'))>=$currDate&&!in_array('40_yearsOld',$d['config']['users'][$session])){
			$d['config']['users'][$session][] = '40_yearsOld';
			WebDB::saveDB('plugins', $plugin.'/plugin',$d);
		}
	}
	
	
}
function achievements_beforePage(){
	global $lang, $BASEPATH, $session;
		$out = '';
	$plugin = 'achievements';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : ['active'=>''];
	if($d['active']&&isset($session)&&$session!==''){
		if(!isset($d['config']['users'][$session])){
			$d['config']['users'][$session][] = 'first_timer';
			WebDB::saveDB('plugins', $plugin.'/plugin',$d);
		}
		checkAchievements();
	}
	
}
function achievements_countAchievements($un){
	global $lang;
	$plugin='achievements';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : '';
	return '<span class="value">'.count($d['config']['users'][$un]).'</span><span class="text-secondary parameter">'.$lang[$plugin.'_name'].'</span>';
}
function achievements_profile(){
		global $lang, $BASEPATH, $session;
		$out = '';
	$plugin = 'achievements';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$out.='<div class="col">
			<a href="./view?plugins=achievements'.(isset($_GET['name']) ? '&user='.$_GET['name']: '').'"><button type="button" class="btn btn-warning">'.$lang[$plugin.'_name'].'<span class="badge bg-secondary ms-1 rounded">'.(isset($_GET['name']) ? count($d['config']['users'][$_GET['name']]) : count($d['config']['users'][$session])).'</span></button></a>
			</div>';
	}
	return $out;
}

function achievements_view(){
	global $lang, $BASEPATH, $session;
		$out = '';
	$plugin = 'achievements';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		if(isset($session)&&$session!==''||isset($_GET['user'])&&$_GET['user']!==''){
			$u = (isset($_GET['user']) ? $_GET['user'] : $session);
			
			if(isset($d['config']['users'][$u])){
				$out.= '<h2 class="text-center text-secondary">'.$u.$lang['plural'].$lang[$plugin.'_welcome'].'</h2>';
				$out.='<div class="d-flex">';
				foreach($d['config']['users'][$u] as $acheve){
					$out.='<div class="card border-0 m-2" style="width: 10rem;">
							<img src="'.$BASEPATH.DS.'plugins'.DS.$plugin.DS.'assets'.DS.$acheve.'.png" class="img-thumbnail img-fluid" alt="'.$u.'_'.$acheve.'">
						</div>';
				}
				$out.='</div>';
			}else{
				$out.= '<h2 class="text-center text-danger">'.$lang['nouser'].'</h2>';
			}
		}
	}
	return $out;
}
?>