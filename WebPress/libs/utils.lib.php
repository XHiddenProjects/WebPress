<?php defined('WEBPRESS') or die('Webpress community');
class Utils{
	protected function __construct(){
		
	}
	public static function redirect($title, $desc, $redirect, $type='success'){
		global $lang;
		echo '
		<div class="modal position-static d-block" tabindex="-1" style="z-index:10000;">
    <div class="modal-dialog">
      <div class="modal-content text-light bg-'.$type.'">
        <div class="modal-header">
          <h5 class="modal-title">'.(isset($lang[$title]) ? $lang[$title] : '').'</h5>
        </div>
        <div class="modal-body">
		<center><i class="fas fa-spinner" id="webpress-spinner"></i>
          <p>'.(isset($lang[$desc]) ? $lang[$desc] : '').'</p></center>
        </div>
       
      </div>
    </div>
  </div>
  <script>
  setTimeout(function(){
	  window.open("'.$redirect.'", "_self");
  }, 3000);
  </script>
		';
	}
	public static function change_key( $array, $old_key, $new_key ) {

    if( ! array_key_exists( $old_key, $array ) )
        return $array;

    $keys = array_keys( $array );
    $keys[ array_search( $old_key, $keys ) ] = $new_key;

    return array_combine( $keys, $array );
		}

	public static function profileSave($data){
		global $lang;
	 $db = WebDB::getDB('users','users');
	//$saved	= json_encode($data, JSON_PRETTY_PRINT);
	foreach($data as $d=>$v){
		if($d==="name"){
			$db[$_SESSION['user']]['name'] = $v;
		}elseif($d==="about"){
		$db = WebDB::getDB('users', 'users');
		$db[$_SESSION['user']]['about'] = $v;
		}elseif($d==="password"){
					$psws = explode('+',$v);
					if($psws[0]!==''||$psws[1]!==''){
						if(preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $psws[0]) && preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $psws[1])){
				$db = WebDB::getDB('users', 'users');
				if(password_verify($psws[0], $db[$_SESSION['user']]['psw'])){
				$changepsw = password_hash($psws[1], PASSWORD_BCRYPT, ['cost'=>15]);
				$db[$_SESSION['user']]['psw']= $changepsw;
					
				}else{
				echo '<div class="alert alert-danger">'.$lang['modal.pedit.psw.match'].'</div>';	
				}
			}else{
				echo '<div class="alert alert-danger">'.$lang['modal.pedit.psw.format'].'</div>';
			}
					}
		}
	}
	WebDB::dbExists('users','users') ? WebDB::saveDB('users','users', $db) : '';
	
	
	}
	public static function dateTime($dt){
		$days = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');
		$months = array('01'=>'jan','02'=>'feb','03'=>'mar','04'=>'apr','05'=>'may','06'=>'june','07'=>'july','08'=>'aug','09'=>'sept','10'=>'oct','11'=>'nov','12'=>'dec');
		$year = date('Y');
		if($dt==="days"){
			return $days;
		}elseif($dt==="months"){
			return $months;
		}else{
			return $year;	
		}
	}
	public static function dateTimeData(){
		return array('jan'=>'0,','feb'=>'0,','mar'=>'0,','apr'=>'0,','may'=>'0,','june'=>'0,','july'=>'0,','aug'=>'0,','sept'=>'0,','oct'=>'0,','nov'=>'0,','dec'=>'0,');
	}
	public static function isPost($reciver, $returnBool=false, $func=''){
		if(!$returnBool){
		if(isset($_POST[$reciver]) && is_string($_POST[$reciver])){
		 return $func();
		}	
		}else{
			return isset($_POST[$reciver]) && is_string($_POST[$reciver]);
		}
	}
	public static function isGET($reciver, $returnBool=false, $func=''){
		if(!$returnBool){
			if(isset($_GET[$reciver]) && is_string($_GET[$name])){
				return $func();
			}
		}else{
			return isset($_GET[$name]) && is_string($_GET[$name]);
		}
		
	}
	public static function isREQUEST($reciver, $returnBool=false, $func=''){
		if(!$returnBool){
			if(isset($_REQUEST[$reciver])){
		 return $func();
			}
		}else{
			return isset($_REQUEST[$reciver]) && is_string($_REQUEST[$reciver]);
		}
		
	}
	public static function checkVersion(){
		$v1 = file_get_contents(ROOT.'VERSION');
		$v2 = preg_replace('/\n|\s$/','',file_get_contents('https://raw.githubusercontent.com/surveybuilderteams/WebPress/master/VERSION'));
		$checkVer = $v1===$v2 ? true : false;
		$checkVer = $checkVer ? $v1 : $v1.'->'.$v2;
		$args = array(($v1===$v2 ? true : false), $checkVer);
		return $args;
	}
	public static function getVersion(){
		$current = file_get_contents(ROOT.'VERSION');
		return $current;
	}
	public static function getUpdates($version='', $file='UPDATES.json'){
		global $lang;
		$updates = json_decode(file_get_contents($file), true);
		$out = '';
		$out .= '<ul class="list-group list-group-flush">';
		if(isset($updates['versions'][($version!=='' ? $version : Utils::getVersion())]['textsets'])){
			foreach($updates['versions'][($version!=='' ? $version : Utils::getVersion())]['textsets'] as $main){
					if($main['show']===true){
					$out .= '<li'.(isset($main['tag']) ? ' tag-alert="'.$main['tag'].'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$main['tag'].'"' : '').' class="list-group-item list-group-item-'.(isset($main['type']) ? $main['type'] : 'success').'"><div role="alert" class="notify-alert fade show '.(isset($main['dismissible'])&&$main['dismissible']===true ? 'alert-dismissible' : '').' alert alert-'.(isset($main['type']) ? $main['type'] : 'success').'">'.(isset($main['icon']) ? '<i class="'.$main['icon'].'"></i> ' : '').$main['text'].(isset($main['dismissible'])&&$main['dismissible']===true ? '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' : '').'</div></li>';
					}else{
					$out.='';
					}
				
			}
		}else{
			if($updates['versions'][Utils::getVersion()]['show']===true){
			$out .= '<li'.(isset($updates['versions'][Utils::getVersion()]['tag']) ? ' tag-alert="'.$updates['versions'][Utils::getVersion()]['tag'].'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$updates['versions'][Utils::getVersion()]['tag'].'"' : '').' class="list-group-item list-group-item-'.(isset($updates['versions'][Utils::getVersion()]['type']) ? $updates['versions'][Utils::getVersion()]['type'] : 'success').'"><div role="alert" class="notify-alert fade show '.(isset($updates['versions'][Utils::getVersion()]['dismissible'])&&$updates['versions'][Utils::getVersion()]['dismissible']===true ? 'alert-dismissible' : '').' alert alert-'.(isset($updates['versions'][Utils::getVersion()]['type']) ? $updates['versions'][Utils::getVersion()]['type'] : 'success').'">'.(isset($updates['versions'][Utils::getVersion()]['icon']) ? '<i class="'.$updates['versions'][Utils::getVersion()]['icon'].'"></i> ' : '').$updates['versions'][Utils::getVersion()]['text'].(isset($updates['versions'][Utils::getVersion()]['dismissible'])&&$updates['versions'][Utils::getVersion()]['dismissible']===true ? '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' : '').'</div></li>';			
			}else{
			$out.='';
			}

		}
		$out .= '</ul>';
		return $out;
	}
	public static function catche($type){
	
		$e = constant('DATA_'.strtoupper($type));
		foreach(Files::Scan($e) as $catche){
			if(file_exists($e.$catche.DS)){
				Files::catche($e.$catche.DS);
			}else{
				#nothing
			}
			
		}
	}
	public static function notification($version='', $file='UPDATES'){
		global $lang;
		$out='';
		$id = uniqid();
		$updates = json_decode(file_get_contents(ROOT.$file.'.json'), true);
		$out.='<div class="notify-container">
	   <button type="button" class="position-relative" style="background-color:transparent;border:0;" data-bs-toggle="collapse" data-bs-target="#panel-notify" aria-expanded="false" aria-controls="panelNotify"><i class="fas fa-bell"></i>'.
	   ($updates['needsAttation'] ? 
	   '<span class="position-absolute top-0 start-75 translate-middle p-1 bg-danger border border-light rounded-circle"><span class="visually-hidden">New alerts</span></span>' : 
	   '').
	   '</button>
		<div id="panel-notify" class="collapse text-bg-secondary">
		 <a href="./mail?notify=clear" class="link-light">'.$lang['notify.clear'].'</a>
			'.Utils::getUpdates($version, (!preg_match('/\.json/',$file) ? $file.'.json' : $file)).'
		</div>
	</div>';
	return $out;
	}
	public static function RGB2Hex($r,$g,$b){
		return sprintf("#%02x%02x%02x", (int)$r, (int)$g, (int)$b);
	}
	public static function toDate($id, $pattern = 'Y/m/d H:i', $cooldate = true)
	{
		global $lang, $conf;
		$timestamp = strtotime(substr($id, 0, 16));
		$diff = time() - $timestamp;
		if($pattern === $conf['page']['dateFormat'] && $cooldate && $diff < 604800) //1 week
		{
			$periods = array(86400 => $lang['day'], 3600 => $lang['hour'], 60 => $lang['minute'], 1 => $lang['second']);
			foreach($periods as $key => $value)
			{
				if($diff >= $key)
				{
					$num = (int) ($diff / $key);
					if(TIMESTAMP)
						$date = $num. ' ' .$value.($num > 1? $lang['plural'] : ''). ' ' .$lang['ago'];
					else
						$date = $lang['ago']. ' ' .$num. ' ' .$value.($num > 1? $lang['plural'] : '');
				}
			}
		} 
		if($conf['lang']==='fr-FR') 
		{
			$date = strftime($pattern, $timestamp);
		} 
		else 
		{
			$date = date($pattern, $timestamp);
		}
		return $date;
	}
	
}
?>