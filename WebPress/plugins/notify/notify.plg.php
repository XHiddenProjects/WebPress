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
'options'=>array(
'canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
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
'usedLang'=>array('en-US')
	)
);
$out.= WebDB::saveDB('Plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}


function notify_config(){
	global $lang;
	$out='';
	$plugin = 'notify';
		$d = WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$out.=HTMLForm::form('', '<div class="row">
		<div class="col">
			'.HTMLForm::checkBox('active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::text('msg').'
	</div>
	</div>'
	);
		}

	return $out;	
	

}
function notify_beforePage(){
	global $myLang;
	$out='';
	$plugin = 'notify';
	$d = WebDB::dbExists('Plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$banners = $d['options']['config']['banners'];
		foreach($banners as $banner=>$args){
			if($banners[$banner]['active']){
				$out.='<div name="'.$banners[$banner]['name'].'" class="m-0 alert-dismissible fade show alert alert-'.$banners[$banner]['type'].'" role="alert">'.$banners[$banner]['msg'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
			}
		}
	}
	return $out;
}
?>