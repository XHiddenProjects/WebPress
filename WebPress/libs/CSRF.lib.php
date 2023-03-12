	<?php defined('WEBPRESS') or die('Webpress community');

	class CSRF{
		
		protected function __construct(){
			
		}
		
		public static function generate(){
			$token = implode('|',array(bin2hex(hash('sha512', md5(Users::getRealIP()))), bin2hex(random_bytes(45))));
				$keyOpen = fopen(ROOT.'api'.DS.'KEYS.json', 'w+');
				$jsonKey = json_encode(array('date'=>date('Y-m-d', strtotime('+1 years')), 'key'=>$token));
				fwrite($keyOpen, $jsonKey);
				fclose($keyOpen);
				$_SESSION['token'] = $token;
		}
		public static function checkKeyExists(){
			return file_exists(ROOT.'api'.DS.'KEYS.json') ? true : false;
		}
		public static function check(){
			if(file_exists(ROOT.'api'.DS.'KEYS.json')){
				$key = json_decode(file_get_contents(ROOT.'api'.DS.'KEYS.json'), true);
				$current = str_replace('-','',date('Y-m-d'));
				$expire = str_replace('-','',$key['date']);
				if($current <= $expire){
					$getKey = explode('|', $key['key']);
					if($getKey[0] === bin2hex(hash('sha512', md5(Users::getRealIP())))){
						$_SESSION['token'] = $key['key'];
						return true;
					}else{
						return 'invalidKey';
					}
				}else{
					return 'tokenExpired';
				}
			}else{
				CSRF::generate();
			}
		}
		public static function hide(){
			$getKey = json_decode(file_get_contents(ROOT.'api'.DS.'KEYS.json'), true);
			$key = substr((isset($_SESSION['token'])?$_SESSION['token']:$getKey['key']), 15, 20);
			$key = substr(base64_encode(bin2hex(hash('sha512',md5($key)))), 15, 27);
			return $key;
		}
		public static function checkKey($publicKey){
			$key = base64_encode(md5(CSRF::hide()));
			if($publicKey===$key){
				return true;
			}else{
				return false;
			}
		}
		public static function expire(){
			$getKey = json_decode(file_get_contents(ROOT.'api'.DS.'KEYS.json'),true);
			return isset($getKey['date']) ? $getKey['date'] : '';
		}
		public static function renewKey(){
			$expire = str_replace('-','',CSRF::expire());
			$current = str_replace('-','',date('Y-m-d', strtotime('+5 days')));
			if($current >= $expire){
				CSRF::generate();
			}else{
				return false;
			}
		}
		public static function checkPublicKey($publicKey){
			if($publicKey===base64_encode(md5($_SESSION['user']))){
				return true;
			}else{
				return false;
			}
		}
		public static function checkBadPlugin(){
			global $lang, $conf;
			/*
			ClassName::target; --selects a specific function of the class
			ClassName::*; --selects any function of the class
			*/
			if($conf['security']==='moderate'||$conf['security']==='strict'){
				foreach(Files::Scan(ROOT.'plugins'.DS) as $plugins){
				$badPlugin = file_get_contents(ROOT.'plugins'.DS.$plugins.DS.$plugins.'.plg.php');
					if(strpos($badPlugin, 'CSRF::check')){
						die('<b>'.$plugins.'</b>'.$lang['csrf.privateHook'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(strpos($badPlugin, 'CSRF::generate')){
						die('<b>'.$plugins.'</b>'.$lang['csrf.generateHook'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(strpos($badPlugin, '$_SESSION[\'token\']')||strpos($badPlugin, '$_SESSION["token"]')){
						die('<b>'.$plugins.'</b>'.$lang['csrf.tokenTheft'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(strpos($badPlugin, 'Files::')&&!strpos($badPlugin, 'Files::Scan')&&!strpos($badPlugin, 'Files::upload')){
						die('<b>'.$plugins.'</b>'.$lang['csrf.fileAccess'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(preg_match_all('/api\/keys\.json|api\.DS\.keys\.json/i',$badPlugin)){
						die('<b>'.$plugins.'</b>'.$lang['csrf.apiKey'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(strpos($badPlugin, 'file_')&&!strpos($badPlugin, 'file_exists')&&$conf['security']==='strict'){
						die('<b>'.$plugins.'</b>'.$lang['csrf.filegetcontent'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(strpos($badPlugin, 'fopen')&&strpos($badPlugin, 'fclose')&&strpos($badPlugin, 'fread')&&strpos($badPlugin, 'readfile')&&strpos($badPlugin, 'fwrite')&&$conf['security']==='strict'){
						die('<b>'.$plugins.'</b>'.$lang['csrf.filegetcontent'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}elseif(strpos($badPlugin, 'CSRF::')&&$conf['security']==='strict'){
						die('<b>'.$plugins.'</b>'.$lang['csrf.noCSRF'].'<u><i>'.ROOT.'plugins'.DS.$plugins.'</i></u>');
					}
				}
			}
			
		}
		public static function checkBadTheme($theme){
			global $lang, $conf;
			if($conf['security']==='moderate'||$conf['security']==='strict'){
				foreach(Files::Scan(ROOT.'themes'.DS.$theme) as $themes){
				if(is_dir(ROOT.'themes'.DS.$theme.DS.$themes)&&$themes!=='css'&&$themes!=='js'&&$themes!=='images'&&$themes!=='fonts'){
					die('<b>'.$theme.'</b> '.$lang['csrf.themeFHook'].'<u><i>'.ROOT.'themes'.DS.$theme.DS.$themes.'</i></u>');
				}elseif(is_dir(ROOT.'themes'.DS.$theme.DS.$themes)){
					foreach(Files::Scan(ROOT.'themes'.DS.$theme.DS.$themes) as $themess){
						if(@end(explode('.',$themess))!=='css'&&@end(explode('.',$themess))!=='js'&&@end(explode('.',$themess))!=='json'&&
							@end(explode('.',$themess))!=='ttf'&&@end(explode('.',$themess))!=='png'&&@end(explode('.',$themess))!=='jpg'&&
							@end(explode('.',$themess))!=='gif'&&@end(explode('.',$themess))!=='pdf'&&@end(explode('.',$themess))!=='txt'){
								die('<b>'.$theme.'</b> '.$lang['csrf.themeHook'].'<u><i>'.ROOT.'themes'.DS.$theme.DS.$themess.'</i></u>');
						}
					}
				}elseif(@end(explode('.',$themes))!=='css'&&@end(explode('.',$themes))!=='js'&&@end(explode('.',$themes))!=='json'&&
					@end(explode('.',$themes))!=='tff'&&@end(explode('.',$themes))!=='png'&&@end(explode('.',$themes))!=='jpg'&&
					@end(explode('.',$themes))!=='gif'&&@end(explode('.',$themes))!=='pdf'&&@end(explode('.',$themess))!=='txt'){
						die('<b>'.$theme.'</b> '.$lang['csrf.themeHook'].'<u><i>'.ROOT.'themes'.DS.$theme.DS.$themes.'</i></u>');
					}		
				}
			}
			
		}
	}

	?>