	<?php
	session_start();
	require_once('libs/plugin.lib.php');
	require_once('libs/users.lib.php');
	require_once('libs/utils.lib.php');
	require_once('libs/webdb.lib.php');
	require_once('libs/events.lib.php');
	require_once('libs/files.lib.php');
	require_once('libs/Parsedown.lib.php');
	require_once('libs/ParsedownExtra.lib.php');
	require_once('libs/BBlight.lib.php');
	require_once('libs/BBcode.lib.php');
	require_once('libs/wysiwyg.lib.php');
	require_once('libs/Editor.lib.php');
	require_once('libs/CSRF.lib.php');
	require_once('libs/Captcha.lib.php');
	require_once('libs/HTMLForm.lib.php');
	require_once('libs/toolkit.lib.php');
	require_once('libs/forum.lib.php');
	require_once('libs/Pagination.lib.php');
	require_once('libs/page.lib.php');
	require_once('libs/encryption.lib.php');

	if(file_exists(ROOT.'webpress.pro.php'))
		require_once(ROOT.'webpress.pro.php');

	global $conf, $selLang, $plugins, $lang;
	require_once('lang/'.$selLang.'.php');
	Page::start();
	CSRF::checkBadPlugin();
	foreach(Files::Scan(ROOT.'themes') as $theme){
		CSRF::checkBadTheme($theme); 
	}
	date_default_timezone_set($conf['page']['defaultTimeZone']);
	foreach($plugins as $plugin){
		if(!file_exists(ROOT.'plugins'.DS.$plugin.DS.'lang'.DS.$conf['lang'].'.php')){
			echo 'You are required to have '.$conf['lang'].'.php for "'.$plugin.'"';
		}else{
			include_once(ROOT.'plugins'.DS.$plugin.DS.'lang'.DS.$conf['lang'].'.php');
			include_once(ROOT.'plugins'.DS.$plugin.DS.$plugin.'.plg.php');
				
				}	
				
	}


	CSRF::renewKey();
	$parseMD = new ParsedownExtra();
	$parseBB = new BBcode();
	$parseBBL= new BBlight();
	$Editor = new Editor();

	Users::isProVersion() ? '@webpress.com' : $conf['allowedEmail'];


	 if(!file_exists('data/mail/welcome.dat.json')&&isset($_SESSION['user'])){
			 $open = fopen('data/mail/welcome.dat.json', 'w+');
			 $data = WebDB::getDB('users', 'users');
			 $msg = json_encode(array('msg'=>array('subject'=>'Welcome to WebPress', 'from'=>array('name'=>'Server', 'email'=>'&lt;server@webpress.com&gt;'), 'to'=>array('Server'=>'&lt;server@webpress.com&gt;',$_SESSION['user']=>'&lt;'.$data[$_SESSION['user']]['email'].'&gt;'), 'text'=>'Welcome to <b>WebPress</b>, this is a fun and excited place to make your own CMS and forum-script!' ,'sentTime'=>date('m-d-Y h:i:sa'), 'status'=>'new', 'replys'=>array())),JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
			 fwrite($open, $msg);
			 fclose($open);
		 }


	if(Users::getSession()){
		$d = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		$_SESSION['role'] = isset($d[Users::getSession()]['type']) ? $d[Users::getSession()]['type'] : '';
		if($d[Users::getSession()]['ip']!==Users::getRealIP()){
			$d[Users::getSession()]['ip'] = Users::getRealIP();
			WebDB::saveDB('users', 'users', $d) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/', 'success') : '';
		}
	}

	if(!isset($_SESSION['user'])){
		$_SESSION['guest'] = 'guest';
	}else{
		unset($_SESSION['guest']);
	}

	/*move on*/
	if(Users::isBanned()){
		global $lang;
		$banned = WebDB::DBexists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		if(strtotime(date('m/d/Y H:i:s')) >= strtotime($banned[Users::getSession()]['ban']['time'])&&$banned[Users::getSession()]['ban']['time']!==(int)'-1'){
			$banned[Users::getSession()]['ban']['isBanned'] = filter_var(false, FILTER_VALIDATE_BOOLEAN);
			$banned[Users::getSession()]['ban']['reason'] = '';
			$banned[Users::getSession()]['ban']['time'] = '';
			$banned[Users::getSession()]['ban']['duration'] = '';
			$banned[Users::getSession()]['ban']['bannedBy'] = '';
			echo WebDB::saveDB('users', 'users', $banned) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard', 'success') : '';
		}else{
			if(!preg_match('/\/dashboard(?:\.php)\/(mail\/|mail)/', $_SERVER['REQUEST_URI'])){
				echo '<script>
				window.addEventListener("load", function(){
					let links = document.querySelectorAll("a[href]:not(.urlban):not(footer a)");
				for(let i=0;i<links.length;i++){
					links[i].removeAttribute("href");
					}
				});
				</script>';
				switch($banned[Users::getSession()]['ban']['bannedBy']){
					case 'username':
						if(Users::getSession()===$banned[Users::getSession()]['username'])
							echo '<style>body{overflow:hidden;}.bannedMsg{font-size:86px;}</style><div class="alert alert-danger text-center w-100 h-100"><span class="fw-bold position-absolute top-50 start-50 translate-middle bannedMsg">'.$lang['ban.label'].'<br/><span class="fst-italic fw-normal" style="font-size:32px;">'.$lang['ban.reasonLabel'].': '.$banned[Users::getSession()]['ban']['reason'].'</span><br/><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['ban.orgtimeLabel'].': '.$banned[Users::getSession()]['ban']['orgtime'].'" class="fst-italic fw-normal" style="font-size:32px;cursor:help;">'.$lang['ban.unbanbyLabel'].': '.($banned[Users::getSession()]['ban']['time']===(int)'-1' ? $lang['ban.list']['forever'] : $banned[Users::getSession()]['ban']['time']).'</span><a class="link-primary d-block urlban" href="/'.MAINDIR.'/dashboard.php/mail">'.$lang['ban.request'].'</a></span></div>';                
					break;
					case 'ip':
						if(Users::getRealIP()===$banned[Users::getSession()]['ip'])
							echo '<style>body{overflow:hidden;}.bannedMsg{font-size:86px;}</style><div class="alert alert-danger text-center w-100 h-100"><span class="fw-bold position-absolute top-50 start-50 translate-middle bannedMsg">'.$lang['ban.label'].'<br/><span class="fst-italic fw-normal" style="font-size:32px;">'.$lang['ban.reasonLabel'].': '.$banned[Users::getSession()]['ban']['reason'].'</span><br/><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['ban.orgtimeLabel'].': '.$banned[Users::getSession()]['ban']['orgtime'].'" class="fst-italic fw-normal" style="font-size:32px;cursor:help;">'.$lang['ban.unbanbyLabel'].': '.($banned[Users::getSession()]['ban']['time']===(int)'-1' ? $lang['ban.list']['forever'] : $banned[Users::getSession()]['ban']['time']).'</span><a class="link-primary d-block urlban" href="/'.MAINDIR.'/dashboard.php/mail">'.$lang['ban.request'].'</a></span></div>';
					break;
					case 'hardwareid':
						if(Users::hardwareID()===$banned[Users::getSession()]['id'])
							echo '<style>body{overflow:hidden;}.bannedMsg{font-size:86px;}</style><div class="alert alert-danger text-center w-100 h-100"><span class="fw-bold position-absolute top-50 start-50 translate-middle bannedMsg">'.$lang['ban.label'].'<br/><span class="fst-italic fw-normal" style="font-size:32px;">'.$lang['ban.reasonLabel'].': '.$banned[Users::getSession()]['ban']['reason'].'</span><br/><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['ban.orgtimeLabel'].': '.$banned[Users::getSession()]['ban']['orgtime'].'" class="fst-italic fw-normal" style="font-size:32px;cursor:help;">'.$lang['ban.unbanbyLabel'].': '.($banned[Users::getSession()]['ban']['time']===(int)'-1' ? $lang['ban.list']['forever'] : $banned[Users::getSession()]['ban']['time']).'</span><a class="link-primary d-block urlban" href="/'.MAINDIR.'/dashboard.php/mail">'.$lang['ban.request'].'</a></span></div>';
					break;
				}
			}
			
		}
		
	}

	function head($subtitle=null,$basePath='.'){
		global $session;
		echo Plugin::hook('init');
		if($session!==null||!isset($_SESSION['user'])){
				if(WebDB::DBexists('users', 'views')||WebDB::getDB('users', 'views')!==null){
			$views = WebDB::getDB('users', 'views');
			isset($views[date('Y')][date('m')]['views']) ? $views[date('Y')][date('m')]['views'] = intval($views[date('Y')][date('m')]['views']) + 1 : $views[date('Y')][date('m')]['views'] = 1;
			$array = isset($views[date('Y')][date('m')]['unique']) ? $views[date('Y')][date('m')]['unique'] : $views[date('Y')][date('m')]['unique']=array((isset($_SESSION['user']) ? $_SESSION['user'] : '')=>"");
			
				$session = isset($_SESSION['user']) ? $_SESSION['user'] : '';
				if(!$session===""||!in_array($session, $array)){
					array_push($views[date('Y')][date('m')]['unique'], $session) ? '' : 'failed to add';
				}
			
			$saveViews = json_encode($views, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
			file_put_contents(DATA_USERS.'views.dat.json', $saveViews);
		}else{
			$views = array(date('Y')=>array(date('m')=>array('views'=>1, 'unique'=>array($_SESSION['user']))));
			$saveViews = json_encode($views, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
			!WebDB::DBexists('users', 'views') ? WebDB::makeDB('users', 'views') : '';
			file_put_contents(DATA_USERS.'views.dat.json', $saveViews);
			}
		}

		$timezone = !gettype(Users::ipInfo(Users::getRealIP(), 'timezone')) ? Users::ipInfo(Users::getRealIP(), 'timezone') : 'America/New_York';
	date_default_timezone_set($timezone);
		global $pageTitle, $defaultIcon, $appleIcon, $conf, $pageTheme, $lang;
	$header='';
	$email = '';
	$db = @WebDB::dbExists('USERS', 'users') ? WebDB::getDB('USERS', 'users') : [];
	foreach($db as $u => $data){
		if($data['type'] === 'admin'){
			$email = $data['email'];
		}
	}
	if(version_compare(PHP_VERSION,'7.4', '<')){
		echo '<div style="position:absolute;top:0;left:0;background-color:gray;width:100%;height:100%;z-index:5000;">
		<h1 style="text-align:center;position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size:72px;color:#00ffff;">You must have PHP 7.4 or later</h1>
		</div>'; 
	}else{
	$header .= '<html lang="'.Users::getLang().'">
	<head>
	<meta charset="'.$conf['page']['charset'].'">
	<meta name="viewport" content="width=device-width, initial-scale=1">';
	$header.='<meta name="description" content="'.Page::summary($conf['page']['description'][Users::getLang()], 157).'"/>';
	$header.='<meta name="author" content="'.$conf['page']['author'].'"/>';
	$header .= $conf['page']['refresh']>0 ? '<meta http-equiv="refresh" content="'.$conf['page']['refresh'].'"/>' : '';
	$header .= '<meta name="keywords" content="'.$conf['page']['keywords'].'"/>';
	$header.= '<meta name="robots" content="'.($conf['page']['robots']['index'] ? 'index' : 'noindex').', '.($conf['page']['robots']['follow'] ? 'follow' : 'nofollow').'"/>';
	$header.= $conf['page']['rating']!=="null" ? '<meta name="rating" content="'.$conf['page']['rating'].'"/>' : '';
	$header.='<meta name="buildcopyright" content="XHiddenProjects(WebPress)"/>';
	$header .= $conf['page']['copyright']!=='' ? '<meta name="copyright" content="'.$conf['page']['copyright'].'"/>' : '';
	$header .= '<meta http-equiv="content-language" content="'.strtoupper(Users::getLang()).'">';
	$header .= '<meta name="email" content="'.$email.'"/>';
	$header .= '<meta name="Distribution" content="'.$conf['page']['distribution'].'">';
	$header .= '<meta name="Revisit-after" content="'.$conf['page']['revisted'].'"/>';
	$header.= '<noscript><div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> '.(isset($lang['index.noScript']) ? $lang['index.noScript'] : '').'</div></noscript>';
	$header .='<title>'.(isset($pageTitle) ? $pageTitle : 'Home').(isset($subtitle)||$subtitle!==null ? ' - '.$subtitle : '').' - WebPress</title>';
	$header .='<link rel="shortcut icon" type="image/png" href="'.$basePath.DS.(isset($defaultIcon) ? $defaultIcon : '').'"/>';
	$header .= '<link rel="apple-touch-icon" type="image/png"  sizes="57x57" href="'.$basePath.DS.(isset($appleIcon) ? $appleIcon : '').'"/>';
	$header .= '<link rel="apple-touch-icon" type="image/png" sizes="72x72" href="'.$basePath.DS.(isset($conf['page']['page-icon']['96']) ? $conf['page']['page-icon']['96'] : '').'"/>';
	$header .= '<link rel="apple-touch-icon" type="image/png" sizes="114x144" href="'.$basePath.DS.(isset($conf['page']['page-icon']['128']) ? $conf['page']['page-icon']['128'] : '').'"/>';
	$header .= '<script src="'.$basePath.DS.str_replace('{version}', $conf['jquery']['version'], $conf['jquery']['jsurl']).'"></script>';
	$header .= '<link rel="stylesheet" href="'.$basePath.DS.str_replace('{version}', $conf['fontawesome']['version'], $conf['fontawesome']['cssurl']).'"/>';
	$header .= '<link rel="stylesheet" href="'.$basePath.DS.str_replace('{version}', $conf['bootstrap']['version'], $conf['bootstrap']['cssurl']).'"/>';
	$header .= '<link rel="stylesheet" href="'.$basePath.DS.str_replace('{version}', $conf['prism']['version'], $conf['prism']['cssurl']).'"/>';
	$header.= '';
	$header.='<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
	isset($conf['page']['public'])&&!$conf['page']['public'] ? $header.='<script>window.open('.$BASEPATH.'/, "_blank")</script>' : '';
	$header.= ($pageTheme!=="default" ? '<link rel="stylesheet" href="'.$basePath.'/themes/default/css/style.css?v='.uniqid().'"></link>' : '');
	$themeSelect = array_diff(scandir('themes/'.$pageTheme.'/css/'), ['.','..']);
	foreach(Files::Scan(DATA_THEMES) as $themes){
		if(!isset($_SESSION['themecache'])){
			@mkdir(DATA_THEMES.$themes);
			WebDB::makeDB('themes', $themes.'/theme', '.conf.json');
			Files::copyFile(ROOT.'themes'.DS.$themes.DS.'theme.conf.json', DATA_THEMES.$themes.DS.'theme.conf.json');
		}
	}
	$_SESSION['themecache'] = 'themes';

	foreach($themeSelect as $themes){
		$getDB = WebDB::getDB('themes', $pageTheme.'/theme', '.conf.json');
		if($getDB['active']){
		$header.= '<link rel="stylesheet" href="'.$basePath.'/themes/'.$pageTheme.'/css/'.$themes.'?v='.uniqid().'"></link>';	
		}
	}
	$header.= Plugin::hook('head');
	$header.='</head>';
	$header.='<body>';
	$header .= Plugin::hook('beforePage');
	return $header;	
	}
	}
	?>
