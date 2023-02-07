<?php
$lang = array(
'lang'=>array(
'en-US'=>'English',
'de-DE'=>'Deutsch',
'it-IT'=>'Italiano',
'fr-FR'=>'Français',
'zh-CN'=>'中國人(傳統的)'
),
'sitemap.title'=>'WebPress-站點地圖',
'index.authdown'=> '授權',
'index.registerbtn'=>'創建賬戶 <i class="fas fa-user"></i>',
'index.forumbtn'=>'論壇 <i class="fa-duotone fa-comments"></i>',
'index.loginbtn'=>'登錄 <i class="fas fa-sign-in"></i>',
'index.dashboardbtn'=>'儀表板 <i class="fas fa-tachometer"></i>',
'index.loginoutbtn'=>'登出 <i class="fas fa-sign-out"></i>',
'index.noScript'=>'抱歉，Javascript 未激活，請激活它!',
'index.label.copyright'=>'版權',
'index.label.license'=>'並獲得許可',
'quote_direct'=>'點擊顯示原文',
'visible_for_logged'=>'您必須先登錄',
'visible_for_staff'=>'這僅供員工使用',
'visible_for_specific_user'=>'這僅適用於特定用戶',
'hide_show_more'=>'展示更多...',
'plural'=>'秒',
'posting_frame'=>'你必須在論壇上發帖',
'pro'=>'臨',
# 登記
'register.title'=>'創建賬戶',
'register.name'=>'你的名字',
'register.name.place'=>'輸入全名',
'register.user'=>'用戶名',
'register.user.place'=>'輸入用戶名',
'register.email'=>'電子郵件地址',
'register.email.place'=>'輸入有效的電子郵件地址',
'register.email.syntax'=>'必須是一個有效的E-mail地址',
'register.psw'=>'輸入密碼',
'register.psw.place'=>'輸入密碼',
'register.psw.repeat'=>'重新輸入密碼',
'register.psw.repeat.place'=>'重複輸入密碼',
'register.psw.syntax'=> '必須包括 1 個大寫字母、1 個小寫字母、1 個數字、8 個字符長',
'register.ts' => '我同意所有陳述 <a href="'.$conf['page']['termsandservice'].'" class="text-body"><u>服務條款</u></a>',
'register.submit'=>'報名',
'register.back'=>'後退',
'register.login'=>'登錄',
'register.err.exist'=>'此用戶名已存在',
'register.err.psw'=>'您必須有 1 個大寫字母、1 個小寫字母、1 個數字和 8 個字符',
'register.err.email'=>'您必須有一個有效的電子郵件地址',
'register.err.captcha'=>'無效輸入',
'register.sucs.user'=>'成功創建： ',
#登錄
'login.title'=>'登入帳戶',
'login.submit'=>'登錄',
'login.back'=>'後退',
'login.create'=>'登記',
'login.psw'=>'輸入密碼',
'login.err.user'=>'用戶名不存在',
'login.err.psw'=>'密碼不匹配',
'login.err.loggedin'=>'用戶名已存在。',
'login.user'=>'輸入用戶名',
'login.err.token'=>'令牌無效 <i>'.CSRF::check().'</i>',
'login.token'=>'私人令牌',
'login.token.place'=>'輸入私人令牌',
#授權
'auth.logout'=>'註銷',
'auth.logout.desc'=>'重定向到家',
#儀表板
'dashboard'=>'儀表板',
'dashboard.info.phpversion'=>'PHP版本',
'dashboard.info.projectName'=>'項目名稱',
'dashboard.info.projectVersion'=>'項目版本',
'dashboard.info.projectBuild'=>'項目建設',
'dashboard.info.serverSoftware'=>'服務器軟件',
'dashboard.info.phpModules'=>'PHP模塊',
'dashboard.info.memory'=>'記憶',
'dashboard.info.diskSpace'=>'磁盤空間',
'dashboard.info.dataStorage'=>'<em>數據</em>存儲',
'dashboard.info.uploadSize'=>'上傳最大尺寸',
'dashboard.config.panel.logger'=>'顯示控制台('.($conf['page']['panel']['console']!==(int)'-1' ? '最佳 <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="查看原始文本中的所有錯誤/警告" href="../debug.log">'.$conf['page']['panel']['console'].'</a>' : '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="custom-tooltip" title="警告：這可能會導致頁面延遲！"><span style="cursor:help;text-decoration:underline;color:blue;">全部</span></span>').')',
'dashboard.config.panel.catche'=>'清除緩存',
'dashboard.config.panel.bgcolor'=>'面板背景',
'dashboard.config.panel.color'=>'面板顏色',
'dashboard.config.panel.email'=>'自定義電子郵件域',
'dashboard.config.panel.editor'=>'編輯',
'dashboard.config.panel.theme'=>'主題',
'dashboard.config.panel.index'=>'默認索引',
'dashboard.config.panel.dateformat'=>'日期格式(<a href="https://www.php.net/manual/zh/datetime.format.php" target="_blank">php日期時間格式</a>)',
'dashboard.config.panel.emaildisabled'=>'You cannot change this, please upgrade',
'dashboard.config.panel.emailHelp'=>'Enter your custom domain to allow it',
'dashboard.config.panel.icons'=>'Website Logo',
'dashboard.config.timeZone.title'=>'<a href="https://www.php.net/manual/zh/timezones.php" target="_blank">時區 <i class="fa-solid fa-calendar-days"></i></a>',
'dashboard.userKey'=>'公鑰',
'dashboard.userKey.copy'=>'複製公鑰',
'dashboard.userPKey'=>'私鑰',
'dashboard.userPKey.copy'=>'複製私鑰',
'dashboard.hardwareid.copy'=>'複製硬件 ID',
'dashboard.title.phpinfo'=>'儀表板（PHP 信息）',
'dashboard.title.profile'=>'儀表板（配置文件）',
'dashboard.title.config'=>'儀表板（配置）',
'dashboard.title.docs'=>'儀表板（文檔）',
'dashboard.title.themes'=>'儀表板（主題）',
'dashboard.title.plugins'=>'儀表板（插件）',
'dashboard.title.console'=>'儀表板（控制台）',
'dashboard.title.editors'=>'儀表板（編輯器)',
'dashboard.title.mail'=>'儀表板（郵件）',
'dashboard.title.assets'=>'儀表板（資產）',
'dashboard.title.ban'=>'儀表板（禁止列表）',
'dashboard.title.roles'=>'儀表板（角色）',
'dashboard.title.files'=>'儀表板（文件）',
'dashboard.title.events'=>'儀表板（事件）',
'dashboard.title.pages'=>'儀表板（頁）',
'dashboard.title.view'=>'儀表板（查看插件）',
'dashboard.title.notFound'=>'儀表板（找不到頁面）',
'dashboard.desc'=>'歡迎來到 WebPress 面板！ 在這裡您可以為您的網頁、活動和非活動插件和主題配置和編輯文件/文件夾。 享受！',
'dashboard.logout'=>'登出',
'dashboard.redirect.logout.title'=>'註銷',
'dashboard.redirect.logout.desc'=>'重定向到登錄',
'dashboard.side'=>'WebPress 菜單',
'dashboard.side.welcome.morn'=>'<span style="color:#f7cd5d;">早上好'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunrise"></i></span>',
'dashboard.side.welcome.after'=>'<span style="color:#fce570;">下午好'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sun"></i></span>',
'dashboard.side.welcome.even'=>'<span style="color:#fad6a5;">晚上好'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunset"></i></span>',
'dashboard.side.welcome.night'=>'<span style="color:#003833;">晚安'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-moon"></i></span>',
'dashboard.side.weather'=>'天氣',
'dashboard.side.home'=>'家 <i class="fas fa-house"></i>',
'dashboard.side.back'=>'儀表板 <i class="fas fa-tachometer"></i>',
'dashboard.side.forum'=>'論壇 <i class="fa-duotone fa-comments"></i>',
'dashboard.side.phpinfo'=>'PHP 資料 <i class="fa-brands fa-php"></i>',
'dashboard.side.profile'=>'輪廓 <i class="fas fa-user"></i>',
'dashboard.side.config'=>'配置 <i class="fas fa-sliders-h"></i>',
'dashboard.side.docs'=>'文檔 <i class="fas fa-file-alt"></i>',
'dashboard.side.themes'=>'主題 <i class="fas fa-paint-brush"></i>',
'dashboard.side.plugins'=>'插件 &nbsp;&nbsp;<i class="fas fa-plug" style="transform:rotate(-45deg);"></i>',
'dashboard.side.console'=>'安慰 <i class="fas fa-terminal"></i>',
'dashboard.side.editors'=>'編輯部 <i class="fas fa-pen-square"></i>',
'dashboard.side.assets'=>'資產 <i class="fa-solid fa-books"></i>',
'dashboard.side.mail'=>'郵件 <i class="fas fa-envelope"></i>',
'dashboard.side.ban'=>'禁令名單 <i class="fa-solid fa-ban"></i>',
'dashboard.side.roles'=>'角色 <i class="fa-solid fa-user-plus"></i>',
'dashboard.side.files'=>'文件 <i class="fa-solid fa-files"></i>',
'dashboard.side.events'=>'事件 <i class="fa-regular fa-calendar-lines-pen"></i>',
'dashboard.side.pages'=>'頁數 <i class="fa-solid fa-page"></i>',
'dashboard.graph.user.label'=>'用戶',
'dashboard.graph.user.y'=>'註冊用戶',
'dashboard.graph.subtitle'=>'這將在 ',
'dashboard.graph.views.label'=>'觀點',
'dashboard.graph.views.unique'=>'獨特',
'dashboard.graph.forums.label'=>'論壇',
'dashboard.graph.forums.y'=>'主題/回複數',
'dashboard.graph.forums.topics'=>'主題',
'dashboard.graph.forums.replies'=>'回复',
'dashboard.graph.views.y'=>'網頁瀏覽量',
'dashboard.profile.title'=>'關於用戶',
'dashboard.profile.hardwareID'=>'硬件編號: ',
'dashboard.profile.about'=>'<b>關於: </b>',
'dashboard.profile.timezone'=>'<b>時區: </b>',
'dashboard.profile.ip'=>'<b>知識產權: </b>',
'dashboard.profile.location'=>'<b>地點: </b>',
'dashboard.profile.created'=>'<b>已創建: </b>',
'dashboard.profile.email'=>'<b>電子郵件: </b>',
'dashboard.profile.name'=>'<b>名稱: </b>',
'dashboard.profile.topics'=>'<b class="text-secondary">主題: </b>',
'dashboard.profile.replys'=>'<b class="text-secondary">回复: </b>',
'dashboard.profile.forums'=>'<b class="text-secondary">論壇: </b>',
'dashboard.pageLoaded'=>'<b class=\'text-secondary\'>已加載: </b>',
'dashboard.profile.editbtn'=>'編輯個人資料',
'dashboard.profile.addBan'=>'禁止用戶',
'dashboard.config.title'=>'配置',
'dashboard.config.pageError.title'=>'頁面錯誤（允許HTML+MD）:',
'dashboard.config.page.title'=>'網頁標題',
'dashboard.config.lang.title'=>'語言',
'dashboard.config.400'=>'錯誤的請求',
'dashboard.config.401'=>'授權',
'dashboard.config.403'=>'禁止',
'dashboard.config.404'=>'網頁未找到',
'dashboard.config.500'=>'國際錯誤',
'dashboard.config.301.help'=>'留空不包括它',
'dashboard.config.debug.title'=>'調試',
'dashboard.config.seo.title'=>'搜索引擎優化工具 <i class="fas fa-tools"></i>',
'dashboard.config.description'=>'輸入網頁描述 <i class="fas fa-edit"></i>',
'dashboard.config.author'=>'作者 <i class="fas fa-at"></i>',
'dashboard.config.refresh'=>'自動刷新 <i class="fas fa-sync"></i>',
'dashboard.config.refresh.help'=>'將值設置為 0 不使用自動刷新',
'dashboard.config.keywords'=>'輸入關鍵字 <i class="fas fa-spell-check"></i>',
'dashboard.config.keywords.help'=>'使用逗號(,)來使用多個關鍵字',
'dashboard.config.robotIndex.title'=>'允許機器人索引您的網站？ <i class="fas fa-robot"></i>',
'dashboard.config.robotFollow.title'=>'允許機器人跟踪所有鏈接？ <i class="fas fa-external-link"></i>',
'dashboard.config.rate.title'=>'評分 <i class="fas fa-star"></i>',
'dashboard.config.rate'=>array(
'null'=>'未標明',
'14_years'=>'14年',
'adult'=>'成人',
'general'=>'一般的',
'mature'=>'成熟',
'restricted'=>'受限制的',
'safe_for_kids'=>'對孩子安全'
),
'dashboard.config.copyright'=>'版權 <i class="fas fa-copyright"></i>',
'dashboard.config.distribution.title'=>'分配 <i class="fas fa-chart-network"></i>',
'dashboard.config.distribution'=>array(
'Global'=>'全球的',
'Local'=>'當地的'
),
'dashboard.config.revisted.title'=>'重訪後 <i class="fas fa-exchange"></i>',
'dashboard.config.revisted'=>array(
'1_Day'=>'1 天',
'7_Days'=>'7 天',
'31_Days'=>'31 天',
'180_Days'=>'180 天',
'360_Days'=>'360 天'
),
'dashboard.config.charset.title'=>'字符集 <i class="fas fa-file-times"></i>',
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
'UTF-8'=>'UTF-8 (推薦的)',
'other'=>'其他'
),
'dashboard.config.captch'=>'驗證碼',
'dashboard.pageError'=>'網頁未找到！',
'dashboard.config.forum.title'=>'論壇 <i class="fa-solid fa-comments"></i>',
'dashboard.config.forum.topic'=>'顯示主題量',
'dashboard.config.forum.reply'=>'顯示回復量',
# 模態的
'modal.profile'=>'編輯個人資料',
'modal.profile.username'=>'輸入用戶名',
'modal.profile.name'=>'輸入名字',
'modal.profile.oldpsw'=>'舊密碼',
'modal.profile.newpsw'=>'輸入新密碼',
'modal.profile.delete'=>'刪除帳戶',
'modal.profile.newpsw.note'=>'必須有舊密碼',
'modal.profile.about'=>'關於你自己',
'modal.profile.upload'=>'上傳徽標（僅限 PNG 文件）',
'modal.profile.err.user'=>'此用戶名已存在',
'modal.pedit.title'=>'保存數據',
'modal.failed.title'=>'失敗數據',
'modal.pedit.desc'=>'保存編輯的數據',
'modal.pedit.psw.format'=>'您必須有 1 個大寫字母、1 個小寫字母、1 個數字和 8 個字符',
'modal.pedit.psw.match'=>'密碼不匹配',
'modal.pedit.psw.otn'=>'舊密碼與新密碼不匹配',
'modal.profile.removeAvatar'=>'刪除頭像',

#配置
'config'=>'配置 ',
'config.label'=>'配置 ',
'config.save'=>'救 <i class="fas fa-save"></i>',
'config.failed'=>'保存數據失敗',
'config.success'=>'成功保存數據',
'config.true'=>'在',
'config.false'=>'離開',
#鈕扣
'btn.disabled'=>'您不能使用此選項',
'btn.drop.actions.title'=>'動作',
'btn.drop.copy.url'=>'複製網址 <i class="fas fa-link"></i>',
'btn.drop.copy.msg'=>'複製消息 <i class="fas fa-copy"></i>',
'btn.download'=>'下載 <i class=\'fas fa-download\'></i>',
'btn.save'=>'保存更改',
'btn.close'=>'關閉',
'btn.dismissed'=>'解僱',
'btn.confirm'=>'確認',
'btn.quote'=>'<i class="fa-solid fa-comment-quote"></i> 引用',
'btn.delete'=>'消除',
# 主題
'theme.active'=>'活性 <i class="fas fa-check"></i>',
'theme.deactive'=>'停用 <i class="fas fa-times"></i>',
'theme.error.missingName'=>'缺少姓名',
'theme.error.missingDesc'=>'缺少說明',
'theme.allow.lang'=>'允許的語言： ',
'theme.allow.lang.null'=>'不明確的',
'theme.missing'=>'缺少主題配置文件！',
# 插件
'plugin.active'=>'活性 <i class="fas fa-check"></i>',
'plugin.deactive'=>'停用 <i class="fas fa-times"></i>',
'plugin.error.missingName'=>'缺少姓名',
'plugin.error.missingDesc'=>'缺少說明',
'plugin.allow.lang'=>'允許的語言： ',
'plugin.allow.lang.null'=>'不明確的',
'plugin.pluginUpdated'=>'最近更新時間： ',
#調試
'debug.off'=>'<a href="./configs">調試</a> 關閉後，您將無法再記錄任何功能錯誤。',
# 接觸
'contact.title'=>'接觸',
'contact.email'=>'<i class="fas fa-asterisk text-danger"></i> 電子郵件',
'contact.email.placeholder'=>'輸入您的電子郵件地址',
'contact.emailto'=>'<i class="fas fa-asterisk text-danger"></i> 到:',
'contact.emailto.placeholder'=>'輸入人的電子郵件地址：（使用 \',\' 分隔）',
'contact.to.example'=>'示例：用戶 1：<{user1email}>，用戶 2：<{user2email}>...',
'contact.senderAs'=>'發送為',
'contact.name'=>'<i class="fas fa-asterisk text-danger"></i> 名稱',
'contact.name.placeholder'=>'輸入全名',
'contact.subject'=>'<i class="fas fa-asterisk text-danger"></i> 主題',
'contact.subject.placeholder'=>'輸入主題',
'contact.msg'=>'<i class="fas fa-asterisk text-danger"></i> 信息',
'contact.msg.placeholder'=>'輸入消息',
'contact.send'=>'發信息',
'contact.markasread'=>'標記為已讀',
'contact.markasunread'=>'標記為未讀',
'contact.reply'=>'回复',
'contact.readme'=>'讀',
'contact.hidden'=>'這是僅針對特定用戶的隱藏消息!',
'contact.option.all'=>'全部',
'contact.msg.exists'=>'消息已存在',
'report'=>'<i class="fa-solid fa-bell"></i> 報告',
'contact.report.prioiry'=>'<i class="fas fa-asterisk text-danger"></i> 優先',
'contact.report'=>'舉報用戶',
'contact.report.label'=>'[在這裡輸入推理]',
# 郵件
'mail.success'=>'成功發送郵件至 ',
'mail.failed'=>'發送郵件失敗 ',
# 通知
'notify.clear'=>'標記為已讀',
# 形式
'errLen' => '太短/太長',
'errNb' => '這不是一個正整數',
'ErrContentFilter' => '您至少插入了一個被刪減的詞，請保持禮貌。',
'tableHeader'=>'標頭',
'form_active'=>'開關',
# 資產
'assets.title'=>'資產',
# 禁令名單
'ban.empty'=>'沒有用戶被禁止',
'ban.request'=>'請求上訴',
'ban.remove'=>'消除',
'ban.add'=>'添加用戶',
'ban.table'=>array(
'username'=>'用戶名',
'time'=>'發布日期',
'duration'=>'期間',
'reason'=>'原因',
'bannedBy'=>'禁止者',
'actions'=>'動作',
),
'ban.list'=>array(
'1min'=>'+1 分鐘',
'3min'=>'+3 分鐘',
'5min'=>'+5 分鐘',
'7min'=>'+7 分鐘',
'9min'=>'+9 分鐘',
'11min'=>'+11 分鐘',
'13min'=>'+13 分鐘',
'15min'=>'+15 分鐘',
'17min'=>'+17 分鐘',
'19min'=>'+19 分鐘',
'21min'=>'+21 分鐘',
'23min'=>'+23 分鐘',
'25min'=>'+25 分鐘',
'27min'=>'+27 分鐘',
'29min'=>'+29 分鐘',
'31min'=>'+31 分鐘',
'33min'=>'+33 分鐘',
'35min'=>'+35 分鐘',
'37min'=>'+37 分鐘',
'39min'=>'+39 分鐘',
'41min'=>'+41 分鐘',
'43min'=>'+43 分鐘',
'45min'=>'+45 分鐘',
'47min'=>'+47 分鐘',
'49min'=>'+49 分鐘',
'51min'=>'+51 分鐘',
'53min'=>'+53 分鐘',
'55min'=>'+55 分鐘',
'57min'=>'+57 分鐘',
'59min'=>'+59 分鐘',
'1h'=>'+1 小時',
'3h'=>'+3 小時',
'5h'=>'+5 小時',
'7h'=>'+7 小時',
'9h'=>'+9 小時',
'11h'=>'+11 小時',
'13h'=>'+13 小時',
'15h'=>'+15 小時',
'17h'=>'+17 小時',
'19h'=>'+19 小時',
'21h'=>'+21 小時',
'23h'=>'+23 小時',
'1d'=>'+1 天',
'3d'=>'+3 天',
'5d'=>'+5 天',
'1w'=>'+1 星期',
'3w'=>'+3 週',
'1m'=>'+1 月',
'3m'=>'+3 月',
'5m'=>'+5 月',
'7m'=>'+7 月',
'9m'=>'+9 月',
'11m'=>'+11 月',
'1y'=>'+1 年',
'3y'=>'+3 年',
'5y'=>'+5 年',
'7y'=>'+7 年',
'9y'=>'+9 年',
'11y'=>'+11 年',
'13y'=>'+13 年',
'15y'=>'+15 年',
'17y'=>'+17 年',
'19y'=>'+19 年',
'21y'=>'+21 年',
'23y'=>'+23 年',
'25y'=>'+25 年',
'27y'=>'+27 年',
'29y'=>'+29 年',
'31y'=>'+31 年',
'forever'=>'永遠'
),
'ban.byList'=>array(
'username'=>'用戶名',
'ip'=>'知識產權',
'hardwareid'=>'硬件編號'
),
'ban.forever'=>'永遠',
'ban.UI.title'=>'禁止用戶',
'ban.UI.username'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> 用戶名',
'ban.UI.time'=>'時間',
'ban.UI.reason'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> 原因',
'ban.UI.banBy'=>'禁令類型',
'ban.UI.submit'=>'禁止用戶',
# 上傳
'upload.failed.data'=>'無法接收數據',
'upload.failed.large'=>'抱歉，您的文件太大',
'upload.failed.extentions'=>'抱歉，您的文件不是有效的擴展名',
'upload.failed.overrule'=>'抱歉，您的文件已經存在',
'upload.failed'=>'抱歉，您的文件未上傳。',
'upload.failed.rename'=>'重命名失敗',
'upload.success'=>array('文件 '.(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on' ? 'https://':'http://').$_SERVER['HTTP_HOST'].'/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/uploads/', '已上傳.', 'avatars/'),
# 角色
'roles.user'=>'用戶名',
'roles.roleID'=>'角色類型',
'roles.edit'=>'編輯角色',
'roles.roleSelect'=>'選擇角色',
'roles.createRole'=>'創建角色',
'roles.input.name'=>'角色名稱',
'roles.input.desc'=>'角色描述',
'roles.input.canView'=>'可以查看',
'roles.input.canWrite'=>'會寫',
'roles.input.canRead'=>'可以閱讀',
'roles.input.canDelete'=>'可以刪除',
'roles.input.canBan'=>'可以禁止',
'roles.input.canPost'=>'可以郵寄',
'roles.input.canReply'=>'可以回复',
'roles.input.canMsg'=>'可以留言',
'roles.input.plugins'=>'可以激活插件',
'roles.input.themes'=>'可以激活主題',
'roles.input.config'=>'可以配置',
'roles.input.canRole'=>'可以改變角色',
'roles.input.file'=>'可以使用文件管理器',
'roles.input.profile'=>'可以更改個人資料',
'roles.input.events'=>'可以查看事件',
'roles.input.pages'=>'可以編輯頁面',
'roles.deleteRole'=>'刪除角色',
'roles.removeItems'=>'選擇刪除角色',
# 文件
'file.locked.folder'=>'此文件夾已鎖定',
'file.locked.file'=>'此文件已鎖定',
'file.manager.title'=>'文件管理器',
'file.managerchmod.title'=>'更改權限',
'file.managerchmod.u'=>'更改權限',
'file.managerchmod.g'=>'組權限',
'file.managerchmod.o'=>'其他權利',
'file.managerchmod.read'=>'讀(4)',
'file.managerchmod.write'=>'寫(2)',
'file.managerchmod.execute'=>'執行(1)',
'files.delete'=>'刪除文件',
'files.chmod'=>'更改文件權限',
'files.rename'=>'重新命名文件',
'files.remove.msg'=>'你想刪除 ',
'files.rename.msg'=>'重新命名文件',
'file.rename.newName'=>'新名字:',
'file.rename.oldName'=>'舊名稱:',
'file.manager.createFile'=>'<i class="fa-solid fa-file-plus"></i> 創建文件',
'file.manager.createFolder'=>'<i class="fa-solid fa-folder-plus"></i> 創建文件夾',
'file.manager.upload'=>'<i class="fa-solid fa-upload"></i> 上傳',
'files.addFile.msg'=>'添加文件',
'files.addFolder.msg'=>'新增文件夾',
'files.download'=>'下載文件',
'file.manager.fileUpload'=>'在此處上傳文件： ',
'file.manager.folderUpload'=>'在此處上傳文件夾： ',
'files.uploadFiles.msg'=>'上傳文件',
'files.manager.saved'=>'文件已成功保存，正在重新加載頁面以更新文件...',
'files.manager.error'=>'錯誤：無法保存文件，正在重新加載頁面以更新文件...',
#期望
'expect.lang'=>'你必須有 '.$conf['lang'].'.php',
'expect.guest'=>'<i class="fa-solid fa-triangle-exclamation"></i> 您處於訪客模式，您只能閱讀/查看/註冊/登錄，請<a href="./auth.php/login">登錄</a>或<a href="./auth.php /register">註冊</a>一個賬號',
'expect.requiements'=>'所有必需的表格項目都是必需的！',
#論壇
'forum.title'=>'論壇',
'forum.author'=>'由...製作: ',
'forum.sidebar'=>'論壇',
'forum.addForum'=>'添加論壇',
'forum.addTopic'=>'添加主題',
'forum.editTopic'=>'編輯主題',
'forum.created'=>'已創建: ',
'forum.edited'=>'最後編輯: ',
'forum.search.failed'=>'沒有找到搜索結果',
'forum.replys'=>'回复&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>',
'forum.view'=>'看法&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>',
'forum.replysNoIcon'=>'回复',
'forum.editBtn'=>'<i class="fa-solid fa-pen-to-square"></i> 編輯',
'forum.removeBtn'=>'<i class="fa-solid fa-trash-can"></i> 刪除',
'forum.anonumous'=>'系統',
'forum.inputForumName'=>'論壇名稱',
'forum.inputForumColor'=>'輸入顏色',
'forum.selectIcon'=>'選擇圖標',
'forum.inputTopicName'=>'主題名稱',
'forum.inputTopicCategory'=>'選擇論壇',
'forum.entermsg'=>'輸入消息',
'forum.inputTopicAuthor'=>'作者',
'forum.inputTopicTags'=>'輸入標籤（使用 , 分隔）',
'forum.deleteTopic'=>'刪除主題',
'forum.pinned'=>'置頂',
'forum.locked'=>'鎖定',
'forum.toggleOpt'=>array(
	'false'=>'不',
	'true'=>'是的'
),
'fourm.guest'=>'登錄後在論壇回复',
'forum.recent'=>'最近的活動',
'forum.anchorID'=>'複製回复 ID',
'forum.userStatus'=>'地位',
'forum.sidebar.statistics'=>'統計數據',
'forum.reply_drop'=>'發表回复',
'forum.noreply'=>'您沒有回復權限！',
'forum.home'=>'家',
'forum.category'=>'論壇',
'forum.shortSubmit'=>'排序項目',
'forum.sort'=>'對您的論壇進行排序<b><em>（不要有多個主題具有相同的編號）</em></b>',
'forum.sortUser'=>'請以管理員身份登錄以使用此選項',
# 事件
'events.ip'=>'知識產權',
'events.date'=>'日期',
'events.target'=>'目標',
'events.stat'=>'地位',
'events.action'=>'行動',
#頁數
'pages.form.notice'=>'使用塊接收表單提交不起作用。 您必須使用"Action"屬性來接收數據。 最大 5MB/頁',
# 積木
'blocks.title'=>'拖放塊以構建網站',
'blocks.jsonInfo'=>'這將顯示一個 JSON 構建，可以根據您的頁面結構對其進行編輯。',
'blocks.moveUp'=>'<i class="fa-solid fa-up"></i> 提升',
'blocks.moveDown'=>'<i class="fa-solid fa-down"></i> 下移',
'blocks.remove'=>'<i class="fa-solid fa-trash-can"></i> 刪除',
'blocks.reload'=>'<i class="fa-solid fa-rotate-right"></i> 重新加載',
'blocks.id'=>'<i class="fa-solid fa-id-card"></i> ID',
'blocks.id.prompt'=>'輸入ID，類型 &quote;取消&quote; 取消，否則會刪除ID',
'blocks.classes'=>'<i class="fa-solid fa-code-branch"></i> 班級',
'blocks.class.prompt'=>'輸入類，鍵入 &quote;取消&quote; 取消，否則將刪除類',
'blocks.href'=>'<i class="fa-solid fa-link"></i> 插入鏈接',
'blocks.href.prompt'=>'輸入鏈接，輸入 &quote;取消&quote; 取消，否則將刪除鏈接',
'blocks.hrefTar.prompt'=>'輸入目標：\n1。 自我\n2. 空白\n3. 家長\n4. 最佳',
'blocks.RemHref'=>'<i class="fa-solid fa-link-slash"></i> 刪除鏈接',
'blocks.Bold'=>'<i class="fa-solid fa-bold"></i> 膽大',
'blocks.Italic'=>'<i class="fa-solid fa-italic"></i> 斜體',
'blocks.Strike'=>'<i class="fa-solid fa-strikethrough"></i> 刪除線',
'blocks.style'=>'<i class="fa-solid fa-palette"></i> 風格',
'blocks.Underline'=>'<i class="fa-solid fa-underline"></i> 強調',
'blocks.removeFormat'=>'<i class="fa-solid fa-text-slash"></i> 刪除格式',
'blocks.insert'=>'<i class="fa-solid fa-plus"></i> 插入',
'blocks.actions'=>'動作',
'blocks.blockAction'=>'積木',
'blocks.wordActions'=>'字',
'blocks.removal'=>'移動',
'blocks.page.title'=>'添加頁面',
'blocks.page.name'=>'輸入頁面名稱',
'blocks.settings'=>'設置',
'blocks.settings.bg'=>'背景',
'blocks.settings.solid.color'=>'純色',
'blocks.settings.bg.img'=>'上傳圖片',
'blocks.settings.custom.color'=>'自定義顏色',
'blocks.settings.bgBlock.body'=>'身體',
'blocks.settings.bgBlock.target'=>'選定的塊',
'blocks.customcolor'=>'自定義顏色（查看純色以使用）',
'blocks.bgImage'=>'輸入圖片網址',
'blocks.settings.color'=>'字體顏色',
'blocks.settings.align'=>'文本對齊',
'blocks.settings.padding'=>'填充',
'blocks.settings.margin'=>'利潤',
'blocks.settings.display'=>'展示',
'blocks.settings.flex'=>'柔性',
'blocks.settings.flexWrap'=>'軟包',
'blocks.settings.flexDir'=>'彎曲方向',
'blocks.settings.flexGrow'=>'靈活成長',
'blocks.settings.flexShrink'=>'彈性收縮',
'blocks.settings.flexBiases'=>'彈性基礎',
'blocks.settings.fontSize'=>'字體大小',
'blocks.settings.border'=>'邊界',
'blocks.settings.borderBLRadius'=>'左下半徑',
'blocks.settings.borderBRRadius'=>'右下半徑',
'blocks.settings.borderTLRadius'=>'左上半徑',
'blocks.settings.borderTRRadius'=>'右上半徑',
'blocks.settings.boxShadow'=>'框影',
'blocks.settings.textShadow'=>'文字陰影',
'blocks.settings.boxShadow.h'=>'H陰影',
'blocks.settings.boxShadow.v'=>'V影',
'blocks.settings.boxShadow.blur'=>'模糊',
'blocks.settings.boxShadow.spread'=>'傳播',
'blocks.settings.boxShadow.color'=>'顏色',
'blocks.settings.boxShadow.inset'=>'插圖',
'blocks.settings.animation'=>'動畫',
'blocks.settings.animation.list'=>'選擇動畫',
'blocks.settings.animation.timing'=>'計時功能',
'blocks.settings.animation.direction'=>'方向',
'blocks.settings.animation.fillMode'=>'填充模式',
'blocks.settings.animation.duration'=>'期間',
'blocks.settings.animation.delay'=>'延遲',
'blocks.settings.animation.count'=>'迭代次數，(-1) - 無限',
'blocks.settings.blockWidth'=>'塊寬度',
'blocks.settings.blockHeight'=>'區塊高度',
'blocks.settings.pos'=>'位置',
'blocks.settings.transform'=>'轉換',
'blocks.settings.textTransform'=>'文本轉換',
'blocks.settings.textDirection'=>'文字方向',
'blocks.settings.top'=>'最佳',
'blocks.settings.right'=>'正確的',
'blocks.settings.bottom'=>'底部',
'blocks.settings.left'=>'剩下',
'blocks.settings.none'=>'沒有任何',
'blocks.settings.scripts'=>'腳本',
'blocks.settings.formConfig'=>'表單配置',
'blocks.settings.required'=>'必需的',
'blocks.settings.readOnly'=>'只讀',
'blocks.settings.disabled'=>'殘疾人',
'blocks.settings.regexp'=>'圖案',
'blocks.usage'=>'如何使用:
<ul class="list-group list-group-numbered">
<li class="list-group-item">右鍵單擊塊以使用上下文菜單。</li>
<li class="list-group-item"><em>操作</em>可以影響塊順序和頁面。</li>
<li class="list-group-item"><em>塊</em>影響整個塊，一鍵點擊</li>
<li class="list-group-item"><em>Words</em> 可以通過<q>雙擊/突出顯示</q>塊中的單詞來影響單詞/塊。</li>
<li class="list-group-item"><em>Remove Format</em> 移除塊的頂層</li>
<li class="list-group-item"><em>Delete</em> 刪除整個塊。</li>
</ul>',
#動畫
'animate.blank.fast'=>'空白（快速）',
'animate.blank.slow'=>'空白（慢）',
'animate.bounce.top'=>'彈跳（上）',
'animate.bounce.left'=>'彈跳（左）',
'animate.bounce.right'=>'彈跳（右）',
'animate.bounce.bottom'=>'反彈（底部）',
'animate.jello.horizontal'=>'果凍（水平）',
'animate.jello.vertical'=>'果凍（垂直）',
'animate.pulse.heartbeat'=>'脈衝（心跳）',
'animate.pulse.regular'=>'脈衝（常規）',
'animate.pulse.ping'=>'脈衝（平）',
'animate.shake.horizontal'=>'搖動（水平）',
'animate.shake.vertical'=>'搖動（垂直）',
'animate.shake.rotate'=>'搖動（旋轉）',
'animate.shake.bottom'=>'搖一搖（下）',
'animate.shake.left'=>'搖一搖（左）',
'animate.shake.right'=>'搖動（右）',
'animate.shake.top'=>'搖一搖（上）',
'animate.scale.bottom'=>'規模（底部）',
'animate.scale.center'=>'刻度（中心）',
'animate.scale.left'=>'規模（左）',
'animate.scale.right'=>'比例（右）',
'animate.scale.top'=>'規模（上）',
'animate.scale.horzcenter'=>'規模（水平中心）',
'animate.scale.horzleft'=>'比例尺（水平向左）',
'animate.scale.horzright'=>'比例尺（水平向右）',
'animate.scale.vertbottom'=>'比例（垂直底部）',
'animate.scale.vertcenter'=>'比例（垂直中心）',
'animate.scale.verttop'=>'規模（垂直頂部）',
'animate.rotate.bottom'=>'旋轉（底部）',
'animate.rotate.left'=>'向左旋轉）',
'animate.rotate.right'=>'右旋）',
'animate.rotate.top'=>'旋轉（上）',
'animate.slide.bottom'=>'幻燈片（底部）',
'animate.slide.left'=>'滑動(左)',
'animate.slide.right'=>'滑動(右)',
'animate.slide.top'=>'幻燈片（上）',
'animate.swirl.bottom'=>'漩渦（底部）',
'animate.swirl.left'=>'漩渦（左）',
'animate.swirl.right'=>'漩渦（右）',
'animate.swirl.top'=>'漩渦（上）'
);
?>