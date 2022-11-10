<?php 
require_once('init.php');
require_once('header.php');
require_once('footer.php');

global $lang, $selLang, $conf, $defaultIcon;
require_once('lang/'.$selLang.'.php');
?>
<html>
<head>
<?php
$BASEPATH = '..';
if(preg_match('/\/register/', $_SERVER['REQUEST_URI'])){
echo head('Register', $BASEPATH);	
}elseif(preg_match('/\/login/', $_SERVER['REQUEST_URI'])){
echo head('Login', $BASEPATH);		
}elseif(preg_match('/\/logout/', $_SERVER['REQUEST_URI'])){
echo head('Logout', $BASEPATH);		
}elseif(preg_match('/\/delete/', $_SERVER['REQUEST_URI'])){
echo head('Delete', $BASEPATH);		
}

?>
</head>
<body>
<?php
if(preg_match('/\/register/', $_SERVER['REQUEST_URI'])){
	$output = '<div class="webpress-form" style="height:98%;overflow:auto;"><section>
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body ps-5 pe-5 pt-5">
              <h2 class="text-uppercase text-center mb-5">'.$lang['register.title'].'</h2>
					';
					if(preg_match('/\?error=exist_user/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['register.err.exist'].'</div>';
					}elseif(preg_match('/\?error=invalid_psw/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['register.err.psw'].'</div>';
					}elseif(preg_match('/\?error=invalid_email/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['register.err.email'].'</div>';
					}elseif(preg_match('/\?success=/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-success" role="alert">'.$lang['register.sucs.user'].$_GET['success'].'</div>';
					}elseif(preg_match('/\?error=failed_captcha/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['register.err.captcha'].'</div>';
					}
					$output.='
              <form method="post">

                <div class="form-outline mb-4">
                  <input required="" name="webpressname" type="text" id="webpress-name" class="form-control form-control-lg" placeholder="'.$lang['register.name.place'].'"/>
                  <label class="form-label" for="webpress-name">'.$lang['register.name'].'</label>
                </div>
				
					<div class="form-outline mb-4">
                  <input required="" name="webpressuser" type="text" id="webpress-user" class="form-control form-control-lg" placeholder="'.$lang['register.user.place'].'"/>
                  <label class="form-label" for="webpress-user">'.$lang['register.user'].'</label>
                </div>
				
                <div class="form-outline mb-4">
				<div class="input-group">
                  <input required="" type="text" title="'.$lang['register.email.syntax'].'" name="webpressemail" id="webpress-email" class="form-control form-control-lg" placeholder="'.$lang['register.email.place'].'"/>
                  <span class="input-group-text">'.$conf['allowedEmail'].'</span>
				  <!--<label class="form-label" for="webpress-email">'.$lang['register.email'].'</label>-->
				</div>
			   </div>

                <div class="form-outline mb-4">
                  <input required="" type="password" title="'.$lang['register.psw.syntax'].'" name="webpresspsw" id="webpress-psw" class="form-control form-control-lg" placeholder="'.$lang['register.psw.place'].'"/>
                  <label class="form-label" for="webpress-psw">'.$lang['register.psw'].'</label>
                </div>

                <div class="form-outline mb-4">
                  <input required="" type="password" id="webpress-rpsw" class="form-control form-control-lg" placeholder="'.$lang['register.psw.repeat.place'].'"/>
                  <label class="form-label" for="webpress-rpsw">'.$lang['register.psw.repeat'].'</label>
                </div>';
				
				 $output.=($conf['page']['captcha'] ? '<div class="form-outline mb-4">
					<!--w=200, $h=38, $bgr=128, $bgg=128, $bgb=128, $cr=0, $cg=0, $cb=0-->
					'.Captcha::createCaptcha($captchaSettings[0], $captchaSettings[1], $captchaSettings[2], $captchaSettings[3], $captchaSettings[4], $captchaSettings[5], $captchaSettings[6], $captchaSettings[7]).'
                </div>' : '');
				
               $output.= '<div class="form-check d-flex justify-content-center mb-5">
                  <input required="" name="webpresstas" class="form-check-input me-2" type="checkbox" value="" id="webpress-termsandservice" />
                  <label class="form-check-label" for="webpress-termsandservice">
                    '.$lang['register.ts'].'
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="webpresscreate" id="webpress-submit" disabled=""
                    class="btn btn-success btn-block btn-lg text-body">'.$lang['register.submit'].'</button>
				<a href="../"> <button type="button"
                    class="btn btn-danger btn-block btn-lg text-body ms-3">'.$lang['register.back'].'</button></a>
				<a href="./login"> <button type="button"
                    class="btn btn-warning btn-block btn-lg text-body ms-3">'.$lang['register.login'].'</button></a>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section></div>';
echo $output;
}elseif(preg_match('/\/login/', $_SERVER['REQUEST_URI'])){
	if(Users::getSession()){
			echo '<script>
				window.open("../dashboard'.(isset($_GET['redirect'])&&$_GET['redirect']!==null ? '.php/'.$_GET['redirect'].'' : '').'", "_self");
				</script>';
	}
	$output = '<div class="webpress-form" style="height:98%;overflow:auto;"><section>
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body ps-5 pe-5 pt-5">
              <h2 class="text-uppercase text-center mb-5">'.$lang['login.title'].'</h2>
					';
					if(preg_match('/\?error=invalid_user/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['login.err.user'].'</div>';
					}elseif(preg_match('/\?error=invalid_token/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['login.err.token'].'</div>';
					}elseif(preg_match('/\?error=invalid_psw/', $_SERVER['REQUEST_URI'])){
						$output.='<div class="alert alert-danger" role="alert">'.$lang['login.err.psw'].'</div>';
					}
					$output.='
              <form method="post">

					<div class="form-outline mb-4">
                  <input required="" name="webpressuser" type="text" id="webpress-user" class="form-control form-control-lg" placeholder="'.$lang['register.user.place'].'"/>
                  <label class="form-label" for="webpress-user">'.$lang['login.user'].'</label>
                </div>

                <div class="form-outline mb-4">
                  <input required="" type="password" name="webpresspsw" id="webpress-psw" class="form-control form-control-lg" placeholder="'.$lang['register.psw.place'].'"/>
                  <label class="form-label" for="webpress-psw">'.$lang['login.psw'].'</label>
                </div>
'.(preg_match('/\?error=invalid_token/', $_SERVER['REQUEST_URI']) ? '<div class="form-outline mb-4">
                  <input required="" type="password" name="webpresstoken" id="webpress-token" class="form-control form-control-lg" placeholder="'.$lang['login.token.place'].'"/>
                  <label class="form-label" for="webpress-token">'.$lang['login.token'].'</label>
                </div>' : '').'
			
        
                <div class="d-flex justify-content-center">
                  <button type="submit" name="webpresslogin" id="webpress-login"
                    class="btn btn-success btn-block btn-lg text-body">'.$lang['login.submit'].'</button>
				<a href="../"> <button type="button"
                    class="btn btn-danger btn-block btn-lg text-body ms-3">'.$lang['login.back'].'</button></a>
				<a href="./register"> <button type="button"
                    class="btn btn-warning btn-block btn-lg text-body ms-3">'.$lang['login.create'].'</button></a>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section></div>';
echo $output;
}elseif(preg_match('/\/logout/', $_SERVER['REQUEST_URI'])){
	echo Utils::redirect('auth.logout', 'auth.logout.desc', '../', 'danger');
	session_unset();
}elseif(preg_match('/\/delete/', $_SERVER['REQUEST_URI'])){
	$user = WebDB::dbExists('users', 'users') ? WebDB::getDB('users', 'users') : 'error';
	unset($user[$_GET['user']]);
	echo @WebDB::saveDB('users', 'users', $user) ? Utils::redirect('auth.logout', 'auth.logout.desc', '../', 'danger') : 'error';
	session_unset();
}
?>
<?php
if(isset($_POST['webpresslogin'])){
	$user = filter_var($_POST['webpressuser'], FILTER_SANITIZE_STRING);
	$psw = $_POST['webpresspsw'];
	$token = isset($_POST['webpresstoken']) ? $_POST['webpresstoken'] : '';
	
	!CSRF::checkKeyExists() ? CSRF::generate() : '';
	if(isset($_POST['webpresstoken'])){
		if($token===hash('gost',hash('sha512',CSRF::hide()))&&$token!==''){
		CSRF::generate();
		echo '<script>
				window.open("../dashboard'.(isset($_GET['redirect'])&&$_GET['redirect']!==null ? '.php/'.$_GET['redirect'].'' : '').'", "_self");
				</script>';
				return false;
	}else{
		return false;
	}
	}
	$data = file_get_contents(DATA_USERS.'users.dat.json');
	$users = json_decode($data, true);
	if(isset($users[$user])||$users[$user]['username']===$user){
		if(password_verify($psw, $users[$user]['psw'])){
			if(CSRF::check()!=='tokenExpired'&&CSRF::check()!=='invalidKey'||$users[$user]['type']!=="admin"){
				$_SESSION['user']=$user;
			
				echo '<script>
				window.open("../dashboard'.(isset($_GET['redirect'])&&$_GET['redirect']!==null ? '.php/'.$_GET['redirect'].'' : '').'", "_self");
				</script>';
				return false;
			}else{
				echo '<script>
				window.open("./login?error=invalid_token", "_self");
				</script>';
				return false;
			}	
		}else{
			echo '<script>
				window.open("./login?error=invalid_psw", "_self");
				</script>';
				return false;
		}
		}else{
				echo '<script>
				window.open("./login?error=invalid_user", "_self");
				</script>';
				return false;
		}
	}
if(isset($_POST['webpresscreate'])){
	$name = $_POST['webpressname'];
	$user = $_POST['webpressuser'];
	$psw = $_POST['webpresspsw'];
	$acceptedEmail = @preg_replace('/\@[\w\W]+$/','',$_POST['webpressemail']).$conf['allowedEmail'];
	$email = filter_var($acceptedEmail, FILTER_VALIDATE_EMAIL);
	$isAccepted = isset($_POST['webpresstas']) ? true : false;
	$ip = filter_var(Users::getRealIP(), FILTER_VALIDATE_IP);
	$captcha = $conf['page']['captcha'] ? $_POST['captcha'] : '';
	
	if($isAccepted){
		
		if(preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $psw)){
			$psw = password_hash($psw, PASSWORD_BCRYPT, ['cost'=>15]);
		}else{
				echo '<script>
				window.open("./register?error=invalid_psw", "_self");
				</script>';
				return false;
		}if($captcha===''&&!$conf['page']['captcha']||Captcha::checkCaptcha($captcha)&&$conf['page']['captcha']){
			
		}else{
				echo '<script>
				window.open("./register?error=failed_captcha", "_self");
				</script>';
				return false;
		}
		if(!file_exists(DATA_USERS.'users.dat.json')){
	
			$type='';
			if(!gettype(file_get_contents(DATA_USERS.'users.dat.json'))||!file_exists(DATA_USERS.'users.dat.json')){
				$type = "admin";
			}else{
				$type = "member";
			}
			 $users = fopen(DATA_USERS.'users.dat.json', 'w+');
			 $date=date('m-d-Y+h:i:sa');
			 $timezone = gettype(Users::ipInfo(Users::getRealIP(), 'timezone'))==="string" ? Users::ipInfo(Users::getRealIP(), 'timezone') : Users::ipInfo(Users::getRealIP())['timezone'];
			 $data = array($user=>array('name'=>$name, 'psw'=>$psw, 'username'=>$user, 'email'=>$email, 'ip'=>$ip, 'id'=>Users::hardwareID(),'type'=>$type, 'created'=>$date, 'timezone'=>$timezone, 'ban'=>array('isBanned'=>filter_var(false, FILTER_VALIDATE_BOOLEAN),'reason'=>'', 'time'=>'', 'duration'=>'' ,'bannedBy'=>''), 'about'=>''));
			 $store = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			 fwrite($users, $store);
			 fclose($users);
			!CSRF::checkKeyExists() ? CSRF::generate() : CSRF::check();
			echo '<script>
				window.open("./register?success='.$user.'", "_self");
				</script>';
			return false;
		}else{
			$data = file_get_contents(DATA_USERS.'users.dat.json');
			$users = json_decode($data, true);
			if(!isset($users[$user]) || !$users[$user]){
					$type='';
			if(file_get_contents(DATA_USERS.'users.dat.json')===""||!file_exists(DATA_USERS.'users.dat.json')){
				$type = "admin";
			}else{
				$type = "member";
			}
			$date = date('m-d-Y+h:i:sa');
						 $timezone = gettype(Users::ipInfo(Users::getRealIP(), 'timezone'))==="string" ? Users::ipInfo(Users::getRealIP(), 'timezone') : Users::ipInfo(Users::getRealIP(), 'timezone');
			 $store = array('name'=>$name, 'psw'=>$psw, 'username'=>$user, 'email'=>$email, 'ip'=>$ip, 'type'=>$type, 'created'=>$date, 'timezone'=>$timezone, 'ban'=>array('isBanned'=>filter_var(false, FILTER_VALIDATE_BOOLEAN),'reason'=>'', 'time'=>'', 'duration'=>'' ,'bannedBy'=>''), 'about'=>'');
			$users[$user] = $store;
			$users = json_encode($users, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			$openUsers = fopen(DATA_USERS.'users.dat.json', 'w+');
			fwrite($openUsers, $users);
			fclose($openUsers);
			!CSRF::checkKeyExists() ? CSRF::generate() : CSRF::check();
				echo '<script>
				window.open("./register?success='.$user.'", "_self");
				</script>';
			}else{
				echo '<script>
				window.open("./register?error=exist_user", "_self");
				</script>';
			}
		}
	}
}
?>
<?php
echo foot($BASEPATH);
?>
</body>
</html>
