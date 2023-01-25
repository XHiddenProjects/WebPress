<?php defined('WEBPRESS') or die('WebPress Community');
function maintenance_install(){
	$out = '';
	$plugin = 'maintenance';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';
	$msg  = '<!DOCTYPE html>'.PHP_EOL;
	$msg .= '<html lang="' .$config['lang']. '">'.PHP_EOL;
	$msg .= '<head>'.PHP_EOL;
	$msg .= '<meta charset="UTF-8">'.PHP_EOL;
	$msg .= '<title>Site Maintenance</title>'.PHP_EOL;
	$msg .= '<style>'.PHP_EOL;
	$msg .= 'body { text-align: center; padding: 150px; }'.PHP_EOL;
	$msg .= 'h1 { font-size: 50px; }'.PHP_EOL;
	$msg .= 'body { font: 20px Helvetica, sans-serif; color: #333; }'.PHP_EOL;
	$msg .= 'article { display: block; text-align: left; width: 650px; margin: 0 auto; }'.PHP_EOL;
	$msg .= 'a { color: #2196F3; text-decoration: none; }'.PHP_EOL;
	$msg .= 'a:hover { color: #5352ed; text-decoration: none; }'.PHP_EOL;
	$msg .= 'small { color: #a4b0be; font-style: italic; font-size: small}'.PHP_EOL;
	$msg .= '</style>'.PHP_EOL;
	$msg .= '</head>'.PHP_EOL;
	$msg .= '<body>'.PHP_EOL;	
	$msg .= '<article>'.PHP_EOL;
	$msg .= '<h1>We’ll be back soon!</h1>'.PHP_EOL;
	$msg .= '<div>'.PHP_EOL;
	$msg .= '<p>Sorry for the inconvenience but we’re performing some maintenance at the moment. If you need to you can always <a href="mailto:' .$config['mail']. '">contact us</a>, otherwise we’ll be back online shortly!</p>'.PHP_EOL;
	$msg .= '<p>'.PHP_EOL;
	$msg .= '— ' .$config['title']. ' Team.<br />'.PHP_EOL;
	$msg .= '<small>Maintenance Mode v. 2.0.3</small>'.PHP_EOL;
	$msg .= '</p>'.PHP_EOL;
	$msg .= '</div>'.PHP_EOL;
	$msg .= '</article>'.PHP_EOL;
	$msg .= '</body>'.PHP_EOL;
	$msg .= '</html>';
$data = array(
'active'=>'',
'version'=>'2.0.3', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'active'=>'',
	'msg'=>base64_encode($msg)
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function maintenance_config(){
	global $lang;
	$out='';
	$plugin='maintenance';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::textarea('maintenance_msg', base64_decode($d['config']['msg']), '', '', 8).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('maintenance_submit', 'maintenance_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	}
	return $out;
}
function maintenance_onSubmit(){
	global $lang, $BASEPATH;
		$out='';
	$plugin='maintenance';
	if(isset($_POST['maintenance_submit'])){
	$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
	$msg = base64_encode($_POST['maintenance_msg']);
	
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	$d['active'] = $active;
	$d['config']['msg'] = $msg;
	$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
	return $out;
	}
}
function maintenance_init(){
		global $lang;
	$out='';
	$plugin='maintenance';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if(isset($d['active'])&&$d['active']&&!Users::isAdmin()){
		# maintenance message
		exit(base64_decode($d['config']['msg']));
	}
}
function maintenance_beforePage(){
	global $lang;	
  $plugin = 'maintenance';
  $d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
  if(isset($d['active'])&&$d['active'])
	return '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">' .$lang[$plugin.'mme']. '</h4>' .$lang[$plugin.'messageAlert']. '</div>';   
}
?>