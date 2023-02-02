<?php defined('WEBPRESS') or die('WebPress Community');
function blogger_install(){
	$out = '';
	$plugin = 'blogger';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'2.0.1', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'display'=>'link',
	'color'=>'primary',
	'show'=>(int)'5',
	'blogs'=>array()
));
@mkdir(ROOT.'uploads'.DS.'blogs');
$out.= WebDB::saveDB('PLUGINS', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function blogger_head(){
		global $lang, $BASEPATH;
	$plugin = 'blogger';
	$out='';
	$d = WebDB::dbExists('PLUGINS', $plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : '';
	if(isset($d['active'])&&$d['active']){
		$out.='<link rel="stylesheet" href="'.$BASEPATH.'/plugin/'.$plugin.'/css/'.$plugin.'.css?v='.$d['version'].'"/>';
	}
	return $out;
}
function blogger_nav(){
	global $lang, $BASEPATH;
	$plugin = 'blogger';
	$out='';
	$d = WebDB::dbExists('PLUGINS', $plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : '';
	if($d['active']){
		if($d['config']['display']==='link'){
		$out.='<li class="dropdown-item"><a class="link-'.$d['config']['color'].'" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_viewBlog'].'</a></li>';	
		}elseif($d['config']['display']==='button'){
			$out.='<li class="dropdown-item"><a class="btn btn-'.$d['config']['color'].'" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_viewBlog'].'</a></li>';
		}elseif($d['config']['display']==='outline'){
			$out.='<li class="dropdown-item"><a class="btn btn-outline-'.$d['config']['color'].'" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_viewBlog'].'</a></li>';
		}
			
			
	}
	return $out;
}
function blogger_dblist(){
	global $BASEPATH, $lang;
	$out='';
	$plugin='blogger';
	$d = WebDB::dbExists('PLUGINS',$plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : array('active'=>'');
	if($d['active']){
		$out.='<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_listItem'].'</a>';
	}
	return $out;
}
function blogger_config(){
		global $lang, $BASEPATH;
	$out='';
	$plugin = 'blogger';
	
	$color = array('primary'=>$lang['blue'], 'secondary'=>$lang['gray'], 'success'=>$lang['green'], 'warning'=>$lang['yellow'], 'danger'=>$lang['red'], 'dark'=>$lang['black'], 'light'=>$lang['white']);
	$display = array('link'=>$lang['link'], 'button'=>$lang['button'], 'outline'=>$lang['outline']);
	
	$d = WebDB::dbExists('PLUGINS', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
		
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::select('bloggerColor', $color, $d['config']['color']).'
	</div>
	<div class="col">
	'.HTMLForm::select('bloggerDisplay', $display, $d['config']['display']).'
	</div>
	<div class="col">
	'.HTMLForm::text('bloggerShow', $d['config']['show']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	<label class="form-label">'.$lang[$plugin.'_pageName'].'</label>
	<div class="input-group">
	<div class="autocomplete">
	<input type="text" name="blogName" id="blogName" class="form-control">
	</div>
	</div>
	</div>
	<div class="col">
	<label class="form-label">'.$lang[$plugin.'_pageDescription'].'</label>
	<textarea name="blogDesc" id="blogDesc" class="form-control" maxlength="500"></textarea>
	</div>
	<div class="col">
	<label class="form-label">'.$lang[$plugin.'_pageLogo'].'</label>
	<input type="file" name="blogLogo" accept="image/*" id="blogLogo" class="form-control"/>
	</div>
	</div>
	<h6 class="text-danger">'.$lang[$plugin.'_warn'].'</h6>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('blogger_submit', 'blogger_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	,'','post',true);
	
	return $out;
}
function blogger_onSubmit(){
	global $lang, $BASEPATH, $session;
		$out='';
		$plugin = 'blogger';
		if(isset($_POST['blogger_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$color = $_POST['bloggerColor'];
			$display = $_POST['bloggerDisplay'];
			$name = isset($_POST['blogName'])&&$_POST['blogName']!=='' ? $_POST['blogName'] : 'noname';
			$desc = isset($_POST['blogDesc'])&&$_POST['blogDesc']!=='' ? $_POST['blogDesc'] : 'nodesc';
			$num = isset($_POST['bloggerShow'])&&is_numeric($_POST['bloggerShow']) ? $_POST['bloggerShow'] : $d['config']['show'];
			$num = ($num<2 ? 2 : $num);
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['color'] = $color;
			$d['config']['display'] = $display;
			$d['config']['show'] = (int)$num;
			if(Files::upload('blogLogo', ROOT.'uploads'.DS.'blogs'.DS, preg_replace("/[^a-zA-Z0-9\-\_]/", "", preg_replace('/\s/','-',$name)).'.png')){
			$d['config']['blogs'][] = array(
			'created'=>date('m/d/Y h:i:sa'), 
			'name'=>$name,
			'author'=>$session,
			'desc'=>htmlspecialchars($desc),
			'logo'=>preg_replace("/[^a-zA-Z0-9\-\_]/", "", preg_replace('/\s/','-',$name)).'.png',
			'like'=>(int)'0',
			'dislike'=>(int)'0',
			'users'=>array()
			);
			
			
			}
			$out .= WebDB::saveDB('PLUGINS', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			
			return $out;
		}
}
function blogger_view(){
	global $lang, $BASEPATH,$session,$conf;
	$plugin = 'blogger';
	$out='';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : '';
	if($d['active']){
		$query = $d['config']['blogs'];
		$strictURL = [];
		$urlSet = [];
		$setPages = [];
		for($i=0;$i<count($query);$i++){
			 preg_match_all('/(https?:\/\/)([\da-z\.-]+\.[a-z\.]{2,6}|[\d\.]+)([\/:?=&#]{1}[\da-z\.-]+)*[\/\?]?/', $query[$i]['desc'], $url);
				$q=$query[$i]['desc'];
				for($j=0;$j<count($url[0]);$j++){
					
					if(isset($url[0][$j])&&!empty($url[0][$j])){
					$urlSet[] = $url[0][$j];
					 $strictURL[] = '<a target="_blank" class="link-'.$d['config']['color'].'" href="'.$url[0][$j].'">'.$url[0][$j].'</a>';
					}
				}
			 
			 for($k=0;$k<count($urlSet);$k++){
				 $query[$i]['desc'] = str_replace($urlSet[$k], $strictURL[$k], $query[$i]['desc']);
			 }
			$setPages[]='<div class="card blogpost">
  <img src="'.$BASEPATH.DS.'uploads'.DS.'blogs'.DS.$query[$i]['logo'].'" class="card-img-top" alt="'.$query[$i]['name'].'">
  <div class="card-body">
    <h1 class="card-title">'.$query[$i]['name'].(Users::isAdmin() ? '<a href="./view?plugins='.$plugin.'&delete='.$i.'" class="text-danger float-end d-inline-block"><i class="fa-solid fa-trash-can"></i></a>' : '').'</h1>
    <p class="card-text blogger-desc">'. $query[$i]['desc'].'</p>
	
  </div>
  <div class="card-body blog-thumbs float-end">
    <a'.(!isset($d['config']['blogs'][$i]['users'][$session]) ? ' href="./view?plugins='.$plugin.'&help=like&id='.$i.'" ' : ' href="./view?plugins='.$plugin.'&remove=like&id='.$i.'" ').'class="card-link fs-3"><i class="fa-solid fa-thumbs-up me-2"></i><span class="badge bg-secondary">'.$query[$i]['like'].'</span></a>
    <a'.(!isset($d['config']['blogs'][$i]['users'][$session]) ? ' href="./view?plugins='.$plugin.'&help=dislike&id='.$i.'" ' : ' href="./view?plugins='.$plugin.'&remove=dislike&id='.$i.'" ').'class="card-link fs-3"><i class="fa-solid fa-thumbs-down me-2"></i><span class="badge bg-secondary">'.$query[$i]['dislike'].'</span></a>
  </div>
  <small class="text-secondary">
  '.date($conf['page']['dateFormat'], strtotime($query[$i]['created'])).' | '.$query[$i]['author'].'
  </small>
</div>';
		}
	}
	if(isset($_GET['help'])&&isset($_GET['id'])){
		$d['config']['blogs'][$_GET['id']][$_GET['help']] = (int)$d['config']['blogs'][$_GET['id']][$_GET['help']] + 1;
		$d['config']['blogs'][$_GET['id']]['users'][$session]=$_GET['help'];
		WebDB::saveDB('plugins',$plugin.'/plugin', $d);
		$out.='<script>
		window.history.back();
		</script>';
	}
	if(isset($_GET['remove'])&&isset($_GET['id'])){
		$d['config']['blogs'][$_GET['id']][$_GET['remove']] = ((int)$d['config']['blogs'][$_GET['id']][$_GET['remove']] - 1 <= 0 ? 0 : (int)$d['config']['blogs'][$_GET['id']][$_GET['remove']] - 1);
		if($_GET['remove']===$d['config']['blogs'][$_GET['id']]['users'][$session]){
			 unset($d['config']['blogs'][$_GET['id']]['users'][$session]);
		}
		WebDB::saveDB('plugins',$plugin.'/plugin', $d);
		$out.='<script>
		window.history.back();
		</script>';
	}
	if(isset($_GET['delete'])){
		unset($d['config']['blogs'][$_GET['delete']]);
	
		WebDB::saveDB('plugins',$plugin.'/plugin', $d);
		$out.='<script>
		window.history.back();
		</script>';
	}
	$p = isset($_GET['p']) ? $_GET['p'] : 1;
	$nb = $d['config']['show'];
	for($i=0;$i<count(array_slice($setPages, $nb*($p-1), $nb));$i++){
	$out.=array_slice($setPages, $nb*($p-1), $nb)[$i];
	}
	$out.=Paginate::pageLink(Paginate::pid($d['config']['show']), Paginate::countPage($query, $d['config']['show']), './view?plugins='.$plugin.'&');
	return $out;
}
function blogger_footerJS(){
		global $lang, $BASEPATH;
	$plugin = 'blogger';
	$out='';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : '';
	$args='';
	if($d['active']){
		for($i=0;$i<count($d['config']['blogs']);$i++){
			if($i==0){
				$c='';
			}else{
				if($i<count($d['config']['blogs'])){
				$c = ',';
			}else{
				$c='';
			}
			$args .= '"'.$d['config']['blogs'][$i]['name'].'"'.$c;
			}
			
		}
		$out.='<script>
		var blogs = ['.$args.'];
			autocomplete(document.querySelector("#blogName"), blogs);
			charCount(document.querySelector("#blogDesc"), document.querySelector(".totalCount"));
			</script>';
	}
	return $out;
}
?>