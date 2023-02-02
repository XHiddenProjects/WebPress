<?php defined('WEBPRESS') or die('WebPress Community.');
function shariff_install()
{
$out = '';
$plugin = 'shariff';
!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';


$data = array(
	'active'=>'',
	'version'=>'2.0.1', 
	'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
	'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
	'config'=>array(
		'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
		$plugin.'domaine'=>getenv('HTTP_HOST'),
		'data-theme'=>'standard',
		'data-backend'=>false,
		'data-orientation'=>'horizontal',
		'data-services'=>'&quot;twitter&quot;, &quot;facebook&quot;, &quot;linkedin&quot;, &quot;pinterest&quot;, &quot;info&quot;'
));   
	$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
	return $out;
}


function shariff_config()
{    
	   global $lang, $BASEPATH; 
       $plugin = 'shariff';
       $out ='';
       $Backend = $BASEPATH.DS.'plugins'.DS.$plugin .DS. 'backend' .DS. '?url=' .urlencode(Utils::baseURL());
        
               if (WebDB::dbExists('plugins', $plugin.'/plugin'))
               $data = WebDB::getDB('plugins', $plugin.'/plugin');
               $out .= ($data['config']['data-backend'] ? '<a class="btn btn-primary" href="' .$Backend. '"><i class="fa fa-star" aria-hidden="true"></i> ' .$lang['backend']. '</a>' : '').
               HTMLForm::form(CONFIG_SAVE.$plugin,
               HTMLForm::checkBox('form_active', isset($data) ? $data['active'] : '').
               HTMLForm::checkBox('data-backend', isset($data)? $data['config']['data-backend'] : '').
               HTMLForm::text($plugin.'domaine', isset($data)? $data['config'][$plugin.'domaine'] : '', 'text','col-§'). '
			   <div class="form-row">
				    <div class="col-3">
				        ' .HTMLForm::select('data-theme', array('standard'=> $lang['standard'], 'grey'=> $lang['grey'], 'white'=> $lang['white']), $data['config']['data-theme']). '
				    </div>
				    <div class="col-3">
				        ' .HTMLForm::select('data-orientation', array('vertical'=> $lang['vertical'], 'horizontal'=> $lang['horizontal']), $data['config']['data-orientation']). '			        
				    </div>
			   </div>' . 
               HTMLForm::textarea('data-services', htmlspecialchars_decode($data['config']['data-services']), '', htmlspecialchars_decode('data-services_desc'), 4).
               HTMLForm::simple_submit('shariff_submit', 'shariff_submit','btn btn-success mt-1','fa fa-check'));
       
       return $out;
} 
function shariff_onSubmit(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'shariff';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if(isset($_POST['shariff_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$backend = isset($_POST['data-backend']) ? $_POST['data-backend'] : ''; 
			$domaine = ($_POST[$plugin.'domaine']!=='' ? $_POST[$plugin.'domaine'] : $d['config'][$_POST[$plugin.'domaine']]);
			$themes = $_POST['data-theme'];
			$orientation = $_POST['data-orientation'];
			$services = $_POST['data-services'];
			$d['active'] = $active;
			$d['config']['data-backend'] = $backend;
			$d['config'][$plugin.'domaine'] = $domaine;
			$d['config']['data-theme'] = $themes;
			$d['config']['data-orientation'] = $orientation;
			$d['config']['data-services'] = htmlspecialchars($services);
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
}
function shariff_head()
{
  $plugin = 'shariff';
  $PluginActivate = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin')['active'] : false;
  if ($PluginActivate)
	return '  <link href="/' .MAINDIR.DS.'plugins'.DS.$plugin. DS. 'build' .DS. 'shariff.complete.css" rel="stylesheet">'.PHP_EOL;
	     
}
/**
 * On charge les boutons de partage
**/
function shariff_bottomTopic()
{
	global $lang, $topic, $BASEPATH;
  $plugin = 'shariff';
  # Lecture des données
  $data = WebDB::getDB('plugins', $plugin.'/plugin');
  #$config = WebDB::getDB('config', 'config');
  $l = Users::getLang();
  
  if ($data['active'])
  {
	$topicEntry = WebDB::getDB('topics', $topic);
	$Url = (isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on' ? 'https://' : 'http://') . $data['config'][$plugin.'domaine'] .'/' . MAINDIR. DS. 'forum.php' . DS . 'view?id=' . $topic;
	$Description = substr($topicEntry['msg'],0,20);
	$Title = urlencode($topicEntry['name']);
	$Backend = '/'.MAINDIR.DS.'plugins'.DS.$plugin .DS. 'backend' .DS. '?url=' .urlencode(Utils::baseURL());
   	return '<div class="shariff mt-2"' .($data['config']['data-backend'] ? ' data-backend-url="' .$Backend. '"' : ''). ' data-url="' .$Url. '" data-theme="' .$data['config']['data-theme']. '" data-orientation="' .$data['config']['data-orientation']. '" data-lang="' .$l. '" data-services="[' .$data['config']['data-services']. ']"></div>'.PHP_EOL;	    
  }    
}

/** 
 * Ajoute du Javascript en pied de page du thème
 */
 function shariff_footerJS() { 
  	$plugin = 'shariff';
  	# Lecture des données
  	$PluginActivate = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin')['active'] : false;
  	if ($PluginActivate)
		return '  <script src="/' .MAINDIR.DS.'plugins'.DS. $plugin. DS. 'build' .DS. 'shariff.complete.js"></script>'.PHP_EOL;  
}