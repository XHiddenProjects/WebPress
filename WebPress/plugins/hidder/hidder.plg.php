<?php defined('WEBPRESS') or die('WebPress Community');
function hidder_install(){
	$out = '';
	$plugin = 'hidder';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'on',
'version'=>'0.0.1', 
'options'=>array('canDisabled'=>filter_var(false, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN)
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function hidder_replacement($matches){
	global $lang;
	$plugin = 'hidder';
	if(strpos($matches[0],'{hide}')!==FALSE){
		if(!Users::isGuest()){
		$id = 'target'.substr(sha1(uniqid()), 5, 10);
		return '<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#'.$id.'" aria-expanded="false" aria-controls="collapseExample">'.$lang[$plugin.'_showmore'].'</button><div class="collapse" id="'.$id.'"><div class="card card-body">'.$matches[1].'</div></div>';
		}else{
			return '<div class="alert alert-danger">'.$lang[$plugin.'isHide'].'</div>';
		}
	}elseif(strpos($matches[0],'{hidemod}')!==FALSE){
		if(Users::isMod()||Users::isAdmin()){
		$id = 'target'.substr(sha1(uniqid()), 5, 10);
		return '<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#'.$id.'" aria-expanded="false" aria-controls="collapseExample">'.$lang[$plugin.'_showmore'].'</button><div class="collapse" id="'.$id.'"><div class="card card-body">'.$matches[1].'</div></div>';
		}else{
			return '<div class="alert alert-danger">'.$lang[$plugin.'isHideMod'].'</div>';
		}
	}elseif(strpos($matches[0],'{hideuser=')!==FALSE){
		if(Users::getSession()===$matches[1]){
		$id = 'target'.substr(sha1(uniqid()), 5, 10);
		return '<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#'.$id.'" aria-expanded="false" aria-controls="collapseExample">'.$lang[$plugin.'_showmore'].'</button><div class="collapse" id="'.$id.'"><div class="card card-body">'.$matches[2].'</div></div>';
		}else{
			return '<div class="alert alert-danger">'.$lang[$plugin.'isHideUser'].'</div>';
		}
	}
	
	 } 
function hidder_noreplace($matches){
	return $matches[0];
}
function hidder_footerJS(){
	global $lang, $reply;
	$plugin = 'hidder';
	$out='';
	$d= WebDB::getDB('plugins',$plugin.'/plugin');
	if($d['active']&&isset($reply)){
		foreach($reply as $r){
			$rpy=WebDB::getDB('replys', $r);
			if(preg_match_all('/{hide}(.*?){\/hide}/is', $rpy['msg'])){
				  $results = preg_replace_callback('/{hide}(.*?){\/hide}/is', 'hidder_replacement' ,$rpy['msg']);
				 $out.='<script id="hidder_script">
				  let box = document.querySelectorAll(".replyBox");
				  for(let i=0;i<box.length;i++){
					   box[i].innerHTML = box[i].innerHTML.replace(\''.Files::minify(preg_replace_callback('/{hide}(.*?){\/hide}/is', 'hidder_noreplace' ,$rpy['msg']), 'js').'\', \''.$results.'\');
				  }
				  </script>';
			}elseif(preg_match_all('/{hidemod}(.*?){\/hidemod}/is', $rpy['msg'])){
				  $results = preg_replace_callback('/{hidemod}(.*?){\/hidemod}/is', 'hidder_replacement' ,$rpy['msg']);
				 $out.='<script id="hidder_script">
				  let box = document.querySelectorAll(".replyBox");
				  for(let i=0;i<box.length;i++){
					   box[i].innerHTML = box[i].innerHTML.replace(\''.Files::minify(preg_replace_callback('/{hidemod}(.*?){\/hidemod}/is', 'hidder_noreplace' ,$rpy['msg']), 'js').'\', \''.$results.'\');
				  }
				  </script>';
			}elseif(preg_match_all('/{hideuser=(.*?)}(.*?){\/hideuser}/is', $rpy['msg'])){
				  $results = preg_replace_callback('/{hideuser=(.*?)}(.*?){\/hideuser}/is', 'hidder_replacement' ,$rpy['msg']);
				 $out.='<script id="hidder_script">
				  let box = document.querySelectorAll(".replyBox");
				  for(let i=0;i<box.length;i++){
					   box[i].innerHTML = box[i].innerHTML.replace(\''.Files::minify(preg_replace_callback('/{hideuser=(.*?)}(.*?){\/hideuser}/is', 'hidder_noreplace' ,$rpy['msg']), 'js').'\', \''.$results.'\');
				  }
				  </script>';
			}
		}
		
		
	}
	return $out;
}
?>