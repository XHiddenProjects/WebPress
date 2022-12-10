<?php defined('WEBPRESS') or die('WebPress community');
class Events{
	protected function __construct(){
		#nothing
	}
	public static function createEvent($ip, $date, $user, $stat, $type){
			$setup = $ip . '|' .date('m/d/Y h:i:sa').'|'.$user.'|'.$stat.'|'.$type.'
';
			$event = fopen('events/listener.event', 'a+');
			fwrite($event, preg_replace('/\r/','',$setup));
			fclose($event);
	}
}
?>