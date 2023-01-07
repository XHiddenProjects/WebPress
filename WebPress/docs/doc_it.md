[Documentazione grezza](../docs/doc_en.md)

# WebPress

Un semplice CMS che utilizza il database JSON e utilizzato per tutte le pagine Web, inclusi dominio e host locali

### [cos`è questo?](./docs#cos%60è-questo)

questo è un semplice CMS che ti consente di utilizzare User Infrence (UI) e consentire una ricerca più semplice utilizzando informazioni SEO di alta qualità e strutture di costruzione semplici. Questo utilizza i file JSON per creare/creare pagine sulla tua pagina web. Le tue pagine sono costruite da codici scritti, che poi vengono convertiti in file JSON.

***

### [Requisiti](./docs#requirements) {#requirements}

###### Requisiti di sistema
- PHP 7.4 o superiore
- Server Web (Apache)
###### Estensioni PHP
- Modulo PHP [GD](http://php.net/manual/en/book.mbstring.php) per l'elaborazione delle immagini.
- Modulo PHP [JSON](https://php.net/manual/en/book.json.php) per la manipolazione di JSON.
- Modulo PHP [mbstring](http://php.net/manual/en/book.mbstring.php) per il pieno supporto UTF-8.

***

### [Nozioni di base](./docs#basics) {#basics}

Le basi di questi sono semplici una volta che accedi a questo URL `http(s)://{tuo_dominio}/` o `http(s)://{tuo_dominio}/{cartella}` ci sono 2 **HTACCESS** che 1 sarà la tua pagina principale (WebPress) e l'altra sarà *La tua home page* per il tuo sito web. che sarà nella sua cartella indipendente.

***

### [Come si installa?](./docs#how-to-install) {#how-to-install}

Per installare, basta inserire *Un-ZIPED* la cartella nel tuo *HTDocs (cartella principale)* per avviare l'esecuzione del software. Una volta terminato, vai su `http(s)://{tuo_dominio}/` o aggiungi `./{cartella}/` per accedere alla pagina WebPress principale **Consigliato: htdocs**. Dopo che sei lì, inizia configurando il tuo dopo aver creato l'account _** (Questo sarà l'impostazione predefinita per Admin al primo registro, dopodiché diventerai un membro) **_.

***

### [aggiornamento delle versioni](./docs#updating) {#updating}
1. Esegui il backup dei tuoi dati in modo che nulla venga distrutto.
2. Elimina completamente la cartella "vecchia versione".
3. Al termine, registra un nuovo account per eventuali modifiche.
4. Ricaricare i dati nella cartella dati e configurazione (è possibile eseguire i backup utilizzando il plug-in di backup)

***

### [Ruoli](./docs#roles) {#ruoli}

I ruoli sono importanti, sono molto personalizzabili e ne hanno 3 principali, *admin, mod e member* Questo consentirà agli utenti di accedere in modo diverso.

`admin`, hai tutto il controllo su come le persone possono visualizzare e vedere cosa cambia e notificare. Può anche avere l'aiuto di `mod` per modificare le pagine e migliorare le cose. Modifica il plugin e cambia i temi, ecc. Banna gli utenti per _name_ o _ip_.

`mod` può aiutare `admin` accedendo all'editor (se consentito da `admin`) per migliorare le pagine. Possono anche segnalare qualsiasi attività sospetta e l'amministratore la riceverà.

`member` può solo visualizzare e utilizzare gli elementi della pagina.

"guest" è un account predefinito quando non sei registrato/accedi, puoi solo visualizzare e leggere i dati.

controlla il [Documento Jobs](#jobs) per cosa puoi fare con lo stato degli utenti.

***

### [Pagine di errore](./docs#error-pages) {#error-pages}

Puoi creare pagine di errore personalizzate in [_dashboard.php/configs_](./configs) e creare errori personalizzati in modo che la tua pagina possa mostrare qualcosa, invece di una noiosa vecchia pagina di errore.

Elenco dei documenti di errore (modificabile)

1. 400 - Richiesta errata
2. 401 - Aut. richiesta
3. 403 - Proibito
4. 404 - Non trovato
5. 500 - Errore interno del server

***

### [Lavori](./docs#jobs) {#jobs}

Sotto forma di ruoli di moderazione. Ecco una tabella predefinita per te

| Etichetta | Destinazione | costume? |
| ---- | ------ | --------- |
| amministratore| primo reddito | X |
| moderatore | utenti specificati | X |
| membro | utenti registrati | X |
| ospite | utenti sconosciuti | X |

Se vuoi aggiungere il tuo, vai a _ROLES.json_

Inserisci questo codice
cambia "[obj]" nel nome del tipo, cambia anche true/false per consentire o non consentire tale autorizzazione.
```json
"[oggetto]":{
"nome": "[nomeoggetto]",
"description": "[objdesc]",
"opzioni":{
"vista": vero,
"scrivi": vero,
"leggere": falso,
"cancella": falso,
"divieto": falso,
"avvisare": falso,
"posta": falso,
"risposta": falso,
"onComingMessages": falso,
"activePlugins": falso,
"activeThemes": falso,
"config": falso,
"changeRoles": falso,
"filemanager": falso,
"changeProfile": falso
}
}
```

### [Editor](./docs#editors) {#editors}

Gli editor utilizzati da questo progetto sono __BBCode__, __Markdown__ e __WYSIWYG__

### [Chiave pubblica vs privata](./docs#public-vs-private-key) {#public-vs-private-key}

La chiave pubblica è ciò che useresti per la configurazione di qualsiasi plugin che richiede quella chiave,
La chiave privata è ciò che viene utilizzato per il login di backup, che da una posizione diversa lo utilizza per accedervi.
La chiave pubblica consente plug-in e temi per le informazioni dell'utente.

### [ganci](./docs#hooks) {#hooks}

Con gli hook puoi intercettare tutti i tipi di eventi WebPress per iniettare il tuo codice.

Ecco un elenco di ganci disponibili:

| gancio | eseguire in | nota |
| ---- | ---------- | ---- |
| Profilo | `temi` | viene visualizzato nella pagina del profilo |
| modifica_profilo | `temi` | modifica sull'editor del profilo |
| testa | `temi` | viene eseguito nel tag __head__ |
| navigazione | `temi` | viene visualizzato nella barra di navigazione |
| editore | `temi` | viene visualizzato nella barra dell'editor |
| piè di paginaJS | `temi` | Esegue il codice nel piè di pagina (come __Javascript__) |
| piè di pagina | `temi` | Esegue il codice nel piè di pagina |
| dblist | `nucleo` | viene visualizzato negli elenchi del dashboard |
| primaPagina | `nucleo` | esegue il codice prima del caricamento della pagina |
| dopoPagina | `nucleo` | eseccodice utes dopo il caricamento della pagina |
| rispostaBottom | `nucleo` | viene visualizzato nella parte inferiore del messaggio di risposta |

### [Ban](./docs#bans) {#bans}

I ban dovrebbero essere usati molto indietro, ma tu (l'amministratore) avrai tutto l'accesso per farlo, hai 3 modi per bannare gli utenti

###### __Ban:__
1. Proprietà intellettuale
2. Nome utente
3. ID hardware (divieto rigido)

Può essere temporaneo utilizzando il formato (`m-d-Y H:i:s`) o il tipo (`-1`) per un tempo _illimitato_

### [Toolkit](./docs#toolkits) {#toolkits}

I toolkit sono molto utili in molti casi, questo può funzionare per _plugins_ procedendo come segue

Inserisci in `{plugin_name}.plg.php`:

```php
<?php
include_once(ROOT.'/libs/toolkit.lib.php');
# Usa `toolkits` come TOOLKIT;
usa WebPress\toolkits come TOOLKIT;
# carica il toolkit
$kit = nuovo TOOLKIT();
# Funzioni (questi sono selettori predefiniti, lascia i pramaters null per usare solo default)
$kit->useColor($color='nero');
$kit->useFontWeight($fontWeight='bold');
$kit->useFontStyle($fontStyle='italic');
$kit->useFontSize($fontStyle=25, $units='px');
$kit->setAllies($func, $parma=null);
# convertire
$kit->__toBool($txt);
$kit->__toStr($txt);
$kit->__toInt($txt);
$kit->__toFloat($txt);
?>
```

### [Caricamento file](./docs#caricamento file) {#caricamento file}
Anche il caricamento di file ha i suoi limiti, puoi caricare qualsiasi cosa, ma alcuni elementi non possono essere modificati (ad esempio immagini, video, ecc.).
La dimensione massima di caricamento è quella che il tuo server può gestire. Puoi caricare qualsiasi tipo di file, alcuni potrebbero essere modificabili, altri no, prova a non caricare nulla che potrebbe avere un software di iniezione che consente l'accesso agli account.
Gli utenti che caricano elementi nel 'forum' sono limitati (visualizzalo nella cartella `config`)

### [Ricerca nel forum](./docs#forum-searching) {#forum-searching}
Il forum cerca uno strumento avanzato per trovare le cose più facilmente, ma deve includere un keywork per permettergli di funzionare
esempio, _(tags:fun)_, il modello di sintassi è `{selettore}:{valore}`

Selettori consentiti:
* tag
* Forum
* argomento
* stato

### [Temi](./docs#themes) {#themes}
I temi sono ciò che fa apparire il software come appare, è facile da configurare e configurare.

Ecco come lo imposti.
1. Copia la cartella "Predefinita" nella _cartella del tema_ (questa operazione è necessaria, perché la maggior parte delle cartelle è necessaria affinché funzioni).
2. Vai su `theme.conf.json` e modifica tutto ciò che deve essere modificato.
3. Divertiti, inizia a inserire i codici css/js nella tua cartella e dai uno stile alla tua pagina.

### [Norme](./docs#policy) {#policy}


##### WebPress - Politica

Benvenuto in WebPress, un CMS open source e self-hosting gratuito e Forum-Script. In qualità di sviluppatore (io stesso) mi diverto a creare software che chiunque possa usare e avere un uso equo dei dati, dal momento che questa è classificata come una piattaforma di _social media_, posso dirti che i social media sono sfuggiti di mano con ideali abusivi e non attualmente moderazione. Quindi, anche se questo ti permette di dire quello che ti piace, ho intenzione di essere una **_moderazione di seconda mano_** Leggi di più...

  

#### Permesso

* Condividi le tue opinioni
* Condividi le tue idee/richieste
* Ideali politici/termologici
* Vendi prodotti o promuovi a tua scelta (assicurati che sia appropriato)
* Carica/Pubblica quello che vuoi (assicurati che sia appropriato)
* Rispondi come preferisci

  

#### Non consentito

* Vendita di articoli illegali: (18 U.S. Code § 1170)
* Abuso di minori/pornografia: Abuso di minori: (34 U.S. Code § 20341) | Pornografia infantile: (18 codice degli Stati Uniti § 2256)
* Minacce/Commenti dannosi: (6 Codice degli Stati Uniti § 1508)
* Condivisione di informazioni personali di altri, senza consenso: (18 Codice degli Stati Uniti § 798)
* Furto di identità: (Ohio Admin. Code 3354:1-20-09)

  

**SE TUTTI QUESTI SONO VIOLATI** gli amministratori possono vietare/rimuovere l'account o _possono essere utilizzati contro il tribunale con qualsiasi informazione fornita correttamente. Esempio: immagini/video/post/risposte e tutto ciò che può essere mostrato_ che può essere mostrato alle autorità federali.

  

#### Amministrazione

Tutte queste regole si riferiscono anche a te, non solo ai tuoi _Clienti_. I tuoi _Clienti_ possono segnalare il tuo account e saranno decisi da [surveybuilderteams](#). La tua punizione può essere una _rimozione dell'account_. SurveyBuilderTeams ha tolleranza 0 con qualsiasi cosa **protezione dei minori** o falsa messa al bando **SENZA** e una spiegazione ragionevole.

  

#### Amministratori segnalanti

Sul lato dello schermo ci sarà una barra della chat visualizzata sul lato. Compila le informazioni, questo richiederà quanto segue:

1. Nome utente
2. Nome e Cognome
3. Data di ban (verrà mostrata nella schermata di ban)
4. Reson of ban (verrà mostrato nella schermata del ban)
5. Collegamento alla fonte del divieto (fornito dall'amministratore, assicurati di richiederlo).

Se richiedi il link alla fonte del ban, gli amministratori **SONO OBBLIGATI** a fornirlo, altrimenti il ​​giudizio verrebbe annullato e il ban verrà rilasciato, poiché l'amministratore non ha dimostrato le prove.
**Nota:** non manomettere _NESSUNA_ prova durante la revisione, questo è controllabile e può verificarsi una punizione.

  

Se hai domande, ponile nelle [discussioni](https://github.com/surveybuilderteams/WebPress/discussions/2) su github.

### Medias
Metti mi piace su [alternativeto.net](https://alternativeto.net/software/webpress)

Voto positivo su [producthunt](https://www.producthunt.com/posts/webpress)