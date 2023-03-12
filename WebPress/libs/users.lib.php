	<?php defined('WEBPRESS') or die('Webpress community');
	class Users{
		private function __construct(){
			
		}
		public static function getRealIP($user=null){
			if($user===null){
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
			}else{
				$d = WebDB::getDB('users','users');
				$ip = filter_var($d[$user]['ip'], FILTER_VALIDATE_IP);
			}
		
		return $ip;
	}
	public static function ISO2COUNTRY($code){

    $code = strtoupper($code);

    $countryList = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas the',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island (Bouvetoya)',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros the',
        'CD' => 'Congo',
        'CG' => 'Congo the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote d\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FO' => 'Faroe Islands',
        'FK' => 'Falkland Islands (Malvinas)',
        'FJ' => 'Fiji the Fiji Islands',
        'FI' => 'Finland',
        'FR' => 'France, French Republic',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia the',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyz Republic',
        'LA' => 'Lao',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'AN' => 'Netherlands Antilles',
        'NL' => 'Netherlands the',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn Islands',
        'PL' => 'Poland',
        'PT' => 'Portugal, Portuguese Republic',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia (Slovak Republic)',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia, Somali Republic',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard & Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland, Swiss Confederation',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States of America',
        'UM' => 'United States Minor Outlying Islands',
        'VI' => 'United States Virgin Islands',
        'UY' => 'Uruguay, Eastern Republic of',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    );

    if( !isset($countryList[$code]) ) return $code;
    else return $countryList[$code];
    }
	public static function ipInfo($ip, $sel, $msg='Private Network'){ 
		# ipinfo
		$info = !@json_decode(file_get_contents('https://ipinfo.io/'.$ip.'/json'), true)['bogon'] ? true : false;
		$msg = !$info ? $msg : json_decode(file_get_contents('https://ipinfo.io/'.$ip.'/json'), true)[$sel];
		return $msg;
	}
	public static function isProVersion(){
		return file_exists(ROOT.'webpress.pro.php')&&WEBPRESSPRO ? true : false;
	}
	public static function getSession(){
		return isset($_SESSION['user'])&&WebDB::getDB('users', 'users') ? $_SESSION['user'] : false;
	}
	public static function isAdmin(){
		if(isset($_SESSION['user'])&&$_SESSION['user']!=='')
			return WebDB::getDB('users', 'users')[$_SESSION['user']]['type']==='admin' ? true : false;
		else
			return false;
			
		}
		
	public static function isMod(){
			if(isset($_SESSION['user']))
				return WebDB::getDB('users', 'users')[(isset($_SESSION['user']) ? $_SESSION['user'] : '')]['type']==='mod' ? true : false;
			else
				return false;
	}
	public static function isMember(){
		if(isset($_SESSION['user']))
			return WebDB::getDB('users', 'users')[(isset($_SESSION['user']) ? $_SESSION['user'] : '')]['type']==='member' ? true : false;
		else
			return false;
	}
	public static function isGuest(){
		if(isset($_SESSION['user']))
			return isset($_SESSION['guest']) ? true : false;
		else
			return false;
	}
	# Custom roles
	public static function isRole($role){
		if(isset($_SESSION['user']))
			return WebDB::getDB('users', 'users')[(isset($_SESSION['user']) ? $_SESSION['user'] : '')]['type']===$role ? true : false;
		else
			return false;
	}
	public static function hasPermission($access){
		$roles = json_decode(file_get_contents(ROOT.'ROLES.json'), true);
		$getRole = isset($_SESSION['user']) ? WebDB::getDB('users', 'users')[$_SESSION['user']]['type'] : '';
		return isset($roles['roles'][$getRole]['options'][$access])&&$roles['roles'][$getRole]['options'][$access] ? true : false;
	}
	public static function getRole($name=null){
		return @WebDB::getDB('users', 'users')[($name!=='' ? $name : $_SESSION['user'])]['type'];
	}
	#list Users
	public static function ListUsers($bigArg=true): array{
		$users=[];
		if($bigArg){
			return WebDB::getDB('users', 'users');
		}else{
			$users = WebDB::getDB('users', 'users');
			foreach($users as $u=>$i){
				$users[$u] = $u;
			}
			return $users;
		}
		
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
			<input type="text" readonly="" style="background-color:var(--bs-form-control-disabled-bg);" id="webuser" name="webuser" class="form-control" value="'.(isset($_SESSION['user']) ? $_SESSION['user'] : '').'" placeholder="'.$lang['modal.profile.username'].'"/>
			</div>
			<div class="col">
			<label for="webname" class="form-label">'.$lang['modal.profile.name'].'</label>
			<input type="text" disabled="" id="webname" name="webname" class="form-control" value="'.(isset($d[$_SESSION['user']]['name']) ? $d[$_SESSION['user']]['name'] : '').'" placeholder="'.$lang['modal.profile.username'].'"/>
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
			'.(!Users::isAdmin() ? '<a href="../auth.php/delete?user='.$_SESSION['user'].'"><button type="button" class="btn btn-danger">'.$lang['modal.profile.delete'].'</button></a>' : '').
			'<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$lang['btn.close'].'</button>
		  </div>
		</div>
	  </div>
	</div>';

	}
	# help hover
		public static function helpPrompt($label){
			global $lang;
			return '<i class="fas fa-question-circle" style="cursor:help;" data-bs-toggle="tooltip" data-html="true" data-bs-placement="top" title="'.$lang[$label].'"></i>';
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
		$os_array       = array('/windows nt 10.0/i'     => 'Windows 10',
								'/windows phone 8/i'    =>  'Windows Phone 8',
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
		#$addr = new RemoteAddress;
		$device = '';
		foreach ($os_array as $regex => $value) 
		{ 
		 if (preg_match($regex, $user_agent)) 
			{
				$os_platform    =   $value;
				$device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform) ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
			}
		}
		$device = ($device==='' ? 'SYSTEM':$device);
		return array('os'=>$os_platform,'device'=>$device);
	 }

	 public static function getBrowser() 
	 {
		 $found=false;
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$browser        =   "Unknown Browser";

		$browser_array  = array('/edg/i'        =>  'Microsoft Edge',
								'/safari/i'     =>  'Safari',
								'/msie/i'       =>  'Internet Explorer',
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
			$result = is_callable('shell_exec') && false === stripos(ini_get('disable_functions'), 'shell_exec') ? shell_exec("blkid -o value -s UUID") : '';  
			if(isset($result)&&stripos($result,"blkid")!==false) {
				$result = $_SERVER['HTTP_HOST'];
			}else{
				$result = '0';
			}
		}   
		return md5($salt.md5($result));
	}
	 public static function isBanned($username=null){
		 $getUser = @file_get_contents(DATA_USERS.'users.dat.json');
		 $d = json_decode($getUser, true);
		 if(isset($d[$username]['ban']['isBanned'])||isset($d[self::getSession()]['ban']['isBanned'])){
			$getUser = $username!==null ? $d[$username]['ban']['isBanned'] : $d[self::getSession()]['ban']['isBanned'];
		return $getUser ? true : false; 
		 }
		 
	 } 
	 /*actions*/
	 public static function ban($username, $type, $time='-1', $reason=''){
		 $db = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		 $db[$username]['ban']['isBanned'] = true;
		 $db[$username]['ban']['reason'] = $reason;
		 $db[$username]['ban']['time'] = $time!==(int)'-1' ? date_format(date_create($time), 'm/d/Y H:i:s') : (int)'-1';
		 $db[$username]['ban']['duration'] = date_diff(date_create(date('m/d/Y H:i:s')),date_format(date_create($time), 'm/d/Y H:i:s'));
		 $db[$username]['ban']['bannedBy'] = $type;
		 WebDB::saveDB('users', 'users', $db);
	 }
	 public static function unban($username){
		 $db = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : '';
		 $db[$username]['ban']['isBanned'] = false;
		 $db[$username]['ban']['reason'] = '';
		 $db[$username]['ban']['time'] = '';
		 $db[$username]['ban']['duration'] = '';
		 $db[$username]['ban']['bannedBy'] = '';
		 WebDB::saveDB('users', 'users', $db);
	 }
	 public static function createBadge($username){
		  $getUser = @file_get_contents(DATA_USERS.'users.dat.json');
		 $d = json_decode($getUser, true);
		 return isset($d[$username]) ? '<span class=" ms-2 me-2 badge badge-'.$d[$username]['type'].'">'.$d[$username]['type'].'</span>' : false;
	 }
	 public static function crawler_handler($user_agent){
		 $crawlers = array(
		array('Google', 'Google'),
		array('msnbot', 'MSN'),
		array('Rambler', 'Rambler'),
		array('Yahoo', 'Yahoo'),
		array('AbachoBOT', 'AbachoBOT'),
		array('accoona', 'Accoona'),
		array('AcoiRobot', 'AcoiRobot'),
		array('ASPSeek', 'ASPSeek'),
		array('CrocCrawler', 'CrocCrawler'),
		array('Dumbot', 'Dumbot'),
		array('FAST-WebCrawler', 'FAST-WebCrawler'),
		array('GeonaBot', 'GeonaBot'),
		array('Gigabot', 'Gigabot'),
		array('Lycos', 'Lycos spider'),
		array('MSRBOT', 'MSRBOT'),
		array('Scooter', 'Altavista robot'),
		array('AltaVista', 'Altavista robot'),
		array('IDBot', 'ID-Search Bot'),
		array('eStyle', 'eStyle Bot'),
		array('Scrubby', 'Scrubby robot')
		);

		foreach ($crawlers as $c)
		{
			if (stristr($user_agent, $c[0]))
			{
				return($c[1]);
			}
		}

		return false;
			
	 }
	}


	?>