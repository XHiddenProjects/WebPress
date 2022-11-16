<?php 
require_once('config.php');
require_once('header.php');
require_once('footer.php');
require_once('libs/plugin.lib.php');
require_once('libs/users.lib.php');
$chooseLang='';
global $lang, $selLang, $conf, $defaultIcon;
require_once('lang/'.$selLang.'.php');
?>
<html>
<head>
<?php
echo head();
?>
</head>
<body>
<?php
if(isset($_SESSION['guest'])){
	echo '<div class="alert alert-warning m-0">'.$lang['expect.guest'].'</div>';
}
?>
<?php echo Plugin::hook('beforePage'); ?>
<header>
<nav class="navbar navbar-expand-lg bg-secondary">
 <div class="container-fluid">
    <a class="navbar-brand nav-link active" href="#">
      <img src="<?php echo isset($conf['page']['page-icon']['64']) ? $conf['page']['page-icon']['64'] : '';?>" alt="">
    <?php echo $conf['page']['page-title'];?>
	</a>
	  <div class="collapse navbar-collapse" id="webpressnav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	  <?php
	  echo plugin::hook('nav');
	  ?>
 </ul>
 <span class="dropdown mx-5">
   <span class="nav-link dropdown-toggle" href="#" id="authmenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?php 
		   echo $lang['index.authdown']; ?>
          </span>
          <ul class="dropdown-menu" aria-labelledby="authmenu">
            <li><a class="dropdown-item" href="./auth.php/register"><?php echo "{$lang['index.registerbtn']}";?></a></li>
			<?php
			if(!Users::getSession()){
			echo '<li><a class="dropdown-item" href="./auth.php/login"> '.$lang['index.loginbtn'].'</a></li>';
			}elseif(!Users::isAdmin() && !Users::isMod() && !Users::isMember()){
			echo '<li><a class="dropdown-item" href="./auth.php/logout"> '.$lang['index.loginoutbtn'].'</a></li>';	
			}else{
				echo '<li><a class="dropdown-item" href="./dashboard">'.$lang['index.dashboardbtn'].'</a></li>';
			}
			?>
			<li><a class="dropdown-item" href="<?php echo './forum?p=1';?>"><?php echo "{$lang['index.forumbtn']}";?></a></li>
         </ul>
		 </span>
	</div>
  </div>
</nav>
</header>
<!--Write contents below here-->
<h1 id="contentIndex" class="text-secondary"><?php echo $lang['index.writtable'];?></h1>

<?php
echo foot($BASEPATH);
?>
</body>
</html>