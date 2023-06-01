<?php defined('WEBPRESS') or die('WebPress Community');
function nofollow_install(){
		$out = '';
	$plugin = 'nofollow';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
	'active'=>'',
	'version'=>'0.0.6', 
	'config'=>array(
		'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN)
	),
	'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),  
	'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN', 'ru-RU')
	)
	);
	$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
	return $out;
}
function nofollow_footerJS(){
	global $lang, $BASEPATH;
	$plugin='nofollow';
	$out='';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$out.='<script>
		$(document).ready(function(){
			$("a").attr("rel", "nofollow");
		});
		</script>';
	}
	return $out;
}




?>