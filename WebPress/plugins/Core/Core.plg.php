<?php defined('WEBPRESS') or die('WebPress Community');
function Core_install(){
	$out = '';
	$plugin = 'Core';
	!WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::makeDB('PLUGINS', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'on',
'version'=>'1.2.1', 
'options'=>array('canDisabled'=>filter_var(false, FILTER_VALIDATE_BOOLEAN), 
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN)
), 
'usedLang'=>array('en-US','de-DE','it-IT')));
$out.= WebDB::saveDB('Plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function Core_head(){
	global $BASEPATH;
	$out = '<script src="'.$BASEPATH.DS.'plugins'.DS.'Core'.DS.'js'.DS.'core.js?catche='.date('m-d-Ys').substr(uniqid(), 2, 5).'" class="CoreJS"></script>';
	return $out;
}
function Core_beforePage(){
	global $lang;
	if(!isset($_COOKIE['dissmissedPolicy'])){
	$out='<div class="alert alert-dismissible fade show alert-warning m-2 rounded">'.$lang['checkPolicy'].'
	<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>';
	setcookie('dissmissedPolicy', 'yes', time() + (86400 * 100), "/");
	}else{
		$out='';
	}

	return $out;
}
?>