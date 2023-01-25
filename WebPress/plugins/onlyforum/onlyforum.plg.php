<?php defined('WEBPRESS') or die('WebPress Community');
function onlyforum_install(){
		$out = '';
	$plugin = 'onlyforum';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
	'active'=>'',
	'version'=>'1.0.1', 
	'config'=>array(
		'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
		'forum'=>array(),
	),
	'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),  
	'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR')
	)
	);
	$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
	return $out;
}
function onlyforum_config(){
		global $lang, $BASEPATH;
	$out='';
	$plugin = 'onlyforum';
	$color = array('primary'=>$lang['blue'], 'secondary'=>$lang['gray'], 'success'=>$lang['green'], 'warning'=>$lang['yellow'], 'danger'=>$lang['red'], 'dark'=>$lang['black'], 'light'=>$lang['white']);
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div>
	<div class="row">
	<div class="col">
		'.HTMLForm::text('onlyforum_list', implode(', ',$d['config']['forum'])).'
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('onlyforum_submit', 'onlyforum_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	
	return $out;
}
function onlyforum_onSubmit(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'onlyforum';
		if(isset($_POST['onlyforum_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$list = explode(',',HTMLForm::compile($_POST['onlyforum_list']));
			
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['forum'] = (is_array($list) ? $list : array());
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
}
function onlyforum_footerJS(){
	global $lang, $BASEPATH;
	$out='';
	$plugin = 'onlyforum';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	$forumList=array();
	$args='';
	if($d['active']){
		if(!Users::isAdmin()){
			for($i=0;$i<count($d['config']['forum']);$i++){
				if($i<count($d['config']['forum'])-1){
					$comma=',';
				}else{
					$comma='';
				}
				$args.='"'.$d['config']['forum'][$i].'"'.$comma;
			}
			$out.='<script>var onlyforum=['.$args.'];</script>';
		foreach($d['config']['forum'] as $forums){
			if(isset($_GET['search'])&&$forums===str_replace('forum:','',$_GET['search'])){
				$out.='<script src="'.$BASEPATH.DS.'plugins'.DS.$plugin.DS.'js'.DS.$plugin.'.js?forum='.$forums.'&v=0"></script>';
			}
			$out.='<script src="'.$BASEPATH.DS.'plugins'.DS.$plugin.DS.'js'.DS.'checkBlock.js?forum='.$forums.'&v=0"></script>';
			
			}
		}
	}
	return $out;
}



?>