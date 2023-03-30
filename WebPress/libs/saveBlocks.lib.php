<?php
// get the q parameter from URL
$code = $_REQUEST["code"];
$page = $_REQUEST["page"];
$body = $_REQUEST["body"];

$hint = "";


if ($code !== "" && $page !== '') {
      if(file_exists('../pages/'.$page.'.html')){
		  $tempCode = preg_replace('/\<link rel=\"stylesheet\" href=\"\.\.\/pages\/[\w]+\/[\w]+\.css\?v=[\w]+\" contenteditable=\"true\"\>/','',$code);
		  $tempLen = '<link rel="stylesheet" href="../pages/'.$page.'/'.$page.'.css?v='.uniqid().'"/>'.str_replace('/ht/','#',$tempCode);
		if((int)strlen($tempLen)<=5000000){ //5MB
		  $open = fopen('../pages/'.$page.'.html', 'w+');
		  $openCSS = fopen('../pages/'.$page.'/'.$page.'.css', 'w+');
		  $body = str_replace('_quoteicon_','\'',$body);
		  $body = str_replace('_andicon_','&',$body);
		  $body = str_replace('/ht/','#',$body);
		   preg_match('/background-color\:\s?rgb\(\d{1,3},\s?\d{1,3},\s?\d{1,3}\)/', $body, $rgb);
		  $rgb = str_replace(array('rgb(',')',' ','background-color:'), '', $rgb[0]);
		  $r = (int)explode(',',$rgb)[0];
		  $g = (int)explode(',',$rgb)[1];
		  $b = (int)explode(',',$rgb)[2];
		  $hex = sprintf("#%02x%02x%02x", (int)$r, (int)$g, (int)$b);
		 $body = preg_replace('/background-color\:\s?rgb\(\d{1,3},\s?\d{1,3},\s?\d{1,3}\)/', 'background-color:'.str_replace("'","",$hex), $body);
		  $css = 'body{'.preg_replace('/\"/','\'',$body).'}';
		  fwrite($openCSS, $css);
		  fclose($openCSS);
		  $code = preg_replace('/\<link rel=\"stylesheet\" href=\"\.\.\/pages\/[\w]+\/[\w]+\.css\?v=[\w]+\" contenteditable=\"true\"\>/','',$code);
		  preg_match_all('/\{icon=[\w]+\}/', $code, $icons);
		  foreach($icons as $i=>$arg){
			  foreach($arg as $a){
			  $iconType =  explode('=',str_replace(array('}','{'),'',$a))[1];
			  $code = preg_replace('/'.$a.'/', '<i class="fa-solid fa-'.$iconType.'"></i>', $code);
			  }
		  }
		  fwrite($open, '<link rel="stylesheet" href="../pages/'.$page.'/'.$page.'.css?v='.uniqid().'"/>'.str_replace('/ht/','#',$code));
		  fclose($open);  
		  $hint='Saved to '.$page.'.html';
		  }else{
		  $hint=$page.'.html as excedeed over 5MB';
		  }
	
			#$hint = $code;
		  
	  }else{
		  $hint='Page Not Found!';
	  }
}else{
	$hint='';
}

echo $hint === "" ? "failed" :  $hint;
?>