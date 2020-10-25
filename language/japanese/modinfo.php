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
//                  myMedia v2.1								//
//  ------------------------------------------------------------------------ 	//

define('_MI_MYMEDIA_NAME', 'myMedia');
define('_MI_MYMEDIA_DESC', 'Publish myMedias in the main myMedia or in a block');

define('_MI_MYMEDIA_MAXFILESIZE', '[LOGO] Maximum upload size');
define('_MI_MYMEDIA_MAXFILESIZEDSC', 'Sets the maximum file size allowed when uploading files. Restricted to max upload permitted on the server.');

define('_MI_MYMEDIA_IMGWIDTH', '[LOGO] Maximum image width:');
define('_MI_MYMEDIA_IMGWIDTHDSC', 'Sets the maximum allowed width of an image when uploading.');

define('_MI_MYMEDIA_IMGHEIGHT', '[LOGO] Maximum image height:');
define('_MI_MYMEDIA_IMGHEIGHTDSC', 'Sets the maximum allowed height of an image when uploading');

// define("_MI_MYMEDIA_IMGDIR","[LOGO] Images base directory:");
// define("_MI_MYMEDIA_IMGDIRDSC","This is the directory which holds the operational images. (No trailing \"/\")");

define('_MI_MYMEDIA_UPLOADDIR', '[LOGO] Image upload directory');
define('_MI_MYMEDIA_UPLOADDIRDSC', "This is the directory where 'articles' pics are going to be stored. (No trailing \"/\")");

define('_MI_MYMEDIA_DATEFORMAT', '[ADMIN] Date format:');
define('_MI_MYMEDIA_DATEFORMATDSC', 'Sets the display date format for articles');

define('_MI_MYMEDIA_PERPAGE', '[INDEX] Maximum articles per myMedia:');
define('_MI_MYMEDIA_PERPAGEDSC', 'Maximum number of articles to be displayed per page in admin and index');

define('_MI_MYMEDIA_ALLOWADMINHITS', '[ADMIN] Admin counter reads:');
define('_MI_MYMEDIA_EDALLOWADMINHITSDSC', 'Allow admin hits for stats counter?');

define('_MI_MYMEDIA_COLUMNS', '[INDEX] Index columns:');
define('_MI_MYMEDIA_COLUMNSDSC', 'Number of columns to show in the index');

define('_MI_MYMEDIA_LOGOWIDTH', "[INDEX] Logo's width");
define('_MI_MYMEDIA_LOGOWIDTHDSC', 'Standard width of the logos to show in the index page');

define('_MI_MYMEDIA_DEFAULTEXT', '[MYMEDIA] Default text');
define('_MI_MYMEDIA_DEFAULTEXTDSC', 'Default text to show in each new page');
define(
    '_MI_MYMEDIA_DEFAULTEXTEXP',
    "Welcome in myMedia.

Enter here the text you want to show in the block. Before tag -> [blockbreak].

And here the rest of your page.

To change or delete this standard text, go in myMedia's settings."
);

define('_MI_MYMEDIA_TEXTINDEX', '[INDEX] Intro');
define('_MI_MYMEDIA_TEXTINDEXDSC', 'Introduction text for Index');
define(
    '_MI_MYMEDIA_WELCOME',
    'Welcome in myMedia.

This module allows you to display pictures or mymedia on a day by day, or random basis.'
);

define('_MI_MYMEDIA_EXTOPT', '[EXT_OPTIONS] Extended options');
define('_MI_MYMEDIA_EXTOPTDSC', 'Activate the extended options for advanced users.');

define('_MI_MYMEDIA_EXTOPT_TITLE', '[EXT_OPTIONS] Display title');
define('_MI_MYMEDIA_EXTOPTDSC_TITLE', 'Create a new page with the title shown.');

define('_MI_MYMEDIA_EXTOPT_MAIN', '[EXT_OPTIONS] Display in sub-menu');
define('_MI_MYMEDIA_EXTOPTDSC_MAIN', 'Create a new page with a link in the main menu.');

define('_MI_MYMEDIA_EXTOPT_LOGO', '[EXT_OPTIONS] Display logos');
define('_MI_MYMEDIA_EXTOPTDSC_LOGO', 'Create a new page with the picture in the index.');

define('_MI_MYMEDIA_LOGO_ALIGN', '[LOGO] Logo alignment');
define('_MI_MYMEDIA_LOGO_ALIGNDSC', 'Select the alignment of the logo for all pages.');

define('_MI_MYMEDIA_LOGO_ALIGN_LEFT', 'Left');
define('_MI_MYMEDIA_LOGO_ALIGN_CENTER', 'Center');
define('_MI_MYMEDIA_LOGO_ALIGN_RIGHT', 'Right');

define('_MI_MYMEDIA_EXTOPT_BACK2INDEX', "[EXT_OPTIONS] Display 'Back to index' link");
define('_MI_MYMEDIA_EXTOPTDSC_BACK2INDEX', "Display the 'Back to index link' on each page.");

define('_MI_MYMEDIA_EXTOPT_BLOCK', "[EXT_OPTIONS] Display block's mymedia");
define('_MI_MYMEDIA_EXTOPTDSC_BLOCK', "Create a new page with the blocks's mymedia in the page.");

define('_MI_MYMEDIA_META_KEYWORDS', '[EXT_OPTIONS] Module Meta Keywords');
define('_MI_MYMEDIA_META_KEYWORDS_DSC', 'myMedia automatically creates Meta Keywords from the titles of your page. However, you can add custom keywords here you would like to add on each page of this module. ');

define('_MI_MYMEDIA_META_DESCRIPTION', '[EXT_OPTIONS] Module Meta Description');
define('_MI_MYMEDIA_META_DESC_DSC', 'You can customize here the meta decsription of the pages inside your module. If this textarea is empty, the default Meta Decsription of your site will prevail.');

define('_MI_MYMEDIA_ORDER', '[INDEX] Order');
define('_MI_MYMEDIA_ORDERDSC', 'Standard order of the pages');
define('_MI_MYMEDIA_ORDER_SUBJECT_ASC', 'Title ascending');
define('_MI_MYMEDIA_ORDER_SUBJECT_DESC', 'Title descending');
define('_MI_MYMEDIA_ORDER_DATE_ASC', 'Oldest first');
define('_MI_MYMEDIA_ORDER_DATE_DESC', 'Newest first');
define('_MI_MYMEDIA_ORDER_HIT', 'View');
define('_MI_MYMEDIA_ORDER_READ_DESC', 'Most viewed');

// Nom des menus dans la partie admnistration
define('_MI_MYMEDIA_INDEX', 'Index');
define('_MI_MYMEDIA_HELP', 'Help');

define('_MI_MYMEDIA_BLOCNAME_01', "Today's Media");
define('_MI_MYMEDIA_BLOCNAME_02', 'Random Media');
define('_MI_MYMEDIA_BLOCNAME_03', 'Latest');
define('_MI_MYMEDIA_BLOCNAME_04', 'Popular');
define('_MI_MYMEDIA_BLOCNAME_05', 'Menu 1');
define('_MI_MYMEDIA_BLOCNAME_06', 'Menu 2');

define('_MI_MYMEDIA_TPL01_DESC', 'Display pages list');
define('_MI_MYMEDIA_TPL02_DESC', "Display a page's mymedia");
define('_MI_MYMEDIA_BLOC01_DESC', 'Display the page in a block');
define('_MI_MYMEDIA_BLOC02_DESC', 'Display the page in a block');
define('_MI_MYMEDIA_BLOC03_DESC', 'Display the page in a block');
define('_MI_MYMEDIA_BLOC04_DESC', 'Display the page in a block');
define('_MI_MYMEDIA_BLOC05_DESC', 'Display the Online page list in a block');
define('_MI_MYMEDIA_BLOC06_DESC', 'Display a random page in a block');

//Version 2.3
define('_MI_MYMEDIA_WYSIWYG', '[ADMIN] Use Wysiwyg editor');
define('_MI_MYMEDIA_WYSIWYGDSC', 'Use the Wysiwyg editor to create or edit a page.');

define('_MI_MYMEDIA_TAGS', '[INDEX] Display icons');
define('_MI_MYMEDIA_TAGSDSC', 'Display new and popular icons in the index page. If set yes, reduced logo would be displayed in the list at the bottom of each page, if list is selected.');

define('_MI_MYMEDIA_TAGS_NEW', '[INDEX] New icon (in days)');
define('_MI_MYMEDIA_TAGSDSC_NEW', 'Display new icon in the index page for X days.');

define('_MI_MYMEDIA_TAGS_POP', '[INDEX] Popularity icon');
define('_MI_MYMEDIA_TAGSDSC_POP', 'Display popular icon in the index page for x visits.');

define('_MI_MYMEDIA_INDEX_LOGO', "[INDEX] Index/page's header logo");
define('_MI_MYMEDIA_INDEXDSC_LOGO', 'Display a logo on index page and each and every pages. Leave blank for none.');

define('_MI_MYMEDIA_INDEX_CONTENT', '[INDEX] Replace Index by page :');
define(
    '_MI_MYMEDIA_INDEXDSC_CONTENT',
    "Display a page or another myMedia instead of the main Index page.<br>
- Add page's ID or an http/https url.<br>
- Leave blank for the standard Index page."
);

// myMedia 2.4

define('_MI_MYMEDIA_NAV_LINKS', '[MEDIA] Navigation links');
define(
    '_MI_MYMEDIA_NAVDSC_LINKS',
    'Type of navigation list to display on each and every mymedia of the current parent page.<br>
- <i>List</i> : displayed in a table at page bottom.<br>
- <i>Path</i> : displayed in a row at content bottom.'
);
define('_MI_MYMEDIA_NAV_LINKS_NONE', 'None');
define('_MI_MYMEDIA_NAV_LINKS_LIST', 'List');
define('_MI_MYMEDIA_NAV_LINKS_PATH', 'Path');

define('_MI_MYMEDIA_MEDIADIR', '[MEDIA] Media base path');
define('_MI_MYMEDIA_MEDIADIRDSC', "This is the directory where 'medias' are going to be stored. (No trailing \"/\")");

define('_MI_MYMEDIA_MEDIA_DISPLAY', '[MEDIA] Media display');
define('_MI_MYMEDIA_MEDIA_DISPLAYDSC', 'Display mode for medias.');
define('_MI_MYMEDIA_MEDIA_POPUP', 'Popup');
define('_MI_MYMEDIA_MEDIA_PAGE', 'Page');
define('_MI_MYMEDIA_MEDIA_BOTH', 'Both');

define('_MI_MYMEDIA_MEDIA_SIZE', '[MEDIA] Media size');
define('_MI_MYMEDIA_MEDIADSC_SIZE', 'Display size format');
define('_MI_MYMEDIA_SIZE_DEFAULT', '- none -');
define('_MI_MYMEDIA_SIZE_TVSMALL', 'TV Small');
define('_MI_MYMEDIA_SIZE_TVMEDIUM', 'TV Medium');
define('_MI_MYMEDIA_SIZE_TVBIG', 'TV Large');
define('_MI_MYMEDIA_SIZE_MVSMALL', 'Movie Small');
define('_MI_MYMEDIA_SIZE_MVMEDIUM', 'Movie Medium');
define('_MI_MYMEDIA_SIZE_MVBIG', 'Movie Large');
define('_MI_MYMEDIA_CUSTOM', '[MEDIA] Custom size');
define('_MI_MYMEDIA_SIZE_CUSTOM', 'Custom');
?>
