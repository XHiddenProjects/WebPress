<?php defined('WEBPRESS') or die('WebPress community');
class Events{
	protected function __construct(){
		
	}
	public static function createEvent($ip, $device, $browser ,$location, $date, $user, $stat, $type){
	$setup = $ip . '|'.$device.'|'.$browser.'|'.$location.'|'.date('m/d/Y h:i:sa').'|'.$user.'|'.$stat.'|'.$type.'
';
			$event = fopen('events/listener.event', 'a+');
			fwrite($event, preg_replace('/\r/','',$setup));
			fclose($event);
	}
	protected static function run(string $action, string $type){
			switch($action){
				case 'added':
					switch($type){
						case 'forum':
							if(isset($_POST['makeForum'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'topic':
							if(isset($_POST['makeTopic'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'reply':
							if(isset($_POST['replySub'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'ban':
							if(isset($_POST['addBanUser'])){
								return true;
							}else{
								return false;
							}
						break;
					}
				break;
				case 'remove':
					switch($type){
						case 'forum':
							if(isset($_GET['removeForum'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'topic':
							if(isset($_GET['removeTopic'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'reply':
							if(isset($_GET['removeReply'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'ban':
							if(isset($_GET['remove'])){
								return true;
							}else{
								return false;
							}
						break;
					}
				break;
				case 'edited':
					switch($type){
						case 'topic':
							if(isset($_POST['makeTopic'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'reply':
							if(isset($_POST['replySub'])){
								return true;
							}else{
								return false;
							}
						break;
						case 'settings':
							if(isset($_POST['configsave'])){
								return true;
							}else{
								return false;
							}
						break;
					}
				break;
			}
		}
	public static function listen(string $event, object $func){
		if(is_callable($func)){
			switch($event){
				# forum events
				case 'addedForum':
					 if(self::run('added','forum')) $func();
				break;
				case 'removeForum':
					 if(self::run('remove','forum')) $func();
				break;
				# topic events
				case 'addedTopic':
					 if(self::run('added','topic')) $func();
				break;
				case 'removeTopic':
					 if(self::run('remove','topic')) $func();
				break;
				case 'editedTopic':
					 if(self::run('edited','topic')) $func();
				break;
				# reply events
				case 'addedReply':
					 if(self::run('added','reply')) $func();
				break;
				case 'removeReply':
					 if(self::run('remove','reply')) $func();
				break;
				case 'editedReply':
					 if(self::run('edited','reply')) $func();
				break;
				case 'addBan':
					 if(self::run('added','ban')) $func();
				break;
				case 'removeBan':
					 if(self::run('remove','ban')) $func();
				break;
				case 'editedSettings':
					 if(self::run('edited','settings')) $func();
				break;
			}
		}else{
			return 'error';
		}
	}
}
?>