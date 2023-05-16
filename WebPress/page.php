<?php
require_once('init.php');
require_once('header.php');
require_once('footer.php');
require_once('libs/blocks.lib.php');
?>
<html>
<head>
<?php
$BASEPATH=(!preg_match('/\/page(?:\.php\/)/',$_SERVER['REQUEST_URI']) ? '.' : '..');
if(preg_match('/\/page(?:\.php)\/[\w]+/', $_SERVER['REQUEST_URI'], $title)){
		$base = preg_replace('/\/page(?:\.php)\//','',$title[0]);
	echo head($base, $BASEPATH);	
	}
?>
</head>
<body>
<?php 
global $base, $lang;
echo (isset($_GET['editpage']) ? '<div class="mobileUser alert alert-warning" role="alert" style="display:none"><i class="fa-solid fa-triangle-exclamation"></i> '.$lang['blocks.page.mobileUser'].'</div>' : ''); 
echo Blocks::dropBox(ROOT.'pages'.DS.$base.'.html');
echo Blocks::buildPanel();
echo Blocks::help();
?>
<?php echo foot($BASEPATH)?>
</body>
</html>