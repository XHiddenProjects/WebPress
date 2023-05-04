$(document).ready(function(){
	const btn = $('#addtopicbtn');
	btn.attr('data-bs-target', '');
	btn.attr('class', btn.attr('class').replace('btn-success', 'btn-danger'));
	btn.children('i').attr('class', 'fa-solid fa-lock');
});