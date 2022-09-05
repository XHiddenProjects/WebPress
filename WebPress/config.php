<?php
require_once('init.php');
require_once('header.php');
require_once('libs/plugin.lib.php');
require_once('libs/users.lib.php');
require_once('libs/utils.lib.php');
require_once('libs/webdb.lib.php');
require_once('libs/files.lib.php');
require_once('libs/Parsedown.lib.php');
require_once('libs/ParsedownExtra.lib.php');
require_once('libs/BBlight.lib.php');
require_once('libs/BBcode.lib.php');
require_once('libs/wysiwyg.lib.php');
require_once('libs/Editor.lib.php');
require_once('libs/CSRF.lib.php');
require_once('libs/Captcha.lib.php');
require_once('libs/HTMLForm.lib.php');


if(preg_match('/\/config(?:\.php)\/plugin/', $_SERVER['REQUEST_URI'])){
	# load Plugin language
	global $lang, $selLang;
	foreach($plugins as $plugin){
	if(file_exists('plugins/'.$plugin.'/lang/'.$selLang.'.php')){
		require_once('plugins/'.$plugin.'/lang/'.$selLang.'.php');
	}else{
		echo 'You are required to have '.$selLang.'.php';
	}
}

	$out = '';
	$out .= head('config', '../..');
	$name = preg_replace('/\/WebPress\/config(?:\.php)\/plugin\//', '', $_SERVER['REQUEST_URI']);
	$out .= Plugin::hook('config');
	echo $out;
}
if(isset($_GET['name'])&&isset($_GET['action'])){
		global $lang, $selLang;
	include_once('lang/'.$selLang.'.php');
	$out = '';
	$out .= head('config', './');
	echo $out;
	$name = $_GET['name'];
	$act = $_GET['action'];
	$set='';
	$d = WebDB::DBexists('PLUGINS', $name.'/plugin') ? WebDB::getDB('PLUGINS', $name.'/plugin') : '';
	if($act==='active'){
		$set .= 'on';
	}elseif($act==='deactive'){
		$set.='';
	}
	
	$d['active'] = $set;
	for($i=0;$i<=3000;$i++){
		if($i==3000){
			echo WebDB::saveDB('plugins', $name.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/plugins', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/plugins', 'danger');
		}
	}
		
}
?>