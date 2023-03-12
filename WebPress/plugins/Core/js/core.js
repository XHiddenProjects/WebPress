window.addEventListener('load', function(){
	console.info('%cSuccessfully loaded WebPress[Core]', 'background-color:green;color:lime;');	
	let txt = document.querySelector('.replyItem:not(.replyItem .signatureBox)');
	let arr = txt.innerHTML.match(/@[a-z0-9]+/gi);
	for(let i=0;i<arr.length;i++){
		if(coreUsers.listUsers.includes(arr[i].replace('@',''))){
			txt.innerHTML = txt.innerHTML.replace(arr[i], '<a href="'+window.location.pathname.replace(/\/forum[\w\W]+/, '')+'/dashboard.php/profile?name='+arr[i].replace('@','')+'">'+arr[i]+'</a>');
		}
		
	}
});