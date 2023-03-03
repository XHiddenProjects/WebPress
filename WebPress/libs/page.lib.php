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
	public static function getUnits(){
		return array(
		# Absolute Lengths
		'cm'=>'cm', 
		'mm'=>'mm', 
		'in'=>'in',
		'px'=>'px',
		'pt'=>'pt',
		'pc'=>'pc',
		# Relative Lengths
		'em'=>'em',
		'ex'=>'ex',
		'ch'=>'ch',
		'rem'=>'rem',
		'vw'=>'vw',
		'vh'=>'vh',
		'vmin'=>'vmin',
		'vmax'=>'vmax',
		'%'=>'%'
		);
	}
	public static function getDisplay(){
		return array(
			'block'=>'block',
			'inline'=>'inline',
			'contents'=>'contents',
			'flex'=>'flex',
			'grid'=>'grid',
			'inline-block'=>'inline block',
			'inline-flex'=>'inline flex',
			'inline-grid'=>'inline grid',
			'inline-table'=>'inline table',
			'list-item'=>'list item',
			'run-in'=>'run in',
			'table'=>'table',
			'table-caption'=>'table caption',
			'table-column-group',
			'table-header-group'=>'table header group',
			'table-footer-group'=>'table footer group',
			'table-row-group'=>'table-row-group',
			'table-cell'=>'table cell',
			'table-column'=>'table column',
			'table-row'=>'table row',
			'none'=>'none',
			'initial'=>'initial',
			'inherit'=>'inherit'
		);
	}
	public static function getBorderStyle(){
		return array(
			"none",
		    "hidden",
			"dotted",
			"dashed",
			"solid",
			"double",
			"groove",
			"ridge",
			"inset",
			"outset"
		);
	}
	public static function getAnimations(){
		global $lang;
		return array(
			'blank_fast'=>$lang['animate.blank.fast'],
			'blank_slow'=>$lang['animate.blank.slow'],
			'bounce_top'=>$lang['animate.bounce.top'],
			'bounce_left'=>$lang['animate.bounce.left'],
			'bounce_bottom'=>$lang['animate.bounce.bottom'],
			'bounce_right'=>$lang['animate.bounce.right'],
			'jello_horizontal'=>$lang['animate.jello.horizontal'],
			'jello_vertical'=>$lang['animate.jello.vertical'],
			'pulse_heartbeat'=>$lang['animate.pulse.heartbeat'],
			'pulse_regular'=>$lang['animate.pulse.regular'],
			'pulse_ping'=>$lang['animate.pulse.ping'],
			'shake_horizontal'=>$lang['animate.shake.horizontal'],
			'shake_vertical'=>$lang['animate.shake.vertical'],
			'shake_rotate'=>$lang['animate.shake.rotate'],
			'shake_bottom'=>$lang['animate.shake.bottom'],
			'shake_left'=>$lang['animate.shake.left'],
			'shake_right'=>$lang['animate.shake.right'],
			'shake_top'=>$lang['animate.shake.top'],
			'scale_bottom'=>$lang['animate.scale.bottom'],
			'scale_center'=>$lang['animate.scale.center'],
			'scale_left'=>$lang['animate.scale.left'],
			'scale_right'=>$lang['animate.scale.right'],
			'scale_top'=>$lang['animate.scale.top'],
			'scale_horzcenter'=>$lang['animate.scale.horzcenter'],
			'scale_horzleft'=>$lang['animate.scale.horzleft'],
			'scale_horzright'=>$lang['animate.scale.horzright'],
			'scale_vertbottom'=>$lang['animate.scale.vertbottom'],
			'scale_vertcenter'=>$lang['animate.scale.vertcenter'],
			'scale_verttop'=>$lang['animate.scale.verttop'],
			'rotate_bottom'=>$lang['animate.rotate.bottom'],
			'rotate_left'=>$lang['animate.rotate.left'],
			'rotate_right'=>$lang['animate.rotate.right'],
			'rotate_top'=>$lang['animate.rotate.top'],
			'slide_bottom'=>$lang['animate.slide.bottom'],
			'slide_left'=>$lang['animate.slide.left'],
			'slide_right'=>$lang['animate.slide.right'],
			'slide_top'=>$lang['animate.slide.top'],
			'swirl_bottom'=>$lang['animate.swirl.bottom'],
			'swirl_left'=>$lang['animate.swirl.left'],
			'swirl_right'=>$lang['animate.swirl.right'],
			'swirl_top'=>$lang['animate.swirl.top']
		);
	}
	public static function summary($str,$maxLength=50){
		if(strlen($str)>$maxLength)
			return preg_replace('/\s\.\.\./','...',substr_replace($str, '...', -(strlen($str)-$maxLength)));
		else
			return $str;
	}
	public static function content($text, $summary = false)
	{
		global $conf;			
		if($conf['editor'] === 'markdown'){	
			global $parseBB, $parseBBL;	
			# Parse markdown content.
			$text = $parseMD->text($text);
			$text = $parseBBL->toHTML($text, false, true);
		} else {
			global $parseBB;
			# Parse BBcode content.	
			$text = $parseBB->toHTML($text, false, true);	
		}			
		return $text;
	}
}
?>