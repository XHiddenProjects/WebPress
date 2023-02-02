<?php
class Encrypt{
	protected static $alphaArg;
	protected static $shuffleKey;
	
	protected function __construct(){
		
	}
	public static function CC_encrypt(string $str, int $key){
		# CaesarCipher
		$out='';
		self::$alphaArg = ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'];
		$str1 = str_split($str);
		$str2 = str_split(self::$alphaArg[0]);

		for($i=0;$i<count($str1);$i++){
			$flip = array_flip($str2);
			$setInt = ($flip[$str1[$i]] >= count($str2)-1 ? ($flip[$str1[$i]] % $key)-2 : $flip[$str1[$i]]);
			$movAdd = (int)$setInt+$key;
			$shift = array_slice($str2,$movAdd,1);
			$out.=$shift[0];
		}
		return $out;	
	}
	public static function CC_decrypt(string $str, int $key){
	# CaesarCipher
		$out='';
		self::$alphaArg = ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'];
		$str1 = str_split($str);
		$str2 = str_split(self::$alphaArg[0]);

		for($i=0;$i<count($str1);$i++){
			$flip = array_flip($str2);
			$setInt = ($flip[$str1[$i]] >= count($str2)-1 ? ($flip[$str1[$i]] % $key)-2 : $flip[$str1[$i]]);
			$movAdd = (int)$setInt-$key;
			$shift = array_slice($str2,$movAdd,1);
			$out.=$shift[0];
		}
		return $out;		
	}
	public static function shuffle_encode(string $msg, int $amount, string $key, bool $randBytes=false): string{
		#shuffle encode
		self::$shuffleKey[$key] = $msg;
		$out='';
		$bytes = ($randBytes ? bin2hex(random_bytes(4)): '');
		$msg = $msg.$bytes;
		for($i=0;$i<$amount;$i++){
			$out=str_shuffle($msg);
		}
		return $out;
	}
	public static function shuffle_decode(string $key): string{
		#shuffle decode
		if(array_key_exists($key, self::$shuffleKey)){
			return self::$shuffleKey[$key];
		}else{
			return false;
		}
	}
}

?>