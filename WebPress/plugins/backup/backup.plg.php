<?php
function backup_install(){
	global $lang;
		$out = '';
	$plugin = 'backup';
	!WebDB::dbExists('plugins', $plugin.'/plugin') ? WebDB::makeDB('plugins', $plugin.'/plugin') : 'You cannot make folder';

$data = array(
	'active'=>'',
	'version'=>'1.0.4',  
	'config'=>array(
		'use'=>filter_var(false, FILTER_VALIDATE_BOOLEAN),
	),
	'options'=>array('canDisabled'=>filter_var(true, FILTER_VALIDATE_BOOLEAN),  
	'usedLang'=>array('en-US','de-DE','it-IT', 'fr-FR')));
	$out.= WebDB::saveDB('plugins', $plugin.'/plugin', $data) ? '' : 'Error';
	@mkdir(dirname(ROOT).'/backup');
	return $out; 
}
function backup_dblist(){
	global $BASEPATH, $lang;
	$out='';
	$plugin='backup';
	$d = WebDB::dbExists('plugins',$plugin.'/plugin') ? WebDB::getDB('plugins',$plugin.'/plugin') : array('active'=>'');
	if($d['active']){
		$out.='<a class="mb-2 list-group-item list-group-item-action list-group-item-secondary" aria-current="page" href="'.$BASEPATH.'/dashboard.php/view?plugins='.$plugin.'">'.$lang[$plugin.'_listItem'].'</a>';
	}
	return $out;
}
function createBackup(){
	$createVersion = date('Y-m-').uniqid();
	$zip = new ZipArchive();
	$setZIP=$createVersion.".zip";
	if ($zip->open(dirname(ROOT).'/backup/'.$setZIP, ZIPARCHIVE::CREATE||ZIPARCHIVE::FL_OVERWRITE) != TRUE) {
			die ("Could not open archive");
	}
	foreach(Files::Scan(ROOT.'data') as $folders){
		
		foreach(Files::Scan(ROOT.'data/'.$folders) as $files){
			if(is_dir(ROOT.'data/'.$folders.'/'.$files)&&!preg_match('/\.[\w+]/', $files)){
				foreach(Files::Scan(ROOT.'data/'.$folders.'/'.$files) as $file){
					$zip->addFile(ROOT.'data/'.$folders.'/'.$files.'/'.$file, 'data/'.$folders.'/'.$files.'/'.$file);
				}
			}else{
				$zip->addFile(ROOT.'data/'.$folders.'/'.$files, 'data/'.$folders.'/'.$files);
			}
			
		}
		$zip->addFile(ROOT.'conf/config.dat.json', 'conf/config.dat.json');
	}
		

		// close and save archive

	return $zip->close() ? true : false; 
}
function removeBackup($id){
	if(file_exists(dirname(ROOT).'/backup/'.$id))
		return @unlink(dirname(ROOT).'/backup/'.$id);
}
function restoreBackup($id){
	Files::removeDir(ROOT.'data/');
	Files::removeDir(ROOT.'conf/');
	$zip = new ZipArchive;
	$res = $zip->open(dirname(ROOT).'/backup/'.$id);

	if ($res === TRUE) 
	{
    $zip->extractTo(ROOT);
    $zip->close();
	return true;
	}else{
		return false;
	} 
}
function backup_view(){
	global $BASEPATH, $lang;
	$out='';
	$plugin='backup';
	$d = WebDB::getDB('plugins',$plugin.'/plugin');
	if($d['active']){
		if(!file_exists(dirname(ROOT).'/backup')){
		$out.='<div class="alert alert-danger m-2">'.$lang[$plugin.'_nodir'].'</div>';	
		}else{
		$out.='<div class="m-2"><table class="table"> 
		<thead>
		<tr>
      <th scope="col">'.$lang[$plugin.'_version'].'</th>
      <th scope="col">'.$lang[$plugin.'_delete'].'</th>
      <th scope="col">'.$lang[$plugin.'_restore'].'</th>
	  <th scope="col">'.$lang[$plugin.'_download'].'</th>
		</tr>
  </thead><tbody>';
		foreach(Files::Scan(dirname(ROOT).'/backup') as $backup){
			$out.='<tr>
			<th scope="row"><i class="fa-solid fa-file-zipper"></i> '.$backup.' <span class="badge text-bg-secondary">'.Files::sizeFormat(filesize(dirname(ROOT).'/backup/'.$backup)).'</span></th>
			<td><a href="./view?plugins='.$_GET['plugins'].'&deleteBackup='.$backup.'"><button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></a></td>
			<td><a href="./view?plugins='.$_GET['plugins'].'&restoreBackup='.$backup.'"><button class="btn btn-info"><i class="fa-solid fa-rotate-left"></i></button></a></td>
			<td><a href="'.$BASEPATH.'/download.php?path='.($BASEPATH.'/backup/'.$backup).'&name='.$backup.'"><button class="btn btn-success"><i class="fa-solid fa-download"></i></button></a></td>
		</tr>';
		}
		$out.='</tbody></table></div>';
		$out.='<center><a href="./view?plugins='.$_GET['plugins'].'&createBackup=true"><button class="btn btn-warning fs-5 m-2">'.$lang[$plugin.'_createBackup'].'</button></a></center>';
		if(isset($_GET['createBackup']))
			echo createBackup() ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/view?plugins='.$_GET['plugins'], 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/view?plugins='.$_GET['plugins'], 'danger');
		if(isset($_GET['deleteBackup']))
			echo removeBackup($_GET['deleteBackup']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/view?plugins='.$_GET['plugins'], 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/view?plugins='.$_GET['plugins'], 'danger');
		if(isset($_GET['restoreBackup']))
			echo restoreBackup($_GET['restoreBackup']) ? Utils::redirect('modal.pedit.title', 'config.success', $BASEPATH.'/dashboard.php/view?plugins='.$_GET['plugins'], 'success') : Utils::redirect('modal.failed.title', 'config.failed', $BASEPATH.'/dashboard.php/view?plugins='.$_GET['plugins'], 'danger');
		}
	}
	return $out;
}

?>