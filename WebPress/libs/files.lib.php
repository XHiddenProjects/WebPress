<?php
class Files{
	protected function __construct(){
		
	}
	public static function renameFile($old, $new){
		return rename($old, $new);
	}
	public static function upload($name, $loc, $rename=null){
		global $lang;
		$conf = json_decode(file_get_contents(ROOT.'conf'.DS.'config.dat.json'), true);
		
					if(!isset($_FILES[$name]) OR $_FILES[$name]['error'] > 0){
						echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed.data']."</div>";
						return false;
					}else{
							$target_dir = $loc;
						$target_file = $target_dir . basename($_FILES[$name]["name"]);
$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$uploadOk = 1;
$msg = '';
					}
	if($_FILES[$name]["size"] > $conf['uploads']['maxSize']){
		echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed.large']."</div>";
		$uploadOk = 0;
	}
	if(!in_array($file_type, $conf['uploads']['extentions'])){
		echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed.extentions']."</div>";
		$uploadOk = 0;
	}
	if(file_exists($target_file)&&!$conf['uploads']['overrule']){
		echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed.overrule']."</div>";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
	echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed']."</div>";
	} else {
		if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
			if($rename!==null){
				if(Files::renameFile($target_file, $target_dir.$rename)){
			echo "<div class='alert alert-success' role='alert'>The file ". htmlspecialchars( basename( $_FILES[$name]["name"])). " has been uploaded.</div>";
			}else{
				echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed.rename']."</div>";
			}
			}else{
			echo "<div class='alert alert-success' role='alert'>".$lang['upload.success'][0].(preg_match('/avatars/',$target_dir) ? $lang['upload.success'][2] : '').htmlspecialchars(basename($_FILES[$name]["name"])). " ".$lang['upload.success'][1]."</div>";	
			}
		} else {
		echo "<div class='alert alert-danger' role='alert'>".$lang['upload.failed']."(".$msg.")</div>";
		}
	}
}
	public static function remove($name, $loc){
		return unlink($loc.$name) ? true : false;
	}



	public static function copyFolder($src, $dst) {
		
   // open the source directory
    $dir = opendir($src); 
  
    // Make the destination directory if not exist
    @mkdir($dst); 
  
    // Loop through the files in source directory
    while( $file = readdir($dir) ) { 
  
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) 
            { 
  
                // Recursively calling custom copy function
                // for sub directory 
                Files::copyFolder($src . '/' . $file, $dst . '/' . $file); 
  
            } 
            else { 
                copy($src . '/' . $file, $dst . '/' . $file); 
            } 
        } 
    } 
  
    closedir($dir);
	}
	public static function checkFolder($dir){
		return file_exists($dir)&&is_dir($dir) ? true : false;
	}
	public static function createFolder($dir, $mode=0777, $recursive=false){
		return !Files::checkFolder($dir) ? mkdir($dir, (int)$mode, (bool)$recursive) : false;
	}
	
	
	public static function catche($dir) {
 $dh = opendir($dir);
 if ($dh) {
  while($file = readdir($dh)) {
   if (!in_array($file, array('.', '..'))) {
    if (is_file($dir.'/'.$file)) {
     unlink($dir.'/'.$file);
    }
    else if (is_dir($dir.'/'.$file)) {
     Files::catche($dir.'/'.$file);
    }
   }
  }
  rmdir($dir);
 }

}
	public static function copyFile($start, $end){
		return copy($start, $end) ? true : false;
	}
	public static function Scan($path, $removeDots=true){
		$dirs = $removeDots===true ? array_diff(scandir($path), ['.','..']) : scandir($path);
		return $dirs;
	}
	public static function getFileData($path){
		return file_exists($path) ? nl2br(file_get_contents($path)) : '';
	}
	
	public static function scanXML($dir){
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;
    foreach($ffs as $ff){
			echo '<url><loc>'.str_replace('//','\\',$dir.'/'.$ff);
        if(is_dir($dir.'/'.$ff)) str_replace('//','\\',$dir.'/'.Files::scanXML($dir.'/'.$ff).'\\');
		echo '</loc><changeferq>daily</changeferq></url>';
    }
   
	}
public static function sizeFormat($bytes){ 
	$kb = 1024;
	$mb = $kb * 1024;
	$gb = $mb * 1024;
	$tb = $gb * 1024;

	if (($bytes >= 0) && ($bytes < $kb)) {
	return $bytes . 'B';
	} elseif (($bytes >= $kb) && ($bytes < $mb)) {
		return ceil($bytes / $kb) . 'KB';
	} elseif (($bytes >= $mb) && ($bytes < $gb)) {
		return ceil($bytes / $mb) . 'MB';
	} elseif (($bytes >= $gb) && ($bytes < $tb)) {
		return ceil($bytes / $gb) . 'GB';
	} elseif ($bytes >= $tb) {
		return ceil($bytes / $tb) . 'TB';
	} else {
		return $bytes . 'B';
	}
	}
public static function folderSize($dir){
	$count_size = 0;
	$count = 0;
	$dir_array = scandir($dir);
	foreach($dir_array as $key=>$filename){
		if($filename!=".." && $filename!="."){
		if(is_dir($dir."/".$filename)){
			$new_foldersize = Files::foldersize($dir."/".$filename);
			$count_size = $count_size+ $new_foldersize;
			}else if(is_file($dir."/".$filename)){
			$count_size = $count_size + filesize($dir."/".$filename);
			$count++;
			}
	}
	}
		return $count_size;
	} 

}
?>