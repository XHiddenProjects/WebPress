	<?php defined('WEBPRESS') or die('Webpress community');
	class Utils{
		protected function __construct(){
			
		}
		public static function baseURL(){
			$host = $_SERVER['HTTP_HOST'];
			$uri = $_SERVER['REQUEST_URI'];
			if(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on')
				return 'https://'.$host.$uri;
			else
				return 'http://'.$host.$uri;
		}
		public static function redirect($title, $desc, $redirect, $type='success'){
			global $lang;
			echo '
			<div class="bg-light w-100 h-100 position-absolute top-0" style="z-index:9999;"><div class="modal position-absolute d-block" data-ignore="true" tabindex="-1" style="z-index:10000;top:10%;left:50%;transform:translateX(-50%);">
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
	  </div></div>
	  <script>
	 setInterval(function(){
		let m = document.querySelectorAll(".modal:not([data-ignore])");
			document.body.style.overflow="hidden";
			for(let i=0;i<m.length;i++){
				if(m[i].className.match(/d-block/g)){
					m[i].className = m[i].className.replace("d-block","");
				}
			}
	 });
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
		public static function isGETValidEntry($type, $name, $dbType='.dat.json')
		{
			return Utils::isGET($name) && WebDB::dbExists($type, $_GET[$name]);
		}
		
		public static function isGETValidHook($hook, $name)
		{
			return Utils::isGET($name) && Plugin::isValidHook($hook, $_GET[$name]);
		}
		public static function onPage($item, $items)
		{
			global $conf;
			return (int) (array_search($item, array_values($items), true) / $conf['forum']['maxReplyDisplay']) + 1;
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
				}
			}
		}
		public static function standtomil($hrs, $apm){
			$am = [
				'12'=>'00',
				'01'=>'01',
				'02'=>'02',
				'03'=>'03',
				'04'=>'04',
				'05'=>'05',
				'06'=>'06',
				'07'=>'07',
				'08'=>'08',
				'09'=>'09',
				'10'=>'10',
				'11'=>'11',
			];
			$pm = [
				'12'=>'12',
				'01'=>'13',
				'02'=>'14',
				'03'=>'15',
				'04'=>'16',
				'05'=>'17',
				'06'=>'18',
				'07'=>'19',
				'08'=>'20',
				'09'=>'21',
				'10'=>'22',
				'11'=>'23',
			];
			if($apm==='pm'){
				$hrs = str_replace($hrs, $pm[$hrs], $hrs);
			}elseif($apm==='am'){
				$hrs = str_replace($hrs, $am[$hrs], $hrs);
			}
			return $hrs;
		}
		public static function get_time_ago($t){
			global $lang;
		
			$t1 = explode(' ',$t);
			$t1[1] = substr_replace($t1[1],':',-2,0);
			$t2 = explode(':',$t1[1]);
			$t2[0] = self::standtomil($t2[0],$t2[3]);
			unset($t2[3]);
			$t3 = explode('-',$t1[0]);
			$tt = $t3[2].'-'.$t3[0].'-'.$t3[1].' '.$t2[0].':'.$t2[1].':'.$t2[2];
			$time_difference = time()-strtotime($tt);
			if( $time_difference < 1 ) { return '< 1s '.$lang['ago']; }
			$condition = array( 12 * 30 * 24 * 60 * 60 => $lang['year'],
						30 * 24 * 60 * 60       =>  $lang['month'],
						24 * 60 * 60            =>  $lang['day'],
						60 * 60                 =>  $lang['hour'],
						60                      =>  $lang['minute'],
						1                       =>  $lang['second']
			);

			foreach( $condition as $secs => $str )
			{
				$d = $time_difference / $secs;
				if( $d >= 1 )
				{
					$t = round( $d );
					return '~'.$t . ' ' . $str . ' '.$lang['ago'];
				}
			}
		}
		public static function mailNotify(){
			global $lang, $BASEPATH, $session;
			$mail = json_decode(file_get_contents(ROOT.'MAILUPDATE.json'),true);
			$sentMail = array();
			$sentReplies = array();
			$fr = '';
			foreach(Files::Scan(DATA_MAIL) as $mail){
				$o = WebDB::getDB('mail', str_replace('.dat.json','',$mail));
				/*replies*/
				if(stripos($o['msg']['status'][$session], 'new')!==FALSE){
					foreach($o['msg']['replys'] as $id=>$reply){
						if(strpos($reply['from'],$session)===FALSE){
						$sentReplies[] = '<div class="toast show text-bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
						  <div class="toast-header">
						   <img class="img-fluid img-thumbnail m-1 rounded" width="32" height="32" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$reply['from'].'.png') ? $BASEPATH.DATA_AVATARS.$reply['from'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'" class="rounded me-2" alt="...">
							<strong class="me-auto">'.$reply['from'].'</strong>
							<small>'.self::get_time_ago($reply['sentTime']).'</small>
						  </div>
						</div>';
						}
					}
					/*startMail*/
					if(strpos($o['msg']['from']['name'],$session)===FALSE){
						$id = uniqid();
						$sentMail[] = '<li class="list-group-item dropdown">
									<div class="toast show text-bg-info" role="alert" aria-live="assertive" aria-atomic="true">
						  <div class="toast-header">
						   <img class="img-fluid img-thumbnail m-1 rounded" width="32" height="32" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$o['msg']['from']['name'].'.png') ? $BASEPATH.DATA_AVATARS.$o['msg']['from']['name'].'.png' : $BASEPATH.DATA_AVATARS.'default.png').'" class="rounded me-2" alt="...">
							<strong class="me-auto">'.$o['msg']['from']['name'].' - <a class="text-decoration-none link-info" href="'.$BASEPATH.DS.'dashboard.php'.DS.'mail"><em>'.$o['msg']['subject'].'</em></a></strong>
							<small>'.self::get_time_ago($o['msg']['sentTime']).'</small>
						  </div>
						  <div class="toast-body">
							<button class="btn btn-primary w-100" data-bs-toggle="collapse" data-bs-target="#'.$id.'" aria-expanded="false" aria-controls="collapseExample">'.$lang['forum.replysNoIcon'].'</button>
							<div class="collapse mt-1" id="'.$id.'">'.join('',$sentReplies).'</div>
						  </div>
						</div></li>';
					}
				}
					
			}
			$out = '';
			$out.='<button type="button" class="position-relative" style="background-color:transparent;border:0;" data-bs-toggle="collapse" data-bs-target="#panel-mail" aria-expanded="false" aria-controls="panelMail"><i class="fa-solid fa-envelope"></i>
			<span style="font-size: 8.7px;" class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-pill">'.(count($sentMail)+count($sentReplies)).'<span class="visually-hidden">unread message</span></span></span></button>';
			$out.='<div id="panel-mail" class="collapse text-bg-secondary">
				<ul class="list-group list-group-flush"><div class="toast-container position-static">';
				foreach($sentMail as $mail){
					$out.=$mail;
				}
				$out.='</div></ul>
			</div>';
			return $out;
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
				'.self::getUpdates($version, (!preg_match('/\.json/',$file) ? $file.'.json' : $file)).'
			</div>
			'.self::mailNotify().'
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
						if($timestamp)
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
		public static function ISO2Lang(string $l){
			$langs = ['ab'=>'Abkhazian', 'aa'=>'Afar', 'af'=>'Afrikaans', 'ak'=>'Akan', 'sq'=>'Albanian', 'am'=>'Amharic', 'ar'=>'Arabic', 'an'=>'Aragonese', 'hy'=>'Armenian', 'as'=>'Assamese', 'av'=>'Avaric', 'ae'=>'Avestan', 'ay'=>'Aymara', 'az'=>'Azerbaijani', 'bm'=>'Bambara', 'ba'=>'Bashkir', 'eu'=>'Basque', 'be'=>'Belarusian', 'bn'=>'Bengali(Bangla)', 'bh'=>'Bihari', 'bi'=>'Bislama', 'bs'=>'Bosnian', 'br'=>'Breton', 'bg'=>'Bulgarian', 'my'=>'Burmese', 'ca'=>'Catalan', 'ch'=>'Chamorro', 'ce'=>'Chechen', 'ny'=>'Chichewa, Chewa, Nyanja', 'zh'=>'Chinese', 'zh-Hans'=>'Chinese(Simplified)', 'zh-Hant'=>'Chinese(Traditional)', 'cv'=>'Chuvash', 'kw'=>'Cornish', 'co'=>'Corsican', 'cr'=>'Cree', 'hr'=>'Croatian', 'cs'=>'Czech', 'da'=>'Danish', 'dv'=>'Divehi,Dhivehi,Maldivian', 'nl'=>'Dutch', 'dz'=>'Dzongkha', 'en'=>'English', 'eo'=>'Esperanto', 'et'=>'Estonian', 'ee'=>'Ewe', 'fo'=>'Faroese', 'fj'=>'Fijian', 'fi'=>'Finnish', 'fr'=>'French', 'ff'=>'Fula, Fulah, Pulaar, Pular', 'gl'=>'Galician', 'gd'=>'Gaelic(Scottish)', 'gv'=>'Gaelic(Manx), Manx', 'ka'=>'Georgian', 'de'=>'German', 'el'=>'Greek', 'kl'=>'Greenlandic', 'gn'=>'Guarani', 'gu'=>'Gujarati', 'ht'=>'Haitian Creole', 'ha'=>'Hausa', 'he'=>'Hebrew', 'hz'=>'Hausa', 'hi'=>'Hindi', 'ho'=>'Hiri Motu', 'hu'=>'Hungarian', 'is'=>'Icelandic', 'io'=>'Ido', 'ig'=>'Igbo', 'id'=>'Indonesian', 'in'=>'Indonesian', 'ia'=>'Interlingua', 'ie'=>'Interlingue', 'iu'=>'Inuktitut', 'ik'=>'Inupiak', 'ga'=>'Irish', 'it'=>'Italian', 'ja'=>'Japanese', 'jv'=>'Javanese', 'kl'=>'Kalaallisut, Greenlandic', 'kn'=>'Kannada', 'kr'=>'Kanuri', 'ks'=>'Kashmiri', 'kk'=>'Kazakh', 'km'=>'Khmer', 'ki'=>'Kikuyu', 'rw'=>'Kinyarwanda(Rwanda)', 'rn'=>'Kirundi', 'ky'=>'Kyrgyz', 'kv'=>'Komi', 'kg'=>'Kongo', 'ko'=>'Korean', 'ku'=>'Kurdish', 'kj'=>'Kwanyama', 'lo'=>'Lao', 'la'=>'Latin', 'lv'=>'Latvian(Lettish)', 'li'=>'Limburgish( Limburger)', 'ln'=>'Lingala', 'lt'=>'Lithuanian', 'lu'=>'Luga-Katanga', 'lg'=>'Luganda, Ganda', 'lb'=>'Luxembourgish', 'mk'=>'Macedonian', 'mg'=>'Malagasy', 'ms'=>'Malay', 'ml'=>'Malayalam', 'mt'=>'Maltese', 'mi'=>'Maori', 'mr'=>'Marathi', 'mh'=>'Marshallese', 'mo'=>'Moldavian', 'mn'=>'Mongolian', 'na'=>'Nauru', 'nv'=>'Navajo', 'ng'=>'Ndonga', 'nd'=>'Northern Ndebele', 'ne'=>'Nepali', 'no'=>'Norwegian', 'nb'=>'Norwegian bokmål', 'nn'=>'Norwegian nynorsk', 'ii'=>'Nuosu, Sichuan Yi', 'oc'=>'Occitan', 'oj'=>'Ojibwe', 'cu'=>'Old Church Slavonic, Old Bulgarian', 'or'=>'Oriya', 'om'=>'Oromo(Afaan Oromo)', 'os'=>'Ossetian', 'pi'=>'Pāli', 'ps'=>'Pashto, Pushto', 'fa'=>'Persian(Farsi)', 'pl'=>'Polish', 'pt'=>'Portuguese', 'pa'=>'Punjabi(Eastern)', 'qu'=>'Quechua', 'rm'=>'Romansh', 'ro'=>'Romanian', 'ru'=>'Russian', 'se'=>'Sami', 'sm'=>'Samoan', 'sg'=>'Sango', 'sa'=>'Sanskrit', 'sr'=>'Serbian', 'sh'=>'Serbo-Croatian', 'st'=>'Sesotho', 'tn'=>'Setswana', 'sn'=>'Shona', 'sd'=>'Sindhi', 'si'=>'Sinhalese', 'ss'=>'Siswati, Swati', 'sk'=>'Slovak', 'sl'=>'Slovenian', 'so'=>'Somali', 'nr'=>'Southern Ndebele', 'es'=>'Spanish', 'su'=>'Sundanese', 'sw'=>'Swahili(Kiswahili)', 'sv'=>'Swedish', 'tl'=>'Tagalog', 'ty'=>'Tahitian', 'tg'=>'Tajik', 'ta'=>'Tamil', 'tt'=>'Tatar', 'te'=>'Telugu', 'th'=>'Thai', 'bo'=>'Tibetan', 'ti'=>'Tigrinya', 'to'=>'Tonga', 'ts'=>'Tsonga', 'tr'=>'Turkish', 'tk'=>'Turkmen', 'tw'=>'Twi', 'ug'=>'Uyghur', 'uk'=>'Ukrainian', 'ur'=>'Urdu', 'uz'=>'Uzbek', 've'=>'Venda', 'vi'=>'Vietnamese', 'vo'=>'Volapük', 'wa'=>'Wallon', 'cy'=>'Welsh', 'wo'=>'Wolof', 'fy'=>'Western Frisian', 'xh'=>'Xhosa', 'yi'=>'Yiddish', 'ji'=>'Yiddish', 'yo'=>'Yoruba', 'za'=>'Zhuang, Chuang', 'zu'=>'Zulu' ];
			if(isset($langs[strtolower($l)])){
				return $langs[strtolower($l)];
			}else{
				return 'unknown';
			}
		}
		public static function genHex(int $loop):array{
			$hex = array();
			$list = '0123456789abcdef';
			for($i=0;$i<$loop;$i++){
				$h='#';
				for($k=0;$k<6;$k++){
					$rand = rand(0,strlen($list)-1);
					$l = str_split($list);
					$h.=$l[$rand];
				}
				$hex[$h] = $h;
			}
			return $hex;
		}
	}
	?>