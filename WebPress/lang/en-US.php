<?php
$lang = array(
'lang'=>array(
'en-US'=>'English',
'de-DE'=>'Deutsch',
'it-IT'=>'Italiano',
'fr-FR'=>'Français',
'zh-CN'=>'中國人(傳統的)'
),
'sitemap.title'=>'WebPress-Sitemaps',
'index.authdown'=> 'Authorization',
'index.registerbtn'=>'Create Account <i class="fas fa-user"></i>',
'index.forumbtn'=>'Forum <i class="fa-duotone fa-comments"></i>',
'index.loginbtn'=>'Login <i class="fas fa-sign-in"></i>',
'index.dashboardbtn'=>'Dashboard <i class="fa-solid fa-gauge-min"></i>',
'index.loginoutbtn'=>'Logout <i class="fas fa-sign-out"></i>',
'index.noScript'=>'Sorry Javascript is not activated, please activate it!',
'index.label.copyright'=>'Copyright',
'index.label.license'=>'and Licensed by',
'quote_direct'=>'Click to Show original',
'visible_for_logged'=>'You must be logged in',
'visible_for_staff'=>'This is for staff only',
'visible_for_specific_user'=>'This is only for a specific user',
'hide_show_more'=>'Show More...',
'plural'=>'s',
'posting_frame'=>'You must post this on the forum',
'pro'=>'Pro',
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
'login.err.loggedin'=>'Username is already in use.',
'login.user'=>'Enter Username',
'login.err.token'=>'Invalid Token <i>'.CSRF::check().'</i>',
'login.token'=>'Private Token',
'login.token.place'=>'Enter Private Token',
#auth
'auth.logout'=>'Logging out',
'auth.logout.desc'=>'Redirecting to home',
#dashboard
'dashboard'=>'Dashboard',
'dashboard.info.phpversion'=>'PHP Version',
'dashboard.info.projectName'=>'Project Name',
'dashboard.info.projectVersion'=>'Project Version',
'dashboard.info.projectBuild'=>'Project Build',
'dashboard.info.serverSoftware'=>'Server Software',
'dashboard.info.phpModules'=>'PHP Modules',
'dashboard.info.memory'=>'Memory',
'dashboard.info.diskSpace'=>'Disk Space',
'dashboard.info.dataStorage'=>'<em>DATA</em> storage',
'dashboard.info.uploadSize'=>'Upload Max Size',
'dashboard.config.panel.logger'=>'Display Console('.($conf['page']['panel']['console']!==(int)'-1' ? 'Top <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="View all errors/warnings in raw text" href="../debug.log">'.$conf['page']['panel']['console'].'</a>' : '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="custom-tooltip" title="Warning: This may cause page delay!"><span style="cursor:help;text-decoration:underline;color:blue;">All</span></span>').')',
'dashboard.config.panel.catche'=>'Clear Cache',
'dashboard.config.panel.bgcolor'=>'Panel Background',
'dashboard.config.panel.color'=>'Panel Color',
'dashboard.config.panel.email'=>'Custom Email Domain',
'dashboard.config.panel.editor'=>'Editor',
'dashboard.config.panel.theme'=>'Themes',
'dashboard.config.panel.index'=>'Default index',
'dashboard.config.panel.dateformat'=>'Date Format(<a href="https://www.php.net/manual/en/datetime.format.php" target="_blank">php datetime format</a>)',
'dashboard.config.panel.emaildisabled'=>'You cannot change this, please upgrade',
'dashboard.config.panel.emailHelp'=>'Enter your custom domain to allow it',
'dashboard.config.panel.icons'=>'Website Logo',
'dashboard.config.timeZone.title'=>'<a href="https://www.php.net/manual/en/timezones.php" target="_blank">Timezone <i class="fa-solid fa-calendar-days"></i></a>',
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
'dashboard.title.events'=>'Dashboard(Events)',
'dashboard.title.pages'=>'Dashboard(Pages)',
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
'dashboard.side.back'=>'Dashboard <i class="fa-solid fa-gauge-min"></i>',
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
'dashboard.side.events'=>'Events <i class="fa-regular fa-calendar-lines-pen"></i>',
'dashboard.side.pages'=>'Pages <i class="fa-solid fa-page"></i>',
'dashboard.graph.user.label'=>'users',
'dashboard.graph.user.y'=>'Registered Users',
'dashboard.graph.subtitle'=>'This will be clear out on ',
'dashboard.graph.views.label'=>'views',
'dashboard.graph.views.unique'=>'unique',
'dashboard.graph.forums.label'=>'Forums',
'dashboard.graph.forums.y'=>'Count of topics/replies',
'dashboard.graph.forums.topics'=>'Topics',
'dashboard.graph.forums.replies'=>'Replies',
'dashboard.graph.views.y'=>'Views on webpage',
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
'dashboard.profile.replys'=>'<b class="text-secondary">Replies: </b>',
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
'dashboard.config.forum.summary'=>'Summary Amount',
'dashboard.pageResults'=>'Results',
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
'config'=>'Config ',
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
'btn.delete'=>'Remove',
# Themes
'theme.active'=>'Activated <i class="fas fa-check"></i>',
'theme.deactive'=>'Deactivated <i class="fas fa-times"></i>',
'theme.error.missingName'=>'Missing Name',
'theme.error.missingDesc'=>'Missing Description',
'theme.allow.lang'=>'Allowed Languages: ',
'theme.allow.lang.null'=>'Undefined',
'theme.missing'=>'Missing theme config file!',
# Plugins
'plugin.active'=>'Activated <i class="fas fa-check"></i>',
'plugin.deactive'=>'Deactivated <i class="fas fa-times"></i>',
'plugin.error.missingName'=>'Missing Name',
'plugin.error.missingDesc'=>'Missing Description',
'plugin.allow.lang'=>'Allowed Languages: ',
'plugin.allow.lang.null'=>'Undefined',
'plugin.pluginUpdated'=>'Last Updated: ',
#Debug
'debug.off'=>'<a href="./configs">Debug</a> is off, you can no longer log any feature errors.',
# contact
'contact.title'=>'Contact',
'contact.email'=>'<i class="fas fa-asterisk text-danger"></i> Email',
'contact.email.placeholder'=>'Enter Your Email Address',
'contact.emailto'=>'<i class="fas fa-asterisk text-danger"></i> To:',
'contact.emailto.placeholder'=>'Enter Persons Email Address: (use \',\' to separate)',
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
'report'=>'<i class="fa-solid fa-bell"></i> Report',
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
'ban.request'=>'Request appeal',
'ban.remove'=>'Remove',
'ban.add'=>'Add User',
'ban.table'=>array(
'username'=>'Username',
'time'=>'Release date',
'duration'=>'Duration',
'reason'=>'Reason',
'bannedBy'=>'Banned By',
'actions'=>'Actions',
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
'upload.failed.data'=>'Cannot receive data',
'upload.failed.large'=>'Sorry, your file is to large',
'upload.failed.extentions'=>'Sorry, your file is not a valid extension',
'upload.failed.overrule'=>'Sorry, your file already exists',
'upload.failed'=>'Sorry, your file was not uploaded.',
'upload.failed.rename'=>'Failed to rename',
'upload.success'=>array('The file '.(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on' ? 'https://':'http://').$_SERVER['HTTP_HOST'].'/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/uploads/', 'has been uploaded.', 'avatars/'),
# Roles
'roles.user'=>'Username',
'roles.roleID'=>'Role Type',
'roles.edit'=>'Edit Role',
'roles.roleSelect'=>'Select Role',
'roles.createRole'=>'Create Role',
'roles.input.name'=>'Role Name',
'roles.input.desc'=>'Role Description',
'roles.input.canView'=>'Can View',
'roles.input.canWrite'=>'Can Write',
'roles.input.canRead'=>'Can Read',
'roles.input.canDelete'=>'Can Delete',
'roles.input.canBan'=>'Can Ban',
'roles.input.canPost'=>'Can Post',
'roles.input.canReply'=>'Can Reply',
'roles.input.canMsg'=>'Can Message',
'roles.input.plugins'=>'Can Activate Plugins',
'roles.input.themes'=>'Can Activate Themes',
'roles.input.config'=>'Can Config',
'roles.input.canRole'=>'Can Change Roles',
'roles.input.file'=>'Can use filemanager',
'roles.input.profile'=>'Can change profile',
'roles.input.events'=>'Can view Events',
'roles.input.pages'=>'Can Edit Pages',
'roles.deleteRole'=>'Delete Role',
'roles.removeItems'=>'Select to remove role',
# files
'file.locked.folder'=>'This folder is locked',
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
'files.manager.error'=>'Error: could not save file, reloading page to update file...',
#expectations
'expect.lang'=>'You must have '.$conf['lang'].'.php',
'expect.guest'=>'<i class="fa-solid fa-triangle-exclamation"></i> You are in guest mode, you cannot do anything but read/view/register/login, please <a href="./auth.php/login">login</a> or <a href="./auth.php/register">register</a> an account',
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
'forum.search.failed'=>'No search results found',
'forum.replys'=>'Reply&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>',
'forum.view'=>'View&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>',
'forum.replysNoIcon'=>'Replies',
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
	'false'=>'no',
	'true'=>'yes'
),
'fourm.guest'=>'Login to reply on the forum',
'forum.recent'=>'Recent Activities',
'forum.anchorID'=>'Copy Reply ID',
'forum.userStatus'=>'Status',
'forum.sidebar.statistics'=>'Statistics',
'forum.reply_drop'=>'Post Reply',
'forum.noreply'=>'You do not have permission to reply!',
'forum.home'=>'Home',
'forum.category'=>'Forums',
'forum.shortSubmit'=>'Sort Items',
'forum.sort'=>'Sort your forums <b><em>(do not have multiple topics have the same number)</em></b>',
'forum.sortUser'=>'Please login as administrator to use this option',
# events
'events.ip'=>'IP',
'events.date'=>'Date',
'events.target'=>'Target',
'events.stat'=>'Status',
'events.action'=>'Action',
#pages
'pages.form.notice'=>'Receiving Form submissions do not work using blocks. You must use the "Action" attribute to receive data. 5MB/page is max',
# blocks
'blocks.title'=>'Drag and Drop blocks to build website',
'blocks.jsonInfo'=>'This will display a JSON build, which can be edited based off your page structure.',
'blocks.moveUp'=>'<i class="fa-solid fa-up"></i> Move Up',
'blocks.moveDown'=>'<i class="fa-solid fa-down"></i> Move Down',
'blocks.remove'=>'<i class="fa-solid fa-trash-can"></i> Delete',
'blocks.reload'=>'<i class="fa-solid fa-rotate-right"></i> Reload',
'blocks.id'=>'<i class="fa-solid fa-id-card"></i> ID',
'blocks.id.prompt'=>'Enter ID, type &quote;cancel&quote; to cancel, otherwise it will remove ID',
'blocks.classes'=>'<i class="fa-solid fa-code-branch"></i> Class',
'blocks.class.prompt'=>'Enter Class, type &quote;cancel&quote; to cancel, otherwise it will remove Class',
'blocks.href'=>'<i class="fa-solid fa-link"></i> Insert Link',
'blocks.href.prompt'=>'Enter Link, type &quote;cancel&quote; to cancel, otherwise it will remove Link',
'blocks.hrefTar.prompt'=>'Enter target:\n1. self\n2. blank\n3. parent\n4. top',
'blocks.RemHref'=>'<i class="fa-solid fa-link-slash"></i> Remove Link',
'blocks.Bold'=>'<i class="fa-solid fa-bold"></i> Bold',
'blocks.Italic'=>'<i class="fa-solid fa-italic"></i> Italic',
'blocks.Strike'=>'<i class="fa-solid fa-strikethrough"></i> Strikethrough',
'blocks.style'=>'<i class="fa-solid fa-palette"></i> Style',
'blocks.Underline'=>'<i class="fa-solid fa-underline"></i> Underline',
'blocks.removeFormat'=>'<i class="fa-solid fa-text-slash"></i> Remove Format',
'blocks.insert'=>'<i class="fa-solid fa-plus"></i> Insert',
'blocks.actions'=>'Actions',
'blocks.blockAction'=>'Blocks',
'blocks.wordActions'=>'Words',
'blocks.removal'=>'Removal',
'blocks.page.title'=>'Add Page',
'blocks.page.name'=>'Enter Page Name',
'blocks.settings'=>'Settings',
'blocks.settings.bg'=>'Background',
'blocks.settings.solid.color'=>'Solid Color',
'blocks.settings.bg.img'=>'Upload Image',
'blocks.settings.custom.color'=>'Custom Color',
'blocks.settings.bgBlock.body'=>'Body',
'blocks.settings.bgBlock.target'=>'Selected Block',
'blocks.customcolor'=>'Custom Color(check back at solid color to use)',
'blocks.bgImage'=>'Enter Image URL',
'blocks.settings.color'=>'Font Color',
'blocks.settings.align'=>'Text align',
'blocks.settings.padding'=>'Padding',
'blocks.settings.margin'=>'Margin',
'blocks.settings.display'=>'Display',
'blocks.settings.flex'=>'Flex',
'blocks.settings.flexWrap'=>'Flex Wrap',
'blocks.settings.flexDir'=>'Flex Direction',
'blocks.settings.flexGrow'=>'Flex Grow',
'blocks.settings.flexShrink'=>'Flex Shrink',
'blocks.settings.flexBiases'=>'Flex Basis',
'blocks.settings.fontSize'=>'Font Size',
'blocks.settings.border'=>'Border',
'blocks.settings.borderBLRadius'=>'Bottom-Left Radius',
'blocks.settings.borderBRRadius'=>'Bottom-Right Radius',
'blocks.settings.borderTLRadius'=>'Top-Left Radius',
'blocks.settings.borderTRRadius'=>'Top-Right Radius',
'blocks.settings.boxShadow'=>'Box shadow',
'blocks.settings.textShadow'=>'text shadow',
'blocks.settings.boxShadow.h'=>'H shadow',
'blocks.settings.boxShadow.v'=>'V shadow',
'blocks.settings.boxShadow.blur'=>'Blur',
'blocks.settings.boxShadow.spread'=>'Spread',
'blocks.settings.boxShadow.color'=>'Color',
'blocks.settings.boxShadow.inset'=>'Inset',
'blocks.settings.animation'=>'Animations',
'blocks.settings.animation.list'=>'Select animation',
'blocks.settings.animation.timing'=>'Timing Function',
'blocks.settings.animation.direction'=>'Direction',
'blocks.settings.animation.fillMode'=>'Fill Mode',
'blocks.settings.animation.duration'=>'Duration',
'blocks.settings.animation.delay'=>'Delay',
'blocks.settings.animation.count'=>'Iteration Count, (-1) - infinite',
'blocks.settings.blockWidth'=>'Block Width',
'blocks.settings.blockHeight'=>'Block Height',
'blocks.settings.pos'=>'Position',
'blocks.settings.transform'=>'Transform',
'blocks.settings.textTransform'=>'Text Transform',
'blocks.settings.textDirection'=>'Text Direction',
'blocks.settings.top'=>'Top',
'blocks.settings.right'=>'Right',
'blocks.settings.bottom'=>'Bottom',
'blocks.settings.left'=>'Left',
'blocks.settings.none'=>'None',
'blocks.settings.scripts'=>'Scripts',
'blocks.settings.formConfig'=>'Form Config',
'blocks.settings.required'=>'Required',
'blocks.settings.readOnly'=>'ReadOnly',
'blocks.settings.disabled'=>'Disabled',
'blocks.settings.regexp'=>'pattern',
'blocks.usage'=>'How to use:
<ul class="list-group list-group-numbered">
<li class="list-group-item">Right click on the block to use the context menu.</li>
<li class="list-group-item"><em>Actions</em> can affect block order and page.</li>
<li class="list-group-item"><em>Blocks</em> affect the whole block, by one click</li>
<li class="list-group-item"><em>Words</em> can affect the words/block by <q>double clicking/highlighting</q> on a word in the block.</li>
<li class="list-group-item"><em>Remove Format</em> Remove the top layer of the block</li>
<li class="list-group-item"><em>Delete</em> Removes the entire block.</li>
</ul>',
#animations
'animate.blank.fast'=>'Blank(Fast)',
'animate.blank.slow'=>'Blank(Slow)',
'animate.bounce.top'=>'Bounce(Top)',
'animate.bounce.left'=>'Bounce(Left)',
'animate.bounce.right'=>'Bounce(Right)',
'animate.bounce.bottom'=>'Bounce(Bottom)',
'animate.jello.horizontal'=>'Jello(Horizontal)',
'animate.jello.vertical'=>'Jello(Vertical)',
'animate.pulse.heartbeat'=>'Pulse(Heartbeat)',
'animate.pulse.regular'=>'Pulse(Regular)',
'animate.pulse.ping'=>'Pulse(Ping)',
'animate.shake.horizontal'=>'Shake(Horizontal)',
'animate.shake.vertical'=>'Shake(Vertical)',
'animate.shake.rotate'=>'Shake(Rotate)',
'animate.shake.bottom'=>'Shake(Bottom)',
'animate.shake.left'=>'Shake(Left)',
'animate.shake.right'=>'Shake(Right)',
'animate.shake.top'=>'Shake(Top)',
'animate.scale.bottom'=>'Scale(Bottom)',
'animate.scale.center'=>'Scale(Center)',
'animate.scale.left'=>'Scale(Left)',
'animate.scale.right'=>'Scale(Right)',
'animate.scale.top'=>'Scale(Top)',
'animate.scale.horzcenter'=>'Scale(Horz Center)',
'animate.scale.horzleft'=>'Scale(Horz Left)',
'animate.scale.horzright'=>'Scale(Horz Right)',
'animate.scale.vertbottom'=>'Scale(Vert Bottom)',
'animate.scale.vertcenter'=>'Scale(Vert Center)',
'animate.scale.verttop'=>'Scale(Vert Top)',
'animate.rotate.bottom'=>'Rotate(Bottom)',
'animate.rotate.left'=>'Rotate(Left)',
'animate.rotate.right'=>'Rotate(Right)',
'animate.rotate.top'=>'Rotate(Top)',
'animate.slide.bottom'=>'Slide(Bottom)',
'animate.slide.left'=>'Slide(Left)',
'animate.slide.right'=>'Slide(Right)',
'animate.slide.top'=>'Slide(Top)',
'animate.swirl.bottom'=>'Swirl(Bottom)',
'animate.swirl.left'=>'Swirl(Left)',
'animate.swirl.right'=>'Swirl(Right)',
'animate.swirl.top'=>'Swirl(Top)',
#security
'csrf.privateHook'=>' is requesting to steal your private key! For security reasons, please remove it at ',
'csrf.generateHook'=>' is rewriting your key preventing! For security reasons, please remove it at ',
'csrf.tokenTheft'=>' is requesting/rewriting for user token! For security reasons, please remove it at ',
'csrf.fileAccess'=>' is requesting/rewriting for files! For security reasons, please remove it at ',
'csrf.apiKey'=>' is requesting for API key! For security reasons, please remove it at ',
'csrf.themeHook'=>' is using a non-valid file for theme! For security reasons, please remove it at ',
'csrf.themeFHook'=>' is using a non-valid folder for theme! For security reasons, please remove it at '
);
?>