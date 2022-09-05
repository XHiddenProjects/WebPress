<?php
class Editor{
	public $MD;
	public $BB;
	public $WYSIWYG;
	public $conf;
	
	public function __construct(){
		$this->WYSIWYG = new WYSIWYG(Users::getLang());
	}
	public function createEditor($editor){
		$code='';
		$out = '';
		$out .= '<div class="editorpanel" expended="false">';
		$out .= Plugin::hook('editor');
		if($editor==="wysiwyg"){
			$code = 'html';
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
			$out.='<li class="list-group-item">'.$this->WYSIWYG->blockqoute().'</li>';
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
			$out .= '</ul>';
			$out .= $this->WYSIWYG->divEdit();
			$out .= $this->WYSIWYG->anchorEdit();
			$out .= $this->WYSIWYG->linksEdit();
			$out .= $this->WYSIWYG->tableEdit();
			$out .= $this->WYSIWYG->uploadEdit();
		}elseif($editor==="bbcode"){
			$code='bbcode';
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
			$out.='<li class="list-group-item">'.$this->WYSIWYG->align().'</li>';
			$out .= $this->WYSIWYG->linksEdit();
			$out .= '</ul>';
		}elseif($editor==="markdown"){
			$code='md';
		}
	
		$out .= '<div class="editor">';
		$out .= '<textarea id="editing" class="form-control" spellcheck="false" onkeydown="check_tab(this, event);" oninput="syntaxHighlight(this.value); sync_scroll(this);" onscroll="sync_scroll(this);" onselect="selectedString(this, \''.$code.'\');"></textarea>';
		$out .= '<pre id="highlighting">
					<code class="language-'.$code.'" id="highlighting-content"></code>
				</pre>';
		$out.='</div>';
		$out.='</div>';
		return $out;
	}
}
?>