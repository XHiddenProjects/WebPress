<?php
$lang = array(
'lang'=>array(
'en-US'=>'English',
'de-DE'=>'Deutsch',
'it-IT'=>'Italiano',
'fr-FR'=>'Français',
'zh-CN'=>'中國人(傳統的)',
'ru-RU'=>'Русский'
),
'sitemap.title'=>'WebPress-карты сайта',
'index.authdown'=> 'Авторизация',
'index.registerbtn'=>'Зарегистрироваться <i class="fas fa-user"></i>',
'index.forumbtn'=>'Форум <i class="fa-duotone fa-comments"></i>',
'index.loginbtn'=>'Авторизоваться <i class="fa-solid fa-right-to-bracket"></i>',
'index.dashboardbtn'=>'Панель приборов <i class="fa-solid fa-gauge-min"></i>',
'index.loginoutbtn'=>'Выйти <i class="fa-solid fa-sign-out"></i>',
'index.noScript'=>'К сожалению, Javascript не активирован, пожалуйста, активируйте его!',
'index.label.copyright'=>'Авторские права',
'index.label.license'=>'и Лицензировано',
'quote_direct'=>'Нажмите, чтобы показать оригинал',
'visible_for_logged'=>'Вы должны быть зарегистрированы',
'visible_for_staff'=>'Это только для персонала',
'visible_for_specific_user'=>'Это только для конкретного пользователя',
'hide_show_more'=>'Показать больше...',
'plural'=>'с',
'posting_frame'=>'Вы должны опубликовать это на форуме',
'pro'=>'Про',
# регистр
'register.title'=>'Зарегистрироваться',
'register.name'=>'Ваше имя',
'register.name.place'=>'Введите полное имя',
'register.user'=>'Имя пользователя',
'register.user.place'=>'Введите имя пользователя',
'register.email'=>'Адрес электронной почты',
'register.email.place'=>'Введите действительный адрес электронной почты',
'register.email.syntax'=>'Адрес эл. почты должен быть действительным',
'register.psw'=>'Введите пароль',
'register.psw.place'=>'Введите пароль',
'register.psw.repeat'=>'Повторно введите пароль',
'register.psw.repeat.place'=>'Повторите пароль',
'register.psw.syntax'=> 'Должен содержать 1 прописную, 1 строчную, 1 цифру, 8 символов в длину.',
'register.ts' => 'Я согласен со всеми утверждениями в <a href="'.$conf['page']['termsandservice'].'" class="text-body"><u>Условия использования</u></a>',
'register.submit'=>'Зарегистрироваться',
'register.back'=>'Назад',
'register.login'=>'Авторизоваться',
'register.err.exist'=>'Имя пользователя уже занято',
'register.err.psw'=>'У вас должен быть 1 верхний регистр, 1 нижний регистр, 1 цифра и 8 символов.',
'register.err.email'=>'У вас должен быть действующий адрес электронной почты',
'register.err.captcha'=>'Неверная капча',
'register.sucs.user'=>'Успешно создано: ',
#авторизоваться
'login.title'=>'Войти в аккаунт',
'login.submit'=>'Авторизоваться',
'login.back'=>'Назад',
'login.create'=>'регистр',
'login.psw'=>'Введите пароль',
'login.err.user'=>'Имя пользователя не существует',
'login.err.psw'=>'Пароль не подходит',
'login.err.loggedin'=>'Имя пользователя уже используется.',
'login.user'=>'Введите имя пользователя',
'login.err.token'=>'Неверный токен <i>'.CSRF::check().'</i>',
'login.token'=>'Частный токен',
'login.token.place'=>'Введите личный токен',
#авторизация
'auth.logout'=>'Выход',
'auth.logout.desc'=>'Перенаправление на главную',
#панель приборов
'dashboard'=>'Панель приборов',
'dashboard.info.phpversion'=>'PHP-версия',
'dashboard.info.projectName'=>'название проекта',
'dashboard.info.projectVersion'=>'Версия проекта',
'dashboard.info.projectBuild'=>'Сборка проекта',
'dashboard.info.serverSoftware'=>'Серверное программное обеспечение',
'dashboard.info.phpModules'=>'PHP-модули',
'dashboard.info.memory'=>'Память',
'dashboard.info.diskSpace'=>'Дисковое пространство',
'dashboard.info.dataStorage'=>'Хранилище <em>ДАННЫХ</em>',
'dashboard.info.uploadSize'=>'Загрузить максимальный размер',
'dashboard.config.panel.logger'=>'Показать консоль('.($conf['page']['panel']['console']!==(int)'-1' ? 'Вершина <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="Просмотр всех ошибок/предупреждений в необработанном тексте" href="../debug.log">'.$conf['page']['panel']['console'].'</a>' : '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="custom-tooltip" title="Предупреждение: это может привести к задержке страницы!"><span style="cursor:help;text-decoration:underline;color:blue;">Все</span></span>').')',
'dashboard.config.panel.catche'=>'Очистить кэш',
'dashboard.config.panel.bgcolor'=>'Фон панели',
'dashboard.config.panel.color'=>'Цвет панели',
'dashboard.config.panel.email'=>'Пользовательский домен электронной почты',
'dashboard.config.panel.editor'=>'редактор',
'dashboard.config.panel.theme'=>'Темы',
'dashboard.config.panel.index'=>'Индекс по умолчанию',
'dashboard.config.panel.dateformat'=>'Формат даты(<a href="https://www.php.net/manual/en/datetime.format.php" target="_blank">формат даты и времени в php</a>)',
'dashboard.config.panel.emaildisabled'=>'Вы не можете изменить это, пожалуйста, обновите',
'dashboard.config.panel.emailHelp'=>'Введите свой личный домен, чтобы разрешить его',
'dashboard.config.panel.icons'=>'Логотип веб-сайта',
'dashboard.config.timeZone.title'=>'<a href="https://www.php.net/manual/en/timezones.php" target="_blank">Часовой пояс <i class="fa-solid fa-calendar-days"></i></a>',
'dashboard.config.security.title'=>'Безопасность <i class="fa-solid fa-shield-halved"></i>',
'dashboard.config.security.list'=>['flexible'=>'гибкий', 'moderate'=>'умеренный', 'strict'=>'строгий'],
'dashboard.userKey'=>'Открытый ключ',
'dashboard.userKey.copy'=>'Скопировать открытый ключ',
'dashboard.userPKey'=>'Закрытый ключ',
'dashboard.userPKey.copy'=>'Скопировать закрытый ключ',
'dashboard.hardwareid.copy'=>'Копировать идентификатор оборудования',
'dashboard.title.phpinfo'=>'Панель инструментов(информация PHP)',
'dashboard.title.profile'=>'Панель инструментов(профиль)',
'dashboard.title.config'=>'Панель управления(конфигурация)',
'dashboard.title.docs'=>'Панель управления(Документы)',
'dashboard.title.themes'=>'Панель инструментов(темы)',
'dashboard.title.plugins'=>'Панель инструментов(плагины)',
'dashboard.title.console'=>'Панель управления(консоль)',
'dashboard.title.editors'=>'Панель инструментов(редакторы)',
'dashboard.title.mail'=>'Панель инструментов(почта)',
'dashboard.title.assets'=>'Панель инструментов(активы)',
'dashboard.title.ban'=>'Панель инструментов(список банов)',
'dashboard.title.roles'=>'Панель инструментов(роли)',
'dashboard.title.files'=>'Панель инструментов(файлы)',
'dashboard.title.events'=>'Панель инструментов(события)',
'dashboard.title.pages'=>'Панель инструментов(страницы)',
'dashboard.title.view'=>'Панель инструментов(Просмотр плагина)',
'dashboard.title.notFound'=>'Панель инструментов(страница не найдена)',
'dashboard.desc'=>'Добро пожаловать в панель WebPress! Здесь вы можете настраивать и редактировать файлы/папки для вашей веб-страницы, активные и деактивированные плагины и темы. Наслаждаться!',
'dashboard.logout'=>'Выйти',
'dashboard.redirect.logout.title'=>'Выход',
'dashboard.redirect.logout.desc'=>'Перенаправление на вход',
'dashboard.side'=>'Меню веб-прессы',
'dashboard.side.welcome.morn'=>'<span style="color:#f7cd5d;">Доброе утро'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fa-solid fa-sunrise"></i></span>',
'dashboard.side.welcome.after'=>'<span style="color:#fce570;">Добрый день'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fa-solid fa-sun"></i></span>',
'dashboard.side.welcome.even'=>'<span style="color:#fad6a5;">Добрый вечер'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fa-solid fa-sunset"></i></span>',
'dashboard.side.welcome.night'=>'<span style="color:#003833;">Спокойной ночи'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fa-solid fa-moon"></i></span>',
'dashboard.side.weather'=>'Погода',
'dashboard.side.home'=>'Дом <i class="fas fa-house"></i>',
'dashboard.side.back'=>'Панель приборов <i class="fa-solid fa-gauge-min"></i>',
'dashboard.side.forum'=>'Форум <i class="fa-duotone fa-comments"></i>',
'dashboard.side.phpinfo'=>'Информация о PHP <i class="fa-brands fa-php"></i>',
'dashboard.side.profile'=>'Профиль <i class="fas fa-user"></i>',
'dashboard.side.config'=>'Конфигурация <i class="fas fa-sliders-h"></i>',
'dashboard.side.docs'=>'Документация <i class="fas fa-file-alt"></i>',
'dashboard.side.themes'=>'Темы <i class="fas fa-paint-brush"></i>',
'dashboard.side.plugins'=>'Плагины &nbsp;&nbsp;<i class="fas fa-plug" style="transform:rotate(-45deg);"></i>',
'dashboard.side.console'=>'Консоль <i class="fas fa-terminal"></i>',
'dashboard.side.editors'=>'Редакторы <i class="fas fa-pen-square"></i>',
'dashboard.side.assets'=>'Ресурсы <i class="fa-solid fa-books"></i>',
'dashboard.side.mail'=>'Почта <i class="fas fa-envelope"></i>',
'dashboard.side.ban'=>'Список банов <i class="fa-solid fa-ban"></i>',
'dashboard.side.roles'=>'Роли <i class="fa-solid fa-user-plus"></i>',
'dashboard.side.files'=>'Файлы <i class="fa-solid fa-files"></i>',
'dashboard.side.events'=>'События <i class="fa-regular fa-calendar-lines-pen"></i>',
'dashboard.side.pages'=>'Страницы <i class="fa-solid fa-page"></i>',
'dashboard.graph.user.label'=>'пользователи',
'dashboard.graph.user.y'=>'Зарегистрированные пользователи',
'dashboard.graph.subtitle'=>'Это будет ясно на ',
'dashboard.graph.views.label'=>'Просмотры',
'dashboard.graph.views.unique'=>'уникальный',
'dashboard.graph.forums.label'=>'Форумы',
'dashboard.graph.forums.y'=>'Количество тем/ответов',
'dashboard.graph.forums.topics'=>'Темы',
'dashboard.graph.forums.replies'=>'Ответы',
'dashboard.graph.views.y'=>'Просмотры на веб-странице',
'dashboard.profile.title'=>'О пользователе',
'dashboard.profile.hardwareID'=>'Идентификатор оборудования: ',
'dashboard.profile.about'=>'<b>О: </b>',
'dashboard.profile.timezone'=>'<b>Часовой пояс: </b>',
'dashboard.profile.ip'=>'<b>IP: </b>',
'dashboard.profile.location'=>'<b>Расположение: </b>',
'dashboard.profile.created'=>'<b>Созданный: </b>',
'dashboard.profile.email'=>'<b>Электронная почта: </b>',
'dashboard.profile.name'=>'<b>Имя: </b>',
'dashboard.profile.topics'=>'<b class="text-secondary">Темы: </b>',
'dashboard.profile.replys'=>'<b class="text-secondary">Ответы: </b>',
'dashboard.profile.forums'=>'<b class="text-secondary">Форумы: </b>',
'dashboard.pageLoaded'=>'<b class=\'text-secondary\'>Загружено: </b>',
'dashboard.profile.editbtn'=>'Редактировать профиль',
'dashboard.profile.addBan'=>'Заблокировать пользователя',
'dashboard.config.title'=>'Конфигурация',
'dashboard.config.pageError.title'=>'Ошибки страницы(разрешен HTML+MD):',
'dashboard.config.page.title'=>'Название веб-страницы',
'dashboard.config.lang.title'=>'Язык',
'dashboard.config.400'=>'Неверный запрос',
'dashboard.config.401'=>'Авторизация',
'dashboard.config.403'=>'Запрещенный',
'dashboard.config.404'=>'Страница не найдена',
'dashboard.config.500'=>'Международная ошибка',
'dashboard.config.301.help'=>'Оставьте пустым, чтобы не включать его',
'dashboard.config.debug.title'=>'Отлаживать',
'dashboard.config.seo.title'=>'Инструменты SEO <i class="fa-solid fa-screwdriver-wrench"></i>',
'dashboard.config.description'=>'Введите веб-описание <i class="fas fa-edit"></i>',
'dashboard.config.author'=>'Автор <i class="fas fa-at"></i>',
'dashboard.config.refresh'=>'Автоматическое обновление <i class="fas fa-sync"></i>',
'dashboard.config.refresh.help'=>'Установите значение 0, чтобы не использовать автообновление',
'dashboard.config.keywords'=>'Введите ключевые слова <i class="fas fa-spell-check"></i>',
'dashboard.config.keywords.help'=>'Используйте запятые(,), чтобы использовать несколько ключевых слов',
'dashboard.config.robotIndex.title'=>'Разрешить роботам индексировать ваш сайт? <i class="fas fa-robot"></i>',
'dashboard.config.robotFollow.title'=>'Разрешить роботам переходить по всем ссылкам? <i class="fas fa-external-link"></i>',
'dashboard.config.rate.title'=>'Рейтинг <i class="fas fa-star"></i>',
'dashboard.config.rate'=>array(
'null'=>'Не указан',
'14_years'=>'14 лет',
'adult'=>'Взрослый',
'general'=>'Общий',
'mature'=>'Зрелый',
'restricted'=>'Ограниченный',
'safe_for_kids'=>'Безопасен для детей'
),
'dashboard.config.copyright'=>'Авторские права <i class="fas fa-copyright"></i>',
'dashboard.config.distribution.title'=>'Распределение <i class="fa-solid fa-chart-network"></i>',
'dashboard.config.distribution'=>array(
'Global'=>'Глобальный',
'Local'=>'Местный'
),
'dashboard.config.revisted.title'=>'Повторный визит после <i class="fa-solid fa-exchange"></i>',
'dashboard.config.revisted'=>array(
'1_Day'=>'1 день',
'7_Days'=>'7 дней',
'31_Days'=>'31 дней',
'180_Days'=>'180 дней',
'360_Days'=>'360 дней'
),
'dashboard.config.charset.title'=>'Набор символов <i class="fa-solid fa-file-times"></i>',
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
'UTF-8'=>'UTF-8 (рекомендуемые)',
'other'=>'другой'
),
'dashboard.config.captch'=>'Капча',
'dashboard.pageError'=>'Страница не найдена!',
'dashboard.config.forum.title'=>'Форум <i class="fa-solid fa-comments"></i>',
'dashboard.config.forum.topic'=>'Показать количество тем',
'dashboard.config.forum.reply'=>'Показать количество ответов',
'dashboard.config.forum.summary'=>'Суммарная сумма',
'dashboard.config.forum.icons'=>'Диапазон значков',
'dashboard.pageResults'=>'Полученные результаты',
# модальный
'modal.profile'=>'Редактировать профиль',
'modal.profile.username'=>'Введите имя пользователя',
'modal.profile.name'=>'Введите имя',
'modal.profile.oldpsw'=>'Старый пароль',
'modal.profile.newpsw'=>'Введите новый пароль',
'modal.profile.delete'=>'Удалить аккаунт',
'modal.profile.newpsw.note'=>'Должен быть старый пароль',
'modal.profile.about'=>'О себе',
'modal.profile.upload'=>'Загрузить логотип (только файлы PNG)',
'modal.profile.err.user'=>'Имя пользователя уже занято',
'modal.pedit.title'=>'Сохранение данных',
'modal.failed.title'=>'Неверные данные',
'modal.pedit.desc'=>'Сохранение отредактированных данных',
'modal.pedit.psw.format'=>'У вас должен быть 1 верхний регистр, 1 нижний регистр, 1 цифра и 8 символов.',
'modal.pedit.psw.match'=>'Пароль не подходит',
'modal.pedit.psw.otn'=>'Старый пароль не совпадает с новым паролем',
'modal.profile.removeAvatar'=>'Удалить аватар',

#конфигурация
'config'=>'Конфигурация ',
'config.label'=>'Конфигурация ',
'config.save'=>'Сохранять <i class="fas fa-save"></i>',
'config.failed'=>'Не удалось сохранить данные',
'config.success'=>'Данные успешно сохранены',
'config.true'=>'На',
'config.false'=>'Выключенный',
#кнопки
'btn.disabled'=>'Вы не можете использовать эту опцию',
'btn.drop.actions.title'=>'Действия',
'btn.drop.copy.url'=>'Скопировать URL <i class="fas fa-link"></i>',
'btn.drop.copy.msg'=>'Копировать сообщение <i class="fas fa-copy"></i>',
'btn.download'=>'Скачать <i class=\'fas fa-download\'></i>',
'btn.save'=>'Сохранить изменения',
'btn.close'=>'Закрывать',
'btn.dismissed'=>'Увольнять',
'btn.confirm'=>'Подтверждать',
'btn.quote'=>'<i class="fa-solid fa-comment-quote"></i> Цитировать',
'btn.delete'=>'Удалять',
# Темы
'theme.active'=>'Активировано <i class="fas fa-check"></i>',
'theme.deactive'=>'Deactivated <i class="fas fa-times"></i>',
'theme.error.missingName'=>'Отсутствует имя',
'theme.error.missingDesc'=>'Отсутствует описание',
'theme.allow.lang'=>'Разрешенные языки: ',
'theme.allow.lang.null'=>'Неопределенный',
'theme.missing'=>'Отсутствует файл конфигурации темы!',
# Plugins
'plugin.active'=>'Активировано <i class="fas fa-check"></i>',
'plugin.deactive'=>'Деактивировано <i class="fas fa-times"></i>',
'plugin.error.missingName'=>'Отсутствует имя',
'plugin.error.missingDesc'=>'Отсутствует описание',
'plugin.allow.lang'=>'Разрешенные языки: ',
'plugin.allow.lang.null'=>'Неопределенный',
'plugin.pluginUpdated'=>'Последнее обновление: ',
#Отлаживать
'debug.off'=>'<a href="./configs">Отлаживать</a> выключен, вы больше не можете регистрировать какие-либо ошибки функций.',
# контакт
'contact.title'=>'Контакт',
'contact.email'=>'<i class="fas fa-asterisk text-danger"></i> Электронная почта',
'contact.email.placeholder'=>'Введите ваш адрес электронной почты',
'contact.emailto'=>'<i class="fas fa-asterisk text-danger"></i> К:',
'contact.emailto.placeholder'=>'Введите адрес электронной почты человека: (используется \',\' для разделения)',
'contact.to.example'=>'Пример: user1:<{user1email}>, user2:<{user2email}>...',
'contact.senderAs'=>'Отправка как',
'contact.name'=>'<i class="fas fa-asterisk text-danger"></i> Имя',
'contact.name.placeholder'=>'Введите полное имя',
'contact.subject'=>'<i class="fas fa-asterisk text-danger"></i> Предмет',
'contact.subject.placeholder'=>'Введите тему',
'contact.msg'=>'<i class="fas fa-asterisk text-danger"></i> Сообщение',
'contact.msg.placeholder'=>'Введите сообщение',
'contact.send'=>'Отправить сообщение',
'contact.markasread'=>'Пометить, как прочитанное',
'contact.markasunread'=>'Отметить как непрочитанное',
'contact.reply'=>'Отвечать',
'contact.readme'=>'Читать',
'contact.hidden'=>'Это скрытое сообщение только для определенного пользователя!',
'contact.option.all'=>'Все',
'contact.msg.exists'=>'Сообщение уже существует',
'report'=>'<i class="fa-solid fa-bell"></i> Отчет',
'contact.report.prioiry'=>'<i class="fas fa-asterisk text-danger"></i> Приорат',
'contact.report'=>'Пожаловаться на пользователя',
'contact.report.label'=>'[Введите обоснование здесь]',
# почта
'mail.success'=>'Успешно отправлено письмо на ',
'mail.failed'=>'Не удалось отправить письмо на ',
# поставить в известность
'notify.clear'=>'отметить все как прочитанное',
# форма
'errLen' => 'Слишком короткий / длинный',
'errNb' => 'Это не положительное целое число',
'ErrContentFilter' => 'Вы вставили хотя бы одно цензурированное слово, будьте вежливы.',
'tableHeader'=>'Заголовки',
'form_active'=>'Вкл выкл',
# ресурсы
'assets.title'=>'Ресурсы',
# список банов
'ban.label'=>'Вы заблокированы!',
'ban.reasonLabel'=>'Причина',
'ban.orgtimeLabel'=>'Оригинал',
'ban.unbanbyLabel'=>'Разбан в',
'ban.empty'=>'Ни один пользователь не забанен',
'ban.request'=>'Запросить апелляцию',
'ban.remove'=>'Удалять',
'ban.add'=>'Добавить пользователя',
'ban.table'=>array(
'username'=>'Имя пользователя',
'time'=>'Дата выпуска',
'duration'=>'Продолжительность',
'reason'=>'Причина',
'bannedBy'=>'Запрещено',
'actions'=>'Действия',
),
'ban.list'=>array(
'1min'=>'+1 минута',
'3min'=>'+3 минуты',
'5min'=>'+5 минуты',
'7min'=>'+7 минуты',
'9min'=>'+9 минуты',
'11min'=>'+11 минуты',
'13min'=>'+13 минуты',
'15min'=>'+15 минуты',
'17min'=>'+17 минуты',
'19min'=>'+19 минуты',
'21min'=>'+21 минуты',
'23min'=>'+23 минуты',
'25min'=>'+25 минуты',
'27min'=>'+27 минуты',
'29min'=>'+29 минуты',
'31min'=>'+31 минуты',
'33min'=>'+33 минуты',
'35min'=>'+35 минуты',
'37min'=>'+37 минуты',
'39min'=>'+39 минуты',
'41min'=>'+41 минуты',
'43min'=>'+43 минуты',
'45min'=>'+45 минуты',
'47min'=>'+47 минуты',
'49min'=>'+49 минуты',
'51min'=>'+51 минуты',
'53min'=>'+53 минуты',
'55min'=>'+55 минуты',
'57min'=>'+57 минуты',
'59min'=>'+59 минуты',
'1h'=>'+1 Час',
'3h'=>'+3 Часы',
'5h'=>'+5 Часы',
'7h'=>'+7 Часы',
'9h'=>'+9 Часы',
'11h'=>'+11 Часы',
'13h'=>'+13 Часы',
'15h'=>'+15 Часы',
'17h'=>'+17 Часы',
'19h'=>'+19 Часы',
'21h'=>'+21 Часы',
'23h'=>'+23 Часы',
'1d'=>'+1 День',
'3d'=>'+3 Дни',
'5d'=>'+5 Дни',
'1w'=>'+1 Неделя',
'3w'=>'+3 Недели',
'1m'=>'+1 Месяц',
'3m'=>'+3 Месяцы',
'5m'=>'+5 Месяцы',
'7m'=>'+7 Месяцы',
'9m'=>'+9 Месяцы',
'11m'=>'+11 Месяцы',
'1y'=>'+1 Год',
'3y'=>'+3 Годы',
'5y'=>'+5 Годы',
'7y'=>'+7 Годы',
'9y'=>'+9 Годы',
'11y'=>'+11 Годы',
'13y'=>'+13 Годы',
'15y'=>'+15 Годы',
'17y'=>'+17 Годы',
'19y'=>'+19 Годы',
'21y'=>'+21 Годы',
'23y'=>'+23 Годы',
'25y'=>'+25 Годы',
'27y'=>'+27 Годы',
'29y'=>'+29 Годы',
'31y'=>'+31 Годы',
'forever'=>'Навсегда'
),
'ban.byList'=>array(
'username'=>'Имя пользователя',
'ip'=>'IP',
'hardwareid'=>'Идентификатор оборудования'
),
'ban.forever'=>'Навсегда',
'ban.UI.title'=>'Заблокировать пользователя',
'ban.UI.username'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Имя пользователя',
'ban.UI.time'=>'Время',
'ban.UI.reason'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Причина',
'ban.UI.banBy'=>'Тип бана',
'ban.UI.submit'=>'Заблокировать пользователя',
#дата
'day' => 'дни',
'hour' => 'Часы',
'minute' => 'минуты',
'second' =>'секунды',
'ago' => 'назад',
# загрузки
'upload.failed.data'=>'Не удается получить данные',
'upload.failed.large'=>'Извините, ваш файл слишком большой',
'upload.failed.extentions'=>'Извините, ваш файл не имеет допустимого расширения',
'upload.failed.overrule'=>'Извините, ваш файл уже существует',
'upload.failed'=>'Извините, ваш файл не был загружен.',
'upload.failed.rename'=>'Не удалось переименовать',
'upload.success'=>array('Файл '.(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on' ? 'https://':'http://').$_SERVER['HTTP_HOST'].'/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/uploads/', 'был загружен.', 'avatars/'),
# Роли
'roles.user'=>'Имя пользователя',
'roles.roleID'=>'Тип роли',
'roles.edit'=>'Изменить роль',
'roles.roleSelect'=>'Выберите роль',
'roles.createRole'=>'Создать роль',
'roles.input.name'=>'Имя роли',
'roles.input.desc'=>'Описание роли',
'roles.input.canView'=>'Можно просмотреть',
'roles.input.canWrite'=>'Может писать',
'roles.input.canRead'=>'Может читать',
'roles.input.canDelete'=>'Можно удалить',
'roles.input.canBan'=>'Можно запретить',
'roles.input.canPost'=>'Может опубликовать',
'roles.input.canReply'=>'Могу ответить',
'roles.input.canMsg'=>'Может сообщение',
'roles.input.plugins'=>'Может активировать плагины',
'roles.input.themes'=>'Может активировать темы',
'roles.input.config'=>'Можно настроить',
'roles.input.canRole'=>'Может менять роли',
'roles.input.file'=>'Можно использовать файловый менеджер',
'roles.input.profile'=>'Может изменить профиль',
'roles.input.events'=>'Может просматривать события',
'roles.input.pages'=>'Может редактировать страницы',
'roles.deleteRole'=>'Удалить роль',
'roles.removeItems'=>'Выберите, чтобы удалить роль',
# файлы
'file.locked.folder'=>'Эта папка заблокирована',
'file.locked.file'=>'Этот файл заблокирован',
'file.manager.title'=>'Файловый менеджер',
'file.managerchmod.title'=>'Изменить разрешения',
'file.managerchmod.u'=>'Права владельца',
'file.managerchmod.g'=>'Групповые права',
'file.managerchmod.o'=>'Другие права',
'file.managerchmod.read'=>'Читать(4)',
'file.managerchmod.write'=>'Писать(2)',
'file.managerchmod.execute'=>'Выполнять(1)',
'files.delete'=>'Удалить файл',
'files.chmod'=>'Изменить права доступа к файламs',
'files.rename'=>'Переименуйте файл',
'files.remove.msg'=>'Вы хотите удалить ',
'files.rename.msg'=>'Переименуйте файл',
'file.rename.newName'=>'Новое имя:',
'file.rename.oldName'=>'Старое имя:',
'file.manager.createFile'=>'<i class="fa-solid fa-file-plus"></i> Создать файл',
'file.manager.createFolder'=>'<i class="fa-solid fa-folder-plus"></i> Создать папку',
'file.manager.upload'=>'<i class="fa-solid fa-upload"></i> Загрузить',
'files.addFile.msg'=>'Добавить файл',
'files.addFolder.msg'=>'Добавить папку',
'files.download'=>'Загрузить файл',
'file.manager.fileUpload'=>'Загрузите файлы сюда: ',
'file.manager.folderUpload'=>'Загрузите папки сюда: ',
'files.uploadFiles.msg'=>'Загрузить файлы',
'files.manager.saved'=>'Файл успешно сохранен, перезагружается страница для обновления файла...',
'files.manager.error'=>'Ошибка: не удалось сохранить файл, перезагружается страница для обновления файла...',
#ожидания
'expect.lang'=>'Вы должны иметь '.$conf['lang'].'.php',
'expect.guest'=>'<i class="fa-solid fa-triangle-exclamation"></i> Вы находитесь в гостевом режиме, вы не можете ничего делать, кроме чтения/просмотра/регистрации/авторизации, пожалуйста, <a href="./auth.php/login">войдите</a> или <a href="./auth.php /register">зарегистрировать</a> учетную запись',
'expect.requiements'=>'Все необходимые элементы формы обязательны!',
#Форум
'forum.title'=>'Форум',
'forum.author'=>'Сделано: ',
'forum.forumTag'=>'Теги: ',
'forum.sidebar'=>'Форумы',
'forum.addForum'=>'Добавить форум',
'forum.addTopic'=>'Добавить тему',
'forum.editTopic'=>'Изменить тему',
'forum.created'=>'Созданный: ',
'forum.edited'=>'Последнее редактирование: ',
'forum.search.failed'=>'Результаты поиска не найдены',
'forum.replys'=>'Отвечать&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>',
'forum.view'=>'Вид&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>',
'forum.replysNoIcon'=>'Ответы',
'forum.editBtn'=>'<i class="fa-solid fa-pen-to-square"></i> Редактировать',
'forum.removeBtn'=>'<i class="fa-solid fa-trash-can"></i> Удалить',
'forum.anonumous'=>'Система',
'forum.inputForumName'=>'Имя на форуме',
'forum.inputForumColor'=>'Введите цвет',
'forum.inputForumDesc'=>'Введите описание',
'forum.selectIcon'=>'Выберите значок',
'forum.inputTopicName'=>'Название темы',
'forum.inputTopicCategory'=>'Выберите форум',
'forum.entermsg'=>'Введите сообщение',
'forum.inputTopicAuthor'=>'Автор',
'forum.inputTopicTags'=>'Введите теги(используйте , для разделения)',
'forum.deleteTopic'=>'Удалить тему',
'forum.pinned'=>'Закреплено',
'forum.locked'=>'Заблокировано',
'forum.toggleOpt'=>array(
	'false'=>'нет',
	'true'=>'да'
),
'fourm.guest'=>'Войдите, чтобы отвечать на форуме',
'forum.recent'=>'Последние действия',
'forum.anchorID'=>'Копировать идентификатор ответа',
'forum.userStatus'=>'Положение дел',
'forum.sidebar.statistics'=>'Статистика',
'forum.reply_drop'=>'Ответить',
'forum.noreply'=>'У вас нет разрешения на ответ!',
'forum.home'=>'Дом',
'forum.category'=>'Форумы',
'forum.shortSubmit'=>'Сортировка предметов',
'forum.sort'=>'Отсортируйте свои форумы <b><em>(не используйте несколько тем с одинаковым номером)</em></b>',
'forum.sortUser'=>'Пожалуйста, войдите в систему как администратор, чтобы использовать эту опцию',
# события
'events.ip'=>'IP',
'events.device'=>'Устройство',
'events.browser'=>'Браузер',
'events.loc'=>'Расположение',
'events.date'=>'Дата',
'events.target'=>'Цель',
'events.stat'=>'Положение дел',
'events.action'=>'Действие',
#страницы
'pages.form.notice'=>'Получение отправленных форм не работает с использованием блоков. Для получения данных необходимо использовать атрибут «Действие». 5 МБ/страница не более',
# блоки
'blocks.title'=>'Перетащите блоки для создания веб-сайта',
'blocks.jsonInfo'=>'Это отобразит сборку JSON, которую можно редактировать в зависимости от структуры вашей страницы.',
'blocks.moveUp'=>'<i class="fa-solid fa-up"></i> Вверх',
'blocks.moveDown'=>'<i class="fa-solid fa-down"></i> Вниз',
'blocks.remove'=>'<i class="fa-solid fa-trash-can"></i> Удалить',
'blocks.reload'=>'<i class="fa-solid fa-rotate-right"></i> Перезагрузить',
'blocks.id'=>'<i class="fa-solid fa-id-card"></i> ID',
'blocks.id.prompt'=>'Введите ID, введите &quote;отмена&quot; отменить, иначе он удалит ID',
'blocks.classes'=>'<i class="fa-solid fa-code-branch"></i> Класс',
'blocks.class.prompt'=>'Войдите в класс, введите &quote;отмена&quot; отменить, иначе он удалит Class',
'blocks.href'=>'<i class="fa-solid fa-link"></i> Вставить ссылку',
'blocks.href.prompt'=>'Введите ссылку, введите &quote;отменить&quot; отменить, иначе он удалит Link',
'blocks.hrefTar.prompt'=>'Введите цель:\n1. себя\n2. пусто\n3. родитель\n4. вершина',
'blocks.RemHref'=>'<i class="fa-solid fa-link-slash"></i> Удалить ссылку',
'blocks.Bold'=>'<i class="fa-solid fa-bold"></i> Bold',
'blocks.Italic'=>'<i class="fa-solid fa-italic"></i> Курсив',
'blocks.Strike'=>'<i class="fa-solid fa-strikethrough"></i> Strikethrough',
'blocks.style'=>'<i class="fa-solid fa-palette"></i> Стиль',
'blocks.Underline'=>'<i class="fa-solid fa-underline"></i> Underline',
'blocks.removeFormat'=>'<i class="fa-solid fa-text-slash"></i> Удалить формат',
'blocks.insert'=>'<i class="fa-solid fa-plus"></i> Вставить',
'blocks.actions'=>'Действия',
'blocks.blockAction'=>'Блоки',
'blocks.wordActions'=>'Слова',
'blocks.removal'=>'Удаление',
'blocks.page.title'=>'Добавить страницу',
'blocks.page.name'=>'Введите название страницы',
'blocks.page.mobileUser'=>'Это не поддерживается для мобильных пользователей!',
'blocks.settings'=>'Настройки',
'blocks.settings.bg'=>'Фон',
'blocks.settings.solid.color'=>'Сплошной цвет',
'blocks.settings.bg.img'=>'Загрузить изображение',
'blocks.settings.custom.color'=>'Пользовательский цвет',
'blocks.settings.bgBlock.body'=>'Тело',
'blocks.settings.bgBlock.target'=>'Выбранный блок',
'blocks.customcolor'=>'Пользовательский цвет(чтобы использовать сплошной цвет, проверьте его снова)',
'blocks.bgImage'=>'Введите URL-адрес изображения',
'blocks.settings.color'=>'Цвет шрифта',
'blocks.settings.align'=>'Выравнивание текста',
'blocks.settings.padding'=>'Заполнение',
'blocks.settings.margin'=>'Маржа',
'blocks.settings.display'=>'Экран',
'blocks.settings.flex'=>'Flex',
'blocks.settings.flexWrap'=>'Flex Wrap',
'blocks.settings.flexDir'=>'Направление гибкости',
'blocks.settings.flexGrow'=>'Flex Grow',
'blocks.settings.flexShrink'=>'Flex Shrink',
'blocks.settings.flexBiases'=>'Основа гибкости',
'blocks.settings.fontSize'=>'Размер шрифта',
'blocks.settings.border'=>'Граница',
'blocks.settings.borderBLRadius'=>'Нижний левый радиус',
'blocks.settings.borderBRRadius'=>'Нижний правый радиус',
'blocks.settings.borderTLRadius'=>'Верхний левый радиус',
'blocks.settings.borderTRRadius'=>'Верхний правый радиус',
'blocks.settings.boxShadow'=>'Тень окна',
'blocks.settings.textShadow'=>'тень текста',
'blocks.settings.boxShadow.h'=>'H тень',
'blocks.settings.boxShadow.v'=>'V тень',
'blocks.settings.boxShadow.blur'=>'Размытие',
'blocks.settings.boxShadow.spread'=>'Распространение',
'blocks.settings.boxShadow.color'=>'Цвет',
'blocks.settings.boxShadow.inset'=>'Вставка',
'blocks.settings.animation'=>'Анимации',
'blocks.settings.animation.list'=>'Выбрать анимацию',
'blocks.settings.animation.timing'=>'Функция синхронизации',
'blocks.settings.animation.direction'=>'Направление',
'blocks.settings.animation.fillMode'=>'Режим заливки',
'blocks.settings.animation.duration'=>'Продолжительность',
'blocks.settings.animation.delay'=>'Задержка',
'blocks.settings.animation.count'=>'Счетчик итераций, (-1) - бесконечно',
'blocks.settings.blockWidth'=>'Ширина блока',
'blocks.settings.blockHeight'=>'Высота блока',
'blocks.settings.pos'=>'Позиция',
'blocks.settings.transform'=>'Преобразование',
'blocks.settings.textTransform'=>'Текстовое преобразование',
'blocks.settings.textDirection'=>'Направление текста',
'blocks.settings.top'=>'Вверху',
'blocks.settings.right'=>'Правильно',
'blocks.settings.bottom'=>'Внизу',
'blocks.settings.left'=>'Левый',
'blocks.settings.none'=>'Нет',
'blocks.settings.scripts'=>'Скрипты',
'blocks.settings.formConfig'=>'Конфигурация формы',
'blocks.settings.required'=>'Обязательно',
'blocks.settings.readOnly'=>'Только чтение',
'blocks.settings.disabled'=>'Отключено',
'blocks.settings.regexp'=>'шаблон',
'blocks.usage'=>'Как использовать:
<ul class="list-group list-group-numbered">
<li class="list-group-item">Щелкните блок правой кнопкой мыши, чтобы открыть контекстное меню.</li>
<li class="list-group-item"><em>Действия</em> могут повлиять на порядок блоков и страницу.</li>
<li class="list-group-item"><em>Блоки</em> воздействуют на весь блок одним щелчком мыши</li>
<li class="list-group-item"><em>Слова</em> могут повлиять на слова/блок, <q>дважды щелкнув/выделив</q> слово в блоке.</li>
<li class="list-group-item"><em>Удалить формат</em> Удалить верхний слой блока</li>
<li class="list-group-item"><em>Удалить</em> Удаляет весь блок.</li>
</ul>',
#анимации
'animate.blank.fast'=>'Пусто (быстро)',
'animate.blank.slow'=>'Пусто(Медленно)',
'animate.bounce.top'=>'Отскок (сверху)',
'animate.bounce.left'=>'Отскок(Влево)',
'animate.bounce.right'=>'Отскок (справа)',
'animate.bounce.bottom'=>'Отскок (снизу)',
'animate.jello.horizontal'=>'Желе (горизонтальное)',
'animate.jello.vertical'=>'Желло (Вертикаль)',
'animate.pulse.heartbeat'=>'Пульс (сердцебиение)',
'animate.pulse.regular'=>'Пульс(Обычный)',
'animate.pulse.ping'=>'Пульс(Ping)',
'animate.shake.horizontal'=>'Встряхнуть(Горизонтально)',
'animate.shake.vertical'=>'Встряхнуть(Вертикально)',
'animate.shake.rotate'=>'Встряхнуть(Повернуть)',
'animate.shake.bottom'=>'Встряхнуть(Низ)',
'animate.shake.left'=>'Встряхнуть(Влево)',
'animate.shake.right'=>'Встряхнуть(Вправо)',
'animate.shake.top'=>'Встряхнуть(Верх)',
'animate.scale.bottom'=>'Масштаб (снизу)',
'animate.scale.center'=>'Масштаб (по центру)',
'animate.scale.left'=>'Масштаб (слева)',
'animate.scale.right'=>'Масштаб (справа)',
'animate.scale.top'=>'Масштаб(Верх)',
'animate.scale.horzcenter'=>'Масштаб (Горизонтальный центр)',
'animate.scale.horzleft'=>'Масштаб(Гориз.слева)',
'animate.scale.horzright'=>'Масштаб (горизонт вправо)',
'animate.scale.vertbottom'=>'Масштаб (Верт. Низ)',
'animate.scale.vertcenter'=>'Масштаб (центр по вертикали)',
'animate.scale.verttop'=>'Масштаб(Вертикальная вершина)',
'animate.rotate.bottom'=>'Повернуть (снизу)',
'animate.rotate.left'=>'Повернуть(влево)',
'animate.rotate.right'=>'Повернуть (вправо)',
'animate.rotate.top'=>'Повернуть (сверху)',
'animate.slide.bottom'=>'Слайд (снизу)',
'animate.slide.left'=>'Слайд(Влево)',
'animate.slide.right'=>'Слайд (справа)',
'animate.slide.top'=>'Слайд (сверху)',
'animate.swirl.bottom'=>'Вихрь(Нижний)',
'animate.swirl.left'=>'Вихрь (влево)',
'animate.swirl.right'=>'Вихрь (справа)',
'animate.swirl.top'=>'Вихрь(Верх)',
#безопасность
'csrf.privateHook'=>' запрашивает кражу вашего закрытого ключа! Из соображений безопасности удалите его по адресу ',
'csrf.generateHook'=>' предотвращает перезапись вашего ключа! Из соображений безопасности удалите его по адресу ',
'csrf.tokenTheft'=>' запрашивает/перезаписывает токен пользователя! Из соображений безопасности удалите его по адресу ',
'csrf.fileAccess'=>' запрашивает/перезаписывает файлы! Из соображений безопасности удалите его по адресу ',
'csrf.filegetcontent'=>' запускает содержимое файла ',
'csrf.noCSRF'=>' использует CSRF, это не разрешено',
'csrf.apiKey'=>' запрашивает ключ API! Из соображений безопасности удалите его по адресу ',
'csrf.themeHook'=>' использует недействительный файл для темы! Из соображений безопасности удалите его по адресу ',
'csrf.themeFHook'=>' использует недопустимую папку для темы! Из соображений безопасности удалите его в '
);
?>