<?php defined('WEBPRESS') or die('WebPress Community');
function signature_install(){
	$out = '';
	$plugin = 'signature';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'2.0.0', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'valid'=>array()
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function signature_config(){
	global $lang;
	$out='';
	$plugin = 'signature';
	$d = WebDB::getDB('plugins',$plugin.'/plugin');
	if($d['active']){
		
		$out.=HTMLForm::form(CONFIG_SAVE.$plugin, '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::select('signature_users', Users::listUsers(false)).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::textarea('signature_msg', '', '', 'signature_des', 10).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('signature_submit', 'signature_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	}
	return $out;
}
function signature_onSubmit(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'signature';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if(isset($_POST['signature_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$un = $_POST['signature_users'];
			$msg = $_POST['signature_msg'];
			$d['active'] = $active;
			if($msg!==''){
				$d['config']['valid'][$un] = htmlentities($msg, ENT_QUOTES);
			}else{
				if(isset($d['config']['valid'][$un])){
					unset($d['config']['valid'][$un]);
				}
			}
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
	
}
function signature_afterMsg(){
	global $lang, $BASEPATH, $author;
		$out='';
		$plugin = 'signature';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		if(array_key_exists($author, $d['config']['valid']))
			$out.='<blockquote class="mt-4 mb-3" style="border-left-color:#07d5df; border-right-color:#07d5df">'.html_entity_decode($d['config']['valid'][$author], ENT_QUOTES).'</blockquote>';
	}
	return $out;
}
?>