<?php
# check valid PHP library
if(!extension_loaded('gd')){
	echo 'You must have "gd" enabled';
	return false;
}
if(!extension_loaded('json')){
	echo 'You must have "json" enabled';
	return false;
}
if(!extension_loaded('mbstring')){
	echo 'You must have "mbstring" enabled';
	return false;
}

date_default_timezone_set("America/New_York");
# defination
$removeSERVER = str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']);
$root = str_replace('\\','/',str_replace($removeSERVER,'',__DIR__));



# installations
if(!is_dir('data')||!file_exists('data/')){
	mkdir('data/');
}
if(!is_dir('data/users')||!file_exists('data/users/')){
 mkdir('data/users');
}
if(!is_dir('data/plugins')||!file_exists('data/plugins/')){
	 mkdir('data/plugins');
}
if(!is_dir('data/themes')||!file_exists('data/themes/')){
	 mkdir('data/themes');
}
if(!is_dir('data/mail')||!file_exists('data/mail')){
	 mkdir('data/mail');
}
if(!is_dir('api')||!file_exists('api/')){
	 mkdir('api/');
}
#defined
!defined('DS') ? define('DS', '/') : '';
!defined('ROOT') ? define('ROOT', __DIR__.DS) : '';
$BASEPATH = '.';


!defined('DATA_USERS') ? define('DATA_USERS', ROOT.'data'.DS.'users'.DS) : '';
!defined('DATA_PLUGINS') ? define('DATA_PLUGINS', ROOT.'data'.DS.'plugins'.DS) : '';
!defined('DATA_THEMES') ? define('DATA_THEMES', ROOT.'data'.DS.'themes'.DS) : '';
!defined('DATA_MAIL') ? define('DATA_MAIL', ROOT.'data'.DS.'mail'.DS) : '';
!defined('DATA_UPLOADS') ? define('DATA_UPLOADS', ROOT.'uploads'.DS) : '';
!defined('DATA_AVATARS') ? define('DATA_AVATARS', '/uploads'.DS.'avatars'.DS) : '';
!defined('DATA_CONFIG') ? define('DATA_CONFIG', $BASEPATH.'/conf'.DS) : '';
!defined('DATA') ? define('DATA', ROOT.'data'.DS) : '';
#Project Info
!defined('PROJECT_NAME') ? define('PROJECT_NAME', 'WebPress') : '';
!defined('PROJECT_BUILD') ? define('PROJECT_BUILD', '220626 <span class="text-secondary" style="font-size:12px;">'.date('d (F) Y', strtotime('22-06-26')).'</span>') : '';
!defined('PROJECT_VERSION') ? define('PROJECT_VERSION', file_get_contents(ROOT.'VERSION')) : '';
!defined('WEBPRESS') ? define('WEBPRESS', true) : ''; # Use for plugins
require_once('init.php');

	 
#config(run JSON)
$conf = json_decode(file_get_contents('conf/config.dat.json'), true);
$defaultIcon = $conf['page']['page-icon']['16'];
$appleIcon = $conf['page']['page-icon']['64'];
$pageTitle = $conf['page']['page-title'];
$pageError = $conf['page']['errors'];
$pageTheme = $conf['page']['themes'];
$captchaSettings = $conf['page']['captcha']['settings'];
/*language*/
$selLang = $conf['lang'];

function errormsg($errno, $errstr, $errfile, $errline, $errcontext){
	echo '<div class="alert alert-danger"><i class="fas fa-times-circle"></i> '.$errstr.'</div>';
}
function noticemsg($errno, $errstr, $errfile, $errline, $errcontext){
	echo '<div class="alert alert-warning"><i class="fas fa-exclamation-circle"></i> '.$errstr.'</div>';
}
//set error handler
if (isset($conf['debug'])) {
    ini_set('error_log', ROOT . 'debug.log');
    if ($conf['debug'] === true) {
        error_reporting(E_ALL | E_STRICT | E_NOTICE);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        ini_set("track_errors", 1);
        ini_set('html_errors', 1);
    } elseif ($conf['debug'] === false) {
        error_reporting(0);
        ini_set('display_errors', false);
        ini_set('display_startup_errors', false);
    }
}
#global variable
$plugins = array_diff(scandir(ROOT.'plugins'.DS), ['.','..']);
$themes = array_diff(scandir(ROOT.'themes'.DS), ['.','..']);
$session = isset($_SESSION['user']) ? $_SESSION['user'] : '';
$token = str_replace('=','',base64_encode(md5($session)));


function langpack(){
	global $lang;
	return array('en-US'=>$lang['lang']['en-US']);
}

?>