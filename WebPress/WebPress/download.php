<?php
echo '<a id="downloadFile" download="'.$_GET['name'].'" href="'.$_GET['path'].'">'.$_GET['name'].'</a>';
echo '<script>
window.addEventListener("load", function(){
	document.querySelector("#downloadFile").click();
	window.history.back();
});
</script>';
?>