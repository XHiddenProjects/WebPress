<?php

class CSRF{
	
	protected function __construct(){
		
	}
	
	public static function generate(){
		$token = implode('|',array(bin2hex(hash('sha512', md5(Users::getRealIP()))), bin2hex(random_bytes(45))));
			$keyOpen = fopen(ROOT.'api'.DS.'KEYS', 'w+');
			$jsonKey = json_encode(array('date'=>date('Y-m-d', strtotime('+1 years')), 'key'=>$token));
			fwrite($keyOpen, $jsonKey);
			fclose($keyOpen);
			$_SESSION['token'] = $token;
	}
	public static function checkKeyExists(){
		return file_exists(ROOT.'api'.DS.'KEYS') ? true : false;
	}
	public static function check(){
		if(file_exists(ROOT.'api'.DS.'KEYS')){
			$key = json_decode(file_get_contents(ROOT.'api'.DS.'KEYS'), true);
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
		$getKey = json_decode(file_get_contents(ROOT.'api'.DS.'KEYS'), true);
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
		$getKey = json_decode(file_get_contents(ROOT.'api'.DS.'KEYS'),true);
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
}

?>