<?php
class WYSIWYG
{
		# ~
	const version = '0.0.1';
		# ~
		
	public $lang;
	protected $dict;
	public $conf;
	
	function __construct($language){
		$this->lang = $language;
		$this->conf = json_decode(file_get_contents(ROOT.'conf'.DS.'config.dat.json'), true);
		$this->dict = array(
		'en'=>array(
			'modal'=>array(
				'divContainer'=>array(
					'title'=>'Div Container Properties'
					),
				'anchor'=>array(
					'title'=>'Anchor Properties'
				),
				'link'=>array(
					'title'=>'Link Properties'
				),
				'table'=>array(
					'title'=>'Table Properties'
				),
				'uploads'=>array(
					'title'=>'Upload Properties',
					'label'=>'Upload File'
				),
				'style'=>'Style',
				'classes'=>'Stylesheet classes',
				'id'=>'ID',
				'lang'=>'Language Code',
				'advisorytitle'=>'Advisory Title',
				'close'=>'Close',
				'save'=>'Save',
				'advanced'=>'Advanced',
				'general'=>'General',
				'dir'=>'Language Direction',
				'name'=>'Name',
				'type'=>'Type',
				'protocol'=>'Protocol',
				'url'=>'URL',
				'target'=>'Target',
				'email'=>array(
					'title'=>'Email Address',
					'subject'=>'Message Subject',
					'body'=>'Message Body'
				),
				'phone'=>'Phone',
				'displayname'=>'Display Name',
				'advisorycontenttype'=>'Advisory Content Type',
				'linkedresourcecharset'=>'Linked Resource Charset',
				'rel'=>'Relationship',
				'download'=>'Force Download',
				'width'=>'Width',
				'height'=>'height',
				'borderSpacing'=>'Border Spacing'
			),
			'pf'=>array(
				'label'=>'Paragraph Format',
				'lists'=>array(
					''=>'Normal',
					'h1'=>'Heading 1',
					'h2'=>'Heading 2',
					'h3'=>'Heading 3',
					'h4'=>'Heading 4',
					'h5'=>'Heading 5',
					'h6'=>'Heading 6',
					'pre'=>'Formatted',
					'address'=>'Address',
					'div'=>'Normal (DIV)'
				)
				),
				'fs'=>array(
					'label'=>'Font Size',
					'lists'=>array(
					''=>'Default',
					'8'=>'8',
					'9'=>'9',
					'10'=>'10',
					'11'=>'11',
					'12'=>'12',
					'14'=>'14',
					'16'=>'16',
					'18'=>'18',
					'20'=>'20',
					'22'=>'22',
					'24'=>'24',
					'26'=>'26',
					'28'=>'28',
					'36'=>'36',
					'48'=>'48',
					'72'=>'72'
					)
				),
				'fn'=>array(
					'label'=>'Font Name',
					'lists'=>array(
						''=>'Default',
						'Arial,Helvetica,sans-serif'=>'Airal',
						'Comic Sans MS,cursive'=>'Comic Sans MS',
						'Courier New,Courier,monospace'=>'Courier New',
						'Georgia,serif'=>'Georgia',
						'Lucida Sans Unicode,Lucida Grande,sans-serif'=>'Lucida Sans Unicode',
						'Tahoma,Geneva,sans-serif'=>'Tahoma',
						'Times New Roman,Times,serif'=>'Times New Roman',
						'Trebuchet MS,Helvetica,sans-serif'=>'Trebuchet MS',
						'Verdana,Geneva,sans-serif'=>'Verdana'
					)
				
				),
				'bs'=>array(
					'label'=>'Block Style',
					'lists'=>array(
						# ',' are used for multiple actions
						''=>'Default',
						'h2,italic'=>'Italic Title',
						'h3,italic'=>'Subtitle',
						'attr,special-container'=>'<span class="special-container">Special Container</span>',
						'attr,marker'=>'<span class="marker">Marker</span>',
						'big'=>'Big',
						'small'=>'small',
						'tt'=>'Typewriter',
						'code'=>'Computer Code',
						'kbd'=>'Keyboard Phrase',
						'samp'=>'Sample Text',
						'var'=>'Variable',
						'del'=>'Deleted Text',
						'ins'=>'Insert Text',
						'cite'=>'Cited Work',
						'q'=>'Inline Quotation',
						'attr,rtl'=>'<span dir="rtl">Language: RTL</span>',
						'attr,ltr'=>'<span dir="ltr">Language: LTR</span>'
					)
				),
				'prebtn'=>array(
					'label'=>'Toggle Preview'
				),
				'tc'=>array(
					'label'=>'<i class="fas fa-paint-brush-alt"></i>',
					'lists'=>array(
						'rgba(0,0,0,0)'=>'<span style="color:black;">Transparent</span>',
						'#000000'=>'Black',
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
						'#2f4f4f'=>'Darkslategrey'
					)
					),
					'bg'=>array(
						'label'=>'<i class="fas fa-fill-drip"></i>',
						'lists'=>array(
							'rgba(0,0,0,0)'=>'<span style="color:black;">Transparent</span>',
							'#000000'=>'Black',
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
							'#2f4f4f'=>'Darkslategrey'
					)
				),
				'bold'=>array(
					'label'=>'<i class="fas fa-bold"></i>'
				),
				'italic'=>array(
					'label'=>'<i class="fas fa-italic"></i>'
				),
				'underline'=>array(
					'label'=>'<i class="fas fa-underline"></i>'
				),
				'strikethrough'=>array(
					'label'=>'<i class="fas fa-strikethrough"></i>'
				),
				'superscript'=>array(
					'label'=>'<i class="fas fa-superscript"></i>'
				),
				'subscript'=>array(
					'label'=>'<i class="fas fa-subscript"></i>'
				),
				'align'=>array(
					'label'=>'<i class="fas fa-align-left"></i>',
					'lists'=>array(
						'left'=>'<i class="fas fa-align-left"></i>',
						'center'=>'<i class="fas fa-align-center"></i>',
						'right'=>'<i class="fas fa-align-right"></i>',
						'justify'=>'<i class="fas fa-align-justify"></i>'
					)
				),
				'bq'=>array(
					'label'=>'<i class="fas fa-quote-left"></i>'
				),
				'div'=>array(
					'label'=>'<i class="fas fa-code"></i>'
				),
				'uploads'=>array(
					'label'=>'<i class="fa-solid fa-upload"></i>'
				),
				'copy'=>array(
					'label'=>'<i class="fas fa-copy"></i>'
				),
				'paste'=>array(
					'label'=>'<i class="fas fa-paste"></i>'
				),
				'fullscreen'=>array(
					'label'=>'<i class="far fa-expand-arrows"></i>'
				),
				'pdir'=>array(
					'label'=>'<i class="fas fa-paragraph"></i>',
					'lists'=>array(
						'ltr'=>'<i class="fas fa-paragraph-rtl" style="transform: scaleX(-1);"></i>',
						'rtl'=>'<i class="fas fa-paragraph-rtl"></i>'
					)
				),
				'indent'=>array(
					'label'=>'<i class="fas fa-indent"></i>',
					'lists'=>array(
						'increase'=>'<i class="fas fa-indent"></i>',
						'decrease'=>'<i class="fas fa-indent" style="transform: scaleX(-1);"></i>'
					)
				),
				'listing'=>array(
					'label'=>'<i class="fas fa-list-alt"></i>',
					'lists'=>array(
						'ol'=>'<i class="fas fa-list-ol"></i>',
						'ul'=>'<i class="fas fa-list-ul"></i>'
					)
				),
				'anchor'=>array(
					'label'=>'<i class="fas fa-anchor"></i>'
				),
				'link'=>array(
					'label'=>'<i class="fas fa-link"></i>',
					'lists'=>array(
						'url'=>'URL',
						'anchor'=>'Anchor',
						'email'=>'Email',
						'phone'=>'Phone'
					),
					'targets'=>array(
						''=>'&lt;Not Set&gt;',
						'_blank'=>'New Window',
						'_top'=>'Topmost Window',
						'_self'=>'Same Window',
						'_parent'=>'Parent Window'
					)
				),
				'table'=>array(
					'label'=>'<i class="fal fa-table"></i>',
					'rows'=>'Rows',
					'cols'=>'Columns',
					'cellSpacing'=>'Cell Spacing',
					'cellPadding'=>'Cell Padding',
					'headers'=>array(
						'label'=>'Headers',
						'lists'=>array(
							''=>'None',
							'firstrow'=>'First Row',
							'firstcol'=>'First Column',
							'both'=>'Both'
						)
					),
					'align'=>array(
						'label'=>'Alignment',
						'lists'=>array(
							''=>'&lt;Not Set&gt;',
							'left'=>'Left',
							'center'=>'Center',
							'right'=>'Right'
						)
					),
					'caption'=>'Caption',
					'summary'=>'Summary'
				),
				'selectAll'=>array(
					'label'=>'<i class="fas fa-highlighter"></i>'
				),
				'imgs'=>array(
					'label'=>'<i class="fa-solid fa-image"></i>'
				),
				'vids'=>array(
					'label'=>'<i class="fa-solid fa-video"></i>'
				)
				
		)
		);
}
	function paragraphFormat($options=[]){
		$out='';
		$options = $this->dict[$this->lang]['pf']['lists'];
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="paraFormatList" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['pf']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="paraFormatList">
	';
	foreach($options as $opt=>$val){
			$out.='<li onclick="paragraphFormat(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn">'.($opt!=='' ? '<'.$opt.'>'.$val.'</'.$opt.'>' : '<span>'.$val.'</span>').'</a></li>';
		} 
	$out.='
  </ul>
</div>';
		
	
		return $out;
	}
	function fontSize($options=[]){
			$out='';
		$options = $this->dict[$this->lang]['fs']['lists'];
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="fontSize" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['fs']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="fontSize">
	';
	foreach($options as $opt=>$val){
			$out.='<li onclick="fontSize(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span '.($opt!=='' ? 'style="font-size:'.$opt.'px;"' : '').'>'.$val.'</span></a></li>';
		} 
	$out.='
  </ul>
</div>';
		return $out;
	}
	function fontName($options=[]){
			$out='';
		$options = $this->dict[$this->lang]['fn']['lists'];
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="fontName" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['fn']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="fontName">
	';
	foreach($options as $opt=>$val){
			$out.='<li onclick="fontName(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span '.($opt!=="" ? 'style="font-family:'.$opt.';"' : '').'>'.$val.'</span></a></li>';
		} 
	$out.='
  </ul>
</div>';
		return $out;
	}
	function blockStyle($options=[]){
		$out='';
		$options = $this->dict[$this->lang]['bs']['lists'];
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="blockStyle" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['bs']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="blockStyle">
	';
	foreach($options as $opt=>$val){
		if($opt!==''){
			$mult = explode(',', $opt);	
		}
		#assumed tag
		$tag ='';
		if($opt!==''){
			$tag .= '<'.(isset($mult[0])&&$mult[0]!=='attr' ? $mult[0] : 'span').(isset($mult[1])&&$mult[0]!=='attr' ? ' style="font-style:'.$mult[1].'"' : '').'>'.$val.'</'.(isset($mult[0])&&$mult[0]!=='attr' ? $mult[0] : 'span').'>';
		}else{
			$tag .= '<span>'.$val.'</span>';
		}
			$out.='<li onclick="blockStyle(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn">'.$tag.'</a></li>';
		} 
	$out.='
  </ul>
</div>';
		return $out;	
	}
	function previewBtn(){
		$out='<button type="button" toggle-mode="edit" onclick="togglePreview(this, this.getAttribute(\'toggle-mode\'))" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$this->dict[$this->lang]['prebtn']['label'].'"><i class="fas fa-eye"></i></button>';
		return $out;
	}
	
	function textColor($color='black'){
		$out='';
		$options = $this->dict[$this->lang]['tc']['lists'];
	$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="textColor" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['tc']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="textColor">
	';
	foreach($options as $opt=>$val){
	$out.='<li onclick="textColor(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span '.($opt!=="" ? 'style="color:'.$opt.';"' : '').'>'.$val.'</span></a></li>';	
	}
	$out.='
  </ul>
</div>';
return $out;
}

	function bgColor($color='black'){
		$out='';
		$options = $this->dict[$this->lang]['bg']['lists'];
	$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="textColor" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['bg']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="textColor">
	';
	foreach($options as $opt=>$val){
	$out.='<li onclick="backgroundColor(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn" '.($opt==="#000000"||$opt==="#0000ff"||$opt==="#2f4f4f" ? 'style="color:white;"':'').'><span '.($opt!=="" ? 'style="background-color:'.$opt.';"' : '').'>'.$val.'</span></a></li>';	
	}
	$out.='
  </ul>
</div>';
return $out;
}
function bold(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="bold" onclick="createBold();">
    '.$this->dict[$this->lang]['bold']['label'].'
  </button>
</div>';
return $out;
}
function italic(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="italic" onclick="createItalic();">
    '.$this->dict[$this->lang]['italic']['label'].'
  </button>
</div>';
return $out;
}
function underline(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="underline" onclick="createUnderline();">
    '.$this->dict[$this->lang]['underline']['label'].'
  </button>
</div>';
return $out;
}
function strikethrough(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="strikethrough" onclick="createStrikethrough();">
    '.$this->dict[$this->lang]['strikethrough']['label'].'
  </button>
</div>';
return $out;
}

function superscript(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="superscript" onclick="createSuper();">
    '.$this->dict[$this->lang]['superscript']['label'].'
  </button>
</div>';
return $out;
}
function subscript(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="subscript" onclick="createSub();">
    '.$this->dict[$this->lang]['subscript']['label'].'
  </button>
</div>';
return $out;
}
function align($options=[]){
		$out='';
		$options = $this->dict[$this->lang]['align']['lists'];
	$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="textColor" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['align']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="textColor">
	';
	foreach($options as $opt=>$val){
		$out.='<li onclick="textAlign(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span style="text-align:'.$opt.'">'.$val.'</span></a></li>';	
	}
	$out.='
  </ul>
</div>';
return $out;
}

function blockqoute(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="blockquote" onclick="createBlockQuote();">
    '.$this->dict[$this->lang]['bq']['label'].'
  </button>
</div>';
return $out;
}
# start Div container
function div(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="div" onclick="toggleDiv();">
    '.$this->dict[$this->lang]['div']['label'].'
  </button>
</div>';
return $out;
}
function divEdit(){
	$out = '';
	$out .= '
	<button type="button" class="editPromptBtn editDivContainer" data-bs-toggle="modal" data-bs-target="#divEditContainer"></button>
	<div class="modal fade" id="divEditContainer" tabindex="-1" aria-labelledby="divEdit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="divEdit">'.$this->dict[$this->lang]['modal']['divContainer']['title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">';
	  $out.='<h6>'.$this->dict[$this->lang]['modal']['general'].'</h6>';
	  $out.='<div class="row">';
        $out .= '<div class="col">
		<label for="DivStyle" class="form-label">'.$this->dict[$this->lang]['modal']['style'].'</label>
		<select id="DivStyle" class="form-control">
		<option value="">&lt;not set&gt;</option>
		<option value="special-container">Special Container</option>
		</select></div>';
		 $out .= '<div class="col">
		<label for="DivClasses" class="form-label">'.$this->dict[$this->lang]['modal']['classes'].'</label>
		<input class="form-control" id="DivClasses"/>
		</div>';
	$out.='</div>';
	$out.='<hr/><h6 class="mt-2">'.$this->dict[$this->lang]['modal']['advanced'].'</h6>';
	$out.='<div class="row">
	<div class="col">
	<label for="DivID" class="form-label">'.$this->dict[$this->lang]['modal']['id'].'</label>
	<input type="text" class="form-control" id="DivID"/>
	</div>
	<div class="col">
	<label for="DivLang" class="form-label">'.$this->dict[$this->lang]['modal']['lang'].'</label>
	<input type="text" class="form-control" id="DivLang"/>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<label for="DivStyleTxt" class="form-label">'.$this->dict[$this->lang]['modal']['style'].'</label>
	<input type="text" class="form-control" id="DivStyleTxt"/>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<label for="DivTitle" class="form-label">'.$this->dict[$this->lang]['modal']['advisorytitle'].'</label>
	<input type="text" class="form-control" id="DivTitle"/>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
	<label for="DivDir" class="form-label">'.$this->dict[$this->lang]['modal']['dir'].'</label>
	<select class="form-control" id="DivDir">
	<option value="">&lt;not set&gt;</option>
	<option value="ltr">LTR</option>
	<option value="rtl">RTL</option>
	</select>
	</div>
	</div>';
    $out.='</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">'.$this->dict[$this->lang]['modal']['close'].'</button>
        <button type="button" class="btn btn-primary saveDiv">'.$this->dict[$this->lang]['modal']['save'].'</button>
      </div>
    </div>
  </div>
</div>';
	
	return $out;
}
# End Div container
function copyText(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="copy" onclick="copyText();">
    '.$this->dict[$this->lang]['copy']['label'].'
  </button>
</div>';	
return $out;
}

function pasteText(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="paste" onclick="pasteText();">
    '.$this->dict[$this->lang]['paste']['label'].'
  </button>
</div>';	
return $out;
}

function fullScreen(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="fullscreen" onclick="fullScreen();">
    '.$this->dict[$this->lang]['fullscreen']['label'].'
  </button>
</div>';	
return $out;	
}

function paragraphDir($options=[]){
		$out='';
		$options = $this->dict[$this->lang]['pdir']['lists'];
	$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="textColor" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['pdir']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="textColor">
	';
	foreach($options as $opt=>$val){
		$out.='<li onclick="paragraphDir(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span dir='.$opt.'">'.$val.'</span></a></li>';	
	}
	$out.='
  </ul>
</div>';
return $out;
}

function indent($options=[]){
		$out='';
		$options = $this->dict[$this->lang]['indent']['lists'];
	$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="textColor" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['indent']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="textColor">
	';
	foreach($options as $opt=>$val){
		$out.='<li onclick="indent(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span dir='.$opt.'">'.$val.'</span></a></li>';	
	}
	$out.='
  </ul>
</div>';
return $out;
}

function listing($options=[]){
		$out='';
		$options = $this->dict[$this->lang]['listing']['lists'];
	$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="textColor" data-bs-toggle="dropdown" aria-expanded="false">
    '.$this->dict[$this->lang]['listing']['label'].'
  </button>
  <ul class="dropdown-menu" aria-labelledby="textColor">
	';
	foreach($options as $opt=>$val){
		$out.='<li onclick="listing(\''.$opt.'\')" class="m-0" value="'.$opt.'"><a class="btn"><span dir='.$opt.'">'.$val.'</span></a></li>';	
	}
	$out.='
  </ul>
</div>';
return $out;
}
# start anchor element
function anchor(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="anchor" onclick="toggleAnchor();">
    '.$this->dict[$this->lang]['anchor']['label'].'
  </button>
</div>';
return $out;
}
function anchorEdit(){
	$out = '';
	$out .= '
	<button type="button" class="editPromptBtn editAnchorEdit" data-bs-toggle="modal" data-bs-target="#anchorEditContainer"></button>
	<div class="modal fade" id="anchorEditContainer" tabindex="-1" aria-labelledby="anchorEdit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="anchorEdit">'.$this->dict[$this->lang]['modal']['anchor']['title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ';
		$out.='<div class="row">
		<div class="col">
			<label for="anchorName" class="form-label">'.$this->dict[$this->lang]['modal']['name'].'</label>
			<input type="text" class="form-control" id="anchorName"/>
		</div>
		</div>';
		$out.='
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$this->dict[$this->lang]['modal']['close'].'</button>
        <button type="button" class="btn btn-primary saveAnchor">'.$this->dict[$this->lang]['modal']['save'].'</button>
      </div>
    </div>
  </div>
</div>
	';
	
	return $out;
}
/*link*/
function links(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="link" onclick="toggleLink();">
    '.$this->dict[$this->lang]['link']['label'].'
  </button>
</div>';
return $out;
}
function linksEdit(){
	$out = '';
	$out .= '
	<button type="button" class="editPromptBtn editLinkEdit" data-bs-toggle="modal" data-bs-target="#LinkEditContainer"></button>
	<div class="modal fade" id="LinkEditContainer" tabindex="-1" aria-labelledby="linkEdit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="anchorEdit">'.$this->dict[$this->lang]['modal']['link']['title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ';
		$out.='<div class="row">
		<h6 class="mt-2">'.$this->dict[$this->lang]['modal']['general'].'</h6>
		<div class="col">
			<label for="displayName" class="form-label">'.$this->dict[$this->lang]['modal']['displayname'].'</label>
			<input type="text" class="form-control" id="displayName"/>
		</div>
		</div>';
		$out.='<div class="row">
		<div class="col">
			<label for="type" class="form-label">'.$this->dict[$this->lang]['modal']['type'].'</label>
			<select class="form-control" id="LinkType">
			';
			foreach($this->dict[$this->lang]['link']['lists'] as $item=>$txt){
				if($this->conf['editor']==='wysiwyg'&&$item==='phone'||$this->conf['editor']==='wysiwyg'&&$item==='anchor'){
					$out.='<option value="'.$item.'">'.$txt.'</option>';
				}elseif($this->conf['editor']!=='wysiwyg'&&$item==='phone'||$this->conf['editor']!=='wysiwyg'&&$item==='anchor'){
					$out.='';
				}else{
					$out.='<option value="'.$item.'">'.$txt.'</option>';
				}
				
				
			}
		$out.='
			</select>
		</div>
		</div>';
		
		$out.='<div class="row" target-link="url">
		<div class="col">
			<label for="Protocol" class="form-label">'.$this->dict[$this->lang]['modal']['protocol'].'</label>
			<select class="form-control" id="Protocol">
			<option value="http://">http://</option>
			<option value="https://">https://</option>
			</select>
		</div>
		<div class="col">
		<label for="url" class="form-label">'.$this->dict[$this->lang]['modal']['url'].'</label>
			<input type="text" class="form-control" id="url"/>
		</div>
		<div class="col" '.($this->conf['editor']==='wysiwyg' ? '' : 'hidden="hidden"').'>
			<label for="target" class="form-label">'.$this->dict[$this->lang]['modal']['target'].'</label>
			<select class="form-control" id="target">
			';
			foreach($this->dict[$this->lang]['link']['targets'] as $target=>$label){
				$out .= '<option value="'.$target.'">'.$label.'</option>';
			}
			$out.='
			</select>
		</div>
		</div>';
		$out.='<div class="row" target-link="anchor" hidden="true">
			<div class="col mt-2">
			<div class="input-group">
		<span class="input-group-text"><i class="fas fa-hashtag"></i></span>
			<input type="text" class="form-control" id="anchor"/>
		</div>
		</div>
		</div>';
		
		$out.='<div class="row" target-link="email" hidden="true">
			<div class="col mt-2">
			<label for="email" class="form-label">'.$this->dict[$this->lang]['modal']['email']['title'].'</label>
			<input type="email" class="form-control" id="email"/>
			</div>
			<div class="col mt-2">
			<label for="subject" class="form-label">'.$this->dict[$this->lang]['modal']['email']['subject'].'</label>
			<input type="text" class="form-control" id="subject"/>
			</div>
			<div class="col mt-2">
			<label for="body" class="form-label">'.$this->dict[$this->lang]['modal']['email']['body'].'</label>
			<textarea class="form-control" id="body"></textarea>
			</div>
		</div>';
		
		$out.='<div class="row" target-link="phone" hidden="true">
			<div class="col mt-2">
			<label for="phone" class="form-label">'.$this->dict[$this->lang]['modal']['phone'].'</label>
			<input type="tel" class="form-control" id="phone"/>
			</div>
		</div>';
			$out .= '<div '.($this->conf['editor']==='wysiwyg' ? '' : 'style="display:none;"').'>';
				$out.='<hr/><h6 class="mt-2">'.$this->dict[$this->lang]['modal']['advanced'].'</h6>';
		$out.='
		<div class="row">
		<div class="col">
		<label for="linkid" class="form-label">'.$this->dict[$this->lang]['modal']['id'].'</label>
		<input type="text" id="linkid" class="form-control"/>
		</div>
		<div class="col">
		<label for="linkname" class="form-label">'.$this->dict[$this->lang]['modal']['name'].'</label>
		<input type="text" id="linkname" class="form-control"/>
		</div>
		</div>
		';
		$out.='<div class="row">
		<div class="col">
			<label for="LinkLang" class="form-label">'.$this->dict[$this->lang]['modal']['lang'].'</label>
			<input type="text" class="form-control" id="LinkLang"/>
		</div>
		<div class="col">
	<label for="LinkDir" class="form-label">'.$this->dict[$this->lang]['modal']['dir'].'</label>
	<select class="form-control" id="LinkDir">
	<option value="">&lt;not set&gt;</option>
	<option value="ltr">LTR</option>
	<option value="rtl">RTL</option>
	</select>
	</div>
		</div>';
			$out.='<div class="row">
	<div class="col">
	<label for="LinkTitle" class="form-label">'.$this->dict[$this->lang]['modal']['advisorytitle'].'</label>
	<input type="text" class="form-control" id="LinkTitle"/>
	</div>
	<div class="col">
	<label for="LinkType" class="form-label">'.$this->dict[$this->lang]['modal']['advisorycontenttype'].'</label>
	<input type="text" class="form-control" id="LinkType"/>
	</div>
	</div>';
	$out.='<div class="row">
	<div class="col">
		<label for="LinkClasses" class="form-label">'.$this->dict[$this->lang]['modal']['classes'].'</label>
		<input class="form-control" id="LinkClasses"/>
		</div>
		<div class="col">
		<label for="LinkCharset" class="form-label">'.$this->dict[$this->lang]['modal']['linkedresourcecharset'].'</label>
		<input class="form-control" id="LinkCharset"/>
		</div>
	</div>';
$out.='<div class="row">
	<div class="col">
		<label for="LinkRel" class="form-label">'.$this->dict[$this->lang]['modal']['rel'].'</label>
		<input class="form-control" id="LinkRel"/>
		</div>
		<div class="col">
	<label for="LinkStyle" class="form-label">'.$this->dict[$this->lang]['modal']['style'].'</label>
	<input type="text" class="form-control" id="LinkStyle"/>
	</div>
	</div>';
$out.='<div class="row">
<div class="col">
	<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="LinkDownload">
  <label class="form-check-label" for="LinkDownload">
    '.$this->dict[$this->lang]['modal']['download'].'
  </label>
</div>
</div>
</div>';
$out.='</div>';
		
	
		$out.='
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$this->dict[$this->lang]['modal']['close'].'</button>
        <button type="button" class="btn btn-primary saveLink">'.$this->dict[$this->lang]['modal']['save'].'</button>
      </div>
    </div>
  </div>
</div>
	';
	
	return $out;
}

/*end link*/

/*start table*/
function table(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="div" onclick="toggleTable();">
    '.$this->dict[$this->lang]['table']['label'].'
  </button>
</div>';
return $out;
}
function tableEdit(){
	$out = '';
	$out .= '
	<button type="button" class="editPromptBtn editTableEdit" data-bs-toggle="modal" data-bs-target="#TableEditContainer"></button>
	<div class="modal fade" id="TableEditContainer" tabindex="-1" aria-labelledby="tableEdit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="anchorEdit">'.$this->dict[$this->lang]['modal']['table']['title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ';
		$out.='<div class="row">
		<h6 class="mt-2">'.$this->dict[$this->lang]['modal']['general'].'</h6>
		<div class="col">
			<label for="tableRows" class="form-label">'.$this->dict[$this->lang]['table']['rows'].'</label>
			<input type="number" class="form-control" id="tableRows" value="3"/>
		</div>
		<div class="col">
			<label for="tableWidth" class="form-label">'.$this->dict[$this->lang]['modal']['width'].'</label>
			<input type="number" class="form-control" id="tableWidth" value="500"/>
		</div>
		</div>';
			$out.='<div class="row">
		<div class="col">
			<label for="tableCols" class="form-label">'.$this->dict[$this->lang]['table']['cols'].'</label>
			<input type="number" class="form-control" id="tableCols" value="2"/>
		</div>
		<div class="col">
			<label for="tableHeight" class="form-label">'.$this->dict[$this->lang]['modal']['height'].'</label>
			<input type="number" class="form-control" id="tableHeight"/>
		</div>
		</div>';
			$out.='<div class="row">
		<div class="col">
			'.HTMLForm::select('tableHeader', $this->dict[$this->lang]['table']['headers']['lists']).'
		</div>
		<div class="col">
			<label for="cellSpacing" class="form-label">'.$this->dict[$this->lang]['table']['cellSpacing'].'</label>
			<input type="number" class="form-control" id="cellSpacing" value="1"/>
		</div>
		</div>';
				$out.='<div class="row">
		<div class="col">
			<label for="borderSpacing" class="form-label">'.$this->dict[$this->lang]['modal']['borderSpacing'].'</label>
			<input type="number" class="form-control" id="borderSpacing" value="1"/>
		</div>
		<div class="col">
			<label for="cellPadding" class="form-label">'.$this->dict[$this->lang]['table']['cellPadding'].'</label>
			<input type="number" class="form-control" id="cellPadding" value="1"/>
		</div>
		</div>';
				$out.='<div class="row">
		<div class="col">
			<label for="tableAlign" class="form-label">'.$this->dict[$this->lang]['table']['align']['label'].'</label>
			<select id="tableAlign" name="tableAlign" class="form-control w-50">
			';
			foreach($this->dict[$this->lang]['table']['align']['lists'] as $val => $txt){
				$out .= '<option value="'.$val.'">'.$txt.'</option>';
			}
			$out.='
			</select>
		</div>
		</div>';
			$out.='<div class="row">
		<div class="col">
			<label for="tableCaption" class="form-label">'.$this->dict[$this->lang]['table']['caption'].'</label>
			<input type="text" class="form-control" id="tableCaption"/>
		</div>
		</div>';
			$out.='<div class="row">
		<div class="col">
			<label for="tableSummary" class="form-label">'.$this->dict[$this->lang]['table']['summary'].'</label>
			<input type="text" class="form-control" id="tableSummary"/>
		</div>
		</div>';
		$out.='<hr/><h6 class="mt-2">'.$this->dict[$this->lang]['modal']['advanced'].'</h6>';
		$out.='<div class="row">
		<div class="col">
			<label for="tableID" class="form-label">'.$this->dict[$this->lang]['modal']['id'].'</label>
			<input type="text" class="form-control" id="tableID"/>
		</div>
		<div class="col">
			<label for="tableDir" class="form-label">'.$this->dict[$this->lang]['modal']['dir'].'</label>
			<select class="form-control" id="tableDir">
			<option value="">&lt;Not Set&gt;</option>
			<option value="ltr">LFT</option>
			<option value="RTL">RTL</option>
			</select>
		</div>
		</div>';
				$out.='<div class="row">
		<div class="col">
			<label for="tableStyle" class="form-label">'.$this->dict[$this->lang]['modal']['style'].'</label>
			<input type="text" class="form-control" id="tableStyle"/>
		</div>
		<div class="col">
			<label for="tableClasses" class="form-label">'.$this->dict[$this->lang]['modal']['classes'].'</label>
			<input type="text" class="form-control" id="tableClasses">
		</div>
		</div>';
		
		$out.='
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$this->dict[$this->lang]['modal']['close'].'</button>
        <button type="button" class="btn btn-primary saveTable">'.$this->dict[$this->lang]['modal']['save'].'</button>
      </div>
    </div>
  </div>
</div>
	';
	return $out;
}
/*end table*/

# end anchor element
function selectAll(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="selectAll" onclick="selectAll();">
    '.$this->dict[$this->lang]['selectAll']['label'].'
  </button>
</div>';	
return $out;
}

# start uploads
function uploads(){
		$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="div" onclick="toggleUploads();">
    '.$this->dict[$this->lang]['uploads']['label'].'
  </button>
</div>';
return $out;
}
function uploadEdit(){
	include_once('files.lib.php');
	global $session;
	$out='';
	$out.='
	<button type="button" class="editPromptBtn editUploadContainer" data-bs-toggle="modal" data-bs-target="#uploadEditContainer"></button>
	<div class="modal fade" id="uploadEditContainer" tabindex="-1" aria-labelledby="uploadEdit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadEdit">'.$this->dict[$this->lang]['modal']['uploads']['title'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

	  <label class="from-label">'.$this->dict[$this->lang]['modal']['uploads']['label'].'</label>
        <input type="file" name="fileUpload" required="" class="form-control"/>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">'.$this->dict[$this->lang]['modal']['close'].'</button>
        <button name="saveUpload" type="submit" class="btn btn-primary saveUpload">'.$this->dict[$this->lang]['modal']['save'].'</button>
      </div>
	  </form>
    </div>
  </div>
</div>';
if(isset($_POST['saveUpload'])){
				Files::upload('fileUpload', DATA_UPLOADS.DS);
		}
return $out;
}


# end uploads

function imgs(){
		$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="div" onclick="createImg();">
    '.$this->dict[$this->lang]['imgs']['label'].'
  </button>
</div>';
return $out;
}
function vids(){
	$out='';
		$out .= '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="div" onclick="createVids();">
    '.$this->dict[$this->lang]['vids']['label'].'
  </button>
</div>';
return $out;
}


	}
	
	
?>