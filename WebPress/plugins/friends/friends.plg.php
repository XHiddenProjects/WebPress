<?php defined('WEBPRESS') or die('WebPress Community');
function friends_install(){
	$out = '';
	$plugin = 'friends';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'1.2.1', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN),
	'users'=>array()
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function friends_beforePage(){
	global $lang, $BASEPATH, $session;
	$out = '';
	$plugin = 'friends';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if(isset($d['active'])&&$d['active']){
		if(!isset($d['config']['users'][$session])&&isset($session)&&$session!==''){
			$d['config']['users'][$session] = array(
				'blocked'=>array(),
				'request'=>array(),
				'accepted'=>array()
			);
			WebDB::saveDB('plugins', $plugin.'/plugin', $d);
		}
	}
}
function friends_countFriends($un){
	global $lang;
		$out = '';
	$plugin = 'friends';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if(isset($d['active'])&&$d['active']){
		return '<span class="value">'.count($d['config']['users'][$un]['accepted']).'</span>
		<span class="text-secondary parameter">'.$lang[$plugin.'_name'].'</span>';
	}
}
function friends_dblist(){
		global $lang, $BASEPATH, $session;
	$out = '';
	$plugin = 'friends';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if(isset($d['active'])&&$d['active']){
		$out.='<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'&view=online">'.$lang[$plugin.'_listItem'].'</a>';
	}
	return $out;
}
function friends_profile(){
		global $lang, $BASEPATH, $session;
		$out = '';
	$plugin = 'friends';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::GetDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$out.='<div class="col">
			<a href="./view?plugins=friends'.(isset($_GET['name']) ? '&view=online&blockuser='.$_GET['name']: '').'"><button type="button" class="btn btn-danger">'.$lang[$plugin.'_blockUserLabel'].'</button></a>
			</div>';
	}
	return $out;
}
function friends_view(){
			global $lang, $BASEPATH, $session;
	$out = '';
	$plugin = 'friends';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	$u = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
	$online = WebDB::dbExists('plugins','online/online_hit') ? WebDB::getDB('plugins','online/online_hit') : '';
	if($d['active']){
		$out.='<style>
		.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
			background:rgba(128,128,128, 0.8)!important;
			transition:all 0.5s;
		}
		.nav-pills .nav-link:not(.text-bg-success):hover, .nav-pills>.nav-link:not(.text-bg-success):hover{
			background:rgba(128,128,128, 0.5)!important;
		}
		</style>';
		$out.='<div class="m-2">
	<ul class="nav nav-pills justify-content-center">
  <li class="nav-item ms-2 me-2">
    <a class="nav-link'.($_GET['view']==='online' ? ' active' : '').'" aria-current="page" href="./view?plugins='.$plugin.'&view=online">'.$lang[$plugin.'_online'].'</a>
  </li>
  <li class="nav-item ms-2 me-2">
    <a class="nav-link'.($_GET['view']==='all' ? ' active' : '').'" href="./view?plugins='.$plugin.'&view=all">'.$lang[$plugin.'_all'].'</a>
  </li>
  <li class="nav-item ms-2 me-2">
    <a class="nav-link'.($_GET['view']==='pending' ? ' active' : '').'" href="./view?plugins='.$plugin.'&view=pending">'.$lang[$plugin.'_pending'].'
	<span class="position-absolute translate-middle p-2 bg-danger border border-light rounded-circle" '.(empty($d['config']['users'][$session]['request']) ? 'hidden="hidden"' : '').'>
    <span class="visually-hidden">New Pending</span>
  </span>
	</a>
  </li>
  <li class="nav-item ms-2 me-2">
    <a class="nav-link'.($_GET['view']==='blocked' ? ' active' : '').'" href="./view?plugins='.$plugin.'&view=blocked">'.$lang[$plugin.'_blocked'].'</a>
  </li>
   <li class="nav-item ms-2 me-2">
    <a class="nav-link text-bg-success'.($_GET['view']==='add' ? ' active' : '').'" href="./view?plugins='.$plugin.'&view=add">'.$lang[$plugin.'_add'].'</a>
  </li>
</ul>
		</div>';
		if($_GET['view']==='online'){
			# online friends
			foreach($d['config']['users'][$session]['accepted'] as $friends){
				if(isset($online[$u[$friends]['ip']])){
					$out.='<div style="background-color:rgba(169,169,169, 0.5);" class="row m-2 text-secondary p-2 rounded"><span class="fs-3"><img width="64" height="64" class="img-fluid img-thumbnail" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$friends.'.png') ? $BASEPATH.DS.'uploads'.DS.'avatars'.DS.$friends.'.png' : $BASEPATH.DS.'uploads'.DS.'avatars'.DS.'default.png').'"/>&nbsp;'.(isset($u[$friends]['name']) ? $u[$friends]['name'] : $friends).' <a href="./view?plugins='.$plugin.'&view='.$_GET['view'].'&actionRemoveFriend='.$friends.'" class="float-end link-danger ms-3" style="margin-top:1%;"><i class="fa-solid fa-x"></i></a> <a class="float-end link-info ms-3" style="margin-top:1%;" href="../dashboard.php/mail?to='.$friends.':<'.(isset($u[$friends]['email']) ? $u[$friends]['email'] : '').'>"><i class="fa-solid fa-envelope"></i></a></span></div>';
				}
			}
		}elseif($_GET['view']==='all'){
			# all friends
			if(empty($d['config']['users'][$session]['accepted'])){
					$out.='<div class="row m-2 text-secondary p-2 rounded"><span class="text-center">'.$lang[$plugin.'_noresults'].'</span></div>';
			}else{
				foreach($d['config']['users'][$session]['accepted'] as $friends){
					$out.='<div style="background-color:rgba(169,169,169, 0.5);" class="row m-2 text-secondary p-2 rounded"><span class="fs-3"><img width="64" height="64" class="img-fluid img-thumbnail" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$friends.'.png') ? $BASEPATH.DS.'uploads'.DS.'avatars'.DS.$friends.'.png' : $BASEPATH.DS.'uploads'.DS.'avatars'.DS.'default.png').'"/>&nbsp;'.(isset($u[$friends]['name']) ? $u[$friends]['name'] : $friends).' <a href="./view?plugins='.$plugin.'&view='.$_GET['view'].'&actionRemoveFriend='.$friends.'" class="float-end link-danger ms-3" style="margin-top:1%;"><i class="fa-solid fa-x"></i></a> <a class="float-end link-info ms-3" style="margin-top:1%;" href="../dashboard.php/mail?to='.$friends.':<'.(isset($u[$friends]['email']) ? $u[$friends]['email'] : '').'>"><i class="fa-solid fa-envelope"></i></a></span></div>';
				}
			}
			
		}elseif($_GET['view']==='pending'){
			# pending friends
			$fsent='';
			$fto='';
			if(empty($d['config']['users'][$session]['request'])){
					$out.='<div class="row m-2 text-secondary p-2 rounded"><span class="text-center">'.$lang[$plugin.'norequest'].'</span></div>';
			}else{
				foreach($d['config']['users'] as $users=>$info){
					$fto = isset($info['request']['to']) ? $info['request']['to'] : $fto;
					$fsent = isset($info['request']['sender']) ? $info['request']['sender'] : $fsent;
					
				}
				foreach($d['config']['users'] as $users=>$info){
				
					
						if(isset($info['request']['to'])&&$session===$info['request']['to']){
						#view
						$d1 = date_create(date('Y-m-d', strtotime($d['config']['users'][$fto]['request']['start'].'+5 days')));
						$d2 = date_create(date('Y-m-d'));
						$diff=date_diff($d2,$d1);
						$out.='<div style="background-color:rgba(169,169,169, 0.5);" class="row m-2 text-secondary p-2 rounded"><span class="fs-3"><img width="64" height="64" class="img-fluid img-thumbnail" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$fsent.'.png') ? $BASEPATH.DS.'uploads'.DS.'avatars'.DS.$fsent.'.png' : $BASEPATH.DS.'uploads'.DS.'avatars'.DS.'default.png').'"/>&nbsp;'.(isset($u[$fsent]['name']) ? $u[$fsent]['name'] : $fsent).' 
						('.($diff->format("%a days")).')
						<a href="./view?plugins='.$plugin.'&view='.$_GET['view'].'&actionRemovePending='.$fsent.'" class="float-end link-danger ms-3" style="margin-top:1%;"><i class="fa-solid fa-x"></i></a>
						<a href="./view?plugins='.$plugin.'&view='.$_GET['view'].'&actionAddPending='.$fsent.'" class="float-end link-success ms-3" style="margin-top:1%;"><i class="fa-solid fa-check"></i></a>
						</div>';
					
					}	
						if(isset($info['request']['sender'])&&$session==$info['request']['sender']){
						# senter Requestion
						$d1 = date_create(date('Y-m-d', strtotime($d['config']['users'][$fto]['request']['start'].'+5 days')));
						$d2 = date_create(date('Y-m-d'));
						
						$diff=date_diff($d2,$d1);
						$out.='<div style="background-color:rgba(169,169,169, 0.5);" class="row m-2 text-secondary p-2 rounded"><span class="fs-3"><img width="64" height="64" class="img-fluid img-thumbnail" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$fto.'.png') ? $BASEPATH.DS.'uploads'.DS.'avatars'.DS.$fto.'.png' : $BASEPATH.DS.'uploads'.DS.'avatars'.DS.'default.png').'"/>&nbsp;'.(isset($u[$fto]['name']) ? $u[$fto]['name'] : $fto).' ('.($diff->format("%a days")).')</div>';
						}
				}
			}
		}elseif($_GET['view']==='blocked'){
			# blocked friends
			if(empty($d['config']['users'][$session]['blocked'])){
					$out.='<div class="row m-2 text-danger p-2 rounded"><span class="text-center">'.$lang[$plugin.'noblocked'].'</span></div>';
			}else{
				foreach($d['config']['users'][$session]['blocked'] as $friends=>$orig){
					if($orig==='origin'){
						$out.='<div style="background-color:rgba(169,169,169, 0.5);" class="row m-2 text-secondary p-2 rounded"><span class="fs-3"><img width="64" height="64" class="img-fluid img-thumbnail" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$friends.'.png') ? $BASEPATH.DS.'uploads'.DS.'avatars'.DS.$friends.'.png' : $BASEPATH.DS.'uploads'.DS.'avatars'.DS.'default.png').'"/>&nbsp;'.(isset($u[$friends]['name']) ? $u[$friends]['name'] : $friends).' 
						<a href="./view?plugins='.$plugin.'&view='.$_GET['view'].'&actionRemoveBlock='.$friends.'" class="float-end link-danger ms-3" style="margin-top:1%;"><i class="fa-solid fa-x"></i></a> 
						</div>';
					}else{
						$out.='<div style="background-color:rgba(169,169,169, 0.5);" class="row m-2 text-secondary p-2 rounded"><span class="fs-3"><img width="64" height="64" class="img-fluid img-thumbnail" src="'.(file_exists(ROOT.'uploads'.DS.'avatars'.DS.$friends.'.png') ? $BASEPATH.DS.'uploads'.DS.'avatars'.DS.$friends.'.png' : $BASEPATH.DS.'uploads'.DS.'avatars'.DS.'default.png').'"/>&nbsp;'.(isset($u[$friends]['name']) ? $u[$friends]['name'] : $friends).' 
						</div>';
					}
					
				}
			}
		}elseif($_GET['view']==='add'){
			# add friends
			$out.='<form method="post">
				<div class="form-floating">
  <input type="text"'.(empty($d['config']['users'][$session]['request']) ? '' : ' disabled="disabled" ').' class="form-control" name="friendUser" required id="friendUser" '.(isset($_GET['request']) ? 'value="'.$_GET['request'].'"' : '').' placeholder="'.$lang[$plugin.'addUser'].'">
  <label for="friendUser">'.$lang[$plugin.'addUser'].'</label>
</div>
<button type="submit" class="btn btn-info w-100 mt-2" name="submitFriend">'.$lang[$plugin.'_add'].'</button>
			</form>';
		}
		#actions
		if(isset($_POST['submitFriend'])){
			$un = isset($_POST['friendUser']) ? $_POST['friendUser'] : '';
			if($un===$_SESSION['user']){
				$out.='<p class="text-danger text-center fw-bold">'.$lang[$plugin.'selffriend'].'</p>';
			}elseif(isset($u[$un])){
				if(in_array($un,$d['config']['users'][$session]['accepted'])){
					$out.='<p class="text-danger text-center fw-bold">'.$un.' '.$lang[$plugin.'friendexists'].'</p>';
				}elseif(empty($d['config']['users'][$un]['request'])){
					$d['config']['users'][$session]['request']['to'] = $un;
					$d['config']['users'][$session]['request']['start'] = date('Y-m-d');
					$d['config']['users'][$un]['request']['sender'] = $session;
					$d['config']['users'][$un]['request']['start'] = date('Y-m-d');
				WebDB::saveDB('plugins', $plugin.'/plugin', $d);
				$out.='<p class="text-success text-center fw-bold">'.$lang[$plugin.'userfound'][0].$un.'! '.$lang[$plugin.'userfound'][1].'</p>';
				}else{
				$out.='<p class="text-danger text-center fw-bold">'.$un.' '.$lang[$plugin.'requestbusy'].'</p>';
				}
				
			}else{
				$out.='<p class="text-danger text-center fw-bold">'.$lang[$plugin.'usernotfound'].'</p>';
			}
		}
		if(isset($_GET['blockuser'])){
			if(empty($d['config']['users'][$session]['request'])){
				$d['config']['users'][$session]['blocked'][$_GET['blockuser']] = 'origin';
				$d['config']['users'][$_GET['blockuser']]['blocked'][$session] = $session;
				WebDB::saveDB('plugins',$plugin.'/plugin',$d);
				$out.='<p class="text-success text-center fw-bold">'.$lang[$plugin.'successBan'].$_GET['blockuser'].'!</p>';
			}else{
				$out.='<p class="text-danger text-center fw-bold">'.$lang[$plugin.'usersInRequest'].'</p>';
			}
		
			
		}
		if(isset($_GET['actionRemoveBlock'])){
			if (array_key_exists($_GET['actionRemoveBlock'], $d['config']['users'][$session]['blocked']) !== false) {
			
				 unset($d['config']['users'][$_GET['actionRemoveBlock']]['blocked'][$session]);
				 unset($d['config']['users'][$session]['blocked'][$_GET['actionRemoveBlock']]);
				if(WebDB::saveDB('plugins', $plugin.'/plugin', $d)){
					echo '<script>
					window.open("./view?plugins='.$_GET['plugins'].'&view='.$_GET['view'].'", "_self");
					</script>';
				}
					
				
			}
		}
		if(isset($_GET['actionRemoveFriend'])){
			if (($key = array_search($_GET['actionRemoveFriend'], $d['config']['users'][$session]['accepted'])) !== false) {
				 unset($d['config']['users'][$_GET['actionRemoveFriend']]['accepted'][$key]);
				 unset($d['config']['users'][$session]['accepted'][$key]);
		
			}
			 if(WebDB::saveDB('plugins', $plugin.'/plugin', $d)){
				 echo '<script>
				 window.open("./view?plugins='.$_GET['plugins'].'&view='.$_GET['view'].'", "_self");
				 </script>';
			 }
		}
		if(isset($d['config']['users'][$session]['request']['to']['request']['start'])){
			
			if(strtotime(date('Y-m-d')) >= strtotime(date('Y-m-d', strtotime($d['config']['users'][$session]['request']['start'].'+5 days')))){
				unset($d['config']['users'][$d['config']['users'][$session]['request']['to']]['request']['start']);
				unset($d['config']['users'][$d['config']['users'][$session]['request']['to']]['request']['to']);
				unset($d['config']['users'][$session]['request']['start']);
				unset($d['config']['users'][$session]['request']['sender']);
			
				WebDB::saveDB('plugins', $plugin.'/plugin',$d);
				echo '<script>
					window.open("./view?plugins='.$_GET['plugins'].'&view='.$_GET['view'].'", "_self");
					</script>';
			}
		}
		if(isset($_GET['actionRemovePending'])){
			unset($d['config']['users'][$session]['request']['sender']);
			unset($d['config']['users'][$_GET['actionRemovePending']]['request']['to']);
			unset($d['config']['users'][$session]['request']['start']);
			unset($d['config']['users'][$_GET['actionRemovePending']]['request']['start']);
			WebDB::saveDB('plugins', $plugin.'/plugin',$d);
			 echo '<script>
				 window.open("./view?plugins='.$_GET['plugins'].'&view='.$_GET['view'].'", "_self");
				 </script>';
		}
		if(isset($_GET['actionAddPending'])){
			$d['config']['users'][$session]['accepted'][] = $_GET['actionAddPending'];
			$d['config']['users'][$_GET['actionAddPending']]['accepted'][] = $session;
			unset($d['config']['users'][$session]['request']['sender']);
			unset($d['config']['users'][$_GET['actionAddPending']]['request']['to']);
			WebDB::saveDB('plugins', $plugin.'/plugin',$d);
			 echo '<script>
				 window.open("./view?plugins='.$_GET['plugins'].'&view='.$_GET['view'].'", "_self");
				 </script>';
		}
	
	return $out;
}
}
?>