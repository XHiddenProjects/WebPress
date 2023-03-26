	<?php defined('WEBPRESS') or die('Webpress community');

	include_once('webdb.lib.php');
	include_once('files.lib.php');
	include_once('events.lib.php');
	if(isset($_SESSION['user_lang'])){
	include_once(ROOT.'lang'.DS.$_SESSION['user_lang'].'.php');
	}

	$langs = (isset($lang) ? $lang : '');
	class Forum{
		protected function __construct(){

		}
		
		protected static function generate_id($salt=4){
			return substr(strtr(bin2hex(random_bytes($salt)), '+', '.'), 0, 44);
		}
		protected static function generate_ProfileID(){		
			return substr(sha1(mt_rand()),17,6);
		}
		protected static function generate_imgVer(){
			return substr(sha1(uniqid()),0,4);
		}
		protected static function replyID(){
			return date('Y-m').'-'.date('d').substr(self::generate_id(), 0, 10);
		}
		protected static function getTopicsByForum($forumName){
			$forum = array();
			foreach(Files::Scan(DATA_TOPICS) as $topics){
					$topics = str_replace('.dat.json','',$topics);
					$info = WebDB::getDB('topics', $topics);
					if($info['forum']===$forumName){
						$forum[] = $topics;
					}
			}
			return count($forum);
		}
		protected static function getReplysByTopic($topic){
			$reply = array();
			foreach(Files::Scan(DATA_REPLYS) as $replys){
				$replys = str_replace('.dat.json','',$replys);
				$info = WebDB::getDB('replys', $replys);
				if($info['topic']===$topic){
					$reply[] = $replys;
				}
			}
			return count($reply);
		}
		public static function getTopicsByID($id){
			foreach(Files::Scan(DATA_TOPICS) as $topics){
				$topics = Files::removeExtension($topics);
				if(strpos($topics, $id)){
					return $topics;
				}
			}
		}
		public static function number_abbr($number)
	{
		$abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

		foreach ($abbrevs as $exponent => $abbrev) {
			if (abs($number) >= pow(10, $exponent)) {
				$display = $number / pow(10, $exponent);
				$decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
				$number = number_format($display, $decimals).$abbrev;
				break;
			}
		}

		return $number;
	} 
	public static function usersData($name, $type){
			$counter=0;
			if($type==='topics'){
				foreach(Files::Scan(DATA_TOPICS) as $topics){
					$topic = Files::removeExtension($topics);
					$db = WebDB::getDB('topics',$topic);
					if($db['author']===$name){
						$counter++;
					}else{
						$counter=$counter;
					}
				}
				return $counter;
			}elseif($type==='replys'){
				foreach(Files::Scan(DATA_REPLYS) as $replys){
					$replys = Files::removeExtension($replys);
					$db = WebDB::getDB('replys',$replys);
					if($db['author']===$name){
						$counter++;
					}else{
						$counter=$counter;
					}
				}
				return $counter;
			}
		}
		public static function listForums(){
			global $langs, $BASEPATH;
			$out='';
			$lists=array();
			foreach(Files::Scan(DATA_FORUMS) as $forums){
				$forums = str_replace('.dat.json', '', $forums);
				$forumDB = WebDB::getDB('forums', $forums);
				$lists[(string)$forumDB['val']] = '<a href="'.$BASEPATH.'/forum.php/forum/'.$forumDB['name'].'" style="text-decoration:none;"><li class="nav-item"><i style="color:'.$forumDB['tagColor'].'!important;" class="'.$forumDB['tagIcon'].'"></i> <span style="color:'.$forumDB['tagColor'].'";>'.$forumDB['name'].'</span> <span class="badge bg-danger rounded-circle">'.(self::getTopicsByForum($forumDB['name'])).'</span> '.(Users::isAdmin() ? '<a href="'.$BASEPATH.'/forum?removeForum='.$forumDB['name'].'"><i style="color:red;" class="fa-solid fa-trash-can"></i></a>' : '').'</li></a>';
			}
			ksort($lists);
			foreach($lists as $item => $list){
				$out.=$list;
			}
			return $out;
		}
		public static function renderTopic($topics){
			global $conf, $countTopics;
			$out='';
			$items = array();
			$pinned = array();
			$setTopicData = array();
			$d='';
			foreach($topics as $args=>$topic){
				$out='';
				foreach($topic as $t){
				if(preg_replace('/[\d]+/','',$args)==='pinned'){
					if(preg_match('/(forum|tags|status|topic)\/[\w\-\_]+$|(forum|tags|status|topic)\/[\w\-\_]+\?/', $_SERVER['REQUEST_URI'])){
						preg_match('/[\w\-\_]+$|[\w\-\_]+\?/', $_SERVER['REQUEST_URI'],$durl);
						if(preg_match('/forum="'.str_replace('?','',$durl[0]).'"/', $t)){
							array_push($pinned, $t);
						}
					}else{
						array_push($pinned, $t);
					}
				}else{
					if(preg_match('/(forum|tags|status|topic)\/[\w\-\_]+$|(forum|tags|status|topic)\/[\w\-\_]+\?/', $_SERVER['REQUEST_URI'])){
						preg_match('/[\w\-\_]+$|[\w\-\_]+\?/', $_SERVER['REQUEST_URI'],$durl);
						if(preg_match('/forum="'.str_replace('?','',$durl[0]).'"/', $t)){
							array_push($items, $t);
						}
					}else{
						array_push($items, $t);
					}
					
					}
				}
				
				
			}
			
			$items = array_reverse(array_merge($items, $pinned));
			$p = isset($_GET['p']) ? $_GET['p'] : 1;
			$nb = $conf['forum']['maxTopicDisplay'];
			
			for($i=0;$i<count(array_slice($items, $nb*($p-1), $nb));$i++){
				if(preg_match('/\/forum(?:\.php)\/(forum|tags|status|topic)\/[\w\-\_]+|\/forum(?:\.php)\/(forum|tags|status|topic)\/[\w\-\_]+\?/', $_SERVER['REQUEST_URI'])){
						preg_match('/(forum|tags|status|topic)\/[\w\-\_]+$|(forum|tags|status|topic)\/[\w\-\_]+\?/', $_SERVER['REQUEST_URI'], $url);
				$target = @explode('/', str_replace('?','',$url[0]));
				if($target[0]==='forum'){
					if(strstr(array_slice($items, $nb*($p-1), $nb)[$i], $target[1])){
						$d.=array_slice($items, $nb*($p-1), $nb)[$i];
					}		
				}
			}else{
				$d.=array_slice($items, $nb*($p-1), $nb)[$i];
			}
				
			}
			foreach(Files::Scan(DATA_TOPICS) as $topics){
				$topics = Files::removeExtension($topics);
				$db = WebDB::getDB('topics', $topics);
				if(preg_match('/(forum|tags|status|topic)\/[\w\-\_]+|(forum|tags|status|topic)\/[\w\-\_]+\?/', $_SERVER['REQUEST_URI'])){
					preg_match('/(forum|tags|status|topic)\/[\w\-\_]+|(forum|tags|status|topic)\/[\w\-\_]+\?/', $_SERVER['REQUEST_URI'], $ot);
					$forum = preg_replace('/(forum|tags|status|topic)\/|\?/','',$ot[0]);
					if($db['forum']===$forum)
						$countTopics[] = $topics;
				}else{
					$countTopics[] = $topics;
				}
			}
			
			return $d;
		}
		public static function loadTopics(){
			global $langs, $BASEPATH, $conf, $session, $topicsArr;
			$out='';
			$setOnce=0;
			$scanDir = Files::Scan(DATA_TOPICS);
			 asort($scanDir);
			foreach($scanDir as $topics){
			$genID = self::generate_ProfileID();
			$user = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
			  
					$topics = str_replace('.dat.json','',$topics);
					
					$info = WebDB::getDB('topics', $topics);
					$forumDB = WebDB::getDB('forums', $info['forum']);
					$userInfo = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : [];
					# tags
					$getTags = (@explode(',', $info['tags']) ? @explode(',', $info['tags']) : array($info['tags']));
					$listTags = '';
					$dontIncludeLastTag = 1; 
					foreach($getTags as $tags){
						if($dontIncludeLastTag < count($getTags)){
							$comma = ',';
						}else{
							$comma = '';
						}
						$listTags .= '<a class="link-primary fst-italic" href="'.$BASEPATH.'/forum.php/tags/'.$tags.'">'.$tags.'</a>'.$comma.' ';
						$dontIncludeLastTag++;
					}
					$dinfo = '<!-- Media object -->
	<li class="list-group-item border-0" forum="'.$info['forum'].'">
	<div class="d-flex m-2 text-bg-light w-100" style="background-color:rgba(219,215,210,1)!important;border-radius:15px;">
	  <!-- Image -->
	  <a '.('href="'.$BASEPATH.'/dashboard.php/profile?name='.$info['author'].'"').'><img
		src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$info['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png?v='.self::generate_imgVer() : $BASEPATH.DATA_AVATARS.'default.png').'"
		alt="'.$info['author'].'"
		class="ms-3 mt-2 me-3 rounded-circle userIcon"
		style="width: 60px; height: 60px; background-color:'.$forumDB['tagColor'].';"
		onmouseout="ProfileCard(\''.$genID.'\', \'closed\')" 
		onmouseover="ProfileCard(\''.$genID.'\',\'open\')"
		/>'.checkOnline(isset($user[$info['author']]['ip']) ? $user[$info['author']]['ip'] : null).'</a>
	   <div class="card infocard" profile-id="'.$genID.'" onmouseout="ProfileCard(\''.$genID.'\', \'closed\')" onmouseover="ProfileCard(\''.$genID.'\',\'open\')">
	  <div class="card-body">
	  <div class="card-title text-center">'.$info['author'].'</div>
		<div class="row">
			<div class="col">
				<img width="64" height="64" class="rounded-circle img-fluid" src="'.(file_exists(ROOT.DATA_AVATARS.$info['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png?v='.self::generate_imgVer() : $BASEPATH.DATA_AVATARS.'default.png').'"/>
				<span class="d-block mt-2 mb-2">'.Users::createBadge($info['author']).'</span>
				<p class="text-secondary">'.Page::summary($userInfo[$info['author']]['about'], $conf['forum']['maxSummary']).'</p>
				<a href="/'.MAINDIR.'/dashboard.php/mail?to='.$info['author'].':<'.$userInfo[$info['author']]['email'].'>"><button class="btn btn-outline-secondary w-100"><i class="fa-solid fa-envelope"></i> '.(isset($langs['contact.title']) ? $langs['contact.title'] : 'Contact').'</button></a>
				'.(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']&&$info['author']!==$session ? '<a href="/'.MAINDIR.'/dashboard.php/view?plugins=friends&view=add&request='.$info['author'].'"><button class="btn btn-outline-secondary w-100 mt-2"><i class="fa-solid fa-user-plus"></i> '.(isset($langs['friends_add']) ? $langs['friends_add'] : 'Add Friend').'</button></a>' : '').'
				'.(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']&&$info['author']!==$session ? '<a href="/'.MAINDIR.'/dashboard.php/view?plugins=friends&view=online&blockuser='.$info['author'].'"><button class="btn btn-outline-danger w-100 mt-2">'.(isset($langs['friends_blockUserLabel']) ? $langs['friends_blockUserLabel'] : 'Block User').'</button></a>' : '').'
				'.(Plugin::hook('profileCards_btn')).'
			</div>
			<div class="col stats">
				<div class="box">
					<span class="value">'.self::usersData($info['author'], 'topics').'</span>
					<span class="text-secondary parameter">'.(isset($langs['dashboard.profile.topics']) ? str_replace(':','',$langs['dashboard.profile.topics']) : 'Topics').'</span>
				</div>
				<div class="box">
					<span class="value">'.self::usersData($info['author'], 'replys').'</span>
					<span class="text-secondary parameter">'.(isset($langs['dashboard.profile.replys']) ? str_replace(':','',$langs['dashboard.profile.replys']) : 'Replys').'</span>
				</div>';
					if(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']){
						$dinfo.='<div class="box">'.friends_countFriends($info['author']).'</div>';
					}
					if(WebDB::dbExists('plugins', 'achievements/plugin')&&WebDB::getDB('plugins', 'achievements/plugin')['active']){
						$dinfo.='<div class="box">'.achievements_countAchievements($info['author']).'</div>';
					}
					$dinfo.=Plugin::hook('profileCards_box');
			$dinfo.='</div>
		</div>
	  </div>
	</div>
	  <!-- Media body -->
	  <div class="p-2">
		<h5 class="fw-bold mt-2">
		  '.(Users::createBadge($info['author']) ? Users::createBadge($info['author']) : '<span class="ms-2 me-2 badge text-bg-secondary">'.(isset($langs['forum.anonumous']) ? $langs['forum.anonumous'] : 'System').'</span>').$info['author'].' - <em>'.$info['name'].'</em>
		  <small class="text-muted">'.(isset($langs['forum.created']) ? $langs['forum.created'] : 'Created: ').' '.Utils::toDate($info['created'], $conf['page']['dateFormat']).'</small>
			'.($info['pinned'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.pinned']) ? $langs['forum.pinned'] : 'Pinned').'" class="badge text-bg-success"><i class="fa-solid fa-thumbtack"></i></span>' : '').'
			'.($info['locked'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.locked']) ? $langs['forum.locked'] : 'Locked').'" class="badge text-bg-danger"><i class="fa-solid fa-lock"></i></span>' : '').'
		</h5>
		<p class="text-bg-dark me-2 p-2 rounded showPreMsg">
		 '.Page::summary($info['msg'], $conf['forum']['maxSummary']).'
		</p>
		<div class="d-inline-block" '.(strtotime($info['created'])===strtotime($info['edited']) ? 'style="display:none!important;"' : '').'><small class="text-muted" style="float:left;"><i class="fa-solid fa-pen-to-square"></i> '.(isset($langs['forum.edited']) ? $langs['forum.edited'] : 'Last Edited: ').' '.Utils::toDate($info['edited'],$conf['page']['dateFormat']).'</small></div>
		<div><i class="fa-solid fa-eye"></i> <span class="text-secondary">'.self::number_abbr($info['views']).'</span><i style="transform:rotateY(180deg);" class="fa-solid fa-comment ms-3"></i> <span class="text-secondary">'.self::getReplysByTopic($info['id']).'</span></div>

		<tags>'.(isset($langs['forum.forumTag']) ? $langs['forum.forumTag'] : 'Tags: ').$listTags.'</tags>
		<a class="text-decoration-none" href="'.$BASEPATH.'/forum.php/view?id='.$info['id'].'"><button class="btn '.($info['locked'] ? 'btn-secondary' : 'btn-primary').' d-flex mt-2 mb-2">'.($info['locked'] ? (isset($langs['forum.view']) ? $langs['forum.view'] : 'View&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>') : (isset($langs['forum.replys']) ? $langs['forum.replys'] : 'Reply&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>')).'</button></a><a href="'.$BASEPATH.DS.'dashboard.php'.DS.'mail?report='.$info['id'].'" class="text-decoration-none"><button class="btn btn-info">'.(isset($langs['report']) ? $langs['report'] : '<i class="fa-solid fa-bell"></i> Report').'</button></a>
		'.($session===$info['author']||Users::isAdmin() ? '<a'.(Users::hasPermission('delete') ? '' : ' hidden="hidden"').' href="'.$BASEPATH.'/forum?removeTopic='.date('Y-m', strtotime($info['created'])).'-'.$info['id'].'"><button class="btn btn-danger">'.(isset($langs['forum.deleteTopic']) ? $langs['forum.deleteTopic'] : 'Delete Topic').' <i class="fa-solid fa-trash-can"></i></button></a> <a'.(Users::hasPermission('write') ? '' : ' hidden="hidden"').' href="'.$BASEPATH.'/forum?editTopic='.date('Y-m', strtotime($info['created'])).'-'.$info['id'].'"><button class="btn btn-success">'.(isset($langs['forum.editBtn']) ? $langs['forum.editBtn'] : '<i class="fa-solid fa-pen-to-square"></i> Edit').'</button></a>':'').'

	 </div>

	  <!-- Media body -->
	</div></li>

	<!-- Media object -->';
		
					
				if($info['pinned']&&$info['pinned']===true){
					array_push($topicsArr['pinned'], $dinfo);
				}else{
					 array_push($topicsArr['topics'], $dinfo);	
				}
			
		
		}
		
			return self::renderTopic($topicsArr);
		}
		public static function renderReply($replys){
			global $conf;
				$out='';
				$items = array();
				$d='';
				foreach($replys as $args=>$replys){
					foreach($replys as $r){
					 !in_array($r, $items) ? array_push($items, $r) : '';
					}
				}
			
			$p = isset($_GET['p']) ? $_GET['p'] : 1;
			$nb = $conf['forum']['maxReplyDisplay'];
			for($i=0;$i<count(array_slice($items, $nb*($p-1), $nb));$i++){
				$d.=array_slice($items, $nb*($p-1), $nb)[$i];
				}
				return $d;
		}
		public static function checkReplyByTopic($tid){
			foreach(Files::Scan(DATA_TOPICS) as $topics){
				if(strpos($topics, $tid)){
					return Files::removeExtension($topics);
				}
			}
		}
		public static function loadReplys(){
			global $langs, $BASEPATH, $conf, $session, $replaysArr; 
			$replyItem='';
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$author='';
		foreach(Files::scan(DATA_TOPICS) as $topics){
				$topics = str_replace('.dat.json','',$topics);	
				$info = WebDB::getDB('topics', $topics);
				$forumDB = WebDB::getDB('forums', $info['forum']);
				$userInfo = WebDB::getDB('users', 'users');
					# tags
					$getTags = explode(',', $info['tags']);
					$listTags = '';
					$dontIncludeLastTag = 1; 
					foreach($getTags as $tags){
						if($dontIncludeLastTag < count($getTags)){
							$comma = ',';
						}else{
							$comma = '';
						}
						$listTags .= '<a class="link-primary fst-italic" href="'.$BASEPATH.'/search?results='.$tags.'">'.$tags.'</a>'.$comma.' ';
						$dontIncludeLastTag++;
					}
					
			if($info['id']===$id){
				
			# modal
			  $genID = self::generate_ProfileID();
			  $GLOBALS['author'] = $info['author'];
			  $GLOBALS['topic'] = $topics;
								$dinfo = '<!-- Media object -->
	<li class="list-group-item replyItem border-0" forum="'.$info['forum'].'"><div class="d-flex m-2 text-bg-light w-100" style="background-color:rgba(219,215,210,1)!important;border-radius:15px;">
	  <!-- Image -->
	  <a '.('href="'.$BASEPATH.'/dashboard.php/profile?name='.$info['author'].'"').'><img
		src="'.(file_exists(ROOT.DATA_AVATARS.$info['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png?v='.self::generate_imgVer() : $BASEPATH.DATA_AVATARS.'default.png').'"
		alt="'.$info['author'].'"
		class="ms-3 mt-2 me-3 rounded-circle userIcon"
		style="width: 60px; height: 60px; background-color:'.$forumDB['tagColor'].';"
		onmouseout="ProfileCard(\''.$genID.'\', \'closed\')" 
		onmouseover="ProfileCard(\''.$genID.'\',\'open\')"
		/>'.checkOnline(isset($userInfo[$info['author']]['ip']) ? $userInfo[$info['author']]['ip'] : null).'</a>
	  <div class="card infocard" profile-id="'.$genID.'" onmouseout="ProfileCard(\''.$genID.'\', \'closed\')" onmouseover="ProfileCard(\''.$genID.'\',\'open\')">
	  <div class="card-body">
	  <div class="card-title text-center">'.$info['author'].'</div>
		<div class="row">
			<div class="col">
				<img width="64" height="64" class="rounded-circle img-fluid" src="'.(file_exists(ROOT.DATA_AVATARS.$info['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png?v='.self::generate_imgVer() : $BASEPATH.DATA_AVATARS.'default.png').'"/>
				<span class="d-block mt-2 mb-2">'.Users::createBadge($info['author']).'</span>
				<p class="text-secondary">'.Page::summary($userInfo[$info['author']]['about'], $conf['forum']['maxSummary']).'</p>
				<a href="/'.MAINDIR.'/dashboard.php/mail?to='.$info['author'].':<'.$userInfo[$info['author']]['email'].'>"><button class="btn btn-outline-secondary w-100"><i class="fa-solid fa-envelope"></i> '.(isset($langs['contact.title']) ? $langs['contact.title'] : 'Contact').'</button></a>
				'.(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']&&$info['author']!==$session ? '<a href="/'.MAINDIR.'/dashboard.php/view?plugins=friends&view=add&request='.$info['author'].'"><button class="btn btn-outline-secondary w-100 mt-2"><i class="fa-solid fa-user-plus"></i> '.(isset($langs['friends_add']) ? $langs['friends_add'] : 'Add Friend').'</button></a>' : '').'
				'.(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']&&$info['author']!==$session ? '<a href="/'.MAINDIR.'/dashboard.php/view?plugins=friends&view=online&blockuser='.$info['author'].'"><button class="btn btn-outline-danger w-100 mt-2">'.(isset($langs['friends_blockUserLabel']) ? $langs['friends_blockUserLabel'] : 'Block User').'</button></a>' : '').'
				'.(Plugin::hook('profileCards_btn')).'
			</div>
			<div class="col stats">
				<div class="box">
					<span class="value">'.self::usersData($info['author'], 'topics').'</span>
					<span class="text-secondary parameter">'.(isset($langs['dashboard.profile.topics']) ? str_replace(':','',$langs['dashboard.profile.topics']) : 'Topics').'</span>
				</div>
				<div class="box">
					<span class="value">'.self::usersData($info['author'], 'replys').'</span>
					<span class="text-secondary parameter">'.(isset($langs['dashboard.profile.replys']) ? str_replace(':','',$langs['dashboard.profile.replys']) : 'Replys').'</span>
				</div>';
					if(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']){
						$dinfo.='<div class="box">'.friends_countFriends($info['author']).'</div>';
					}
					if(WebDB::dbExists('plugins', 'achievements/plugin')&&WebDB::getDB('plugins', 'achievements/plugin')['active']){
						$dinfo.='<div class="box">'.achievements_countAchievements($info['author']).'</div>';
					}
					$dinfo.=Plugin::hook('profileCards_box');
			$dinfo.='</div>
		</div>
	  </div>
	</div>
	  <!-- Media body -->
	  <div class="p-2">
		<h5 class="fw-bold mt-2">
		  '.$info['author'].(Users::createBadge($info['author']) ? Users::createBadge($info['author']) : '<span class="ms-2 me-2 badge text-bg-secondary">'.$langs['forum.anonumous'].'</span>').
		 '<small class="text-muted">'.(isset($langs['forum.created']) ? $langs['forum.created'] : '').' '.date($conf['page']['dateFormat'], strtotime($info['created'])).'</small>
			'.($info['pinned'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.pinned']) ? $langs['forum.pinned'] : 'Pinned').'" class="badge text-bg-success"><i class="fa-solid fa-thumbtack"></i></span>' : '').'
			 '.($info['locked'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.locked']) ? $langs['forum.locked'] : 'Locked').'" class="badge text-bg-danger"><i class="fa-solid fa-lock"></i></span>' : '').'
	   </h5>
		'.Plugin::hook('beforeMsg').'
		<p class="text-bg-dark me-2 p-2 rounded">
		 '.$info['msg'].'
		</p>
		'.Plugin::hook('afterMsg').'
		<tags>'.(isset($langs['forum.forumTag']) ? $langs['forum.forumTag'] : 'Tags: ').$listTags.'</tags><br/>
		<small '.(strtotime($info['created'])===strtotime($info['edited']) ? 'hidden="hidden"' : '').' class="text-muted"><i class="fa-solid fa-pen-to-square"></i> '.(isset($langs['forum.edited']) ? $langs['forum.edited'] : 'Last Edited: ').' '.date($conf['page']['dateFormat'], strtotime($info['edited'])).'</small>
		<div class="forumoptions"><a href="'.$BASEPATH.DS.'dashboard.php'.DS.'mail?report='.$info['id'].'" class="text-decoration-none"><button class="btn btn-info">'.$langs['report'].'</button></a></div>
			'.Plugin::hook('bottomTopic').'
		   <!-- Nested Media object -->';
			foreach(Files::Scan(DATA_REPLYS) as $replys){
				$genID = self::generate_ProfileID();
					$replys = str_replace('.dat.json','',$replys);
					$rInfo = WebDB::getDB('replys', $replys);
					$GLOBALS['author'] = $rInfo['author'];
					$GLOBALS['reply'] = $replys;
					if($rInfo['topic']===$_GET['id']){
						$replyItem='<div id="'.$rInfo['id'].'" class="d-flex mt-4 replyBox">
		<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$langs['forum.anchorID'].'" onclick="copyReplyID(\''.$rInfo['id'].'\')" class="link-primary fs-3 me-2" href="#'.$rInfo['id'].'"><i class="fa-solid fa-anchor"></i></a>  
		<div class="position-relative">
		<a '.('href="'.$BASEPATH.'/dashboard.php/profile?name='.$rInfo['author'].'"').'><img
			src="'.(file_exists(ROOT.DATA_AVATARS.$rInfo['author'].'.png') ? $BASEPATH.DATA_AVATARS.$rInfo['author'].'.png?v='.self::generate_imgVer() : $BASEPATH.DATA_AVATARS.'default.png').'"
			alt="'.$rInfo['author'].'"
			class="me-3 rounded-circle userIcon"
			style="width: 60px; height: 60px;"
			onmouseout="ProfileCard(\''.$genID.'\', \'closed\')" 
			onmouseover="ProfileCard(\''.$genID.'\',\'open\')"
			/>'.checkOnline(isset($userInfo[$rInfo['author']]['ip']) ? $userInfo[$rInfo['author']]['ip'] : null).'</a>
		  
		   <div class="card infocard" profile-id="'.$genID.'" onmouseout="ProfileCard(\''.$genID.'\', \'closed\')" onmouseover="ProfileCard(\''.$genID.'\',\'open\')">
	  <div class="card-body">
	  <div class="card-title text-center">'.$rInfo['author'].'</div>
		<div class="row">
			<div class="col">
				<img width="64" height="64" class="rounded-circle img-fluid" src="'.(file_exists(ROOT.DATA_AVATARS.$rInfo['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png?v='.self::generate_imgVer() : $BASEPATH.DATA_AVATARS.'default.png').'"/>
				<span class="d-block mt-2 mb-2">'.Users::createBadge($rInfo['author']).'</span>
				<p class="text-secondary">'.Page::summary($userInfo[$rInfo['author']]['about'],$conf['forum']['maxSummary']).'</p>
				<a href="/'.MAINDIR.'/dashboard.php/mail?to='.$rInfo['author'].':<'.$userInfo[$rInfo['author']]['email'].'>"><button class="btn btn-outline-secondary w-100"><i class="fa-solid fa-envelope"></i> '.(isset($langs['contact.title']) ? $langs['contact.title'] : 'Contact').'</button></a>
				'.(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']&&$rInfo['author']!==$session ? '<a href="/'.MAINDIR.'/dashboard.php/view?plugins=friends&view=add&request='.$rInfo['author'].'"><button class="btn btn-outline-secondary w-100 mt-2"><i class="fa-solid fa-user-plus"></i> '.(isset($langs['friends_add']) ? $langs['friends_add'] : 'Add Friend').'</button></a>' : '').'
				'.(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']&&$rInfo['author']!==$session ? '<a href="/'.MAINDIR.'/dashboard.php/view?plugins=friends&view=online&blockuser='.$info['author'].'"><button class="btn btn-outline-danger w-100 mt-2">'.(isset($langs['friends_blockUserLabel']) ? $langs['friends_blockUserLabel'] : 'Block User').'</button></a>' : '').'
				'.(Plugin::hook('profileCards_btn')).'
			</div>
			<div class="col stats">
				<div class="box">
					<span class="value">'.self::usersData($rInfo['author'], 'topics').'</span>
					<span class="text-secondary parameter">'.(isset($langs['dashboard.profile.topics']) ? str_replace(':','',$langs['dashboard.profile.topics']) : 'Topics').'</span>
				</div>
				<div class="box">
					<span class="value">'.self::usersData($rInfo['author'], 'replys').'</span>
					<span class="text-secondary parameter">'.(isset($langs['dashboard.profile.replys']) ? str_replace(':','',$langs['dashboard.profile.replys']) : 'Replys').'</span>
				</div>';
					if(WebDB::dbExists('plugins', 'friends/plugin')&&WebDB::getDB('plugins', 'friends/plugin')['active']){
						$replyItem.='<div class="box">'.friends_countFriends($rInfo['author']).'</div>';
					}
					if(WebDB::dbExists('plugins', 'achievements/plugin')&&WebDB::getDB('plugins', 'achievements/plugin')['active']){
						$replyItem.='<div class="box">'.achievements_countAchievements($rInfo['author']).'</div>';
					}
					$replyItem.=Plugin::hook('profileCards_box');
			$replyItem.='</div>
		</div>
	  </div>
	</div>
	</div>
		  <div>
			<h5 class="fw-bold">
			  '.$rInfo['author'].(Users::createBadge($rInfo['author']) ? Users::createBadge($rInfo['author']) : '<span class="ms-2 me-2 badge text-bg-secondary">'.$langs['forum.anonumous'].'</span>').'
			  <small class="text-muted">'.(isset($langs['forum.created']) ? $langs['forum.created'] : '').' '.date($conf['page']['dateFormat'], strtotime($rInfo['created'])).'</small>
			</h5>
			'.Plugin::hook('beforeMsg').'
			<p>
			 '.$rInfo['msg'].'
			</p>
			'.Plugin::hook('afterMsg').'
			<small '.(strtotime($rInfo['created'])===strtotime($rInfo['edited']) ? 'hidden="hidden"' : '').' class="text-muted"><i class="fa-solid fa-pen-to-square"></i> '.(isset($langs['forum.edited']) ? $langs['forum.edited'] : '').' '.date($conf['page']['dateFormat'], strtotime($rInfo['edited'])).'</small>
			<div style="display:flex;" class="m-2 rmsg">'.Plugin::hook('replyMsg').'</div>
			<div class="forumoptions">'.($session===$rInfo['author']&&!$info['locked']||Users::isAdmin()&&!$info['locked'] ? '<a href="./view?id='.$_GET['id'].'&quoteReply='.$rInfo['id'].'"><button class="btn btn-primary">'.$langs['btn.quote'].'</button></a> <a href="./view?id='.$_GET['id'].'&editReply='.$rInfo['id'].'"><button class="btn btn-success">'.$langs['forum.editBtn'].'</button></a> <a href="./view?id='.$_GET['id'].'&removeReply='.$rInfo['id'].'"><button class="btn btn-danger">'.$langs['forum.removeBtn'].'</button></a>
			<a href="'.$BASEPATH.DS.'dashboard.php'.DS.'mail?report='.$info['id'].'&replyID='.$rInfo['id'].'&pnum='.(isset($_GET['p']) ? $_GET['p'] : '1').'" class="text-decoration-none ms-1"><button class="btn btn-info">'.$langs['report'].'</button></a>' : '<a href="./view?id='.$_GET['id'].'&quoteReply='.$rInfo['id'].'"><button class="btn btn-primary">'.$langs['btn.quote'].'</button></a> <a href="'.$BASEPATH.DS.'dashboard.php'.DS.'mail?report='.$info['id'].'&replyID='.$rInfo['id'].'&pnum='.(isset($_GET['p']) ? $_GET['p'] : '1').'" class="text-decoration-none ms-1"><button class="btn btn-info">'.$langs['report'].'</button></a>').'
			'.Plugin::hook('bottomReply').'</div>
		 </div>
		</div>';	
		!in_array($replyItem, $replaysArr['replys']) ? array_push($replaysArr['replys'], $replyItem) : '';

					}
					
						
				}
			
				$dinfo.=self::renderReply($replaysArr);
		$dinfo.='<!-- Nested Media object -->
	  </div>
	  
	  <!-- Media body -->
	</div></li>

	<!-- Media object -->';
			}
			
		}
		
		return $dinfo;
		
		}
		public static function makeReply($msg, $author, $raw, $topicID=null, $created=null, $edited=null, $id=null){
			$edited = date('m/d/Y h:i:sa');
			$id = !isset($_GET['editReply']) ? self::replyID() : $_GET['editReply'];
			
			!WebDB::DBexists('replys', $id) ? WebDB::makeDB('replys', $id) : '';
			$d = WebDB::DBexists('replys', $id) ? WebDB::getDB('replys', $id) : '';
			$t = WebDB::dbExists('topics', self::getTopicsByID($_GET['id'])) ? WebDB::getDB('topics', self::getTopicsByID($_GET['id'])) : '';
			$data = array(
					'topic'=>$t['id'],
					'id'=>$id,
					'created'=>(isset($d['created']) ? $d['created'] : date('m/d/Y h:i:sa')),
					'edited'=>$edited,
					'author'=>(isset($d['author']) ? $d['author'] : $author),
					'msg'=>$msg,
					'raw'=>$raw
			);
			Events::createEvent(Users::getRealIP($author),Users::getSystInfo()['os'].'('.Users::getSystInfo()['device'].')',Users::getBrowser(),Users::ipInfo(Users::getRealIP(), 'city').','.Users::ISO2COUNTRY(Users::ipInfo(Users::getRealIP(), 'country')), date('m/d/Y h:i:sa'), $author, 'success', 'create reply');
			$t['replys'][] = $id;
			WebDB::saveDB('topics', self::getTopicsByID($_GET['id']), $t);
			return WebDB::saveDB('replys', $id, $data) ? true : false; 
		}
		public static function makeTopic($name, $forum, $author, $msg, $tags, $raw, $pinned=false, $locked=false, $created=null, $edited=null, $id=null){
			$created = $created!==null ? $created : date('m/d/Y h:i:sa');
			$edited = date('m/d/Y h:i:sa');
			$id = !isset($_GET['editTopic']) ? date('d').self::generate_id() : preg_replace('/[\d]{4}\-[\d]{2}\-/','',$_GET['editTopic']);
			$idFile = isset($_GET['editTopic']) ? $_GET['editTopic'] : date('Y-m').'-'.$id;
			$topic = !WebDB::DBexists('topics', $idFile) ? WebDB::makeDB('topics', $idFile) : 'error';
			$d = WebDB::dbExists('topics', $idFile) ? WebDB::getDB('topics', $idFile) : '';
			$data = array(
				'name'=>$name,
				'msg'=>$msg,
				'raw'=>$raw,
				'created'=>$created,
				'edited'=>$edited,
				'id'=>$id,
				'author'=>(isset($d['author']) ? $d['author']  : $author),
				'tags'=>$tags,
				'forum'=>$forum,
				'views'=>(isset($d['views']) ? (int)$d['views'] : filter_var(0, FILTER_VALIDATE_INT)),
				'pinned'=>filter_var($pinned, FILTER_VALIDATE_BOOLEAN),
				'locked'=>filter_var($locked, FILTER_VALIDATE_BOOLEAN),
				'replys'=>(isset($d['replys']) ? $d['replys'] : [])
			);
			Events::createEvent(Users::getRealIP($author),Users::getSystInfo()['os'].'('.Users::getSystInfo()['device'].')',Users::getBrowser(),Users::ipInfo(Users::getRealIP(), 'city').','.Users::ISO2COUNTRY(Users::ipInfo(Users::getRealIP(), 'country')), date('m/d/Y h:i:sa'), $author, 'success', 'create topic');
			return WebDB::saveDB('topics', $idFile, $data) ? true : false; 
		}
		
	}
	?>