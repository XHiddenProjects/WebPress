<?php
//image.php
function createCaptcha($w=200, $h=38, $bgr=128, $bgg=128, $bgb=128, $cr=0, $cg=0, $cb=0, $size=20, $angle=0){
session_start();

$random_alpha = md5(rand());

$captcha_code = substr($random_alpha, 0, 6);

$_SESSION['captcha_code'] = $captcha_code;

header('Content-Type: image/jpeg');

$image = imagecreatetruecolor($w, $h);

$background_color = imagecolorallocate($image, $bgr, $bgg, $bgb); # r,g,b

$text_color = imagecolorallocate($image, $cr, $cg, $cb); # rbg

imagefilledrectangle($image, 0, 0, $w, $h, $background_color);

$font = dirname(dirname(__dir__)).'/themes/default/fonts/arial.ttf';
imagettftext($image, $size, $angle, 60, 28, $text_color, $font, $captcha_code);

imagepng($image);

imagedestroy($image);	
}

if(isset($_GET['captcha'])){
	$plus = str_replace(' ','+', $_GET['captcha']);
	$attr = preg_replace('/(\w.+|\w)\-/','',explode('+', $plus));
	createCaptcha((int)$attr[0],(int)$attr[1],(int)$attr[2],(int)$attr[3],(int)$attr[4],(int)$attr[5],(int)$attr[6],(int)$attr[7],(int)$attr[8],(int)$attr[9]);
}

?>