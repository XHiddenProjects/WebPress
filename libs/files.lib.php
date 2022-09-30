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
public static function uploadToFileManager($name, $path){
 
 			// Count total files
 			$fileCount = count($_FILES[$name]['name']);

 			// Iterate through the files
 			for($i = 0; $i < $fileCount; $i++){

  				$file = $_FILES[$name]['name'][$i];
 
  				// Upload file to $path
  				return @move_uploaded_file($_FILES[$name]['tmp_name'][$i], $file);
 
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
public static function LockedItem($file, $locked){
	if(!is_array($locked)){
		return notify_alert('locked_file', 'danger', '<i class="fa-solid fa-triangle-exclamation"></i> You must have an array!');
	}
	return @in_array($file, $locked);
}	
public static function ManagerOpts($path){
	global $lang;
	$fileName = preg_match('/([\w\-\_]+\.[\w\-\_]+)|([\w\_\-]+\.[\w\-\_]+\.[\w\-\_]+)/',$path,$name);
	$inits = str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']);
	$convert = str_replace($inits.'\\','/',$path);
		$out='';
		$out.='<a href="./files?delete='.$path.'"><button class="btn btn-danger float-end ms-2 me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['files.delete'].'"><i class="fa-solid fa-trash-can"></i></button></a>';
		$out.='<a href="./files?chmod='.$path.'"><button class="btn btn-secondary float-end ms-2 me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['files.chmod'].'"><i class="fa-solid fa-key"></i></button></a>';
		$out.='<a href="./files?rename='.$path.'"><button class="btn btn-warning float-end ms-2 me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['files.rename'].'"><i class="fa-solid fa-pen-to-square"></i></button></a>';
		if(isset($name)&&$fileName){
		$out.='<a href="../download.php?path='.$convert.'&name='.@reset($name).'"><button class="btn btn-info float-end ms-2 me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['files.download'].'"><i class="fa-solid fa-download"></i></button></a>';			
		}

	return $out;
	}
public static function Perms($path){
	return substr(sprintf('%o', fileperms($path)), -4);
}
public static function FullPerms($path){
$perms = fileperms($path);

switch ($perms & 0xF000) {
    case 0xC000: // socket
        $info = 's';
        break;
    case 0xA000: // symbolic link
        $info = 'l';
        break;
    case 0x8000: // regular
        $info = 'r';
        break;
    case 0x6000: // block special
        $info = 'b';
        break;
    case 0x4000: // directory
        $info = 'd';
        break;
    case 0x2000: // character special
        $info = 'c';
        break;
    case 0x1000: // FIFO pipe
        $info = 'p';
        break;
    default: // unknown
        $info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

return ' -'.$info.'-';
}
public static function removeDir($dir){
	foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            deleteAll($file);
        else
            unlink($file);
    }
   return @rmdir($dir) ? true : false;
}

}
?>