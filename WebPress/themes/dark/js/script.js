setInterval(function(){
	setTimeout(function(){
		let name = $('#webpress-name').val();
		let user = $('#webpress-user').val();
		let email = $('#webpress-email').val();
		let psw = $('#webpress-psw').val();
	let rpsw = $('#webpress-rpsw').val();
	let terms = $('#webpress-termsandservice');
		/*check password*/
	if(psw!==""&&rpsw!==""&&name!==""&&user!==''&&email!==""&&terms.is(":checked")){
		if(rpsw===psw){
			$('#webpress-submit').removeAttr('disabled');
		}else{
			$('#webpress-submit').attr('disabled', "true");
		}
	}else{
		console.log(psw+','+rpsw+','+name+','+user+','+email+','+terms);
		$('#webpress-submit').attr('disabled', "true");
	}
	}, 100);
	
}, 50);

setTimeout(function(){
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
}, 300);
setTimeout(function(){
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
}, 300);

setTimeout(function(){
	let tables = document.querySelectorAll('table');
	for(let i=0;i<tables.length;i++){
		if(tables[i].getAttribute('table-style')&&tables[i].getAttribute('table-style')!==''){
			tables[i].className = "table table-bordered border-light table-responsive table-striped table-"+tables[i].getAttribute('table-style')+" table-hover";
		}else{
			tables[i].className = "table table-bordered border-light table-responsive table-striped table-primary table-hover";
		}
		
	}
}, 300);
if(document.querySelector('#webnpsw')){
document.querySelector('#webnpsw').addEventListener('keyup', function(){
	let psw = document.querySelector('#webpsw');
	if(psw.value===""){
		psw.classList.add('is-invalid');
		psw.classList.remove('is-valid');
	}else{
		psw.classList.remove('is-invalid');
		psw.classList.add('is-valid');
	}
});	
}
function copyURLConsole(n){
	let url = '';
	if(window.location.hash){
		 url = window.location.href.replace(window.location.hash, '#log-'+n);
	}else{
		 url = window.location.href+'#log-'+n;
	}
	if(navigator.clipboard.writeText(url)){
		console.log('Copied');
	}else{
		console.error('Can\'t copy to clipboard');
	}
}
function copyMsgConsole(n){
	let msg = document.querySelector('#log-'+n);
	if(navigator.clipboard.writeText(msg.querySelector('.msg').innerText)){
		console.log('Copied');
	}else{
		console.error('Can\'t copy to clipboard');
	}
}

function removeConsoleViewer(){
	let logs = document.querySelectorAll('[log]');
	for(let i=0; i<logs.length;i++){
		if(logs[i].getAttribute('log')!==window.location.hash.replace('#log-','')){
			logs[i].classList.remove('border');
			logs[i].classList.remove('border-5');
			logs[i].classList.remove('border-primary');
		}
	}
}
function addConsoleViewer(target){
	setTimeout(removeConsoleViewer, 100);
	target.classList.add('border');
	target.classList.add('border-5');
	target.classList.add('border-primary');
	setTimeout(function(){
		target.scrollIntoView({
					behavior: 'smooth',
					inline: 'center',
					block: 'center'
				});	
	}, 10);
	
	

}


	let logCapture = document.querySelectorAll('[id="logCapture"]') ? document.querySelectorAll('[id="logCapture"]') : '';
for (let i = 0; i < logCapture.length; i++) {
	logCapture[i].addEventListener('click', function() {
			if (document.querySelector('#log-'+this.parentElement.parentElement.getAttribute('log'))) {
				setTimeout(addConsoleViewer(document.querySelector('#log-'+this.parentElement.parentElement.getAttribute('log'))), 100);

			}else{
				console.error('can\'t find '+'#log-'+this.parentElement.parentElement.getAttribute('log'));
			}
	});
}

setTimeout(function(){
	if(window.location.hash!==''&&window.location.hash){
		if (document.querySelector(window.location.hash)) {
				let target = document.querySelector(window.location.hash);
				target.classList.add('border');
				target.classList.add('border-5');
				target.classList.add('border-primary');
				target.scrollIntoView({
					behavior: 'smooth',
					inline: 'center',
					block: 'center'
				});
			}
	}
}, 100);

function copyPublicKey(){
	  var key = document.querySelector("#user-api");
	key.select();
	key.setSelectionRange(0, 99999);
	navigator.clipboard.writeText(key.value);
}
function copyPrivateKey(){
	  var key = document.querySelector("#user-private-api");
	key.select();
	key.setSelectionRange(0, 99999);
	navigator.clipboard.writeText(key.value);
}
function copyHardwareID(){
	  var id = document.querySelector("#user-hardwareid");
	id.select();
	id.setSelectionRange(0, 99999);
	navigator.clipboard.writeText(id.value);
}

setTimeout(function(){
const notifyAlert = document.querySelectorAll('.notify-alert');
for(let i=0;i<notifyAlert.length;i++){
	let tagName = notifyAlert[i].parentElement;
	notifyAlert[i].addEventListener('closed.bs.alert', event=>{
		tagName.remove();
	});
}	
}, 300);


function syntaxHighlight(text) {
  let result_element = document.querySelector("#highlighting-content");
	    // Update code
  result_element.innerText = text;
  // Syntax Highlight
  Prism.highlightElement(result_element);

}
function linenumber(element){
	let texts = element.value;
	let content = document.querySelector(".line-numbers-rows");
	
	let splitNav = texts.split('\n');
	for(let i=1; i<splitNav.length;i++){
		let span = document.createElement('span');
		content.appendChild(span);
	}
}
function sync_scroll(element) {
  /* Scroll result to scroll coords of event - sync with textarea */
  let result_element = document.querySelector("#highlighting");
  // Get and set x and y
	  result_element.scrollTop = element.scrollTop;
	result_element.scrollLeft = element.scrollLeft; 
}

function check_tab(element, event) {
  let code = element.value;
  if(event.key == "Tab") {
    /* Tab key pressed */
    event.preventDefault(); // stop normal
    let before_tab = code.slice(0, element.selectionStart); // text before tab
    let after_tab = code.slice(element.selectionEnd, element.value.length); // text after tab
    let cursor_pos = element.selectionEnd + 1; // where cursor moves after tab - moving forward by 1 char to after tab
    element.value = before_tab + "\t" + after_tab; // add tab char
    // move cursor
    element.selectionStart = cursor_pos;
    element.selectionEnd = cursor_pos;
    syntaxHighlight(element.value); // Update text to include indent
  }
}

setTimeout(function(){
	if(document.querySelector('#LinkType')){
			document.querySelector('#LinkType').addEventListener('change', function(){
		let targetLink = document.querySelectorAll('[target-link]');
		for(let i=0; i<targetLink.length;i++){
			if(targetLink[i].getAttribute('target-link')===this.value){
				targetLink[i].hidden = false;
			}else{
				targetLink[i].hidden = true;
			}
		}
	});
	}

}, 100);


setTimeout(function(){
	if(document.querySelector('[toggle-mode]')){
			document.querySelector('[toggle-mode]').addEventListener('click', function(){
		if(this.getAttribute('toggle-mode')==='edit'){
			// Nothing
		}else{
			let d = document.querySelectorAll('[dir]');
			for(let i=0; i<d.length;i++){
				d[i].classList.add('d-flex')
				if(d[i].dir==='ltr'){
					d[i].classList.remove('flex-row-reverse');
					d[i].classList.add('flex-row');
					d[i].removeAttribute('dir');
				}else{
					d[i].classList.remove('flex-row');
					d[i].classList.add('flex-row-reverse');
					d[i].removeAttribute('dir');
				}
			}
		}
	});
	}

});

// Icons
function openIconList(elem){
	let list = elem.parentElement.parentElement.querySelector('.iconList');
	if(list.style.height==='0px'){
		list.style.height = '320px';
	}else{
		list.style.height = '0px';
	}
}
function selectIcon(elem, icon){
	let displayIcon = elem.parentElement.parentElement.parentElement.querySelector('input[type="text"]');
	displayIcon.value = icon;
	elem.parentElement.parentElement.parentElement.querySelector('.iconList').style.height = '0px';
}

function copyReplyID(id){
	if(navigator.clipboard.writeText(id))
			console.log('Copied');
}
function returnSearch(event){
	let unicode = event.keyCode||event.which;
	if(unicode===13||unicode==='13'){
		document.querySelector('.submitsearch').click();
	}
}