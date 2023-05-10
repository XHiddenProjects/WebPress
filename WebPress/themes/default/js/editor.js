var selectedItem='';
var targetItem = '';
var selectedEditor = '';
function warn(){
	console.warn('You must select a string to add element');
	alert('You must select a string to add element');
}
var targetItem;
function replaceIt(txtarea, newtxt) {
      let v =  $(txtarea).val().substring(0, txtarea.selectionStart)+
        newtxt+
        $(txtarea).val().substring(txtarea.selectionEnd)
	return v;
}
  
function selectedString(elem, editor='wysiwyg'){
 if(typeof elem != "undefined"){
	targetItem = elem;
  s=elem.selectionStart;
  e=elem.selectionEnd;
   selectedItem = elem.value.substring(s, e);
 }else{
  selectedItem = '';
 }
 selectedEditor = editor;

}
function paragraphFormat(format){
	if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');
	format = (format!=='' ? format : 'p');
	code.innerText = replaceIt(targetItem,'<'+(format!=='pre' ? format : format+' class="viewCode"')+'>'+selectedItem+'</'+format+'>');
	targetItem.value = replaceIt(targetItem,selectedItem, '<'+(format!=='pre' ? format : format+' class="viewCode"')+'>'+selectedItem+'</'+format+'>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
					let code = targetItem.parentElement.querySelector('#highlighting-content');;
	format = (format!=='' ? format : 'p');
	code.innerText = replaceIt(targetItem, '['+(format==='pre' ? 'code' : format)+']'+selectedItem+'[/'+(format==='pre' ? 'code' : format)+']');
	targetItem.value = replaceIt(targetItem, '['+(format==='pre' ? 'code' : format)+']'+selectedItem+'[/'+(format==='pre' ? 'code' :format)+']');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='markdown'){
					let code = targetItem.parentElement.querySelector('#highlighting-content');
	format = (format!=='' ? format : 'p');
	switch(format){
		case 'h1':
			code.innerText = replaceIt(targetItem, '# '+selectedItem);
			targetItem.value = replaceIt(targetItem, '# '+selectedItem);
		break;
		case 'h2':
			code.innerText = replaceIt(targetItem, '## '+selectedItem);
			targetItem.value = replaceIt(targetItem, '## '+selectedItem);
		break;
		case 'h3':
			code.innerText = replaceIt(targetItem, '### '+selectedItem);
			targetItem.value = replaceIt(targetItem, '### '+selectedItem);
		break;
		case 'h4':
			code.innerText = replaceIt(targetItem, '#### '+selectedItem);
			targetItem.value = replaceIt(targetItem, '#### '+selectedItem);
		break;
		case 'h5':
			code.innerText = replaceIt(targetItem, '##### '+selectedItem);
			targetItem.value = replaceIt(targetItem, '##### '+selectedItem);
		break;
		case 'h6':
			code.innerText = replaceIt(targetItem, '###### '+selectedItem);
			targetItem.value = replaceIt(targetItem, '###### '+selectedItem);
		break;
		case 'pre':
		code.innerText = replaceIt(targetItem, '`'+selectedItem+'`');
		targetItem.value = replaceIt(targetItem, '`'+selectedItem+'`');
		break;
	}

	 Prism.highlightElement(code);
		}
	
	}

}
function fontSize(size){
	if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');
	let tag = (size!=='' ? 'span' : 'p');
	size = (size!=='' ? ' style="font-size:'+size+'px;"' : '');
	code.innerText = replaceIt(targetItem, '<'+tag+size+'>'+selectedItem+'</'+tag+'>');
	targetItem.value = replaceIt(targetItem, '<'+tag+size+'>'+selectedItem+'</'+tag+'>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');
	let tag = (size!=='' ? 'span' : 'p');
	size = (size!=='' ? size : '');
	code.innerText = replaceIt(targetItem, '[size='+size+']'+selectedItem+'[/size]');
	targetItem.value = replaceIt(targetItem, '[size='+size+']'+selectedItem+'[/size]');
	 Prism.highlightElement(code);
		}
		
	}
}
function fontName(font){
		if(selectedItem===''){
		warn();
	}else{
		let code = targetItem.parentElement.querySelector('#highlighting-content');
		font = (font!='' ? '<span style="font-family:'+font+';">'+selectedItem+'</span>' : selectedItem);
	code.innerText = replaceIt(targetItem, font);
	targetItem.value = replaceIt(targetItem, font);
	 Prism.highlightElement(code);
	}
}
function blockStyle(style){
	flat = '';
		if(selectedItem===''){
		warn();
	}else{
		let code = targetItem.parentElement.querySelector('#highlighting-content');
		let splitCode = style.split(',');
		if(splitCode[0]==='h2'||splitCode[0]==='h3'&&splitCode[1]==='italic'){
			flat = '<'+splitCode[0] + ' style="font-style:italic;">'+selectedItem+'</'+splitCode[0]+'>';
		}else if(splitCode[0]==='attr'&&splitCode[1]==="marker"||splitCode[1]==="special-container"){
			flat = '<span class="'+splitCode[1]+'">'+selectedItem+'</span>';
		}else if(splitCode[0]==='attr'&&splitCode[1]==="ltr"||splitCode[1]==="rtl"){
			flat = '<span dir="'+splitCode[1]+'">'+selectedItem+'</span>';
		}else{
			flat = '<'+style+'>'+selectedItem+'</'+style+'>';
		}
		
	code.innerText = replaceIt(targetItem, flat);
	targetItem.value = replaceIt(targetItem, flat);
	 Prism.highlightElement(code);
	}
}

function textColor(color){
	if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');
		color = (color!='' ? '<span style="color:'+color+';">'+selectedItem+'</span>' : selectedItem);
	code.innerText = replaceIt(targetItem, color);
	targetItem.value = replaceIt(targetItem, color);
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
		color = (color!='' ? '[color='+color+']'+selectedItem+'[/color]' : selectedItem);
	code.innerText = replaceIt(targetItem, color);
	targetItem.value = replaceIt(targetItem, color);
	 Prism.highlightElement(code);
		}
		
	}
}

function backgroundColor(color){
	if(selectedItem===''){
		warn();
	}else{
		let code = targetItem.parentElement.querySelector('#highlighting-content');
		color = (color!='' ? '<span style="background-color:'+color+';">'+selectedItem+'</span>' : selectedItem);
	code.innerText = replaceIt(targetItem, color);
	targetItem.value = replaceIt(targetItem, color);
	 Prism.highlightElement(code);
	}
}
function createBold(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<strong>'+selectedItem+'</strong>');
	targetItem.value = replaceIt(targetItem, '<strong>'+selectedItem+'</strong>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '[b]'+selectedItem+'[/b]');
	targetItem.value = replaceIt(targetItem, '[b]'+selectedItem+'[/b]');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='markdown'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '**'+selectedItem+'**');
	targetItem.value = replaceIt(targetItem, '**'+selectedItem+'**');
	 Prism.highlightElement(code);
		}
		
	}
}

function createItalic(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<em>'+selectedItem+'</em>');
	targetItem.value = replaceIt(targetItem, '<em>'+selectedItem+'</em>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '[i]'+selectedItem+'[/i]');
	targetItem.value = replaceIt(targetItem, '[i]'+selectedItem+'[/i]');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='markdown'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '_'+selectedItem+'_');
	targetItem.value = replaceIt(targetItem, '_'+selectedItem+'_');
	 Prism.highlightElement(code);
		}
		
	}
}

function createUnderline(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
		let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<u>'+selectedItem+'</u>');
	targetItem.value = replaceIt(targetItem, '<u>'+selectedItem+'</u>');
	 Prism.highlightElement(code);	
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '[u]'+selectedItem+'[/u]');
	targetItem.value = replaceIt(targetItem, '[u]'+selectedItem+'[/u]');
	 Prism.highlightElement(code);
		}
		
	}
}

function createStrikethrough(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<s>'+selectedItem+'</s>');
	targetItem.value = replaceIt(targetItem, '<s>'+selectedItem+'</s>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '[s]'+selectedItem+'[/s]');
	targetItem.value = replaceIt(targetItem, '[s]'+selectedItem+'[/s]');
	 Prism.highlightElement(code);
		}
	
	}
}

function createSuper(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<sup>'+selectedItem+'</sup>');
	targetItem.value = replaceIt(targetItem, '<sup>'+selectedItem+'</sup>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '[sup]'+selectedItem+'[/sup]');
	targetItem.value = replaceIt(targetItem, '[sup]'+selectedItem+'[/sup]');
	 Prism.highlightElement(code);
		}
		
	}
}

function createSub(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<sub>'+selectedItem+'</sub>');
	targetItem.value = replaceIt(targetItem, '<sub>'+selectedItem+'</sub>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
		let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '[sub]'+selectedItem+'[/sub]');
	targetItem.value = replaceIt(targetItem, '[sub]'+selectedItem+'[/sub]');
	 Prism.highlightElement(code);
		}
	}
}

function textAlign(alignment){
	if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<p style="text-align:'+alignment+';">'+selectedItem+'</p>');
	targetItem.value = replaceIt(targetItem, '<p style="text-align:'+alignment+';">'+selectedItem+'</p>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '['+alignment+']'+selectedItem+'[/'+alignment+']');
	targetItem.value = replaceIt(targetItem, '['+alignment+']'+selectedItem+'[/'+alignment+']');
	 Prism.highlightElement(code);
		}
		
	}
}
function createBlockQuote(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<figure><blockquote class="blockquote"><p>'+selectedItem+'</p></blockquote><figcaption class="blockquote-footer"><cite>Source Title</cite></figcaption></figure>');
	targetItem.value = replaceIt(targetItem, '<figure><blockquote class="blockquote"><p>'+selectedItem+'</p></blockquote><figcaption class="blockquote-footer"><cite>Source Title</cite></figcaption></figure>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='markdown'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
			code.innerText = replaceIt(targetItem, '> '+selectedItem);
			targetItem.value = replaceIt(targetItem, '> '+selectedItem);
			 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
			code.innerText = replaceIt(targetItem, '[quote]'+selectedItem+'[/quote]');
			targetItem.value = replaceIt(targetItem, '[quote]'+selectedItem+'[/quote]');
			 Prism.highlightElement(code);
		}
		
	}
}

/*start div*/
function createDiv(style='', classes='', id='', lang='', styleText='', title='', dir=''){
		if(selectedItem===''){
		warn();
	}else{
		let addClass = (classes!=='' ? ' '+classes : '');
		let divClass = (style!==''||classes!=='' ? ' class="'+style+addClass+'"' : '');
		let divID = (id!=='' ? ' id="'+id+'"' : '');
		let divLang = (lang!=='' ? ' lang="'+lang+'"': '');
		let divTitle = (title!=='' ? ' data-bs-toggle="tooltip" data-bs-placement="top" title="'+title+'"' : '');
		let divStyle = (styleText!=='' ? ' style="'+styleText+';"' : '');
		let divDir = (dir!=='' ? ' dir="'+dir+'"' : '');
		
		let divAttr = divClass+divID+divLang+divLang+divTitle+divStyle+divDir;
		
		let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<div'+divAttr+'><p>'+selectedItem+'</p></div>');
	targetItem.value = replaceIt(targetItem, '<div'+divAttr+'><p>'+selectedItem+'</p></div>');
	 Prism.highlightElement(code);
	 $('#divEditContainer').modal("hide");
	}
}
function toggleDiv(){
	document.querySelector('.editDivContainer').click();
}
function toggleUploads(){
	document.querySelector('.editUploadContainer').click();
}
setTimeout(function(){
	if(document.querySelector('.saveDiv')){
		document.querySelector('.saveDiv').addEventListener('click',function(){
	let style = document.querySelector('#DivStyle');
	let classes = document.querySelector('#DivClasses');
	let id = document.querySelector('#DivID');
	let lang = document.querySelector('#DivLang');
	let styleText = document.querySelector('#DivStyleTxt');
	let title = document.querySelector('#DivTitle'); 
	let dir = document.querySelector('#DivDir');
	createDiv(style.value, classes.value, id.value, lang.value, styleText.value, title.value, dir.value);
	style.value='';
	classes.value='';
	id.value='';
	lang.value='';
	styleText.value='';
	title.value='';
	dir.value='';
});	
	}
}, 300);

/*end Div*/

function copyText(t){
    t.parentElement.parentElement.parentElement.parentElement.querySelector('#editing').select();
    if(document.execCommand('copy')){
			$.notify("Copied to clipboard",{
				'className':'success',
				'autoHide': true,
				'clickToHide': true,
				'globalPosition': 'top right'
			});
	}else{
			$.notify("Failed to copy",{
				'className':'error',
				'autoHide': true,
				'clickToHide': true,
				'globalPosition': 'top right'
			});
	}
}

function pasteText(t){
    let ta = t.parentElement.parentElement.parentElement.parentElement.querySelector('#editing');
	let code = t.parentElement.parentElement.parentElement.parentElement.querySelector('#highlighting-content');
    if(navigator.clipboard.readText()){
		navigator.clipboard.readText().then((clipText)=>(ta.value = clipText));
		navigator.clipboard.readText().then((clipText)=>(code.innerHTML = clipText.replace(/</g, '&lt;').replace(/>/g, '&gt;')));
		Prism.highlightElement(code);
			$.notify("Pasted",{
				'className':'success',
				'autoHide': true,
				'clickToHide': true,
				'globalPosition': 'top right'
			});
	}else{
			$.notify("Failed to paste, try using CTRL+V",{
				'className':'error',
				'autoHide': true,
				'clickToHide': true,
				'globalPosition': 'top right'
			});
	}
}

function fullScreen(tar){
	let expend = tar.parentElement.parentElement.parentElement.parentElement;
	if(expend.getAttribute('expended')==='false'){
		expend.setAttribute('expended', 'true');
	}else{
		expend.setAttribute('expended', 'false');
	}
}

function paragraphDir(dir){
		if(selectedItem===''){
		warn();
	}else{
	let code = targetItem.parentElement.querySelector('#highlighting-content');;
	let direct = (dir==="rtl" ? 'rtl' : 'ltr');
	code.innerText = replaceIt(targetItem, '<p dir="'+direct+'">'+selectedItem+'</p>');
	targetItem.value = replaceIt(targetItem, '<p dir="'+direct+'">'+selectedItem+'</p>');
	 Prism.highlightElement(code);
	}
}

function indent(indent){
		if(selectedItem===''){
		warn();
	}else{
	let code = targetItem.parentElement.querySelector('#highlighting-content');;
	let ind = (indent==="increase" ? ' style="margin-left:40px;"' : '');
	code.innerText = replaceIt(targetItem, '<p'+ind+'>'+selectedItem+'</p>');
	targetItem.value = replaceIt(targetItem, '<p'+ind+'>'+selectedItem+'</p>');
	 Prism.highlightElement(code);
	}
}
function customSyntax(syntax){
	if(selectedItem===''){
		warn();
	}else{
	let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, syntax);
	targetItem.value = replaceIt(targetItem, syntax);
	Prism.highlightElement(code);
	}
}
function listing(list){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<'+list+' class="list-group list-group-flush'+(list==='ol' ? ' list-group-numbered' : '')+'">\n<li class="list-group-item">'+selectedItem+'</li>\n</'+list+'>');
	targetItem.value = replaceIt(targetItem, '<'+list+' class="list-group list-group-flush'+(list==='ol' ? ' list-group-numbered' : '')+'">\n<li class="list-group-item">'+selectedItem+'</li>\n</'+list+'>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '['+list+']\n[*]'+selectedItem+'\n[/'+list+']');
	targetItem.value = replaceIt(targetItem, '['+list+']\n[*]'+selectedItem+'\n[/'+list+']');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='markdown'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
			switch(list){
				case 'ul':
			
	code.innerText = replaceIt(targetItem, '* '+selectedItem);
	targetItem.value = replaceIt(targetItem, '* '+selectedItem);
	 Prism.highlightElement(code);
				break;
				case 'ol':
	code.innerText = replaceIt(targetItem, '1. '+selectedItem);
	targetItem.value = replaceIt(targetItem, '1. '+selectedItem);
	 Prism.highlightElement(code);
				break;
				
			}
				
		}

	}
}

/*start anchor*/
function createAnchor(name){
		if(selectedItem===''){
		warn();
	}else{
		let code = targetItem.parentElement.querySelector('#highlighting-content');;
	code.innerText = replaceIt(targetItem, '<p><a id="'+name+'" name="'+name+'">'+selectedItem+'</a></p>');
	targetItem.value = replaceIt(targetItem, '<p><a id="'+name+'" name="'+name+'">'+selectedItem+'</a></p>');
	 Prism.highlightElement(code);
	}
}

function toggleAnchor(){
	document.querySelector('.editAnchorEdit').click();
}

setTimeout(function(){
	if(document.querySelector('.saveAnchor')){
		document.querySelector('.saveAnchor').addEventListener('click', function(){
		let name = document.querySelector('#anchorName');
		createAnchor(name.value);
		name.value = '';
		$('#anchorEditContainer').modal('hide');
	});
	}
	
});
/*end anchor*/

/*start link*/
function createLink(display, id, name, href, lang, dir, download, title, charset, type, classes, rel, style){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
		id = (id!=='' ? ' id="'+id+'"' : '');
		name = (name!=='' ? ' name="'+name+'"' : '');
		href = (href!=='' ? ' '+ href : '');
		lang = (lang!=='' ? ' lang="'+lang+'"' : '');
		dir = (dir!=='' ? ' dir="'+dir+'"' : '');
		download = (download ? ' download' : '');
		title = (title!=='' ? ' title="'+title+'"' : '');
		charset = (charset!=='' ? ' charset="'+charset+'"' : '');
		type = (type!=='' ? ' type="'+type+'"' : '');
		classes = (classes!=='' ? ' class="'+classes+'"' : '');
		rel = (rel!=='' ? ' rel="'+rel+'"' : '');
		style = (style!==''&&typeof(style)!=='undefined' ? ' style="'+style+'"' : '');
		
	code.innerText = replaceIt(targetItem, '<p><a'+id+name+href+lang+dir+download+title+charset+type+classes+rel+style+'>'+(display!=='' ? display : selectedItem)+'</a></p>');
	targetItem.value = replaceIt(targetItem, '<p><a'+id+name+href+lang+dir+download+title+charset+type+classes+rel+style+'>'+(display!=='' ? display : selectedItem)+'</a></p>');
	 Prism.highlightElement(code);
		}else if(selectedEditor==='bbcode'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
		href = (href!=='' ? ' '+ href.replace(/href=|"|target=/g,'') : '');
		let tag = (href.match('mailto:') ? 'email' : 'url');
		let str = '['+tag+'='+href.replace(' ','')+']'+(display!=='' ? display : selectedItem)+'[/'+tag+']';
	code.innerText = replaceIt(targetItem, str.replace(' ', ''));
	targetItem.value = replaceIt(targetItem, str.replace(/\[url\]\s|\s\[\/url\]/, ''));
	 Prism.highlightElement(code);
		}else if(selectedEditor==='markdown'){
				let code = targetItem.parentElement.querySelector('#highlighting-content');;
		href = (href!=='' ? ' '+ href.replace(/href=|"|target=/g,'') : '');
		let str = '['+(display!=='' ? display : selectedItem)+']('+href.replace(' ','')+')';
	code.innerText = replaceIt(targetItem, str.replace(' ', ''));
	targetItem.value = replaceIt(targetItem, str.replace(' ', ''));
	 Prism.highlightElement(code);
		}
	
	}
}

function toggleLink(){
	document.querySelector('.editLinkEdit').click();
}

setTimeout(function(){
	if(document.querySelector('.saveLink')){
		document.querySelector('.saveLink').addEventListener('click', function(){
		let display = document.querySelector('#displayName');
		let linktype = document.querySelector('#LinkType');
		let Protocol = document.querySelector('#Protocol');
		let url = document.querySelector('#url');
		let target = document.querySelector('#target');
		let anchor = document.querySelector('#anchor');
		let email = document.querySelector('#email');
		let sub = document.querySelector('#subject');
		let body = document.querySelector('#body');
		let phone = document.querySelector('#phone');
		
		let href = '';
		if(linktype.value==='url'){
			href = 'href="'+Protocol.value+url.value+'" target="'+target.value+'"';
		}else if(linktype.value==='anchor'){
			href = 'href="#'+anchor.value+'"';
		}else if(linktype.value==='email'){
			href = 'href="mailto:'+email.value+'?subject='+sub.value+'&amp;body='+body.value+'"';
		}else{
			href = 'href="tel:'+phone.value+'"';
		}
		let id = document.querySelector('#linkid');
		let name = document.querySelector('#linkname');
		let lang = document.querySelector('#LinkLang');
		let dir = document.querySelector('#LinkDir');
		let title = document.querySelector('#LinkTitle');
		let type = document.querySelector('#LinkType');
		let classes = document.querySelector('#LinkClasses');
		let charset = document.querySelector('#LinkCharset');
		let rel = document.querySelector('#LinkRel');
		let style = document.querySelector('#LinkStyle');
		let download = document.querySelector('#LinkDownload');

		createLink(display.value, id.value, name.value, href, lang.value, dir.value, download.checked, title.value, charset.value, type.value, classes.value, rel.value, style.value);
		name.value = '';
		href = '';
		display.value = '';
		linktype.value = 'url';
		id.value = '';
		Protocol.value = 'http://';
		url.value = '';
		target.value = '';
		anchor.value = '';
		email.value = '';
		sub.value = '';
		body.value = '';
		phone.value = '';
		lang.value = '';
		dir.value = '';
		title.value = '';
		type.value = '';
		classes.value = '';
		charset.value = '';
		rel.value = '';
		style.value = '';
		download.checked = false;
		$('#LinkEditContainer').modal('hide');
	});	
	}
});
/*end link*/

/*start table*/
function createTable(rows=3, cols=2, width=500, height, header, border=1, spacing, padding, align, caption, summary, id, dir, style, classes){
			if(selectedItem===''){
		warn();
	}else{
		let code = targetItem.parentElement.querySelector('#highlighting-content');;
			let table = '';
			width = width!=='' ? 'width:'+width+'px;' : '';
			height = height!=='' ? ' height:'+height+'px;' : '';
		const r=rows;
		table += '<table'+(id!=='' ? ' id="'+id+'"' : '')+(dir!=='' ? 'dir="'+dir+'"' : '')+(padding!=='' ? ' cellpadding="'+padding+'"' : '')+(spacing!=='' ? ' cellspacing="'+spacing+'"' : '')+(border!=='' ? ' border="'+border+'"' : '')+(align!=='' ? ' align="'+align+'"' : '')+' style="'+width+height+(style!=='' ? style : '')+'" class="table table-primary'+(classes!=='' ? ' '+classes : '')+(border!=='' ? ' table-bordered' : '')+'"'+(summary!=='' ? ' summary="'+summary+'"' : '')+'>';
		table += caption!=='' ? '<caption class="caption-top">'+caption+'</caption>' : '';
		table += '<tbody>';
		for(let i=0; i<cols;i++){
			if(header==='firstrow'){
				if(i===0){
				table+='<tr>';
			for(let j=0;j<cols;j++){
				table+='<td scope="col">&nbsp;</td>';
			}
			table+='</tr>';		
				}else{
						table+='<tr>';
			for(let j=0;j<cols;j++){
				table+='<td>&nbsp;</td>';
				}
				table+='</tr>';		
				}
			
			}else if(header==="firstcol"){
				table+='<tr>';
			for(let j=0;j<cols;j++){
				if(j===0){
				table+='<th scope="row">&nbsp;</th>';
				}else{
				table+='<td>&nbsp;</td>';	
				}
				
				}
				table+='</tr>';	
			}else if(header==="both"){
					if(i===0){
				table+='<tr>';
			for(let j=0;j<cols;j++){
				table+='<td scope="col">&nbsp;</td>';
			}
			table+='</tr>';		
				}else{
						table+='<tr>';
			for(let j=0;j<cols;j++){
					if(j===0){
				table+='<th scope="row">&nbsp;</th>';
				}else{
				table+='<td>&nbsp;</td>';	
				}
				}
				table+='</tr>';		
				}
				
			}else{
				table+='<tr>';
			for(let j=0;j<cols;j++){
				table+='<td>&nbsp;</td>';
			}
			table+='</tr>';			
			}
			
		}
			
		table += '</tbody>';
		table += '</table>';
		code.innerText = replaceIt(targetItem, table);
		targetItem.value = replaceIt(targetItem, table);
		Prism.highlightElement(code);
	}
	
}
function toggleTable(){
		document.querySelector('.editTableEdit').click();
}
setTimeout(function(){
	if(document.querySelector('.saveTable')){
		document.querySelector('.saveTable').addEventListener('click', function(){
		let rows = document.querySelector('#tableRows');
		let cols = document.querySelector('#tableCols');
		let height = document.querySelector('#tableHeight');
		let width = document.querySelector('#tableWidth');
		let header = document.querySelector('#tableHeader');
		let border = document.querySelector('#borderSpacing');
		let spacing = document.querySelector('#cellSpacing');
		let padding = document.querySelector('#cellPadding');
		let align = document.querySelector('#tableAlign');
		let caption = document.querySelector('#tableCaption');
		let summary = document.querySelector('#tableSummary');
		let id = document.querySelector('#tableID');
		let dir = document.querySelector('#tableDir');
		let style = document.querySelector('#tableStyle');
		let classes = document.querySelector('#tableClasses');
		
		createTable(rows.value, cols.value, width.value, height.value, header.value, border.value ,spacing.value, padding.value, align.value, caption.value, summary.value, id.value, dir.value, style.value, classes.value);
		rows.value = '3';
		cols.value = '2';
		height.value = '';
		width.value = '500';
		header.value = '';
		border.value = '1';
		spacing.value = '1';
		padding.value = '1';
		align.value = '';
		caption.value = '';
		summary.value = '';
		id.value = '';
		dir.value = '';
		style.value = '';
		classes.value = '';
		
		$('#TableEditContainer').modal('hide');
	});	
	}
});
/*end table*/

function slctAll(elem){
		elem.parentElement.parentElement.parentElement.parentElement.querySelector('#editing').select();
}
function createImg(){
	if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
		code.innerText = replaceIt(targetItem, '<img src="'+selectedItem+'" width="320" height="320" alt="myimage"/>');
		targetItem.value = replaceIt(targetItem, '<img src="'+selectedItem+'" width="320" height="320" alt="myimage"/>');
		Prism.highlightElement(code);
		}
		if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
		code.innerText = replaceIt(targetItem, '[img width="320" height="320"]'+selectedItem+'[/img]');
		targetItem.value = replaceIt(targetItem, '[img width="320" height="320"]'+selectedItem+'[/img]');
		Prism.highlightElement(code);
		}
		if(selectedEditor==='markdown'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
		code.innerText = replaceIt(targetItem, '![alt]('+selectedItem+')');
		targetItem.value = replaceIt(targetItem, '![alt]('+selectedItem+')');
		Prism.highlightElement(code);
		}
	}
	
}
function createVids(){
		if(selectedItem===''){
		warn();
	}else{
		if(selectedEditor==='wysiwyg'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
		code.innerText = replaceIt(targetItem, '<video controls width="320" height="320"><source src="'+selectedItem+'" type="video/mp4"/>   Your browser does not support the video tag.</video>');
		targetItem.value = replaceIt(targetItem, '<video controls width="320" height="320"><source src="'+selectedItem+'" type="video/mp4"/>   Your browser does not support the video tag.</video>');
		Prism.highlightElement(code);
		}
		if(selectedEditor==='bbcode'){
			let code = targetItem.parentElement.querySelector('#highlighting-content');;
		code.innerText = replaceIt(targetItem, '[video width="320" height="320"]'+selectedItem+'[/video]');
		targetItem.value = replaceIt(targetItem, '[video width="320" height="320"]'+selectedItem+'[/video]');
		Prism.highlightElement(code);
		}
	}
}

/*Preview*/
function togglePreview(element, mode){
		 let result_element = document.querySelector("#highlighting-content");
		 let textbox = document.querySelector('#editing');
	if(mode==="preview"){
		result_element.innerText = textbox.value;
		element.setAttribute('toggle-mode', 'edit');
		Prism.highlightElement(result_element);
		textbox.style.zIndex = 1;
		result_element.style.zIndex = 0;
		textbox.disabled = false;
		document.querySelector('.lineCount').hidden=false;
	}else{
		result_element.innerHTML = textbox.value.replace(new RegExp("&", "g"), "&").replace(new RegExp("<", "g"), "<").replace(new RegExp('<\\?','g'), '&lt;?').replace(new RegExp('\\?>','g'), '?&gt;'); /* Global RegExp */
		element.setAttribute('toggle-mode', 'preview');
		textbox.style.zIndex = 0;
		if(document.querySelector('.editor pre.viewCode')){
			let childCode = document.querySelectorAll('.editor pre.viewCode code');
			for(let i=0; i<childCode.length;i++){
				childCode[i].innerHTML = childCode[i].innerHTML.replace(new RegExp('<', 'g'), '&lt;').replace(new RegExp('>', 'g'), '&gt;');
			}
			let hightlightAll = document.querySelectorAll('.editor pre.viewCode');
			for(let i=0; i<hightlightAll.length;i++){
				Prism.highlightAllUnder(hightlightAll[i]);
			}
			
		}
		result_element.style.zIndex = 1;
		textbox.disabled = true;
		document.querySelector('.lineCount').hidden=true;
	}
} 

function VoiceControl(elem){
	var toggleVoice = true;
	window.SpeechRecognition = window.webkitSpeechRecognition;
	const recognition = new SpeechRecognition();
	recognition.interimResults = true;
	let placement = elem.parentElement.parentElement.parentElement.parentElement;
	recognition.addEventListener('result', e=>{
		const transcript = Array.from(e.results)
		.map(result => result[0])
		.map(result => result.transcript);
		placement.querySelector('#editing').value = transcript;
		placement.querySelector('#highlighting-content').innerHTML = placement.querySelector('#editing').value;
	});
	recognition.start();
}