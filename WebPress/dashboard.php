<?php 
require_once('init.php');
require_once('header.php');
require_once('footer.php');

global $lang, $selLang, $conf, $defaultIcon;
include_once('lang/'.$selLang.'.php');
?>
<html>
<head>
<?php
global $plugins, $themes;
	foreach($plugins as $plugin){
		 if(!Files::checkFolder(DATA_PLUGINS.$plugin.DS))
			mkdir(DATA_PLUGINS.$plugin.DS, 0777, true); 
	}
	foreach($themes as $theme){
		 if(!Files::checkFolder(DATA_THEMES.$theme.DS))
			mkdir(DATA_THEMES.$theme.DS, 0777, true);	
	}
$BASEPATH=(!preg_match('/\/dashboard(?:\.php\/)/',$_SERVER['REQUEST_URI']) ? '.' : '..');
if(!preg_match('/\/dashboard(?:\.php\/)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(phpinfo\/|phpinfo)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.phpinfo'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(profile\/|profile)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.profile'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(configs\/|configs)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.config'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(docs\/|docs)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.docs'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(themes\/|themes)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.themes'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(plugins\/|plugins)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.plugins'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(console\/|console)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.console'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(editors\/|editors)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.editors'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(assets\/|assets)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.assets'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(mail\/|mail)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.mail'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(ban\/|ban)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.ban'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(roles\/|roles)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.roles'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(files\/|files)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.files'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(events\/|events)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.events'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(pages\/|pages)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.pages'], $BASEPATH);	
}elseif(preg_match('/\/dashboard(?:\.php)\/(view\/|view)/', $_SERVER['REQUEST_URI'])){
	echo head($lang['dashboard.title.view'], $BASEPATH);	
}else{
	echo head($lang['dashboard.title.notFound'], $BASEPATH);	
}

if(!file_exists(DATA_USERS.'users.dat.json')){
		echo '<script>
				window.open("'.$BASEPATH.'/auth.php/register", "_self");
				</script>';
			return false;
}
if(!isset($_SESSION['user'])){
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
$d[$_SESSION['user']]['ip'] = Users::getRealIP();
$d[$_SESSION['user']]['id'] = Users::hardwareID();
WebDB::saveDB('users', 'users', $d);
$out='';
if(!isset($_SESSION['guest'])){
	$out .= '<div id="pageColor" style="background-color: '.$conf['page']['panel']['bgcolor'].'; color:'.$conf['page']['panel']['color'].';">';
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
	$out .= '<br/>'.(Utils::checkVersion()[0] ? '<div class="alert alert-success" role="alert"><i class="fas fa-check"></i> Current '.Utils::checkVersion()[1].(Users::isProVersion() ? ' <span class="badge bg-danger probadeg">'.$lang['pro'].'</span>' : '').'</div>' : '<div class="alert alert-danger" role="alert"><i class="fas fa-upload"></i> Outdated '.Utils::checkVersion()[1].(Users::isProVersion() ? ' <span class="badge bg-danger probadeg">'.$lang['pro'].'</span>' : '').'</div>');
	$out.='</div>';
	$out.='<textarea class="form-control mb-2 wpnotes" oninput="saveNotes();" style="height: 130px;"></textarea>';
      $out.= '  <ul class="list-group list-group-flush">
        <a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/">'.$lang['dashboard.side.home'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard">'.$lang['dashboard.side.back'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/forum">'.$lang['dashboard.side.forum'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/phpinfo">'.$lang['dashboard.side.phpinfo'].'</a>
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
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/roles">'.$lang['dashboard.side.roles'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/files">'.$lang['dashboard.side.files'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/events">'.$lang['dashboard.side.events'].'</a>
		<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/pages">'.$lang['dashboard.side.pages'].'</a>
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
$out.='<center><div class="text-light bg-secondary p-2 w-75 rounded">'.$lang['dashboard.desc'].'</div></center>';
$out.='<center><div style="height:80%;overflow:auto;">';
$out.='<canvas id="webpress-users" class="dashboard-status"></canvas>';
$out.='<br/>';
$out.='<canvas id="webpress-views" class="dashboard-status"></canvas>';
$out.='<br/>';
$out.='<canvas id="webpress-forums" class="dashboard-status"></canvas>';
$out.='<br/>';
$out .= '<div></center>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Query</th>
	  <th scope="col">Value</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>'.$lang['dashboard.info.phpversion'].'</th>
	  <th>(7.4)<='.phpversion().'</th>
    </tr>
	 <tr>
      <th>'.$lang['dashboard.info.projectName'].'</th>
	  <th>'.PROJECT_NAME.'</th>
    </tr>
	 <tr>
      <th>'.$lang['dashboard.info.projectVersion'].'</th>
	  <th>'.Utils::checkVersion()[1].'</th>
    </tr>
	 <tr>
      <th>'.$lang['dashboard.info.projectBuild'].'</th>
	  <th>'.PROJECT_BUILD.'</th>
    </tr>
	<tr>
      <th>'.$lang['dashboard.info.serverSoftware'].'</th>
	  <th>'.(!empty($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '').'</th>
    </tr>
	<tr>
      <th>'.$lang['dashboard.info.phpModules'].'</th>
	  <th>'.implode(', ', get_loaded_extensions()).'</th>
    </tr>
	<tr>
      <th>'.$lang['dashboard.info.memory'].'</th>
	  <th>'.Files::sizeFormat(memory_get_usage()).' ('.Files::sizeFormat(memory_get_usage()).') out of '.Files::sizeFormat(memory_get_peak_usage(true)).'</th>
    </tr>
	<tr>
      <th>'.$lang['dashboard.info.diskSpace'].'</th>
	  <th>'.Files::sizeFormat(disk_free_space(dirname(dirname(dirname(ROOT))))).' out of '.Files::sizeFormat(disk_total_space(dirname(dirname(dirname(ROOT))))).'</th>
    </tr>
	<tr>
      <th>'.$lang['dashboard.info.dataStorage'].'</th>
	  <th>'.Files::sizeFormat(Files::folderSize(DATA)).'</th>
    </tr>
	<tr>
      <th>'.$lang['dashboard.info.uploadSize'].'</th>
	  <th>'.ini_get('upload_max_filesize').'</th>
    </tr>
	
  </tbody>
</table>
</div>';
$out.='</div>';


}elseif(preg_match('/\/dashboard(?:\.php)\/phpinfo/', $_SERVER['REQUEST_URI'])){
	$out.='<iframe src="../phpinfo.php" style="width:100%;height:77%;"></iframe>';
}elseif(preg_match('/\/dashboard(?:\.php)\/profile/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('changeProfile')){
	$info = isset($_GET['name']) ? $_GET['name'] : $_SESSION['user'];
	$out.='<div class="card text-center h-100 w-50 position-realative m-3 start-50 translate-middle-x">
  <div class="card-header">
    '.$lang['dashboard.profile.title'].'
  </div>
  <div class="card-body">
    <h5 class="card-title">'.$info.'</h5>
	<div class="container">
	<div class="row">
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.timezone'].$d[$info]['timezone'].'</p>
	</div>';
	$out.= (Users::isAdmin()|| Users::isMod() ? '<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.ip'].$d[$info]['ip'].'</p>
	</div>' : '');
	$out.='<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.location'].Users::ipInfo($d[$info]['ip'], 'location', 'Private IP').'</p>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.created'].Utils::toDate(explode('+',$d[$info]['created'])[0].' '.explode('+',$d[$info]['created'])[1], $conf['page']['dateFormat']).'</p>
	</div>
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.email'].$d[$info]['email'].'</p>
	</div>
	<div class="col">
	<p class="card-text">'.$lang['dashboard.profile.name'].$d[$info]['name'].'</p>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="'.$lang['btn.download'].'" href="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$info.'.png') ? $BASEPATH.DATA_AVATARS.$info.'.png' : $BASEPATH.DATA_AVATARS.'default.png').'" download="WebPress-'.$info.'-avatar">
	<img class="img-fluid rounded avatar" style="width:125px!important;height:125px!important;" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$info.'.png') ? $BASEPATH.DATA_AVATARS.$info.'.png?v='.trim(time()) : $BASEPATH.DATA_AVATARS.'default.png').'"/>
	</a>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<p class="card-text overflow-auto h-100">'.$lang['dashboard.profile.about'].$d[$info]['about'].'</p>
	</div>
	';
	
	
	if(Users::isAdmin()){
			$out.='<div class="col">
		<label class="form-label" for="user-api"><b>'.$lang['dashboard.userKey'].'</b></label>
	<div class="input-group">
	  <input type="text" id="user-api" class="form-control" readonly="" value="'.$token.'"/>
	<button onclick="copyPublicKey()" class="btn btn-secondary input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['dashboard.userKey.copy'].'"><i class="fas fa-copy"></i></button>
	</div>
	</div>
	<div class="col">
		<label class="form-label" for="user-private-api"><b>'.$lang['dashboard.userPKey'].'</b></label>
	<div class="input-group">
	  <input type="text" id="user-private-api" class="form-control" readonly="" value="'.(!file_exists(ROOT.'api'.DS.'KEYS.json') ? CSRF::generate() : hash('gost', hash('sha512',CSRF::hide()))).'"/>
	<button onclick="copyPrivateKey()" class="btn btn-secondary input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['dashboard.userPKey.copy'].'"><i class="fas fa-copy"></i></button>
	</div>
	</div>';
	}
	$out.='</div>
	
		<div class="row" '.(Users::isAdmin() ? '' : 'hidden="hidden"').'>
	<div class="col">
	<label class="form-label" for="user-hardwareid"><b>'.$lang['dashboard.profile.hardwareID'].'</b></label>
		<div class="input-group"> 
		 <input type="text" id="user-hardwareid" class="form-control" readonly="" value="'.$d[$info]['id'].'"/>
	<button onclick="copyHardwareID()" class="btn btn-secondary input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['dashboard.hardwareid.copy'].'"><i class="fas fa-copy"></i></button>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col">'.$lang['dashboard.profile.topics'].Forum::usersData((isset($_GET['name']) ? $_GET['name'] : $_SESSION['user']), 'topics').'</div>
	<div class="col">'.$lang['dashboard.profile.replys'].Forum::usersData((isset($_GET['name']) ? $_GET['name'] : $_SESSION['user']), 'replys').'</div>
	</div>
	<div class="row">'.Plugin::hook('profile').'</div>
	</div>
    
    
  </div>
  <div class="card-footer text-muted" style="overflow:auto;">
   '.(!isset($_GET['name']) ? '<button type="button" data-bs-toggle="modal"  data-bs-target="#apedit" class="btn btn-primary">'.$lang['dashboard.profile.editbtn'].'</button>' : '')
  .(!isset($_GET['name'])&&file_exists(DATA_UPLOADS.'avatars'.DS.$_SESSION['user'].'.png') ? '<form method="post" class="m-0 p-0"><button type="submit" name="removedAvatar" class="btn btn-danger">'.$lang['modal.profile.removeAvatar'].'</button></form>' : '').'
  '.(Users::isAdmin()&&isset($_GET['name']) ? '<a href="'.$BASEPATH.'/dashboard.php/ban?add='.$_GET['name'].'"><button class="btn btn-danger">'.$lang['dashboard.profile.addBan'].'</button></a>' : '').'
  </div>
</div>';
$out.= Users::editProfile();
Utils::isPost('profileEdit', false, function(){
	global $lang, $BASEPATH;
		$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	$username = $_POST['webuser'];
	$psw = $_POST['webpsw'];
	$newpsw = $_POST['webnpsw'];
	$about = $_POST['webabout'];
	# change username
	if($username!==""||$username===$_SESSION['user']&&!isset($d[$username])){
		  Files::upload('profileicon', DATA_UPLOADS.'avatars'.DS, (isset($_SESSION['user']) ? $_SESSION['user'].'.png' : null));
		Utils::profileSave(['about'=>$about, 'password'=>$psw.'+'.$newpsw]);
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
}elseif(preg_match('/\/dashboard(?:\.php)\/configs/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('config')){
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
    <input type="color" id="panelbgcolor" value="'.$conf['page']['panel']['bgcolor'].'" class="form-control b-0 p-0 m-0 form-control-lg w-100 form-control-color" name="panelbgcolor"/>
</div>
	</div>
	<div class="col">
		<div class="input-group p-0">
		<h4>'.$lang['dashboard.config.panel.color'].'</h4>
    <input type="color"  id="panelcolor" value="'.$conf['page']['panel']['color'].'" class="form-control b-0 p-0 m-0 form-control-lg w-100 form-control-color" name="panelcolor"/>
</div>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.captch'].'</h4>
		<select name="captchaActive" class="form-control">
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
	<div class="col">
	<h4>'.$lang['dashboard.config.panel.theme'].'</h4>
	<select class="form-control" name="themes">
	';
	foreach(Files::Scan(ROOT.'/themes') as $themes){
		$theme = Files::removeExtension($themes);
		$dbtheme = WebDB::getDB('themes', $theme.'/theme','.conf.json');
		if($dbtheme['active']){
		$out.='<option'.($themes===$conf['page']['themes'] ? ' selected="selected"' : '').
		' value="'.$themes.'" '.
		($themes==='default' ? 'style="background-color:lightgray;"' : '').
		'>'.$dbtheme['name'][Users::getLang()].'</option>';
		}
	}
	$out.='
	</select>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.panel.dateformat'].'</h4>
	<input class="form-control" name="dateFormat" value="'.$conf['page']['dateFormat'].'"/>
	</div>
	</div>';
	$out.='<div class="row">
	<h4>'.$lang['dashboard.config.panel.icons'].'</h4>
	<div class="col">
	<label class="form-label">16x16</label>
	<div class="input-group">	
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon16" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['16']).'"/>
	</div>
	<label class="form-label">24x24</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon24" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['24']).'"/>
	</div>
	<label class="form-label">32x32</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon32" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['32']).'"/>
	</div>
	<label class="form-label">48x48</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon48" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['48']).'"/>
	</div>
	<label class="form-label">64x64</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon64" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['64']).'"/>
	</div>
	<label class="form-label">96x96</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon96" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['96']).'"/>
	</div>
	<label class="form-label">128x128</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon128" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['128']).'"/>
	</div>
	<label class="form-label">256x256</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon256" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['256']).'"/>
	</div>
	<label class="form-label">512x512</label>
	<div class="input-group">
	<label class="input-group-text">themes/</label>
	<input type="text" name="icon512" class="form-control" value="'.str_replace('themes/','',$conf['page']['page-icon']['512']).'"/>
	</div>
	</div>
	<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.panel.index'].'</h4>
	<select name="defaultIndex" class="form-control">';
	foreach(Files::Scan(ROOT.'pages'.DS) as $files){
		if(is_file(ROOT.'pages'.DS.$files)){
			$out.='<option '.(Files::removeExtension($files, '.html')===$conf['page']['index'] ? 'selected="selected"' : '').' value="'.Files::removeExtension($files, '.html').'">'.$files.'</option>';
		}
	}
	$out.='</select>
	</div>
	</div>
	</div>';
	$out.='<hr class="border border-5 border-primary"/>';
	$out.='<h1 class="text-center" id="configSeo">'.$lang['dashboard.config.seo.title'].' </h1>';
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
	<div class="col">
	<h4>'.$lang['dashboard.config.timeZone.title'].'</h4>
	<input type="text" autocorrect="off" name="defaultTimeZone" class="form-control" value="'.$conf['page']['defaultTimeZone'].'"/>
	</div>
	</div>';
	$out.='<hr class="border border-5 border-primary"/>';
	$out.='<h1 class="text-center" id="configForum">'.$lang['dashboard.config.forum.title'].' </h1>';
	$out.='<div class="row">
	<div class="col">
	<h4>'.$lang['dashboard.config.forum.topic'].'</h4>
	<input name="displayTopicAmount" class="form-control" type="number" value="'.$conf['forum']['maxTopicDisplay'].'" min="2"/>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.forum.reply'].'</h4>
	<input name="displayReplyAmount" class="form-control" type="number" value="'.$conf['forum']['maxReplyDisplay'].'" min="2"/>
	</div>
	<div class="col">
	<h4>'.$lang['dashboard.config.forum.summary'].'</h4>
	<input name="displaySumAmount" class="form-control" type="number" value="'.$conf['forum']['maxSummary'].'" min="10" max="100"/>
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
		$icon16 = isset($_POST['icon16'])&&$_POST['icon16']!=='' ? 'themes/'.$_POST['icon16'] : $conf['page']['page-icon']['16'];
		$icon24 = isset($_POST['icon24'])&&$_POST['icon24']!=='' ? 'themes/'.$_POST['icon24'] : $conf['page']['page-icon']['24'];
		$icon32 = isset($_POST['icon32'])&&$_POST['icon32']!=='' ? 'themes/'.$_POST['icon32'] : $conf['page']['page-icon']['32'];
		$icon48 = isset($_POST['icon48'])&&$_POST['icon48']!=='' ? 'themes/'.$_POST['icon48'] : $conf['page']['page-icon']['48'];
		$icon64 = isset($_POST['icon64'])&&$_POST['icon64']!=='' ? 'themes/'.$_POST['icon64'] : $conf['page']['page-icon']['64'];
		$icon96 = isset($_POST['icon96'])&&$_POST['icon96']!=='' ? 'themes/'.$_POST['icon96'] : $conf['page']['page-icon']['96'];
		$icon128 = isset($_POST['icon128'])&&$_POST['icon128']!=='' ? 'themes/'.$_POST['icon128'] : $conf['page']['page-icon']['128'];
		$icon256 = isset($_POST['icon256'])&&$_POST['icon256']!=='' ? 'themes/'.$_POST['icon256'] : $conf['page']['page-icon']['256'];
		$icon512 = isset($_POST['icon512'])&&$_POST['icon512']!=='' ? 'themes/'.$_POST['icon512'] : $conf['page']['page-icon']['512'];
		$dateFormat = isset($_POST['dateFormat'])&&$_POST['dateFormat']!=='' ? $_POST['dateFormat'] : $conf['page']['dateFormat'];
		$topicAmount = isset($_POST['displayTopicAmount'])&&$_POST['displayTopicAmount']>1 ? (int) $_POST['displayTopicAmount'] : $conf['forum']['maxTopicDisplay'];
		$replyAmount = isset($_POST['displayReplyAmount'])&&$_POST['displayReplyAmount']>1 ? (int) $_POST['displayReplyAmount'] : $conf['forum']['maxReplyDisplay'];
		$themes = isset($_POST['themes']) ? $_POST['themes'] : $conf['page']['themes'];
		$timeZone = isset($_POST['defaultTimeZone'])&&$_POST['defaultTimeZone']!=='' ? $_POST['defaultTimeZone'] : $conf['page']['defaultTimeZone'];
		$dI = isset($_POST['defaultIndex']) ? $_POST['defaultIndex'] : $conf['page']['index'];
		$sumAmount = isset($_POST['displaySumAmount'])&&$_POST['displaySumAmount']>=10&&$_POST['displaySumAmount']<=100 ? $_POST['displaySumAmount'] : $conf['forum']['maxSummary'];
		
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
		$d['page']['page-icon']['16'] = $icon16;
		$d['page']['page-icon']['24'] = $icon24;
		$d['page']['page-icon']['32'] = $icon32;
		$d['page']['page-icon']['48'] = $icon48;
		$d['page']['page-icon']['64'] = $icon64;
		$d['page']['page-icon']['96'] = $icon96;
		$d['page']['page-icon']['128'] = $icon128;
		$d['page']['page-icon']['256'] = $icon256;
		$d['page']['page-icon']['512'] = $icon512;
		$d['page']['themes'] = $themes;
		$d['page']['dateFormat'] = $dateFormat;
		$d['forum']['maxTopicDisplay'] = $topicAmount;
		$d['forum']['maxReplyDisplay'] = $replyAmount;
		$d['forum']['maxSummary'] = $sumAmount;
		$d['page']['defaultTimeZone'] = $timeZone;
		$d['page']['index'] = $dI;
		
		
		WebDB::saveDB('CONFIG', 'config', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/configs', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/config', 'danger');
	});
}elseif(preg_match('/\/dashboard(?:\.php)\/docs/', $_SERVER['REQUEST_URI'])){
	$out.='<div class="position-relative" style="background-color:#c1c1c14a;height:77.3%;overflow:auto;">';
	$getDoc = file_get_contents(ROOT.'docs'.DS.'doc_'.explode('-',$conf['lang'])[0].'.md');
	$bb = $parseBB->toHTML($getDoc);
	$out.=$parseMD->text($bb);
	
	$out.='</div>';
}elseif(preg_match('/\/dashboard(?:\.php)\/themes/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('activeThemes')){
	$listThemes = array();
	$tplot='';
	$p = isset($_GET['p']) ? $_GET['p'] : 1;
	$nb = $conf['themesDisplayAmount'];
	$coun=0;

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
		$tplot='<li class="list-group-item"><div class="card h-100 text-bg-secondary theme '.($themeConfig['active']!=='' ? 'theme-active' : '').'" style="width:18rem;">
<div class="card-header text-center h3">
'.(isset($themeConfig['name'][Users::getLang()]) ? $themeConfig['name'][Users::getLang()] : '<div class="alert alert-danger">'.$lang['theme.error.missingName'].'</div>').'
</div>
<div class="card-body text-bg-primary overflow-auto">
'.(isset($themeConfig['desc'][Users::getLang()]) ? $themeConfig['desc'][Users::getLang()] : '<div class="alert alert-danger">'.$lang['theme.error.missingDesc'].'</div>').'
'.(isset($themeConfig['options']['usedLang']) ? '<div class="text-bg-dark">'.$lang['theme.allow.lang'].'<span class="fw-bold fst-italic">'.$lgs.'</span></div>' : '<div class="text-bg-dark">'.$lang['theme.allow.lang'].'<span class="fw-bold fst-italic">'.$lang['theme.allow.lang.null'].'</span></div>').'
</div>
<div class="card-footer p-0">

'.($themes==='default'&&!$themeConfig['options']['canDisabled'] ? '<div data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['btn.disabled'].'">' : '').'
<a'.($themeConfig['options']['canDisabled'] ? ' href="../config.php?type=themes&name='.$themes.'&action='.($themeConfig['active']!=='' ? 'deactive' : 'active').'"' : '').'><button '.($themes==='default'&&!$themeConfig['options']['canDisabled'] ? 'disabled="disabled"   ' : '').' class="theme-btn '.($themeConfig['active']!=='' ? 'btn-success' : 'btn-danger').' w-100 m-0 btn theme-btn-active">'.($themeConfig['active']!=='' ? $lang['theme.active'] : $lang['theme.deactive']).'</button></a>
'.($themes==='default'&&!$themeConfig['options']['canDisabled'] ? '</div>' : '').'
</div>
</div></li>';
$listThemes[] = $tplot;
	}
		
}
for($i=0;$i<count(array_slice($listThemes, $nb*($p-1), $nb));$i++){
	$out.=array_slice($listThemes, $nb*($p-1), $nb)[$i];
}
$out.='</ul>';
$out.= Paginate::pageLink(Paginate::pid($conf['themesDisplayAmount']), Paginate::countPage(Files::Scan(DATA_THEMES), $conf['themesDisplayAmount']), './themes?');
}elseif(preg_match('/\/dashboard(?:\.php)\/plugins/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('activePlugins')){
$out.='<ul class="list-group list-group-flush list-group-horizontal">';
$listPlugins = array();
$plout='';
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$nb = $conf['pluginDisplayAmount'];
$coun=0;
foreach(Files::Scan(ROOT.'plugins') as $plugins){
@!file_exists(DATA_PLUGINS.$plugins.DS) ? @mkdir(DATA_PLUGINS.$plugins) : '';
	if(!file_exists(DATA_PLUGINS.$plugins.DS.'plugin.dat.json')){
		echo Plugin::forceExecute('install', $plugins);
		echo '<script>window.location.reload();</script>';
	}elseif(file_exists(DATA_PLUGINS.$plugins.DS.'plugin.dat.json')){
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
		$plout='<li class="list-group-item"><div class="card h-100 text-bg-secondary plugin '.($pluginsConfig['active']!=='' ? 'plugin-active' : '').'" style="width:18rem;">
<div class="card-header text-center h3">
'.(isset($lang[$plugins.'_name']) ? $lang[$plugins.'_name'] . ' <h6><small data-bs-toggle="tooltip" data-bs-placement="top" title="'.(isset($lang[$plugins.'_updated']) ? $lang['plugin.pluginUpdated'].$lang[$plugins.'_updated'] : '').'" class="badge bg-primary">v'.$pluginsConfig['version'].'</small></h6>' : '<div class="alert alert-danger">'.$lang['plugin.error.missingName'].'</div>').'
'.(isset($lang[$plugins.'_author']) ? '<a target="_blank" '.(isset($lang[$plugins.'_homepage']) ? 'href="'.$lang[$plugins.'_homepage'].'"' : '').'><small class="badge'.(isset($lang[$plugins.'_homepage']) ? ' link-primary' : '').'">'.$lang[$plugins.'_author'].'</small></a>' : '').'
</div>
<div class="card-body text-bg-primary overflow-auto">
'.(isset($lang[$plugins.'_desc']) ? '<div style="overflow:auto;height:26%;">'.$lang[$plugins.'_desc'].'</div>' : '<div class="alert alert-danger">'.$lang['plugin.error.missingDesc'].'</div>').'
<img class="img-fluid plugin-icon" src="'.$BASEPATH.'/plugins/'.$plugins.DS.'icon.png"/>
'.(isset($pluginsConfig['options']['usedLang']) ? '<div class="text-bg-dark rounded ps-1 pt-1 pb-1">'.$lang['plugin.allow.lang'].'<span class="fw-bold fst-italic">'.$lgs.'</span></div>' : '<div class="text-bg-dark">'.$lang['plugin.allow.lang'].'<span class="fw-bold fst-italic">'.$lang['plugin.allow.lang.null'].'</span></div>').'
</div>
<div class="card-footer p-0">

'.(!$pluginsConfig['options']['canDisabled'] ? '<div data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['btn.disabled'].'">' : '').'
<a'.($pluginsConfig['options']['canDisabled'] ? ' href="../config.php?name='.$plugins.'&action='.($pluginsConfig['active']!=='' ? 'deactive' : 'active').(isset($_GET['p']) ? '&r='.$_GET['p'] : '').'"' : '').'><button '.(!$pluginsConfig['options']['canDisabled'] ? 'disabled="disabled"   ' : '').' class="plugin-btn '.($pluginsConfig['active']!=='' ? 'btn-success' : 'btn-danger').' w-100 m-0 btn theme-btn-active">'.($pluginsConfig['active']!=='' ? $lang['plugin.active'] : $lang['plugin.deactive']).'</button></a>
'.(!$pluginsConfig['options']['canDisabled'] ? '</div>' : '').'
'.(isset($pluginsConfig['config']['use'])&&$pluginsConfig['config']['use']&&$pluginsConfig['active'] ? '<a href="'.$BASEPATH.'/config.php/plugin/'.$plugins.'"><div data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang['config.label'].$plugins.'"><button class="btn btn-secondary w-100 m-0">'.$lang['config.label'].'<i class="fas fa-user-cog"></i></button></div></a>' : '').'
</div>
</div></li>';
	$listPlugins[] = $plout;
	}
}

for($i=0;$i<count(array_slice($listPlugins, $nb*($p-1), $nb));$i++){
	$out.=array_slice($listPlugins, $nb*($p-1), $nb)[$i];

}

$out.='</ul>';
$out.= Paginate::pageLink(Paginate::pid($conf['pluginDisplayAmount']), Paginate::countPage(Files::Scan(DATA_PLUGINS), $conf['pluginDisplayAmount']), './plugins?');
}elseif(preg_match('/\/dashboard(?:\.php)\/console/', $_SERVER['REQUEST_URI'])){
	$data = '';
	$getLog = preg_split('/\R/', Files::getFileData(ROOT.'debug.log'));
	$id=0;
	$targetCurrent=0;
	$remove=$conf['page']['panel']['console'];
	foreach($getLog as $log){
		if($log!==''){
			$targetCurrent++;
			if($targetCurrent===(count($getLog)-$remove)&&$id<=$conf['page']['panel']['console']||$conf['page']['panel']['console']===(int)'-1'){
				$id++;
				$remove--;
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
	
}elseif(preg_match('/\/dashboard(?:\.php)\/mail/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('onComingMessages')){
	$out.='<div class="bg-primary p-2 m-2">';
foreach(Files::Scan('data/mail/') as $mails){
	$mails = str_replace('.dat.json','',$mails);
	$mail = WebDB::getDB('mail', $mails);
	$emailExp = '/\s\&lt\;([\w\W]+)\&gt\;/';
	$users = WebDB::getDB('users', 'users');
	if(isset($mail['msg']['to'][$session])){
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
	}
	
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
	  </div>';
	 $out.=(isset($_GET['report']) ? '<div class="col">
	 <label class="form-label" for="prioiry">'.$lang['contact.report.prioiry'].'</label>
	 <select class="form-control" name="prioiry">
	 <option value="0">0</option>
	 <option value="1">1</option>
	 <option value="2">2</option>
	 <option value="3">3</option>
	 <option value="4">4</option>
	 </select></div>' : '');
	  $out.='</div>
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
	 <div class="autocomplete">
	 <input type="text" '.(isset($_GET['to']) ? 'value="'.$_GET['to'].'"' : '').' required="required" placeholder="'.$lang['contact.emailto.placeholder'].'" class="form-control" id="toemail" name="toemail"/>
	  </div>
	  <small class="text-muted form-text">'.$lang['contact.to.example'].'</small>
		</div>';
	
	  $out.='</div>
		<div class="row">
		<div class="col">
		<label class="form-label" for="sendmsg">'.$lang['contact.msg'].'</label>
		<textarea style="height:136px;" class="form-control" required="required" name="sendmsg" id="sendmsg" placeholder="'.$lang['contact.msg.placeholder'].'">'.(isset($_GET['report']) ? '<a href="'.$BASEPATH.'/forum.php/view?id='.$_GET['report'].(isset($_GET['pnum'])? '&p='.$_GET['pnum'] : '').(isset($_GET['replyID']) ? '#'.$_GET['replyID'] : '').'">'.(isset($_GET['replyID']) ? $_GET['replyID'] : $_GET['report']).'</a> '.$lang['contact.report.label'].' ' : '').'</textarea>
		</div>
		</div>
		<div class="row mt-2">
		<div class="col">
		<button type="submit" name="sender" class="btn '.(isset($_GET['report']) ? 'btn-warning' : 'btn-primary').'">'.(isset($_GET['report']) ? $lang['contact.report'] : $lang['contact.send']).'</button>
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
	$prioiry = isset($_POST['prioiry']) ? $_POST['prioiry'] : '';
	
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
		/*getNotifiedData*/
		$updates = json_decode(file_get_contents(ROOT.'UPDATES.json'), true);
		array_push($updates['versions'][Utils::getVersion()]['textsets'], array('text'=>$msg, 'icon'=>'fa-solid fa-envelope', 'tag'=>'mail', 'show'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 'type'=>'secondary'));
		$updates['needsAttation'] = filter_var('true', FILTER_VALIDATE_BOOLEAN);
		file_put_contents(ROOT.'UPDATES.json',json_encode($updates, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
		/*end nottify data*/
	WebDB::makeDB('MAIL', $fileSub);
	echo WebDB::saveDB('MAIL', $fileSub, $exploitMsg) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
}
if(isset($_GET['notify'])){
	$updates = json_decode(file_get_contents(ROOT.'UPDATES.json'), true);
	$updates['needsAttation'] = filter_var('false', FILTER_VALIDATE_BOOLEAN);
	echo @file_put_contents(ROOT.'UPDATES.json',json_encode($updates, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/mail', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/mail', 'danger');
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

}elseif(preg_match('/\/dashboard(?:\.php)\/ban/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('ban')){
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
}elseif(preg_match('/\/dashboard(?:\.php)\/roles/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('changeRoles')){
	$users = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	$out .= '<table table-style="primary">  
	<thead>
    <tr>
      <th>'.$lang['roles.user'].'</th>
	  <th>'.$lang['roles.roleID'].'</th>
	  <th>'.$lang['roles.edit'].'</th>
    </tr>
  </thead><tbody>';
	foreach($users as $user => $data){
		$out.='<tr>';
		$out.='<td>'.$user.'</td>';
		$out.='<td>'.$data['type'].'</td>';
		$out.='<td><button type="button"'.(Users::getRole($user)==='admin' ? ' disabled="disabled" ' : '').'class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#editRole" data-bs-user="'.$user.'"><i class="fa-solid fa-pencil"></i></button></td>';
		$out.='</tr>';
	}
	$out.='</tbody></table>';
	$out.='<div class="modal fade" id="editRole" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="editRoleLabel">'.$lang['roles.edit'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
          <div class="mb-3">
            <label for="username" class="col-form-label">'.$lang['roles.user'].'</label>
            <input type="text" class="form-control" id="username" readonly="" name="username">
          </div>
		  <div class="mb-3">
            <label for="roleSelect" class="col-form-label">'.$lang['roles.roleSelect'].'</label>
            <select type="text" class="form-control" id="roleSelect" name="roleSelect">';
			$getRoles = json_decode(file_get_contents(ROOT.'ROLES.json'), true);
			foreach($getRoles['roles'] as $role=>$info){
				if($role!=='guest'){
				$out .= '<option data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$info['description'].'" value="'.$role.'">'.$role.'</option>';
				}
			}
			$out.='</select>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button>
        <button type="submit" name="saveRole" class="btn btn-primary">'.$lang['btn.save'].'</button>
      </div>
	   </form>
    </div>
  </div>
</div>';
if(isset($_POST['saveRole'])){
	$user = $_POST['username'];
	$setRole = $_POST['roleSelect'];
	$userDB = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	$userDB[$user]['type'] = $setRole;
	echo WebDB::saveDB('users', 'users', $userDB) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/roles', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/roles', 'danger');
}	
$out.='<script>
const roleEditor = document.getElementById(\'editRole\')
roleEditor.addEventListener(\'show.bs.modal\', event => {
  // Button that triggered the modal
  const button = event.relatedTarget
  // Extract info from data-bs-* attributes
  const getUser = button.getAttribute(\'data-bs-user\')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal\'s content.
  const user = roleEditor.querySelector(\'#username\');

  user.value = getUser
})
</script>';
$out.= (Users::isAdmin() ? '<center><button data-bs-toggle="modal" data-bs-target="#createRole" class="btn btn-warning fs-5 m-3 w-75">'.$lang['roles.createRole'].'</button></center>' : '');
$out.= (Users::isAdmin() ? '<center><button data-bs-toggle="modal" data-bs-target="#deleteRole" class="btn btn-danger fs-5 m-3 w-75">'.$lang['roles.deleteRole'].'</button></center>' : '');
$out.='<div class="modal fade" id="createRole" tabindex="-1" aria-labelledby="createRole" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createRole">'.$lang['roles.createRole'].'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col">
			<label class="form-label" for="roleName">'.$lang['roles.input.name'].'</label>
				<input type="text" required="" id="roleName" class="form-control" name="roleName"/>
			</div>
			<div class="col">
			<label class="form-label" for="roleDesc">'.$lang['roles.input.desc'].'</label>
				<textarea id="roleDesc" required="" class="form-control" name="roleDesc"></textarea>
			</div>
		</div>
		<hr/>
		<div class="row">
		<label class="form-label" for="roleView">'.$lang['roles.input.canView'].'</label>
		<select class="form-control" disabled="" id="roleView" name="roleView">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option'.($val==='yes' ? ' selected="selected"' : '').' value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
		<div class="row">
		<label class="form-label" for="roleWrite">'.$lang['roles.input.canWrite'].'</label>
		<select class="form-control" id="roleWrite" name="roleWrite">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleRead">'.$lang['roles.input.canRead'].'</label>
		<select class="form-control" id="roleRead" name="roleRead">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleDelete">'.$lang['roles.input.canDelete'].'</label>
		<select class="form-control" id="roleDelete" name="roleDelete">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleBan">'.$lang['roles.input.canBan'].'</label>
		<select class="form-control" id="roleBan" name="roleBan">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="rolePost">'.$lang['roles.input.canPost'].'</label>
		<select class="form-control" id="rolePost" name="rolePost">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleReply">'.$lang['roles.input.canReply'].'</label>
		<select class="form-control" id="roleReply" name="roleReply">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleMsg">'.$lang['roles.input.canMsg'].'</label>
		<select class="form-control" id="roleMsg" name="roleMsg">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="rolePlugins">'.$lang['roles.input.plugins'].'</label>
		<select class="form-control" id="rolePlugins" name="rolePlugins">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleThemes">'.$lang['roles.input.themes'].'</label>
		<select class="form-control" id="roleThemes" name="roleThemes">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleConfig">'.$lang['roles.input.config'].'</label>
		<select class="form-control" id="roleConfig" name="roleConfig">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleRoles">'.$lang['roles.input.canRole'].'</label>
		<select class="form-control" id="roleRoles" name="roleRoles">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleFile">'.$lang['roles.input.file'].'</label>
		<select class="form-control" id="roleFile" name="roleFile">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
			<div class="row">
		<label class="form-label" for="roleProfile">'.$lang['roles.input.profile'].'</label>
		<select class="form-control" id="roleProfile" name="roleProfile">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
		<div class="row">
		<label class="form-label" for="roleEvent">'.$lang['roles.input.events'].'</label>
		<select class="form-control" id="roleEvent" name="roleEvent">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
		<div class="row">
		<label class="form-label" for="rolePages">'.$lang['roles.input.pages'].'</label>
		<select class="form-control" id="rolePages" name="rolePages">';
		foreach($lang['forum.toggleOpt'] as $opt=>$val){
			$out.='<option value="'.$opt.'">'.$val.'</option>';
		}
		$out.='</select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="roleCreateSubmit" class="btn btn-primary">'.$lang['roles.createRole'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
if(isset($_POST['roleCreateSubmit'])){
	$name = $_POST['roleName'];
	$desc = $_POST['roleDesc'];
	$view = (bool)true;
	$write = filter_var($_POST['roleWrite'], FILTER_VALIDATE_BOOLEAN);
	$read = filter_var($_POST['roleRead'], FILTER_VALIDATE_BOOLEAN);
	$delete = filter_var($_POST['roleDelete'],FILTER_VALIDATE_BOOLEAN);
	$ban = filter_var($_POST['roleBan'], FILTER_VALIDATE_BOOLEAN);
	$post = filter_var($_POST['rolePost'], FILTER_VALIDATE_BOOLEAN);
	$reply = filter_var($_POST['roleReply'],FILTER_VALIDATE_BOOLEAN);
	$msg = filter_var($_POST['roleMsg'], FILTER_VALIDATE_BOOLEAN);
	$plugins = filter_var($_POST['rolePlugins'], FILTER_VALIDATE_BOOLEAN);
	$themes = filter_var($_POST['roleThemes'], FILTER_VALIDATE_BOOLEAN);
	$config = filter_var($_POST['roleConfig'], FILTER_VALIDATE_BOOLEAN);
	$roles = filter_var($_POST['roleRoles'], FILTER_VALIDATE_BOOLEAN);
	$file = filter_var($_POST['roleFile'], FILTER_VALIDATE_BOOLEAN);
	$profile = filter_var($_POST['roleProfile'],FILTER_VALIDATE_BOOLEAN);
	$events = filter_var($_POST['roleEvent'],FILTER_VALIDATE_BOOLEAN);
	$pages = filter_var($_POST['rolePages'],FILTER_VALIDATE_BOOLEAN);
	$role = array(
			'name'=>$name,
			'description'=>$desc,
			'options'=>array(
				'view'=>$view,
				'write'=>$write,
				'read'=>$read,
				'delete'=>$delete,
				'ban'=>$ban,
				'post'=>$post,
				'reply'=>$reply,
				'onComingMessages'=>$msg,
				'activePlugins'=>$plugins,
				'activeThemes'=>$themes,
				'config'=>$config,
				'changeRoles'=>$roles,
				'filemanager'=>$file,
				'changeProfile'=>$profile,
				'events'=>$events,
				'pages'=>$pages
			)
	);
	$getRoles = json_decode(file_get_contents(ROOT.'ROLES.json'), true);
	$getRoles['roles'][$name] = $role;
	$encodeRoles = json_encode($getRoles, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	echo @file_put_contents(ROOT.'ROLES.json', $encodeRoles) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/roles', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/roles', 'danger');
}
$out.='<div class="modal fade" id="deleteRole" tabindex="-1" aria-labelledby="deleteRole" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteRole">'.$lang['roles.deleteRole'].'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label class="form-label" for="roleItems">'.$lang['roles.removeItems'].'</label>
		<select class="form-control" name="roleItems" id="roleItems">';
		$getRoles = json_decode(file_get_contents(ROOT.'ROLES.json'), true);
		foreach($getRoles['roles'] as $name => $items){
			if($name!=='admin'&&$name!=='moderator'&&$name!=='member'&&$name!=='guest')
				$out.='<option value="'.$name.'">'.$name.'</option>';
		}
		$out.='</select>
      </div>
      <div class="modal-footer">
        <button type="submit" name="roleDeleteSubmit" class="btn btn-danger">'.$lang['roles.deleteRole'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
	if(isset($_POST['roleDeleteSubmit'])){
		if(isset($_POST['roleItems'])&&$_POST['roleItems']!==''){
			$getRoles = json_decode(file_get_contents(ROOT.'ROLES.json'), true);
			unset($getRoles['roles'][$_POST['roleItems']]);
			$encodeRoles = json_encode($getRoles, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			echo @file_put_contents(ROOT.'ROLES.json', $encodeRoles) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/roles', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/roles', 'danger');
		}else{
			echo Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/roles', 'danger');
		}
	}
}elseif(preg_match('/\/dashboard(?:\.php)\/files/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('filemanager')){
	$path = isset($_GET['path']) ? $_GET['path'] : '';
	$out.='<form method="post">';
	$out.='<a href="./files?'.(isset($_GET['path']) ? 'path='.$_GET['path'].'&' : '').'createFile='.ROOT.(isset($_GET['path']) ? $_GET['path']: '').'"><button type="button" class="btn btn-secondary m-3">'.$lang['file.manager.createFile'].'</button></a>';
	$out.='<a href="./files?'.(isset($_GET['path']) ? 'path='.$_GET['path'].'&' : '').'createFolder='.ROOT.(isset($_GET['path']) ? $_GET['path']: '').'"><button type="button" class="btn btn-secondary m-3">'.$lang['file.manager.createFolder'].'</button></a>';
	$out.='<a href="./files?'.(isset($_GET['path']) ? 'path='.$_GET['path'].'&' : '').'upload='.ROOT.(isset($_GET['path']) ? $_GET['path']: '').'"><button type="button" class="btn btn-secondary m-3">'.$lang['file.manager.upload'].'</button></a>';
	
	$out.='</form>';
	if(isset($_GET['createFile'])){
			$out.='<div class="modal d-block" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['files.addFile.msg'].'</h5>
      </div>
	  <div class="modal-body">
	  <div class="input-group">
	  <label class="input-group-text" for="filename">'.$_GET['createFile'].'</label> 
	   <input class="form-control" id="filename" type="text" name="filename"/>
	  </div>
	 
	  </div>
      <div class="modal-footer">
       <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button></a>
        <button name="createFile" type="submit" class="btn btn-success">'.$lang['btn.save'].'</button>
      
	  </div>
	  </form>
    </div>
  </div>
</div>';
	}
	$out.='</form>';
	if(isset($_GET['createFolder'])){
			$out.='<div class="modal d-block" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['files.addFolder.msg'].'</h5>
      </div>
	  <div class="modal-body">
	  <div class="input-group">
	  <label class="input-group-text" for="filename">'.$_GET['createFolder'].'</label> 
	   <input class="form-control" id="filename" type="text" name="filename"/>
	  </div>
	 
	  </div>
      <div class="modal-footer">
       <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button></a>
        <button name="createFolder" type="submit" class="btn btn-success">'.$lang['btn.save'].'</button>
      
	  </div>
	  </form>
    </div>
  </div>
</div>';
	}
if(isset($_GET['upload'])){
			$out.='<div class="modal d-block" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['files.uploadFiles.msg'].'</h5>
      </div>
	  <div class="modal-body">
	  <div class="input-group">
	  <label class="form-label">'.$lang['file.manager.fileUpload'].'&nbsp;&nbsp;</label> 
	  <input class="form-control" id="filename" type="file" multiple name="fileUpload[]"/>
	   </div>
	 
	  </div>
      <div class="modal-footer">
       <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button></a>
        <button name="uploadFiles" type="submit" class="btn btn-success">'.$lang['btn.save'].'</button>
      
	  </div>
	  </form>
    </div>
  </div>
</div>';
	}
if(isset($_POST['uploadFiles'])){
	echo @Files::uploadToFileManager('fileUpload', $_GET['upload']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
}
	
if(isset($_POST['createFile'])){
	$name = isset($_POST['filename']) ? $_POST['filename'] : '';
	$name = !strpos($name, '.') ? $name.'.file' : $name;
	$file = fopen($_GET['createFile'].$name, 'w+') or die('Unable to open file');
	@fclose($file) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
}
if(isset($_POST['createFolder'])){
		$name = isset($_POST['filename']) ? $_POST['filename'] : '';
	@mkdir($_GET['createFolder'].$name) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
}
$out.='<h1 class="text-center">'.count(Files::Scan(ROOT.(isset($_GET['path']) ? $_GET['path']: ''))).' '.$lang['dashboard.pageResults'].'</h1>';
	$out.='<ol class="breadcrumb text-big container-p-x py-3 m-0">
	<li class="breadcrumb-item"> 
	<a href="./files">'.str_replace('/','',str_replace($_SERVER['DOCUMENT_ROOT'].'/','',str_replace('\\','/',ROOT))).'</a>
	</li>';
	if($path!==''){
		$exploit = explode('/', $path);
		$implode = array();
		$i=0;
		foreach($exploit as $exp){
			if($exp!==''){
			$checkActive = count($exploit);
			$implode[] = $exp;
			$i++;
			$out.='<li class="breadcrumb-item'.($i===$checkActive-1 ? ' active' : '').'">
			<a href="./files?path='.implode('/',$implode).'/">'.$exp.'</a>
			</li>';	
			}
		}
	}
	$out.='</ol>';
	$out.='<ul class="list-group list-group-flush">'; 
	# check for valid types
	$apache = array('htaccess', 'config');
	$code = array('php', 'json');
	$html = array('htm','html');
	$css = array('scss', 'css');
	$js = array('js');
	$txt = array('txt', 'doc', 'docx', 'rtf');
	$imgs = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'tiff', 'raw');
	$audio = array('mp3', 'wav', 'ogg');
	$video = array('mp4', 'mov', 'avi');
	$compress = array('zip', '7z', 'rar', 'gz');
	$hidden = array('controller', 'controller.lib.php');
	#sender 
	foreach(Files::Scan(ROOT.$path) as $send){
		$type = @end(explode('.',strtolower($send)));
		$name = @reset(explode('.',strtolower($send)));
		if(is_dir(ROOT.$path.$send)){
			if(Files::LockedItem($send, array('api', 'docs', 'assets')) || !is_writable(ROOT.$path.$send)){
			$out.= '<a style="color:#808080;text-decoration:none;"><li class="list-group-item list-group-item-action" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['file.locked.folder'].'"><span><i class="fa-solid fa-folder-xmark" style="color:#808080;"></i> '.$send.'</span> <span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span><span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';	
			}else{
			$out.= '<a href="./files?path='.$path.$send.'/" style="color:#808080;text-decoration:none;"><li class="list-group-item list-group-item-action"><span><i class="fa-solid fa-folder" style="color:#808080;"></i> '.$send.'</span> <span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
			}	
		}elseif(Files::LockedItem($send, array()) || !is_writable(ROOT.$path.$send)){
		$out.= '<a><li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['file.locked.file'].'" class="list-group-item list-group-item-action"><i class="fa-solid fa-file-lock"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span><span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';	
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $apache)){
			$out.= '<a style="text-decoration:none;color:#0000ff;" href="./files?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'edit='.ROOT.$path.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-solid fa-circle-info"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span><span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($name, $hidden)){
			$out.='';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $code)){
			$out.= '<a style="text-decoration:none;color:#0000ff;" href="./files?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'edit='.ROOT.$path.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-solid fa-code"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $compress)){
			$out.= '<a style="text-decoration:none;color:#29ab87;" href="../download.php?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'path='.ROOT.$path.$send.'&name='.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-sharp fa-solid fa-file-zipper"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $html)){
			$out.= '<a style="text-decoration:none;color:#00ffff" href="./files?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'edit='.ROOT.$path.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-brands fa-html5"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $css)){
			$out.= '<a style="text-decoration:none;color:#9370db;" href="./files?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'edit='.ROOT.$path.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-brands fa-css3"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $js)){
			$out.= '<a style="text-decoration:none;color:#daa520;" href="./files?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'edit='.ROOT.$path.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-brands fa-js"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $txt)){
			$out.= '<a style="text-decoration:none;color:#bebebe;" href="./files?'.(isset($_GET['path']) ? 'path='.$path.'&' : '').'edit='.ROOT.$path.$send.'"><li class="list-group-item list-group-item-action"><i class="fa-solid fa-file-lines"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li></a>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $imgs)){
			$out.= '<li class="list-group-item list-group-item-action" style="color:#cb4154;"><i class="fa-solid fa-image"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)). '</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span></li>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $audio)){
			$out.= '<li class="list-group-item list-group-item-action" style="color:#808080;"><i class="fa-solid fa-file-audio"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i>'.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span></li>';
		}elseif(is_file(ROOT.$path.$send)&&in_array($type, $video)){
			$out.= '<li class="list-group-item list-group-item-action" style="color:#e6e6fa;"><i class="fa-solid fa-file-video"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span><span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i>'.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)).'</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span></li>';
		}else{
			$out.= '<li class="list-group-item list-group-item-action" style="color:#4a5d23;"><i class="fa-solid fa-file"></i> '.$send.' <span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.$path.$send)).'</span>'.Files::ManagerOpts(ROOT.$path.$send).'<span class="text-secondary float-end"><span class="fst-italic"><i class="fa-solid fa-clock"></i> '.date("m/d/Y h:i:sa", filemtime(ROOT.$path.$send)). '</span> | <i class="fa-solid fa-key"></i> '.(Files::Perms(ROOT.$path.$send)).'</span><span class="text-secondary">'.(Files::FullPerms(ROOT.$path.$send)).'</span></li>';
		}
	}
	$out.='</ul>';
		
		if(isset($_GET['chmod'])){
			$out.='<div class="modal d-block" tabindex="-1" id="filemanager">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['file.managerchmod.title'].'</h5>
      </div>
      <div class="modal-body">
	  <form method="post">
    <table class="table">
  <thead>
    <tr>
	<th scope="col"></th>
      <th scope="col">'.$lang['file.managerchmod.u'].'</th>
      <th scope="col">'.$lang['file.managerchmod.g'].'</th>
      <th scope="col">'.$lang['file.managerchmod.o'].'</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$lang['file.managerchmod.read'].'</td>
		<td><div class="form-check">
  <input class="form-check-input" class="read" checked="checked" type="checkbox" value="4" name="read1">
</div>
</td>
			<td><div class="form-check">
  <input class="form-check-input" class="write" checked="checked" type="checkbox" value="4" name="read2">
</div>
</td>
			<td><div class="form-check">
  <input class="form-check-input" class="exec" checked="checked" type="checkbox" value="4" name="read3">
</div>
</td>
    </tr>
    <tr>
      <td>'.$lang['file.managerchmod.write'].'</td>
    	<td><div class="form-check">
  <input class="form-check-input" class="read" checked="checked" type="checkbox" value="2" name="write1">
</div>
</td>
	<td><div class="form-check">
  <input class="form-check-input" class="write" checked="checked" type="checkbox" value="2" name="write2">
</div>
</td>
	<td><div class="form-check">
  <input class="form-check-input" class="exec" checked="checked" type="checkbox" value="2" name="write3">
</div>
</td>
    </tr>
    <tr>
      <td>'.$lang['file.managerchmod.execute'].'</td>
      	<td><div class="form-check">
  <input class="form-check-input" class="read" checked="checked" type="checkbox" value="1" name="exec1">
</div>
</td>
	<td><div class="form-check">
  <input class="form-check-input" class="write" checked="checked" type="checkbox" value="1" name="exec2">
</div>
</td>
	<td><div class="form-check">
  <input class="form-check-input" class="exec" checked="checked" type="checkbox" value="1" name="exec3">
</div>
</td>
    </tr>
  </tbody>
</table>
<input type="submit" name="saveChmod" class="btn btn-success" value="'.$lang['btn.save'].'"/>
</form>


      </div>
      <div class="modal-footer">
        <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
      </div>
    </div>
  </div>
</div>';
		}
#save chmod
if(isset($_POST['saveChmod'])){
	$owner = array((isset($_POST['read1']) ? $_POST['read1'] : 0), (isset($_POST['write1']) ? $_POST['write1'] : 0), (isset($_POST['exec1']) ? $_POST['exec1'] : 0));
	$group = array((isset($_POST['read2']) ? $_POST['read2'] : 0),(isset($_POST['write2']) ? $_POST['write2'] : 0),(isset($_POST['exec2']) ? $_POST['exec2'] : 0));
	$other = array((isset($_POST['read3']) ? $_POST['read3'] : 0), (isset($_POST['write3']) ? $_POST['write3'] : 0), (isset($_POST['exec3']) ? $_POST['exec3'] : 0));
	
	$zero=0;
	$owners = $owner[0]+$owner[1]+$owner[2];
	$groups = $group[0]+$group[1]+$group[2];
	$others = $other[0]+$other[1]+$other[2];
	$mod = array((int)$zero,(int)$owners,(int)$groups,(int)$others);
	echo @chmod($_GET['chmod'],$mod[0].$mod[1].$mod[2].$mod[3]) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
}
if(isset($_GET['delete'])){
	$out.='<div class="modal d-block" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['files.remove.msg'].$_GET['delete'].'?</h5>
      </div>
      <div class="modal-footer">
	  <form method="post">
       <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button></a>
        <button name="deleteFile" type="submit" class="btn btn-danger">'.$lang['btn.confirm'].'</button>
      </form>
	  </div>
    </div>
  </div>
</div>';
}
if(isset($_POST['deleteFile'])){
	if(is_dir($_GET['delete'])){
		echo @Files::removeDir($_GET['delete']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
	}else{
		echo @unlink($_GET['delete']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
	}
}
if(isset($_GET['rename'])){
	preg_match('/(\w+\.\w+)|(\w+\.\w+\.\w+)/', $_GET['rename'], $name);
	$out.='<div class="modal d-block" tabindex="-1">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
	 <form method="post">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['files.rename.msg'].' '.$_GET['rename'].'</h5>
      </div>
	  <div class="modal-body">
	  <div class="row">
	  <div class="col">
	  	  <label for="oldnameID" class="form-label">'.$lang['file.rename.oldName'].'</label>
	  <input id="oldnameID" type="text" class="form-control" readonly="" name="oldname" value="'.$name[0].'"/>
	  </div>
	  </div>
	   <div class="row mt-2">
	  <div class="col">
	  <label for="newnameID" class="form-label">'.$lang['file.rename.newName'].'</label>
	  <input id="newnameID" type="text" class="form-control" name="newname"/>
	  </div>
	  </div>
	  </div>
      <div class="modal-footer">
	  
       <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button></a>
        <button name="renameFile" type="submit" class="btn btn-success">'.$lang['btn.save'].'</button>
      
	  </div>
	  </form>
    </div>
  </div>
</div>';
}
if(isset($_POST['renameFile'])){
	preg_match('/(\w+\.\w+)|(\w+\.\w+\.\w+)/', $_GET['rename'], $name);
	$oldName = isset($_POST['oldname']) ? $_POST['oldname'] : 'error';
	$newName = isset($_POST['newname'])&&$_POST['newname']!=='' ? $_POST['newname'] : $oldName;
	echo @Files::renameFile(str_replace($name,'',$_GET['rename']).$oldName, str_replace($name,'',$_GET['rename']).$newName) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : ''), 'danger');
}
# other
if(isset($_GET['edit'])){
	 preg_match('/((\w+\.\w+\.\w+)|(\w+\.\w+))/', $_GET['edit'], $d);
	 $type = @end(explode('.',$d[0]));
$out.='<div class="modal d-block" tabindex="-1" id="filemanager">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
	<form method="post" style="height: 75%;">
      <div class="modal-header">
        <h5 class="modal-title">'.$lang['file.manager.title'].'</h5>
      </div>
      <div class="modal-body">
       '.$Editor->createEditor('', false, $type, $_GET['edit']).'
      </div>
      <div class="modal-footer">
	  <span class="text-secondary position-absolute start-0">'.(isset($_GET['edit']) ? str_replace('/','\\',$_GET['edit']) : '').'</span>
        <a href="./files'.(isset($_GET['path']) ? '?path='.$_GET['path'] : '').'"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
        <button type="submit" name="saveFile" class="btn btn-success">'.$lang['btn.save'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
}

if(isset($_POST['saveFile'])){
	$data = isset($_POST['editorText']) ? $_POST['editorText'] : '';
	$open = fopen($_GET['edit'], 'w+');
	fwrite($open, $data);
	echo @fclose($open) ? '<div style="z-index:10000;" class="alert alert-success alert-dismissible fade show position-absolute w-100 top-0" role="alert">'.$lang['files.manager.saved'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' : '<div style="z-index:10000;" class="alert alert-danger w-100 position-absolute top-0 alert-dismissible fade show" role="alert">'.$lang['files.manager.error'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	echo '<script>
	setTimeout(function(){
		window.open(window.location.href, "_self");
	}, 3000);
	</script>';
}
	

	
}elseif(preg_match('/\/dashboard(?:\.php)\/(view|view\/)/', $_SERVER['REQUEST_URI'])){
	$out .= Plugin::useHook('view', $_GET['plugins']);
}elseif(preg_match('/\/dashboard(?:\.php)\/(events\/|events)/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('events')){
	$_SESSION['access'] = (isset($_SESSION['access']) ? $_SESSION['access'] : false);
	if($_SESSION['access']){
	$out.='<div class="h-50" style="overflow:auto;"><table class="table">
	<thead class="position-sticky top-0">
	 <tr>
      <th scope="col">'.$lang['events.ip'].'</th>
      <th scope="col">'.$lang['events.date'].'</th>
      <th scope="col">'.$lang['events.target'].'</th>
      <th scope="col">'.$lang['events.stat'].'</th>
	  <th scope="col">'.$lang['events.action'].'</th>
    </tr>
	</thead>
  <tbody>
   ';
   $listen = preg_replace('/(\n|\r|\r\n)/','-',preg_replace('/\n$/','',file_get_contents(ROOT.'/events/listener.event')));
   $expoit = @explode('-',$listen);
   foreach($expoit as $item){
	   $setItem = @explode('|', $item);
	   $out.='<tr>';
	   for($i=0;$i<count($setItem);$i++){
		   $out.='<td>'.$setItem[$i].'</td>';
	   }
	   $out.='</tr>';
	   
   }
   $out.='
	</tbody>
	</table></div>';
}else{
	$out.='<form method="post">
	<label class="form-label">'.$lang['login.token'].'</label>
	<input class="form-control" name="pkey" type="password"/>
	<button class="btn btn-success" name="viewEvents" type="submit">'.$lang['btn.confirm'].'</button>
	</form>';
}
if(isset($_POST['viewEvents'])){
	if(CSRF::check()!=='tokenExpired'&&CSRF::check()!=='invalidKey'){
		$_SESSION['access'] = true;
	}else{
		$_SESSION['access'] = false;
	}
}
}elseif(preg_match('/\/dashboard(?:\.php)\/(pages\/|pages)/', $_SERVER['REQUEST_URI'])&&Users::hasPermission('pages')){
	$out.='<div class="alert alert-danger">'.$lang['pages.form.notice'].'</div>';
	$out.='<ul class="list-group list-group-flush">';
	foreach(Files::Scan(ROOT.'pages') as $pages){
		if(is_file(ROOT.'pages'.DS.$pages)&&preg_match('/\.html$/', $pages)){
			$out.='<li class="list-group-item mt-1 list-group-item-action list-group-item-dark">
			<b>'.$pages.'</b>
			<span class="badge bg-secondary">'.Files::sizeFormat(filesize(ROOT.'pages'.DS.$pages)).'</span>
			<span class="float-end">
			<a target="_blank" href="'.$BASEPATH.DS.'page.php'.DS.Files::removeExtension($pages, '.html').'?editpage"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
			<a target="_blank" href="'.$BASEPATH.DS.'page.php'.DS.Files::removeExtension($pages, '.html').'"><button class="btn btn-info"><i class="fa-solid fa-eye"></i></button></a>
			<a href="'.$BASEPATH.DS.'dashboard.php'.DS.'pages?delete='.Files::removeExtension($pages, '.html').'"><button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></a>
			<button type="button" class="btn btn-secondary" onclick="copyPageURL(\''.((isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on' ? 'https://': 'http://' ).$_SERVER['HTTP_HOST'].DS.MAINDIR.'/page.php/'.$pages).'\')"><i class="fa-solid fa-copy"></i></button>
			</span>
			</li>';
		}
	}
		$out.='</ul>';
		$out.='<div class="modal fade" id="addPage" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5">'.$lang['blocks.page.title'].'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <label class="form-label">'.$lang['blocks.page.name'].'</label>
		<div class="input-group">
        <input type="form-control" name="pageName"/>
		<span class="input-group-text">.html</span>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button>
        <button type="submit" name="makePage" class="btn btn-primary">'.$lang['btn.save'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
		$out.='<button data-bs-toggle="modal" data-bs-target="#addPage" class="btn btn-warning btn-lg w-100 mt-2 mb-2"><i class="fa-solid fa-plus"></i></button>';
	if(isset($_GET['delete'])){
		if(Files::remove($_GET['delete'].'.html', ROOT.'pages'.DS)){
			Files::removeDir(ROOT.'pages'.DS.$_GET['delete']);
			$out.='<script>
			window.history.go(-1);
			</script>';
		}
	}
	if(isset($_POST['makePage'])){
		$page = isset($_POST['pageName'])&&$_POST['pageName']!=='' ? $_POST['pageName'].'.html' : '';
		if($page!==''){
			if(!file_exists(ROOT.'pages'.DS.$page)){
				if(Files::createFile($page, ROOT.'pages'.DS)){
					Files::createFolder(ROOT.'pages'.DS.str_replace('.html','',$page));
					Files::createFile(str_replace('.html','.css',$page), ROOT.'pages'.DS.str_replace('.html','',$page).DS);
					$css = fopen(ROOT.'pages'.DS.str_replace('.html','',$page).DS.str_replace('.html','.css',$page), 'w+');
					fwrite($css,'body{color:rgb(0, 0, 0);background-color:#ffffff;}');
					$out.='<script>
			window.location.reload();
			</script>';
				}
					
			}
		}
	}
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
$rdt = Utils::dateTimeData();
$tdt = Utils::dateTimeData();
$topicCount=0;
$replyCount=0;
foreach(Files::Scan(DATA_TOPICS) as $topics){
	$topics = Files::removeExtension($topics);
	$topic = WebDB::getDB('topics', $topics);
	 preg_match('/\d{4}/',$topic['created'], $year);
	 preg_match('/^\d{2}/', $topic['created'], $month);
	$y=$year[0];
	$m=$month[0];
	if($y===date('Y')){
		$topicCount++;
		$tdt[Utils::dateTime('months')[$m]] = $topicCount . ',';
	}
}
foreach(Files::Scan(DATA_REPLYS) as $replies){
	$replies = Files::removeExtension($replies);
	$reply = @WebDB::getDB('replys', $replies) ? WebDB::getDB('replys', $replies) : false;
	 preg_match('/\d{4}/',$reply['created'], $year);
	 preg_match('/^\d{2}/', $reply['created'], $month);
	$y=$year[0];
	$m=$month[0];
	if($y[0]===date('Y')){
		$replyCount++;
		echo $replyCount;
		$rdt[Utils::dateTime('months')[$m]] = $replyCount . ',';
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
			 text:"'.$lang['dashboard.graph.subtitle'].date('Y', strtotime('+1 years')).'"
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
			 text:"'.$lang['dashboard.graph.subtitle'].date('Y', strtotime('+1 years')).'"
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
$out.='<script>
new Chart("webpress-forums", {
  type: "line",
  data: {
    labels: xVWal,
    datasets: [{
	  label: "'.$lang['dashboard.graph.forums.topics'].'",
	  data:['.preg_replace('/\,$/','',$tdt['jan'].$tdt['feb'].$tdt['mar'].$tdt['apr'].$tdt['may'].$tdt['june'].$tdt['july'].$tdt['aug'].$tdt['sept'].$tdt['oct'].$tdt['nov'].$tdt['dec']).'],
      fill: false,
      lineTension: 0.1,
      backgroundColor: "rgba(16,141,237,1.0)",
      borderColor: "rgba(16,141,237,0.1)",

    },
	{
	  label: "'.$lang['dashboard.graph.forums.replies'].'",
	  data:['.preg_replace('/\,$/','',$rdt['jan'].$rdt['feb'].$rdt['mar'].$rdt['apr'].$rdt['may'].$rdt['june'].$rdt['july'].$rdt['aug'].$rdt['sept'].$rdt['oct'].$rdt['nov'].$rdt['dec']).'],
      fill: false,
      lineTension: 0.1,
      backgroundColor: "rgba(11,226,226,1.0)",
      borderColor: "rgba(11,226,226,0.1)",
  
    }]
  },
  options: {
     plugins: {
		 title:{
			 display:true,
			 fullSize: true,
			 text: "'.$lang['dashboard.graph.forums.label'].'"
		 },
		 subtitle:{
			 display: true,
			 text:"'.$lang['dashboard.graph.subtitle'].date('Y', strtotime('+1 years')).'"
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
			  text: "'.$lang['dashboard.graph.forums.y'].'"
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
echo $out;
}


?>
</body>
</html>