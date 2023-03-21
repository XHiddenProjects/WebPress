function checkIfLineMade(){
	if(document.querySelector('#editing')){
		let txtlength = document.querySelector('#editing').value;
		document.querySelector('.lineCount').innerHTML = '';
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			if(i===txtlength.split(/\n/).length){
				//return false;
			}
		}
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			let elm = document.querySelector('.editor .lineCount');
			let createNum = document.createElement('span');
			if(elm.getAttribute('data-line')&&elm.getAttribute('data-line')!==''){
				if(i===Number(elm.getAttribute('data-line')-1)){
					createNum.className = 'active';
				}
			}
		elm.appendChild(createNum);
		let breaks = document.createElement('br');
		elm.appendChild(breaks);
		}
	}
		
}
function createLineNum(event){
	let key = event.keyCode||event.which;
	if(key===13||key==='13'||key===8||key==='8'){
		let txtlength = document.querySelector('#editing').value;
		document.querySelector('.lineCount').innerHTML = '';
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			if(i===txtlength.split(/\n/).length){
				//return false;
			}
		}
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			let elm = document.querySelector('.editor .lineCount');
			let createNum = document.createElement('span');
			if(elm.getAttribute('data-line')&&elm.getAttribute('data-line')!==''){
				if(i===Number(elm.getAttribute('data-line')-1)){
					createNum.className = 'active';
				}
			}
		elm.appendChild(createNum);
		}
		setTimeout(checkIfLineMade, 100);
	}
}
window.addEventListener('load', checkIfLineMade());