<?php 
declare(strict_types=1);
namespace WebPress;

defined('WEBPRESS') or die('Webpress community');

class toolkits{
	public $colors = ['#000000'=>'Black',
					  '#ffffff'=>'White',
					  '#ff0000'=>'Red',
					  '#ffa500'=>'Orange',
					  '#ffff00'=>'Yellow',
					  '#00ff00'=>'Lime',
					  '#008000'=>'Green',
					  '#00ffff'=>'Cyan',
					  '#0000ff'=>'Blue',
					  '#800080'=>'Purple',
					  '#ff00ff'=>'Magenta',
					  '#ffc0cb'=>'Pink',
					  '#808080'=>'Gray',
					  '#d3d3d3'=>'Lightgray',
					  '#c0c0c0'=>'Silver',
					  '#f5f5f5'=>'Whitesmoke',
					  '#2f4f4f'=>'Darkslategrey'];
	public $weight = ['normal'=>'normal', 
	'bold'=>'bold', 
	'bolder'=>'bolder', 
	'lighter'=>'lighter', 
	'100'=>'100', 
	'200'=>'200', 
	'300'=>'300', 
	'400'=>'400', 
	'500'=>'500', 
	'600'=>'600', 
	'700'=>'700', 
	'800'=>'800', 
	'900'=>'900', 
	'initial'=>'initial',
	'inherit'=>'inherit'];
	public $style = ['normal'=>'normal',
	'italic'=>'italic',
	'oblique'=>'oblique',
	'initial'=>'initial',
	'inherit'=>'inherit'];
	public $units = ['cm'=>'cm',
	'mm'=>'mm',
	'in'=>'in',
	'px'=>'px',
	'pt'=>'pt',
	'pc'=>'pc',
	'em'=>'em',
	'ex'=>'ex',
	'ch'=>'ch',
	'rem'=>'rem',
	'vw'=>'vw',
	'vh'=>'vh',
	'vmin'=>'vmin',
	'vmax'=>'vmax',
	'%'=>'%'];
	
	
	public function useColor($color='black'){
		foreach($this->colors as $key => $val){
			 if(mb_strtolower($color)===mb_strtolower($key)||mb_strtolower($color)===mb_strtolower($val))
					return 'color:'.mb_strtolower($color).';';
		
		}
	}
	public function useFontWeight($fontWeight='bold'){
		if(is_array($this->weight)&&isset($this->weight[$fontWeight])&&$this->weight[$fontWeight])
				return 'font-weight:'.$fontWeight.';';
			return 'font-weight:bold;';
	}
	public function useFontStyle($fontStyle='italic'){
		if(is_array($this->style)&&isset($this->style[$fontStyle])&&$this->style[$fontStyle])
				return 'font-style:'.$fontStyle.';';
			return 'font-style:italic;';
	}
	public function useFontSize($fontStyle=25, $units='px'){
			if(isset($this->units[$units])&&$this->units[$units])
				return 'font-size:'.(int)$fontStyle.(string)$units.';';
			return 'font-size:'.(int)$fontStyle.'px;'; 
	}
	public function setAllies($func, $parma=null){
		return function_exists($func) ? $func($parma) : '';
	}
	
	public function __toBool($txt){
		return boolval($txt);
	}
	public function __toStr($txt){
		return strval($txt);
	}
	public function __toInt($txt){
		return intval($txt);
	}
	public function __toFloat($txt){
		return floatval($txt);
	}
}
?>