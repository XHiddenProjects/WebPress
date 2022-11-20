<?php
$lang = array(
'lang'=>array(
'en-US'=>'Englisch',
'de-DE'=>'Deutsch'
),
'sitemap.title'=>'WebPress-Sitemaps',
'index.authdown'=> 'Genehmigung',
'index.registerbtn'=>'Konto anlegen <i class="fas fa-user"></i>',
'index.forumbtn'=>'Forum <i class="fa-duotone fa-comments"></i>',
'index.loginbtn'=>'Anmeldung <i class="fas fa-sign-in"></i>',
'index.dashboardbtn'=>'Armaturenbrett <i class="fas fa-tachometer"></i>',
'index.loginoutbtn'=>'Ausloggen <i class="fas fa-sign-out"></i>',
'index.noScript'=>'Entschuldigung, Javascript ist nicht aktiviert, bitte aktivieren Sie es!',
'index.label.copyright'=>'Urheberrechte ',
'index.label.license'=>'und lizenziert von',
'quote_direct'=>'Klicken Sie auf Original anzeigen',
'index.writtable'=>'Geben Sie hier Inhalt ein',
# Registrieren
'register.title'=>'Konto anlegen',
'register.name'=>'Ihren Namen',
'register.name.place'=>'Geben Sie den vollständigen Namen ein',
'register.user'=>'Nutzername',
'register.user.place'=>'Geben Sie den Benutzernamen ein',
'register.email'=>'E-Mail-Addresse',
'register.email.place'=>'Geben Sie eine gültige E-Mail-Adresse ein',
'register.email.syntax'=>'Muss eine gültige E-Mail-Adresse sein',
'register.psw'=>'Passwort eingeben',
'register.psw.place'=>'Passwort eingeben',
'register.psw.repeat'=>'Passwort wiederholen',
'register.psw.repeat.place'=>'Passwort wiederholen',
'register.psw.syntax'=> 'Muss 1 Großbuchstaben, 1 Kleinbuchstaben, 1 Zahl und 8 Zeichen lang enthalten',
'register.ts' => 'Ich stimme allen Aussagen zu <a href="'.$conf['page']['termsandservice'].'" class="text-body"><u>Nutzungsbedingungen</u></a>',
'register.submit'=>'Anmeldung',
'register.back'=>'Der Rücken',
'register.login'=>'Anmeldung',
'register.err.exist'=>'Benutzername existiert bereits',
'register.err.psw'=>'Sie müssen 1 Großbuchstaben, 1 Kleinbuchstaben, 1 Zahl und 8 Zeichen haben',
'register.err.email'=>'Sie müssen über eine gültige E-Mail-Adresse verfügen',
'register.err.captcha'=>'Ungültiges Captcha',
'register.sucs.user'=>'Erfolgreich erstellt: ',
#Anmeldung
'login.title'=>'Melden Sie sich beim Konto an',
'login.submit'=>'Anmeldung',
'login.back'=>'Der Rücken',
'login.create'=>'Registrieren',
'login.psw'=>'Passwort eingeben',
'login.err.user'=>'Benutzername existiert nicht',
'login.err.psw'=>'Passwort stimmt nicht überein',
'login.user'=>'Geben Sie den Benutzernamen ein',
'login.err.token'=>'Ungültiges Token <i>'.CSRF::check().'</i>',
'login.token'=>'Privates Token',
'login.token.place'=>'Geben Sie Privates Token ein',
#auth
'auth.logout'=>'Ausloggen',
'auth.logout.desc'=>'Umleitung nach Hause',
#armaturenbrett
'dashboard'=>'Armaturenbrett',
'dashboard.info.phpversion'=>'PHP Version',
'dashboard.info.projectName'=>'Projektname',
'dashboard.info.projectVersion'=>'Projektversion',
'dashboard.info.projectBuild'=>'Projektaufbau',
'dashboard.info.serverSoftware'=>'Server Software',
'dashboard.info.phpModules'=>'PHP Modules',
'dashboard.info.memory'=>'Erinnerung',
'dashboard.info.diskSpace'=>'Festplattenplatz',
'dashboard.info.dataStorage'=>'<em>DATEN</em> Speicher',
'dashboard.info.uploadSize'=>'Maximale Größe hochladen',
'dashboard.config.panel.logger'=>'Konsole anzeigen('.($conf['page']['panel']['console']!==(int)'-1' ? 'Top <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="View all errors/warnings in raw text" href="../debug.log">'.$conf['page']['panel']['console'].'</a>' : '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="custom-tooltip" title="Warning: This may cause page delay!"><span style="cursor:help;text-decoration:underline;color:blue;">All</span></span>').')',
'dashboard.config.panel.catche'=>'Cache leeren',
'dashboard.config.panel.bgcolor'=>'Panel-Hintergrund',
'dashboard.config.panel.color'=>'Panel-Farbe',
'dashboard.config.panel.email'=>'Benutzerdefinierte E-Mail-Domäne',
'dashboard.config.panel.editor'=>'Editor',
'dashboard.config.panel.theme'=>'Themen',
'dashboard.config.panel.emaildisabled'=>'Sie können dies nicht ändern, bitte aktualisieren Sie',
'dashboard.config.panel.emailHelp'=>'Geben Sie Ihre benutzerdefinierte Domäne ein, um sie zuzulassen',
'dashboard.config.panel.icons'=>'Website Logo',
'dashboard.userKey'=>'Öffentlicher Schlüssel',
'dashboard.userKey.copy'=>'Öffentlichen Schlüssel kopieren',
'dashboard.userPKey'=>'Privat Schlüssel',
'dashboard.userPKey.copy'=>'Privaten Schlüssel kopieren',
'dashboard.hardwareid.copy'=>'Kopieren Sie die Hardware-ID',
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
'dashboard.desc'=>'Willkommen beim WebPress Panel! Hier können Sie Dateien/Ordner für Ihre Webseite, aktive und deaktivierte Plugins und Designs konfigurieren und bearbeiten. Genießen!',
'dashboard.logout'=>'Ausloggen',
'dashboard.redirect.logout.title'=>'Ausloggen',
'dashboard.redirect.logout.desc'=>'Weiterleitung zum Login',
'dashboard.side'=>'WebPress Menü',
'dashboard.side.welcome.morn'=>'<span style="color:#f7cd5d;">Guten Morgen'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunrise"></i></span>',
'dashboard.side.welcome.after'=>'<span style="color:#fce570;">Guten Tag'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sun"></i></span>',
'dashboard.side.welcome.even'=>'<span style="color:#fad6a5;">Guten Abend'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunset"></i></span>',
'dashboard.side.welcome.night'=>'<span style="color:#003833;">Gute Nacht'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-moon"></i></span>',
'dashboard.side.weather'=>'Wetter',
'dashboard.side.home'=>'Heim <i class="fas fa-house"></i>',
'dashboard.side.back'=>'Armaturenbrett <i class="fas fa-tachometer"></i>',
'dashboard.side.forum'=>'Forum <i class="fa-duotone fa-comments"></i>',
'dashboard.side.phpinfo'=>'PHP Info <i class="fa-brands fa-php"></i>',
'dashboard.side.profile'=>'Profil <i class="fas fa-user"></i>',
'dashboard.side.config'=>'Konfig <i class="fas fa-sliders-h"></i>',
'dashboard.side.docs'=>'Dokumentation <i class="fas fa-file-alt"></i>',
'dashboard.side.themes'=>'Themen <i class="fas fa-paint-brush"></i>',
'dashboard.side.plugins'=>'Plugins &nbsp;&nbsp;<i class="fas fa-plug" style="transform:rotate(-45deg);"></i>',
'dashboard.side.console'=>'Konsole <i class="fas fa-terminal"></i>',
'dashboard.side.editors'=>'Redakteure <i class="fas fa-pen-square"></i>',
'dashboard.side.assets'=>'Vermögenswerte <i class="fa-solid fa-books"></i>',
'dashboard.side.mail'=>'Post <i class="fas fa-envelope"></i>',
'dashboard.side.ban'=>'Verbotsliste <i class="fa-solid fa-ban"></i>',
'dashboard.side.roles'=>'Rollen <i class="fa-solid fa-user-plus"></i>',
'dashboard.side.files'=>'Dateien <i class="fa-solid fa-files"></i>',
'dashboard.graph.user.label'=>'benutzer',
'dashboard.graph.user.y'=>'Registrierte Benutzer',
'dashboard.graph.subtitle'=>'Dies wird am klar sein ',
'dashboard.graph.views.label'=>'Ansichten',
'dashboard.graph.views.unique'=>'einzigartig',
'dashboard.graph.views.y'=>'Ansichten auf der Webseite',
'dashboard.profile.title'=>'Über den Benutzer',
'dashboard.profile.hardwareID'=>'Hardware ID: ',
'dashboard.profile.about'=>'<b>Um: </b>',
'dashboard.profile.timezone'=>'<b>Zeitzone: </b>',
'dashboard.profile.ip'=>'<b>IP: </b>',
'dashboard.profile.location'=>'<b>Ort: </b>',
'dashboard.profile.created'=>'<b>Erstellt: </b>',
'dashboard.profile.email'=>'<b>Email: </b>',
'dashboard.profile.name'=>'<b>Name: </b>',
'dashboard.profile.topics'=>'<b class="text-secondary">Themen: </b>',
'dashboard.profile.replys'=>'<b class="text-secondary">Antworten: </b>',
'dashboard.profile.forums'=>'<b class="text-secondary">Foren: </b>',
'dashboard.pageLoaded'=>'<b class=\'text-secondary\'>Geladen: </b>',
'dashboard.profile.editbtn'=>'Profil bearbeiten',
'dashboard.profile.addBan'=>'Einen Nutzer ausschließen',
'dashboard.config.title'=>'Aufbau',
'dashboard.config.pageError.title'=>'Seitenfehler (HTML+MD ist erlaubt):',
'dashboard.config.page.title'=>'Titel der Webseite',
'dashboard.config.lang.title'=>'Sprache',
'dashboard.config.400'=>'Ungültige Anforderung',
'dashboard.config.401'=>'Genehmigung',
'dashboard.config.403'=>'Verboten',
'dashboard.config.404'=>'Seite nicht gefunden',
'dashboard.config.500'=>'Internationaler Fehler',
'dashboard.config.301.help'=>'Lassen Sie das Feld leer, um es nicht einzuschließen',
'dashboard.config.debug.title'=>'Debuggen',
'dashboard.config.seo.title'=>'SEO Tools <i class="fas fa-tools"></i>',
'dashboard.config.description'=>'Geben Sie die Webbeschreibung einn <i class="fas fa-edit"></i>',
'dashboard.config.author'=>'Author <i class="fas fa-at"></i>',
'dashboard.config.refresh'=>'Automatische Aktualisierung <i class="fas fa-sync"></i>',
'dashboard.config.refresh.help'=>'Setzen Sie den Wert auf 0, um die automatische Aktualisierung nicht zu verwenden',
'dashboard.config.keywords'=>'Schlüsselwörter eingeben <i class="fas fa-spell-check"></i>',
'dashboard.config.keywords.help'=>'Verwenden Sie Kommas (,), um mehrere Schlüsselwörter zu verwendens',
'dashboard.config.robotIndex.title'=>'Erlauben Sie Robots, Ihre Website zu indizieren? <i class="fas fa-robot"></i>',
'dashboard.config.robotFollow.title'=>'Robots erlauben, allen Links zu folgen? <i class="fas fa-external-link"></i>',
'dashboard.config.rate.title'=>'Bewertung <i class="fas fa-star"></i>',
'dashboard.config.rate'=>array(
'null'=>'Unbestimmt',
'14_years'=>'14 Jahre',
'adult'=>'Erwachsene',
'general'=>'Allgemein',
'mature'=>'Reifen',
'restricted'=>'Eingeschränkt',
'safe_for_kids'=>'Sicher für Kinder'
),
'dashboard.config.copyright'=>'Urheberrechte <i class="fas fa-copyright"></i>',
'dashboard.config.distribution.title'=>'Verteilung <i class="fas fa-chart-network"></i>',
'dashboard.config.distribution'=>array(
'Global'=>'Global',
'Local'=>'Lokal'
),
'dashboard.config.revisted.title'=>'Revisit-after <i class="fas fa-exchange"></i>',
'dashboard.config.revisted'=>array(
'1_Day'=>'1 Tag',
'7_Days'=>'7 Tage',
'31_Days'=>'31 Tage',
'180_Days'=>'180 Tage',
'360_Days'=>'360 Tage'
),
'dashboard.config.charset.title'=>'Zeichensatz <i class="fas fa-file-times"></i>',
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
'UTF-8'=>'UTF-8 (Empfohlen)',
'other'=>'other'
),
'dashboard.config.captch'=>'Captcha',
'dashboard.pageError'=>'Seite nicht gefunden!',
'dashboard.config.forum.title'=>'Forum <i class="fa-solid fa-comments"></i>',
'dashboard.config.forum.topic'=>'Themenbetrag anzeigen',
'dashboard.config.forum.reply'=>'Anzahl der Antworten anzeigen',
# modal
'modal.profile'=>'Profil bearbeiten',
'modal.profile.username'=>'Geben Sie den Benutzernamen ein',
'modal.profile.name'=>'Name eingeben',
'modal.profile.oldpsw'=>'Altes Passwort',
'modal.profile.newpsw'=>'Neues Passwort eingeben',
'modal.profile.delete'=>'Konto löschen',
'modal.profile.newpsw.note'=>'Altes Passwort muss vorhanden sein',
'modal.profile.about'=>'Über dich',
'modal.profile.upload'=>'Logo hochladen (nur PNG-Dateien)',
'modal.profile.err.user'=>'Benutzername existiert bereits',
'modal.pedit.title'=>'Daten speichern',
'modal.failed.title'=>'Fehlerhafte Daten',
'modal.pedit.desc'=>'Bearbeitete Daten speichern',
'modal.pedit.psw.format'=>'Sie müssen 1 Großbuchstaben, 1 Kleinbuchstaben, 1 Zahl und 8 Zeichen haben',
'modal.pedit.psw.match'=>'Passwort stimmt nicht überein',
'modal.pedit.psw.otn'=>'Altes Passwort stimmt nicht mit neuem Passwort überein',
'modal.profile.removeAvatar'=>'Avatar entfernen',

#konfig
'config'=>'Konfig ',
'config.label'=>'Konfig ',
'config.save'=>'Speichern <i class="fas fa-save"></i>',
'config.failed'=>'Daten konnten nicht gespeichert werden',
'config.success'=>'Daten erfolgreich gespeichert',
'config.true'=>'An',
'config.false'=>'Aus',
#Tasten
'btn.disabled'=>'Sie können diese Option nicht verwenden',
'btn.drop.actions.title'=>'Aktionen',
'btn.drop.copy.url'=>'URL kopieren <i class="fas fa-link"></i>',
'btn.drop.copy.msg'=>'Nachricht kopieren <i class="fas fa-copy"></i>',
'btn.download'=>'Download <i class=\'fas fa-download\'></i>',
'btn.save'=>'Änderungen speichern',
'btn.close'=>'Nah dran',
'btn.dismissed'=>'Zurückweisen',
'btn.confirm'=>'Bestätigen',
'btn.quote'=>'<i class="fa-solid fa-comment-quote"></i> Zitieren',
# Themen
'theme.active'=>'Aktiviert <i class="fas fa-check"></i>',
'theme.deactive'=>'Deaktiviert <i class="fas fa-times"></i>',
'theme.error.missingName'=>'Fehlender Name',
'theme.error.missingDesc'=>'Fehlende Beschreibung',
'theme.allow.lang'=>'Erlaubte Sprachen: ',
'theme.allow.lang.null'=>'Nicht definiert',
'theme.missing'=>'Fehlende Theme-Konfigurationsdatei!',
# Plugins
'plugin.active'=>'Aktiviert <i class="fas fa-check"></i>',
'plugin.deactive'=>'Deaktiviert <i class="fas fa-times"></i>',
'plugin.error.missingName'=>'Fehlender Name',
'plugin.error.missingDesc'=>'Fehlende Beschreibung',
'plugin.allow.lang'=>'Erlaubte Sprachen: ',
'plugin.allow.lang.null'=>'Nicht definiert',
#Debuggen
'debug.off'=>'<a href="./configs">Debuggen</a> deaktiviert ist, können Sie keine Funktionsfehler mehr protokollieren.',
# Kontakt
'contact.title'=>'Kontakt',
'contact.email'=>'<i class="fas fa-asterisk text-danger"></i> Email',
'contact.email.placeholder'=>'Geben sie ihre E-Mailadresse ein',
'contact.emailto'=>'<i class="fas fa-asterisk text-danger"></i> Zu:',
'contact.emailto.placeholder'=>'Geben Sie die E-Mail-Adresse der Person ein: (verwenden Sie \',\' zum Trennen)',
'contact.to.example'=>'Beispiel: user1:<{user1email}>, user2:<{user2email}>...',
'contact.senderAs'=>'Senden als',
'contact.name'=>'<i class="fas fa-asterisk text-danger"></i> Name',
'contact.name.placeholder'=>'Geben Sie den vollständigen Namen ein',
'contact.subject'=>'<i class="fas fa-asterisk text-danger"></i> Thema',
'contact.subject.placeholder'=>'Betreff eingeben',
'contact.msg'=>'<i class="fas fa-asterisk text-danger"></i> Nachricht',
'contact.msg.placeholder'=>'Nachricht eingeben',
'contact.send'=>'Nachricht senden',
'contact.markasread'=>'Als gelesen markieren',
'contact.markasunread'=>'Als ungelesen markieren',
'contact.reply'=>'Antwort',
'contact.readme'=>'Lesen',
'contact.hidden'=>'Dies ist eine versteckte Nachricht nur an einen bestimmten Benutzer!',
'contact.option.all'=>'Alle',
'contact.msg.exists'=>'Nachricht existiert bereits',
'contact.report.prioiry'=>'<i class="fas fa-asterisk text-danger"></i> Priorat',
'contact.report'=>'Benutzer melden',
'contact.report.label'=>'[Hier Begründung eingeben]',
# post
'mail.success'=>'E-Mail erfolgreich gesendet an ',
'mail.failed'=>'E-Mail konnte nicht gesendet werden ',
# benachrichtigen
'notify.clear'=>'Alles als gelesen markieren',
# bilden
'errLen' => 'Zu kurz/lang',
'errNb' => 'Dies ist keine positive ganze Zahl',
'ErrContentFilter' => 'Sie haben mindestens ein zensiertes Wort eingefügt, seien Sie bitte höflich.',
'tableHeader'=>'Überschriften',
'form_active'=>'An/Aus',
# Vermögenswerte
'assets.title'=>'Vermögenswerte',
# Verbotsliste
'ban.empty'=>'Es werden keine Benutzer gesperrt',
'ban.remove'=>'Entfernen',
'ban.add'=>'Nutzer hinzufügen',
'ban.table'=>array(
'username'=>'Nutzername',
'time'=>'Veröffentlichungsdatum',
'duration'=>'Dauer',
'reason'=>'Grund',
'bannedBy'=>'Gesperrt durch',
'actions'=>'Aktionen'
),
'ban.list'=>array(
'1min'=>'+1 minute',
'3min'=>'+3 Protokoll',
'5min'=>'+5 Protokoll',
'7min'=>'+7 Protokoll',
'9min'=>'+9 Protokoll',
'11min'=>'+11 Protokoll',
'13min'=>'+13 Protokoll',
'15min'=>'+15 Protokoll',
'17min'=>'+17 Protokoll',
'19min'=>'+19 Protokoll',
'21min'=>'+21 Protokoll',
'23min'=>'+23 Protokoll',
'25min'=>'+25 Protokoll',
'27min'=>'+27 Protokoll',
'29min'=>'+29 Protokoll',
'31min'=>'+31 Protokoll',
'33min'=>'+33 Protokoll',
'35min'=>'+35 Protokoll',
'37min'=>'+37 Protokoll',
'39min'=>'+39 Protokoll',
'41min'=>'+41 Protokoll',
'43min'=>'+43 Protokoll',
'45min'=>'+45 Protokoll',
'47min'=>'+47 Protokoll',
'49min'=>'+49 Protokoll',
'51min'=>'+51 Protokoll',
'53min'=>'+53 Protokoll',
'55min'=>'+55 Protokoll',
'57min'=>'+57 Protokoll',
'59min'=>'+59 Protokoll',
'1h'=>'+1 Stunde',
'3h'=>'+3 Std',
'5h'=>'+5 Std',
'7h'=>'+7 Std',
'9h'=>'+9 Std',
'11h'=>'+11 Std',
'13h'=>'+13 Std',
'15h'=>'+15 Std',
'17h'=>'+17 Std',
'19h'=>'+19 Std',
'21h'=>'+21 Std',
'23h'=>'+23 Std',
'1d'=>'+1 Tag',
'3d'=>'+3 Tage',
'5d'=>'+5 Tage',
'1w'=>'+1 Woche',
'3w'=>'+3 Wochen',
'1m'=>'+1 Monat',
'3m'=>'+3 Monate',
'5m'=>'+5 Monate',
'7m'=>'+7 Monate',
'9m'=>'+9 Monate',
'11m'=>'+11 Monate',
'1y'=>'+1 Jahr',
'3y'=>'+3 Jahre',
'5y'=>'+5 Jahre',
'7y'=>'+7 Jahre',
'9y'=>'+9 Jahre',
'11y'=>'+11 Jahre',
'13y'=>'+13 Jahre',
'15y'=>'+15 Jahre',
'17y'=>'+17 Jahre',
'19y'=>'+19 Jahre',
'21y'=>'+21 Jahre',
'23y'=>'+23 Jahre',
'25y'=>'+25 Jahre',
'27y'=>'+27 Jahre',
'29y'=>'+29 Jahre',
'31y'=>'+31 Jahre',
'forever'=>'Bis in alle Ewigkeit'
),
'ban.byList'=>array(
'username'=>'Nutzername',
'ip'=>'IP',
'hardwareid'=>'Hardware ID'
),
'ban.forever'=>'Bis in alle Ewigkeit',
'ban.UI.title'=>'Einen Nutzer ausschließen',
'ban.UI.username'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Nutzername',
'ban.UI.time'=>'Zeit',
'ban.UI.reason'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Grund',
'ban.UI.banBy'=>'Verbot Typ',
'ban.UI.submit'=>'Einen Nutzer ausschließen',
# uploads
'upload.failed.data'=>'Kann keine Daten empfangen',
'upload.failed.large'=>'Entschuldigung, Ihre Datei ist zu groß',
'upload.failed.extentions'=>'Entschuldigung, Ihre Datei hat keine gültige Erweiterung',
'upload.failed.overrule'=>'Entschuldigung, Ihre Datei existiert bereits',
'upload.failed'=>'Entschuldigung, Ihre Datei wurde nicht hochgeladen.',
'upload.failed.rename'=>'Fehler beim Umbenennen',
'upload.success'=>array('Die Datei '.(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on' ? 'https://':'http://').$_SERVER['HTTP_HOST'].'/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/'.'uploads/', 'wurde hochgeladen.', 'avatars/'),
# Rollen
'roles.user'=>'Nutzername',
'roles.roleID'=>'Rollentyp',
'roles.edit'=>'Rolle bearbeiten',
'roles.roleSelect'=>'Rolle auswählen',
'roles.createRole'=>'Rolle erstellen',
'roles.input.name'=>'Rollenname',
'roles.input.desc'=>'Rollenbeschreibung',
'roles.input.canView'=>'Kann ansehen',
'roles.input.canWrite'=>'Kann schreibene',
'roles.input.canRead'=>'Kann lesen',
'roles.input.canDelete'=>'Kann löschen',
'roles.input.canBan'=>'Kann verbieten',
'roles.input.canPost'=>'Kann posten',
'roles.input.canReply'=>'Kann antworten',
'roles.input.canMsg'=>'Kann Nachricht',
'roles.input.plugins'=>'Kann Plugins aktivieren',
'roles.input.themes'=>'Kann Themen aktivieren',
'roles.input.config'=>'Kann Konfig',
'roles.input.canRole'=>'Kann Rollen wechseln',
'roles.input.file'=>'Kann den Dateimanager verwenden',
'roles.input.profile'=>'Profil ändern kann',
'roles.deleteRole'=>'Rolle löschen',
'roles.removeItems'=>'Wählen Sie diese Option aus, um die Rolle zu entfernen',
# dateien
'file.locked.folder'=>'Dieser Ordner ist gesperrt',
'file.locked.file'=>'Diese Datei ist gesperrt',
'file.manager.title'=>'Dateimanager',
'file.managerchmod.title'=>'Berechtigungen ändern',
'file.managerchmod.u'=>'Eigentümerrechte',
'file.managerchmod.g'=>'Gruppenrechte',
'file.managerchmod.o'=>'Andere Rechte',
'file.managerchmod.read'=>'Lesen(4)',
'file.managerchmod.write'=>'Schreiben(2)',
'file.managerchmod.execute'=>'Ausführen(1)',
'files.delete'=>'Datei löschen',
'files.chmod'=>'Dateiberechtigungen ändern',
'files.rename'=>'Datei umbenennen',
'files.remove.msg'=>'Möchten Sie entfernen ',
'files.rename.msg'=>'Datei umbenennen',
'file.rename.newName'=>'Neuer Name:',
'file.rename.oldName'=>'Alte Bezeichnung:',
'file.manager.createFile'=>'<i class="fa-solid fa-file-plus"></i> Erstelle Datei',
'file.manager.createFolder'=>'<i class="fa-solid fa-folder-plus"></i> Ordner erstellen',
'file.manager.upload'=>'<i class="fa-solid fa-upload"></i> Hochladen',
'files.addFile.msg'=>'Datei hinzufügen',
'files.addFolder.msg'=>'Ordner hinzufügen',
'files.download'=>'Download-Datei',
'file.manager.fileUpload'=>'Laden Sie hier Dateien hoch: ',
'file.manager.folderUpload'=>'Ordner hier hochladen: ',
'files.uploadFiles.msg'=>'Daten hochladen',
'files.manager.saved'=>'Datei erfolgreich gespeichert, Seite wird neu geladen, um Datei zu aktualisieren...',
'files.manager.error'=>'Fehler: Datei konnte nicht gespeichert werden, Seite wird neu geladen, um Datei zu aktualisieren...',
#expectations
'expect.lang'=>'Du musst haben '.$conf['lang'].'.php',
'expect.guest'=>'<i class="fa-solid fa-triangle-exclamation"></i> Sie befinden sich im Gastmodus, Sie können nichts anderes tun als lesen/ansehen/registrieren/anmelden, bitte <a href="./auth.php/login">anmeldung</a> or <a href="./auth.php/register">registrieren</a> ein Konto',
'expect.requiements'=>'Alle erforderlichen Formularelemente sind erforderlich!',
#forum
'forum.title'=>'Forum',
'forum.author'=>'Erstellt von: ',
'forum.sidebar'=>'Foren',
'forum.addForum'=>'Forum hinzufügen',
'forum.addTopic'=>'Thema hinzufügen',
'forum.editTopic'=>'Thema bearbeiten',
'forum.created'=>'Erstellt: ',
'forum.edited'=>'Zuletzt bearbeitet: ',
'forum.search.failed'=>'Keine Suchergebnisse gefunden',
'forum.replys'=>'Antwort&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>',
'forum.view'=>'Aussicht&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>',
'forum.replysNoIcon'=>'Antworten',
'forum.editBtn'=>'<i class="fa-solid fa-pen-to-square"></i> Bearbeiten',
'forum.removeBtn'=>'<i class="fa-solid fa-trash-can"></i> Löschen',
'forum.anonumous'=>'System',
'forum.inputForumName'=>'Forum Name',
'forum.inputForumColor'=>'Farbe eingeben',
'forum.selectIcon'=>'Wählen Sie Symbol',
'forum.inputTopicName'=>'Themenname',
'forum.inputTopicCategory'=>'Wählen Sie Forum',
'forum.entermsg'=>'Nachricht eingeben',
'forum.inputTopicAuthor'=>'Autor',
'forum.inputTopicTags'=>'Tags eingeben (verwenden Sie , zum Trennen)',
'forum.deleteTopic'=>'Thema löschen',
'forum.pinned'=>'Gepinnt',
'forum.locked'=>'Gesperrt',
'forum.toggleOpt'=>array(
	'false'=>'nein',
	'true'=>'Jawohl'
),
'fourm.guest'=>'Melden Sie sich an, um im Forum zu antworten',
'forum.recent'=>'Kürzliche Aktivitäten',
'forum.anchorID'=>'Antwort-ID kopieren',
'forum.userStatus'=>'Status',
'forum.sidebar.statistics'=>'Statistiken',
'forum.reply_drop'=>'Briefantwort',
'forum.noreply'=>'Sie haben keine Berechtigung zu antworten!',
'forum.home'=>'Heim',
'forum.category'=>'Foren',
'forum.shortSubmit'=>'Artikel sortieren',
'forum.sort'=>'Sortieren Sie Ihre Foren <b><em>(do not have multiple topics have the same int)</em></b>'
);
?>