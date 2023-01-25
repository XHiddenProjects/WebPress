<?php defined('WEBPRESS') or die('WebPress Community');
function dataguard_install(){
	$out = '';
	$plugin = 'dataguard';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'2.0.1', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'copy'=>'on',
	'cut'=>'on',
	'print'=>'on',
	'menu'=>'on',
	'paste'=>'on'
),);
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}

function dataguard_config(){
	$out='';
	$plugin='dataguard';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$out.=$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::checkBox($plugin.'_copy', $d['config']['copy']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::checkBox($plugin.'_cut', $d['config']['cut']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::checkBox($plugin.'_print', $d['config']['print']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::checkBox($plugin.'_menu', $d['config']['menu']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::checkBox($plugin.'_paste', $d['config']['paste']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('dataguard_submit', 'dataguard_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	}
	return $out;
}
function dataguard_onSubmit(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'dataguard';
		if(isset($_POST['dataguard_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$copy = isset($_POST[$plugin.'_copy']) ? $_POST[$plugin.'_copy'] : '';
			$cut = isset($_POST[$plugin.'_cut']) ? $_POST[$plugin.'_cut'] : '';
			$print = isset($_POST[$plugin.'_print']) ? $_POST[$plugin.'_print'] : '';
			$menu = isset($_POST[$plugin.'_menu']) ? $_POST[$plugin.'_menu'] : '';
			$paste = isset($_POST[$plugin.'_paste']) ? $_POST[$plugin.'_paste'] : '';
			
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['copy'] = $copy;
			$d['config']['cut'] = $cut;
			$d['config']['print'] = $print;
			$d['config']['menu'] = $menu;
			$d['config']['paste'] = $paste;
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
	
}

function dataguard_footerJS(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'dataguard';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$out.='<script class="dataguardinfo">
			var protect = {
				copy: "'.$d['config']['copy'].'",
				cut: "'.$d['config']['cut'].'",
				print: "'.$d['config']['print'].'",
				menu: "'.$d['config']['menu'].'",
				paste: "'.$d['config']['paste'].'"
			}</script>';
			$out.='<script src="'.$BASEPATH.'/plugin/'.$plugin.'/js/'.$plugin.'.min.js?v='.$d['version'].'"></script>';
		}
		return $out;
}

?>