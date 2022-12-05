<?php
function foot($basepath){
	global $pageTitle, $defaultIcon, $conf ,$pageTheme, $lang;
$footer='';
$footer.=Plugin::hook('afterLoad');
$footer.='<footer class="bg-light text-center text-dark position-sticky bottom-0" style="z-index:999;">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 '.(date('Y')==='2022' ? '' : ' - '.date('Y')).' '.$lang['index.label.copyright'].':
    <a class="link-primary" href="#">SurveyBuilderTeams</a> '.$lang['index.label.license'].' <a class="link-primary" href="https://github.com/surveybuilderteams/WebPress/blob/master/LICENSE" target="_blank">MIT</a>
	<section class="mb-0">
      <!-- Github -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #333333;"
        href="https://github.com/surveybuilderteams/" target="_blank"
        role="button"
        ><i class="fab fa-github"></i
      ></a>
	  <!--Website-->
	  <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #1765da;"
        href="#" target="_blank"
        role="button"
        ><?xml version="1.0" encoding="UTF-8" standalone="no" ?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="36" height="36" viewBox="0 0 36 36" xml:space="preserve">
<desc>Created with Fabric.js 3.6.3</desc>
<defs>
</defs>
<g transform="matrix(0.36 0 0 0.36 18.08 18.17)"  >
<linearGradient id="SVGID_366" gradientUnits="userSpaceOnUse" gradientTransform="matrix(1 0 0 1 -40 -40)"  x1="0" y1="40" x2="80" y2="40">
<stop offset="0%" style="stop-color:rgba(0, 0, 0, 1);"/>
<stop offset="0%" style="stop-color:rgba(7, 242, 176, 1);"/>
<stop offset="99.024%" style="stop-color:rgba(6, 239, 250, 1);"/>
<stop offset="100%" style="stop-color:rgba(0, 0, 0, 1);"/>
</linearGradient>
<circle style="stroke: rgb(66,128,66); stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: url(#SVGID_366); fill-rule: nonzero; opacity: 1;"  cx="0" cy="0" r="40" />
</g>
<g transform="matrix(1 0 0 1 17.5 18.54)" style=""  >
		<text xml:space="preserve" font-family="\'Comic Sans MS\', \'Comic Sans\', cursive, sans-serif" font-size="16" font-style="normal" font-weight="bold" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,116,255); fill-rule: nonzero; opacity: 1; white-space: pre;" ><tspan x="-12.58" y="5.03" >WP</tspan></text>
</g>
</svg></a>
    </section>
	'.Plugin::hook('footer').'
  </div>
</footer>';
$footer .= '<script src="'.$basepath.DS.str_replace('{version}', $conf['bootstrap']['version'], $conf['bootstrap']['jsurl']).'?v=1"></script>';
$footer.= '<script src="'.$basepath.DS.str_replace('{version}', $conf['fontawesome']['version'], $conf['fontawesome']['jsurl']).'?v=1"></script>';
$footer.= '<script src="'.$basepath.DS.str_replace('{version}', $conf['notify']['version'], $conf['notify']['jsurl']).'?v=1"></script>';
$footer.='<script src="'.$basepath.DS.str_replace('{version}', $conf['prism']['version'], $conf['prism']['jsurl']).'?v=1"></script>';
$themeSelect = array_diff(scandir('themes/'.$pageTheme.'/js/'), ['.','..']);
$footer .= ($pageTheme!=="default" ? '<script src="'.$basepath.'/themes/default/js/script.js?v='.uniqid().'"></script>' : '');
foreach($themeSelect as $themes){
	$footer.= '<script src="'.$basepath.'/themes/'.$pageTheme.'/js/'.$themes.'?v='.uniqid().'"></script>';
}
	$footer.="<script>
		var emailSelector = [";
		$db = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : array();;
		$i=1;
		foreach($db as $users=>$info){
			if($i<count($db)){
				$comma = ',';
			}else{
				$comma='';
			}
			$footer.='"'.$info['username'].':&lt;'.$info['email'].'&gt;'.'"'.$comma;
		}
		$footer.="];
		</script>";
$footer.='<script>
if(document.querySelector("#toemail")){
	autocomplete(document.querySelector("#toemail"), emailSelector);
}
</script>';
$footer.='<script>
const complete = [';
$searchItem=array();
foreach(Files::Scan(DATA_FORUMS) as $forums){
	$forums = Files::removeExtension($forums);
	array_push($searchItem, '"forum:'.$forums.'"');
}
foreach(Files::Scan(DATA_TOPICS) as $topics){
	$topics = Files::removeExtension($topics);
	$data = WebDB::getDB('topics', $topics);
	foreach(@explode(',',$data['tags']) as $tags){
		array_push($searchItem,'"tags:'.$tags.'"');
	}	
}
foreach(Files::Scan(DATA_TOPICS) as $topics){
	$topics = Files::removeExtension($topics);
	$data = WebDB::getDB('topics', $topics);
	array_push($searchItem, '"topic:'.$data['name'].'"');
}
array_push($searchItem, '"status:Pinned"');
array_push($searchItem, '"status:Locked"');

$footer.=implode(',',$searchItem);
$footer.='];
if(document.querySelector("#search")){
	autocomplete(document.querySelector("#search"), complete);
}
</script>';
$footer.= Plugin::hook('footerJS');
Page::ends();
$footer.='<script>
let displayLoad = document.querySelectorAll(".showLoad");
for(let i=0; i<displayLoad.length;i++){
	displayLoad[i].innerHTML = "'.$lang['dashboard.pageLoaded'].'<i class=\'fa-solid fa-clock\'></i> '.Page::Loaded().'"
}
</script>';

return $footer;	
}
?>
