<?php defined('WEBPRESS') or die('WebPress community');
class Events{
	protected function __construct(){
		#nothing
	}
	public static function createEvent($ip, $device, $browser ,$location, $date, $user, $stat, $type){
	$setup = $ip . '|'.$device.'|'.$browser.'|'.$location.'|'.date('m/d/Y h:i:sa').'|'.$user.'|'.$stat.'|'.$type.'
';
			$event = fopen('events/listener.event', 'a+');
			fwrite($event, preg_replace('/\r/','',$setup));
			fclose($event);
	}
}
?>