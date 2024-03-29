[Необработанная документация](../docs/doc_ru.md)

# ВебПресс

Простая CMS, которая использует базу данных JSON и используется для всех веб-страниц, включая домен и локальные хосты.

### [что это?](./docs#что-это-это) {#что-это-это}

это простая CMS, которая позволяет вам использовать User Infrence (UI) и упрощает поиск, используя высококачественную SEO-информацию и простые строительные структуры. Это использует файлы JSON для создания/создания страниц на вашей веб-странице. Ваши страницы создаются с помощью письменных кодов, которые затем преобразуются в файл JSON.

***

### [Требования](./docs#requirements) {#requirements}

###### Системные Требования
- PHP 7.4 или выше
- Веб-сервер (Apache)
###### Расширения PHP
- Модуль PHP [GD](http://php.net/manual/en/book.mbstring.php) для обработки изображений.
- Модуль PHP [JSON](https://php.net/manual/en/book.json.php) для работы с JSON.
- Модуль PHP [mbstring](http://php.net/manual/en/book.mbstring.php) для полной поддержки UTF-8.

***

### [Основы](./docs#basics) {#basics}

Основы их просты, когда вы получаете доступ к этому URL-адресу `http(s)://{ваш_домен}/` или `http(s)://{ваш_домен}/{папка}` есть 2 **HTACCESS**, которые 1 будет вашей главной (WebPress) страницей, а другая будет *Вашей домашней страницей* вашего веб-сайта. который будет в своей собственной независимой папке.

***

### [Как установить?](./docs#how-to-install) {#how-to-install}

Чтобы установить, просто вставьте *Un-ZIPED* папку в *HTDocs (корневая папка)*, чтобы запустить программное обеспечение. Когда закончите, перейдите на `http(s)://{your_domain}/` или добавьте `./{folder}/`, чтобы получить доступ к главной странице WebPress **Рекомендуется: htdocs**. После того, как вы там, начните с настройки вашей учетной записи после создания _ ** (по умолчанию это будет администратор при первой регистрации, после чего вы станете участником) ** _.

***

### [обновление версий](./docs#updating) {#updating}
1. Сделайте резервную копию ваших данных, чтобы ничего не было уничтожено.
2. Полностью удалите папку «старая версия».
3. После этого зарегистрируйте новую учетную запись для любых изменений.
4. Перезагрузите свои данные обратно в папку данных и конфигурации (резервные копии можно сделать с помощью плагина резервного копирования)

***

### [Роли](./docs#roles) {#roles}

Роли важны, они очень настраиваемые и имеют 3 основных: *admin, mod и member*. Это даст пользователям разный доступ.

`admin`, имеют полный контроль над тем, как люди могут просматривать и видеть, какие изменения и уведомления. Также может иметь `mod`, помогающий редактировать страницы и улучшать их. Редактировать плагин и менять темы и т.д. Банить пользователей по _name_ или _ip_.

`mod` может помочь `admin`, получив доступ к редактору (если это разрешено `admin`), чтобы сделать страницы лучше. Они также могут сообщить о любой подозрительной активности, и «админ» получит ее.

`member` может только просматривать и использовать элементы страницы.

«гость» — это учетная запись по умолчанию, когда вы не зарегистрированы/не вошли в систему, вы можете только просматривать и читать данные.

ознакомьтесь с [Документом о вакансиях](#jobs), чтобы узнать, что вы можете делать со статусом пользователя.

***

### [Страницы ошибок](./docs#error-pages) {#error-pages}

Вы можете создавать собственные страницы ошибок в [_dashboard.php/configs_](./configs) и создавать собственные ошибки, чтобы ваша страница могла что-то отображать вместо скучной старой страницы ошибок.

Список документов об ошибках (редактируемый)

1. 400 - Неверный запрос
2. 401 — требуется авторизация
3. 403 - Запрещено
4. 404 - Не найдено
5. 500 — внутренняя ошибка сервера

***

### [Вакансии](./docs#jobs) {#jobs}

В виде ролей модератора. Вот таблица, которая по умолчанию для вас

| Тег | Цель | обычай? |
| ---- | ------ | --------- |
| администратор| первый доход | Х |
| модератор | указанные пользователи | Х |
| член | зарегистрированные пользователи | Х |
| гость | неизвестные пользователи | Х |

Если вы хотите добавить свои собственные, перейдите в файл _ROLES.json_.

Введите этот код
измените `[obj]` на имя типа, а также измените true/false, чтобы разрешить или запретить это разрешение.
```json
"[объект]":{
"имя": "[имя_объекта]",
"описание": "[объект]",
"параметры":{
"вид": правда,
"написать верно,
"читать": ложь,
"удалить": ложь,
"бан": ложь,
"предупреждать": ложь,
"пост": ложь,
"ответ": ложь,
"onComingMessages": ложь,
"активные плагины": ложь,
"активные темы": ложь,
"конфиг": ложь,
«changeRoles»: ложь,
"файловый менеджер": ложь,
«изменить профиль»: ложь
}
}
```

### [Редакторы](./docs#editors) {#editors}

В этом проекте используются следующие редакторы: __BBCode__, __Markdown__ и __WYSIWYG__.

### [Открытый и закрытый ключ](./docs#public-vs-private-key) {#public-vs-private-key}

Открытый ключ — это то, что вы будете использовать для настройки любого плагина, для которого требуется этот ключ.
Закрытый ключ — это то, что используется для резервного входа в систему, которые из другого места используют его для доступа к нему.
Открытый ключ позволяет использовать плагины и темы для информации о пользователе.

### [хуки](./docs#хуки) {#хуки}

С помощью хуков вы можете перехватывать все виды событий WebPress для внедрения собственного кода.

Вот список доступных хуков:

| крючок | выполнить в | примечание |
| ---- | ---------- | ---- |
| Профиль | `темы` | отображается на странице профиля |
| редактировать_профиль | `темы` | редактировать в редакторе профиля |
| голова | `темы` | выполняется в теге __head__ |
| навигация | `темы` | отображается в навигационной панели |
| редактироватьр | `темы` | отображается в панели редактора |
| нижний колонтитулJS | `темы` | Выполняет код в нижнем колонтитуле (как __Javascript__) |
| нижний колонтитул | `темы` | Выполняет код в нижнем колонтитуле |
| список баз данных | `ядро` | отображается в списках панели инструментов |
| перед страницей | `ядро` | выполняет код перед загрузкой страницы |
| после страницы | `ядро` | выполняет код после загрузки страницы |
| инициировать | `ядро` | выполняется до того, как все загрузится |
| профильCards_box | `форум` | отображается в поле «Карточка профиля» |
| профильCards_btn | `форум` | отображается в группе кнопок «Карточка профиля» |
| перед сообщением | `форум` | отображается перед загрузкой сообщения |
| сообщение после | `форум` | отображается после загрузки сообщения |
| снизуОтветить | `форум` | отображается внизу ответного сообщения |
| внизуТема | `форум` | отображается в нижней части сообщения темы |

### [Баны](./docs#баны) {#баны}

Баны следует использовать очень осторожно, но вы (админ) будете иметь все права на это, у вас есть 3 способа банить пользователей.

###### __Баны:__
1. ИП
2. Имя пользователя
3. Идентификатор оборудования (жесткий запрет)

Это может быть временное использование формата (`m-d-Y H:i:s`) или типа (`-1`) в течение _неограниченного_ времени.

### [Наборы инструментов](./docs#наборы инструментов) {#наборы инструментов}

Наборы инструментов очень полезны во многих случаях, это может работать для _plugins_, выполнив следующие действия.

Вставьте в `{plugin_name}.plg.php`:

```php
<?php
include_once(ROOT.'/libs/toolkit.lib.php');
# Используйте наборы инструментов как TOOLKIT;
использовать WebPress\toolkits в качестве ИНСТРУМЕНТА;
# загрузить набор инструментов
$kit = новый ИНСТРУМЕНТ ();
# Функции (это селекторы по умолчанию, оставьте значение null, чтобы использовать значения по умолчанию)
$kit->useColor($color='черный');
$kit->useFontWeight($fontWeight='жирный');
$kit->useFontStyle($fontStyle='italic');
$kit->useFontSize($fontStyle=25, $units='px');
$kit->setAllies($func, $parma=null);
# конвертировать
$комплект->__toBool($txt);
$комплект->__toStr($txt);
$комплект->__toInt($txt);
$комплект->__toFloat($txt);
?>
```

### [Загрузка файла](./docs#загрузка файла) {#загрузка файла}
Загрузка файлов также имеет свои ограничения, вы можете загружать что угодно, но некоторые элементы нельзя редактировать (например, изображения, видео и т. д.).
Максимальный размер загрузки — это то, что может обработать ваш сервер. Вы можете загружать файлы любого типа, некоторые из них могут быть редактируемыми, некоторые нет, старайтесь не загружать ничего, что может иметь программное обеспечение для внедрения, которое позволяет получить доступ к учетным записям.
Пользователи, которые загружают элементы в «форум», ограничены (просмотрите их в папке «config»).

### [Поиск по форуму](./docs#поиск по форуму) {#поиск по форуму}
Форум ищет продвинутый инструмент, чтобы найти что-то проще, но он должен включать ключевую работу, чтобы позволить ему работать.
например, _(tags:fun)_, шаблон синтаксиса `{selector}:{value}`

Разрешенные селекторы:
* теги
* Форум
* тема
* положение дел

### [Темы](./docs#themes) {#themes}
Темы — это то, что делает программное обеспечение таким, каким оно выглядит, его легко установить и настроить.

Вот как вы это настроили.
1. Скопируйте папку "Default" в папку _theme_ (это обязательно, т.к. для этого требуется большинство папок).
2. Перейдите в `theme.conf.json` и измените все, что нужно изменить.
3. Наслаждайтесь, начните размещать коды css/js в своей папке и стилизовать свою страницу.

### [Политики](./docs#policy) {#policy}


##### WebPress - Политика

Добро пожаловать в WebPress, бесплатную CMS и Forum-Script с открытым исходным кодом и собственным хостингом. Поскольку разработчик (я сам) любит создавать программное обеспечение для всех, кто может использовать и добросовестно использовать данные, поскольку это классифицируется как платформа _социальных сетей_, я могу сказать вам, что социальные сети вышли из-под контроля с оскорбительной властью и ненадлежащим образом модерация. Так что даже если это позволяет вам говорить все, что вам нравится, я собираюсь стать модератором **_из вторых рук_** Подробнее...

  

#### Допустимый

* Поделитесь своим мнением
* Поделитесь своими идеями / запросами
* Политические/терминологические идеалы
* Продавайте товары или продвигайте выбранные вами товары (убедитесь, что это уместно)
* Загружайте / публикуйте все, что вам нравится (убедитесь, что это уместно)
* Отвечайте, что хотите

  

#### Запрещено

* Продажа незаконных предметов: (18 Кодекс США § 1170)
* Жестокое обращение с детьми/порнография: Жестокое обращение с детьми: (34 Кодекса США, § 20341) | Детская порнография: (18 Кодекс США § 2256)
* Угрозы/вредные комментарии: (6 Свод законов США, § 1508)
* Разглашение личной информации других лиц без их согласия: (18 Кодекс США, § 798)
* Кража личных данных: (Административный код штата Огайо 3354:1-20-09)

  

**ЕСЛИ ВСЕ ЭТО НАРУШЕНО**, администратор может заблокировать/удалить учетную запись или _может быть использован в суде с любой информацией, предоставленной правильно. Пример: изображения/видео/сообщения/ответы и все, что можно показать_ что можно показать федеральным властям.

  

#### Администрация

Все эти правила относятся и к вам, а не только к вашим _Клиентам_. Ваши _Клиенты_ могут сообщить о вашей учетной записи, и это будет принято [XHiddenProjects](#). Вашим наказанием может быть _удаление аккаунта_. XHiddenProjects не приемлет **отсутствие защиты от детей** или ложный бан **БЕЗ** и разумного объяснения.

  

#### Администраторы отчетов

Сбоку экрана будет панель чата, отображаемая сбоку. Заполните информацию, для этого потребуется следующее:

1. Усернамне
2. Имя и фамилия
3. Дата бана(будет показана на экране бана)
4. Причина бана(будет показана на экране бана)
5. Ссылка на источник бана (предоставляется администратором, убедитесь, что вы запросили ее.)

Если вы запрашиваете ссылку на источник бана, админы **ОБЯЗАТЕЛЬНЫ** предоставить ее, иначе приговор будет отменен, а бан снят, так как админ не смог доказать доказательства.
**Примечание.** Не подделывайте _НИКАКИХ_ улик во время просмотра, это можно проверить, и за это может последовать наказание.

  

Если у вас есть вопросы, задавайте их в [обсуждениях](https://github.com/XHiddenProjects1/WebPress/discussions/2) на github.

### Медиа
Совместная работа [Github] (https://github.com/XHiddenProjects1/WebPress)