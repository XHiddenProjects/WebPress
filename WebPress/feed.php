<?php
require_once('init.php');
require_once('libs/files.lib.php');
require_once('libs/webdb.lib.php');
require_once('libs/utils.lib.php');
require_once('libs/page.lib.php');
require_once('libs/users.lib.php');
require_once('libs/forum.lib.php');
require_once('libs/Pagination.lib.php');
global $conf;
$baseURL = ROOT;
$t = '';
if(preg_match('/\/feed(?:\.php)\/topics/', $_SERVER['REQUEST_URI'])){
	$t = 'Topics - '.MAINDIR;
}else if(preg_match('/\/feed(?:\.php)\/replies/', $_SERVER['REQUEST_URI'])){
	$t = 'Replies - '.MAINDIR;
}
header('Content-Type: application/xml; charset=utf-8');
echo '<feed xmlns="http://www.w3.org/2005/Atom" xml:base="'.preg_replace('/feed.php\/[\w]+/','',Utils::baseURL()).'">'.
PHP_EOL;
$u = WebDB::getDB('users', 'users');
echo '<id>'.Utils::baseURL().'</id>'.
	  '<title>'.$t.'</title>'.
	  '<subtitle>'.$conf['page']['description'][Users::getLang()].'</subtitle>'.
	  '<updated>'.Utils::toDate(date('Y-m-d h:i:sa',filemtime('feed.php')), 'c').'</updated>'.
	  '<link href="'.preg_replace('/\/'.MAINDIR.'\//','',$_SERVER['REQUEST_URI']).'" rel="self"></link>'.
	  '<author>
		<name>'.$conf['page']['author'].'</name>
		<email>'.reset($u)['email'].'</email>
	  </author>'.
	  '<feedbase>
		<item>Topics</item>
		<item>Replies</item>
	  </feedbase>'.PHP_EOL;
if(preg_match('/\/feed(?:\.php)\/topics/', $_SERVER['REQUEST_URI'])){
	foreach(Files::Scan(DATA_TOPICS) as $topics){
		$topic = Files::removeExtension($topics);
		echo '<entry>
			<id>'.WebDB::getDB('topics', $topic)['id'].'</id>
			<title>'.WebDB::getDB('topics', $topic)['name'].'</title>
			<created>'.Utils::toDate(WebDB::getDB('topics', $topic)['created'],'c').'</created>
			<updated>'.Utils::toDate(WebDB::getDB('topics', $topic)['edited'],'c').'</updated>
			<link href="'.str_replace('feed.php','forum.php',Utils::baseURL()).'/view?id='.WebDB::getDB('topics', $topic)['id'].'"></link>'.
			'<author>'.WebDB::getDB('topics', $topic)['author'].'</author>'.
			'<tags>'.WebDB::getDB('topics', $topic)['tags'].'</tags>'.
			'<summary type="html">'.htmlspecialchars(Page::summary(WebDB::getDB('topics', $topic)['msg']), ENT_XML1 | ENT_QUOTES, 'UTF-8').'</summary>'.
		'</entry>';
	}
}
if(preg_match('/\/feed(?:\.php)\/replies/', $_SERVER['REQUEST_URI'])){
	$replies = WebDB::listDB('replys');
	$nb = $conf['forum']['maxReplyDisplay'];
	$total = Paginate::countPage($replies, $nb);
	$p = Paginate::pid($total);	
	arsort($replies, SORT_NATURAL | SORT_FLAG_CASE);
	foreach(Paginate::viewPage($replies, $p, $nb) as $replys){
		$replys = Files::removeExtension($replys);
		$gt = WebDB::getDB('topics',Forum::getTopicsByID(WebDB::getDB('replys', $replys)['topic']));
		echo '<entry>
			<id>'.WebDB::getDB('replys', $replys)['id'].'</id>
			<topic>'.WebDB::getDB('replys', $replys)['topic'].'</topic>
			<created>'.Utils::toDate(WebDB::getDB('replys', $replys)['created'],'c').'</created>
			<updated>'.Utils::toDate(WebDB::getDB('replys', $replys)['edited'],'c').'</updated>
			<link href="'.str_replace('feed.php','forum.php',Utils::baseURL()).'/view?id='.WebDB::getDB('replys', $replys)['topic'].'&#38;p='.(Utils::onPage($replys, $gt['replys'])).'#'.WebDB::getDB('replys', $replys)['id'].'"></link>'.
			'<author>'.WebDB::getDB('replys', $replys)['author'].'</author>'.
			'<summary type="html">'.htmlentities(Page::summary(WebDB::getDB('replys', $replys)['msg']), ENT_XML1 | ENT_QUOTES, 'UTF-8').'</summary>'.
		'</entry>';
	}
}
echo '</feed>';
?>