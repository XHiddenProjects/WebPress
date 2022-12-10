<?php 
require_once('config.php');
require_once('header.php');
require_once('footer.php');
require_once('libs/plugin.lib.php');
require_once('libs/users.lib.php');
require_once('libs/webdb.lib.php');
$chooseLang='';
global $lang, $selLang, $conf, $defaultIcon;
require_once('lang/'.$selLang.'.php');
?>
<html>
<head>
<?php
$BASEPATH=(!preg_match('/\/forum(?:\.php\/)/',$_SERVER['REQUEST_URI']) ? '.' : '..');
$BASEPATH = (!preg_match('/\/forum(?:\.php)\/p\/[\d]+/',$_SERVER['REQUEST_URI']) ? $BASEPATH : '../..');
if(preg_match('/\/forum(?:\.php)\/view/', $_SERVER['REQUEST_URI'])){
	echo head($lang['forum.title'], $BASEPATH);
}if(preg_match('/\/forum(?:\.php)\/p\/[\d]+/', $_SERVER['REQUEST_URI'])){
	echo head($lang['forum.title'], $BASEPATH);
}else{
	echo head($lang['forum.title'], $BASEPATH);
}

$_SESSION['user_lang'] = $conf['lang'];
?>
</head>
<body>
<style>
.showPreMsg{
display: inline-block;
width: 240px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
background: #FFFCD7;
padding: 5px;
width: calc(100% - 50px);
}
.userIcon{
	transition: box-shadow 300ms ease-out;
}
.userIcon:hover{
	box-shadow: rgba(151,154,170, 0.6) 0 0 0 0.5rem;
}
</style>
</head>
<body>
<?php echo Plugin::hook('beforePage'); ?> 
<nav class="navbar navbar-expand-lg text-dark" style="background-color:#9f998e;">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="<?php echo $BASEPATH;?>/forum"><?php echo $conf['page']['page-title'].' '.$lang['forum.title'];?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#forumNavBar" aria-controls="forumNavBar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="forumNavBar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="<?php echo $BASEPATH;?>/"><?php echo $lang['forum.home'];?></a>
        </li>
		   <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="<?php echo $BASEPATH;?>/forum.php/forums"><?php echo $lang['forum.category'];?></a>
        </li>
		<?php echo plugin::hook('forumnav');?>
      </ul>
      <form class="d-flex" role="search" method="get">
	  <div class="input-group">
	  <div class="autocomplete">
        <input style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control me-2" onkeydown="returnSearch(event);" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
	  </div>
	  		 <button class="btn btn-outline-success input-group-text submitsearch" type="submit">Search</button>
	  </div>
	   <?php
	  echo isset($_SESSION['guest']) ? '<a class="d-flex text-decoration-none" href="'.$BASEPATH.'/auth.php/login"><button type="button" class="btn btn-warning ms-1">'.$lang['register.login'].'</button></a>' : '';
	  ?>
      </form>
	 
	  <?php
	  # Users information
	  if(!Users::isGuest()){
		  $db = WebDB::getDB('users', 'users');
		  $logo='';
		  $logo.= '<div><a data-bs-toggle="collapse" href="#userinfo" role="button" aria-expanded="false" aria-controls="userinfo" style="cursor:pointer;"><img class="img-fluid ms-2" style="border-radius:15px;" width="100" height="100" src="'.(!file_exists(DATA_UPLOADS.'avatars'.DS.$_SESSION['user'].'.png') ? $BASEPATH.DATA_AVATARS.'default.png' : $BASEPATH.DATA_AVATARS.$_SESSION['user'].'.png').'"/></a>';
		$logo.='<div class="collapse position-absolute" style="z-index:5000;right:1%;width:15%;" id="userinfo">
  <div class="card card-body">
  <p class="text-secondary">'.$_SESSION['user'].'('.$db[$_SESSION['user']]['name'].')</p>
    <a href="'.$BASEPATH.'/auth.php/logout" class="mt-2"><button class="btn btn-danger">'.$lang['index.loginoutbtn'].'</button></a>
	<a href="'.$BASEPATH.'/dashboard" class="mt-2"><button class="btn btn-primary">'.$lang['index.dashboardbtn'].'</button></a>
	<a href="'.$BASEPATH.'/dashboard.php/profile" class="mt-2"><button class="btn btn-secondary">'.$lang['dashboard.side.profile'].'</button></a>
	'.(Users::isAdmin() ? '<a href="'.$BASEPATH.'/dashboard.php/configs#configForum" class="mt-2"><button class="btn btn-success">'.$lang['dashboard.side.config'].'</button></a>' : '').'
	<hr/>
	<span class="fs-5 text-secondary">'.$lang['forum.userStatus'].'</span>
	<span class="d-inline-block">'.$lang['dashboard.profile.topics'].Forum::usersData($_SESSION['user'], 'topics').'
	'.$lang['dashboard.profile.replys'].Forum::usersData($_SESSION['user'], 'replys').'</span>
  </div>
</div></div>';
	  echo $logo;
	  }
	  ?>
    </div>
  </div>
</nav>
 <?php
		if(isset($_POST['makeForum'])){
			$name = isset($_POST['forumName'])&&$_POST['forumName']!=='' ? $_POST['forumName'] : 0;
			$color = isset($_POST['forumColor'])&&$_POST['forumColor']!=='' ? $_POST['forumColor'] : 0;
			$icon = isset($_POST['iconpicker'])&&$_POST['iconpicker']!=='' ? $_POST['iconpicker'] : 0;
			if($name!=0&&$color!=0&&$icon!=0){
				$data = array(
					'name'=>$name,
					'created'=>date('m/d/Y h:i:sa'),
					'tagColor'=>$color,
					'tagIcon'=>$icon,
					'val'=>(string)(count(Files::Scan(DATA_FORUMS))+1)
				);
				if(!WebDB::dbExists('forums', $name)){
					WebDB::makeDB('forums', $name) ? true : false;
					echo WebDB::saveDB('forums', $name, $data) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/forum', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/forum', 'danger');
				}
				Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'create forum');
			}else{
				Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'failed', 'create forum');
				echo '<div class="alert alert-danger">'.$lang['expect.requiements'].'</div>';
			}
		}
		if(isset($_POST['makeTopic'])){
			if(isset($_GET['editTopic'])){
				$db = WebDB::dbExists('topics', $_GET['editTopic']) ? WebDB::getDB('topics', $_GET['editTopic']) : '';
			}
			$name = isset($_POST['topicName'])&&$_POST['topicName']!=='' ? $_POST['topicName'] : 0;
			$forum = isset($_POST['topicCategory'])&&$_POST['topicCategory']!=='' ? $_POST['topicCategory'] : 0;
			$getMsg = isset($_POST['topicMsg'])&&$_POST['topicMsg']!=='' ? $_POST['topicMsg'] : 0;
			if($conf['editor']==='bbcode'){
				$msg = $parseBB->toHTML($getMsg);
			}elseif($conf['editor']==='markdown'){
				$msg = $parseMD->text($getMsg);
			}else{
				$msg = $getMsg;
			}
			$author = isset($_POST['topicAuthor'])&&$_POST['topicAuthor']!=='' ? $_POST['topicAuthor'] : 0;
			$tags = isset($_POST['topicTags'])&&$_POST['topicTags']!=='' ? str_replace(' ','',$_POST['topicTags']) : 0;
			$pinned = isset($_POST['pinnedTopic']) ? $_POST['pinnedTopic'] : (isset($db['pinned']) ? $db['pinned'] : 'no');
			$locked = isset($_POST['lockedTopic']) ? $_POST['lockedTopic'] : (isset($db['locked']) ? $db['locked'] : 'no');
			if($name!=0&&$forum!=0&&$msg!=0&&$tags!=0&&$author!=0){
				echo Forum::makeTopic($name, $forum, $author, $msg, $tags, $getMsg, $pinned, $locked ,(isset($db['created']) ? $db['created'] : null)) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/forum', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/forum', 'danger');
			}else{
				echo '<div class="alert alert-danger">'.$lang['expect.requiements'].'</div>';
			}
		}
		if(isset($_GET['removeForum'])){
			foreach(Files::Scan(DATA_FORUMS) as $forums){
				$forums = Files::removeExtension($forums);
				if($forums!==$_GET['removeForum']){
				$set = WebDB::getDB('forums', $_GET['removeForum']);
				$d = WebDB::getDB('forums', $forums);
				$d['val'] = ($d['val']>$set['val'] ? $d['val'] - 1 : $d['val']);
				WebDB::saveDB('forums', $forums, $d);
				}
			
			}
			foreach(Files::Scan(DATA_TOPICS) as $topics){
				$name = Files::removeExtension($topics);
				$topic= WebDB::getDB('topics', $name);
				if($topic['forum']===$_GET['removeForum']){
					foreach(Files::Scan(DATA_REPLYS) as $replys){
					$r = Files::removeExtension($replys);
					$topID = WebDB::getDB('topics', $name);
					$db = WebDB::getDB('replys', $r);
					if(isset($db[$topID['id']])){
						WebDB::removeDB('replys',$r);
						}
					}
					WebDB::removeDB('topics',$name);
				}
				
			}
			WebDB::removeDB('forums', $_GET['removeForum']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/forum', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/forum', 'danger');
		}
		if(isset($_GET['removeTopic'])){
			foreach(Files::Scan(DATA_TOPICS) as $topics){
				$name = Files::removeExtension($topics);
				if($name===$_GET['removeTopic']){
						$name = Files::removeExtension($topics);
				foreach(Files::Scan(DATA_REPLYS) as $replys){
					$r = Files::removeExtension($replys);
					$topID = WebDB::getDB('topics', $name);
					$db = WebDB::getDB('replys', $r);
					if(isset($db[$topID['id']])){
						WebDB::removeDB('replys',$r);
					}
				}
				WebDB::removeDB('topics',$name) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/forum', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/forum', 'danger');
				}
			
			}
			Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'remove topic');
		}
		if(isset($_GET['removeReply'])){
			if(WebDB::dbExists('replys', $_GET['removeReply'])){
				Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'remove reply');
				WebDB::removeDB('replys', $_GET['removeReply']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/forum.php/view?id='.$_GET['id'], 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/forum.php/view?id='.$_GET['id'], 'danger');
			}
		}
	  ?>
<div class="display d-flex">
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-primary" style="width: 280px;">
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4"><?php echo $lang['forum.sidebar'];?></span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
	<li class="nav-item">
	<?php echo Users::hasPermission('post') ? '<button id="addtopicbtn" data-bs-toggle="modal" data-bs-target="#addTopic" class="btn btn-success w-100 mb-2 text-center"><i class="fa-solid fa-circle-plus"></i> '.$lang['forum.addTopic'].'</button>' : '';?>
	<?php echo Users::isAdmin() ? '<button data-bs-toggle="modal" data-bs-target="#addForum" class="btn btn-warning w-100 mb-2 text-center"><i class="fa-solid fa-circle-plus"></i> '.$lang['forum.addForum'].'</button>' : '';?>
	</li>
      <?php
	  echo Forum::listForums();
	  ?>
	  <hr/>
	   <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4"><?php echo $lang['forum.sidebar.statistics'];?></span>
    </a>
	<div class="text-bg-light fw-bold p-2 rounded">
    <div><?php echo $lang['dashboard.profile.forums'].count(Files::Scan(DATA_FORUMS));?></div>
	<div><?php echo $lang['dashboard.profile.topics'].count(Files::Scan(DATA_TOPICS));?></div>
	<div><?php echo $lang['dashboard.profile.replys'].count(Files::Scan(DATA_REPLYS));?></div>
	<div class="showLoad"></div>
	</div>
    </div>
	<?php
	if(isset($_GET['editTopic'])){
		$out='';
		$db = WebDB::getDB('topics', $_GET['editTopic']);
		$out.= '<div class="modal d-block" id="editTopic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5">'.$lang['forum.editTopic'].'</h1>
		<a href="'.$BASEPATH.'/forum"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col">
			<label class="form-label" for="topicName">'.(isset($lang['forum.inputTopicName']) ? $lang['forum.inputTopicName'] : 'Topic Name').'</label>
				<input type="text" id="topicName" value="'.$db['name'].'" name="topicName" class="form-control"/>
			</div>
			<div class="col">
			<label class="form-label" for="topicCategory">'.(isset($lang['forum.inputTopicCategory']) ? $lang['forum.inputTopicCategory'] : 'Select Forum').'</label>
				<select id="topicCategory" name="topicCategory" class="form-control">';
				
				foreach(Files::Scan(DATA_FORUMS) as $forums){
					$forums = str_replace('.dat.json','',$forums);
					$forums = WebDB::getDB('forums', $forums);
					$out.= '<option'.($forums['name']===$db['forum'] ? ' selected="selected"':'').' value="'.$forums['name'].'">'.$forums['name'].'</option>';
				}
				
				$out.='</select>
			</div>
		</div>
		<div class="row">
		<div class="col">
			<label for="topicMsg" class="topicMsg">'.$lang['forum.entermsg'].'('.$conf['editor'].')</label>
			<textarea id="topicMsg" name="topicMsg" class="form-control">'.$db['raw'].'</textarea>
		</div>
		<div class="col">
			<label class="form-label" for="topicAuthor">'.$lang['forum.inputTopicAuthor'].'</label>
				<input type="text" id="topicAuthor" name="topicAuthor" readonly value="'.$db['author'].'" class="form-control"/>
			</div>
		</div>
		<div class="row">
		<div class="col">
			<label class="form-label" for="topicTags">'.$lang['forum.inputTopicTags'].'</label>
				<input type="text" value="'.$db['tags'].'" id="topicTags" name="topicTags"  class="form-control"/>
			</div>
		</div>
		<div class="row">
			<div class="col">
			<label class="form-label" for="pinnedTopic">'.$lang['forum.pinned'].'</label>
				<select'.(Users::isAdmin()||Users::isMod() ? '' : ' disabled="disabled"').' class="form-control" id="pinnedTopic" name="pinnedTopic">';
				foreach($lang['forum.toggleOpt'] as $opt=>$val){
					$out.='<option'.(filter_var($opt, FILTER_VALIDATE_BOOLEAN)===$db['pinned'] ? ' selected="selected"' : '').' value="'.$opt.'">'.$val.'</option>';
				}
				$out.='</select>
			</div>
			<div class="col">
			<label class="form-label" for="lockedTopic">'.$lang['forum.locked'].'</label>
				<select class="form-control" id="lockedTopic" name="lockedTopic">';
				foreach($lang['forum.toggleOpt'] as $opt=>$val){
					$out.='<option'.(filter_var($opt, FILTER_VALIDATE_BOOLEAN)===$db['locked'] ? ' selected="selected"' : '').' value="'.$opt.'">'.$val.'</option>';
				}
				$out.='</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="makeTopic" class="btn btn-primary">'.$lang['btn.save'].'</button>
      </div>
	  </form>
	 
    </div>
  </div>
</div>';
echo $out;
Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'edit topic');
	}

?>
	<div class="modal fade" id="addTopic" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5"><?php echo $lang['forum.addTopic'];?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col">
			<label class="form-label" for="topicName"><?php echo $lang['forum.inputTopicName'];?></label>
				<input type="text" id="topicName" name="topicName" class="form-control"/>
			</div>
			<div class="col">
			<label class="form-label" for="topicCategory"><?php echo $lang['forum.inputTopicCategory'];?></label>
				<select id="topicCategory" name="topicCategory" class="form-control">
				<?php
				foreach(Files::Scan(DATA_FORUMS) as $forums){
					$forums = str_replace('.dat.json','',$forums);
					echo '<option value="'.$forums.'">'.$forums.'</option>';
				}
				?>
				</select>
			</div>
		</div>
		<div class="row">
		<div class="col">
			<label for="topicMsg" class="topicMsg"><?php echo $lang['forum.entermsg'].'('.$conf['editor'].')';?></label>
			<textarea id="topicMsg" name="topicMsg" class="form-control"></textarea>
		</div>
		<div class="col">
			<label class="form-label" for="topicAuthor"><?php echo $lang['forum.inputTopicAuthor'];?></label>
				<input type="text" id="topicAuthor" name="topicAuthor" readonly value="<?php echo $session;?>" class="form-control"/>
			</div>
		</div>
		<div class="row">
		<div class="col">
			<label class="form-label" for="topicTags"><?php echo $lang['forum.inputTopicTags'];?></label>
				<input type="text" id="topicTags" name="topicTags"  class="form-control"/>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $lang['btn.close'];?></button>
        <button type="submit" name="makeTopic" class="btn btn-primary"><?php echo $lang['btn.save'];?></button>
      </div>
	  </form>
	 
    </div>
  </div>
</div>
	<div class="modal fade" id="addForum" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5"><?php echo $lang['forum.addForum'];?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col">
			<label class="form-label" for="forumName"><?php echo $lang['forum.inputForumName'];?></label>
				<input type="text" id="forumName" name="forumName" class="form-control"/>
			</div>
			<div class="col">
			<label class="form-label" for="forumColor"><?php echo $lang['forum.inputForumColor'];?></label>
				<input type="color" id="forumColor" name="forumColor" class="form-control"/>
			</div>
		</div>
		<?php
			echo HTMLForm::loadIcons();
			?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $lang['btn.close'];?></button>
        <button type="submit" name="makeForum" class="btn btn-primary"><?php echo $lang['btn.save'];?></button>
      </div>
	  </form>
	 
    </div>
  </div>
</div>
<?php
$source = null;
if(isset($_GET['editReply'])){
	$db = WebDB::getDB('replys', $_GET['editReply']);
	$source = isset($db['raw']) ? $db['raw'] : null;
	Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'edit reply');
}
if(isset($_GET['quoteReply'])){
	global $BASEPATH;
	if($conf['editor']==='bbcode'){
		$source = '[quote]'.$_GET['quoteReply'].'[/quote]';
	}elseif($conf['editor']==='markdown'){
	$db = WebDB::getDB('replys', $_GET['quoteReply']);
		$source = '<a style="text-decoration:none;" href="./view?id=69608770#'.$_GET['quoteReply'].'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click to Show original">
		  <figure class="bg-white p-3 rounded mb-0" style="border-left: 0.25rem solid rgb(163, 78, 120);">
            <blockquote class="blockquote pb-2">
			<img class="img-fluid rounded img-thumbnail" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$db['author'].'.png') ? $BASEPATH.DATA_AVATARS.$db['author'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'">
              <p class="text-bg-secondary">
               '.$db['raw'].'
              </p>
            
            <figcaption class="blockquote-footer mb-0 font-italic">
              '.$db['author'].'
            </figcaption>
          </figure></a>';
	}else{
		$db = WebDB::getDB('replys', $_GET['quoteReply']);
		$source = '<a style="text-decoration:none;" href="./view?id=69608770#'.$_GET['quoteReply'].'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click to Show original">
		  <figure class="bg-white p-3 rounded mb-0" style="border-left: 0.25rem solid rgb(163, 78, 120);">
            <blockquote class="blockquote pb-2">
			<img class="img-fluid rounded img-thumbnail" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$db['author'].'.png') ? $BASEPATH.DATA_AVATARS.$db['author'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'">
              <p class="text-bg-secondary">
               '.$db['raw'].'
              </p>
            
            <figcaption class="blockquote-footer mb-0 font-italic">
              '.$db['author'].'
            </figcaption>
          </figure></a>';
	}
	Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'quoted reply');	
}
echo '<ul class="list-group w-100">';
if(preg_match('/\/forum(?:\.php)\/forums/', $_SERVER['REQUEST_URI'])){
	$out='';
	if(Users::isAdmin()&&isset($_SESSION['user'])){
	$out.='<h4 class="text-center text-info">'.$lang['forum.sort'].'</h4>';
	$out.='<div><form method="post">';
	$sortProper = array();
	foreach(FILES::Scan(DATA_FORUMS) as $forums){
		$forums = Files::removeExtension($forums);	
		$d = WebDB::getDB('forums', $forums);
		$sortProper[(string)$d['val']] = '<div style="background-color:'.$d['tagColor'].';" class="alert alert-secondary m-2 fs-3"><i class="'.$d['tagIcon'].'"></i> '.$d['name'].' <input type="text" name="itemName[]" style="width:0;height:0;border:0;padding:0;" value="'.$d['name'].'"/><span class="badge text-bg-secondary float-end"><input name="sortForum[]" type="number" min="1" max="'.count(Files::Scan(DATA_FORUMS)).'" class="form-control" value="'.$d['val'].'"/></span></div>';
	}
	ksort($sortProper);
	foreach($sortProper as $item => $list){
		$out.=$list;
	}
	$out.='<center><button name="sortBtn" class="btn btn-success w-75" type="submit">'.$lang['forum.shortSubmit'].'</button></center>';
	$out.='</form></div>';
	}else{
		$out.='<div class="alert alert-danger m-2">'.$lang['forum.sortUser'].'</div>';
	}
	echo $out;
	if(isset($_POST['sortBtn'])){
		$sort = $_POST['sortForum'];
		$names = $_POST['itemName'];
		$id=0;
		foreach($names as $forums){
		$d = WebDB::getDB('forums', $forums);
		$d['val'] = strval($sort[$id]);
		WebDB::saveDB('forums', $forums, $d);
		$id++;
		}
		Events::createEvent(Users::getRealIP($session), date('m/d/Y h:i:sa'), $session, 'success', 'sorted forum');
		echo Utils::redirect('modal.pedit.title', 'modal.pedit.desc', $BASEPATH.'/forum.php/forums', 'success');
	}
}elseif(preg_match('/\/forum(?:\.php)\/view/', $_SERVER['REQUEST_URI'])){
	echo Forum::loadReplys();
	echo Paginate::pageLink(Paginate::pid($conf['forum']['maxReplyDisplay']), Paginate::countPage(Files::Scan(DATA_REPLYS), $conf['forum']['maxReplyDisplay']), './view?id='.$_GET['id'].'&');
  if(isset($_GET['id'])){
	foreach(Files::Scan(DATA_TOPICS) as $topics){
		$topics = Files::removeExtension($topics);
		$db = WebDB::getDB('topics', $topics);
		
		if($db['id']===$_GET['id']){
			$db['views'] = (int)$db['views']+1;
			WebDB::saveDB('topics', $topics, $db);
			 if(!$db['locked']&&!Users::isGuest()){
				 	echo '<br/>';
	echo Users::hasPermission('reply') ? '<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#PostReply" aria-expanded="false" aria-controls="collapseExample">
   '.$lang['forum.reply_drop'].'
  </button>' : '';
	 echo Users::hasPermission('reply') ? '<div class="collapse" id="PostReply">
 <form method="post"><input type="submit" name="replySub" class="btn btn-success w-100 mt-3"/>'.$Editor->createEditor($conf['editor'], true, null, $source, true).'</form>
</div>' : '<div class="alert alert-danger ms-2 me-2"><b><i class="fa-solid fa-triangle-exclamation"></i> '.$lang['forum.noreply'].'</b></div>'; 
  }else{
	  if(Users::isGuest()&&!$db['locked']){
		  echo '<div class="alert alert-secondary mt-2 ms-2 me-2 fs-3"><a href="'.$BASEPATH.'/auth.php/login"><button class="border border-0 btn w-100 fs-3">'.$lang['fourm.guest'].'</button></a></div>';
	  }else{
		  echo '';
	  }
  }
		}
	}
  }
 
	
}else{
	echo (isset($_GET['search']) ? '' : '<h1 class="text-secondary ms-1">'.$lang['forum.recent'].'</h1>');
	echo Forum::loadTopics();
	echo Paginate::pageLink(Paginate::pid($conf['forum']['maxTopicDisplay']), Paginate::countPage(Files::Scan(DATA_TOPICS), $conf['forum']['maxTopicDisplay']), './forum?');
}

echo '</ul>';
?>

</div>
<?php
if(isset($_POST['replySub'])){
	$replyMsg = isset($_POST['editorText']) ? $_POST['editorText'] : '';
	if($conf['editor']==='bbcode'){
		$msg = $parseBB->toHTML($replyMsg);
	}elseif($conf['editor']==='markdown'){
		$msg = $parseMD->text($replyMsg);
	}else{
		$msg = $replyMsg;
	}
	echo Forum::makeReply($msg, $session, $replyMsg) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/forum.php/view?id='.$_GET['id'], 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/forum.php/view?id='.$_GET['id'], 'danger');;
}
?>

<?php echo Plugin::hook('afterPage'); ?>
<?php
echo '<br/><br/><br/><br/><br/><br/><br/>';
echo foot($BASEPATH);
?>
</body>
</html>