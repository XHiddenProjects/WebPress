<?php defined('WEBPRESS') or die('Webpress community');
class Page{
	public $startTime;
	public $endTime;
	protected function __construct(){
	
	}
	protected static function getTime()
	{
		return array_sum(explode(" ",microtime()));  
	}
	public static function start(){
		global $startTime;
		$startTime = self::getTime();
	}
	public static function ends(){
		global $endTime;
		$endTime = self::getTime();
	}
	public static function Loaded(){
		global $startTime, $endTime;
		return round(($endTime - $startTime),2).'s';
	}
}
?>