<?php defined('WEBPRESS') or die('WebPress Community');
function Core_install(){
	$out = '';
	$plugin = 'Core';
	!WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::makeDB('PLUGINS', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'name'=>array('en'=>'Core'),
'active'=>'on',
'version'=>'0.0.2', 
'desc'=>array('en'=>'Easy way to run WebPress, activates and creates editors and etc...'), 
'options'=>array('canDisabled'=>filter_var(false, FILTER_VALIDATE_BOOLEAN), 
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN)
), 
'usedLang'=>array('en-US')));
$out.= WebDB::saveDB('Plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function Core_head(){
	global $BASEPATH;
	$out = '<script src="'.$BASEPATH.DS.'plugins'.DS.'Core'.DS.'js'.DS.'core.js?catche='.date('m-d-Ys').'" class="CoreJS"></script>';
	return $out;
}
?>