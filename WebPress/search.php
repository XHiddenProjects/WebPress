<?php
require_once('init.php');
require_once('header.php');
require_once('footer.php');
require_once('libs/files.lib.php');
echo head();
?>
<style>
point{
	width:12px;
	height:12px;
	background-color:cyan;
	border-radius:50%;
	display:inline-block;
}
</style>
<ul class="list-group">
<?php
global $lang, $BASEPATH;
$results = $_GET['results'];
$success=0;
foreach(Files::Scan(DATA_TOPICS) as $topics){
	$topics = Files::removeExtension($topics);
	$search = WebDB::getDB('topics', $topics);
	if(stripos(strtolower($search['name']),strtolower($results))!==false){
		echo '<a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"><li class="list-group-item"><point></point> '.$search['name'].'</li></a>';
		$success=1;
	}else if(stripos(strtolower($search['tags']),strtolower($results))!==false){
		echo '<a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"><li class="list-group-item"><point></point> '.$search['name'].'</li></a>';
		$success=1;
	}else if(stripos(strtolower($search['author']),strtolower($results))!==false){
		echo '<a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"><li class="list-group-item"><point></point> '.$search['name'].'</li></a>';
		$success=1;
	}else if(stripos(strtolower($search['forum']),strtolower($results))!==false){
		echo '<a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"><li class="list-group-item"><point></point> '.$search['name'].'</li></a>';
		$success=1;
	}else if(stripos(strtolower($search['msg']),strtolower($results))!==false){
		echo '<a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"><li class="list-group-item"><point></point> '.$search['name'].'</li></a>';
		$success=1;
	}		
}
if($success==0){
	echo '<li class="list-group-item"><point></point> '.$lang['forum.search.failed'].'</li>';
}
?>
</ul>

<?php
echo foot($BASEPATH);
?>
