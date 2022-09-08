<?php defined('WEBPRESS') or die('WebPress Community');

function notify_install(){
	$out = '';
	$plugin = 'notify';
	!WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::makeDB('PLUGINS', $plugin.'/plugin') : '';

$data = array(
'name'=>array('en'=>'Notify'),
'active'=>'',
'version'=>'0.0.1', 
'desc'=>array('en'=>'Allow Users to get Notify on page load'), 
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'banners'=>array(
		'demo'=>array(
			'name'=>'demo',
			'type'=>'success',
			'msg'=>'This is a demo banner',
			'active'=>'on'
			)
	)
), 
'options'=>array(
'canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US')
	)
);
$out.= WebDB::saveDB('Plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;

}
function notify_config(){
	global $lang, $BASEPATH;
	$out='';
	$plugin = 'notify';
		$d = WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$type = array('success'=>'success', 'warning'=>'warning', 'info'=>'info', 'danger'=>'danger', 'dark'=>'dark', 'light'=>'light');
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col">
			'.HTMLForm::checkBox('notify_active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::text('notify_msg').'
	</div>
	<div class="col">
	'.HTMLForm::select('notify_type', $type).'
	</div>
	<div class="col">
	'.HTMLForm::text('notify_name').'
	</div>
	<div class="col">
	'.HTMLForm::checkBox('notify_bannerActive').'
	</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('notify_submit','notify_submit').'
	</div>
	</div>'
	);
		}
	
	return $out;	
}
function notify_onSubmit(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'notify';
		if(isset($_POST['notify_submit'])){
		
		$active = isset($_POST['notify_active']) ? $_POST['notify_active'] : '';
		$msg = $_POST['notify_msg'];
		$type = $_POST['notify_type'];
		$name =  $_POST['notify_name'];
		$bannerActive = isset($_POST['notify_bannerActive']) ? $_POST['notify_bannerActive'] : '';
		# get database
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	
		#save query
	
		if($msg&&$type&&$name){
			$d['config']['banners'][$name]['name'] = $name;
			$d['config']['banners'][$name]['type'] = $type;
			$d['config']['banners'][$name]['msg'] = $msg;
			$d['config']['banners'][$name]['active'] = $bannerActive;
		}
		$d['active'] = $active;
		
		$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
		}else{
		$out.=Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
		}
	return $out;	
}
function notify_beforePage(){
	global $myLang;
	$out='';
	$plugin = 'notify';
	$d = WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$banners = $d['config']['banners'];
		foreach($banners as $banner=>$args){
			if($banners[$banner]['active']){
				$out.='<div name="'.$banners[$banner]['name'].'" class="m-0 alert-dismissible fade show alert alert-'.$banners[$banner]['type'].'" role="alert">'.$banners[$banner]['msg'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}
	}
	return $out;
}
?>