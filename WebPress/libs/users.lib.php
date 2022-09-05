<?php
class Users{
	private function __construct(){
		
	}
	public static function getRealIP(){
	if($_SERVER['SERVER_NAME'] === "localhost"){
			$ip = getHostByName(getHostName());
		}elseif(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
public static function ipInfo($ip, $sel, $msg=''){ 
	# ipinfo
	$info = @json_decode(file_get_contents('https://ipinfo.io/'.$ip.'/json'), true) ? true : false;
	$msg = $msg!=='' ? $msg : 'Failed to connect';
	$msg = !$info ? 'Failed to connect' : $msg;
	return $msg;
}
public static function isProVersion(){
	return file_exists(ROOT.'webpressPro') ? file_get_contents(ROOT.'webpressPro') : false;
}
public static function getSession(){
	return isset($_SESSION['user'])&&WebDB::getDB('users', 'users') ? $_SESSION['user'] : false;
}
public static function isAdmin(){
	return WebDB::getDB('users', 'users')[$_SESSION['user']]['type']==='admin' ? true : false;
}
public static function isMod(){
	return WebDB::getDB('users', 'users')[$_SESSION['user']]['type']==='mod' ? true : false;
}
public static function isMember(){
	return WebDB::getDB('users', 'users')[$_SESSION['user']]['type']==='member' ? true : false;
}
# Custom roles
public static function isRole($role){
	return WebDB::getDB('users', 'users')[$_SESSION['user']]['type']===$role ? true : false;
}
#list Users
public static function ListUsers(){
	return WebDB::getDB('users', 'users');
}
#editProfile
public static function editProfile($base=''){
	global $lang;
	$d = WebDB::getDB('users','users');
	return '<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="apedit" tabindex="-1" aria-labelledby="apeditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="apeditlable">'.$lang['modal.profile'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
		<div class="row">
		<div class="col">
		<label for="webuser" class="form-label">'.$lang['modal.profile.username'].'</label>
		<input type="text" id="webuser" name="webuser" class="form-control" value="'.(isset($_SESSION['user']) ? $_SESSION['user'] : '').'" placeholder="'.$lang['modal.profile.username'].'"/>
		</div>
		<div class="col">
		<label for="webname" class="form-label">'.$lang['modal.profile.name'].'</label>
		<input type="text" id="webname" name="webname" class="form-control" value="'.(isset($d[$_SESSION['user']]['name']) ? $d[$_SESSION['user']]['name'] : '').'" placeholder="'.$lang['modal.profile.username'].'"/>
		</div>
		</div>
		<div class="row">
		<div class="col">
		<label for="webpsw" class="form-label">'.$lang['modal.profile.oldpsw'].'</label>
		<input type="password" id="webpsw" name="webpsw" class="form-control" placeholder="'.$lang['modal.profile.oldpsw'].'"/>
		  <div class="invalid-feedback">
      Please provide your old password.
    </div>
		</div>
		<div class="col">
		<label for="webnpsw" class="form-label">'.$lang['modal.profile.newpsw'].'</label>
		<input type="password" id="webnpsw" name="webnpsw" class="form-control" placeholder="'.$lang['modal.profile.newpsw'].'"/>
		<p class="text-muted">'.$lang['modal.profile.newpsw.note'].'</p>
		</div>
		</div>
		<div class="row">
		<div class="col">
		<label for="webabout" class="form-label">'.$lang['modal.profile.about'].' <span class="text-muted">(HTML is allowed)</span></label>
		<textarea style="height:115px;" id="webabout" class="form-control" name="webabout" placeholder="'.$lang['modal.profile.about'].'">'.$d[$_SESSION['user']]['about'].'</textarea>
		</div>
		</div>
		
		<div class="row">
		<label for="webimg" class="form-label">'.$lang['modal.profile.upload'].'</label>
		<input type="file" name="profileicon" id="webimg" class="form-control" accept=".png"/>
		</div>
		'.Plugin::hook('edit_profile').'
		<div class="row mt-2">
		    <div class="col"><button type="submit" name="profileEdit" class="btn btn-primary">'.$lang['btn.save'].'</button></div>
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button>
      </div>
    </div>
  </div>
</div>';

}
# help hover
	public static function helpPrompt($label){
		global $lang;
		return '<i class="fas fa-question-circle" style="cursor:help;" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$lang[$label].'"></i>';
	}
# getSelectedLang
	public static function getLang(){
		global $conf;
		return isset($conf['lang']) ? explode('-',$conf['lang'])[0] : '';
	}

 public static function getSystInfo()
 {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform    = "Unknown OS Platform";
    $os_array       = array('/windows phone 8/i'    =>  'Windows Phone 8',
                            '/windows phone os 7/i' =>  'Windows Phone 7',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile');
    $found = false;
    $addr = new RemoteAddress;
    $device = '';
    foreach ($os_array as $regex => $value) 
    { 
        if($found)
         break;
        else if (preg_match($regex, $user_agent)) 
        {
            $os_platform    =   $value;
            $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                      ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
        }
    }
    $device = !$device? 'SYSTEM':$device;
    return array('os'=>$os_platform,'device'=>$device);
 }

 public static function getBrowser() 
 {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  = array('/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser');

    foreach ($browser_array as $regex => $value) 
    { 
        if($found)
         break;
        else if (preg_match($regex, $user_agent,$result)) 
        {
            $browser    =   $value;
        }
    }
    return $browser;
 }
 
  public static function hardwareID($salt="") {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
        if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
        $output = shell_exec("diskpart /s ".$temp);
        $lines = explode("\n",$output);
        $result = array_filter($lines,function($line) {
            return stripos($line,"ID:")!==false;
        });
        if(count($result)>0) {
            $result = @array_shift(array_values($result));
            $result = explode(":",$result);
            $result = trim(end($result));       
        } else $result = $output;       
    } else {
        $result = shell_exec("blkid -o value -s UUID");  
        if(stripos($result,"blkid")!==false) {
            $result = $_SERVER['HTTP_HOST'];
        }
    }   
    return md5($salt.md5($result));
}
 public static function isBanned($username=null){
	 $getUser = file_get_contents(DATA_USERS.'users.dat.json');
	 $d = json_decode($getUser, true);
	 if(isset($d[$username]['ban']['isBanned'])||isset($d[self::getSession()]['ban']['isBanned'])){
		$getUser = $username!==null ? $d[$username]['ban']['isBanned'] : $d[self::getSession()]['ban']['isBanned'];
	return $getUser ? true : false; 
	 }
	 
 } 
}


?>