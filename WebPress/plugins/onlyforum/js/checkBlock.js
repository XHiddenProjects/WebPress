window.addEventListener('load', function(){
	let data = document.querySelectorAll('#topicCategory option');
	for(let i=0;i<data.length;i++){
		if(onlyforum.indexOf(data[i].value)>=0){
			data[i].remove();
		}
	}
});
	

