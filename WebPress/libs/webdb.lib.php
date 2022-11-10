<?php defined('WEBPRESS') or die('Webpress community');
class WebDB{
	protected function __construct(){
		
	}
	public static function getDB($type, $name, $dbType='.dat.json'){
		$e = constant('DATA_'.strtoupper($type));
		return json_decode((file_exists($e.$name.$dbType) ? file_get_contents($e.$name.$dbType) : ''), true);
	}
	public static function makeDB($type, $name, $dbType='.dat.json'){
		$e = constant('DATA_'.strtoupper($type));
	 if(!file_exists($e.$name.$dbType)){
				$createDB = fopen($e.$name.$dbType, 'w+');
			fwrite($createDB, '');
			fclose($createDB); 
		}
	}
	public static function saveDB($type, $name, $data, $dbType='.dat.json'){
		$e = constant('DATA_'.strtoupper($type));
		if(file_exists($e.$name.$dbType)){
			$rewriteDB = fopen($e.$name.$dbType, 'w+');
			$data = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			fwrite($rewriteDB, $data);
			fclose($rewriteDB);
			return true;
		}else{
			return false;
		}
	}
	public static function removeDB($type, $name, $dbType='.dat.json'){
		$e = constant('DATA_'.strtoupper($type));
		if(file_exists($e.$name.$dbType)){
			return unlink($e.$name.$dbType) ? true : false;
		}
	}
	public static function DBexists($type, $name, $dbType='.dat.json'){
		$e = constant('DATA_'.strtoupper($type));
		return file_exists($e.$name.$dbType) ? true : false;
	}
}
?>