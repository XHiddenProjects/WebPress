<?php
function checkEmojiSetup(){
	$plugin = 'reactions';
	$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	foreach($d['config']['replies'] as $replys=>$info){
		if(!file_exists(DATA_REPLYS.$replys.'.dat.json')){
			unset($d['config']['replies'][$replys]);
			WebDB::saveDB('plugins', $plugin.'/plugin', $d);
		}
	}
	$setUsers = $d['config']['replies'];
		foreach(Files::Scan(DATA_REPLYS) as $replys){
		$replys = Files::removeExtension($replys);
		$em=array();
		foreach($d['config']['reactions'] as $reaction=>$emoji){
			$em[$reaction] = (isset($d['config']['replies'][$replys][$reaction]) ? (int)$d['config']['replies'][$replys][$reaction] : 0);
		}
		if(isset($d['config']['replies'][$replys]['users'])){
			$d['config']['replies'][$replys]['users'] = $d['config']['replies'][$replys]['users'];
		}else{
			$d['config']['replies'][$replys]['users'] = array();
		}
		$users = isset($d['config']['replies'][$replys]['users']) ? $d['config']['replies'][$replys]['users'] : array();
		$d['config']['replies'][$replys] = $em;
		$d['config']['replies'][$replys]['users'] = $users;
	}
	WebDB::saveDB('plugins', $plugin.'/plugin', $d);
		
}
function reactions_install(){
		$out = '';
	$plugin = 'reactions';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
	'active'=>'',
	'version'=>'2.0.3', 
	'config'=>array(
		'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
		'reactions'=>array(
		'like'=>'/plugins/reactions/icons/like.png',
		'dislike'=>'/plugins/reactions/icons/dislike.png',
		'love'=>'/plugins/reactions/icons/love.png',
		'hate'=>'/plugins/reactions/icons/hate.png',
		'applause'=>'/plugins/reactions/icons/applause.png',
		'wave'=>'/plugins/reactions/icons/wave.png'
		),
		'replies'=>array()
	),
	'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),  
	'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN', 'ru-RU')
	)
	);
	$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
	return $out;
}
function reactionsList($d){
	global $BASEPATH;
	$list='';
	foreach($d['config']['reactions'] as $reaction => $emoji){
		$list.='<div class="d-block">'.$reaction.' <img style="cursor:pointer;" class="rounded-circle img-fluid img-thumbnail" src="'.$BASEPATH.$emoji.'" alt="'.$emoji.'" width="32" height="32"/></div>';
	}
	return $list;
}

function reactions_config(){
	global $lang, $BASEPATH;
	$out = '';
	$plugin = 'reactions';
	$d = WebDB::getDB('plugins', $plugin.'/plugin');
		$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div>
	<div class="row">
	<div class="col border border-2 mt-1 mb-1">
	<h4>'.$lang[$plugin.'_reactionList'].'</h4>
	'.
	reactionsList($d)
	.'
	</div>
	<div class="col">
		<label class="form-label">'.$lang[$plugin.'_reactionName'].'</label>
	<input type="text" id="reactionName" name="reactionName" class="form-control"/>
	<label class="form-label">'.$lang[$plugin.'_reactionIcon'].'</label>
	<div class="input-group">
	<span class="input-group-text">/plugins/reactions/icons/</span>
	<input type="text" id="reactionIcon" readonly="" name="reactionIcon" class="form-control"/>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('reactions_submit', 'reactions_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	return $out;
}
function reactions_onSubmit(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'reactions';
		if(isset($_POST['reactions_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$icon = isset($_POST['reactionIcon'])&&$_POST['reactionIcon']!==''?'/plugins/reactions/icons/'.$_POST['reactionIcon']:'';
			$name = $_POST['reactionName'];
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			if($icon!==''&&$name!==''&&file_exists(ROOT.$icon)){
				$d['config']['reactions'][$name] = $icon;
			}else{
				$d['config']['reactions'] = $d['config']['reactions'];
			} 
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
}
function reactions_beforePage(){
	$plugin = 'reactions';
	if(WebDB::dbExists('plugins', $plugin.'/plugin'))
		checkEmojiSetup();
}
function reactions_bottomReply(){
	global $lang, $BASEPATH, $session, $replyID;
		$out='';
		$plugin = 'reactions';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$out.='<div class="btn-group ms-1 dropup-center dropup">
  <button class="btn btn-warning btn-lg" type="button">
    <i class="fa-solid fa-icons"></i>
  </button>
  <button type="button" class="btn btn-lg btn-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu"><div class="row">';

	if(!Users::isGuest()){
		foreach($d['config']['replies'] as $r=>$count){
			if($r===$replyID){
			$r = WebDB::getDB('replys', $replyID);
			foreach($d['config']['reactions'] as $reaction=>$emoji){
				$out.='<div class="col"><a '.(!isset($d['config']['replies'][$r['id']]['users'][$session]) ? 'href="'.$BASEPATH.DS.'dashboard.php/view?plugins='.$plugin.'&reply='.$r['id'].'&react='.$reaction.'"' : '').'><li><img width="32" height="32" alt="'.$reaction.'" src="'.$BASEPATH.$emoji.'"/>'.$count[$reaction].'</li></a></div>';
				}
			}
		}
	}else{
		$out.='<li class="text-bg-warning">'.$lang[$plugin.'_nouser'].'</li>';
	} 
  $out.='</div></ul>
</div>';
		}
	return $out;
}
function reactions_footerJS(){
	global $lang, $BASEPATH;
		$out='';
		$plugin = 'reactions';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
		$out.='<script src="'.$BASEPATH.'/plugins/reactions/js/reactions.js?v='.$d['version'].'"></script>';	
		}
		return $out;
}
function reactions_view(){
	global $lang, $BASEPATH, $session;
	if(isset($_GET['reply'])&&isset($_GET['react'])){
		$out='';
		$plugin = 'reactions';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			$id = $_GET['reply'];
			$react = $_GET['react'];	
			if(!isset($d['config']['replies'][$id]['users'][$session])){
				$d['config']['replies'][$id][$react] = (int)($d['config']['replies'][$id][$react] + 1);
				$d['config']['replies'][$id]['users'][$session] = $react;
				WebDB::saveDB('plugins', $plugin.'/plugin', $d);
			}
		
			$out.='<script>
			window.history.go(-1);
			</script>';
		}
	}
	return $out;
}
function reactions_replyMsg(){
		global $lang, $BASEPATH, $reply;
		$out='';
		$plugin = 'reactions';
		$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
		if($d['active']){
			
			foreach($d['config']['replies'] as $replys=>$count){
				if($replys===$reply){
				$r = WebDB::getDB('replys', $replys);
				$display=0;
				if($replys===WebDB::getDB('replys',$reply)['id']){
				foreach($d['config']['replies'][$r['id']]['users'] as $name=>$info){
					if($display<5){
					$out.='<div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="'.$name.' has <b>'.$info.'</b>" class="position-relative ms-2"><img width="42" height="42" class="rounded-circle img-fluid" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$name.'.png') ? $BASEPATH.DATA_AVATARS.$name.'.png' : $BASEPATH.DATA_AVATARS.'default.png').'"/> <span class="position-absolute top-0 translate-middle badge rounded-circle">
    <img width="18" height="18" alt="'.$info.'" src="'.$BASEPATH.'/plugins/reactions/icons/'.$info.'.png"/>
  </span></div>';
					$display++;
					}else{
						$out.='';
						$display++;
					}
					
				}
				if($display>5){
					$count = $display - 5;
					$out.='<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$count.' '.$lang[$plugin.'_additonal'].'" class="btn btn-secondary rounded-circle ms-2">'.$count.'+</span>';
				}
				}
			}
		}
	}
		return $out;
}

?>