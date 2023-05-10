<?php defined('WEBPRESS') or die('WebPress community');
class Blocks{
	protected function __construct(){
		
	}

		public static function contextMenu(){
		global $lang;
		$out = '';
		$out.= '<div class="context-menu">
		<ul>
		<span class="contextTarget"></span>
		<span class="contextLabel">'.$lang['blocks.actions'].'</span>
			<li class="up">'.$lang['blocks.moveUp'].'</li>
			<li class="down">'.$lang['blocks.moveDown'].'</li>
			<li class="reload" onclick="reloadBlockPage();">'.$lang['blocks.reload'].'</li>
			<li class="split"></li>
			<span class="contextLabel">'.$lang['blocks.blockAction'].'</span>
			<li class="blockID" onclick=\'blockID("'.$lang['blocks.id.prompt'].'");\'>'.$lang['blocks.id'].'</li>
			<li class="blockClasses" onclick=\'blockClasses("'.$lang['blocks.class.prompt'].'");\'>'.$lang['blocks.classes'].'</li>
			<li class="blockHref" onclick=\'blockHref("'.$lang['blocks.href.prompt'].'", "'.$lang['blocks.hrefTar.prompt'].'");\'>'.$lang['blocks.href'].'</li>
			<li class="remBlockHref" onclick=\'removeBlockHref();\'>'.$lang['blocks.RemHref'].'</li>
			<li class="split"></li>
			<span class="contextLabel">'.$lang['blocks.wordActions'].'</span>
			<li class="blockBold" onclick=\'blockBold();\'>'.$lang['blocks.Bold'].'</li>
			<li class="blockItalic" onclick=\'blockItalic();\'>'.$lang['blocks.Italic'].'</li>
			<li class="blockStirkethrough" onclick=\'blockStirke();\'>'.$lang['blocks.Strike'].'</li>
			<li class="blockUnderline" onclick=\'blockUnderline();\'>'.$lang['blocks.Underline'].'</li>
			<li class="blockBG" onclick=\'blockSettings();\'>'.$lang['blocks.style'].'</li>
			<li class="split"></li>
			<span class="contextLabel">'.$lang['blocks.removal'].'</span>
			<li onclick="RemoveBlockFormat()" class="text-bg-danger">'.$lang['blocks.removeFormat'].'</li>
			<li onclick="DeleteBlock()" class="text-bg-danger">'.$lang['blocks.remove'].'</li>
		</ul>
		</div>';
		return $out;
	}
	protected static function requestPage(){
		preg_match('/page.php\/[\w]+/', $_SERVER['REQUEST_URI'], $page);
		return str_replace('page.php/','',$page[0]);
	}
	public static function buildPanel(){
		global $lang, $BASEPATH;
		$panel='';
	
		if(Users::isAdmin()&&isset($_GET['editpage'])||Users::hasPermission('pages')&&isset($_GET['editpage'])){
			$panel.=self::contextMenu();
			$panel.= '<div id="elemdata">
			<div class="toggleElemdata" data-state="expand" onclick="expander(this)">-</div>
			<item>Tag ID: <span class="tagid"></span></item>
			<item>Tag Name: <span class="tagname"></span></item>
			<item>Tag Type: <span class="tagtype"></span></item>
			<item>Tag Classes: <span class="tagclass"></span></item>
			<item>Tag style: <span class="tagstyle"></span></item>
			</div>';
			$panel.='<button type="button" style="z-index:1000;" class="position-absolute m-3 btn btn-secondary bottom-0 end-0 rounded-circle fs-2" data-bs-toggle="offcanvas" data-bs-target="#editorBar" aria-controls="offcanvasScrolling"><i class="fa-solid fa-pencil"></i></button>';
			$panel.='<button type="button" style="right:calc(0px + 5%); z-index:1000;" class="position-absolute m-3 btn border-0 bottom-0 rounded-circle fs-2" data-bs-toggle="offcanvas" data-bs-target="#settingsBar" aria-controls="offcanvasScrolling"><i style="color:black;" class="fa-solid fa-gear"></i></button>';
	$panel.='<div class="offcanvas offcanvas-end" tabindex="-1" id="settingsBar" aria-labelledby="offcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasLabel">'.$lang['blocks.settings'].'</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form>
	<div class="btn-group mt-2 mb-2 d-flex justify-content-center" role="group">
  <input type="radio" class="btn-check" value="body" name="bgBlock" id="blockBody" autocomplete="off" checked>
  <label class="btn btn-outline-secondary" for="blockBody">'.$lang['blocks.settings.bgBlock.body'].'</label>

  <input type="radio" class="btn-check" value="target" name="bgBlock" id="selectedTarget" autocomplete="off">
  <label class="btn btn-outline-secondary" for="selectedTarget">'.$lang['blocks.settings.bgBlock.target'].'</label>
</div>

	<h6>'.$lang['blocks.settings.bg'].'</h6>
	<div class="btn-group" role="group">
  <input type="radio" class="btn-check" value="solidColor" name="bgSetting" id="solidColor" autocomplete="off" checked>
  <label class="btn btn-outline-primary" for="solidColor">'.$lang['blocks.settings.solid.color'].'</label>

  <input type="radio" class="btn-check" value="uploadImage" name="bgSetting" id="uploadImage" autocomplete="off">
  <label class="btn btn-outline-primary" for="uploadImage">'.$lang['blocks.settings.bg.img'].'</label>
  
  <input type="radio" class="btn-check" value="customColor" name="bgSetting" id="customColor" autocomplete="off">
  <label class="btn btn-outline-primary" for="customColor">'.$lang['blocks.settings.custom.color'].'</label>
</div>


	<div class="solidColor">
		<ul class="list-group list-group-flush list-group-horizontal d-flex flex-wrap">
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffffff" style="background-color:white;" name="bgcolor" id="bgwhite" autocomplete="off" checked>
				<label class="btn btn-circle" style="background-color:white;" for="bgwhite"><i class="fa-solid fa-check text-secondary"></i></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#000000" name="bgcolor" id="bgblack" autocomplete="off">
				<label class="btn btn-circle" style="background-color:black;" for="bgblack"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#808080" name="bgcolor" id="bggray" autocomplete="off">
				<label class="btn btn-circle" style="background-color:gray;" for="bggray"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ff0000" name="bgcolor" id="bgred" autocomplete="off">
				<label class="btn btn-circle" style="background-color:red;" for="bgred"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffa500" name="bgcolor" id="bgorange" autocomplete="off">
				<label class="btn btn-circle" style="background-color:orange;" for="bgorange"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffff00" name="bgcolor" id="bgyellow" autocomplete="off">
				<label class="btn btn-circle" style="background-color:yellow;" for="bgyellow"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#008000" name="bgcolor" id="bggreen" autocomplete="off">
				<label class="btn btn-circle" style="background-color:green;" for="bggreen"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#0000ff" name="bgcolor" id="bgblue" autocomplete="off">
				<label class="btn btn-circle" style="background-color:blue;" for="bgblue"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#800080" name="bgcolor" id="bgpruple" autocomplete="off">
				<label class="btn btn-circle" style="background-color:purple;" for="bgpruple"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffc0cb" name="bgcolor" id="bgpink" autocomplete="off">
				<label class="btn btn-circle" style="background-color:pink;" for="bgpink"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#c0c0c0" name="bgcolor" id="bgsilver" autocomplete="off">
				<label class="btn btn-circle" style="background-color:silver;" for="bgsilver"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#00ff00" name="bgcolor" id="bglime" autocomplete="off">
				<label class="btn btn-circle" style="background-color:lime;" for="bglime"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#00ffff" name="bgcolor" id="bgcyan" autocomplete="off">
				<label class="btn btn-circle" style="background-color:cyan;" for="bgcyan"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ff00ff" name="bgcolor" id="bgmagenta" autocomplete="off">
				<label class="btn btn-circle" style="background-color:magenta;" for="bgmagenta"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffd700" name="bgcolor" id="bggold" autocomplete="off">
				<label class="btn btn-circle" style="background-color:gold;" for="bggold"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#800000" name="bgcolor" id="bgmaroon" autocomplete="off">
				<label class="btn btn-circle" style="background-color:maroon;" for="bgmaroon"></label>
			</li>
			<li class="list-group-item" style="border-right:2px solid black;">
				<input type="radio" class="btn-check" value="transparent" name="bgcolor" id="bgtransparent" autocomplete="off">
				<label class="btn btn-circle" style="background-color:transparent;" for="bgtransparent"></label>
			</li>
			
		</ul>
	</div>
	
	<div class="uploadImage mt-2" style="display:none;">
	<label class="form-label">'.$lang['blocks.bgImage'].'</label>
		<input type="url" id="bgImgURL" class="form-control"/>
		<button type="button" class="btn btn-danger btn-lg w-100 mt-1" onclick="removeBGImg();"><i class="fa-solid fa-minus"></i></button>
	</div>
	<div class="customColor mt-2" style="display:none;">
	<label class="form-label" for="customcolor">'.$lang['blocks.customcolor'].'</label>
	<input type="color" class="custom form-control" id="customcolorinput"/>
	<button type="button" class="btn btn-info btn-lg w-100 mt-1" onclick="add2ColorList()"><i class="fa-solid fa-plus"></i></button>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.color'].'</h6>
	<div class="btn-group" role="group">
  <input type="radio" class="btn-check" value="solidColor2" name="colorSetting" id="solidColor2" autocomplete="off" checked>
  <label class="btn btn-outline-primary" for="solidColor2">'.$lang['blocks.settings.solid.color'].'</label>
  
  <input type="radio" class="btn-check" value="customColor2" name="colorSetting" id="customColor2" autocomplete="off">
  <label class="btn btn-outline-primary" for="customColor2">'.$lang['blocks.settings.custom.color'].'</label>
</div>
	<div class="solidColor2">
		<ul class="list-group list-group-flush list-group-horizontal d-flex flex-wrap">
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffffff" style="background-color:white;" name="color" id="colorwhite" autocomplete="off" checked>
				<label class="btn btn-circle" style="background-color:white;" for="colorwhite"><i class="fa-solid fa-check text-secondary"></i></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#000000" name="color" id="colorblack" autocomplete="off">
				<label class="btn btn-circle" style="background-color:black;" for="colorblack"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#808080" name="color" id="colorgray" autocomplete="off">
				<label class="btn btn-circle" style="background-color:gray;" for="colorgray"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ff0000" name="color" id="colorred" autocomplete="off">
				<label class="btn btn-circle" style="background-color:red;" for="colorred"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffa500" name="color" id="colororange" autocomplete="off">
				<label class="btn btn-circle" style="background-color:orange;" for="colororange"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffff00" name="color" id="coloryellow" autocomplete="off">
				<label class="btn btn-circle" style="background-color:yellow;" for="coloryellow"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#008000" name="color" id="colorgreen" autocomplete="off">
				<label class="btn btn-circle" style="background-color:green;" for="colorgreen"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#0000ff" name="color" id="colorblue" autocomplete="off">
				<label class="btn btn-circle" style="background-color:blue;" for="colorblue"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#800080" name="color" id="colorpruple" autocomplete="off">
				<label class="btn btn-circle" style="background-color:purple;" for="colorpruple"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffc0cb" name="color" id="colorpink" autocomplete="off">
				<label class="btn btn-circle" style="background-color:pink;" for="colorpink"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#c0c0c0" name="color" id="colorsilver" autocomplete="off">
				<label class="btn btn-circle" style="background-color:silver;" for="colorsilver"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#00ff00" name="color" id="colorlime" autocomplete="off">
				<label class="btn btn-circle" style="background-color:lime;" for="colorlime"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#00ffff" name="color" id="colorcyan" autocomplete="off">
				<label class="btn btn-circle" style="background-color:cyan;" for="colorcyan"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ff00ff" name="color" id="colormagenta" autocomplete="off">
				<label class="btn btn-circle" style="background-color:magenta;" for="colormagenta"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#ffd700" name="color" id="colorgold" autocomplete="off">
				<label class="btn btn-circle" style="background-color:gold;" for="colorgold"></label>
			</li>
			<li class="list-group-item">
				<input type="radio" class="btn-check" value="#800000" name="color" id="colormaroon" autocomplete="off">
				<label class="btn btn-circle" style="background-color:maroon;" for="colormaroon"></label>
			</li>
			<li class="list-group-item" style="border-right:2px solid black;">
				<input type="radio" class="btn-check" value="transparent" name="color" id="colortransparent" autocomplete="off">
				<label class="btn btn-circle" style="background-color:transparent;" for="colortransparent"></label>
			</li>
			
		</ul>
	</div>
		<div class="customColor2 mt-2" style="display:none;">
	<label class="form-label" for="customcolor2">'.$lang['blocks.customcolor'].'</label>
	<input type="color" class="custom form-control" id="customcolorinput2"/>
	<button type="button" class="btn btn-info btn-lg w-100 mt-1" onclick="add2ColorList(true)"><i class="fa-solid fa-plus"></i></button>
	</div>
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.align'].'</h6>
	<div class="aligner">
		<div class="btn-group" role="group">
			<input type="radio" class="btn-check" onclick="BlocktextAlign(\'left\')" name="textalign" id="alignleft" autocomplete="off" checked>
			<label class="btn btn-outline-primary" for="alignleft"><i class="fa-solid fa-align-left"></i></label>

			<input type="radio" class="btn-check" onclick="BlocktextAlign(\'center\')" name="textalign" id="aligncenter" autocomplete="off">
			<label class="btn btn-outline-primary" for="aligncenter"><i class="fa-solid fa-align-center"></i></label>

			<input type="radio" class="btn-check" onclick="BlocktextAlign(\'right\')" name="textalign" id="alignright" autocomplete="off">
			<label class="btn btn-outline-primary" for="alignright"><i class="fa-solid fa-align-right"></i></label>
			
			<input type="radio" class="btn-check" onclick="BlocktextAlign(\'justify\')" name="textalign" id="alignjustify" autocomplete="off">
			<label class="btn btn-outline-primary" for="alignjustify"><i class="fa-solid fa-align-justify"></i></label>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.padding'].'</h6>
	<div class="padding-blocks">
	<label for="pt">'.$lang['blocks.settings.top'].'</label>
	<div class="input-group">
	<input id="pt" type="number" min="0" value="0" class="form-control" oninput="makePadding(\'Top\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label for="pr">'.$lang['blocks.settings.right'].'</label>
		<div class="input-group">
	<input id="pr" min="0" type="number" value="0" class="form-control" oninput="makePadding(\'Right\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<label for="pb">'.$lang['blocks.settings.bottom'].'</label>
		<div class="input-group">
	<input id="pb" min="0" type="number" value="0" class="form-control" oninput="makePadding(\'Bottom\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<label for="pl">'.$lang['blocks.settings.left'].'</label>
		<div class="input-group">
	<input id="pl" min="0" type="number" value="0" class="form-control" oninput="makePadding(\'Left\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.margin'].'</h6>
	<div class="margin-blocks">
	<label for="mt">'.$lang['blocks.settings.top'].'</label>
	<div class="input-group">
	<input id="mt" type="number" min="0" value="0" class="form-control" oninput="makeMargin(\'Top\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label for="mr">'.$lang['blocks.settings.right'].'</label>
		<div class="input-group">
	<input id="mr" min="0" type="number" value="0" class="form-control" oninput="makeMargin(\'Right\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<label for="mb">'.$lang['blocks.settings.bottom'].'</label>
		<div class="input-group">
	<input id="mb" min="0" type="number" value="0" class="form-control" oninput="makeMargin(\'Bottom\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<label for="ml">'.$lang['blocks.settings.left'].'</label>
		<div class="input-group">
	<input id="ml" min="0" type="number" value="0" class="form-control" oninput="makeMargin(\'Left\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.display'].'</h6>
	<div class="display-con">
	<select class="form-control" onchange="makeDisplay(this.value)">';
	foreach(Page::getDisplay() as $display=>$label){
		$panel.='<option value="'.$display.'">'.$label.'</option>';
	}
	$panel.='
	</select>
	</div>
		<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.flex'].'</h6>
	<div class="flex-wrapper">
	<div class="input-group">
	<input class="form-control" oninput="makeFlex(this.value)" value="0" min="0" id="flex"/>
	<span class="input-group-text">%</span>
	</div>
	</div>
	

	
	<h6>'.$lang['blocks.settings.flexWrap'].'</h6>
	<div class="flex-wrapper">
	<select class="form-control" onchange="makeFlexWrap(this.value)">
	<option value="nowrap">nowrap</option>
	<option value="wrap">wrap</option>
	<option value="wrap-reverse">wrap-reverse</option>
	</select>
	</div>
	

	
	<h6>'.$lang['blocks.settings.flexDir'].'</h6>
	<div class="flex-wrapper">
	<select class="form-control" onchange="makeFlexDir(this.value)">
	<option value="row">row</option>
	<option value="row-reverse">row-reverse</option>
	<option value="column">column</option>
	<option value="column-reverse">column-reverse</option>
	</select>
	</div>
	

	
	<h6>'.$lang['blocks.settings.flexBiases'].'</h6>
		<div class="input-group">
	<input min="0" type="number" value="0" class="form-control" oninput="makeFlexBasis(this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	

	
	<h6>'.$lang['blocks.settings.flexGrow'].'</h6>
	<div class="flex-wrapper">
	<input type="number" class="form-control" oninput="makeFlexGroth(this.value);" value="0" min="0"/>
	</div>
	

	
	<h6>'.$lang['blocks.settings.flexShrink'].'</h6>
	<div class="flex-wrapper">
	<input type="number" class="form-control" oninput="makeFlexShrink(this.value);" value="0" min="0"/>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.fontSize'].'</h6>
		<div class="input-group">
	<input min="0" type="number" value="0" class="form-control" oninput="makeFontSize(this.value, this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	
	<h6>'.$lang['blocks.settings.border'].'</h6>
	<div class="border-blocks">
	<label for="bt">'.$lang['blocks.settings.top'].'</label>
	<div class="input-group">
	<input id="bt" type="number" min="0" value="0" class="form-control" oninput="makeBorder(\'Top\', this)"/>
	<select class="form-control input-group-text bsize">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	<select class="form-control input-group-text bstyle">';
	foreach(Page::getBorderStyle() as $style){
		$panel.='<option'.($style==='solid' ? ' selected="selected"' : '').' value="'.$style.'">'.$style.'</option>';
	}
	$panel.='</select>
	<input type="color" class="form-control input-group-text" style="padding:18px;"/>
	</div>
	
	<label for="br">'.$lang['blocks.settings.right'].'</label>
		<div class="input-group">
	
	<input id="br" min="0" type="number" value="0" class="form-control" oninput="makeBorder(\'Right\', this)"/>
	<select class="form-control input-group-text bsize">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	<select class="form-control input-group-text bstyle">';
	foreach(Page::getBorderStyle() as $style){
		$panel.='<option'.($style==='solid' ? ' selected="selected"' : '').' value="'.$style.'">'.$style.'</option>';
	}
		$panel.='</select>
		<input type="color" class="form-control input-group-text bcolor" style="padding:18px;"/>
	</div>
	
	<label for="bb">'.$lang['blocks.settings.bottom'].'</label>
		<div class="input-group">
	
	<input id="bb" min="0" type="number" value="0" class="form-control" oninput="makeBorder(\'Bottom\', this)"/>
	<select class="form-control input-group-text bsize">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	<select class="form-control input-group-text bstyle">';
	foreach(Page::getBorderStyle() as $style){
		$panel.='<option'.($style==='solid' ? ' selected="selected"' : '').' value="'.$style.'">'.$style.'</option>';
	}
		$panel.='</select>
		<input type="color" class="form-control input-group-text bcolor" style="padding:18px;"/>
	</div>
	
	<label for="bl">'.$lang['blocks.settings.left'].'</label>
		<div class="input-group">
	
	<input id="bl" min="0" type="number" value="0" class="form-control" oninput="makeBorder(\'Left\', this)"/>
	<select class="form-control input-group-text bsize">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	<select class="form-control input-group-text bstyle">';
	foreach(Page::getBorderStyle() as $style){
		$panel.='<option'.($style==='solid' ? ' selected="selected"' : '').' value="'.$style.'">'.$style.'</option>';
	}
		$panel.='</select>
		<input type="color" class="form-control input-group-text bcolor" style="padding:18px;"/>
	</div>
	</div>
	
	<h6>'.$lang['blocks.settings.borderBLRadius'].'</h6>
		<div class="input-group">
	<input min="0" type="number" value="0" class="form-control" oninput="makeBorderRadius(\'bl\',this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<h6>'.$lang['blocks.settings.borderBRRadius'].'</h6>
		<div class="input-group">
	<input min="0" type="number" value="0" class="form-control" oninput="makeBorderRadius(\'br\',this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<h6>'.$lang['blocks.settings.borderTLRadius'].'</h6>
		<div class="input-group">
	<input min="0" type="number" value="0" class="form-control" oninput="makeBorderRadius(\'tl\',this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<h6>'.$lang['blocks.settings.borderTRRadius'].'</h6>
		<div class="input-group">
	<input min="0" type="number" value="0" class="form-control" oninput="makeBorderRadius(\'tr\',this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.boxShadow'].'</h6>
	<div class="shadow-block">
	<button type="button" onclick="makeShadowBox(this)" class="btn btn-secondary w-100 btn-lg"><i class="fa-solid fa-plus"></i></button>
		<div class="form-check">
			<input class="form-check-input none" type="checkbox" value="" id="bsn">
			<label class="form-check-label" for="bsn">
				'.$lang['blocks.settings.none'].'
			</label>
		</div>
		
	<label class="form-label">'.$lang['blocks.settings.boxShadow.h'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control hshadow"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label class="form-label">'.$lang['blocks.settings.boxShadow.v'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control vshadow"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>

	<label class="form-label">'.$lang['blocks.settings.boxShadow.blur'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control blur"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label class="form-label">'.$lang['blocks.settings.boxShadow.spread'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control spread"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label class="form-label">'.$lang['blocks.settings.boxShadow.color'].'</label>
	<input type="color" value="0" class="form-control color" style="padding:18px;"/>
	
		<div class="form-check">
			<input class="form-check-input sinset" type="checkbox" value="">
			<label class="form-check-label">
				'.$lang['blocks.settings.boxShadow.inset'].'
			</label>
		</div>

	</div>
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.textShadow'].'</h6>
	<div class="shadowText-block">
	<button type="button" onclick="makeShadowText(this)" class="btn btn-secondary w-100 btn-lg"><i class="fa-solid fa-plus"></i></button>
		<div class="form-check">
			<input class="form-check-input none" type="checkbox" value="" id="bsn">
			<label class="form-check-label" for="bsn">
				'.$lang['blocks.settings.none'].'
			</label>
		</div>
		
	<label class="form-label">'.$lang['blocks.settings.boxShadow.h'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control hshadow"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label class="form-label">'.$lang['blocks.settings.boxShadow.v'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control vshadow"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>

	<label class="form-label">'.$lang['blocks.settings.boxShadow.blur'].'</label>
	<div class="input-group">
	<input min="0" type="number" value="0" class="form-control blur"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label class="form-label">'.$lang['blocks.settings.boxShadow.color'].'</label>
	<input type="color" value="0" class="form-control color" style="padding:18px;"/>
	
		
	</div>
	
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.animation'].'</h6>
	<div class="animate-block">
	<label class="form-label">'.$lang['blocks.settings.animation.list'].'</label>
	<select class="form-control" onchange="makeAnimate(this)">';
	foreach(Page::getAnimations() as $anime=>$label){
		$panel.='<option value="'.$anime.'">'.$label.'</option>';
	}
	$panel.='</select>

	
	<label class="form-label">'.$lang['blocks.settings.animation.timing'].'</label>
	<select class="form-control atime">
	<option value="linear">linear</option>
	<option value="ease">ease</option>
	<option value="ease-in">ease-in</option>
	<option value="ease-out">ease-out</option>
	<option value="ease-in-out">ease-in-out</option>
	</select>
	
	<label class="form-label">'.$lang['blocks.settings.animation.direction'].'</label>
	<select class="form-control adir">
	<option value="normal">normal</option>
	<option value="reverse">reverse</option>
	<option value="alternate">alternate</option>
	<option value="alternate-reverse">alternate-reverse</option>
	</select>
	
	<label class="form-label">'.$lang['blocks.settings.animation.fillMode'].'</label>
	<select class="form-control afill">
	<option value="none">none</option>
	<option value="forwards">forwards</option>
	<option value="backwards">backwards</option>
	<option value="both">both</option>
	</select>
	<label class="form-label">'.$lang['blocks.settings.animation.duration'].'</label>
	<div class="input-group">
	<input type="number" value="5" min="0" class="form-control adur"/>
	<select class="form-control input-group-text">
	<option value="s">s</option>
	<option value="ms">ms</option>
	</select>
	</div>
	
	<label class="form-label">'.$lang['blocks.settings.animation.delay'].'</label>
	<div class="input-group">
	<input type="number" value="0" min="0" class="form-control adel"/>
	<select class="form-control input-group-text">
	<option value="s">s</option>
	<option value="ms">ms</option>
	</select>
	</div>
	
	<label class="form-label">'.$lang['blocks.settings.animation.count'].'</label>
	<input type="number" value="-1" min="-1" class="form-control acount"/>
	</div>
		<hr class="border border-3 border-primary bg-primary"/>
		<h6>'.$lang['blocks.settings.blockWidth'].'</h6>
		<div class="input-group">
	<input min="-1" type="number" value="0" class="form-control" oninput="makeWidth(this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<h6>'.$lang['blocks.settings.blockHeight'].'</h6>
		<div class="input-group">
	<input min="-1" type="number" value="0" class="form-control" oninput="makeHeight(this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<hr class="border border-3 border-primary bg-primary"/>
	<div class="pos-blocks">
		<h6>'.$lang['blocks.settings.pos'].'</h6>
		<select class="form-control" onchange="makePosV(this.value)">
		<option value="static">static</option>
		<option value="relative">relative</option>
		<option value="fixed">fixed</option>
		<option value="absolute">absolute</option>
		<option value="sticky">sticky</option>
		</select>
	
		
	<label for="pt">'.$lang['blocks.settings.top'].'</label>
	<div class="input-group">
	<input id="pt" type="number" min="-1" value="0" class="form-control" oninput="makePos(\'Top\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	<label for="pr">'.$lang['blocks.settings.right'].'</label>
		<div class="input-group">
	<input id="pr" min="-1" type="number" value="0" class="form-control" oninput="makePos(\'Right\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<label for="pb">'.$lang['blocks.settings.bottom'].'</label>
		<div class="input-group">
	<input id="pb" min="-1" type="number" value="0" class="form-control" oninput="makePos(\'Bottom\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	
	<label for="pl">'.$lang['blocks.settings.left'].'</label>
		<div class="input-group">
	<input id="pl" min="-1" type="number" value="0" class="form-control" oninput="makePos(\'Left\', this)"/>
	<select class="form-control input-group-text">';
	foreach(Page::getUnits() as $unit=>$label){
		$panel.='<option'.($unit=='px' ? ' selected="selected"' : '').' value="'.$unit.'">'.$label.'</option>';
	}
	$panel.='</select>
	</div>
	</div>
		<hr class="border border-3 border-primary bg-primary"/>
	<div class="transform-block">
	<h6>'.$lang['blocks.settings.transform'].'</h6>
	<div class="input-group">
		<select class="form-control input-group-text" onchange="makePosV(this.value)">
		<option value="none">none</option>
		<option value="matrix">matrix(n,n,n,n,n,n)</option>
		<option value="matrix3d">matrix3d(n,n,n,n, etc...)</option>
		<option value="translate">translate(x,y)</option>
		<option value="translate3d">translate3d(x,y,z)</option>
		<option value="translateX">translateX(x)</option>
		<option value="translateY">translateY(y)</option>
		<option value="translateZ">translateZ(z)</option>
		<option value="scale">scale(x,y)</option>
		<option value="scale3d">scale3d(x,y,z)</option>
		<option value="scaleX">scaleX(x)</option>
		<option value="scaleY">scaleY(y)</option>
		<option value="scaleZ">scaleZ(z)</option>
		<option value="rotate">rotate(angle)</option>
		<option value="rotate3d">rotate3d(x,y,z,angle)</option>
		<option value="rotateX">rotateX(angle)</option>
		<option value="rotateY">rotateY(angle)</option>
		<option value="rotateZ">rotateZ(angle)</option>
		<option value="skew">skew(x-angle, y-angle)</option>
		<option value="skewX">skewX(angle)</option>
		<option value="skewY">skewY(angle)</option>
		<option value="perspective">perspective(n)</option>
		</select>
		
		<input type="text" class="form-control" oninput=""/>
		<button type="button" onclick="makeTransform(this)" class="btn btn-secondary btn-lg w-100 mt-2 input-group-text"><i class="fa-solid fa-plus"></i></button>
		</div>
		
	</div>
		<hr class="border border-3 border-primary bg-primary"/>
		<h6>'.$lang['blocks.settings.textTransform'].'</h6>
		<select class="form-control" onchange="makeTextTransform(this.value);">
		<option value="none">none</option>
		<option value="capitalize">capitalize</option>
		<option value="uppercase">uppercase</option>
		<option value="lowercase">lowercase</option>
		</select>
	<hr class="border border-3 border-primary bg-primary"/>
		<h6>'.$lang['blocks.settings.textDirection'].'</h6>
		<select class="form-control" onchange="makeTextDir(this.value);">
		<option value="ltr">Left-to-Right</option>
		<option value="rtl">Right-to-Left</option>
		</select>
	<hr class="border border-3 border-primary bg-primary"/>
	<h3 class="text-center text-secondary">'.$lang['blocks.settings.scripts'].'</h3>
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.formConfig'].'</h6>
	<div class="input-group">
	<input type="text" class="form-control" oninput="configForm(this)"/>
	<select class="form-control input-group-text">
		<option value="post">POST</option>
		<option value="get">GET</option>
	</select>
	</div>
		<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.required'].'</h6>
	<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" onclick="configRequire(this.checked)">
  <label class="form-check-label"></label>
</div>
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.readOnly'].'</h6>
	<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" onclick="configReadOnly(this.checked)">
  <label class="form-check-label"></label>
</div>
	<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.disabled'].'</h6>
	<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" onclick="configDisabled(this.checked)">
  <label class="form-check-label"></label>
</div>
		<hr class="border border-3 border-primary bg-primary"/>
	<h6>'.$lang['blocks.settings.regexp'].'</h6>
	<input type="text" class="form-control" oninput="configPattern(this.value)"/>
	
	
	</div>
	</form>
  </div>
</div>';
	$panel.='<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="editorBar" aria-labelledby="offcanvasScrollingLabel">
			<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasScrollingLabel">'.$lang['blocks.title'].'</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
	<div class="offcanvas-body">
		<ul class="list-group">
		 <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#heading" aria-expanded="false" aria-controls="collapseExample">
   <i class="fa-solid fa-heading"></i> Heading
  </button>
		<div class="collapse" id="heading">
  <div class="card card-body">
		<li class="list-group-item drag" id="h1" draggable="true" data-tag="h1" ondragstart="dragItem(event)"><i class="fa-solid fa-h1"></i> Heading 1</li>
		<li class="list-group-item drag" id="h2" draggable="true" data-tag="h2" ondragstart="dragItem(event)"><i class="fa-solid fa-h2"></i> Heading 2</li>
		<li class="list-group-item drag" id="h3" draggable="true" data-tag="h3" ondragstart="dragItem(event)"><i class="fa-solid fa-h3"></i> Heading 3</li>
		<li class="list-group-item drag" id="h4" draggable="true" data-tag="h4" ondragstart="dragItem(event)"><i class="fa-solid fa-h4"></i> Heading 4</li>
		<li class="list-group-item drag" id="h5" draggable="true" data-tag="h5" ondragstart="dragItem(event)"><i class="fa-solid fa-h5"></i> Heading 5</li>
		<li class="list-group-item drag" id="h6" draggable="true" data-tag="h6" ondragstart="dragItem(event)"><i class="fa-solid fa-h6"></i> Heading 6</li>
  </div>
</div>
	<li class="list-group-item drag" id="p" draggable="true" data-tag="p" ondragstart="dragItem(event)"><i class="fa-solid fa-paragraph"></i> Paragraph</li>
	<li class="list-group-item drag" id="span" draggable="true" data-tag="span" ondragstart="dragItem(event)">Span</li>
	<li class="list-group-item drag" id="a" draggable="true" data-tag="a" ondragstart="dragItem(event)"><i class="fa-solid fa-link"></i> Link</li>
	<li class="list-group-item drag" id="table" draggable="true" data-tag="table" ondragstart="dragItem(event)"><i class="fa-solid fa-table"></i> Table</li>
	<li class="list-group-item drag" id="row" draggable="true" data-tag="row" ondragstart="dragItem(event)"><i class="fa-solid fa-table-rows"></i> Row</li>
	<li class="list-group-item drag" id="cols" draggable="true" data-tag="cols" ondragstart="dragItem(event)"><i class="fa-solid fa-table-columns"></i> Columns</li>
	<li class="list-group-item drag" id="div" draggable="true" data-tag="div" ondragstart="dragItem(event)"><i class="fa-solid fa-container-storage"></i> DIV container</li>
	<li class="list-group-item drag" id="br" draggable="true" data-tag="br" ondragstart="dragItem(event)"><i class="fa-solid fa-file-dashed-line"></i> Line Break</li>
	<li class="list-group-item drag" id="hr" draggable="true" data-tag="hr" ondragstart="dragItem(event)"><i class="fa-solid fa-horizontal-rule"></i> Horizontal Line</li>
	<li class="list-group-item drag" id="form" draggable="true" data-tag="form" ondragstart="dragItem(event)"><i class="fa-solid fa-square-poll-horizontal"></i> Forms</li>
			 <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#forms" aria-expanded="false" aria-controls="collapseExample">
   <i class="fa-solid fa-square-poll-horizontal"></i> Forms
  </button>
		<div class="collapse" id="forms">
  <div class="card card-body">
			<li class="list-group-item drag" id="label" draggable="true" data-tag="label" ondragstart="dragItem(event)"><i class="fa-solid fa-font"></i> Label</li>
	<li class="list-group-item drag" id="text" draggable="true" data-tag="text" ondragstart="dragItem(event)"><i class="fa-solid fa-input-text"></i> Textbox</li>
	<li class="list-group-item drag" id="number" draggable="true" data-tag="number" ondragstart="dragItem(event)"><i class="fa-solid fa-input-numeric"></i> Number</li>
	<li class="list-group-item drag" id="phone" draggable="true" data-tag="phone" ondragstart="dragItem(event)"><i class="fa-solid fa-phone"></i> Phone</li>
	<li class="list-group-item drag" id="email" draggable="true" data-tag="email" ondragstart="dragItem(event)"><i class="fa-solid fa-envelope"></i> Email</li>
	<li class="list-group-item drag" id="group" draggable="true" data-tag="group" ondragstart="dragItem(event)"><i class="fa-solid fa-layer-group"></i> Group</li>
	<li class="list-group-item drag" id="group-text" draggable="true" data-tag="group-text" ondragstart="dragItem(event)"><i class="fa-solid fa-text-size"></i> Group Text</li>
	<li class="list-group-item drag" id="float-text" draggable="true" data-tag="float-text" ondragstart="dragItem(event)"><i class="fa-solid fa-ghost"></i> Floating Text</li>
	<li class="list-group-item drag" id="button" draggable="true" data-tag="button" ondragstart="dragItem(event)"><i class="fa-solid fa-rectangle-wide"></i> Button</li>
	<li class="list-group-item drag" id="submit" draggable="true" data-tag="submit" ondragstart="dragItem(event)"><i class="fa-solid fa-rectangle-wide"></i> Submit</li>
	<li class="list-group-item drag" id="clear" draggable="true" data-tag="clear" ondragstart="dragItem(event)"><i class="fa-solid fa-rectangle-wide"></i> Clear</li>
	<li class="list-group-item drag" id="radio" draggable="true" data-tag="radio" ondragstart="dragItem(event)"><i class="fa-regular fa-circle-dot"></i> Radio</li>
	<li class="list-group-item drag" id="checkbox" draggable="true" data-tag="checkbox" ondragstart="dragItem(event)"><i class="fa-solid fa-square-check"></i> Checkbox</li>
	<li class="list-group-item drag" id="password" draggable="true" data-tag="password" ondragstart="dragItem(event)"><i class="fa-solid fa-lock"></i> Password</li>
	<li class="list-group-item drag" id="datetime" draggable="true" data-tag="datetime" ondragstart="dragItem(event)"><i class="fa-solid fa-calendar-days"></i> DateTime</li>
	<li class="list-group-item drag" id="url" draggable="true" data-tag="url" ondragstart="dragItem(event)"><i class="fa-solid fa-link"></i> URL</li>
	<li class="list-group-item drag" id="range" draggable="true" data-tag="range" ondragstart="dragItem(event)"><i class="fa-solid fa-slider"></i> Range</li>
	<li class="list-group-item drag" id="hidden" draggable="true" data-tag="hidden" ondragstart="dragItem(event)"><i class="fa-solid fa-input-pipe"></i> Hidden</li>
	<li class="list-group-item drag" id="search" draggable="true" data-tag="search" ondragstart="dragItem(event)"><i class="fa-solid fa-magnifying-glass"></i> Search</li>
	<li class="list-group-item drag" id="upload" draggable="true" data-tag="upload" ondragstart="dragItem(event)"><i class="fa-solid fa-upload"></i> Upload</li>
  </div>
  </div>
  <li class="list-group-item drag" id="img" draggable="true" data-tag="img" ondragstart="dragItem(event)"><i class="fa-solid fa-image"></i> Image</li>
  <li class="list-group-item drag" id="video" draggable="true" data-tag="video" ondragstart="dragItem(event)"><i class="fa-solid fa-video"></i> Video</li>
  <li class="list-group-item drag" id="iframe" draggable="true" data-tag="iframe" ondragstart="dragItem(event)"><i class="fa-solid fa-frame"></i> IFrame</li>
		</ul>
		
		<button onclick="saveBlocks(\''.$BASEPATH.'/libs\', \''.self::requestPage().'\')" class="btn btn-success btn-lg mt-1 float-end fs-3"><i class="fa-solid fa-floppy-disk"></i></button>
	</div>
</div>';

		}
		
		return $panel;
	}
	public static function dropBox($file=null){
		global $page;
		$edit = isset($_GET['editpage'])&&Users::isAdmin()||Users::hasPermission('pages')&&isset($_GET['editpage']) ? true : false;
		$box='';
		$box.='<div oncontextmenu="return showContextMenu();" id="dropbox"'.($edit ? ' contenteditable="true" class="editView m-2" ' : 'class="m-2').' ondrop="dropItem(event)" ondragover="allowDropItem(event)">';
		$file = ($file!==null ? file_get_contents($file): '');
		$i=0;
		if(preg_split('/\n/', $file)){
			foreach(preg_split('/\n/', $file) as $element){
				$box .= $element;
			
			}
		}
		$box.='</div>';
		$box.='<script>
		let style = "'.str_replace(array("body{","}"," ","\n","\r","\r\n"),'',file_get_contents(ROOT.'pages'.DS.self::requestPage().DS.self::requestPage().'.css')).'"
		document.body.setAttribute("style", style);
		</script>';
		return $box;
	}
	public static function help(){
		global $lang;
		$help='';
		$edit = isset($_GET['editpage'])&&Users::isAdmin()||Users::hasPermission('pages')&&isset($_GET['editpage']) ? true : false;
		if($edit)
			$help = '<div class="modal fade" id="blockshelper" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        '.$lang['blocks.usage'].'
      </div>
    </div>
  </div>
</div><button style="z-index:1000;" data-bs-toggle="modal" data-bs-target="#blockshelper" class="btn fs-2 position-absolute bottom-0 btn-dark"><i class="fa-solid fa-circle-question"></i></button>';
		
		return $help;
	}
}
?>