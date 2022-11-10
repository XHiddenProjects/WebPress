<?php
require_once('config.php');
require_once('header.php');
global $pageError, $conf;
preg_match('/[\d]+/', $_SERVER['REQUEST_URI'], $type);
$type = $type[0];
$code=$type;
?>
<html>
<head>
<?php $pageTitle .= ' - '.$type; echo head(); ?>
</head>
<body>
<?php
global $code;
if((int)$code===400){
echo $pageError['400'];	
}elseif((int)$code===401){
echo $pageError['401'];
}elseif((int)$code===403){
echo $pageError['403'];
}elseif((int)$code===404){
echo $pageError['404'];	
}elseif((int)$code===500){
echo $pageError['500'];
}
?>
</body>
</html>