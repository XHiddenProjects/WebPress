<?php defined('WEBPRESS') or die('Webpress community');
class Editor{
	public $MD;
	public $BB;
	public $WYSIWYG;
	public $conf;
	
	public function __construct(){
		$this->WYSIWYG = new WYSIWYG(Users::getLang());
	}
	public function createEditor($editor, $displayUI=true, $customCode=null, $show_source=null, $raw=false, $name=''){
		$code='';
		$show_source = $show_source;
		$out = '';
		$out .= '<div class="editorpanel" expended="false">';
		$out .= Plugin::hook('editor');
		$setClass = '';
		if($customCode!==null){
			$code = $customCode;
		}elseif($editor==="wysiwyg"){
			$code = 'html';
			if($displayUI){
			$out .= '<ul class="list-group flex-wrap border border-0 list-group-flush list-group-horizontal list-group-horizontal-sm wysiwyg-editor">';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->paragraphFormat().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->fontSize().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->fontName().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->blockStyle().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->previewBtn().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->textColor().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->bgColor().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->bold().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->italic().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->underline().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->strikethrough().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->superscript().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->subscript().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->align().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->blockquote().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->div().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->copyText().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->pasteText().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->fullScreen().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->paragraphDir().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->indent().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->listing().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->anchor().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->selectAll().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->links().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->table().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->uploads().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->imgs().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->vids().'</li>';
			$out .= '</ul>';
			$out .= $this->WYSIWYG->divEdit();
			$out .= $this->WYSIWYG->anchorEdit();
			$out .= $this->WYSIWYG->linksEdit();
			$out .= $this->WYSIWYG->tableEdit();
			$out .= $this->WYSIWYG->uploadEdit();
			}
	
		}elseif($editor==="bbcode"){
			$code='bbcode';
			if($displayUI){
			$out .= '<ul class="list-group flex-wrap border border-0 list-group-flush list-group-horizontal list-group-horizontal-sm wysiwyg-editor">';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->paragraphFormat().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->fontSize().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->textColor().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->bold().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->italic().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->underline().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->strikethrough().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->superscript().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->subscript().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->links().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->listing().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->blockquote().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->align().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->uploads().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->imgs().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->vids().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->fullScreen().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->selectAll().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->copyText().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->pasteText().'</li>';
			
			$out .= '</ul>';
			$out .= $this->WYSIWYG->linksEdit();
			$out .= $this->WYSIWYG->uploadEdit();
			}
			
		}elseif($editor==="markdown"){
			$code='md';
			if($displayUI){
					$out .= '<ul class="list-group flex-wrap border border-0 list-group-flush list-group-horizontal list-group-horizontal-sm wysiwyg-editor">';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->paragraphFormat().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->bold().'</li>';
			$out.= '<li class="list-group-item">'.$this->WYSIWYG->italic().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->links().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->blockquote().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->listing().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->uploads().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->imgs().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->fullScreen().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->selectAll().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->copyText().'</li>';
			$out.='<li class="list-group-item">'.$this->WYSIWYG->pasteText().'</li>';
			$out .= '</ul>';
			$out .= $this->WYSIWYG->linksEdit();
			$out .= $this->WYSIWYG->uploadEdit();
			}
		}
	
		$out .= '<div class="editor">';
		$out .= '<textarea id="editing" name="'.($name!=='' ? $name : 'editorText').'" class="form-control lined" spellcheck="false" onkeydown="check_tab(this, event); createLineNum(event);" oninput="syntaxHighlight(this.value); sync_scroll(this);" onscroll="sync_scroll(this);" onselect="selectedString(this, \''.$editor.'\');">'.($show_source!==null ? htmlentities((!$raw ? file_get_contents($show_source) : $show_source)) : '').'</textarea>';
		$out .= '<pre id="highlighting">
					<code class="language-'.$code.'" id="highlighting-content">'.($show_source!==null ? htmlentities((!$raw ? file_get_contents($show_source) : $show_source)) : '').'</code>
					<span aria-hidden="true" class="lineCount">
						<span></span>
					</span>
				</pre>';
		$out.='</div>';
		$out.='</div>';
		return $out;
	}
}
?>