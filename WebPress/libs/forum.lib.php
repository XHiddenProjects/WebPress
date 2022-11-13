<?php defined('WEBPRESS') or die('Webpress community');

include_once('webdb.lib.php');
include_once('files.lib.php');
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
	protected static function replyID(){
		return date('Y-m').'-'.substr(self::generate_id(), 0, 10);
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
	public static function listForums(){
		global $langs, $BASEPATH;
		$out='';
		foreach(Files::Scan(DATA_FORUMS) as $forums){
			$forums = str_replace('.dat.json', '', $forums);
			$forumDB = WebDB::getDB('forums', $forums);
			$out.='<a href="./forum?search=forum:'.$forumDB['name'].'" style="text-decoration:none;"><li class="nav-item"><i style="color:'.$forumDB['tagColor'].'!important;" class="'.$forumDB['tagIcon'].'"></i> <span style="color:'.$forumDB['tagColor'].'";>'.$forumDB['name'].'</span> <span class="badge bg-danger rounded-circle">'.(self::getTopicsByForum($forumDB['name'])).'</span> <a href="'.$BASEPATH.'/forum?removeForum='.$forumDB['name'].'"><i style="color:red;" class="fa-solid fa-trash-can"></i></a></li></a>';
		}
		return $out;
	}
	public static function renderTopic($topics){
		global $conf;
		$out='';
		$items = array();
		$pinned = array();
		$d='';
		foreach($topics as $args=>$topic){
			$out='';
			foreach($topic as $t){
				if(preg_replace('/[\d]+/','',$args)==='pinned'){
				array_push($pinned, $t);
			}else{
				array_push($items, $t);
				}
			}
			
			
		}
		$items = array_reverse(array_merge($items, $pinned));
		$p = isset($_GET['p']) ? $_GET['p'] : 1;
		$nb = $conf['forum']['maxTopicDisplay'];
		for($i=0;$i<count(array_slice($items, $nb*($p-1), $nb));$i++){
			if(isset($_GET['search'])){
			$target = @explode(':', $_GET['search']);
			
			if($target[0]==='tags'){
				if(strstr(array_slice($items, $nb*($p-1), $nb)[$i], $target[1])){
					$d.=array_slice($items, $nb*($p-1), $nb)[$i];
				}
			}elseif($target[0]==='forum'){
				if(strstr(array_slice($items, $nb*($p-1), $nb)[$i], $target[1])){
					$d.=array_slice($items, $nb*($p-1), $nb)[$i];
				}
			}elseif($target[0]==='topic'){
				if(strstr(array_slice($items, $nb*($p-1), $nb)[$i], $target[1])){
					$d.=array_slice($items, $nb*($p-1), $nb)[$i];
				}
			}elseif($target[0]==='status'){
				if(strstr(array_slice($items, $nb*($p-1), $nb)[$i], $target[1])){
					$d.=array_slice($items, $nb*($p-1), $nb)[$i];
				}
			}elseif($target[0]===''||$target[0]==='all'){
				$d.=array_slice($items, $nb*($p-1), $nb)[$i];
			}
		}else{
			$d.=array_slice($items, $nb*($p-1), $nb)[$i];
		}
			
		}
		
		return $d;
	}
	public static function loadTopics(){
		global $langs, $BASEPATH, $conf, $session, $topicsArr;
		$out='';
		$setOnce=0;
		foreach(Files::Scan(DATA_TOPICS) as $topics){
		$user = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		
				$topics = str_replace('.dat.json','',$topics);
				
				$info = WebDB::getDB('topics', $topics);
				$forumDB = WebDB::getDB('forums', $info['forum']);
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
					$listTags .= '<a class="link-primary fst-italic" href="./forum?search=tags:'.$tags.'">'.$tags.'</a>'.$comma.' ';
					$dontIncludeLastTag++;
				}
				$dinfo = '<!-- Media object -->
<li class="list-group-item border-0" forum="'.$info['forum'].'">
<div class="d-flex m-2 text-bg-light w-100" style="background-color:rgba(219,215,210,1)!important;border-radius:15px;">
  <!-- Image -->
  <a '.($info['author']!=='System' ? 'href="'.$BASEPATH.'/dashboard.php/profile?name='.$info['author'].'"' : '').'><img
    src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$info['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'"
    alt="'.$info['author'].'"
    class="ms-3 mt-2 me-3 rounded-circle userIcon"
    style="width: 60px; height: 60px; background-color:'.$forumDB['tagColor'].';"
  />'.checkOnline(isset($user[$info['author']]['ip']) ? $user[$info['author']]['ip'] : null).'</a>
  <!-- Media body -->
  <div>
    <h5 class="fw-bold mt-2">
      '.$info['author'].' - <em>'.$info['name'].'</em>
      <small class="text-muted">'.(isset($langs['forum.edited']) ? $langs['forum.edited'] : 'Last Edited: ').' '.date($conf['page']['dateFormat'], strtotime($info['edited'])).'</small>
		'.($info['pinned'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.pinned']) ? $langs['forum.pinned'] : 'Pinned').'" class="badge text-bg-success"><i class="fa-solid fa-thumbtack"></i></span>' : '').'
		'.($info['locked'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.locked']) ? $langs['forum.locked'] : 'Locked').'" class="badge text-bg-danger"><i class="fa-solid fa-lock"></i></span>' : '').'
	</h5>
    <p class="text-bg-dark me-2 p-2 rounded">
     '.$info['msg'].'
    </p>
	<div><i class="fa-solid fa-eye"></i> <span class="text-secondary">'.self::number_abbr($info['views']).'</span><i style="transform:rotateY(180deg);" class="fa-solid fa-comment ms-3"></i> <span class="text-secondary">'.self::getReplysByTopic($info['id']).'</span></div>
	<tags>'.$listTags.'</tags>
	<a class="text-decoration-none" href="./forum.php/view?id='.$info['id'].'"><button class="btn '.($info['locked'] ? 'btn-secondary' : 'btn-primary').' d-flex mt-2 mb-2">'.($info['locked'] ? (isset($langs['forum.view']) ? $langs['forum.view'] : 'View&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>') : (isset($langs['forum.replys']) ? $langs['forum.replys'] : 'Reply&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>')).'</button></a>
	'.($session===$info['author'] ? '<a'.(Users::hasPermission('delete') ? '' : ' hidden="hidden"').' href="./forum?removeTopic='.date('Y-m', strtotime($info['created'])).'-'.$info['id'].'"><button class="btn btn-danger">'.(isset($langs['forum.deleteTopic']) ? $langs['forum.deleteTopic'] : 'Delete Topic').' <i class="fa-solid fa-trash-can"></i></button></a> <a'.(Users::hasPermission('write') ? '' : ' hidden="hidden"').' href="./forum?editTopic='.date('Y-m', strtotime($info['created'])).'-'.$info['id'].'"><button class="btn btn-success">'.(isset($langs['forum.editBtn']) ? $langs['forum.editBtn'] : '<i class="fa-solid fa-pen-to-square"></i> Edit').'</button></a>':'').'
 </div>

  <!-- Media body -->
</div></li>

<!-- Media object -->';
	
				/*if(isset($_GET['search'])){
					$target = (strpos($_GET['search'], ':') ? @explode(':', $_GET['search']) : $_GET['search']);
					$splitTag = explode(',',$info['tags']);
					if(is_array($target)&&preg_match('/author/',$target[0])&&preg_match('/'.$info['author'].'/',$target[1])){
						$dinfo=$dinfo;
					}elseif(is_array($target)&&preg_match('/forum/',$target[0])&&preg_match('/'.$info['forum'].'/',$target[1])){
						$dinfo=$dinfo;
					}elseif(is_array($target)&&preg_match('/tags/',$target[0])&&in_array(strtolower($target[1]),$splitTag)){
						$dinfo=$dinfo;
					}else{
							$dinfo='<div class="alert alert-danger">'.$langs['forum.search.failed'].'</div>';
					}
				}*/
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
			$items = array_reverse($items);
		$p = isset($_GET['p']) ? $_GET['p'] : 1;
		$nb = $conf['forum']['maxReplyDisplay'];
		for($i=0;$i<count(array_slice($items, $nb*($p-1), $nb));$i++){
			$d.=array_slice($items, $nb*($p-1), $nb)[$i];
			}
			return $d;
	}
	public static function loadReplys(){
		global $langs, $BASEPATH, $conf, $session, $replaysArr; 
		$replyItem='';
	$id = isset($_GET['id']) ? $_GET['id'] : '';
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
					$listTags .= '<a class="link-primary fst-italic" href="./forum?search=tags:'.$tags.'">'.$tags.'</a>'.$comma.' ';
					$dontIncludeLastTag++;
				}
				
		if($info['id']===$id){
			
		# modal
							$dinfo = '<!-- Media object -->
<li class="list-group-item border-0"><div class="d-flex m-2 text-bg-light w-100" style="background-color:rgba(219,215,210,1)!important;border-radius:15px;">
  <!-- Image -->
  <a '.($info['author']!=='System' ? 'href="'.$BASEPATH.'/dashboard.php/profile?name='.$info['author'].'"' : '').'><img
    src="'.(file_exists(ROOT.DATA_AVATARS.$info['author'].'.png') ? $BASEPATH.DATA_AVATARS.$info['author'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'"
    alt="'.$info['author'].'"
    class="ms-3 mt-2 me-3 rounded-circle userIcon"
    style="width: 60px; height: 60px; background-color:'.$forumDB['tagColor'].';"
  />'.checkOnline(isset($userInfo[$info['author']]['ip']) ? $userInfo[$info['author']]['ip'] : null).'</a>
  <!-- Media body -->
  <div>
    <h5 class="fw-bold mt-2">
      '.$info['author'].(Users::createBadge($info['author']) ? Users::createBadge($info['author']) : '<span class="ms-2 me-2 badge text-bg-secondary">'.$langs['forum.anonumous'].'</span>').
     '<small class="text-muted">'.(isset($langs['forum.edited']) ? $langs['forum.edited'] : '').' '.date($conf['page']['dateFormat'], strtotime($info['edited'])).'</small>
		'.($info['locked'] ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.(isset($langs['forum.locked']) ? $langs['forum.locked'] : 'Locked').'" class="badge text-bg-danger"><i class="fa-solid fa-lock"></i></span>' : '').'
   </h5>

    <p class="text-bg-dark me-2 p-2 rounded">
     '.$info['msg'].'
    </p>
	<tags>'.$listTags.'</tags>
	    <!-- Nested Media object -->';
		foreach(Files::Scan(DATA_REPLYS) as $replys){
				$replys = str_replace('.dat.json','',$replys);
				$rInfo = WebDB::getDB('replys', $replys);
				if($rInfo['topic']===$_GET['id']){
					$replyItem='<div id="'.$rInfo['id'].'" class="d-flex mt-4">
    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$langs['forum.anchorID'].'" onclick="copyReplyID(\''.$rInfo['id'].'\')" class="link-primary fs-3 me-2" href="#'.$rInfo['id'].'"><i class="fa-solid fa-anchor"></i></a>  
	<a '.($rInfo['author']!=='System' ? 'href="'.$BASEPATH.'/dashboard.php/profile?name='.$rInfo['author'].'"' : '').'><img
        src="'.(file_exists(ROOT.DATA_AVATARS.$rInfo['author'].'.png') ? $BASEPATH.DATA_AVATARS.$rInfo['author'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'"
        alt="'.$rInfo['author'].'"
        class="me-3 rounded-circle userIcon"
        style="width: 60px; height: 60px;"
      />'.checkOnline(isset($userInfo[$rInfo['author']]['ip']) ? $userInfo[$rInfo['author']]['ip'] : null).'</a>
      <div>
        <h5 class="fw-bold">
          '.$rInfo['author'].(Users::createBadge($rInfo['author']) ? Users::createBadge($rInfo['author']) : '<span class="ms-2 me-2 badge text-bg-secondary">'.$langs['forum.anonumous'].'</span>').'
          <small class="text-muted">'.(isset($langs['forum.edited']) ? $langs['forum.edited'] : '').' '.date($conf['page']['dateFormat'], strtotime($rInfo['edited'])).'</small>
        </h5>
        <p>
         '.$rInfo['msg'].'
        </p>
		'.($session===$rInfo['author']&&!$info['locked'] ? '<a href="./view?id='.$_GET['id'].'&quoteReply='.$rInfo['id'].'"><button class="btn btn-primary">'.$langs['btn.quote'].'</button></a> <a href="./view?id='.$_GET['id'].'&editReply='.$rInfo['id'].'"><button class="btn btn-success">'.$langs['forum.editBtn'].'</button></a> <a href="./view?id='.$_GET['id'].'&removeReply='.$rInfo['id'].'"><button class="btn btn-danger">'.$langs['forum.removeBtn'].'</button></a>' : '').'
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
	public static function makeReply($msg, $author, $raw, $topicID=null, $edited=null, $id=null){
		$edited = date('m/d/Y h:i:sa');
		$id = !isset($_GET['editReply']) ? self::replyID() : $_GET['editReply'];
		$topicID = isset($_GET['id']) ? $_GET['id'] : '';
		!WebDB::DBexists('replys', $id) ? WebDB::makeDB('replys', $id) : '';
		$data = array(
				'topic'=>$topicID,
				'id'=>$id,
				'edited'=>$edited,
				'author'=>$author,
				'msg'=>$msg,
				'raw'=>$raw
		);
		return WebDB::saveDB('replys', $id, $data) ? true : false; 
	}
	public static function makeTopic($name, $forum, $author, $msg, $tags, $raw, $pinned=false, $locked=false, $created=null, $edited=null, $id=null){
		$created = $created!==null ? $created : date('m/d/Y h:i:sa');
		$edited = date('m/d/Y h:i:sa');
		$id = !isset($_GET['editTopic']) ? self::generate_id() : preg_replace('/[\d]{4}\-[\d]{2}\-/','',$_GET['editTopic']);
		$idFile = isset($_GET['editTopic']) ? $_GET['editTopic'] : date('Y-m').'-'.$id;
		$topic = !WebDB::DBexists('topics', $idFile) ? WebDB::makeDB('topics', $idFile) : 'error';
		
		$data = array(
			'name'=>$name,
			'msg'=>$msg,
			'raw'=>$raw,
			'created'=>$created,
			'edited'=>$edited,
			'id'=>$id,
			'author'=>$author,
			'tags'=>$tags,
			'forum'=>$forum,
			'views'=>filter_var(0, FILTER_VALIDATE_INT),
			'pinned'=>filter_var($pinned, FILTER_VALIDATE_BOOLEAN),
			'locked'=>filter_var($locked, FILTER_VALIDATE_BOOLEAN)
		);
		return WebDB::saveDB('topics', $idFile, $data) ? true : false; 
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
}

?>