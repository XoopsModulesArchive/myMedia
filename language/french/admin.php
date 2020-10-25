<?php

//  ------------------------------------------------------------------------ 	//
//                XOOPS - PHP Content Management System    				//
//                    Copyright (c) 2004 XOOPS.org                       	//
//                       <https://www.xoops.org>                              //
//                   										//
//                  Authors :									//
//						- solo (www.wolfpackclan.com)         	//
//						- christian (www.edom.org)		 	//
//						- herve (www.herve-thouzard.com)   		//
//                  myMedia v2.2								//
//  ------------------------------------------------------------------------ 	//

//	Partie administration
// admin/fichier index.php
define('_AM_MYMEDIA_CREATE', 'Créer nouvelle page');
define('_AM_MYMEDIA_ADD', 'Ajouter');
define('_AM_MYMEDIA_LIST', 'Liste des pages');
define('_AM_MYMEDIA_ID', 'N°');
define('_AM_MYMEDIA_SUBJECT', 'Sujet');
define('_AM_MYMEDIA_BEGIN', 'Début de la page');
define('_AM_MYMEDIA_COUNTER', 'Lectures');
define('_AM_MYMEDIA_LINE', 'Status');
define('_AM_MYMEDIA_OFFLINE', 'Désactivé');
define('_AM_MYMEDIA_ONLINE', 'En ligne');
define('_AM_MYMEDIA_ACTIONS', 'Actions');
define('_AM_MYMEDIA_EDIT', 'Editer');
define('_AM_MYMEDIA_DELETE', 'Effacer');
define('_AM_NO_MYMEDIA', 'Aucune page à afficher');

// admin/content.php
define('_AM_MYMEDIA_NOMYMEDIATOEDIT', 'Aucune myMedia à éditer');
define('_AM_MYMEDIA_ADMINARTMNGMT', 'Gestion des pages');
define('_AM_MYMEDIA_MODMYMEDIA', "Modification d'un Media");
define('_AM_MYMEDIA_CREATING', 'Créer un nouveau Media');
define('_AM_MYMEDIA_BODY', "Contenu de la page<p><font color='red'><i>Utilisez la balise [blockbreak]<br>pour déterminer le contenu<br>à afficher dans le bloc</i></font>");
define('_AM_MYMEDIA_SELECT_IMG', 'Image de la page');
define('_AM_MYMEDIA_UPLOADIMAGE', "Chargement d'une image");
define('_AM_MYMEDIA_ALLOWCOMMENTS', 'Autoriser les commentaires ?');
define('_AM_MYMEDIA_SWITCHOFFLINE', 'En ligne ?');
define('_AM_MYMEDIA_BLOCK', 'Afficher le contenu du Bloc dans <br><i>(si balise [blockbreak])</i>');
define('_AM_MYMEDIA_OPTIONS', 'Options');
define('_AM_MYMEDIA_NOHTML', 'D&eacute;sactiver les balises HTML');
define('_AM_MYMEDIA_NOSMILEY', 'D&eacute;sactiver Smileys ');
define('_AM_MYMEDIA_NOXCODE', 'D&eacute;sactiver codes XOOPS<br>Si cette case est cochée et que votre site est multilangues, ces fonctions seront inopérantes');
define('_AM_MYMEDIA_NOTITLE', 'Afficher le titre');
define('_AM_MYMEDIA_NOLOGO', 'Afficher le logo');
define('_AM_MYMEDIA_NOMAIN', 'Afficher dans le menu principal');
define('_AM_MYMEDIA_SUBMIT', 'Valider');
define('_AM_MYMEDIA_CLEAR', 'Effacer');
define('_AM_MYMEDIA_CANCEL', 'Annuler');
define('_AM_MYMEDIA_MODIFY', 'Modifier');
define('_AM_MYMEDIA_FILEEXISTS', 'Le fichier existe déjà !');
define('_AM_MYMEDIA_MYMEDIACREATED', 'Nouvelle page créé avec succès');
define('_AM_MYMEDIA_MYMEDIANOTCREATED', 'Impossible de créer une nouvelle page');
define('_AM_MYMEDIA_MYMEDIAMODIFIED', 'Base de données mise à jour avec succès');
define('_AM_MYMEDIA_MYMEDIANOTUPDATED', "La base de données n'a pu être mise à jour");
define('_AM_MYMEDIA_MYMEDIACANTPARENT', 'Une page mère ne peut se lier à elle-même ou à sa fille !');
define('_AM_MYMEDIA_MYMEDIADELETED', 'Page supprimé avec succès');
define('_AM_MYMEDIA_DELETETHISMYMEDIA', 'Confirmez-vous la suppression de cet page :');
define('_AM_MYMEDIA_HIDDEN', "Afficher dans la page d'index");
// Modifs Hervé
define('_AM_MYMEDIA_YES', _YES);
define('_AM_MYMEDIA_NO', _NO);
// Ajouts Hervé
define('_AM_MYMEDIA_GROUPS', 'Groupes');
define('_AM_MYMEDIA_NO_MYMEDIA', 'Aucune page');

// Barre de Navigation
define('_AM_MYMEDIA_NAV_MAIN', 'Aller au module');
define('_AM_MYMEDIA_NAV_LIST', 'Liste des pages');
define('_AM_MYMEDIA_NAV_CREATE', 'Créer une nouvelle page');
define('_AM_MYMEDIA_NAV_PREFERENCES', 'Préférences');
define('_AM_MYMEDIA_NAV_SEE', 'Voir la page');
define('_MI_MYMEDIA_NAV_HELP', 'Aide');
define('_AM_MYMEDIA_BLOCK_LINK', 'Administration des blocs');
define('_AM_MYMEDIA_BLOCK_MYMEDIA', 'Blocs Contenu');
define('_AM_MYMEDIA_BLOCK_MENU', 'Blocs Menu');

// myMedia
define('_AM_MYMEDIA_SELECT_MEDIA', "Media local<p><font color='red'>Fichiers dans le répertoire :<br>'<i>" . $xoopsModuleConfig['sbmediadir'] . "/<i>'</font>");

define('_AM_MYMEDIA_MEDIA', "Media externe<p><font color='red'>Type d'url supporté :<br><i>- http://<br>- https://<i></font>");
define('_AM_MYMEDIA_MEDIATYPE', 'Media Local ');
define('_AM_MYMEDIA_MEDIAURL', 'Media Externe');

define('_AM_MYMEDIA_PARENT', 'Page père');
define('_AM_MYMEDIA_PID', 'ID Père');

define('_AM_MYMEDIA_MEDIA_SIZE', "Format d'affichage");

define('_AM_MYMEDIA_MEDIA_SIZE', 'Select Media display size');
define('_AM_MYMEDIA_SELECT_DEFAULT', '- aucun -');
define('_AM_MYMEDIA_SELECT_TVSMALL', 'TV Petit');
define('_AM_MYMEDIA_SELECT_TVMEDIUM', 'TV Moyen');
define('_AM_MYMEDIA_SELECT_TVBIG', 'TV Large');
define('_AM_MYMEDIA_SELECT_CUSTOM', 'Personnalisé');
define('_AM_MYMEDIA_SELECT_MVSMALL', 'MOVIE Petit');
define('_AM_MYMEDIA_SELECT_MVMEDIUM', 'MOVIE Moyen');
define('_AM_MYMEDIA_SELECT_MVBIG', 'MOVIE Large');
?>
