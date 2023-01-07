[Documentation brute](../docs/doc_fr.md)

# WebPress

Un CMS simple qui utilise la base de données JSON et utilisé pour toutes les pages Web, y compris le domaine et les hôtes locaux

### [qu'est-ce que c'est ?](./docs#what-is-this) {#what-is-this}

Il s'agit d'un CMS simple qui vous permet d'utiliser User Infrence (UI) et de faciliter la recherche en utilisant des informations SEO de haute qualité et des structures de construction simples. Cela utilise des fichiers JSON pour créer/créer des pages sur votre page Web. Vos pages sont construites par des codes écrits, qui sont ensuite convertis en fichier JSON.

***

### [Exigences](./docs#requirements) {#requirements}

###### Configuration requise
- PHP 7.4 ou supérieur
- Serveur Web (Apache)
###### Extensions PHP
- Module PHP [GD](http://php.net/manual/en/book.mbstring.php) pour le traitement d'images.
- Module PHP [JSON](https://php.net/manual/en/book.json.php) pour la manipulation de JSON.
- Module PHP [mbstring](http://php.net/manual/en/book.mbstring.php) pour une prise en charge complète de l'UTF-8.

***

### [Bases](./docs#basics) {#basics}

Les bases de ceux-ci sont simples une fois que vous accédez à cette URL `http(s)://{votre_domaine}/` ou `http(s)://{votre_domaine}/{dossier}` il y a 2 **HTACCESS** qui aura 1 étant votre page principale (WebPress) et l'autre sera * Votre page d'accueil * pour votre site Web. qui sera dans son propre dossier indépendant.

***

### [Comment installer ?](./docs#how-to-install) {#how-to-install}

Pour l'installer, insérez simplement *Un-ZIPED* le dossier dans votre *HTDocs (dossier racine)* pour commencer à exécuter le logiciel. Une fois que vous avez terminé, allez sur `http(s)://{votre_domaine}/` ou ajoutez `./{dossier}/` pour accéder à la page WebPress principale **Recommandé : htdocs**. Une fois que vous y êtes, commencez par configurer votre compte après avoir créé _** (Ce sera par défaut sur Admin lors du premier enregistrement, après quoi vous serez membre) **_.

***

### [mise à jour des versions](./docs#updating) {#updating}
1. Sauvegardez vos données pour que rien ne soit détruit.
2. Supprimez entièrement le dossier "ancienne version".
3. Une fois cela fait, enregistrez un nouveau compte pour tout changement.
4. Rechargez vos données dans le dossier data and config (des sauvegardes peuvent être effectuées à l'aide du plugin de sauvegarde)

***

### [Rôles](./docs#roles) {#roles}

Les rôles sont importants, ils sont très personnalisables et en ont 3 principaux, *admin, mod et member* Cela donnera aux utilisateurs un accès différent.

`admin`, ayez tout le contrôle sur la façon dont les gens peuvent voir et voir les changements et notifier. Peut également avoir une aide "mod" pour modifier les pages et améliorer les choses. Modifiez le plugin et changez les thèmes, etc. Bannissez les utilisateurs par _name_ ou _ip_.

`mod` peut aider `admin` en accédant à l'éditeur (si autorisé par `admin`) pour améliorer les pages. Ils peuvent également signaler toute activité suspecte et l'"administrateur" la recevra.

`member` peut uniquement afficher et utiliser les éléments de la page.

`guest` est un compte par défaut lorsque vous n'êtes pas enregistré/connecté, vous pouvez uniquement afficher et lire les données.

consultez le [Document des travaux](#jobs) pour savoir ce que vous pouvez faire avec le statut des utilisateurs.

***

### [Pages d'erreur](./docs#error-pages) {#error-pages}

Vous pouvez créer des pages d'erreur personnalisées dans le [_dashboard.php/configs_](./configs) et créer des erreurs personnalisées afin que votre page puisse afficher quelque chose, au lieu d'une ancienne page d'erreur ennuyeuse.

Liste des documents d'erreur (modifiable)

1. 400 - Mauvaise demande
2. 401 - Authentification requise
3. 403 - Interdit
4. 404 - Introuvable
5. 500 - Erreur interne du serveur

***

### [Tâches](./docs#jobs) {#jobs}

Sous forme de rôles de modération. Voici un tableau qui vous est proposé par défaut

| Balise | Cible | Douane? |
| ---- | ------ | --------- |
| administrateur| premiers revenus | X |
| modérateur | utilisateurs spécifiés | X |
| membre | utilisateurs enregistrés | X |
| invité | utilisateurs inconnus | X |

Si vous souhaitez ajouter le vôtre, accédez au _ROLES.json_

Entrez ce code
remplacez `[obj]` par le nom du type, modifiez également true/false pour autoriser ou interdire cette autorisation.
```json
"[obj]":{
"name": "[nom_objet]",
"description": "[objdesc]",
"choix":{
"voir": vrai,
"écrire": vrai,
"lire": faux,
"supprimer": faux,
"interdire": faux,
"avertir": faux,
"poster": faux,
"répondre": faux,
"onComingMessages": faux,
"ActivePlugins": faux,
"activeThemes": faux,
"config": faux,
"changeRoles": faux,
"gestionnaire de fichiers": faux,
"changeProfile": faux
}
}
```

### [Éditeurs](./docs#éditeurs) {#éditeurs}

Les éditeurs utilisés par ce projet sont __BBCode__, __Markdown__ et __WYSIWYG__

### [Clé publique vs clé privée](./docs#clé-publique-vs-privée) {#clé-publique-vs-privée}

La clé publique est ce que vous utiliseriez pour la configuration de tout plugin qui nécessite cette clé,
La clé privée est ce qui est utilisé pour la connexion de sauvegarde, qui à partir d'un emplacement différent l'utilise pour y accéder.
La clé publique vous permet des plugins et des thèmes pour les informations utilisateur.

### [hooks](./docs#hooks) {#hooks}

Avec les crochets, vous pouvez intercepter toutes sortes d'événements WebPress pour injecter votre propre code.

Voici une liste des crochets disponibles :

| crochet | exécuter dans | remarque |
| ---- | ---------- | ---- |
| Profil | `thèmes` | s'affiche sur la page de profil |
| modifier_profil | `thèmes` | modifier sur l'éditeur de profil |
| tête | `thèmes` | s'exécute dans la balise __head__ |
| navigation | `thèmes` | s'affiche dans la barre de navigation |
| éditeur | `thèmes` | s'affiche dans la barre d'édition |
| footerJS | `thèmes` | Exécute le code dans le pied de page (comme __Javascript__) |
| pied de page | `thèmes` | Exécute le code dans le pied de page |
| dblist | `noyau` | s'affiche sur les listes du tableau de bord |
| avantPage | `noyau` | exécute le code avant le chargement de la page |
| aprèsPage | `noyau` | exécutecode après le chargement de la page |
| répondreBas | `noyau` | s'affiche en bas du message de réponse |

### [Bannis](./docs#bans) {#bans}

Les interdictions doivent être utilisées très rarement, mais vous (l'administrateur) aurez tout accès pour le faire, vous avez 3 façons d'interdire les utilisateurs

###### __Interdit :__
1. IP
2. Nom d'utilisateur
3. ID matériel (interdiction définitive)

Il peut être temporaire en utilisant le format (`m-d-Y H:i:s`) ou le type (`-1`) pour un temps _illimité_

### [Boîtes à outils](./docs#toolkits) {#boîtes à outils}

Les boîtes à outils sont très utiles dans de nombreux cas, cela peut fonctionner pour les _plugins_ en procédant comme suit

Insérez dans le `{plugin_name}.plg.php` :

```php
<?php
include_once(ROOT.'/libs/toolkit.lib.php');
# Utilisez `toolkits` comme TOOLKIT ;
utiliser WebPress\toolkits comme TOOLKIT ;
# charger la boîte à outils
$kit = nouveau TOOLKIT();
# Fonctions (ce sont des sélecteurs par défaut, laissez les paramètres nuls pour n'utiliser que la valeur par défaut)
$kit->useColor($color='noir');
$kit->useFontWeight($fontWeight='bold');
$kit->useFontStyle($fontStyle='italic');
$kit->useFontSize($fontStyle=25, $units='px');
$kit->setAllies($func, $parma=null);
# convertir
$kit->__toBool($txt);
$kit->__toStr($txt);
$kit->__toInt($txt);
$kit->__toFloat($txt);
?>
```

### [Téléchargement de fichiers](./docs#file-uploading) {#file-uploading}
Le téléchargement de fichiers a également ses limites, vous pouvez télécharger n'importe quoi, mais certains éléments ne peuvent pas être modifiés (par exemple, des images, des vidéos, etc.).
La taille de téléchargement maximale correspond à ce que votre serveur peut gérer. Vous pouvez télécharger n'importe quel type de fichier, certains peuvent être modifiables, d'autres non, essayez de ne rien télécharger qui puisse avoir un logiciel d'injection qui permet d'accéder aux comptes.
Les utilisateurs qui téléchargent des éléments dans le "forum" sont limités (voir dans le dossier "config")

### [Recherche de forum](./docs#forum-searching) {#forum-searching}
Le forum recherche un outil avancé pour trouver les choses plus facilement, mais il doit inclure un travail clé pour lui permettre de fonctionner
exemple, _(tags:fun)_, le modèle de syntaxe est `{selector} :{value}`

Sélecteurs autorisés :
* Mots clés
* forums
* sujet
* statut

### [Thèmes](./docs#themes) {#thèmes}
Les thèmes sont ce qui donne au logiciel l'apparence qu'il a, il est facile à configurer et configurable.

Voici comment vous l'avez configuré.
1. Copiez le dossier "Default" dans le _theme folder_ (cela est nécessaire, car la plupart des dossiers sont nécessaires pour que cela fonctionne).
2. Accédez au `theme.conf.json` et modifiez tout ce qui doit être modifié.
3. Profitez-en, commencez à placer des codes css/js dans votre dossier et stylisez votre page.

### [Politiques](./docs#policy) {#policy}


##### WebPress - Politique

Bienvenue sur WebPress, un CMS et Forum-Script libre et auto-hébergé. En tant que développeur (moi-même) aime créer des logiciels pour que tout le monde puisse les utiliser et faire un usage équitable des données, car cela est classé comme une plate-forme de _médias sociaux_, je peux vous dire que les médias sociaux sont devenus incontrôlables avec des idéaux abusifs et pas actuellement modération. Donc, même si cela vous permet de dire ce que vous aimez, je vais participer pour être une **_modération de seconde main_** Lire la suite...

  

#### Autorisé

* Partagez vos opinions
* Partagez vos idées/demandes
* Idéaux politiques/termologiques
* Vendez des produits ou faites la promotion de votre choix (assurez-vous que c'est approprié)
* Téléchargez / publiez ce que vous voulez (assurez-vous que c'est approprié)
* Répondez comme vous voulez

  

#### Refusé

* Vente d'articles illégaux : (18 U.S. Code § 1170)
* Abus d'enfants/pornographie : Abus d'enfants : (34 U.S. Code § 20341) | Pornographie enfantine : (18 U.S. Code § 2256)
* Menaces/Commentaires nuisibles : (6 U.S. Code § 1508)
* Partage d'informations personnelles d'autres personnes, sans consentement : (18 U.S. Code § 798)
* Usurpation d'identité : (Ohio Admin. Code 3354:1-20-09)

  

** SI TOUTES CES CONDITIONS SONT VIOLÉES **, les administrateurs peuvent interdire / supprimer le compte ou _ peuvent être utilisés contre le tribunal avec toutes les informations fournies correctement. Exemple : images/vidéos/messages/réponses et tout ce qui peut être montré_ qui peut être montré aux autorités fédérales.

  

#### Administration

Toutes ces règles font également référence à vous, et pas seulement à vos _Clients_. Vos _Clients_ peuvent signaler votre compte et seront décidés par [surveybuilderteams](#). Votre punition peut être une _suppression de compte_. SurveyBuilderTeams a une tolérance de 0 avec toute **protection de l'enfant** ou fausse interdiction **SANS** et explication raisonnable.

  

#### Administrateurs de rapports

Sur le côté de votre écran, il y aura une barre de discussion affichée sur le côté. Remplissez les informations, cela nécessitera des éléments suivants :

1. Nom d'utilisateur
2. Nom et prénom
3. Date d'interdiction (sera affichée sur l'écran d'interdiction)
4. Reson of ban (sera affiché sur l'écran d'interdiction)
5. Lien vers la source de l'interdiction (fourni par l'administrateur, assurez-vous de le demander.)

Si vous demandez le lien vers la source de l'interdiction, les administrateurs ** SONT OBLIGÉS ** de le fournir, sinon le jugement serait annulé et l'interdiction serait levée, car l'administrateur n'a pas réussi à prouver la preuve.
**Remarque :** Ne modifiez _AUCUNE_ preuve lors de l'examen, cela est vérifiable et des sanctions peuvent survenir.

  

Si vous avez des questions, posez-les sur les [discussions](https://github.com/surveybuilderteams/WebPress/discussions/2) sur github.

### Des médias
Comme sur [alternativeto.net](https://alternativeto.net/software/webpress)

Votez pour [producthunt](https://www.producthunt.com/posts/webpress)