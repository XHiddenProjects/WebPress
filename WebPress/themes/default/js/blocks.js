window.addEventListener('load', function(){
	if(!window.location.href.match(/\?editpage/)){
		if(document.querySelector('#dropbox')){
		document.querySelector('#dropbox').removeAttribute('contenteditable');
		let allElem = document.querySelectorAll('#dropbox *');
		for(let i=0;i<allElem.length;i++){
			allElem[i].removeAttribute('contenteditable');
		}
	}
	}
});

/*Target Areas*/
var targetArea;
var selectedTxt;
function stylizeHighlightedString() {

    var text = window.getSelection();

    // For diagnostics
    var start = text.anchorOffset;
    var end = text.focusOffset - text.anchorOffset;
    range = window.getSelection().getRangeAt(0);
	
	selectedTxt = range;
}
// Clicks selected text
window.addEventListener('dblclick', stylizeHighlightedString);
if(document.querySelector('#dropbox.editView'))
	document.querySelector('#dropbox.editView').addEventListener('mouseup', stylizeHighlightedString);

/*actions*/
function allowDropItem(ev) {
  ev.preventDefault();
}

function dragItem(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function dropItem(ev) {
  ev.preventDefault();
  let data = ev.dataTransfer.getData("text");
  let h;
  switch(data){
	
	  case 'h1':
		 h = document.createElement(data);
		h.innerHTML = 'Heading 1';
	   ev.target.appendChild(h);
		break;
	   case 'h2':
	   h = document.createElement(data);
		h.innerHTML = 'Heading 2';
	   ev.target.appendChild(h);
	  break;
	   case 'h3':
	   h = document.createElement(data);
		h.innerHTML = 'Heading 3';
	   ev.target.appendChild(h);
	  break;
	   case 'h4':
	   h = document.createElement(data);
		h.innerHTML = 'Heading 4';
	   ev.target.appendChild(h);
	  break;
	   case 'h5':
	   h = document.createElement(data);
		h.innerHTML = 'Heading 5';
	   ev.target.appendChild(h);
	  break; 
	  case 'h6':
	   h = document.createElement(data);
		h.innerHTML = 'Heading 6';
	   ev.target.appendChild(h);
	  break;
	   case 'p':
	   h = document.createElement(data);
		h.innerHTML = 'paragraph';
		h.style.textIndent = '0.5in';
	   ev.target.appendChild(h);
	  break;
	  case 'a':
	   h = document.createElement(data);
		h.innerHTML = 'Link';
	   ev.target.appendChild(h);
	  break;
	  case 'table':
	   rows = prompt('Enter Rows');
	   cols = prompt('Enter Cols');
	   head = prompt('Include Heading; Yes/No');
	  if(rows===null||!parseInt((rows))){
		  rows=2;
	  }else{
		  rows = parseInt(rows);
	  }
	  if(cols===null||!parseInt((cols))){
		  cols=2;
	  }else{
		  cols = parseInt(cols);
	  }
	  h = document.createElement('table');
	  for(let r=0;r<rows;r++){
		  let addRow = document.createElement('tr');
		  for(let c=0;c<cols;c++){
			  if(head.toLowerCase()==='yes'){
				  if(r==0){
					   let addCols = document.createElement('th');  
						addCols.innerHTML = '&nbsp;';
						addRow.appendChild(addCols); 
				  }else{
					 let addCols = document.createElement('td');  
						addCols.innerHTML = '&nbsp;';
						addRow.appendChild(addCols);   
				  }
			  }else if(head.toLowerCase()==='no'){
				  let addCols = document.createElement('td');  
						addCols.innerHTML = '&nbsp;';
						addRow.appendChild(addCols); 
			  }
			
		  }
		  h.appendChild(addRow);
	  }
	   ev.target.appendChild(h);
	  break;
	  case 'row':
	  h = document.createElement('div');
	  h.className = 'row';
	  h.innerHTML = '&nbsp;';
	  ev.target.appendChild(h);
	  break;
	  case 'cols':
	  h = document.createElement('div');
	  h.className = 'col';
	  h.innerHTML = '&nbsp;';
	  ev.target.appendChild(h);
	  break;
	  case 'div':
	   h = document.createElement('div');
	   h.innerHTML = '&nbsp;';
	   ev.target.appendChild(h);
	  break;
	   case 'br':
	   h = document.createElement('br');
	   ev.target.appendChild(h);
	  break;
	  case 'hr':
	   h = document.createElement('hr');
	   ev.target.appendChild(h);
	  break;
	   case 'form':
	   h = document.createElement('form');
	   h.enctype="multipart/form-data";
	   h.method='post';
	   h.action='';
	   h.innerHTML='&nbsp;';
	   ev.target.appendChild(h);
	  break;
	   case 'label':
	   h = document.createElement('label');
	   h.innerHTML = '...';
	   h.className = 'form-label';
	   ev.target.appendChild(h);
	  break;
	  case 'text':
	   h = document.createElement('input');
	   h.type='text';
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	  case 'number':
	   h = document.createElement('input');
	   h.type='number';
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	   case 'phone':
	   h = document.createElement('input');
	   h.type='tel';
	   h.pattern='[0-9]{3}-[0-9]{2}-[0-9]{3}';
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	   case 'email':
	   h = document.createElement('input');
	   h.type='email';
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	   case 'group':
	   h = document.createElement('div');
	   h.innerHTML = '&nbsp;';
	   h.className = 'input-group';
	   ev.target.appendChild(h);
	  break;
	  case 'group-text':
	   h = document.createElement('span');
	   h.innerHTML = '&nbsp;';
	   h.className = 'input-group-text';
	   ev.target.appendChild(h);
	  break;
	   case 'float-text':
	   h = document.createElement('div');
	   h.className = 'form-floating';
	    p = prompt('Enter Label');
	   inp = document.createElement('input');
	   inp.className = 'form-control';
	   inp.type='text';
	   inp.placeholder = p;
	   lab = document.createElement('label');
	   lab.innerHTML = p;
	   h.appendChild(inp);
	   h.appendChild(lab);
	   ev.target.appendChild(h);
	  break;
	  case 'button':
	   h = document.createElement('button');
	   h.innerHTML = 'Button';
	   h.type="button";
	   h.className = 'btn btn-primary';
	   ev.target.appendChild(h);
	  break;
	  case 'submit':
	   h = document.createElement('button');
	   h.innerHTML = 'Submit';
	   h.type="submit";
	   h.className = 'btn btn-secondary';
	   ev.target.appendChild(h);
	  break;
	  case 'clear':
	   h = document.createElement('button');
	   h.innerHTML = 'Clear';
	   h.type="reset";
	   h.className = 'btn btn-secondary';
	   ev.target.appendChild(h);
	  break;
	  case 'radio':
	   h = document.createElement('div');
	   h.className="form-check";
	   inp = document.createElement('input');
	   inp.type = 'radio';
	   inp.className = 'form-check-input';
	   lab = document.createElement('label');
	   lab.innerHTML = '...';
	   lab.className = 'form-check-label';
	   h.appendChild(inp);
	   h.appendChild(lab);
	   ev.target.appendChild(h);
	  break;
	  case 'checkbox':
	   h = document.createElement('div');
	   h.className="form-check";
	   inp = document.createElement('input');
	   inp.type = 'checkbox';
	   inp.className = 'form-check-input';
	   lab = document.createElement('label');
	   lab.innerHTML = '...';
	   lab.className = 'form-check-label';
	   h.appendChild(inp);
	   h.appendChild(lab);
	   ev.target.appendChild(h);
	  break;
	   case 'password':
	   h = document.createElement('input');
	   h.type="password";
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	  case 'datetime':
	   h = document.createElement('input');
	   h.type="datetime-local";
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	   case 'url':
	   h = document.createElement('input');
	   h.type="url";
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	   case 'range':
	   h = document.createElement('input');
	   h.type="range";
	   h.className = 'form-range';
	   ev.target.appendChild(h);
	  break;
	   case 'hidden':
	   h = document.createElement('input');
	   h.type="hidden";
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	  case 'search':
	   h = document.createElement('input');
	   h.type="search";
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	  case 'upload':
	   h = document.createElement('input');
	   h.type="file";
	   h.className = 'form-control';
	   ev.target.appendChild(h);
	  break;
	  case 'img':
	  h = document.createElement('img');
	  h.className = 'img img-fluid';
	  let url = prompt('Enter Image URL:');
	  let width = prompt('Enter Width:');
	  let hight = prompt('Enter Height:');
	  let alt = prompt('Alt Name:')
	  if(url){
		  h.src = url;
		  h.alt = alt;
		  h.width = parseInt(width);
		  h.height = parseInt(hight);
	  }
	  ev.target.appendChild(h);
	  break;
  }

}

window.addEventListener('load', function(){
	let toper = 1;
	
	let elem = document.querySelectorAll('.editView *');
	for(let i=0;i<elem.length;i++){
		elem[i].contentEditable = true;
	
	}
});

$('.editView').click(function(event){
	document.querySelector('.tagname').innerHTML =  event.target.tagName;
	document.querySelector('.tagid').innerHTML =  event.target.id;
	document.querySelector('.tagname').innerHTML =  event.target.name;
	document.querySelector('.tagtype').innerHTML =  event.target.type;
	document.querySelector('.tagclass').innerHTML =  event.target.classList;
	document.querySelector('.tagstyle').innerHTML =  event.target.getAttribute('style');
});

$(document).ready(function(){
		$('.editView').contextmenu(function(event){
			if(event.target.id!=='dropbox'){
				const id = event.target.id!=='' ? '#'+event.target.id : '';
				const classes = event.target.className!=='' ? '.'+event.target.classList : '';
				$('.contextTarget').html(event.target.tagName+id+classes);
				targetArea = event.target;
			}else{
				$('.contextTarget').html('');
			}
	
	});
});



function expander(e){
	if(e.getAttribute('data-state')=='expand'){
		e.innerHTML = '+';
		e.setAttribute('data-state', 'minify');
		e.parentElement.style.height = '30px';
	}else{
		e.innerHTML = '-';
		e.setAttribute('data-state', 'expand');
		e.parentElement.style.height = '40%';
	}
}
var contextMenu;
window.onclick = hideContextMenu;
window.onkeydown = listenKeyMenu;
window.addEventListener('load', function(){
	 contextMenu = document.querySelector('.context-menu');
});

function showContextMenu(){
	contextMenu.style.display = 'block';
	contextMenu.style.left = event.clientX + 'px';
	contextMenu.style.top = event.clientY + 'px';

	return false;
}
function hideContextMenu(){
	if(contextMenu)
		contextMenu.style.display = 'none';
}
function listenKeyMenu(event){
	const key = event.keyCode || event.which;
	if(key==27){
		hideContextMenu();
	}
}


function DeleteBlock(){
	if(targetArea!==''){
		targetArea.remove();
	}
}

/*move elements*/
window.onload = function () {
	var upLink = document.querySelectorAll(".up");

	for (var i = 0; i < upLink.length; i++) {
		upLink[i].addEventListener('click', function () {
			var wrapper = targetArea.parentElement;
		console.log(wrapper);
			if (wrapper.previousElementSibling)
			    wrapper.parentNode.insertBefore(wrapper, wrapper.previousElementSibling);
		});
	}

	var downLink = document.querySelectorAll(".down");

	for (var i = 0; i < downLink.length; i++) {
		downLink[i].addEventListener('click', function () {
			var wrapper = targetArea.parentElement;

			if (wrapper.nextElementSibling)
			    wrapper.parentNode.insertBefore(wrapper.nextElementSibling, wrapper);
		});
	}
}
/*blockID*/
function blockID(promptLang){
	promptLang = promptLang.replaceAll('&quote;','"');
	let id = prompt(promptLang);
	if(id==='cancel'){
		return false;
	}
	if(id!==''&&id!==null){
		targetArea.id = id;
		targetArea.name = id;
	}else{
		targetArea.removeAttribute('id');
	}
}
function blockClasses(promptLang){
	promptLang = promptLang.replaceAll('&quote;','"');
	let classes = prompt(promptLang);
	if(classes==='cancel'){
		return false;
	}
	if(classes!==''&&classes!==null){
		targetArea.className = classes;
	}else{
		targetArea.removeAttribute('class');
	}
}

function blockHref(promptLang, promptTarget){
	promptLang = promptLang.replaceAll('&quote;','"');
	let href = prompt(promptLang);
	let target = prompt(promptTarget);
		target = target!=='' ? target : 'blank';
	if(href==='cancel'){
		return false;
	}
	if(href!==''&&href!==null){
		if(targetArea.tagName!=='A'){
			let links = document.createElement('a');
			let data = targetArea.parentElement.innerHTML;
				targetArea.parentElement.innerHTML='<a href="'+href+'" target="'+target+'">'+data+'</a>';
		}else{
			targetArea.href = href;
			target.target = target;
		}
		
	}else{
		targetArea.removeAttribute('href');
		targetArea.removeAttribute('target');
	}
}
function removeBlockHref(){
	if(targetArea.tagName!=='A'){
		const html = targetArea.parentElement.innerHTML;
		targetArea.parentElement.parentElement.innerHTML = html;
		targetArea.parentElement.remove();
	}else{
		targetArea.removeAttribute('href');
		targetArea.removeAttribute('target');
	}
}
function blockBold(){
	   const selectionContents = selectedTxt.extractContents();
		const bold = document.createElement("strong");

    bold.appendChild(selectionContents);


    selectedTxt.insertNode(bold);
}
function blockItalic(){
	   const selectionContents = selectedTxt.extractContents();
		const italics = document.createElement("em");

    italics.appendChild(selectionContents);


    selectedTxt.insertNode(italics);
}
function blockStirke(){
	   const selectionContents = selectedTxt.extractContents();
		const strike = document.createElement("s");

    strike.appendChild(selectionContents);


    selectedTxt.insertNode(strike);
}
function blockUnderline(){
	   const selectionContents = selectedTxt.extractContents();
		const underline = document.createElement("u");

    underline.appendChild(selectionContents);


    selectedTxt.insertNode(underline);
}
function RemoveBlockFormat(){
	 const parEle = selectedTxt.commonAncestorContainer;
	const contextNode = document.createTextNode(parEle.parentElement.innerHTML);
	parEle.parentElement.parentElement.replaceChild(contextNode, parEle.parentElement);
}
/*reload Page*/
function reloadBlockPage(){
	let reloadConfirm = confirm('All changes will be removed, do you wish to continue?');
	if(reloadConfirm){
		window.location.reload();
	}else{
		return false;
	}
}

/*save blocks*/
function saveBlocks(root, page){
	let elem = document.querySelector('.editView');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
      }
    };
xmlhttp.open("GET", root+"/saveBlocks.lib.php?page="+page+"&code=" + elem.innerHTML.replaceAll('&nbsp;',' ').replaceAll('#','/ht/')+'&body='+document.body.getAttribute('style').replaceAll('"','_quoteicon_').replaceAll('&','__andicon_').replaceAll(' ',''), true);
    xmlhttp.send();
}
function blockSettings(){
	const settings = new bootstrap.Offcanvas('#settingsBar');
	settings.toggle();
}
function checkToggleBGColor(){
	let bg = document.querySelectorAll('[name="bgcolor"]');
	for(let i=0;i<bg.length;i++){
		if(bg[i].checked){
			bg[i].parentElement.querySelector('label').innerHTML = '<i class="fa-solid fa-check text-secondary"></i>';
		}else{
			bg[i].parentElement.querySelector('label').innerHTML = '';
		}
	}
}
function checkToggleColor(){
	let bg = document.querySelectorAll('[name="color"]');
	for(let i=0;i<bg.length;i++){
		if(bg[i].checked){
			bg[i].parentElement.querySelector('label').innerHTML = '<i class="fa-solid fa-check text-secondary"></i>';
		}else{
			bg[i].parentElement.querySelector('label').innerHTML = '';
		}
	}
}
function checkBG(){
		let bg = document.querySelectorAll('[name="bgcolor"]');
	let d = document.querySelectorAll('[name=bgBlock]');
	
	for(let i=0;i<bg.length;i++){
		if(bg[i].checked){
			bg[i].parentElement.querySelector('label').innerHTML = '<i class="fa-solid fa-check text-secondary"></i>';
			for(let j=0;j<d.length;j++){
				if(d[j].checked){
					const val = d[j].value;
					switch(val){
						case 'body':
							document.querySelector('body').style.backgroundColor = bg[i].value;
						break;
						case 'target':
						
							targetArea.style.backgroundColor = bg[i].value;
						break;
					}
				}
			}
			checkToggleBGColor();
		}else{
			bg[i].parentElement.querySelector('label').innerHTML = '';
			checkToggleBGColor();
		}
	}
}

function BlocktextAlign(alignment){
	let d = document.querySelectorAll('[name=bgBlock]');
		for(let j=0;j<d.length;j++){
				if(d[j].checked){
					const val = d[j].value;
					switch(val){
						case 'body':
							
						break;
						case 'target':
							targetArea.style.textAlign = alignment;
						break;
					}
				}
			}
}

function checkColor(){
		let bg = document.querySelectorAll('[name="color"]');
	let d = document.querySelectorAll('[name=bgBlock]');
	
	for(let i=0;i<bg.length;i++){
		if(bg[i].checked){
			bg[i].parentElement.querySelector('label').innerHTML = '<i class="fa-solid fa-check text-secondary"></i>';
			for(let j=0;j<d.length;j++){
				if(d[j].checked){
					const val = d[j].value;
					switch(val){
						case 'body':
							document.querySelector('body').style.color = bg[i].value;
						break;
						case 'target':
						
							targetArea.style.color = bg[i].value;
						break;
					}
				}
			}
			checkToggleColor();
		}else{
			bg[i].parentElement.querySelector('label').innerHTML = '';
			checkToggleColor();
		}
	}
}
$('[name="bgcolor"]').click(function(){
	let bg = document.querySelectorAll('[name="bgcolor"]');
	let d = document.querySelectorAll('[name=bgBlock]');
	
	for(let i=0;i<bg.length;i++){
		if(bg[i].checked){
			bg[i].parentElement.querySelector('label').innerHTML = '<i class="fa-solid fa-check text-secondary"></i>';
			for(let j=0;j<d.length;j++){
				if(d[j].checked){
					const val = d[j].value;
					switch(val){
						case 'body':
							document.querySelector('body').style.backgroundColor = bg[i].value;
						break;
						case 'target':
						
							targetArea.style.backgroundColor = bg[i].value;
						break;
					}
				}
			}
			checkToggleBGColor();
		}else{
			bg[i].parentElement.querySelector('label').innerHTML = '';
			checkToggleBGColor();
		}
	}
});
$('[name="color"]').click(function(){
	let bg = document.querySelectorAll('[name="color"]');
	let d = document.querySelectorAll('[name=bgBlock]');
	
	for(let i=0;i<bg.length;i++){
		if(bg[i].checked){
			bg[i].parentElement.querySelector('label').innerHTML = '<i class="fa-solid fa-check text-secondary"></i>';
			for(let j=0;j<d.length;j++){
				if(d[j].checked){
					const val = d[j].value;
					switch(val){
						case 'body':
							document.querySelector('body').style.color = bg[i].value;
						break;
						case 'target':
						
							targetArea.style.color = bg[i].value;
						break;
					}
				}
			}
			checkToggleColor();
		}else{
			bg[i].parentElement.querySelector('label').innerHTML = '';
			checkToggleColor();
		}
	}
});

$('[name=bgSetting]').click(function(){
	let bgs = document.querySelectorAll('[name=bgSetting]');
	for(let i=0;i<bgs.length;i++){
			if(bgs[i].checked){
				if(bgs[i].value==='solidColor'){
				document.querySelector('.solidColor').style.display = 'block';
				document.querySelector('.uploadImage').style.display = 'none';
				document.querySelector('.customColor').style.display = 'none';
			}else if(bgs[i].value==='uploadImage'){
				document.querySelector('.solidColor').style.display = 'none';
				document.querySelector('.uploadImage').style.display = 'block';
				document.querySelector('.customColor').style.display = 'none';
			}else if(bgs[i].value==='customColor'){
				document.querySelector('.solidColor').style.display = 'none';
				document.querySelector('.uploadImage').style.display = 'none';
				document.querySelector('.customColor').style.display = 'block';
			}
		}
		
	}
});
$('[name=colorSetting]').click(function(){
	let bgs = document.querySelectorAll('[name=colorSetting]');
	for(let i=0;i<bgs.length;i++){
			if(bgs[i].checked){
				if(bgs[i].value==='solidColor2'){
				document.querySelector('.solidColor2').style.display = 'block';
				document.querySelector('.customColor2').style.display = 'none';
			}else if(bgs[i].value==='customColor2'){
				document.querySelector('.solidColor2').style.display = 'none';
				document.querySelector('.customColor2').style.display = 'block';
			}
		}
		
	}
});
function rgb2hex(rgb){
	alert(rgb);
	rgb = rgb.split('(')[1].split(')')[0];
	rgb = rgb.split(',');
	let hex = rgb.map(function(x){
		x = parseInt(x).toString(16);
		return (x.length==1) ? "0"+x : x;
	});
	return '#'+hex.join('');
}
function add2ColorList(useColor=false){
	if(useColor){
		let color = document.querySelector('#customcolorinput2');
	let list = document.createElement('li');
		list.className = 'list-group-item';
	let input = document.createElement('input');
		input.type = 'radio';
		input.className = 'btn-check customColorBtn';
		input.value = color.value;
		input.name='color';
		input.id="color"+color.value.replace('#','');
		input.autocomplete = 'off';
		input.setAttribute('onclick','checkColor()');
	let label = document.createElement('label');
		label.className = 'btn btn-circle';
		label.style.backgroundColor=color.value;
		label.setAttribute('for','color'+color.value.replace('#',''));
	list.appendChild(input);
	list.appendChild(label);
	document.querySelector('.solidColor2 ul').appendChild(list);
	}else{
		let color = document.querySelector('#customcolorinput');
	let list = document.createElement('li');
		list.className = 'list-group-item';
	let input = document.createElement('input');
		input.type = 'radio';
		input.className = 'btn-check customColorBtn';
		input.value = color.value;
		input.name='bgcolor';
		input.id="bg"+color.value.replace('#','');
		input.autocomplete = 'off';
		input.setAttribute('onclick','checkBG()');
	let label = document.createElement('label');
		label.className = 'btn btn-circle';
		label.style.backgroundColor=color.value;
		label.setAttribute('for','bg'+color.value.replace('#',''));
	list.appendChild(input);
	list.appendChild(label);
	document.querySelector('.solidColor ul').appendChild(list);
	}
	
}
window.addEventListener('load',function(){
if(document.querySelector('#bgImgURL')){	
document.querySelector('#bgImgURL').addEventListener('input', function(){
	let d = document.querySelectorAll('[name=bgBlock]');
	for(let i=0;i<d.length;i++){
		if(d[i].checked){
			const val = d[i].value;
					switch(val){
						case 'body':
						document.querySelector('body').style.backgroundImage = "url('"+this.value+"')";
						break;
						case 'target':
						
							targetArea.style.backgroundImage = "url('"+this.value+"')";
						break;
					}
		}
	
	}
	
});	
}
});

function hex2rgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}
$(document).ready(function(){
	setTimeout(function(){
		var bodyColor = document.body;

	if(!bodyColor.style.backgroundColor||bodyColor.style.backgroundColor===''){
		bodyColor = 'rgb(255,255,255)';
	}else{
		let colorHex = bodyColor.getAttribute('style').match(/#[\w\d]{3,6}/g);
			let bg = "rgb("+hex2rgb(colorHex[0]).r+","+hex2rgb(colorHex[0]).g+","+hex2rgb(colorHex[0]).b+")";
			if(colorHex[1]){
				let color = "rgb("+hex2rgb(colorHex[1]).r+","+hex2rgb(colorHex[1]).g+","+hex2rgb(colorHex[1]).b+")";
				bodyColor.setAttribute('style', bodyColor.getAttribute('style').replace(/background-color:#[\w\d]{3,6}/,'background-color:'+bg).replace(/color:#[\w\d]{3,6}/,'color:'+color));
			}else{
				bodyColor.setAttribute('style', bodyColor.getAttribute('style').replace(/background-color:#[\w\d]{3,6}/,'background-color:'+bg));
			}
			
			
	}
	}, 100);
	
});
function removeBGImg(){
	document.body.style.backgroundImage = '';
	}

function makePadding(side, len, size="px"){
	let d = document.querySelectorAll('[name=bgBlock]');
	let s = side.toLowerCase();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
						switch(s){
							case 'top':
								targetArea.style.paddingTop = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
							case 'right':
								targetArea.style.paddingRight = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
							case 'bottom':
								targetArea.style.paddingBottom = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
							case 'left':
								targetArea.style.paddingLeft = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
						}
							
						break;
					}
				}
			}
	
}

function makeMargin(side, len, size="px"){
	let d = document.querySelectorAll('[name=bgBlock]');
	let s = side.toLowerCase();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
						switch(s){
							case 'top':
								targetArea.style.marginTop = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
							case 'right':
								targetArea.style.marginRight = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
							case 'bottom':
								targetArea.style.marginBottom = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
							case 'left':
								targetArea.style.marginLeft = (len.value<1 ? 0 : len.value+len.parentElement.querySelector('select').value);
							break;
						}
							
						break;
					}
				}
			}	
}
function makeDisplay(selected){
		let d = document.querySelectorAll('[name=bgBlock]');
	let s = selected.toLowerCase();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.display = s;
						break;
					}
	}
}
}
function makeFlex(flexInt){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.flex = flexInt+'%';
						break;
					}
	}
	}
}
function makeFlexWrap(wrapper){
	w = wrapper.toLowerCase();
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.flexWrap = w;
						break;
					}
	}
	}
}
function makeFlexDir(dir){
	dr = dir.toLowerCase();
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.flexDirection = dr;
						break;
					}
	}
	}
}

function makeFlexGroth(val){
		let d = document.querySelectorAll('[name=bgBlock]');
		v = val.toString();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.flexGrow = v;
						break;
					}
	}
	}
}
function makeFlexShrink(val){
		let d = document.querySelectorAll('[name=bgBlock]');
		let v = val.toString();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.flexShrink = v;
						break;
					}
	}
	}
}
function makeFlexBasis(con){
	let bi = con.value.toString()+con.parentElement.querySelector('select').value;
	let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.flexBasis = bi;
						break;
					}
	}
	}
	
}

function makeFontSize(num, size){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
							targetArea.style.fontSize = num+size.parentElement.querySelector('select').value;
						break;
					}
	}
	}
}
function makeBorder(pos, elm){
	let d = document.querySelectorAll('[name=bgBlock]');
	pos = pos.toLowerCase();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
						case 'target':
						switch(pos){
							case 'top':
							 tc = elm.parentElement.querySelector('input[type="color"]').value;
							 ts = elm.value + elm.parentElement.querySelector('select.bsize').value;
							 tss = elm.parentElement.querySelector('select.bstyle').value;
							targetArea.style.borderTop = ts+' '+tss+' '+tc;
							break;
								case 'right':
							  rc = elm.parentElement.querySelector('input[type="color"]').value;
							  rs = elm.value + elm.parentElement.querySelector('select.bsize').value;
							  rss = elm.parentElement.querySelector('select.bstyle').value;
							targetArea.style.borderRight = rs+' '+rss+' '+rc;
							break;
								case 'bottom':
							  bc = elm.parentElement.querySelector('input[type="color"]').value;
							  bs = elm.value + elm.parentElement.querySelector('select.bsize').value;
							  bss = elm.parentElement.querySelector('select.bstyle').value;
							targetArea.style.borderBottom = bs+' '+bss+' '+bc;
							break;
								case 'left':
							  lc = elm.parentElement.querySelector('input[type="color"]').value;
							  ls = elm.value + elm.parentElement.querySelector('select.bsize').value;
							  lss = elm.parentElement.querySelector('select.bstyle').value;
							targetArea.style.borderLeft = ls+' '+lss+' '+lc;
							break;
						}
							
						break;
					}
	}
	}
}
function makeBorderRadius(pos, rad){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					const val = d[j].value;
					switch(val){
						case 'target':
						switch(pos){
							case 'bl':
								targetArea.style.borderBottomLeftRadius = rad.value + rad.parentElement.querySelector('select').value;
							break;
							case 'br':
								targetArea.style.borderBottomRightRadius = rad.value + rad.parentElement.querySelector('select').value;
							break;
							case 'tl':
								targetArea.style.borderTopLeftRadius = rad.value + rad.parentElement.querySelector('select').value;
							break;
							case 'tr':
								targetArea.style.borderTopRightRadius = rad.value + rad.parentElement.querySelector('select').value;
							break;
						}
						
						break;
					}
				}
	}
}
function makeShadowBox(elem){
			let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					 no = elem.parentElement.querySelector('.none');
					if(!no.checked){
					 h = elem.parentElement.querySelector('.hshadow').value+elem.parentElement.querySelector('.hshadow').parentElement.querySelector('select').value;
					 v = elem.parentElement.querySelector('.vshadow').value+elem.parentElement.querySelector('.vshadow').parentElement.querySelector('select').value;
					 b = elem.parentElement.querySelector('.blur').value+elem.parentElement.querySelector('.blur').parentElement.querySelector('select').value;
					 s = elem.parentElement.querySelector('.spread').value+elem.parentElement.querySelector('.spread').parentElement.querySelector('select').value;
					 c = elem.parentElement.querySelector('.color').value;
					 i = (elem.parentElement.querySelector('.sinset').checked ? 'inset' : '');
			
					targetArea.style.boxShadow = h+' '+v+' '+b+' '+s+' '+c+(i!=='' ? ' ' + i : ''); 
					}else{
						targetArea.style.boxShadow = 'none';
					}
					break;
				}
			}
	}
}
function makeShadowText(elem){
			let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					 no = elem.parentElement.querySelector('.none');
					if(!no.checked){
					 h = elem.parentElement.querySelector('.hshadow').value+elem.parentElement.querySelector('.hshadow').parentElement.querySelector('select').value;
					 v = elem.parentElement.querySelector('.vshadow').value+elem.parentElement.querySelector('.vshadow').parentElement.querySelector('select').value;
					 b = elem.parentElement.querySelector('.blur').value+elem.parentElement.querySelector('.blur').parentElement.querySelector('select').value;
					 c = elem.parentElement.querySelector('.color').value;
					console.log(h+' '+v+' '+b+' '+c);
						targetArea.style.textShadow = h+' '+v+' '+b+' '+c; 
					}else{
						targetArea.style.textShadow = 'none';
					}
					break;
				}
			}
	}
}
function makeAnimate(ani){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					 animate = ani.value;
					 timing = ani.parentElement.querySelector('.atime').value;
					 direction = ani.parentElement.querySelector('.adir').value;
					 fill = ani.parentElement.querySelector('.afill').value;
					 duration = ani.parentElement.querySelector('.adur').value + ani.parentElement.querySelector('.adur').parentElement.querySelector('select').value;
					 delay = ani.parentElement.querySelector('.adel').value + ani.parentElement.querySelector('.adel').parentElement.querySelector('select').value;
					 count = (ani.parentElement.querySelector('.acount').value<0 ? 'infinite' : ani.parentElement.querySelector('.acount'));
					
					targetArea.style.animation = animate + ' ' + duration + ' ' + timing + ' ' + delay + ' '  + count + ' ' + direction + ' ' + fill;
					
					break;
					}
				}
	}
}

function makeWidth(v){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
						 width = (v.value<0 ? 'auto' : v.value + v.parentElement.querySelector('select').value);
						targetArea.style.width = width;
					break;
					}
				}
	}
}
function makeHeight(v){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
						 height = (v.value<0 ? 'auto' : v.value + v.parentElement.querySelector('select').value);
						targetArea.style.height = height;
					break;
					}
				}
	}
}
function makePosV(pos){
			let d = document.querySelectorAll('[name=bgBlock]');
			pos = pos.toLowerCase();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.style.position = pos;
					break;
					}
				}
	}
}
function makePos(pos, v){
			let d = document.querySelectorAll('[name=bgBlock]');
			pos = pos.toLowerCase();
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
						switch(pos){
							case 'top':
								 tops = (v.value<0 ? 'auto' : v.value+v.parentElement.querySelector('select').value);
								targetArea.style.top = tops;
							break;
							case 'right':
								 right = (v.value<0 ? 'auto' : v.value+v.parentElement.querySelector('select').value);
								targetArea.style.right = right;
							break;
							case 'bottom':
								 bottom = (v.value<0 ? 'auto' : v.value+v.parentElement.querySelector('select').value);
								targetArea.style.bottom = bottom;
							break;
							case 'left':
								 left = (v.value<0 ? 'auto' : v.value+v.parentElement.querySelector('select').value);
								targetArea.style.left = left;
							break;
						}
					break;
					}
				}
	}
}
function makeTransform(v){
				let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					 set = (v.parentElement.querySelector('select').value==='none'? 'none' : v.parentElement.querySelector('select').value.toLowerCase()+'('+v.parentElement.querySelector('input').value+')');
					targetArea.style.transform = set;
					break;
					}
				}
	}
}
function makeTextTransform(v){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.style.textTransform = v;
					break;
					}
				}
	}
}

function makeTextDir(v){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.style.direction = v;
					break;
					}
				}
	}
}
function configForm(v){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.action = v.value;
					targetArea.method = v.parentElement.querySelector('select').value;
					break;
					}
				}
	}
}
function configRequire(checked){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.required = (checked ? true : false);
					break;
					}
				}
	}
}
function configReadOnly(checked){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.readOnly = (checked ? true : false);
					break;
					}
				}
	}
}
function configDisabled(checked){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.disabled = (checked ? true : false);
					break;
					}
				}
	}
}
function configPattern(v){
		let d = document.querySelectorAll('[name=bgBlock]');
	for(let j=0;j<d.length;j++){
				if(d[j].checked){
					 val = d[j].value;
					switch(val){
					case 'target':
					targetArea.pattern = v;
					break;
					}
				}
	}
}