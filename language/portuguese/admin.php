<?php
//  ------------------------------------------------------------------------ 	//
//                XOOPS - PHP Content Management System    				//
//                    Copyright (c) 2004 XOOPS.org                       	//
//                       <https://www.xoops.org>                              //
//                   										//
//                  Authors :									//
//						- solo (www.wolfpackclan.com)         	//
//						-  christian (www.edom.org)		 	//
//						-  herve (www.herve-thouzard.com)   	//
//                  page v2.1								//
//  ------------------------------------------------------------------------ 	//

//	Partie administration
// admin/fichier index.php
define('_AM_MYMEDIA_CREATE', 'Create new page');
define('_AM_MYMEDIA_ADD', 'Add');
define('_AM_MYMEDIA_LIST', "Page's list");
define('_AM_MYMEDIA_ID', 'N°');
define('_AM_MYMEDIA_SUBJECT', 'Subject');
define('_AM_MYMEDIA_BEGIN', 'Text');
define('_AM_MYMEDIA_COUNTER', 'Reads');
define('_AM_MYMEDIA_LINE', 'Status');
define('_AM_MYMEDIA_OFFLINE', 'Offline');
define('_AM_MYMEDIA_ONLINE', 'Online');
define('_AM_MYMEDIA_ACTIONS', 'Actions');
define('_AM_MYMEDIA_EDIT', 'Edit');
define('_AM_MYMEDIA_DELETE', 'Delete');
define('_AM_NO_MYMEDIA', 'No page to display');

// admin/page.php
define('_AM_MYMEDIA_NOMYMEDIATOEDIT', 'No page to edit');
define('_AM_MYMEDIA_ADMINARTMNGMT', 'page management');
define('_AM_MYMEDIA_MODMYMEDIA', 'Modify page');
define('_AM_MYMEDIA_CREATING', 'Creating new page');
define('_AM_MYMEDIA_BODY', "Page's content<p><font color='red'><i>Use the [blockbreak] tag<br>to delimit the content<br>to display in the related block</i></font>");
define('_AM_MYMEDIA_SELECT_IMG', 'Page illustration');
define('_AM_MYMEDIA_UPLOADIMAGE', 'Upload picture');
define('_AM_MYMEDIA_ALLOWCOMMENTS', 'Allow comments?');
define('_AM_MYMEDIA_SWITCHOFFLINE', 'Online?');
define('_AM_MYMEDIA_BLOCK', 'Hide Block mymedia<br><i>(if [blockbreak] tag used)</i>');
define('_AM_MYMEDIA_OPTIONS', 'Options');
define('_AM_MYMEDIA_NOHTML', 'Deactivate HTML');
define('_AM_MYMEDIA_NOSMILEY', 'Deactivate Smileys');
define('_AM_MYMEDIA_NOXCODE', 'Deactivate XOOPS codes');
define('_AM_MYMEDIA_NOTITLE', 'Display title');
define('_AM_MYMEDIA_NOLOGO', 'Display logo');
define('_AM_MYMEDIA_NOMAIN', 'Display Main menu link');
define('_AM_MYMEDIA_SUBMIT', 'Submit');
define('_AM_MYMEDIA_CLEAR', 'Delete');
define('_AM_MYMEDIA_CANCEL', 'Cancel');
define('_AM_MYMEDIA_MODIFY', 'Modify');
define('_AM_MYMEDIA_FILEEXISTS', 'Files already exists!');
define('_AM_MYMEDIA_MYMEDIACREATED', 'New page successfully created');
define('_AM_MYMEDIA_MYMEDIANOTCREATED', 'Impossible to creat a new page');
define('_AM_MYMEDIA_MYMEDIACANTPARENT', "Parent page can't link to herself or to a child!");
define('_AM_MYMEDIA_MYMEDIAMODIFIED', 'Database successfully updated');
define('_AM_MYMEDIA_MYMEDIANOTUPDATED', 'Database not updated');
define('_AM_MYMEDIA_MYMEDIADELETED', 'page successfully deleted');
define('_AM_MYMEDIA_DELETETHISMYMEDIA', 'Are you sure you want to delete this page?');
define('_AM_MYMEDIA_HIDDEN', 'Diplay in index');

// Modifs Hervé
define('_AM_MYMEDIA_YES', _YES);
define('_AM_MYMEDIA_NO', _NO);

// Ajouts Hervé
define('_AM_MYMEDIA_GROUPS', 'Groups');
define('_AM_MYMEDIA_NO_MYMEDIA', 'No page');

// Barre de Navigation
define('_AM_MYMEDIA_NAV_MAIN', 'Go to Index page');
define('_AM_MYMEDIA_NAV_LIST', "pages' list");
define('_AM_MYMEDIA_NAV_CREATE', 'Create a new page');
define('_AM_MYMEDIA_NAV_PREFERENCES', 'Settings');
define('_AM_MYMEDIA_NAV_SEE', 'See current Page');
define('_MI_MYMEDIA_NAV_HELP', 'Help');
define('_AM_MYMEDIA_BLOCK_LINK', 'Visible Bloc Admin');
define('_AM_MYMEDIA_BLOCK_MYMEDIA', 'Content Blocks');
define('_AM_MYMEDIA_BLOCK_MENU', 'Menu Blocks');

// page
define('_AM_MYMEDIA_SELECT_MEDIA', "Local Media<p><font color='red'>Files in directory:<br>'<i>" . $xoopsModuleConfig['sbmediadir'] . "/<i>'</font>");
define('_AM_MYMEDIA_MEDIA', "External Media<p><font color='red'>URL type supported:<br><i>- http://<br>- https://<i></font>");

define('_AM_MYMEDIA_MEDIATYPE', 'Local media');
define('_AM_MYMEDIA_MEDIAURL', 'External media');

define('_AM_MYMEDIA_PARENT', 'Parent page');
define('_AM_MYMEDIA_PID', 'Parent ID');

define('_AM_MYMEDIA_MEDIA_SIZE', 'Select Media display size');
define('_AM_MYMEDIA_SELECT_DEFAULT', '- none -');
define('_AM_MYMEDIA_SELECT_TVSMALL', 'TV Small');
define('_AM_MYMEDIA_SELECT_TVMEDIUM', 'TV Medium');
define('_AM_MYMEDIA_SELECT_TVBIG', 'TV Large');
define('_AM_MYMEDIA_SELECT_CUSTOM', 'Custom');
define('_AM_MYMEDIA_SELECT_MVSMALL', 'Movie Small');
define('_AM_MYMEDIA_SELECT_MVMEDIUM', 'Movie Medium');
define('_AM_MYMEDIA_SELECT_MVBIG', 'Movie Large');
?>
