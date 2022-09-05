<?php
require('config.php');
require('header.php');
global $pageError, $conf;
$type = http_response_code();
$code='';
if($type===400){
	$code=400;
}elseif($type===401){
	$code=401;
}elseif($type===403){
	$code=403;
}elseif($type===404){
	$code=404;
}elseif($type===500){
	$code=500;
}
?>
<html>
<head>
<?php $pageTitle .= ' - '.$type; echo head(); ?>
</head>
<body>
<?php
if($code===400){
echo "{$pageError['400']}";	
}elseif($code===401){
echo "{$pageError['401']}";
}elseif($code===403){
echo "{$pageError['403']}";
}elseif($code===404){
echo "{$pageError['404']}";	
}elseif($code===500){
echo "{$pageError['500']}";
}
?>
</body>
</html>