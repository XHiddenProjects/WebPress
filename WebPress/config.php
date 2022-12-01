<?php
require_once('init.php');
require_once('header.php');
require_once('footer.php');
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
	global $lang, $selLang, $BASEPATH;
	$BASEPATH = '../..';
	foreach($plugins as $plugin){
	if(file_exists('plugins/'.$plugin.'/lang/'.$selLang.'.php')){
		require_once('plugins/'.$plugin.'/lang/'.$selLang.'.php');
	}else{
		echo 'You are required to have '.$selLang.'.php';
	}
}

	$out = '';
	
	$name = preg_replace('/\/[\w\W]+\/config(?:\.php)\/plugin\//', '', $_SERVER['REQUEST_URI']);
	$out .= head('config '.$name.'', $BASEPATH);
	$out.='<style>form{height:70%;overflow:auto;}</style>';
	$out.='<h1 class="text-center mb-4">'.$lang['config.label'].' '.$name.' <a href="'.$BASEPATH.'/dashboard.php/plugins"><button class="btn btn-primary">'.$lang['index.dashboardbtn'].'</button></a></h1>';
	$out .= Plugin::forceExecute('config', $name);
	$out .= foot($BASEPATH);
	echo $out;
}
if(preg_match('/\/config(?:\.php)\/save\/[\w]+/', $_SERVER['REQUEST_URI'])){
	$out = '';
	$out .= head('config', '../..');
	$name = preg_replace('/\/[\w\W]+\/config(?:\.php)\/save\//', '', $_SERVER['REQUEST_URI']);
	$out .= Plugin::forceExecute('onSubmit', $name);
	$out .= foot($BASEPATH);
	echo $out;
}
if(isset($_GET['type'])&&isset($_GET['name'])&&isset($_GET['action'])){
	global $lang, $selLang;
	include_once('lang/'.$selLang.'.php');
	$out = '';
	$out .= head('config', './');
	echo $out;
	$name = $_GET['name'];
	$act = $_GET['action'];
	$set='';
	$d = WebDB::DBexists('themes', $name.'/theme', '.conf.json') ? WebDB::getDB('themes', $name.'/theme','.conf.json') : '';
	if($act==='active'){
		$set .= 'on';
	}elseif($act==='deactive'){
		$set.='';
	}
	
	$d['active'] = $set;
	for($i=0;$i<=3000;$i++){
		if($i==3000){
			$rewriteDB = fopen('themes/'.$name.'/theme.conf.json', 'w+');
			$data = json_encode($d, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			fwrite($rewriteDB, $data);
			echo @fclose($rewriteDB) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/themes', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/themes', 'danger');
		}
	}
	
}elseif(isset($_GET['name'])&&isset($_GET['action'])){
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
			echo WebDB::saveDB('plugins', $name.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/plugins'.(isset($_GET['r']) ? '?p='.$_GET['r'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/plugins', 'danger');
		}
	}
		
}
?>