<?php defined('WEBPRESS') or die('WebPress Community');
function scrolltop_install(){
	$out = '';
	$plugin = 'scrolltop';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'1.1.0', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'design'=>'up-arrow'
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function scrolltop_config(){
	global $lang, $BASEPATH;
	$out = '';
	$plugin = 'scrolltop';
	$data = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($data['active']){
		  $design = Files::Scan(ROOT.'plugins'.DS.$plugin. DS. 'assets');
		       # On met en place un compteur pour notre ID unique de chaque image
			   $i=0;
		       $allTypes = '<ul class="picSelect">';
			   foreach($design as $type)
			   {
				  $info = pathinfo($type);
				  $filename = $info['filename'];
				  $allTypes .= '<li><input name="design" value="' .$type. '" type="radio" id="cb'.$i.'"' .($data['config']['design']==$type ? ' checked="checked"' : ''). ' />
				  <label for="cb'.$i.'"><img src="' .$BASEPATH.DS.'plugins'.DS.$plugin. DS. 'assets' . DS . $type. '" alt="' .$lang[$type]. '" /></label></li>';
				  $i++;
			   }
			   $allTypes .= '</ul>'; 
	                  
               $out .= HTMLForm::form(CONFIG_SAVE.$plugin.'',
               HTMLForm::checkBox('form_active', $data['active']).
               '<h6>' .$lang['design']. '</h6>'.
               $allTypes.               
               #HTMLForm::select('design', array_combine($design, $design), $data['design']).        
               HTMLForm::simple_submit('scrolltop_submit','scrolltop_submit'));
	}
	return $out;
}
function scrolltop_head()
{
	global $cur, $BASEPATH;
  	$plugin = 'scrolltop';
  	# Lecture des données
  	$data = WebDB::getDB('plugins', $plugin.'/plugin');
  	$out = '';
  	if (Users::isAdmin() && $cur=='scrolltop') $out .= '<style type="text/css">
ul.picSelect {
  width: 100%;
  margin: 0;
  list-style-type: none;
}

.picSelect li {
  display: inline-block;
}

.picSelect input[type="radio"][id^="cb"] {
  display: none;
}

.picSelect label {
  border: 1px solid #fefefe;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

.picSelect label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid #5764C6;
  position: absolute;
  top: -10px;
  left: -10px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 23px;
  transition-duration: 0.4s;
  transform: scale(0);
}

.picSelect label img {
  height: 48px;
  width: 48px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

.picSelect :checked + label {
  border-color: #5764C6;
}

.picSelect :checked + label:before {
  content: "✓";
  background-color: #5764C6;
  transform: scale(1);
}

.picSelect :checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
} 	
  	</style>';
  	if ($data['active']) $out .= '  <style type="text/css">.to-top{display:inline-block;z-index:2000;height:40px;width:40px;position:fixed;bottom:40px;right:10px;overflow:hidden;text-indent:100%;white-space:nowrap;background:url(' .$BASEPATH.DS.'plugins'.DS.$plugin. DS. 'assets' . DS . $data['config']['design']. ') center 50% no-repeat;visibility:hidden;opacity:0;-webkit-transition:all .3s;-moz-transition:all .3s;transition:all .3s}.to-top.top-is-visible{visibility:visible;opacity:1}.to-top.top-fade-out{opacity:.5}.no-touch .to-top:hover{background-color:#e86256;opacity:1}@media only screen and (min-width:768px){.to-top{right:20px;bottom:20px}}@media only screen and (min-width:1024px){.to-top{height:60px;width:60px;right:30px;bottom:30px}}</style>'.PHP_EOL;
  
  	return $out;
}
function scrolltop_onSubmit(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'scrolltop';
		if(isset($_POST['scrolltop_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$design = isset($_POST['design']) ? $_POST['design'] : '';
			
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['design'] = $design;
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
	
}
 function scrolltop_footerJS() { 
	global $lang;
  	$plugin = 'scrolltop';
  	# Lecture des données
  	$data = WebDB::getDB('plugins', $plugin.'/plugin'); 
  	$out = '';

	if ($data['active']) {  	
	# javascript
	$out .= '	<a href="#0" class="to-top" title="' .$lang['top']. '">' .$lang['top']. '</a>'.PHP_EOL;
    $out .= '	<script>$(document).ready(function(t){var o=t(".to-top");t(window).scroll(function(){300<t(this).scrollTop()?o.addClass("top-is-visible"):o.removeClass("top-is-visible top-fade-out"),1200<t(this).scrollTop()&&o.addClass("top-fade-out")}),o.on("click",function(o){o.preventDefault(),t("body,html").animate({scrollTop:0},700)})});</script>'.PHP_EOL;
	}
	return $out;  
}
?>