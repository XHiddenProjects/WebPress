<?php 
require_once('init.php');
require_once('config.php');
require_once('header.php');
require_once('footer.php');

global $lang, $selLang, $conf, $defaultIcon;
include_once('lang/'.$selLang.'.php');
?>
<html>
<head>
<?php
	foreach($plugins as $plugin){
		 if(!Files::checkFolder(DATA_PLUGINS.$plugin.DS)){
			mkdir(DATA_PLUGINS.$plugin.DS, 0777, true);
		 }else{
			 #nothing
		 }
	}
	foreach($themes as $theme){
		 if(!Files::checkFolder(DATA_THEMES.$theme.DS)){
			mkdir(DATA_THEMES.$theme.DS, 0777, true);
		 }else{
			 #nothing
		 }
	}
$BASEPATH=!preg_match('/\/dashboard(?:\.php\/)/',$_SERVER['REQUEST_URI']) ? '.' : '..';
if(!preg_match('/\/dashboard(?:\.php\/)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/profile/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.profile'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/configs/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.config'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/docs/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.docs'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/themes/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.themes'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/plugins/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.plugins'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/console/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.console'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/editors/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.editors'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/assets/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.assets'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/mail/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.mail'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/ban/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.ban'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/view/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.view'], $BASEPATH);	
}else{
	echo head($lang['dashboard.title.notFound'], $BASEPATH);	
}

if(file_exists(DATA_USERS.'users.dat.json')){
	
}else{
		echo '<script>
				window.open("'.$BASEPATH.'/auth.php/register", "_self");
				</script>';
			return false;
}
if(isset($_SESSION['user'])){

}else{
	echo '<script>
	//redirect on unlogged in user
				window.open("'.$BASEPATH.'/auth.php/login'.(preg_match('/\/dashboard(?:\.php)\/[\w]+/', $_SERVER['REQUEST_URI']) ? '?redirect='.preg_replace('/\/[\w]+\/dashboard\.php\//','', $_SERVER['REQUEST_URI']) : '').'", "_self");
				</script>';
			return false;
}
?>
</head>
<body>
<?php
$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
$out='';
if($d[$_SESSION['user']]['type'] === 'admin'){
	$out .= '<div style="background-color: '.$conf['page']['panel']['bgcolor'].'; color:'.$conf['page']['panel']['color'].'">';
	$out.='<nav class="navbar navbar-dark bg-primary navbar-expand-lg" id="dbnavbar">
  <div class="container-fluid">
  <button style="background:transparent;outline:none;border:0;" type="button" data-bs-toggle="offcanvas" data-bs-target="#webpress-sidebar" aria-controls="webpress-sidebar">
  <i class="fas fa-bars" style="color:white;"></i>
</button>
    <a class="navbar-brand">'.$lang['dashboard'].'</a>
	'.Utils::notification(PROJECT_VERSION).'
  </div>
  <span>
  <form method="post" class="m-0">
  <button type="submit" name="webpresslogout" class="btn btn-danger">'.$lang['dashboard.logout'].'</button>
  </form>
  </span>
</nav>';
	$out.='
<div style="background:#b5b5b5;" class="offcanvas offcanvas-start"  tabindex="-1" id="webpress-sidebar" aria-labelledby="webpressdashnav">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="webpressdashnav">'.$lang['dashboard.side'].'</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>';
	$out .= '<div class="fs-5 p-3 db-welcome">';
	$hrs = date('G');
	$t = preg_replace("/\r|\n/", "", $hrs);
	if((int)$hrs>=0&&(int)$hrs<=11){
		$out .= $lang['dashboard.side.welcome.morn'];
	}elseif((int)$hrs >= 12 && (int)$hrs <= 16){
		$out .= $lang['dashboard.side.welcome.after'];
	}elseif((int)$hrs >= 17 && (int)$hrs <= 20){
		$out .= $lang['dashboard.side.welcome.even'];
	}elseif((int)$hrs >= 21 && (int)$hrs <= 23){
		$out .= $lang['dashboard.side.welcome.night'];
	}
	$getWeather = file_get_contents('https://content.api.nytimes.com/svc/weather/v2/current.json');
	$weather = json_decode($getWeather, true);
	$out .= '<br/>'.$lang['dashboard.side.weather'].' <img src="'.$weather['results'][0]['image'].'" alt="'.$weather['results'][0]['phrase'].'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$weather['results'][0]['phrase'].'"/>';
	$out .= '<br/>'.(Utils::checkVersion()[0] ? '<div class="alert alert-success" role="alert"><i class="fas fa-check"></i> Current '.Utils::checkVersion()[1].'</div>' : '<div class="alert alert-danger" role="alert"><i class="fas fa-upload"></i> Outdated '.Utils::checkVersion()[1].'</div>');
	$out.='</div>';
      $out.= '  <ul class="list-group list-group-flush">
        <a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/">'.$lang['dashboard.side.home'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard">'.$lang['dashboard.side.back'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/profile">'.$lang['dashboard.side.profile'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/configs">'.$lang['dashboard.side.config'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/docs">'.$lang['dashboard.side.docs'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/themes">'.$lang['dashboard.side.themes'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/plugins">'.$lang['dashboard.side.plugins'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/console#log-1">'.$lang['dashboard.side.console'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/editors">'.$lang['dashboard.side.editors'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/assets">'.$lang['dashboard.side.assets'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/mail">'.$lang['dashboard.side.mail'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/ban">'.$lang['dashboard.side.ban'].'</a>
		';
		$out.= Plugin::hook('dblist');
		$out.='
      </ul>
    </div>
  </div>
</div>';
if(!preg_match('/\/dashboard(?:\.php\/)/', $_SERVER['REQUEST_URI'])){
	$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
$out.='<h1 class="text-center">'.$lang['dashboard'].'</h1>';
$out.='<center><div class="text-light bg-secondary p-2 w-50">'.$lang['dashboard.desc'].'</div></center>';
$out.='<div style="height:80%;overflow:auto;">';
$out.='<canvas id="webpress-users" class="dashboard-status"></canvas>';
$out.='<br/>';
$out.='<canvas id="webpress-views" class="dashboard-status"></canvas>';
$out.='<br/>';
$out .= '<div>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Query</th>
	  <th scope="col">Value</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>PHP Version</th>
	  <th>(7.4)>='.phpversion().'</th>
    </tr>
	 <tr>
      <th>Project Name</th>
	  <th>'.PROJECT_NAME.'</th>
    </tr>
	 <tr>
      <th>Project Version</th>
	  <th>'.Utils::checkVersion()[1].'</th>
    </tr>
	 <tr>
      <th>Project Build</th>
	  <th>'.PROJECT_BUILD.'</th>
    </tr>
	<tr>
      <th>Server Software</th>
	  <th>'.(!empty($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '').'</th>
    </tr>
	<tr>
      <th>PHP Modules</th>
	  <th>'.implode(', ', get_loaded_extensions()).'</th>
    </tr>
	<tr>
      <th>Memory</th>
	  <th>'.Files::sizeFormat(memory_get_usage()).' ('.Files::sizeFormat(memory_get_usage()).') out of '.Files::sizeFormat(memory_get_peak_usage(true)).'</th>
    </tr>
	<tr>
      <th><em>DATA</em> storage</th>
	  <th>'.Files::sizeFormat(Files::folderSize(DATA)).'</th>
    </tr>
	
  </tbody>
</table>
</div>';
$out.='</div>';


}elseif(preg_match('/\/dashboard(?:\.php)\/profile/', $_SERVER['REQUEST_URI'])){
	$out.='<div class="card text-center h-100 w-50 position-realative m-3 start-50 translate-middle-x">
  <div class="card-header">
    '.$lang['dashboard.profile.title'].'
  </div>
  <div class="card-body">
    <h5 class="card-title">'.(isset($_SESSION['user'])?$_SESSION['user']:'').'</h5>
	<div class="container">
	<div class="row">
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.timezone'].$d[$_SESSION['user']]['timezone'].'</p>
	</div>
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.ip'].$d[$_SESSION['user']]['ip'].'</p>
	</div>
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.location'].Users::ipInfo($d[$_SESSION['user']]['ip'], 'location', 'Private IP').'</p>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.created'].$d[$_SESSION['user']]['created'].'</p>
	</div>
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.email'].$d[$_SESSION['user']]['email'].'</p>
	</div>
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.name'].$d[$_SESSION['user']]['name'].'</p>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="'.$lang['btn.download'].'" href="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$_SESSION['user'].'.png') ? $BASEPATH.DATA_AVATARS.$_SESSION['user'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'" download="WebPress-'.$_SESSION['user'].'-avatar">
	<img class="img-fluid rounded avatar" style="width:125px!important;height:125px!important;" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$_SESSION['user'].'.png') ? $BASEPATH.DATA_AVATARS.$_SESSION['user'].'.png?v='.trim(time()) : $BASEPATH.DATA_AVATARS.'default.png').'"/>
	</a>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<p class="card-text overflow-auto h-100">'.$lang['dashboard.profile.about'].$d[$_SESSION['user']]['about'].'</p>
	</div>
	<div class="col">
		<label class="form-label" for="user-api"><b>'.$lang['dashboard.userKey'].'</b></label>
	<div class="input-group">
	  <input type="text" id="user-api" class="form-control" readonly="" value="'.$token.'"/>
	<button onclick="copyPublicKey()" class="btn btn-secondary input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['dashboard.userKey.copy'].'"><i class="fas fa-copy"></i></button>
	</div>
	</div>
	<div class="col">
		<label class="form-label" for="user-private-api"><b>'.$lang['dashboard.userPKey'].'</b></label>
	<div class="input-group">
	  <input type="text" id="user-private-api" class="form-control" readonly="" value="'.(!file_exists(ROOT.'api'.DS.'KEYS') ? CSRF::generate() : hash('gost', hash('sha512',CSRF::hide()))).'"/>
	<button onclick="copyPrivateKey()" class="btn btn-secondary input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['dashboard.userPKey.copy'].'"><i class="fas fa-copy"></i></button>
	</div>
	</div>

	</div>
	
		<div class="row" '.(Users::isAdmin() ? '' : 'hidden="hidden"').'>
	<div class="col">
	<label class="form-label" for="user-hardwareid"><b>'.$lang['dashboard.profile.hardwareID'].'</b></label>
		<div class="input-group"> 
		 <input type="text" id="user-hardwareid" class="form-control" readonly="" value="'.Users::hardwareID().'"/>
	<button onclick="copyHardwareID()" class="btn btn-secondary input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['dashboard.hardwareid.copy'].'"><i class="fas fa-copy"></i></button>
	</div>
	</div>
	</div>
	'.Plugin::hook('profile').'
	</div>
    
    
  </div>
  <div class="card-footer text-muted" style="overflow:auto;">
   <button type="button" data-bs-toggle="modal"  data-bs-target="#apedit" class="btn btn-primary">'.$lang['dashboard.profile.editbtn'].'</button>
  '.(file_exists(DATA_UPLOADS.'avatars'.DS.$_SESSION['user'].'.png') ? '<form method="post" class="m-0 p-0"><button type="submit" name="removedAvatar" class="btn btn-danger">'.$lang['modal.profile.removeAvatar'].'</button></form>' : '').'
  </div>
</div>';
$out.= Users::editProfile();
Utils::isPost('profileEdit', false, function(){
	global $lang, $BASEPATH;
		$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	$username = $_POST['webuser'];
	$name = $_POST['webname'];
	$psw = $_POST['webpsw'];
	$newpsw = $_POST['webnpsw'];
	$about = $_POST['webabout'];
	# change username
	if($username!==""||$username===$_SESSION['user']&&!isset($d[$username])){
		  Files::upload('profileicon', DATA_UPLOADS.'avatars'.DS, (isset($_SESSION['user']) ? $_SESSION['user'].'.png' : null));
		Utils::profileSave('users','users', ['username'=>$username, 'about'=>$about, 'name'=>$name, 'password'=>$psw.'+'.$newpsw]);
		echo Utils::redirect('modal.pedit.title', 'modal.pedit.desc', $BASEPATH.'/dashboard.php/profile', 'success');
		return false;
	}else{
		echo '<div class="alert alert-danger" role="alert">'.$lang['modal.profile.err.user'].'</div>';
		return false;
	}
});
Utils::isPost('removedAvatar', false, function(){
	global $lang, $BASEPATH;
	echo Files::remove((isset($_SESSION['user']) ? $_SESSION['user'].'.png' : null), DATA_UPLOADS.'avatars'.DS) ? Utils::redirect('modal.pedit.title', 'modal.pedit.desc', $BASEPATH.'/dashboard.php/profile', 'success') : '';
});
}elseif(preg_match('/\/dashboard(?:\.php)\/configs/', $_SERVER['REQUEST_URI'])){
	$out .= '<h1 class="text-center">'.$lang['dashboard.config.title'].'</h1>';
	$out .= '<div class="container"><form method="post">';
	$out.='<div class="row">
	<h4>'.$lang['dashboard.config.page.title'].'</h4>
	<div class="col">
	<input type="text" class="form-control" name="pagetitle" value="'.$conf['page']['page-title'].'"/>
	</div>
	</div>';
	$out.='<div class="row">
	<h4>'.$lang['dashboard.config.pageError.title'].'</h4>

	<div class="col">
	<lable for="err400">400('.$lang['dashboard.config.400'].')</label>
	<textarea class="form-control" style="height: 156px;" id="err400" name="err400">'.$conf['page']['errors']['400'].'</textarea>
	</div>
	<div class="col">
	<lable for="err401">401('.$lang['dashboard.config.401'].')</label>
	<textarea class="form-control" style="height: 156px;" id="err401" name="err401">'.$conf['page']['errors']['401'].'</textarea>
	</div>
	<div class="col">
	<lable for="err403">403('.$lang['dashboard.config.403'].')</label>
	<textarea class="form-control" style="height: 156px;" id="err403" name="err403">'.$conf['page']['errors']['403'].'</textarea>
	</div>
	<div class="col">
	<lable for="err404">404('.$lang['dashboard.config.404'].')</label>
	<textarea class="form-control" style="height: 156px;" id="err404" name="err404">'.$conf['page']['errors']['404'].'</textarea>
	</div>
	<div class="col">
	<lable for="err500">500('.$lang['dashboard.config.500'].')</label>
	<textarea class="form-control" style="height: 156px;" id="err500" name="err500">'.$conf['page']['errors']['500'].'</textarea>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
		<h4>'.$lang['dashboard.config.lang.title'].'</h4>
	<select name="conflang" class="form-control">
	';
	foreach(langpack() as $s=>$l){
		$out .= '<option '.($s===$selLang ? 'selected="selected"' : '').' value="'.$s.'">'.$l.'</option>';
	}
	
	$out.='</select>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.debug.title'].'</h4>
	<select name="confdebug" class="form-control" disabled="disabled">
	<option value="true" '.($conf['debug'] ? 'selected="selected"' : '').'>'.$lang['config.true'].'</option>
	<option value="false" '.(!$conf['debug'] ? 'selected="selected"' : '').'>'.$lang['config.false'].'</option>
	</select>
	</div>
	<div class="col">
	<div class="input-group p-0">
		<h4>'.$lang['dashboard.config.panel.bgcolor'].'</h4>
    <input type="color" value="'.$conf['page']['panel']['bgcolor'].'" class="form-control b-0 p-0 m-0 form-control-lg w-100 form-control-color" name="panelbgcolor"/>
</div>
	</div>
	<div class="col">
		<div class="input-group p-0">
		<h4>'.$lang['dashboard.config.panel.color'].'</h4>
    <input type="color" value="'.$conf['page']['panel']['color'].'" class="form-control b-0 p-0 m-0 form-control-lg w-100 form-control-color" name="panelcolor"/>
</div>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.captch'].'</h4>
		<select name="captchaActive" class="form-control" disabled="disabled">
	<option value="true" '.($conf['page']['captcha']['active'] ? 'selected="selected"' : '').'>'.$lang['config.true'].'</option>
	<option value="false" '.(!$conf['page']['captcha']['active'] ? 'selected="selected"' : '').'>'.$lang['config.false'].'</option>
	</select>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.panel.logger'].'</h4>
	<input class="form-control" min="-1" name="displayLogger" type="number" value="'.$conf['page']['panel']['console'].'"/>
	</div>
	<!--<div class="col">
	<h4>'.$lang['dashboard.config.panel.catche'].'</h4>
	<select name="clearCatche" class="form-control" name="clearCatche">
	<option value="">--Select--</option>
	<option value="plugins">Plugins</option>
	<option value="themes">Themes</option>
	</select>
	</div>-->
	<div class="col">
	<h4>'.$lang['dashboard.config.panel.email'].' | '.Users::helpPrompt('dashboard.config.panel.emailHelp').'</h4>
	<div class="input-group">
	<span class="input-group-text">@</span>
	<input type="text" readonly="" name="customemaildomain" class="form-control" value="'.str_replace('@','',$conf['allowedEmail']).'"/>
	</div>
	</div>
	
	</div>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.panel.editor'].'</h4>
	<select class="form-control" name="editor">
	<option'.($conf['editor']==='wysiwyg' ? ' selected="selected"' : '').' value="wysiwyg">WYSIWYG</option>
	<option'.($conf['editor']==='markdown' ? ' selected="selected"' : '').' value="markdown">Markdown</option>
	<option'.($conf['editor']==='bbcode' ? ' selected="selected"' : '').' value="bbcode">BBCode</option>
	</select>
	</div>
	</div>';
	$out.='<hr class="border border-5 border-primary"/>';
	$out.='<h1 class="text-center">'.$lang['dashboard.config.seo.title'].' </h1>';
	$out.='<h5><a href="'.$BASEPATH.'/sitemap.xml">'.$lang['sitemap.title'].'</a></h5>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.description'].'</h4>
	<textarea class="form-control" style="height: 116px;" name="pageDesc">'.$conf['page']['description'][Users::getLang()].'</textarea>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.author'].'</h4>
	<input type="text" class="form-control" name="pageAuthor" value="'.$conf['page']['author'].'"/>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
		<h4>'.$lang['dashboard.config.refresh'].'<span class="text-secondary"> | </span>'.Users::helpPrompt('dashboard.config.refresh.help').'</h4>
		<input type="number" class="form-control" min="0" name="pageRefresh" value="'.$conf['page']['refresh'].'"/>
	</div>
	<div class="col">
		<h4>'.$lang['dashboard.config.keywords'].'<span class="text-secondary"> | </span>'.Users::helpPrompt('dashboard.config.keywords.help').'</h4>
		<input type="text" class="form-control" name="pageKeywords" value="'.$conf['page']['keywords'].'"/>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.robotIndex.title'].'</h4>
	<select name="robotIndex" class="form-control">
	<option value="true" '.($conf['page']['robots']['index'] ? 'selected="selected"' : '').'>'.$lang['config.true'].'</option>
	<option value="false" '.(!$conf['page']['robots']['index'] ? 'selected="selected"' : '').'>'.$lang['config.false'].'</option>
	</select>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.robotFollow.title'].'</h4>
	<select name="robotFollow" class="form-control">
	<option value="true" '.($conf['page']['robots']['follow'] ? 'selected="selected"' : '').'>'.$lang['config.true'].'</option>
	<option value="false" '.(!$conf['page']['robots']['follow'] ? 'selected="selected"' : '').'>'.$lang['config.false'].'</option>
	</select>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.rate.title'].'</h4>
	<select name="pageRating" class="form-control">';
	foreach($lang['dashboard.config.rate'] as $key => $val){
		$out.= '<option '.($key===str_replace(' ','_',$conf['page']['rating']) ? 'selected="selected"' : '').' value="'.$key.'">'.$val.'</option>';
	}
	$out.='</select>
	</div>
	<div class="col">
		<h4>'.$lang['dashboard.config.copyright'].'</h4>
		<input type="text" class="form-control" name="pageCopyright" value="'.$conf['page']['copyright'].'"/>
	</div>
	</div>';
	$out .= '<div class="row">
	<div class="col">
		<h4>'.$lang['dashboard.config.distribution.title'].'</h4>
	<select name="pageDistribution" class="form-control">';
	foreach($lang['dashboard.config.distribution'] as $key => $val){
		$out.= '<option '.($key===str_replace(' ','_',$conf['page']['distribution']) ? 'selected="selected"' : '').' value="'.$key.'">'.$val.'</option>';
	}
	$out.='</select>
	</div>
	<div class="col">
		<h4>'.$lang['dashboard.config.revisted.title'].'</h4>
	<select name="pageRevisted" class="form-control">';
	foreach($lang['dashboard.config.revisted'] as $key => $val){
		$out.= '<option '.($key===str_replace(' ','_',$conf['page']['revisted']) ? 'selected="selected"' : '').' value="'.$key.'">'.$val.'</option>';
	}
	$out.='</select>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.charset.title'].'</h4>
	<select name="pageCharset" class="form-control">';
	foreach($lang['dashboard.config.charset'] as $key => $val){
		$out.= '<option '.($key===$conf['page']['charset'] ? 'selected="selected"' : '').' value="'.$key.'">'.$val.'</option>';
	}
	$out.='</select>
	</div>
	</div>';
	$out.='<br/>
	<div class="row">
	<div class="col">
	<button type="submit" name="configsave" class="btn btn-success w-100">'.$lang['config.save'].'</button>
	</div></div>';
	$out .='</form></div>';
	Utils::isPost('configsave', false, function(){
		$d = WebDB::DBexists('CONFIG', 'config') ? WebDB::getDB('CONFIG', 'config') : '';
		global $conf, $BASEPATH;
		$title = isset($_POST['pagetitle'])&& $_POST['pagetitle']!=='' ? $_POST['pagetitle'] : $conf['page']['page-title'];
		$language = isset($_POST['conflang']) ? $_POST['conflang'] : 'en-US';
		$e400 = isset($_POST['err400'])&&$_POST['err400']!=='' ? $_POST['err400'] : $conf['page']['errors']['400'];
		$e401 = isset($_POST['err401'])&&$_POST['err401']!=='' ? $_POST['err401'] : $conf['page']['errors']['401'];
		$e403 = isset($_POST['err403'])&&$_POST['err403']!=='' ? $_POST['err403'] : $conf['page']['errors']['403'];
		$e404 = isset($_POST['err404'])&&$_POST['err404']!=='' ? $_POST['err404'] : $conf['page']['errors']['404'];
		$e500 = isset($_POST['err500'])&&$_POST['err500']!=='' ? $_POST['err500'] : $conf['page']['errors']['500'];
		$debug = isset($_POST['confdebug']) ? $_POST['confdebug'] : 'true';
		$webDesc = isset($_POST['pageDesc'])&&$_POST['pageDesc']!=='' ? $_POST['pageDesc'] : $conf['page']['description'][Users::getLang()];
		$author = isset($_POST['pageAuthor'])&&$_POST['pageAuthor']!=='' ? $_POST['pageAuthor'] : $conf['page']['author'];
		$refresh = isset($_POST['pageRefresh'])&&$_POST['pageRefresh']!=='' ? intval($_POST['pageRefresh']) : $conf['page']['refresh'];
		$keywords = isset($_POST['pageKeywords'])&&$_POST['pageKeywords']!=='' ? $_POST['pageKeywords'] : $conf['page']['keywords'];
		$botIndex = isset($_POST['robotIndex']) ? $_POST['robotIndex'] : 'false';
		$botFollow = isset($_POST['robotFollow']) ? $_POST['robotFollow'] : 'false';
		$rating = isset($_POST['pageRating'])&&$_POST['pageRating']!=='' ? $_POST['pageRating'] : $conf['page']['rating'];
		$copyright = isset($_POST['pageCopyright'])&&$_POST['pageCopyright']!=='' ? '&copy;'.str_replace('©','',$_POST['pageCopyright']) : '';
		$distribution = isset($_POST['pageDistribution']) ? $_POST['pageDistribution'] : $conf['page']['distribution'];
		$revisted = isset($_POST['pageRevisted']) ? str_replace('_',' ',$_POST['pageRevisted']) : $conf['page']['pageRevisted'];
		$charset = isset($_POST['pageCharset']) ? $_POST['pageCharset'] : $conf['page']['charset'];
		$bg = isset($_POST['panelbgcolor']) ? $_POST['panelbgcolor'] : $conf['page']['panel']['bgcolor'];
		$color = isset($_POST['panelcolor']) ? $_POST['panelcolor'] : $conf['page']['panel']['color'];
		$captcha = isset($_POST['captchaActive']) ? $_POST['captchaActive'] : 'true';
		$displayConsole = isset($_POST['displayLogger'])&&$_POST['displayLogger']!=='' ? (int)$_POST['displayLogger'] : $conf['page']['panel']['console'];
		#$catche = isset($_POST['clearCatche'])&&$_POST['clearCatche']!=='' ? $_POST['clearCatche'] : '';
		$emaildomain = isset($_POST['customemaildomain'])&&$_POST['customemaildomain']!==''&&Users::isProVersion() ? '@'.$_POST['customemaildomain'] : $conf['allowedEmail'];
		$editor = isset($_POST['editor'])&&$_POST['editor']!=='' ? $_POST['editor'] : $conf['editor'];
		
		$d['page']['errors']['400'] = $e400;
		$d['page']['errors']['401'] = $e401;
		$d['page']['errors']['403'] = $e403;
		$d['page']['errors']['404'] = $e404;
		$d['page']['errors']['500'] = $e500;
		$d['page']['page-title'] = $title;
		$d['lang'] = $language;
		$d['debug'] = filter_var($debug, FILTER_VALIDATE_BOOLEAN);
		$d['page']['description'][Users::getLang()] = $webDesc;
		$d['page']['author'] = $author;
		$d['page']['refresh'] = $refresh;
		$d['page']['keywords'] = $keywords;
		$d['page']['robots']['index'] = filter_var($botIndex, FILTER_VALIDATE_BOOLEAN);
		$d['page']['robots']['follow'] = filter_var($botFollow, FILTER_VALIDATE_BOOLEAN);
		$d['page']['rating'] = str_replace('_',' ',$rating);
		$d['page']['copyright'] = $copyright;
		$d['page']['distribution'] = $distribution;
		$d['page']['revisted'] = $revisted;
		$d['page']['charset'] = $charset;
		$d['page']['panel']['bgcolor'] = strtoupper($bg);
		$d['page']['panel']['color'] = strtoupper($color);
		$d['page']['captcha']['active'] = filter_var($captcha, FILTER_VALIDATE_BOOLEAN);
		$d['page']['panel']['console'] = $displayConsole;
		$d['allowedEmail'] = $emaildomain;
		$d['editor'] = $editor;
		
		WebDB::saveDB('CONFIG', 'config', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/configs', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/config', 'danger');
	});
}elseif(preg_match('/\/dashboard(?:\.php)\/docs/', $_SERVER['REQUEST_URI'])){
	$out.='<div class="position-relative" style="background-color:#c1c1c14a;height:77.3%;overflow:auto;">';
	$getDoc = file_get_contents(ROOT.'docs'.DS.'doc_'.explode('-',$conf['lang'])[0].'.md');
	$bb = $parseBB->toHTML($getDoc);
	$out.=$parseMD->text($bb);
	
	$out.='</div>';
}elseif(preg_match('/\/dashboard(?:\.php)\/themes/', $_SERVER['REQUEST_URI'])){
	$out.='<ul class="list-group list-group-flush list-group-horizontal">';
foreach(Files::Scan(DATA_THEMES) as $themes){
	if(!file_exists(ROOT.'themes'.DS.$themes.DS.'theme.conf.json')){
		echo '<div class="alert alert-danger" role="alert">'.$lang['theme.missing'].'</div>';
	}else{
		Files::copyFile(ROOT.'themes'.DS.$themes.DS.'theme.conf.json',DATA_THEMES.$themes.DS.'theme.conf.json');
	}
	
	if(file_exists(DATA_THEMES.$themes.DS.'theme.conf.json')){
		$lgs = '';
		$themeConfig = WebDB::getDB('THEMES', $themes.DS.'theme', '.conf.json');
		if(isset($themeConfig['options']['usedLang'])){
		for($i=0;$i<count($themeConfig['options']['usedLang']);$i++){
			if($i<count($themeConfig['options']['usedLang'])-1){
				$lgs.= $lang['lang'][$themeConfig['options']['usedLang'][$i]].', ';
			}else{
				$lgs.=$lang['lang'][$themeConfig['options']['usedLang'][$i]];
			}
		}
		}
		$out.='<li class="list-group-item"><div class="card h-100 text-bg-secondary theme '.($themeConfig['active']!=='' ? 'theme-active' : '').'" style="width:18rem;">
<div class="card-header text-center h3">
'.(isset($themeConfig['name'][Users::getLang()]) ? $themeConfig['name'][Users::getLang()] : '<div class="alert alert-danger">'.$lang['theme.error.missingName'].'</div>').'
</div>
<div class="card-body text-bg-primary overflow-auto">
'.(isset($themeConfig['desc'][Users::getLang()]) ? $themeConfig['desc'][Users::getLang()] : '<div class="alert alert-danger">'.$lang['theme.error.missingDesc'].'</div>').'
'.(isset($themeConfig['options']['usedLang']) ? '<div class="text-bg-dark">'.$lang['theme.allow.lang'].'<span class="fw-bold fst-italic">'.$lgs.'</span></div>' : '<div class="text-bg-dark">'.$lang['theme.allow.lang'].'<span class="fw-bold fst-italic">'.$lang['theme.allow.lang.null'].'</span></div>').'
</div>
<div class="card-footer p-0">

'.($themes==='default'&&!$themeConfig['options']['canDisabled'] ? '<div data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['btn.disabled'].'">' : '').'
<button '.($themes==='default'&&!$themeConfig['options']['canDisabled'] ? 'disabled="disabled"   ' : '').' class="theme-btn '.($themeConfig['active']!=='' ? 'btn-success' : 'btn-danger').' w-100 m-0 btn theme-btn-active">'.($themeConfig['active']!=='' ? $lang['theme.active'] : $lang['theme.deactive']).'</button>
'.($themes==='default'&&!$themeConfig['options']['canDisabled'] ? '</div>' : '').'
</div>
</div></li>';
	}
}
$out.='</ul>';
}elseif(preg_match('/\/dashboard(?:\.php)\/plugins/', $_SERVER['REQUEST_URI'])){
$out.='<ul class="list-group list-group-flush list-group-horizontal">';
foreach(Files::Scan(ROOT.'plugins') as $plugins){
	if(!file_exists(DATA_PLUGINS.$plugins.DS.'plugin.dat.json'))
		echo Plugin::forceExecute('install', $plugins);
	$config = Plugin::hook('config');
	if(file_exists(DATA_PLUGINS.$plugins.DS.'plugin.dat.json')){
		$lgs = '';
		$pluginsConfig = WebDB::getDB('PLUGINS', $plugins.DS.'plugin', '.dat.json');
		if(isset($pluginsConfig['options']['usedLang'])){
		for($i=0;$i<count($pluginsConfig['options']['usedLang']);$i++){
			if($i<count($pluginsConfig['options']['usedLang'])-1){
				$lgs.= $lang['lang'][$pluginsConfig['options']['usedLang'][$i]].', ';
			}else{
				$lgs.=$lang['lang'][$pluginsConfig['options']['usedLang'][$i]];
			}
		}
		}
		$out.='<li class="list-group-item"><div class="card h-100 text-bg-secondary plugin '.($pluginsConfig['active']!=='' ? 'plugin-active' : '').'" style="width:18rem;">
<div class="card-header text-center h3">
'.(isset($pluginsConfig['name'][Users::getLang()]) ? $pluginsConfig['name'][Users::getLang()] . ' <h6><small class="badge bg-primary">v'.$pluginsConfig['version'].'</small></h6>' : '<div class="alert alert-danger">'.$lang['plugin.error.missingName'].'</div>').'
</div>
<div class="card-body text-bg-primary overflow-auto">
'.(isset($pluginsConfig['desc'][Users::getLang()]) ? $pluginsConfig['desc'][Users::getLang()] : '<div class="alert alert-danger">'.$lang['plugin.error.missingDesc'].'</div>').'
<img class="img-fluid plugin-icon" src="'.$BASEPATH.'/plugins/'.$plugins.DS.'icon.png"/>
'.(isset($pluginsConfig['options']['usedLang']) ? '<div class="text-bg-dark">'.$lang['plugin.allow.lang'].'<span class="fw-bold fst-italic">'.$lgs.'</span></div>' : '<div class="text-bg-dark">'.$lang['plugin.allow.lang'].'<span class="fw-bold fst-italic">'.$lang['plugin.allow.lang.null'].'</span></div>').'
</div>
<div class="card-footer p-0">

'.(!$pluginsConfig['options']['canDisabled'] ? '<div data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['btn.disabled'].'">' : '').'
<a'.($pluginsConfig['options']['canDisabled'] ? ' href="../config.php?name='.$plugins.'&action='.($pluginsConfig['active']!=='' ? 'deactive' : 'active').'"' : '').'><button '.(!$pluginsConfig['options']['canDisabled'] ? 'disabled="disabled"   ' : '').' class="plugin-btn '.($pluginsConfig['active']!=='' ? 'btn-success' : 'btn-danger').' w-100 m-0 btn theme-btn-active">'.($pluginsConfig['active']!=='' ? $lang['plugin.active'] : $lang['plugin.deactive']).'</button></a>
'.(!$pluginsConfig['options']['canDisabled'] ? '</div>' : '').'
'.(isset($pluginsConfig['options']['config']['use'])&&$pluginsConfig['options']['config']['use']&&$pluginsConfig['active'] ? '<div data-bs-toggle="modal" data-bs-target="#'.$plugins.'Modal" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['config.label'].$plugins.'"><button class="btn btn-secondary w-100 m-0">'.$lang['config.label'].'<i class="fas fa-user-cog"></i></button></div>' : '').'
</div>
</div>';
$out .= '<div class="modal fade modal-xl" id="'.$plugins.'Modal" tabindex="-1" aria-labelledby="'.$plugins.'Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">'.$lang['config'].$plugins.'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe class="w-100" frameborder="0" title="'.$plugins.'" src="../config.php/plugin/'.$plugins.'"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button>
      </div>
    </div>
  </div>
</div></li>';
	}
}
$out.='</ul>';
}elseif(preg_match('/\/dashboard(?:\.php)\/console/', $_SERVER['REQUEST_URI'])){
	$data = '';
	$getLog = preg_split('/\R/', Files::getFileData(ROOT.'debug.log'));
	$id=0;
	foreach($getLog as $log){
		if($log!==''){
			$id++;
			if($id<=$conf['page']['panel']['console']||$conf['page']['panel']['console']===(int)'-1'){
			if(preg_match('/Warning/', $log)){
				
			$data.='<div log="'.$id.'" id="log-'.$id.'" class="alert alert-warning" role="alert"><a href="./console#log-'.$id.'"><i id="logCapture" class="fas fa-exclamation-triangle"></i></a> <span class="msg">'.$log.'</span><div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    '.$lang['btn.drop.actions.title'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item btn" onclick="copyURLConsole('.$id.')">'.$lang['btn.drop.copy.url'].'</a></li>
    <li><a class="dropdown-item btn" onclick="copyMsgConsole('.$id.')">'.$lang['btn.drop.copy.msg'].'</a></li>
  </ul>
</div></div>';
		}else{
			$data.='<div log="'.$id.'" id="log-'.$id.'" class="alert alert-danger" role="alert"><a href="./console#log-'.$id.'"><i id="logCapture"  class="fas fa-times"></i></a> <span class="msg">'.$log.'</span><div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    '.$lang['btn.drop.actions.title'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item btn" onclick="copyURLConsole('.$id.')">'.$lang['btn.drop.copy.url'].'</a></li>
    <li><a class="dropdown-item btn" onclick="copyMsgConsole('.$id.')">'.$lang['btn.drop.copy.msg'].'</a></li>
  </ul>
</div></div>';

			}
			
			}
		}
	}
	$out.= $conf['debug'] ? '' : '<h4 class="text-center text-bg-danger">'.$lang['debug.off'].'</h4>';
	$out .= $conf['page']['panel']['console']!==(int)'-1' ? '<h4 class="text-center text-bg-danger">'.$lang['dashboard.config.panel.logger'].'</h4>' : '<h4 class="text-center text-bg-danger">'.$lang['dashboard.config.panel.logger'].'</h4>';
	$out.='<div class="console text-bg-dark" style="height:77.3%;overflow:auto;">
	'.$data.'
	</div>';
}elseif(preg_match('/\/dashboard(?:\.php)\/editors/', $_SERVER['REQUEST_URI'])){
	$out .= $Editor->createEditor($conf['editor']);
}elseif(preg_match('/\/dashboard(?:\.php)\/assets/', $_SERVER['REQUEST_URI'])){
	$out .= '<h1 class="text-center">'.$lang['assets.title'].'</h1>';
	foreach(Files::Scan(ROOT.'assets'.DS) as $assets){
		$out .= '<div class="alert alert-primary" style="font-size:32px;">'.$assets;
		switch($assets){
			case 'bootstrap':
			$out .= '<i class="fa-brands fa-bootstrap ms-2" style="color:purple;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$assets.' v'.$conf[$assets]['version'].'"></i>';
			break;
			case 'fontawesome':
			$out .= '<i class="fa-solid fa-font-awesome ms-2" style="color:#528dd7;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$assets.' v'.$conf[$assets]['version'].'"></i>';
			break;
			case 'jquery':
			$out .= '<i class="fa-brands fa-js ms-2" style="color:yellow;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$assets.' v'.$conf[$assets]['version'].'"></i>';
			break;
			case 'notify':
			$out .= '<i class="fa-solid fa-bell ms-2" style="color:black;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$assets.' v'.$conf[$assets]['version'].'"></i>';
			break;
			case 'prism':
			$out .= '<i class="fa-solid fa-rainbow ms-2" style="background: red; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(left, orange , yellow, green, cyan, blue, violet); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(right, orange, yellow, green, cyan, blue, violet); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(right, orange, yellow, green, cyan, blue, violet); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to right, orange , yellow, green, cyan, blue, violet); /* Standard syntax (must be last) */;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$assets.' v'.$conf[$assets]['version'].'"></i>';
			break;
		}
		$out.='<small class="badge text-bg-secondary ms-3">v'.$conf[$assets]['version'].'</small></div>';
	}
	
}elseif(preg_match('/\/dashboard(?:\.php)\/mail/', $_SERVER['REQUEST_URI'])){
	$out.='<div class="bg-primary p-2 m-2">';
foreach(Files::Scan('data/mail/') as $mails){
	$mails = str_replace('.dat.json','',$mails);
	$mail = WebDB::getDB('mail', $mails);
	$emailExp = '/\s\&lt\;([\w\W]+)\&gt\;/';
	$users = WebDB::getDB('users', 'users');
	$out.='<div class="alert'.($mail['msg']['status']==='new' ? ' alert-light' : ' alert-dark').'"><i class="fas fa-envelope"></i> '.$mail['msg']['subject'].'  <span class="float-end contact-options"><a href="./mail?sub='.$mails.($mail['msg']['status']==='new' ? '' : '&unread=true').'"><i class="fas fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="'.($mail['msg']['status']==='new' ? $lang['contact.markasread'] : $lang['contact.markasunread']).'"></i></a>&nbsp;&nbsp;<i data-bs-toggle="modal" data-bs-target="#'.$mails.'_view" class="fab fa-readme" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['contact.readme'].'"></i></span></div>';
	$out.='<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="'.$mails.'_view" tabindex="-1" aria-labelledby="'.$mails.'Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="'.$mail['msg']['subject'].'Label">'.$mail['msg']['subject'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <div class="container h-100 overflow-auto">
		<div class="msgbox from">
		'.(preg_replace($emailExp,'',$mail['msg']['from']['email'])===$_SESSION['user']||Users::isAdmin() ? '<a href="./mail?removeMessage='.$mails.'"><i class="fa-solid fa-trash-can float-start" style="color:red;cursor:pointer;"></i></a>' : '').'
		<span class="usertag text-muted">'.$mail['msg']['from']['name'].' '.$mail['msg']['from']['email'].'</span><br/>'.$mail['msg']['text'].'<br/><span class="senttime text-muted">'.$mail['msg']['sentTime'].'</span></div>
        ';
		if(isset($mail['msg']['replys'])&&is_array($mail['msg']['replys'])){
			foreach($mail['msg']['replys'] as $id=>$replys){
			if(!isset($replys['to'])||$replys['to']==='all'){
				$out .= '<div class="msgbox '.($replys['from']!==$mail['msg']['from']['name'] ? 'to' : 'from').'">'.($replys['from']===$_SESSION['user']||Users::isAdmin() ? '<a href="./mail?topic='.$mails.'&removeReply='.$id.'"><i class="fa-solid fa-trash-can float-start" style="color:red;cursor:pointer;"></i></a>' : '').' <span class="usertag text-muted">'. $replys['from'].' '.$mail['msg']['to'][$replys['from']].'</span><br/><span class="usermsg">'.$replys['text'].'</span><br/><br/><span class="senttime text-muted">'.$replys['sentTime'].'</span></div>';
			}else{
				$out .= ($_SESSION['user']===$replys['to']||$_SESSION['user']===$replys['from'] ? '<div class="msgbox '.($replys['from']!==$mail['msg']['from']['name'] ? 'to' : 'from').'">'.($replys['from']===$_SESSION['user']||Users::isAdmin() ? '<a href="./mail?topic='.$mails.'&removeReply='.$id.'"><i class="fa-solid fa-trash-can float-start" style="color:red;cursor:pointer;"></i></a>' : '').'  <span class="usertag text-muted">'.$replys['from'].' '.$mail['msg']['to'][$replys['from']].'</span><br/><span class="usermsg">'.$replys['text'].'</span><br/><br/><span class="senttime text-muted">'.$replys['sentTime'].'</span></div>' : '<div class="alert alert-danger" role="alert">'.$lang['contact.hidden'].'</div>');
			}
			
		}
		}
		$out.='</div>';
		$out.='<hr/>';
		
		$out.='<form method="post">
		<small class="text-secondary">'.$lang['contact.senderAs'].(isset($_SESSION['user']) ? ' <i>'.$users[$_SESSION['user']]['email'].'</i>' : '').'</small>
		<input type="hidden" name="subject" value="'.$mails.'"/>
		<div class="row mb-2">
		<div class="col">
		<label for="sendto">'.$lang['contact.emailto'].'</label>
		<select class="form-control" id="sendto" name="sendto">
		<option value="all">'.$lang['contact.option.all'].'</option>';
		if(isset($mail['msg']['to'])){
			foreach($mail['msg']['to'] as $user => $mail){
		$out.='<option value="'.$user.'">'.$user.' '.$mail.'</option>';
			}
		}
		$out.='</select>
		</div>
		</div>
		<div class="row mb-2">
		<label for="replymsg">'.$lang['contact.msg'].'</label>
		<div class="input-group col">
		<input type="text" required="" id="replymsg" class="form-control" placeholder="'.$lang['contact.send'].'" name="replymsg"/>
		<button name="submitReply" type="submit" class="input-group-text btn btn-secondary">Reply</button>
		</div>
		</div>
		</form>';
		$out.='
      </div>
    </div>
  </div>
</div>';
$out.='<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="sendMessageUI" tabindex="-1" aria-labelledby="sendMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendMessageLabel">'.$lang['contact.title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form method="post">
	  <div class="row">
	  <div class="col">
	   <label class="form-label" for="subject">'.$lang['contact.subject'].'</label>
	  <input type="text" required="required" placeholder="'.$lang['contact.subject.placeholder'].'" class="form-control" id="subject" name="subject"/>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col">
	  <label class="form-label" for="from">'.$lang['contact.name'].'</label>
	  <input type="text" required="required" placeholder="'.$lang['contact.name.placeholder'].'" class="form-control" id="from" name="from" readonly="" value="'.$_SESSION['user'].'"/>
	 </div>
	   <div class="col">
	   <label class="form-label" for="fromemail">'.$lang['contact.email'].'</label>
	  <input type="email" required="required" placeholder="'.$lang['contact.email.placeholder'].'" class="form-control" id="fromemail" name="fromemail" readonly="" value="'.$users[$_SESSION['user']]['email'].'"/>
	  </div>
	  </div>
      <div class="row">
		<div class="col">
		 <label class="form-label" for="toemail">'.$lang['contact.emailto'].'</label>
	  <input type="text" required="required" placeholder="'.$lang['contact.emailto.placeholder'].'" class="form-control" id="toemail" name="toemail"/>
	  <small class="text-muted form-text">'.$lang['contact.to.example'].'</small>
		</div>
	  </div>
		<div class="row">
		<div class="col">
		<label class="form-label" for="sendmsg">'.$lang['contact.msg'].'</label>
		<textarea class="form-control" required="required" name="sendmsg" id="sendmsg" placeholder="'.$lang['contact.msg.placeholder'].'"></textarea>
		</div>
		</div>
		<div class="row mt-2">
		<div class="col">
		<button type="submit" name="sender" class="btn btn-primary">'.$lang['contact.send'].'</button>
		</div>
		</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
$out.='<div data-bs-toggle="modal" data-bs-target="#sendMessageUI" class="position-absolute p-3 text-bg-secondary" style="background-color:RGBA(108,117,125,0.7)!important;font-size:40px;border-radius:50%;bottom:5%;right:1%;cursor:crosshair;"><i class="fa-solid fa-envelope"></i></div>';
}


$out.='</div>';
if(isset($_POST['sender'])){
	$subject = $_POST['subject'];
	$fileSub = @str_replace(' ', '_', $_POST['subject']);
	$fromName = $_POST['from'];
	$fromEmail = '&lt;'.$_POST['fromemail'].'&gt;';
	$to = str_replace(' ','',$_POST['toemail']);
	$toArgs = array();
	$msg = $_POST['sendmsg'];
	
	$toArgs[$fromName] = $fromEmail;
	if(@explode(',',$to)){
		$to = explode(',',$to);
		foreach($to as $t){
			$set = explode(':', $t);
			$toArgs[$set[0]] = htmlentities($set[1]);
		}
	}else{
		$set = explode('>', $t);
		$toArgs[$set[0]] = $set[1];	
	}
	$exploitMsg = array('msg'=>array('subject'=>$subject, 'from'=>array('name'=>$fromName, 'email'=>$fromEmail), 'to'=>$toArgs, 'text'=>$msg, 'sentTime'=>date('m-d-Y h:i:sa'), 'status'=>'new', 'replys'=>array()));
	# create Message
	if(WebDB::DBexists('MAIL', $fileSub))
		echo '<div class="alert alert-danger" role="alert">'.$lang['contact.msg.exists'].'</div>';
	WebDB::makeDB('MAIL', $fileSub);
	echo WebDB::saveDB('MAIL', $fileSub, $exploitMsg) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
}
if(isset($_GET['sub'])){
	$d = WebDB::DBexists('MAIL', $_GET['sub']) ? WebDB::getDB('MAIL', $_GET['sub']) : '';
	if(isset($_GET['unread'])){
		$d['msg']['status'] = 'new';
	}else{
		$d['msg']['status'] = 'old';	
	}
	echo WebDB::saveDB('MAIL', $_GET['sub'], $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
	}
# submit replys 
if(isset($_POST['submitReply'])){
	$sub =  $_POST['subject'];
	$target  = $_POST['sendto'];
	$msg = $_POST['replymsg'];
	$session = Users::getSession();
	
	$d = WebDB::DBexists('MAIL', $sub) ? WebDB::getDB('MAIL', $sub) : '';
		$pushMsg = array('from'=>$session, 'sentTime'=>date('m-d-Y h:i:sa'), 'to'=>$target, 'text'=>$msg);
		array_push($d['msg']['replys'], $pushMsg);
		echo WebDB::saveDB('MAIL', $sub, $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
}
# Remove replys
if(isset($_GET['topic'])){
	$topic = $_GET['topic'];
	$id = $_GET['removeReply'];
	$d = WebDB::DBexists('MAIL', $topic) ? WebDB::getDB('MAIL', $topic) : '';
	unset($d['msg']['replys'][$id]);
	echo WebDB::saveDB('MAIL', $topic, $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
}
# remove message
if(isset($_GET['removeMessage'])){
	$file = $_GET['removeMessage'];
	if(WebDB::DBexists('MAIL', $file))
			echo WebDB::removeDB('MAIL', $file) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
}

}elseif(preg_match('/\/dashboard(?:\.php)\/ban/', $_SERVER['REQUEST_URI'])){
	$db = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	$out.='<button class="btn btn-warning fs-4 m-3" style="width: calc(100% - 35px);" data-bs-toggle="modal" data-bs-target="#banModal"><i class="fa-solid fa-circle-plus"></i> '.$lang['ban.add'].'</button>';
	$out.='<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="banModalLabel">'.$lang['ban.UI.title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">
		<div class="row">
		<div class="col">
		<label for="banUsername" class="form-label">'.$lang['ban.UI.username'].'</label>
		<select required="" class="form-control" id="banUsername" type="text" name="banUsername">';
		foreach(Users::ListUsers() as $username => $data){
			$out.='<option'.(isset($_GET['add'])&&$_GET['add']===$username ? ' selected="selected"' : '').' value='.$username.'>'.$username.'</option>';
		}
		$out.='</select>
		</div>
		<div class="col">
			<label for="banTime" class="form-label">'.$lang['ban.UI.time'].'</label>
		<select name="banTime" class="form-control" id="banTime">';
		foreach($lang['ban.list'] as $id => $val){
			$out.='<option '.(isset($_GET['time'])&&$_GET['time']===$id ? 'selected="selected"' : '').' value="'.$id.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
		</div>
		<div class="row">
		<div class="col">
		<label for="banReason" class="form-label">'.$lang['ban.UI.reason'].'</label>
		<input type="text" '.(isset($_GET['reason'])&&$_GET['reason']!=='' ? ' value="'.$_GET['reason'].'"' : '').' class="form-control" required="" name="banReason" id="banReason"/>
		</div>
		<div class="col">
		<label for="banBy" class="form-label">'.$lang['ban.UI.banBy'].'</label>
		<select id="banBy" name="banBy" class="form-control">';
		foreach($lang['ban.byList'] as $type=>$label){
			$out.='<option '.(isset($_GET['type'])&&$_GET['type']===$type ? 'selected="selected"' : '').' value="'.$type.'">'.$label.'</option>';
		}
		$out.='</select>
		</div>
		</div>
		<div class="row mt-2">
		<div class="col">
		<button type="submit" name="addBanUser" class="btn btn-danger"><i class="fa-solid fa-ban"></i> '.$lang['ban.UI.submit'].'</button>
		</div>
		</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button>
      </div>
    </div>
  </div>
</div>';
	
	$args = array();
	foreach($db as $user){
		Users::isBanned($user['username']) ? array_push($args, $user['username']) : '';
	}
	if(empty($args)){
			$out.= '<p>'.$lang['ban.empty'].'</p>';
	}else{
		$out.= '<table class="table">
  <thead>
    <tr>
      <th>'.$lang['ban.table']['username'].'</th>
      <th>'.$lang['ban.table']['reason'].'</th>
      <th>'.$lang['ban.table']['time'].'</th>
	   <th>'.$lang['ban.table']['duration'].'</th>
      <th>'.$lang['ban.table']['bannedBy'].'</th>
	  <th>'.$lang['ban.table']['actions'].'</th>
    </tr>
  </thead>
  <tbody>
 ';
 foreach($args as $user){
	 $out.='<tr>
	 <td>'.$user.'</td>
	 <td>'.$db[$user]['ban']['reason'].'</td>
	  <td>'.($db[$user]['ban']['time']==(int)'-1' ? $lang['ban.forever'] : date_format(date_create($db[$user]['ban']['time']), 'm/d/Y H:i:s')).'</td>
	 <td>'.$db[$user]['ban']['duration'].'</td>
	 <td>'.$db[$user]['ban']['bannedBy'].'</td>
	  <td>
	<a href="./ban?remove='.$user.'"><button type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> '.$lang['ban.remove'].'</button></a>
	  </td>
	 </tr>';
 }
 $out.='
  </tbody>
</table>';
		}
		
	if(isset($_GET['remove'])){
		$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		$d[$_GET['remove']]['ban']['isBanned'] = filter_var(false, FILTER_VALIDATE_BOOLEAN);
		$d[$_GET['remove']]['ban']['reason'] = '';
		$d[$_GET['remove']]['ban']['time'] = '';
		$d[$_GET['remove']]['ban']['bannedBy'] = '';
		$d[$_GET['remove']]['ban']['duration'] = '';
		echo WebDB::saveDB('users', 'users', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/ban', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/ban', 'danger');
	}
	if(isset($_POST['addBanUser'])){
		$username = $_POST['banUsername'];
		$time = $_POST['banTime'];
		$reason = $_POST['banReason'];
		$by = $_POST['banBy'];
		if(preg_match('/\dmin/', $time)){
			$time = @str_replace('min', ' minutes', $time);
		}elseif(preg_match('/\dh/', $time)){
			$time = @str_replace('h', ' hours', $time);
		}elseif(preg_match('/\dd/', $time)){
			$time = @str_replace('d', ' days', $time);
		}elseif(preg_match('/\dw/', $time)){
			$time = @str_replace('w', ' Week', $time);
		}elseif(preg_match('/\dm/', $time)){
			$time = @str_replace('m', ' months', $time);
		}elseif(preg_match('/\dy/', $time)){
			$time = @str_replace('y', ' years', $time);
		}

		$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		if(isset($d[$username])){
			$d[$username]['ban']['isBanned'] = filter_var(true, FILTER_VALIDATE_BOOLEAN);
		$d[$username]['ban']['reason'] = $reason;
		$d[$username]['ban']['time'] = ($time==='forever' ? (int)'-1' : date('m/d/Y H:i:s', strtotime('+'.$time)));
		$d[$username]['ban']['bannedBy'] = $by;
		$d[$username]['ban']['duration'] = '+'.$time;
		echo WebDB::saveDB('users', 'users', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/ban', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/ban', 'danger');
		}else{
			echo Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/ban', 'danger');
		}
		
	}
}elseif(preg_match('/\/dashboard(?:\.php)\/view/', $_SERVER['REQUEST_URI'])){
	$out .= Plugin::useHook('view', $_GET['plugin']);
}else{
	$out.='<h1 class="text-center alert alert-danger">'.$lang['dashboard.pageError'].'</h1>';
}

$out.='</div>';

echo $out;
}

?>
<?php
# actions
if(isset($_POST['webpresslogout'])){
	echo Utils::redirect('auth.logout', 'dashboard.redirect.logout.desc', $BASEPATH.'/auth.php/login', 'danger');
	session_unset();
}
?>
<?php 
echo foot($BASEPATH);
if(!preg_match('/\/dashboard(?:\.php\/)/', $_SERVER['REQUEST_URI'])){
	$db = WebDB::getDB('users', 'users');
$mon = Utils::dateTimeData();
foreach($db as $users){
	preg_match('/\d{4}/', explode('+',$users['created'])[0], $year);
	if($year[0]===date('Y')){
		preg_match('/^\d+(?=\-)/',explode('+',$users['created'])[0], $out);
			if(array_key_exists($out[0], Utils::dateTime('months'))){
				$mon[Utils::dateTime('months')[$out[0]]] = intval($mon[Utils::dateTime('months')[$out[0]]]) + 1 .',';
			}
	}	
}
$views = WebDB::getDB('users', 'views');
$vmon = Utils::dateTimeData();
$vumon = Utils::dateTimeData();
foreach($views as $v=>$vwmon){
	if(date($v)===date('Y')){
		foreach($vwmon as $m=>$vws){
			$vmon[Utils::dateTime('months')[$m]] = $vws['views'] . ',';
			$vumon[Utils::dateTime('months')[$m]] = count($vws['unique']) . ',';
		}
	}
}

# dashboard graph
$out='<script>
var xVal = ["Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov", "Dec"];
var yVal = ['.preg_replace('/\,$/','',$mon['jan'].$mon['feb'].$mon['mar'].$mon['apr'].$mon['may'].$mon['june'].$mon['july'].$mon['aug'].$mon['sept'].$mon['oct'].$mon['nov'].$mon['dec']).'];
new Chart("webpress-users", {
  type: "line",
  data: {
    labels: xVal,
    datasets: [{
		label: "'.$lang['dashboard.graph.user.label'].'",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yVal
    }]
  },
  options: {
     plugins: {
		 title:{
			 display:true,
			 fullSize: true,
			 text: "'.$lang['dashboard.graph.user.label'].'"
		 },
		 subtitle:{
			 display: true,
			 text:"'.$lang['dashboard.graph.user.subtitle'].date('Y', strtotime('+1 years')).'"
		 },
           legend: {
				title:{
				  display: false,
				}
			}
	 },
    scales: {
      y:{
		  stacked: true,
		   title:{
			   display:true,
			  text: "'.$lang['dashboard.graph.user.y'].'"
		  } 
	  },
	  x:{
		  title:{
			   display:true,
			  text: "'.date('Y').'-'.date('Y', strtotime('+1 years')).'"
		  } 
	  }
    }
  }
});
</script>';
$out.='<script>
var xVWal = ["Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov", "Dec"];
var yVWal = ['.preg_replace('/\,$/','',$vmon['jan'].$vmon['feb'].$vmon['mar'].$vmon['apr'].$vmon['may'].$vmon['june'].$vmon['july'].$vmon['aug'].$vmon['sept'].$vmon['oct'].$vmon['nov'].$vmon['dec']).'];
var uniqUser = ['.preg_replace('/\,$/','',$vumon['jan'].$vumon['feb'].$vumon['mar'].$vumon['apr'].$vumon['may'].$vumon['june'].$vumon['july'].$vumon['aug'].$vumon['sept'].$vumon['oct'].$vumon['nov'].$vumon['dec']).']
new Chart("webpress-views", {
  type: "line",
  data: {
    labels: xVWal,
    datasets: [{
			label: "'.$lang['dashboard.graph.views.unique'].'",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "rgba(0,255,0,1.0)",
      borderColor: "rgba(0,255,0,0.1)",
		data:uniqUser
	},{
		label: "'.$lang['dashboard.graph.views.label'].'",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "rgba(255,0,0,1.0)",
      borderColor: "rgba(255,0,0,0.1)",
      data: yVWal
    }]
  },
  options: {
     plugins: {
		 title:{
			 display:true,
			 fullSize: true,
			 text: "'.$lang['dashboard.graph.views.label'].'"
		 },
		 subtitle:{
			 display: true,
			 text:"'.$lang['dashboard.graph.views.subtitle'].date('Y', strtotime('+1 years')).'"
		 },
           legend: {
				title:{
				  display: false,
				}
			}
	 },
    scales: {
      y:{
		  stacked: true,
		   title:{
			   display:true,
			  text: "'.$lang['dashboard.graph.views.y'].'"
		  } 
	  },
	  x:{
		  title:{
			   display:true,
			  text: "'.date('Y').'-'.date('Y', strtotime('+1 years')).'"
		  } 
	  }
    }
  }
});</script>';

echo $out;
}


?>
</body>
</html>