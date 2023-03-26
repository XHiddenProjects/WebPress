<?php
require_once('init.php');
require_once('header.php');
require_once('footer.php');
require_once('libs/files.lib.php');
echo head();
?>
<ul class="list-group list-group-flush list-group-numbered">
<?php
global $lang, $BASEPATH;
$results = $_GET['results'];
$success=0;
foreach(Files::Scan(DATA_TOPICS) as $topics){
	$topics = Files::removeExtension($topics);
	$search = WebDB::getDB('topics', $topics);
	if(stripos(strtolower($search['name']),strtolower($results))!==false){
		echo '<li class="list-group-item list-group-item-action"><a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"> '.$search['name'].'</a></li>';
		$success=1;
	}else if(stripos(strtolower($search['tags']),strtolower($results))!==false){
		echo '<li class="list-group-item list-group-item-action"><a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"> '.$search['name'].'</a></li>';
		$success=1;
	}else if(stripos(strtolower($search['author']),strtolower($results))!==false){
		echo '<li class="list-group-item list-group-item-action"><a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"> '.$search['name'].'</a></li>';
		$success=1;
	}else if(stripos(strtolower($search['forum']),strtolower($results))!==false){
		echo '<li class="list-group-item list-group-item-action"><a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"> '.$search['name'].'</a></li>';
		$success=1;
	}else if(stripos(strtolower($search['msg']),strtolower($results))!==false){
		echo '<li class="list-group-item list-group-item-action"><a href="'.$BASEPATH.'/forum.php/view?id='.$search['id'].'"> '.$search['name'].'</a></li>';
		$success=1;
	}		
}
if($success==0){
	echo '<li class="list-group-item"> '.$lang['forum.search.failed'].'</li>';
}
?>
</ul>

<?php
echo foot($BASEPATH);
?>
