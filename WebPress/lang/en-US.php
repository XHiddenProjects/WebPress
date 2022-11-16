<?php
$lang = array(
'lang'=>array(
'en-US'=>'English'
),
'sitemap.title'=>'WebPress-Sitemaps',
'index.authdown'=> 'Authorization',
'index.registerbtn'=>'Create Account <i class="fas fa-user"></i>',
'index.forumbtn'=>'Forum <i class="fa-duotone fa-comments"></i>',
'index.loginbtn'=>'Login <i class="fas fa-sign-in"></i>',
'index.dashboardbtn'=>'Dashboard <i class="fas fa-tachometer"></i>',
'index.loginoutbtn'=>'Logout <i class="fas fa-sign-out"></i>',
'index.noScript'=>'Sorry Javascript is not activated, please activate it!',
'index.label.copyright'=>'Copyright',
'index.label.license'=>'and Licensed by',
'quote_direct'=>'Click to Show original',
'index.writtable'=>'Enter Content here',
# Register
'register.title'=>'Create Account',
'register.name'=>'Your Name',
'register.name.place'=>'Enter Full Name',
'register.user'=>'Username',
'register.user.place'=>'Enter Username',
'register.email'=>'Email Address',
'register.email.place'=>'Enter valid Email address',
'register.email.syntax'=>'Must be a valid email address',
'register.psw'=>'Enter Password',
'register.psw.place'=>'Enter password',
'register.psw.repeat'=>'Re-enter Password',
'register.psw.repeat.place'=>'Repeat Password',
'register.psw.syntax'=> 'Must include 1 uppercase, 1 lowercase, 1 number, 8 characters long',
'register.ts' => 'I agree all statements in <a href="'.$conf['page']['termsandservice'].'" class="text-body"><u>Terms of service</u></a>',
'register.submit'=>'Sign Up',
'register.back'=>'Back',
'register.login'=>'Login',
'register.err.exist'=>'Username already exists',
'register.err.psw'=>'You must have 1 uppercase, 1 lowercase, 1 number, and 8 characters',
'register.err.email'=>'You must have a valid email address',
'register.err.captcha'=>'Invalid Captcha',
'register.sucs.user'=>'Successfully created: ',
#login
'login.title'=>'Login to Account',
'login.submit'=>'Login',
'login.back'=>'Back',
'login.create'=>'Register',
'login.psw'=>'Enter Password',
'login.err.user'=>'Username doesn\'t exits',
'login.err.psw'=>'Password doesn\'t match',
'login.user'=>'Enter Username',
'login.err.token'=>'Invalid Token <i>'.CSRF::check().'</i>',
'login.token'=>'Private Token',
'login.token.place'=>'Enter Private Token',
#auth
'auth.logout'=>'Logging out',
'auth.logout.desc'=>'Redirecting to home',
#dashboard
'dashboard'=>'Dashboard',
'dashboard.config.panel.logger'=>'Display Console('.($conf['page']['panel']['console']!==(int)'-1' ? 'Top <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="View all errors/warnings in raw text" href="../debug.log">'.$conf['page']['panel']['console'].'</a>' : '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="custom-tooltip" title="Warning: This may cause page delay!"><span style="cursor:help;text-decoration:underline;color:blue;">All</span></span>').')',
'dashboard.config.panel.catche'=>'Clear Catche',
'dashboard.config.panel.bgcolor'=>'Panel Background',
'dashboard.config.panel.color'=>'Panel Color',
'dashboard.config.panel.email'=>'Custom Email Domain',
'dashboard.config.panel.editor'=>'Editor',
'dashboard.config.panel.theme'=>'Themes',
'dashboard.config.panel.emaildisabled'=>'You cannot change this, please upgrade',
'dashboard.config.panel.emailHelp'=>'Enter your custom domain to allow it',
'dashboard.config.panel.icons'=>'Website Logo',
'dashboard.userKey'=>'Public Key',
'dashboard.userKey.copy'=>'Copy Public Key',
'dashboard.userPKey'=>'Private Key',
'dashboard.userPKey.copy'=>'Copy Private Key',
'dashboard.hardwareid.copy'=>'Copy Hardware ID',
'dashboard.title.phpinfo'=>'Dashboard(PHP info)',
'dashboard.title.profile'=>'Dashboard(Profile)',
'dashboard.title.config'=>'Dashboard(Config)',
'dashboard.title.docs'=>'Dashboard(Docs)',
'dashboard.title.themes'=>'Dashboard(Themes)',
'dashboard.title.plugins'=>'Dashboard(Plugins)',
'dashboard.title.console'=>'Dashboard(Console)',
'dashboard.title.editors'=>'Dashboard(Editors)',
'dashboard.title.mail'=>'Dashboard(Mail)',
'dashboard.title.assets'=>'Dashboard(Assets)',
'dashboard.title.ban'=>'Dashboard(Ban List)',
'dashboard.title.roles'=>'Dashboard(Roles)',
'dashboard.title.files'=>'Dashboard(Files)',
'dashboard.title.view'=>'Dashboard(View Plugin)',
'dashboard.title.notFound'=>'Dashboard(Page Not Found)',
'dashboard.desc'=>'Welcome to WebPress panel! This is where you can config and edit file/folders for your web page, active and deactive plugins and themes. Enjoy!',
'dashboard.logout'=>'Logout',
'dashboard.redirect.logout.title'=>'Logging out',
'dashboard.redirect.logout.desc'=>'Redirecting to Login',
'dashboard.side'=>'WebPress Menu',
'dashboard.side.welcome.morn'=>'<span style="color:#f7cd5d;">Good Morning'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunrise"></i></span>',
'dashboard.side.welcome.after'=>'<span style="color:#fce570;">Good Afternoon'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sun"></i></span>',
'dashboard.side.welcome.even'=>'<span style="color:#fad6a5;">Good Evening'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunset"></i></span>',
'dashboard.side.welcome.night'=>'<span style="color:#003833;">Good Night'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-moon"></i></span>',
'dashboard.side.weather'=>'Weather',
'dashboard.side.home'=>'Home <i class="fas fa-house"></i>',
'dashboard.side.back'=>'Dashboard <i class="fas fa-tachometer"></i>',
'dashboard.side.forum'=>'Forum <i class="fa-duotone fa-comments"></i>',
'dashboard.side.phpinfo'=>'PHP Info <i class="fa-brands fa-php"></i>',
'dashboard.side.profile'=>'Profile <i class="fas fa-user"></i>',
'dashboard.side.config'=>'Config <i class="fas fa-sliders-h"></i>',
'dashboard.side.docs'=>'Documentation <i class="fas fa-file-alt"></i>',
'dashboard.side.themes'=>'Themes <i class="fas fa-paint-brush"></i>',
'dashboard.side.plugins'=>'Plugins &nbsp;&nbsp;<i class="fas fa-plug" style="transform:rotate(-45deg);"></i>',
'dashboard.side.console'=>'Console <i class="fas fa-terminal"></i>',
'dashboard.side.editors'=>'Editors <i class="fas fa-pen-square"></i>',
'dashboard.side.assets'=>'Assets <i class="fa-solid fa-books"></i>',
'dashboard.side.mail'=>'Mail <i class="fas fa-envelope"></i>',
'dashboard.side.ban'=>'Ban List <i class="fa-solid fa-ban"></i>',
'dashboard.side.roles'=>'Roles <i class="fa-solid fa-user-plus"></i>',
'dashboard.side.files'=>'Files <i class="fa-solid fa-files"></i>',
'dashboard.graph.user.label'=>'users',
'dashboard.graph.user.y'=>'Registered Users',
'dashboard.graph.user.subtitle'=>'This will be clear out on ',
'dashboard.graph.views.label'=>'views',
'dashboard.graph.views.unique'=>'unique',
'dashboard.graph.views.y'=>'Views on webpage',
'dashboard.graph.views.subtitle'=>'This will be clear out on ',
'dashboard.profile.title'=>'About the User',
'dashboard.profile.hardwareID'=>'Hardware ID: ',
'dashboard.profile.about'=>'<b>About: </b>',
'dashboard.profile.timezone'=>'<b>Timezone: </b>',
'dashboard.profile.ip'=>'<b>IP: </b>',
'dashboard.profile.location'=>'<b>Location: </b>',
'dashboard.profile.created'=>'<b>Created: </b>',
'dashboard.profile.email'=>'<b>Email: </b>',
'dashboard.profile.name'=>'<b>Name: </b>',
'dashboard.profile.topics'=>'<b class="text-secondary">Topics: </b>',
'dashboard.profile.replys'=>'<b class="text-secondary">Replys: </b>',
'dashboard.profile.forums'=>'<b class="text-secondary">Forums: </b>',
'dashboard.pageLoaded'=>'<b class=\'text-secondary\'>Loaded: </b>',
'dashboard.profile.editbtn'=>'Edit Profile',
'dashboard.profile.addBan'=>'Ban User',
'dashboard.config.title'=>'Configuration',
'dashboard.config.pageError.title'=>'Page Errors(HTML+MD is allowed):',
'dashboard.config.page.title'=>'Webpage Title',
'dashboard.config.lang.title'=>'Language',
'dashboard.config.400'=>'Bad Request',
'dashboard.config.401'=>'Authorization',
'dashboard.config.403'=>'Forbidden',
'dashboard.config.404'=>'Page Not Found',
'dashboard.config.500'=>'International Error',
'dashboard.config.301.help'=>'Leave blank to not include it',
'dashboard.config.debug.title'=>'Debug',
'dashboard.config.seo.title'=>'SEO Tools <i class="fas fa-tools"></i>',
'dashboard.config.description'=>'Enter Web Description <i class="fas fa-edit"></i>',
'dashboard.config.author'=>'Author <i class="fas fa-at"></i>',
'dashboard.config.refresh'=>'Auto Refresh <i class="fas fa-sync"></i>',
'dashboard.config.refresh.help'=>'Set value to 0 to not use auto-refresh',
'dashboard.config.keywords'=>'Enter Keywords <i class="fas fa-spell-check"></i>',
'dashboard.config.keywords.help'=>'Use commas(,) to use multiple keywords',
'dashboard.config.robotIndex.title'=>'Allow robots to index your website? <i class="fas fa-robot"></i>',
'dashboard.config.robotFollow.title'=>'Allow robots to follow all links? <i class="fas fa-external-link"></i>',
'dashboard.config.rate.title'=>'Rating <i class="fas fa-star"></i>',
'dashboard.config.rate'=>array(
'null'=>'Not Specified',
'14_years'=>'14 Years',
'adult'=>'Adult',
'general'=>'General',
'mature'=>'Mature',
'restricted'=>'Restricted',
'safe_for_kids'=>'Safe for kids'
),
'dashboard.config.copyright'=>'Copyright <i class="fas fa-copyright"></i>',
'dashboard.config.distribution.title'=>'Distribution <i class="fas fa-chart-network"></i>',
'dashboard.config.distribution'=>array(
'Global'=>'Global',
'Local'=>'Local'
),
'dashboard.config.revisted.title'=>'Revisit-after <i class="fas fa-exchange"></i>',
'dashboard.config.revisted'=>array(
'1_Day'=>'1 Day',
'7_Days'=>'7 Days',
'31_Days'=>'31 Days',
'180_Days'=>'180 Days',
'360_Days'=>'360 Days'
),
'dashboard.config.charset.title'=>'Charset <i class="fas fa-file-times"></i>',
'dashboard.config.charset'=>array(
'GB2312'=>'GB2312',
'US-ASCII'=>'US-ASCII',
'ISO-8859-1'=>'ISO-8859-1',
'ISO-8859-2'=>'ISO-8859-2',
'ISO-8859-3'=>'ISO-8859-3',
'ISO-8859-4'=>'ISO-8859-4',
'ISO-8859-5'=>'ISO-8859-5',
'ISO-8859-6'=>'ISO-8859-6',
'ISO-8859-7'=>'ISO-8859-7',
'ISO-8859-8'=>'ISO-8859-8',
'ISO-8859-9'=>'ISO-8859-9',
'ISO-2022-JP'=>'ISO-2022-JP',
'ISO-2022-JP-2'=>'ISO-2022-JP-2',
'SHIFT_JIS'=>'SHIFT_JIS',
'EUC-KR'=>'EUC-KR',
'BIG5'=>'BIG5',
'KOI8-R'=>'KOI8-R',
'KSC_5601'=>'KSC_5601',
'HZ-GB-2312'=>'HZ-GB-2312',
'JIS_X0208'=>'JIS_X0208',
'UTF-8'=>'UTF-8 (Recommended)',
'other'=>'other'
),
'dashboard.config.captch'=>'Captcha',
'dashboard.pageError'=>'Page Not Found!',
'dashboard.config.forum.title'=>'Forum <i class="fa-solid fa-comments"></i>',
'dashboard.config.forum.topic'=>'Display Topic Amount',
'dashboard.config.forum.reply'=>'Display Reply Amount',
# modal
'modal.profile'=>'Edit Profile',
'modal.profile.username'=>'Enter Username',
'modal.profile.name'=>'Enter Name',
'modal.profile.oldpsw'=>'Old Password',
'modal.profile.newpsw'=>'Enter New Password',
'modal.profile.delete'=>'Delete Account',
'modal.profile.newpsw.note'=>'Must have Old Password',
'modal.profile.about'=>'About Yourself',
'modal.profile.upload'=>'Upload Logo(PNG files only)',
'modal.profile.err.user'=>'Username already exists',
'modal.pedit.title'=>'Saving Data',
'modal.failed.title'=>'Failed Data',
'modal.pedit.desc'=>'Saving edited data',
'modal.pedit.psw.format'=>'You must have 1 uppercase, 1 lowercase, 1 number, and 8 characters',
'modal.pedit.psw.match'=>'Password doesn\'t match',
'modal.pedit.psw.otn'=>'Old password doesn\'t match with new password',
'modal.profile.removeAvatar'=>'Remove Avatar',

#config
'config.label'=>'Config ',
'config.save'=>'Save <i class="fas fa-save"></i>',
'config.failed'=>'Failed to save data',
'config.success'=>'Successfully saved data',
'config.true'=>'On',
'config.false'=>'Off',
#buttons
'btn.disabled'=>'You can\'t can use this option',
'btn.drop.actions.title'=>'Actions',
'btn.drop.copy.url'=>'Copy URL <i class="fas fa-link"></i>',
'btn.drop.copy.msg'=>'Copy Message <i class="fas fa-copy"></i>',
'btn.download'=>'Download <i class=\'fas fa-download\'></i>',
'btn.save'=>'Save Changes',
'btn.close'=>'Close',
'btn.dismissed'=>'Dismiss',
'btn.confirm'=>'Confirm',
'btn.quote'=>'<i class="fa-solid fa-comment-quote"></i> Quote',
# Themes
'theme.active'=>'Activated <i class="fas fa-check"></i>',
'theme.deactive'=>'Deactivated <i class="fas fa-times"></i>',
'theme.error.missingName'=>'Missing Name',
'theme.error.missingDesc'=>'Missing Description',
'theme.allow.lang'=>'Allowed Languages: ',
'theme.allow.lang.null'=>'Undefined',
'theme.missing'=>'Missing theme config file!',
# Themes
'plugin.active'=>'Activated <i class="fas fa-check"></i>',
'plugin.deactive'=>'Deactivated <i class="fas fa-times"></i>',
'plugin.error.missingName'=>'Missing Name',
'plugin.error.missingDesc'=>'Missing Description',
'plugin.allow.lang'=>'Allowed Languages: ',
'plugin.allow.lang.null'=>'Undefined',
#Debug
'debug.off'=>'<a href="./configs">Debug</a> is off, you can no longer log any feature errors.',
# config
'config'=>'Config ',
# contact
'contact.title'=>'Contact',
'contact.email'=>'<i class="fas fa-asterisk text-danger"></i> Email',
'contact.email.placeholder'=>'Enter Your Email Address',
'contact.emailto'=>'<i class="fas fa-asterisk text-danger"></i> To:',
'contact.emailto.placeholder'=>'Enter Persons Email Address: (use \',\' to seperate)',
'contact.to.example'=>'Example: user1:<{user1email}>, user2:<{user2email}>...',
'contact.senderAs'=>'Sending as',
'contact.name'=>'<i class="fas fa-asterisk text-danger"></i> Name',
'contact.name.placeholder'=>'Enter Full Name',
'contact.subject'=>'<i class="fas fa-asterisk text-danger"></i> Subject',
'contact.subject.placeholder'=>'Enter subject',
'contact.msg'=>'<i class="fas fa-asterisk text-danger"></i> Message',
'contact.msg.placeholder'=>'Enter message',
'contact.send'=>'Send Message',
'contact.markasread'=>'Mark as Read',
'contact.markasunread'=>'Mark as Unread',
'contact.reply'=>'Reply',
'contact.readme'=>'Read',
'contact.hidden'=>'This is a hidden message to only a specific user!',
'contact.option.all'=>'All',
'contact.msg.exists'=>'Message already exists',
'contact.report.prioiry'=>'<i class="fas fa-asterisk text-danger"></i> Prioiry',
'contact.report'=>'Report User',
'contact.report.label'=>'[Enter Reasoning here]',
# mail
'mail.success'=>'Successfully sent mail to ',
'mail.failed'=>'Failed to send mail to ',
# notify
'notify.clear'=>'Mark all as read',
# form
'errLen' => 'Too short / long',
'errNb' => 'This is not a positive whole number',
'ErrContentFilter' => 'You have inserted at least one censored word, please be polite.',
'tableHeader'=>'Headers',
'form_active'=>'On/Off',
# assets
'assets.title'=>'Assets',
# ban list
'ban.empty'=>'No users are banned',
'ban.remove'=>'Remove',
'ban.add'=>'Add User',
'ban.table'=>array(
'username'=>'Username',
'time'=>'Release date',
'duration'=>'Duration',
'reason'=>'Reason',
'bannedBy'=>'Banned By',
'actions'=>'Actions'
),
'ban.list'=>array(
'1min'=>'+1 minute',
'3min'=>'+3 minutes',
'5min'=>'+5 minutes',
'7min'=>'+7 minutes',
'9min'=>'+9 minutes',
'11min'=>'+11 minutes',
'13min'=>'+13 minutes',
'15min'=>'+15 minutes',
'17min'=>'+17 minutes',
'19min'=>'+19 minutes',
'21min'=>'+21 minutes',
'23min'=>'+23 minutes',
'25min'=>'+25 minutes',
'27min'=>'+27 minutes',
'29min'=>'+29 minutes',
'31min'=>'+31 minutes',
'33min'=>'+33 minutes',
'35min'=>'+35 minutes',
'37min'=>'+37 minutes',
'39min'=>'+39 minutes',
'41min'=>'+41 minutes',
'43min'=>'+43 minutes',
'45min'=>'+45 minutes',
'47min'=>'+47 minutes',
'49min'=>'+49 minutes',
'51min'=>'+51 minutes',
'53min'=>'+53 minutes',
'55min'=>'+55 minutes',
'57min'=>'+57 minutes',
'59min'=>'+59 minutes',
'1h'=>'+1 Hour',
'3h'=>'+3 Hours',
'5h'=>'+5 Hours',
'7h'=>'+7 Hours',
'9h'=>'+9 Hours',
'11h'=>'+11 Hours',
'13h'=>'+13 Hours',
'15h'=>'+15 Hours',
'17h'=>'+17 Hours',
'19h'=>'+19 Hours',
'21h'=>'+21 Hours',
'23h'=>'+23 Hours',
'1d'=>'+1 Day',
'3d'=>'+3 Days',
'5d'=>'+5 Days',
'1w'=>'+1 Week',
'3w'=>'+3 Weeks',
'1m'=>'+1 Month',
'3m'=>'+3 Months',
'5m'=>'+5 Months',
'7m'=>'+7 Months',
'9m'=>'+9 Months',
'11m'=>'+11 Months',
'1y'=>'+1 Year',
'3y'=>'+3 Years',
'5y'=>'+5 Years',
'7y'=>'+7 Years',
'9y'=>'+9 Years',
'11y'=>'+11 Years',
'13y'=>'+13 Years',
'15y'=>'+15 Years',
'17y'=>'+17 Years',
'19y'=>'+19 Years',
'21y'=>'+21 Years',
'23y'=>'+23 Years',
'25y'=>'+25 Years',
'27y'=>'+27 Years',
'29y'=>'+29 Years',
'31y'=>'+31 Years',
'forever'=>'Forever'
),
'ban.byList'=>array(
'username'=>'Username',
'ip'=>'IP',
'hardwareid'=>'Hardware ID'
),
'ban.forever'=>'Forever',
'ban.UI.title'=>'Ban User',
'ban.UI.username'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Username',
'ban.UI.time'=>'Time',
'ban.UI.reason'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Reason',
'ban.UI.banBy'=>'Ban Type',
'ban.UI.submit'=>'Ban User',
# uploads
'upload.failed.data'=>'Cannot recive data',
'upload.failed.large'=>'Sorry, your file is to large',
'upload.failed.extentions'=>'Sorry, your file is not a valid extentions',
'upload.failed.overrule'=>'Sorry, your file already exists',
'upload.failed'=>'Sorry, your file was not uploaded.',
'upload.failed.rename'=>'Failed to rename',
'upload.success'=>array('The file '.(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on' ? 'https://':'http://').$_SERVER['HTTP_HOST'].'/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/'.'uploads/', 'has been uploaded.', 'avatars/'),
# Roles
'roles.user'=>'Username',
'roles.roleID'=>'Role Type',
'roles.edit'=>'Edit Role',
'roles.roleSelect'=>'Select Role',
# files
'file.locked.folder'=>'This folder is locked',
'file.locked.file'=>'This file is locked',
'file.locked.file'=>'This file is locked',
'file.manager.title'=>'File Manager',
'file.managerchmod.title'=>'Change Permissions',
'file.managerchmod.u'=>'Owner Rights',
'file.managerchmod.g'=>'Group Rights',
'file.managerchmod.o'=>'Other Rights',
'file.managerchmod.read'=>'Read(4)',
'file.managerchmod.write'=>'Write(2)',
'file.managerchmod.execute'=>'Execute(1)',
'files.delete'=>'Remove File',
'files.chmod'=>'Change File Permissions',
'files.rename'=>'Rename File',
'files.remove.msg'=>'Do you wish to remove ',
'files.rename.msg'=>'Rename file',
'file.rename.newName'=>'New Name:',
'file.rename.oldName'=>'Old Name:',
'file.manager.createFile'=>'<i class="fa-solid fa-file-plus"></i> Create File',
'file.manager.createFolder'=>'<i class="fa-solid fa-folder-plus"></i> Create Folder',
'file.manager.upload'=>'<i class="fa-solid fa-upload"></i> Upload',
'files.addFile.msg'=>'Add File',
'files.addFolder.msg'=>'Add Folder',
'files.download'=>'Download File',
'file.manager.fileUpload'=>'Upload Files here: ',
'file.manager.folderUpload'=>'Upload Folders here: ',
'files.uploadFiles.msg'=>'Upload Files',
'files.manager.saved'=>'File Successfully saved, reloading page to update file...',
'files.manager.error'=>'Error: could not save file, reloading page to update file..',
#expectations
'expect.lang'=>'You must have '.$conf['lang'].'.php',
'expect.guest'=>'<i class="fa-solid fa-triangle-exclamation"></i> You are in guest mode, you cannot do anything but read/view/register/login, please <a href="./auth.php/login">login</a> or <a href="./auth.php/register">register</a> and account',
'expect.requiements'=>'All required form items are required!',
#forum
'forum.title'=>'Forum',
'forum.author'=>'Created by: ',
'forum.sidebar'=>'Forums',
'forum.addForum'=>'Add Forum',
'forum.addTopic'=>'Add Topic',
'forum.editTopic'=>'Edit Topic',
'forum.created'=>'Created: ',
'forum.edited'=>'Last Edited: ',
'forum.search.failed'=>'No search resaults found',
'forum.replys'=>'Reply&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>',
'forum.view'=>'View&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>',
'forum.replysNoIcon'=>'Replys',
'forum.editBtn'=>'<i class="fa-solid fa-pen-to-square"></i> Edit',
'forum.removeBtn'=>'<i class="fa-solid fa-trash-can"></i> Delete',
'forum.anonumous'=>'System',
'forum.inputForumName'=>'Forum Name',
'forum.inputForumColor'=>'Enter Color',
'forum.selectIcon'=>'Select Icon',
'forum.inputTopicName'=>'Topic Name',
'forum.inputTopicCategory'=>'Select Forum',
'forum.entermsg'=>'Enter Message',
'forum.inputTopicAuthor'=>'Author',
'forum.inputTopicTags'=>'Enter Tags(use , to seperate)',
'forum.deleteTopic'=>'Delete Topic',
'forum.pinned'=>'Pinned',
'forum.locked'=>'Locked',
'forum.toggleOpt'=>array(
	'true'=>'yes',
	'false'=>'no'
),
'fourm.guest'=>'Login to reply on the forum',
'forum.recent'=>'Recent Activities',
'forum.anchorID'=>'Copy Reply ID',
'forum.userStatus'=>'Status',
'forum.sidebar.statistics'=>'Statistics',
'forum.reply_drop'=>'Post Reply',
'forum.noreply'=>'You do not have permission to reply!'
);
?>