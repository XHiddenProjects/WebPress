<?php defined('WEBPRESS') or die('WebPress Community');
function calendar_install(){
	$out = '';
	$plugin = 'calendar';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
'active'=>'',
'version'=>'2.0.0', 
'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN), 
'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR', 'zh-CN')),
'config'=>array(
	'use'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),
	'allow'=>'administrator'
));
$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
WebDB::makeDB('plugins', $plugin.'/events');
$Calevents = array();
$Calevents['events']=array();
$out.= WebDB::saveDB('plugins', $plugin.'/events', $Calevents) ? '' : 'Error';
return $out;
}
function calendar_config(){
	global $lang, $BASEPATH;
	$out='';
	$plugin = 'calendar';
	$access = array('administrator'=>$lang[$plugin.'_admin'], 'anyone'=>$lang[$plugin.'_any']);
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$type = array('success'=>'success', 'warning'=>'warning', 'info'=>'info', 'danger'=>'danger', 'dark'=>'dark', 'light'=>'light');
			$out.=HTMLForm::form(CONFIG_SAVE.$plugin.'', '<div class="row">
		<div class="col w-100">
			'.HTMLForm::checkBox('form_active', $d['active']).'
		</div>
	</div><div class="row">
	<div class="col">
	'.HTMLForm::select('calendar_access', $access, $d['config']['allow']).'
	</div>
	</div>
	<div class="row">
	<div class="col">
	'.HTMLForm::simple_submit('calendar_submit', 'calendar_submit', 'mt-1 btn btn-primary').'
	</div>
	</div>'
	);
	
	return $out;
}
function calendar_onSubmit(){
		global $lang, $BASEPATH;
		$out='';
		$plugin = 'calendar';
		if(isset($_POST['calendar_submit'])){
			$active = isset($_POST['form_active']) ? $_POST['form_active'] : '';
			$access = $_POST['calendar_access'];
			
			$d = WebDB::DBexists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : '';
			$d['active'] = $active;
			$d['config']['allow'] = $access;
			$out .= WebDB::saveDB('plugins', $plugin.'/plugin', $d) ? Utils::redirect('modal.pedit.title', 'config.success', CONFIG_LOAD.$plugin, 'success') : Utils::redirect('modal.failed.title', 'config.failed', CONFIG_LOAD.$plugin, 'danger');
			return $out;
		}
}
function calendar_dblist(){
	global $BASEPATH, $lang;
	$out='';
	$plugin='calendar';
	$d = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : array('active'=>'');
	if($d['active']){
		$out.='<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_listItem'].'</a>';
	}
	return $out;
}
function calendar_view(){
	global $BASEPATH, $lang;
	$out='';
	$plugin='calendar';
	$d = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : array('active'=>'');
	if($d['active']){
		
		$out.='<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@1,600&display=swap" rel="stylesheet">';
		$out.='<style>
		.calendar{
		font-family: "Noto Sans", sans-serif;
		margin-top:80px;
		background-color:#808080;
		padding:15px;
		}
		.calendar th{
			height:30px;
			text-align:center;
			font-weight:700;
			color:#343434;
		}
		.calendar td{
			height:100px;
			color: #343434;
			overflow-y:auto;
			overflow-x:hidden;
		}
		.calendar .today{
			background: rgba(211,211,211, 0.3) !important;
			color:#f0f8ff;
		}
		.calendar th:nth-of-type(7), .calendar td:nth-of-type(7){
			color:#87ceeb;
		}
		.calendar th:nth-of-type(1), .calendar td:nth-of-type(1){
			color:#ff0000;
		}
		.calender-header{
			background-color:#ff9f00;
			padding:30px;
		}
		.calendar h3{
			margin:0;
			font-size:52px;
		}
		.calendar .split{
			background:black;
			border:3px solid black;
		}
		.calendar .event{
			display:block;
			background:lime;
			border-radius:5px;
			padding: 5px 5px 5px 8px;
			margin-bottom:5px;
		}
		</style>';
		$eventsList = WebDB::dbExists('plugins', $plugin.'/events') ? WebDB::getDB('plugins', $plugin.'/events') : '';
		$eventArgs = array();
		$setLEvents = [];
		$setInt=0;
		foreach($eventsList as $event=>$info){
			foreach($info as $event=>$dt){
				if(strtotime(date('Y-m-d H:i'))>=strtotime($dt['endDate'].' '.$dt['endTime'])){
					unset($eventsList['events'][$event]);
					 WebDB::saveDB('plugins', $plugin.'/events',$eventsList);
				}else{
					preg_match('/\-[\d]{2}$/',$dt['startDate'], $start);
					preg_match('/\-[\d]{2}$/',$dt['endDate'], $end);
					$start = str_replace(array('-',' '),'',$start[0]);
					$end = str_replace(array('-',' '),'',$end[0]);
					 array_push($eventArgs,array('name'=>$event, 'startDay'=>$start, 'endDay'=>$end, 'startDate'=>$dt['startDate'], 'startTime'=>$dt['startTime'], 'endDate'=>$dt['endDate'], 'endTime'=>$dt['endTime'], 'color'=>(isset($dt['color'])?$dt['color']:'lime'), 'icon'=>(isset($dt['icon'])&&$dt['icon']!=='' ? $dt['icon'] : '')));	
					$setInt++;
				}
				
			}
		}
		

		if(isset($_GET['ym'])){
			$ym = $_GET['ym'];
		}else{
			$ym = date('Y-m');
		}
		$timestamp = strtotime($ym,'-01');
		if(!$timestamp){
			$timestamp = time();
		}
		$today = date('Y-m-d', time());
		$html_title = date('F Y', $timestamp);
		
		$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1,1,date('Y',$timestamp)));
		$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1,1,date('Y',$timestamp)));
		$prevY = date('Y-m', mktime(0, 0, 0, date('m', $timestamp),1,date('Y',$timestamp)-1));
		$nextY = date('Y-m', mktime(0, 0, 0, date('m', $timestamp),1,date('Y',$timestamp)+1));
		$day_count = date('t', $timestamp);
		
		$str = date('w', mktime(0,0,0, date('m', $timestamp), 1, date('Y', $timestamp)));
		
		$weeks=array();
		$week='';
		$list=array();
		$setCountType=0;
		$week.=str_repeat('<td></td>', $str);
			
		
				
		for($day=1; $day<=$day_count; $day++, $str++){
			if($day<10){
				$day = '0'.$day;
			}else{
				$day = $day;
			}
			$date = $ym.'-'.$day;
		
		
			
				for($e=0;$e<count($eventArgs);$e++){
					
					
					
						if(strtotime($date)>=strtotime($eventArgs[$e]['startDate'])&&strtotime($date)<=strtotime($eventArgs[$e]['endDate'])){
							$list[$day] = isset($list[$day]) ? $list[$day] : array();
							array_push($list[$day],'<span style="background-color:'.$eventArgs[$e]['color'].'" class="event"><i class="'.$eventArgs[$e]['icon'].'"></i> '.$eventArgs[$e]['name'].'</span>');
						}
					
					
					$setCountType++;
				}
			
						
				
				
		
			if($today==$date){
				
				
				$week.='<td class="today">'.$day;
				if(isset($list[$day])){
					for($i=0;$i<count($list[$day]);$i++){
						$week.= $list[$day][$i];
					}
				}
			}else{
				$week.='<td>'.$day;
				if(isset($list[$day])){
					for($i=0;$i<count($list[$day]);$i++){
						$week.= $list[$day][$i];
					}
				}
			}
				$week.='</td>';
				
			if($str % 7 == 6 || $day == $day_count){
				if($day == $day_count){
					$week.=str_repeat('<td></td>', 6-($str % 7));
				}
				$weeks[] = '<tr>'.$week.'</tr>';
				
				$week='';
			}
			
			
		}
		$out.='<div class="modal fade" id="addEventCal" tabindex="-1" aria-labelledby="addEventCal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	 <form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addEventCal">'.$lang[$plugin.'_addEventTitle'].'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <div class="row">
		<div class="col">
		<label class="form-label">'.$lang[$plugin.'eventName'].'</label>
			<input type="text" required="required" class="form-control" name="eventName"/>
		</div>
	  </div>
	  <div class="row">
	   <div class="col">
	   <label class="form-label">'.$lang[$plugin.'_startDate'].'</label>
	   <div class="input-group">
		<span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
       <input type="date" required="required" class="form-control" name="startDate"/>
		</div>
	  </div>
	   <div class="col">
	   <label class="form-label">'.$lang[$plugin.'_startTime'].'</label>
		<div class="input-group">
		<span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
		<input type="time" required="required" class="form-control" name="startTime"/>
		</div>
	  </div>
	</div>
	 <div class="row">
	   <div class="col">
	   <label class="form-label">'.$lang[$plugin.'_endDate'].'</label>
	   <div class="input-group">
		<span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
       <input type="date" required="required" class="form-control" name="endDate"/>
		</div>
	  </div>
	   <div class="col">
	   <label class="form-label">'.$lang[$plugin.'_endTime'].'</label>
		<div class="input-group">
		<span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
		<input type="time" required="required" class="form-control" name="endTime"/>
		</div>
	  </div>
	</div>
	
	<div class="row">
	<div class="col">
	<label class="form-label">'.$lang[$plugin.'_labelColor'].'</label>
		<div class="input-group">
		<span class="input-group-text"><i class="fa-solid fa-palette"></i></span>
		<input type="color" required="required" class="form-control" name="labelcolor" value="#00ff00"/>
		</div>
	</div>
	
	</div>
	  <div class="row">
	  <div class="col">
	<label class="form-label">'.$lang[$plugin.'_labelIcon'].'</label>
		'.HTMLForm::loadIcons().'
	</div>
	  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="addEventBtn" class="btn btn-primary">'.$lang['btn.save'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
$out.='<div class="modal fade" id="removeEventCal" tabindex="-1" aria-labelledby="removeEventCal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="removeEventCal">'.$lang[$plugin.'_removeEventTitle'].'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	   <label class="form-label">'.$lang[$plugin.'_removeEventtxt'].'</label>
	   <div class="input-group">
	   <span class="input-group-text"><i class="fa-solid fa-quote-left"></i></span>
        <input required="" type="text" readonly="true" class="form-control eventNameRemover" name="eventNameRemover"/>
		<span class="input-group-text"><i style="transform:rotateX(180deg);" class="fa-solid fa-quote-right"></i></span>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="eventNameRem" class="btn btn-danger">'.$lang['btn.delete'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
		$out.='<div class="context-menu">
		<ul>
		<span class="dayTxt">Day:</span>
			<li><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventCal">'.$lang[$plugin.'_addEvent'].'</button></li>
			<li><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeEventCal">'.$lang[$plugin.'_removeEvent'].'</button></li>
		</ul>
			</div>';
		$out.='<div class="container calendar">
		<div class="calender-header">
			<h3 class="text-center"><a href="?plugins='.$plugin.'&ym='.$prevY.'"><i class="fa-solid fa-caret-left"></i><i class="fa-solid fa-caret-left"></i></a> <span class="split me-3"></span> <a href="?plugins='.$plugin.'&ym='.$prev.'"><i class="fa-solid fa-caret-left"></i></a>'.$html_title.'<a href="?plugins='.$plugin.'&ym='.$next.'"><i class="fa-solid fa-caret-right"></i></a> <span class="me-3 split"></span> <a href="?plugins='.$plugin.'&ym='.$nextY.'"><i class="fa-solid fa-caret-right"></i><i class="fa-solid fa-caret-right"></i></a></h3>
		</div>
			<table class="table table-bordered" nostyle>
				<thead>
					<tr>
						<th>Sun</th>
						<th>Mon</th>
						<th>Tus</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri</th>
						<th>Sat</th>
					</tr>
				</thead>
				<tbody>
					';
					foreach($weeks as $week){
						$out.=$week;
					}
				$out.='
				</tbody>
			</table>
		</div>';
	}
	$template = @explode('-',$ym);
	$out.="<script>
	window.addEventListener('load', function(){
		let td = document.querySelectorAll('td');
		for(let i=0;i<td.length;i++){
			if(td[i].innerText!==''){
				td[i].setAttribute('oncontextmenu','showContextMenu(); return false;');
			}
			
		}
	});
	
	var contextMenu;
window.onclick = hideContextMenu;
window.onkeydown = listenKeyMenu;
window.addEventListener('load', function(){
	 contextMenu = document.querySelector('.context-menu');
});

function showContextMenu(){
	contextMenu.style.display = 'block';
	contextMenu.style.left = event.clientX + 'px';
	contextMenu.style.top = event.clientY + 'px';

	return false;
}
function hideContextMenu(){
	contextMenu.style.display = 'none';
}
function listenKeyMenu(event){
	const key = event.keyCode || event.which;
	if(key==27){
		hideContextMenu();
	}
}
$(document).ready(function(){
		$('.calendar table tbody').contextmenu(function(event){
			//dateStanders
			
			if(!event.target.innerHTML.match(/\<span/)&&!event.target.innerText.match(/^[\d]{1,2}/)){
				document.querySelector('.eventNameRemover').value=event.target.innerText;
			}
			
			let numberOnly = event.target.innerText.match(/^[\d]{1,2}/,'');
			$('.dayTxt').html('".$template[1]."/'+numberOnly[0]+'/".$template[0]."');
			document.querySelector('[name=\"startDate\"]').value='".$template[0]."-".$template[1]."-'+numberOnly[0];
			document.querySelector('[name=\"startTime\"]').value = '".date('H:i')."';
			document.querySelector('[name=\"endDate\"]').value='".$template[0]."-".$template[1]."-'+numberOnly[0];
			document.querySelector('[name=\"endTime\"]').value = '".date('H:i', strtotime("+1 hours"))."';
			
			
	});
});


	</script>";
	
	if(isset($_POST['addEventBtn'])){
		global $session;
		$name = $_POST['eventName'];
		$startDate = $_POST['startDate'];
		$startTime = $_POST['startTime'];
		$endDate = $_POST['endDate'];
		$endTime = $_POST['endTime'];
		$color = $_POST['labelcolor'];
		$icon = isset($_POST['iconpicker'])&&$_POST['iconpicker']!=='' ? $_POST['iconpicker'] : '';
		
		
		$e = WebDB::dbExists('plugins', $plugin.'/events') ? WebDB::getDB('plugins', $plugin.'/events') : '';
		$e['events'][$name] = array(
			'startDate'=>$startDate,
			'startTime'=>$startTime,
			'endDate'=>$endDate,
			'endTime'=>$endTime,
			'color'=>$color,
			'icon'=>$icon,
			'created'=>$session
		);
		echo WebDB::saveDB('plugins', $plugin.'/events', $e) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/view?plugins='.$plugin.(isset($_GET['ym']) ? '&ym='.$_GET['ym'] : '').'', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/view?plugins='.$plugin.(isset($_GET['ym']) ? '&ym='.$_GET['ym'] : '').'', 'danger');
	}
	if(isset($_POST['eventNameRem'])){
		$name = preg_replace('/^\s/','',$_POST['eventNameRemover']);
		$e = WebDB::dbExists('plugins', $plugin.'/events') ? WebDB::getDB('plugins', $plugin.'/events') : '';
		unset($e['events'][$name]);
		if($name!==''){
			echo WebDB::saveDB('plugins', $plugin.'/events', $e) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/view?plugins='.$plugin.(isset($_GET['ym']) ? '&ym='.$_GET['ym'] : '').'', 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/view?plugins='.$plugin.(isset($_GET['ym']) ? '&ym='.$_GET['ym'] : '').'', 'danger');	
		}else{
			echo Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/view?plugins='.$plugin.(isset($_GET['ym']) ? '&ym='.$_GET['ym'] : '').'', 'danger');
		}
		
	}
	return $out;
}
function calendar_beforePage(){
	global $lang;
	$out='';
	$plugin='calendar';
	$d = WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::getDB('plugins', $plugin.'/plugin') : ['active'=>''];
	if($d['active']){
	$events = WebDB::dbExists('plugins', $plugin.'/events') ? WebDB::getDB('plugins', $plugin.'/events') : '';	
	foreach($events['events'] as $e=>$info){
			if(strtotime(date('Y-m-d H:i'))>=strtotime($info['startDate'].$info['startTime'])&&strtotime(date('Y-m-d H:i'))<=strtotime($info['endDate'].$info['endTime'])){
				$out.='<div class="alert" style="background-color:'.$info['color'].';"><i class="'.$info['icon'].'"></i> '.$e.'</div>';
			}
		}
	}
	return $out;
}
?>