<?php defined('WEBPRESS') or die('Webpress community');
class Plugin{
	public $pluginName;
	public $pluginDB;
	 public function __construct()
    {
		$this->pluginName = basename(dirname(get_class($this)));
		$this->pluginDB = DATA_PLUGINS . $this->pluginName. '.conf.json';        
    }	
	
	public static function isValidHook($hook, $plugin)
	{
		return function_exists($plugin. '_' .$hook);
	}
	
	public static function myHook($hook, $plugin, $param = null)
	{
		$hookFunc = $plugin. '_' .$hook;
		return $hookFunc($param);
	}
	public static function hook($name, $param=null)
	{
		global $plugins;
		$out = '';
				if(is_array($plugins)){
			foreach($plugins as $plugin)
		{
			if(Plugin::isValidHook($name, $plugin))					
				$out .= Plugin::myHook($name, $plugin, $param);
		}
		
			}
		
		return $out;
	}
	public static function useHook($name, $plugin, $param=null)
	{
		$out = '';
			if(Plugin::isValidHook($name, $plugin))					
				$out .= Plugin::myHook($name, $plugin, $param);	
		return $out;
	}
	public static function forceExecute($hook, $plugin, $param=null){
		return self::myHook($hook, $plugin, $param);
	}
	public static function isHere($pluginName){
		return file_exists(DATA_PLUGINS.$pluginName)&&is_dir(DATA_PLUGINS.$pluginName) ? true : false;
	}
	public static function toggleActive($pluginData) : bool{
		if(isset($pluginData['active'])&&is_array($pluginData)&&$pluginData['active']){
			return true;
		}else{
			return false;
		}
	}
}
?>