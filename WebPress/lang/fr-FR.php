<?php
$lang = array(
'lang'=>array(
'en-US'=>'Anglais',
'de-DE'=>'Allemand',
'it-IT'=>'Italien',
'fr-FR'=>'Français'
),
'sitemap.title'=>'WebPress-Plans de site',
'index.authdown'=> 'Autorisation',
'index.registerbtn'=>'Créer un compte <i class="fas fa-user"></i>',
'index.forumbtn'=>'Forum <i class="fa-duotone fa-comments"></i>',
'index.loginbtn'=>'Connexion <i class="fas fa-sign-in"></i>',
'index.dashboardbtn'=>'Tableau de bord <i class="fas fa-tachometer"></i>',
'index.loginoutbtn'=>'Se déconnecter <i class="fas fa-sign-out"></i>',
'index.noScript'=>'Désolé Javascript n`est pas activé, veuillez l`activer!',
'index.label.copyright'=>'droits d`auteur',
'index.label.license'=>'et sous licence par',
'quote_direct'=>'Cliquez pour afficher l`original',
'index.writtable'=>'Entrez le contenu ici',
# S'inscrire
'register.title'=>'Créer un compte',
'register.name'=>'votre nom',
'register.name.place'=>'Entrez le nom complet',
'register.user'=>'Nom d`utilisateur',
'register.user.place'=>'Saisissez votre nom d`utilisateur',
'register.email'=>'Adresse e-mail',
'register.email.place'=>'Entrez une adresse e-mail valide',
'register.email.syntax'=>'Doit être une adresse e-mail valide',
'register.psw'=>'Entrer le mot de passe',
'register.psw.place'=>'Entrer le mot de passe',
'register.psw.repeat'=>'Entrez à nouveau le mot de passe',
'register.psw.repeat.place'=>'Répéter le mot de passe',
'register.psw.syntax'=> 'Doit inclure 1 majuscule, 1 minuscule, 1 chiffre, 8 caractères de long',
'register.ts' => 'J`accepte toutes les déclarations de <a href="'.$conf['page']['termsandservice'].'" class="text-body"><u>Conditions d`utilisation</u></a>',
'register.submit'=>'S`inscrire',
'register.back'=>'Retour',
'register.login'=>'Connexion',
'register.err.exist'=>'Ce nom d`utilisateur existe déjà',
'register.err.psw'=>'Vous devez avoir 1 majuscule, 1 minuscule, 1 chiffre et 8 caractères',
'register.err.email'=>'Vous devez avoir une adresse e-mail valide',
'register.err.captcha'=>'Captcha invalide',
'register.sucs.user'=>'Création réussie: ',
#connexion
'login.title'=>'Connectez-vous au compte',
'login.submit'=>'Connexion',
'login.back'=>'Retour',
'login.create'=>'S`inscrire',
'login.psw'=>'Entrer le mot de passe',
'login.err.user'=>'Le nom d`utilisateur n`existe pas',
'login.err.psw'=>'Le mot de passe ne correspond pas',
'login.user'=>'Saisissez votre nom d`utilisateur',
'login.err.token'=>'jeton invalide <i>'.CSRF::check().'</i>',
'login.token'=>'Jeton privé',
'login.token.place'=>'Entrez le jeton privé',
#auth
'auth.logout'=>'Déconnecter',
'auth.logout.desc'=>'Redirection vers la maison',
#tableau de bord
'dashboard'=>'Tableau de bord',
'dashboard.info.phpversion'=>'PHP Version',
'dashboard.info.projectName'=>'nom du projet',
'dashboard.info.projectVersion'=>'Version du projet',
'dashboard.info.projectBuild'=>'Construction du projet',
'dashboard.info.serverSoftware'=>'Logiciel serveur',
'dashboard.info.phpModules'=>'PHP Modules',
'dashboard.info.memory'=>'Mémoire',
'dashboard.info.diskSpace'=>'Espace disque',
'dashboard.info.dataStorage'=>'Stockage <em>DONNEES</em>',
'dashboard.info.uploadSize'=>'Télécharger la taille maximale',
'dashboard.config.panel.logger'=>'Console d`affichage('.($conf['page']['panel']['console']!==(int)'-1' ? 'Top <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="Afficher toutes les erreurs/avertissements en texte brut" href="../debug.log">'.$conf['page']['panel']['console'].'</a>' : '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-custom-class="custom-tooltip" title="Attention : cela peut entraîner un retard de page !"><span style="cursor:help;text-decoration:underline;color:blue;">Tout</span></span>').')',
'dashboard.config.panel.catche'=>'Vider le cache',
'dashboard.config.panel.bgcolor'=>'Arrière-plan du panneau',
'dashboard.config.panel.color'=>'Couleur du panneau',
'dashboard.config.panel.email'=>'Domaine de messagerie personnalisé',
'dashboard.config.panel.editor'=>'Éditeur',
'dashboard.config.panel.theme'=>'Thèmes',
'dashboard.config.panel.emaildisabled'=>'Vous ne pouvez pas changer cela, veuillez mettre à jour',
'dashboard.config.panel.emailHelp'=>'Entrez votre domaine personnalisé pour l`autoriser',
'dashboard.config.panel.icons'=>'Logo du site Web',
'dashboard.userKey'=>'Clé publique',
'dashboard.userKey.copy'=>'Copier la clé publique',
'dashboard.userPKey'=>'Clé privée',
'dashboard.userPKey.copy'=>'Copier la clé privée',
'dashboard.hardwareid.copy'=>'Copier l`ID du matériel',
'dashboard.title.phpinfo'=>'Tableau de bord(informations PHP)',
'dashboard.title.profile'=>'Tableau de bord(profil)',
'dashboard.title.config'=>'Tableau de bord(Config)',
'dashboard.title.docs'=>'Tableau de bord(Docs)',
'dashboard.title.themes'=>'Tableau de bord(Thèmes)',
'dashboard.title.plugins'=>'Tableau de bord(Plugins)',
'dashboard.title.console'=>'Tableau de bord(Console)',
'dashboard.title.editors'=>'Tableau de bord(éditeurs)',
'dashboard.title.mail'=>'Tableau de bord(Courrier)',
'dashboard.title.assets'=>'Tableau de bord(Actifs)',
'dashboard.title.ban'=>'Tableau de bord(liste d`interdiction)',
'dashboard.title.roles'=>'Tableau de bord(rôles)',
'dashboard.title.files'=>'Tableau de bord(fichiers)',
'dashboard.title.events'=>'Tableau de bord(Événements)',
'dashboard.title.view'=>'Tableau de bord(afficher le plugin)',
'dashboard.title.notFound'=>'Tableau de bord(Page introuvable)',
'dashboard.desc'=>'Bienvenue sur le panneau WebPress! C`est ici que vous pouvez configurer et modifier les fichiers/dossiers de votre page Web, les plugins et thèmes actifs et désactivés. Prendre plaisir!',
'dashboard.logout'=>'Se déconnecter',
'dashboard.redirect.logout.title'=>'Déconnecter',
'dashboard.redirect.logout.desc'=>'Redirection vers la connexion',
'dashboard.side'=>'WebPress Menu',
'dashboard.side.welcome.morn'=>'<span style="color:#f7cd5d;">Bonjour'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunrise"></i></span>',
'dashboard.side.welcome.after'=>'<span style="color:#fce570;">Bonne après-midi'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sun"></i></span>',
'dashboard.side.welcome.even'=>'<span style="color:#fad6a5;">Bonsoir'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-sunset"></i></span>',
'dashboard.side.welcome.night'=>'<span style="color:#003833;">Bonne nuit'.(isset($_SESSION['user']) ? ', '.$_SESSION['user'] : '').' <i class="fas fa-moon"></i></span>',
'dashboard.side.weather'=>'Temps',
'dashboard.side.home'=>'Maison <i class="fas fa-house"></i>',
'dashboard.side.back'=>'Tableau de bord <i class="fas fa-tachometer"></i>',
'dashboard.side.forum'=>'Forum <i class="fa-duotone fa-comments"></i>',
'dashboard.side.phpinfo'=>'PHP Info <i class="fa-brands fa-php"></i>',
'dashboard.side.profile'=>'Profil <i class="fas fa-user"></i>',
'dashboard.side.config'=>'Config <i class="fas fa-sliders-h"></i>',
'dashboard.side.docs'=>'Documentation <i class="fas fa-file-alt"></i>',
'dashboard.side.themes'=>'Thèmes <i class="fas fa-paint-brush"></i>',
'dashboard.side.plugins'=>'Plugins &nbsp;&nbsp;<i class="fas fa-plug" style="transform:rotate(-45deg);"></i>',
'dashboard.side.console'=>'Console <i class="fas fa-terminal"></i>',
'dashboard.side.editors'=>'Éditeurs <i class="fas fa-pen-square"></i>',
'dashboard.side.assets'=>'Les atouts <i class="fa-solid fa-books"></i>',
'dashboard.side.mail'=>'Courrier <i class="fas fa-envelope"></i>',
'dashboard.side.ban'=>'Liste d`interdiction <i class="fa-solid fa-ban"></i>',
'dashboard.side.roles'=>'Les rôles <i class="fa-solid fa-user-plus"></i>',
'dashboard.side.files'=>'Des dossiers <i class="fa-solid fa-files"></i>',
'dashboard.side.events'=>'Événements <i class="fa-regular fa-calendar-lines-pen"></i>',
'dashboard.graph.user.label'=>'utilisateurs',
'dashboard.graph.user.y'=>'Utilisateurs enregistrés',
'dashboard.graph.subtitle'=>'Ce sera clair sur ',
'dashboard.graph.views.label'=>'vues',
'dashboard.graph.views.unique'=>'unique',
'dashboard.graph.views.y'=>'Vues sur la page Web',
'dashboard.graph.forums.label'=>'Forums',
'dashboard.graph.forums.y'=>'Nombre de sujets/réponses',
'dashboard.graph.forums.topics'=>'Les sujets',
'dashboard.graph.forums.replies'=>'réponses',
'dashboard.profile.title'=>'À propos de l`utilisateur',
'dashboard.profile.hardwareID'=>'Identifiant du matériel: ',
'dashboard.profile.about'=>'<b>À propos de: </b>',
'dashboard.profile.timezone'=>'<b>Fuseau horaire: </b>',
'dashboard.profile.ip'=>'<b>IP: </b>',
'dashboard.profile.location'=>'<b>Emplacement: </b>',
'dashboard.profile.created'=>'<b>Établi: </b>',
'dashboard.profile.email'=>'<b>Email: </b>',
'dashboard.profile.name'=>'<b>Nom: </b>',
'dashboard.profile.topics'=>'<b class="text-secondary">Les sujets: </b>',
'dashboard.profile.replys'=>'<b class="text-secondary">réponses: </b>',
'dashboard.profile.forums'=>'<b class="text-secondary">Forums: </b>',
'dashboard.pageLoaded'=>'<b class=\'text-secondary\'>Chargé: </b>',
'dashboard.profile.editbtn'=>'Editer le profil',
'dashboard.profile.addBan'=>'Utilisateur banni',
'dashboard.config.title'=>'Configuration',
'dashboard.config.pageError.title'=>'Erreurs de page (HTML+MD est autorisé):',
'dashboard.config.page.title'=>'Titre de la page Web',
'dashboard.config.lang.title'=>'Langue',
'dashboard.config.400'=>'Mauvaise demande',
'dashboard.config.401'=>'Autorisation',
'dashboard.config.403'=>'Interdit',
'dashboard.config.404'=>'Page non trouvée',
'dashboard.config.500'=>'Erreur internationale',
'dashboard.config.301.help'=>'Laisser vide pour ne pas l`nclure',
'dashboard.config.debug.title'=>'Déboguer',
'dashboard.config.seo.title'=>'SEO Tools <i class="fas fa-tools"></i>',
'dashboard.config.description'=>'Entrez la description Web <i class="fas fa-edit"></i>',
'dashboard.config.author'=>'Auteur <i class="fas fa-at"></i>',
'dashboard.config.refresh'=>'Actualisation automatique <i class="fas fa-sync"></i>',
'dashboard.config.refresh.help'=>'Définissez la valeur sur 0 pour ne pas utiliser l`actualisation automatique',
'dashboard.config.keywords'=>'Entrez des mots-clés <i class="fas fa-spell-check"></i>',
'dashboard.config.keywords.help'=>'Utilisez des virgules (,) pour utiliser plusieurs mots-clés',
'dashboard.config.robotIndex.title'=>'Autoriser les robots à indexer votre site ? <i class="fas fa-robot"></i>',
'dashboard.config.robotFollow.title'=>'Autoriser les robots à suivre tous les liens ? <i class="fas fa-external-link"></i>',
'dashboard.config.rate.title'=>'Évaluation <i class="fas fa-star"></i>',
'dashboard.config.rate'=>array(
'null'=>'Non spécifié',
'14_years'=>'14 ans',
'adult'=>'Adulte',
'general'=>'Général',
'mature'=>'Mature',
'restricted'=>'Restreint',
'safe_for_kids'=>'Sûr pour les enfants'
),
'dashboard.config.copyright'=>'droits d`auteur <i class="fas fa-copyright"></i>',
'dashboard.config.distribution.title'=>'Distribution <i class="fas fa-chart-network"></i>',
'dashboard.config.distribution'=>array(
'Global'=>'Mondial',
'Local'=>'Local'
),
'dashboard.config.revisted.title'=>'Revisiter-après <i class="fas fa-exchange"></i>',
'dashboard.config.revisted'=>array(
'1_Day'=>'1 Jour',
'7_Days'=>'7 jours',
'31_Days'=>'31 jours',
'180_Days'=>'180 jours',
'360_Days'=>'360 jours'
),
'dashboard.config.charset.title'=>'Jeu de caractères <i class="fas fa-file-times"></i>',
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
'UTF-8'=>'UTF-8 (Recommandé)',
'other'=>'autre'
),
'dashboard.config.captch'=>'Captcha',
'dashboard.pageError'=>'Page non trouvée!',
'dashboard.config.forum.title'=>'Forum <i class="fa-solid fa-comments"></i>',
'dashboard.config.forum.topic'=>'Afficher le nombre de sujets',
'dashboard.config.forum.reply'=>'Afficher le montant de la réponse',
# modal
'modal.profile'=>'Editer le profil',
'modal.profile.username'=>'Saisissez votre nom d`utilisateur',
'modal.profile.name'=>'Entrez le nom',
'modal.profile.oldpsw'=>'ancien mot de passe',
'modal.profile.newpsw'=>'Entrez un nouveau mot de passe',
'modal.profile.delete'=>'Supprimer le compte',
'modal.profile.newpsw.note'=>'Doit avoir l`ancien mot de passe',
'modal.profile.about'=>'A propos de toi',
'modal.profile.upload'=>'Télécharger le logo (fichiers PNG uniquement)',
'modal.profile.err.user'=>'Ce nom d`utilisateur existe déjà',
'modal.pedit.title'=>'La sauvegarde des données',
'modal.failed.title'=>'Données échouées',
'modal.pedit.desc'=>'Enregistrement des données modifiées',
'modal.pedit.psw.format'=>'Vous devez avoir 1 majuscule, 1 minuscule, 1 chiffre et 8 caractères',
'modal.pedit.psw.match'=>'Le mot de passe ne correspond pas',
'modal.pedit.psw.otn'=>'L`ancien mot de passe ne correspond pas au nouveau mot de passe',
'modal.profile.removeAvatar'=>'Supprimer l`avatar',

#config
'config'=>'Config ',
'config.label'=>'Config ',
'config.save'=>'sauvegarder <i class="fas fa-save"></i>',
'config.failed'=>'Échec de l`enregistrement des données',
'config.success'=>'Données enregistrées avec succès',
'config.true'=>'Sur',
'config.false'=>'À l`arrêt',
#boutons
'btn.disabled'=>'Vous ne pouvez pas utiliser cette option',
'btn.drop.actions.title'=>'Actions',
'btn.drop.copy.url'=>'Copier le lien <i class="fas fa-link"></i>',
'btn.drop.copy.msg'=>'Copier le message <i class="fas fa-copy"></i>',
'btn.download'=>'Télécharger <i class=\'fas fa-download\'></i>',
'btn.save'=>'Sauvegarder les modifications',
'btn.close'=>'proche',
'btn.dismissed'=>'Rejeter',
'btn.confirm'=>'Confirmer',
'btn.quote'=>'<i class="fa-solid fa-comment-quote"></i> Devis',
# Thèmes
'theme.active'=>'Activé <i class="fas fa-check"></i>',
'theme.deactive'=>'Désactivé <i class="fas fa-times"></i>',
'theme.error.missingName'=>'Nom manquant',
'theme.error.missingDesc'=>'Description manquante',
'theme.allow.lang'=>'Langues autorisées: ',
'theme.allow.lang.null'=>'Indéfini',
'theme.missing'=>'Fichier de configuration de thème manquant!',
# Plugins
'plugin.active'=>'Activé <i class="fas fa-check"></i>',
'plugin.deactive'=>'Désactivé <i class="fas fa-times"></i>',
'plugin.error.missingName'=>'Nom manquant',
'plugin.error.missingDesc'=>'Description manquante',
'plugin.allow.lang'=>'Langues autorisées: ',
'plugin.allow.lang.null'=>'Indéfini',
#Debug
'debug.off'=>'<a href="./configs">Debug</a> est désactivé, vous ne pouvez plus consigner d`erreurs de fonctionnalités.',
# Contactez
'contact.title'=>'Contact',
'contact.email'=>'<i class="fas fa-asterisk text-danger"></i> Email',
'contact.email.placeholder'=>'Entrez votre adresse email',
'contact.emailto'=>'<i class="fas fa-asterisk text-danger"></i> À:',
'contact.emailto.placeholder'=>'Entrez l`adresse e-mail de la personne : (utilisez \',\' pour séparer)',
'contact.to.example'=>'Exemple: utilisateur1 :<{user1email}>, utilisateur2 :<{user2email}>...',
'contact.senderAs'=>'Envoi en tant que',
'contact.name'=>'<i class="fas fa-asterisk text-danger"></i> Nom',
'contact.name.placeholder'=>'Entrez le nom complet',
'contact.subject'=>'<i class="fas fa-asterisk text-danger"></i> Matière',
'contact.subject.placeholder'=>'Entrez le sujet',
'contact.msg'=>'<i class="fas fa-asterisk text-danger"></i> Message',
'contact.msg.placeholder'=>'Saisir le message',
'contact.send'=>'Envoyer le message',
'contact.markasread'=>'Marquer comme lu',
'contact.markasunread'=>'Marquer comme non lu',
'contact.reply'=>'Réponse',
'contact.readme'=>'Lis',
'contact.hidden'=>'Il s`agit d`un message masqué destiné uniquement à un utilisateur spécifique !',
'contact.option.all'=>'Tout',
'contact.msg.exists'=>'Le message existe déjà',
'contact.report.prioiry'=>'<i class="fas fa-asterisk text-danger"></i> Priorité',
'contact.report'=>'Dénoncer un utilisateur',
'contact.report.label'=>'[Entrez le raisonnement ici]',
# courrier
'mail.success'=>'Courrier envoyé avec succès à ',
'mail.failed'=>'Échec de l`envoi du courrier à ',
# notifier
'notify.clear'=>'tout marquer comme lu',
# formulaire
'errLen' => 'Trop court/long',
'errNb' => 'Ce n`est pas un nombre entier positif',
'ErrContentFilter' => 'Vous avez inséré au moins un mot censuré, merci d`être poli.',
'tableHeader'=>'En-têtes',
'form_active'=>'Sur/À l`arrêt',
# des atouts
'assets.title'=>'Des atouts',
# liste d`interdiction
'ban.empty'=>'Aucun utilisateur n`est banni',
'ban.remove'=>'Retirer',
'ban.add'=>'Ajouter un utilisateur',
'ban.table'=>array(
'username'=>'Nom d`utilisateur',
'time'=>'Date de sortie',
'duration'=>'Durée',
'reason'=>'Raison',
'bannedBy'=>'Banni par',
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
'1h'=>'+1 Heure',
'3h'=>'+3 Heures',
'5h'=>'+5 Heures',
'7h'=>'+7 Heures',
'9h'=>'+9 Heures',
'11h'=>'+11 Heures',
'13h'=>'+13 Heures',
'15h'=>'+15 Heures',
'17h'=>'+17 Heures',
'19h'=>'+19 Heures',
'21h'=>'+21 Heures',
'23h'=>'+23 Heures',
'1d'=>'+1 Jour',
'3d'=>'+3 Journées',
'5d'=>'+5 Journées',
'1w'=>'+1 La semaine',
'3w'=>'+3 Semaines',
'1m'=>'+1 Mois',
'3m'=>'+3 Mois',
'5m'=>'+5 Mois',
'7m'=>'+7 Mois',
'9m'=>'+9 Mois',
'11m'=>'+11 Mois',
'1y'=>'+1 An',
'3y'=>'+3 Ans',
'5y'=>'+5 Ans',
'7y'=>'+7 Ans',
'9y'=>'+9 Ans',
'11y'=>'+11 Ans',
'13y'=>'+13 Ans',
'15y'=>'+15 Ans',
'17y'=>'+17 Ans',
'19y'=>'+19 Ans',
'21y'=>'+21 Ans',
'23y'=>'+23 Ans',
'25y'=>'+25 Ans',
'27y'=>'+27 Ans',
'29y'=>'+29 Ans',
'31y'=>'+31 Ans',
'forever'=>'Toujours'
),
'ban.byList'=>array(
'username'=>'Nom d`utilisateur',
'ip'=>'IP',
'hardwareid'=>'Identifiant du matériel'
),
'ban.forever'=>'Toujours',
'ban.UI.title'=>'Utilisateur banni',
'ban.UI.username'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Nom d`utilisateur',
'ban.UI.time'=>'Temps',
'ban.UI.reason'=>'<i class="fa-solid fa-asterisk" style="color:red;"></i> Raison',
'ban.UI.banBy'=>'Type d`interdiction',
'ban.UI.submit'=>'Utilisateur banni',
# téléchargements
'upload.failed.data'=>'Impossible de recevoir des données',
'upload.failed.large'=>'Désolé, votre fichier est trop volumineux',
'upload.failed.extentions'=>'Désolé, votre fichier n`est pas une extension valide',
'upload.failed.overrule'=>'Désolé, votre fichier existe déjà',
'upload.failed'=>'Désolé, votre fichier n`a pas été téléchargé.',
'upload.failed.rename'=>'Impossible de renommer',
'upload.success'=>array('Le fichier '.(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on' ? 'https://':'http://').$_SERVER['HTTP_HOST'].'/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/'.'uploads/', 'a été téléchargé.', 'avatars/'),
# Les rôles
'roles.user'=>'Nom d`utilisateur',
'roles.roleID'=>'Type de rôle',
'roles.edit'=>'Modifier le rôle',
'roles.roleSelect'=>'Sélectionnez un rôle',
'roles.createRole'=>'Créer un rôle',
'roles.input.name'=>'Nom de rôle',
'roles.input.desc'=>'Description du rôle',
'roles.input.canView'=>'Peut voir',
'roles.input.canWrite'=>'Peut écrire',
'roles.input.canRead'=>'Peux lire',
'roles.input.canDelete'=>'Peut supprimer',
'roles.input.canBan'=>'Peut interdire',
'roles.input.canPost'=>'Peut poster',
'roles.input.canReply'=>'Peut répondre',
'roles.input.canMsg'=>'Peut envoyer un message',
'roles.input.plugins'=>'Peut activer les plugins',
'roles.input.themes'=>'Peut activer des thèmes',
'roles.input.config'=>'Peut configurer',
'roles.input.canRole'=>'Peut changer de rôle',
'roles.input.file'=>'Peut utiliser le gestionnaire de fichiers',
'roles.input.profile'=>'Peut changer de profil',
'roles.input.events'=>'Peut voir les événements',
'roles.deleteRole'=>'Supprimer le rôle',
'roles.removeItems'=>'Sélectionner pour supprimer le rôle',
# des dossiers
'file.locked.folder'=>'Ce dossier est verrouillé',
'file.locked.file'=>'Ce fichier est verrouillé',
'file.manager.title'=>'Gestionnaire de fichiers',
'file.managerchmod.title'=>'Modifier les autorisations',
'file.managerchmod.u'=>'Droits du propriétaire',
'file.managerchmod.g'=>'Droits de groupe',
'file.managerchmod.o'=>'Autres droits',
'file.managerchmod.read'=>'Lis(4)',
'file.managerchmod.write'=>'Écrire(2)',
'file.managerchmod.execute'=>'Exécuter(1)',
'files.delete'=>'Effacer le fichier',
'files.chmod'=>'Modifier les autorisations de fichier',
'files.rename'=>'Renommer le fichier',
'files.remove.msg'=>'Souhaitez-vous supprimer ',
'files.rename.msg'=>'Renommer le fichier',
'file.rename.newName'=>'Nouveau nom:',
'file.rename.oldName'=>'Ancien nom:',
'file.manager.createFile'=>'<i class="fa-solid fa-file-plus"></i> Créer un fichier',
'file.manager.createFolder'=>'<i class="fa-solid fa-folder-plus"></i> Créer le dossier',
'file.manager.upload'=>'<i class="fa-solid fa-upload"></i> Télécharger',
'files.addFile.msg'=>'Ajouter le fichier',
'files.addFolder.msg'=>'Ajouter le dossier',
'files.download'=>'Télécharger un fichier',
'file.manager.fileUpload'=>'Télécharger des fichiers ici: ',
'file.manager.folderUpload'=>'Télécharger des dossiers ici: ',
'files.uploadFiles.msg'=>'Télécharger des fichiers',
'files.manager.saved'=>'Fichier enregistré avec succès, rechargement de la page pour mettre à jour le fichier...',
'files.manager.error'=>'Erreur : impossible d`enregistrer le fichier, rechargement de la page pour mettre à jour le fichier...',
#attentes
'expect.lang'=>'Vous devez avoir '.$conf['lang'].'.php',
'expect.guest'=>'<i class="fa-solid fa-triangle-exclamation"></i> Vous êtes en mode invité, vous ne pouvez rien faire d`autre que lire/afficher/s`inscrire/se connecter, veuillez <a href="./auth.php/login">se connecter</a> ou <a href="./auth.php /register">enregistrer</a> un compte',
'expect.requiements'=>'Tous les éléments de formulaire requis sont obligatoires !',
#forum
'forum.title'=>'Forum',
'forum.author'=>'Créé par: ',
'forum.sidebar'=>'Forums',
'forum.addForum'=>'Ajouter un forum',
'forum.addTopic'=>'Ajouter un sujet',
'forum.editTopic'=>'Modifier le sujet',
'forum.created'=>'Établi: ',
'forum.edited'=>'Dernière modification: ',
'forum.search.failed'=>'Aucun résultat de recherche trouvé',
'forum.replys'=>'Réponse&nbsp;&nbsp;<i class="fa-solid fa-reply fs-5 mt-1"></i>',
'forum.view'=>'Voir&nbsp;&nbsp;<i class="fa-solid fa-eye fs-5 mt-1"></i>',
'forum.replysNoIcon'=>'réponses',
'forum.editBtn'=>'<i class="fa-solid fa-pen-to-square"></i> Éditer',
'forum.removeBtn'=>'<i class="fa-solid fa-trash-can"></i> Effacer',
'forum.anonumous'=>'Système',
'forum.inputForumName'=>'Nom du forum',
'forum.inputForumColor'=>'Entrez la couleur',
'forum.selectIcon'=>'Sélectionnez l`icône',
'forum.inputTopicName'=>'Nom du sujet',
'forum.inputTopicCategory'=>'Sélectionnez Forum',
'forum.entermsg'=>'Entrer un message',
'forum.inputTopicAuthor'=>'Auteur',
'forum.inputTopicTags'=>'Entrez les balises (utilisez , pour séparer)',
'forum.deleteTopic'=>'Supprimer le sujet',
'forum.pinned'=>'Épinglé',
'forum.locked'=>'Fermé à clé',
'forum.toggleOpt'=>array(
	'false'=>'non',
	'true'=>'oui'
),
'fourm.guest'=>'Connectez-vous pour répondre sur le forum',
'forum.recent'=>'Activités récentes',
'forum.anchorID'=>'Copier l`ID de réponse',
'forum.userStatus'=>'Statut',
'forum.sidebar.statistics'=>'Statistiques',
'forum.reply_drop'=>'Poster une réponse',
'forum.noreply'=>'Vous n`êtes pas autorisé à répondre!',
'forum.home'=>'Maison',
'forum.category'=>'Forums',
'forum.shortSubmit'=>'Trier les éléments',
'forum.sort'=>'Triez vos forums <b><em>(n`ayez pas plusieurs sujets avec le même numéro)</em></b>',
'forum.sortUser'=>'Veuillez vous connecter en tant qu`administrateur pour utiliser cette option',
# événements
'events.ip'=>'IP',
'events.date'=>'Date',
'events.target'=>'Cible',
'events.stat'=>'Statut',
'events.action'=>'Action'
);
?>