<?php defined('WEBPRESS') or die('Webpress community');

class HTMLForm{
	protected function __construct(){
		
	}
	public static function clean($text)
	{		
		return htmlspecialchars(trim($text), ENT_QUOTES, CHARSET);
	}
	public static function transNL($text)
	{
		return preg_replace('/\n{3,}/', "\n\n", str_replace(array("\r\n", "\r"), "\n", $text));
	}
	public static function compile($text){
		return preg_replace('/\n|\r\n|\s/', '', $text);
	}
	public static function err($eid, $msg)
	{
		if (isset($_SESSION[$eid]))
		{
			unset($_SESSION[$eid]);
			return '&nbsp;<span style="color:red; font-weight:500">' .$msg. '</span>';
		}
		return '';
	}
	public static function form($action, $controls, $class='', $method='post', $enctype=false)
	{
		global $token;
		$class = $class!='' ? ' class="ps-2 pe-2 ' .$class. '"' : 'class="ps-2 pe-2"';
		$enctype = $enctype ? ' enctype="multipart/form-data"' : '';
		$form  = '<form id="form" action="' .$action. '" method="'.$method.'"' . $class . $enctype. '>
						<input type="hidden" name="_token" value="' .$token. '">';
		$form .= 		$controls;
		$form .= '</form>';
		return $form;
	}
	
	public static function password($name, $default='', $class='', $placeholder='', $desc='')
	{
		global $lang;
		
		$value = isset($_POST[$name]) ? HTMLForm::clean($_POST[$name]) : $default;
		$class = $class!='' ? ' class="'.$class.'"' : ' class="form-control"';
		$placeholder = $placeholder!='' ? ' placeholder="' .$lang[$placeholder]. '"' : '';
		$desc = $desc!='' ? '<small class="form-text text-muted">' .$lang[$desc]. '</small>' : '';
		return '<div class="form-group pass_show">
					<label class="form-label" for="' .$name. '">' .$lang[$name]. '
						' .HTMLForm::err($name. 'ErrNotMatch', $lang['errNotMatch']). HTMLForm::err('bad_user_syntax', $lang['bad_user_syntax']). '
					</label>
					<input type="password" name="' .$name. '" value="' .$value. '"' .$class . $placeholder. ' required autofocus>
					' .$desc. '
				</div>';
	}
		public static function text($name, $default='', $type='text', $class='', $placeholder='', $desc='', $disabled=false)
	{
		global $lang;
		$value = $default;
		$class = $class!='' ? ' class="form-control '.$class.'"' : ' class="form-control"';
		$placeholder = $placeholder!='' ? ' placeholder="' .(isset($lang[$placeholder]) ? $lang[$placeholder] : ''). '"' : '';
		$disabled = $disabled===true ? ' disabled' : '';
		$desc = $desc!='' ? '<small class="form-text text-muted">' .(isset($lang[$desc]) ? $lang[$desc] : ''). '</small>' : '';
		
		return '  <div class="form-group">
				    <label class="form-label" for="' .$name. '">' .(isset($lang[$name]) ? $lang[$name] : ''). ' 
				    </label>
				    <input type="' .$type. '" id="' .$name. '" name="' .$name. '" value="' .$value. '"' .$class .$placeholder .$disabled. '>
				    ' .$desc. '
				  </div>';
	}
	

	
	public static function textarea($name, $default='', $class='', $desc='', $rows='', $placeholder='', $disabled=false)
	{
		global $lang;
		$value = Utils::isPOST($name, true)? HTMLForm::transNL(HTMLForm::clean($_POST[$name])) : $default;
		$class = $class!='' ? ' class="form-control '.$class.'"' : ' class="form-control"';
		$desc = $desc!='' ? '<small class="form-text text-muted">' .$lang[$desc]. '</small>' : '';
		$rows = $rows!='' ? $rows : 10;
		$placeholder = $placeholder!='' ? ' placeholder="' .$lang[$placeholder]. '"' : '';
		$disabled = $disabled===true ? ' disabled' : '';
		return '<div class="form-group">
				    <label class="form-label" for="' .$name. '">' .$lang[$name]. '</label>
					<textarea id="' .$name. '" name="' .$name. '" rows="' .$rows. '"' .$class .$placeholder .$disabled. '>' .$value. '</textarea>
					' .$desc. '
				</div>';
	}
	
	public static function select($name, $options, $default = '', $class='', $desc='', $disabled=false)
	{
		global $lang;
		$class = $class!='' ? ' class="form-control '.$class.'"' : ' class="form-control"';
		$desc = $desc!='' ? '<small class="form-text text-muted">' .$lang[$desc]. '</small>' : '';
		$disabled = $disabled==true ? ' disabled' : '';
		$selected = $default;
		$out = '<div class="form-group">
				  <label class="form-label" for="' .$name. '">' .(isset($lang[$name]) ? $lang[$name] : ''). '</label>
                  <select id="' .$name. '" name="' .$name. '"' .$class . $disabled. '>';
				  foreach($options as $value => $option)
				  {
				  	$out .= '<option value="' .$value. '"' .($value == $selected ? ' selected="selected"' : ''). '>' .$option. '</option>';
				  }
		$out .= '</select>
				' .$desc. '
                </div>';
		return $out;
	}
		public static function submit($name, $button='submit', $class='', $icon='')
	{	
		global $lang;
		$out = '';
		$class = $class!='' ? ' class="'.$class.'"' : ' class="btn btn-primary btn-lg"';
		$icon = $icon!='' ? '<i class="' .$icon. '"></i>&nbsp;' : '';
	
		return  $out.= '<button name="'.$name.'" ' .$class. ' type="submit">' . $icon .$lang[$button]. '</button>';
	}	
	
	public static function simple_submit($name, $button='submit', $class='', $icon='', $cancel=false)
	{
		global $lang;
		$class = $class!='' ? ' class="'.$class.'"' : ' class="btn btn-primary"';
		$icon = $icon!='' ? '<i class="' .$icon. '"></i>&nbsp;' : '';
		$cancel = $cancel==true ? '&nbsp;<button type="reset" class="btn btn-secondary btn-lg" onclick="$(\'#form\').remove();"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;' .$lang['cancel']. '</button>' : '';	
		return  '<button name="'.$name.'" ' .$class. ' type="submit">' . $icon . $lang[$button] . '</button>';
	}
	public static function checkBox($name, $default='', $desc='')
	{
		global $lang;
		$desc = $desc!='' ? '<small class="form-text text-muted">' . $lang[$desc] . '</small>' : '';
		
		return '<div class="form-group">
			<div class="form-check form-switch">
			  <input style="width:47px;" class="form-check-input me-1" id="' .$name. '" name="' .$name. '" type="checkbox"' .($default ? ' checked' : ''). '>
			  <label class="form-check-label" for="' .$name. '">
			  		' . $lang[$name] . '
			  </label>
			</div>
	        ' .$desc. '
	    </div>';
	}
	public static function loadIcons($name='iconpicker', $default='', $desc=''){
		global $lang;
		$out='';
		$icons = json_decode(file_get_contents(ROOT.'icons.json'), true);
		$out.='<div class="col mt-1">';
		$out.='<div class="form-group">';
		$out.='<label class="form-label">'.(isset($lang[$desc]) ? $lang[$desc] : '').'</label>';
		$out.='<div class="input-group">
			<button class="btn btn-secondary" onclick="openIconList(this);" type="button">'.$lang['forum.selectIcon'].'('.(number_format(count($icons)+1)).')</button><input '.($default!=='' ? 'value="'.$default.'"' : '').' id="'.$name.'" name="'.$name.'" class="form-control" type="text"/></div>';
		$out.='<div class="grid mt-1 d-block text-wrap bg-secondary position-absolute iconList" style="border-radius:15px; transition:all 0.25s linear;height:0;overflow:auto;">';
			foreach($icons as $icon=>$args){
				$out.= '<span'.($default==='fa-solid fa-'.$icon ? ' style="background-color:lightgray!important;" ' : '').' class="text-bg-secondary p-2 m-2 fs-6"><i'.($default==='fa-solid fa-'.$icon ? ' style="font-size:25px;" ' : '').' data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="fa-solid fa-'.$icon.'" onclick="selectIcon(this, \'fa-solid fa-'.$icon.'\')" style="height:45px;cursor:pointer;" class="fa-solid fa-'.$icon.'"></i></span>';
			}
			$out.='</div>';
			$out.='</div>';
		$out.='</div>';
			return $out;
	}
}

?>