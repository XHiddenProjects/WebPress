[Rohdokumentation](../docs/doc_en.md)

# WebPress

Ein einfaches CMS, das eine JSON-Datenbank verwendet und für alle Webseiten verwendet wird, einschließlich Domain und Localhosts

### [was ist das?](./docs#was-ist-das) {#was-ist-das}

Dies ist ein einfaches CMS, mit dem Sie User Infrence (UI) verwenden und eine einfachere Suche mit hochwertigen SEO-Informationen und einfachen Gebäudestrukturen ermöglichen. Dies verwendet JSON-Dateien, um Seiten auf Ihrer Webseite zu erstellen/erstellen. Ihre Seiten werden durch geschriebene Codes erstellt, die dann in eine JSON-Datei konvertiert werden.

***

### [Anforderungen](./docs#Anforderungen) {#Anforderungen}

###### System Anforderungen
- PHP 7.4 oder höher
- Webserver (Apache)
###### PHP-Erweiterungen
- PHP [GD](http://php.net/manual/en/book.mbstring.php) Modul zur Bildverarbeitung.
- PHP [JSON](https://php.net/manual/en/book.json.php) Modul zur JSON-Manipulation.
- PHP-[mbstring](http://php.net/manual/en/book.mbstring.php)-Modul für volle UTF-8-Unterstützung.

***

### [Grundlagen](./docs#Grundlagen) {#Grundlagen}

Die Grundlagen sind einfach, sobald Sie auf diese URL `http(s)://{your_domain}/` oder `http(s)://{your_domain}/{folder}` zugreifen, gibt es 2 **HTACCESS** dafür 1 wird Ihre Hauptseite (WebPress) sein und die andere wird *Ihre Startseite* für Ihre Website sein. die sich in einem eigenen unabhängigen Ordner befinden.

***

### [Wie installiere ich?](./docs#how-to-install) {#how-to-install}

Zur Installation fügen Sie einfach den *Un-ZIPED*-Ordner in Ihre *HTDocs (Root-Ordner)* ein, um die Software auszuführen. Wenn Sie fertig sind, gehen Sie zu `http(s)://{your_domain}/` oder fügen Sie `./{folder}/` hinzu, um auf die Hauptseite von WebPress zuzugreifen **Empfohlen: htdocs**. Nachdem Sie dort angekommen sind, konfigurieren Sie zunächst Ihr Konto _** (Dies ist bei der ersten Registrierung standardmäßig Admin, danach werden Sie Mitglied)**_.

***

### [Versionen aktualisieren](./docs#updating) {#aktualisierung}
1. Sichern Sie Ihre Daten, damit nichts zerstört wird.
2. Löschen Sie den Ordner „alte Version“ vollständig.
3. Wenn Sie fertig sind, registrieren Sie ein neues Konto für alle Änderungen.
4. Laden Sie Ihre Daten zurück in den Daten- und Konfigurationsordner (Backups können mit dem Backup-Plugin erstellt werden)

***

### [Rollen](./docs#roles) {#roles}

Rollen sind wichtig, sie sind sehr anpassbar und haben 3 Hauptrollen, *admin, mod und member*. Dadurch haben Benutzer unterschiedliche Zugriffsrechte.

`admin`, haben Sie die volle Kontrolle darüber, wie die Leute sehen und sehen können, welche Änderungen und Benachrichtigungen. Kann auch `mod` haben, um Seiten zu bearbeiten und die Sache zu verbessern. Bearbeiten Sie Plugins und ändern Sie Themen usw. Sperren Sie Benutzer nach _name_ oder _ip_.

`mod` kann `admin` helfen, indem es auf den Editor zugreift (sofern von `admin` erlaubt), um Seiten besser zu machen. Sie können auch jede verdächtige Aktivität melden und der "Admin" wird sie erhalten.

`member` kann Seitenelemente nur anzeigen und verwenden.

„Gast“ ist ein Standardkonto, wenn Sie nicht registriert/angemeldet sind, können Sie Daten nur anzeigen und lesen.

Sehen Sie sich das [Jobs-Dokument](#jobs) an, um zu erfahren, was Sie mit dem Benutzerstatus tun können.

***

### [Fehlerseiten](./docs#Fehlerseiten) {#Fehlerseiten}

Sie können benutzerdefinierte Fehlerseiten in [_dashboard.php/configs_](./configs) erstellen und benutzerdefinierte Fehler erstellen, damit Ihre Seite etwas anzeigen kann, anstatt einer langweiligen alten Fehlerseite.

Liste der Fehlerdokumente (editierbar)

1. 400 - Fehlerhafte Anfrage
2. 401 - Authentifizierung erforderlich
3. 403 - Verboten
4. 404 - Nicht gefunden
5. 500 - Interner Serverfehler

***

### [Jobs](./docs#jobs) {#jobs}

In Form von Moderationsrollen. Hier ist eine Tabelle, die Ihnen voreingestellt ist

| Tag | Ziel | Brauch? |
| ---- | ------ | --------- |
| Administrator| erstes Einkommen | X |
| Moderator | angegebene Benutzer | X |
| Mitglied | registrierte Benutzer | X |
| Gast | unbekannte Benutzer | X |

Wenn Sie Ihre eigenen hinzufügen möchten, gehen Sie zu _ROLES.json_

Geben Sie diesen Code ein
ändern Sie `[obj]` in den Namen des Typs, ändern Sie auch true/false, um diese Berechtigung zuzulassen oder zu verweigern.
```json
"[obj]":{
"name": "[objname]",
"Beschreibung": "[objdesc]",
"Optionen":{
"Ansicht": wahr,
"schreiben": wahr,
"lesen": falsch,
"löschen": falsch,
"Verbot": falsch,
"warnen": falsch,
"post": falsch,
"antworten": falsch,
"onComingMessages": falsch,
"activePlugins": falsch,
"activeThemes": falsch,
"config": falsch,
"changeRoles": falsch,
"Dateimanager": falsch,
"changeProfile": falsch
}
}
```

### [Redakteure](./docs#editors) {#editors}

Die von diesem Projekt verwendeten Editoren sind __BBCode__, __Markdown__ und __WYSIWYG__

### [Öffentlicher vs. privater Schlüssel](./docs#public-vs-private-key) {#public-vs-private-key}

Der öffentliche Schlüssel ist das, was Sie für die Konfiguration jedes Plugins verwenden würden, das diesen Schlüssel benötigt,
Der private Schlüssel wird für die Backup-Anmeldung verwendet, die ihn von verschiedenen Standorten aus für den Zugriff verwendet.
Der öffentliche Schlüssel ermöglicht Ihnen Plugins und Themen für Benutzerinformationen.

### [Haken](./docs#Haken) {#Haken}

Mit Hooks können Sie alle Arten von WebPress-Ereignissen abfangen, um Ihren eigenen Code einzufügen.

Hier ist eine Liste der verfügbaren Haken: **(Verwenden Sie die englische Übersetzung für `function_name`)**

| Haken | ausführen in | Hinweis |
| ---- | ---------- | ---- |
| Profile | `Themen` | wird auf der Profilseite angezeigt |
| edit_profile | `Themen` | im Profileditor bearbeiten |
| head | `Themen` | wird im __head__-Tag | ausgeführt
| nav | `Themen` | wird in der Navigationsleiste angezeigt |
| editor | `Themen` | wird in der Editorleiste angezeigt |
| footerJS | `Themen` | Führt Code in der Fußzeile aus (als __Javascript__) |
| footer | `Themen` | Führt Code in der Fußzeile aus |
| dblist | `Kern` | wird in den Listen des Dashboards angezeigt |
| beforePage | `Kern` | führt Code vor dem Laden der Seite aus |
| afterPage | `Kern` | Exekutivenutzt den Code nach dem Laden der Seite |
| init | `Kern` | wird ausgeführt, bevor alles geladen wird |
| profileCards_box | `Forum` | wird im Feld "Profilkarte" | angezeigt
| profileCards_btn | `Forum` | wird in der Schaltflächengruppe "Profilkarte" | angezeigt
| beforeMsg | `Forum` | wird angezeigt, bevor die Nachricht geladen wird |
| afterMsg | `Forum` | wird angezeigt, nachdem die Nachricht geladen wurde |
| bottomReply | `Forum` | erscheint am Ende der Antwortnachricht |
| bottomTopic | `Forum` | wird unten in der Themennachricht angezeigt |

### [Verbote](./docs#Verbote) {#Verbote}

Sperren sollten sehr selten verwendet werden, aber Sie (der Administrator) haben alle Zugriffsmöglichkeiten, Sie haben 3 Möglichkeiten, Benutzer zu sperren

###### __Verbote:__
1. IP
2. Benutzername
3. Hardware-ID (Hard Ban)

Es kann temporär sein, indem Sie das Format (`m-d-Y H:i:s`) verwenden oder (`-1`) für _unbegrenzte_ Zeit eingeben

### [Toolkits](./docs#toolkits) {#toolkits}

Toolkits sind in vielen Fällen sehr hilfreich, dies kann für _Plugins_ funktionieren, indem Sie Folgendes tun

Fügen Sie in die `{plugin_name}.plg.php` ein:

```php
<?php
include_once(ROOT.'/libs/toolkit.lib.php');
# `Toolkits` als TOOLKIT verwenden;
verwenden Sie WebPress\toolkits als TOOLKIT;
# Toolkit laden
$kit = neues TOOLKIT();
# Funktionen (dies sind Standardselektoren, lassen Sie Pramaters null, um nur den Standard zu verwenden)
$kit->useColor($color='black');
$kit->useFontWeight($fontWeight='bold');
$kit->useFontStyle($fontStyle='italic');
$kit->useFontSize($fontStyle=25, $units='px');
$kit->setAllies($func, $parma=null);
# Konvertieren
$kit->__toBool($txt);
$kit->__toStr($txt);
$kit->__toInt($txt);
$kit->__toFloat($txt);
?>
```

### [Datei-Upload](./docs#Datei-Upload) {#Datei-Upload}
Das Hochladen von Dateien hat auch seine Einschränkungen, Sie können alles hochladen, aber einige Elemente können nicht bearbeitet werden (z. B. Bilder, Videos usw.).
Die maximale Upload-Größe ist das, was Ihr Server verarbeiten kann. Sie können jeden Dateityp hochladen, einige können bearbeitet werden, andere nicht. Versuchen Sie, nichts hochzuladen, das möglicherweise eine Injektionssoftware enthält, die den Zugriff auf Konten ermöglicht.
Benutzer, die Artikel in das 'Forum' hochladen, sind eingeschränkt (im Ordner 'config' anzeigen)

### [Suche im Forum](./docs#forum-searching) {#forum-searching}
Das Forum sucht nach einem fortschrittlichen Tool, um Dinge einfacher zu finden, aber es muss eine Schlüsselfunktion enthalten, damit es funktioniert
Beispiel, _(tags:fun)_, das Syntaxmuster ist `{selector}:{value}`

Erlaubte Selektoren:
* Stichworte
*Forum
* Thema
*Zustand

### [Themen](./docs#themes) {#themes}
Themen lassen die Software so aussehen, wie sie aussieht, sie ist einfach einzurichten und konfigurierbar.

So richten Sie es ein.
1. Kopieren Sie den Ordner `Default` in den _theme-Ordner_ (dies ist erforderlich, da die meisten Ordner dafür benötigt werden).
2. Gehen Sie zu `theme.conf.json` und ändern Sie alles, was geändert werden muss.
3. Viel Spaß, beginnen Sie mit dem Platzieren von CSS/JS-Codes in Ihrem Ordner und gestalten Sie Ihre Seite.

### [Richtlinien](./docs#policy) {#policy}


##### WebPress - Richtlinie

Willkommen bei WebPress, einem kostenlosen Open-Source- und selbsthostenden CMS und Forum-Skript. Als Entwickler (ich selbst) macht es Spaß, Software zu entwickeln, die jeder verwenden kann, und die Daten fair zu nutzen, da dies als _Social Media_-Plattform klassifiziert wird, kann ich Ihnen sagen, dass Social Media mit missbräuchlicher Macht und nicht angemessen aus dem Ruder gelaufen ist moderieren. Auch wenn Sie auf diese Weise sagen können, was Sie möchten, werde ich einspringen, um eine **_Second-Hand-Moderation_** zu sein. Weiterlesen...

  

#### Erlaubt

* Teilen Sie Ihre Meinung
* Teilen Sie Ihre Ideen/Wünsche
* Politische/terminologische Ideale
* Verkaufen Sie Produkte oder werben Sie nach Ihrer Wahl (stellen Sie sicher, dass es angemessen ist)
* Hochladen/Posten, was immer Sie möchten (stellen Sie sicher, dass es angemessen ist)
* Antworten Sie, was Sie wollen

  

#### Unzulässig

* Verkauf illegaler Artikel: (18 U.S. Code § 1170)
* Kindesmissbrauch/Pornografie: Kindesmissbrauch: (34 U.S. Code § 20341) | Kinderpornografie: (18 U.S. Code § 2256)
* Drohungen/schädliche Kommentare: (6 U.S. Code § 1508)
* Weitergabe personenbezogener Daten an andere ohne Zustimmung: (18 U.S. Code § 798)
* Identitätsdiebstahl: (Ohio Admin. Code 3354:1-20-09)

  

**WENN ALLE DIESE VERLETZT WERDEN** Administratoren können das Konto sperren/entfernen oder _kann vor Gericht verwendet werden, wenn alle Informationen korrekt angegeben werden. Beispiel: Bilder/Videos/Beiträge/Antworten und alles, was gezeigt werden kann_, das Bundesbehörden gezeigt werden kann.

  

#### Verwaltung

Alle diese Regeln beziehen sich auch auf Sie, nicht nur auf Ihre _Kunden_. Ihre _Kunden_ können Ihr Konto melden und werden von [XHiddenProjects](#) entschieden. Ihre Bestrafung kann eine _Kontolöschung_ sein. XHiddenProjects hat 0 Toleranz gegenüber allem **Mangelnder Kinderschutz** oder falscher Sperrung **OHNE** und angemessener Erklärung.

  

#### Meldende Administratoren

An der Seite Ihres Bildschirms wird eine Chat-Leiste angezeigt. Füllen Sie die Informationen aus, dies erfordert Folgendes:

1. Benutzername
2. Vor- und Nachname
3. Datum der Sperre (wird auf dem Sperrbildschirm angezeigt)
4. Reson of Ban (wird auf dem Ban-Bildschirm angezeigt)
5. Link zur Quelle des Verbots (vom Administrator bereitgestellt, stellen Sie sicher, dass Sie es anfordern.)

Wenn Sie den Link zur Quelle des Banns anfordern, müssen die Administratoren **ERFORDERLICH** diesen angeben, andernfalls würde das Urteil aufgehoben und der Bann aufgehoben, da der Administrator keinen Beweis erbracht hat.
**Hinweis:** Manipulieren Sie _KEINE_ Beweise bei der Überprüfung, dies ist überprüfbar und kann bestraft werden.

Wenn Sie Fragen haben, stellen Sie sie in den [Diskussionen](https://github.com/XHiddenProjects/WebPress/discussions/2) auf github.

### Medien
Like auf [alternativeto.net](https://alternativeto.net/software/webpress)

Upvote auf [producthunt](https://www.producthunt.com/posts/webpress)

Zusammenarbeiten [Github](https://github.com/XHiddenProjects/WebPress)