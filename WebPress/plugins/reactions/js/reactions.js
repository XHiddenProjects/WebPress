$(document).ready(function(){
	$('#reactionName').on('input',function(){
		$('#reactionIcon').val(($('#reactionName').val()!=='' ? $('#reactionName').val().replaceAll(' ','-')+'.png' : ''));
	});
});