function checkIfLineMade(el){
			txtlength = el.value;
		el.parentElement.querySelector('.lineCount').innerHTML = '';
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			if(i===txtlength.split(/\n/).length){
				//return false;
			}
		}
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			let elm = el.parentElement.querySelector('.lineCount');
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
function createLineNum(el,event){
	let key = event.keyCode||event.which;
	if(key===13||key==='13'||key===8||key==='8'){
		let txtlength = el.value+'\n';
		el.parentElement.querySelector('.lineCount').innerHTML = '';
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			if(i===txtlength.split(/\n/).length){
				//return false;
			}
		}
		for(let i=0;i<txtlength.split(/\n/).length;i++){
			let elm = el.parentElement.querySelector('.lineCount');
			let createNum = document.createElement('span');
			if(elm.getAttribute('data-line')&&elm.getAttribute('data-line')!==''){
				if(i===Number(elm.getAttribute('data-line')-1)){
					createNum.className = 'active';
				}
			}
		elm.appendChild(createNum);
		}
		setTimeout(checkIfLineMade(el), 100);
	}
}
