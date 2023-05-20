<?php defined('WEBPRESS') or die('WebPress Community');
function Core_install(){
	$out = '';
	$plugin = 'Core';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'on',
'version'=>'2.3.6', 
'options'=>array('canDisabled'=>filter_var(false, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN)
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function useQuotes($q){
	return '"'.$q.'"';
}
function Core_head(){
	global $BASEPATH;
	$out='<script>var coreUsers = {listUsers:['.implode(',', array_map('useQuotes',Users::listUsers(false))).']}</script>';
	$out .= '<script src="'.$BASEPATH.DS.'plugins'.DS.'Core'.DS.'js'.DS.'core.js?catche='.date('m-d-Ys').substr(uniqid(), 2, 5).'" class="CoreJS"></script>';
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