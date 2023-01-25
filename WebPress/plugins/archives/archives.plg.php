<?php defined('WEBPRESS') or die('WebPress Community');
function archives_install(){
	$out = '';
	$plugin = 'archives';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'2.0.0', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR')),
'config'=>array(
	'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN)
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
return $out;
}
function archives_nav(){
	global $BASEPATH, $lang;
	$out='';
	$plugin='archives';
	$d = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']){
		$out.='<li class="dropdown-item me-2"><a class="link-primary" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'"><i class="fa-solid fa-box-archive"></i> '.$lang[$plugin.'_Listname'].'</a></li>';	
	}
	return $out;
}
function archives_view(){
global $BASEPATH, $lang;
	$out='';
	$plugin='archives';	
	$year = (isset($_GET['year']) ? $_GET['year'] : null);
	$d = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
	if($d['active']&&$year){
		 	$archivedPosts = array();
		$topics = Files::Scan(DATA_TOPICS);
		sort($topics);
		foreach($topics as $topic)
		{
		    if($year === substr($topic, 0, 4))
		    {
		        $month = substr($topic, 5, 2);
		        $archivedPosts[$month][] = $topic;
		    } 
		}
		if(!$archivedPosts)
			$out .= '<div class="alert alert-danger">'.$lang[$plugin.'_no_archive'].'</div>';
		else        
			$out .= '<h4><a href="./view?plugins='.$plugin.'" data-toggle="tooltip" data-placement="top" title="' .$lang[$plugin.'_back']. '"><i class="fa-solid fa-circle-left"></i></a> ' .$year. '</h4>
		
		<div class="row lh-100 d-flex p-3 my-3 bg-white rounded box-shadow">';	
		ksort($archivedPosts);	  
		foreach($archivedPosts as $monthPosts)
		{
		    $out .= '<div class="col-4">
			    <h6>'.Utils::toDate(preg_replace('/\-[\d\w]+$/','',Files::removeExtension($monthPosts[0])), 'F'). '</h6>
			    <ul class="list-unstyled">';
			    foreach($monthPosts as $topic)
			    {
					$topic = Files::removeExtension($topic);
			        $topicEntry = WebDB::getDB('topics', $topic);
			        $out .= '<li><small>' .Utils::toDate($topicEntry['created'], 'jS'). ' - <a href="/'.MAINDIR.'/forum.php/view?id=' .$topicEntry['id']. '">' .$topicEntry['name']. '</a></small></li>';
			    }
			    $out .= '</ul>
		    	</div>';
		}
		$out .= '</div>';
	}else{
		$out.='<h4 class="text-secondary text-center">'.$lang[$plugin.'_name'].'</h4>';
		$archives = (isset($archives) ? $archives : null);
		$archives = array();
		$topics = Files::Scan(DATA_TOPICS);
		sort($topics);
		foreach($topics as $topic)
		{
			$year = substr($topic, 0, 4);
			if(isset($archives[$year]))
				$archives[$year]++;
			else
				$archives[$year] = 1;
		}
		
		$out .= '<div class="row">';
		if($archives){
			#natcasesort($archives);					
			foreach($archives as $years => $count)
				$out .= '<div class="col m-2">
							<a href="./view?plugins='.$plugin.'&year='.$years.'" class="btn btn-primary">
								' .$years. ' <small class="badge badge-light">' .intval($count). '</small>
							</a>
						</div>';
		} else {
			$out .= '<div class="col">' .$lang['none']. '</div>';
		}
		$out .= '</div>';	
	}
	return $out;
}
?>