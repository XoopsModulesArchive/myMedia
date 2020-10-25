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
//						- Marcan (www.smartfactory.ca)   		//
//                  myMedia v1.0.4								//
//  ------------------------------------------------------------------------ 	//

//InfoModule
$modversion['name'] = _MI_MYMEDIA_NAME;
$modversion['version'] = 1.0;
$modversion['description'] = _MI_MYMEDIA_DESC;
$modversion['credits'] = 'http://www.wolfpackclan.com';
$modversion['author'] = 'Solo-Christian-Hervé';
$modversion['license'] = 'GPL';
$modversion['image'] = 'images/mymedia_slogo.png';
$modversion['dirname'] = 'myMedia';

//SQL
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'myMedia';

//Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'myMedia_search';

//Menu
global $xoopsDB, $xoopsUser, $xoopsModuleConfig;
require_once XOOPS_ROOT_PATH . '/modules/' . $modversion['dirname'] . '/include/functions_block.php';
$modversion['hasMain'] = 1;
$subcount = 1;
$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];
$sublinks = $xoopsDB->query(
    '
SELECT id, pid, subject, groups 
FROM ' . $xoopsDB->prefix('myMedia') . ' 
WHERE offline = 1 AND nomain = 1
ORDER BY ' . myMedia_getmoduleoption('order') . ''
);
if (false !== $sublinks) {
    while (list($id, $pid, $subject, $groups) = $xoopsDB->fetchRow($sublinks)) {
        $groups = explode(' ', $groups);

        if (count(array_intersect($group, $groups)) > 0) {
            if (0 == $pid) {
                $pid = $id;
            }

            $modversion['sub'][$subcount]['name'] = $subject;

            $modversion['sub'][$subcount]['url'] = 'content.php?id=' . $id . '&pid=' . $pid;

            $subcount++;
        }
    }
}

// Templates
$modversion['templates'][1]['file'] = 'mymedia_index.html';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'mymedia_item.html';
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = 'mymedia_block.html';
$modversion['templates'][3]['description'] = '';
$modversion['templates'][4]['file'] = 'mymedia_menu_block.html';
$modversion['templates'][4]['description'] = '';
$modversion['templates'][5]['file'] = 'mymedia_image_block.html';
$modversion['templates'][5]['description'] = '';
$modversion['templates'][6]['file'] = 'mymedia_list_block.html';
$modversion['templates'][6]['description'] = '';

// Blocks
$modversion['blocks'][1]['file'] = 'content.php';
$modversion['blocks'][1]['name'] = _MI_MYMEDIA_BLOCNAME_01;
$modversion['blocks'][1]['description'] = '';
$modversion['blocks'][1]['show_func'] = 'a_myMedia_show';
$modversion['blocks'][1]['edit_func'] = 'a_myMedia_edit';
$modversion['blocks'][1]['options'] = '512|latest|0|1|1';
$modversion['blocks'][1]['template'] = 'mymedia_block_01.html';

$modversion['blocks'][2]['file'] = 'content.php';
$modversion['blocks'][2]['name'] = _MI_MYMEDIA_BLOCNAME_02;
$modversion['blocks'][2]['description'] = '';
$modversion['blocks'][2]['show_func'] = 'a_myMedia_show';
$modversion['blocks'][2]['edit_func'] = 'a_myMedia_edit';
$modversion['blocks'][2]['options'] = '512|random|0|1|1';
$modversion['blocks'][2]['template'] = 'mymedia_block_02.html';

$modversion['blocks'][3]['file'] = 'content.php';
$modversion['blocks'][3]['name'] = _MI_MYMEDIA_BLOCNAME_03;
$modversion['blocks'][3]['description'] = '';
$modversion['blocks'][3]['show_func'] = 'a_myMedia_show';
$modversion['blocks'][3]['edit_func'] = 'a_myMedia_edit';
$modversion['blocks'][3]['options'] = '512|latest|0|1|1';
$modversion['blocks'][3]['template'] = 'mymedia_block_03.html';

$modversion['blocks'][4]['file'] = 'content.php';
$modversion['blocks'][4]['name'] = _MI_MYMEDIA_BLOCNAME_04;
$modversion['blocks'][4]['description'] = '';
$modversion['blocks'][4]['show_func'] = 'a_myMedia_show';
$modversion['blocks'][4]['edit_func'] = 'a_myMedia_edit';
$modversion['blocks'][4]['options'] = '512|read|0|1|1';
$modversion['blocks'][4]['template'] = 'mymedia_block_04.html';

$modversion['blocks'][5]['file'] = 'content.php';
$modversion['blocks'][5]['name'] = _MI_MYMEDIA_BLOCNAME_05;
$modversion['blocks'][5]['description'] = '';
$modversion['blocks'][5]['show_func'] = 'a_myMedia_menu_show';
$modversion['blocks'][5]['edit_func'] = 'a_myMedia_menu_edit';
$modversion['blocks'][5]['options'] = 'menu|120|1|subject ASC';
$modversion['blocks'][5]['template'] = 'mymedia_menu_block_01.html';

$modversion['blocks'][6]['file'] = 'content.php';
$modversion['blocks'][6]['name'] = _MI_MYMEDIA_BLOCNAME_06;
$modversion['blocks'][6]['description'] = '';
$modversion['blocks'][6]['show_func'] = 'a_myMedia_menu_show';
$modversion['blocks'][6]['edit_func'] = 'a_myMedia_menu_edit';
$modversion['blocks'][6]['options'] = 'menu|120|1|subject ASC';
$modversion['blocks'][6]['template'] = 'mymedia_menu_block_02.html';

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'myMedia_search';

// Options

$modversion['config'][1]['name'] = 'textindex';
$modversion['config'][1]['title'] = '_MI_MYMEDIA_TEXTINDEX';
$modversion['config'][1]['description'] = '_MI_MYMEDIA_TEXTINDEXDSC';
$modversion['config'][1]['formtype'] = 'textarea';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = _MI_MYMEDIA_WELCOME;

$modversion['config'][2]['name'] = 'columns';
$modversion['config'][2]['title'] = '_MI_MYMEDIA_COLUMNS';
$modversion['config'][2]['description'] = '_MI_MYMEDIA_COLUMNSDSC';
$modversion['config'][2]['formtype'] = 'select';
$modversion['config'][2]['valuetype'] = 'int';
$modversion['config'][2]['default'] = 2;
$modversion['config'][2]['options'] = ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5];

$modversion['config'][3]['name'] = 'order';
$modversion['config'][3]['title'] = '_MI_MYMEDIA_ORDER';
$modversion['config'][3]['description'] = '_MI_MYMEDIA_ORDERDSC';
$modversion['config'][3]['formtype'] = 'select';
$modversion['config'][3]['valuetype'] = 'text';
$modversion['config'][3]['default'] = 'subject ASC';
$modversion['config'][3]['options'] = ['_MI_MYMEDIA_ORDER_SUBJECT_ASC' => 'subject ASC', '_MI_MYMEDIA_ORDER_DATE_DESC' => 'datesub DESC', '_MI_MYMEDIA_ORDER_READ_DESC' => 'counter DESC'];

$modversion['config'][4]['name'] = 'perpage';
$modversion['config'][4]['title'] = '_MI_MYMEDIA_PERPAGE';
$modversion['config'][4]['description'] = '_MI_MYMEDIA_PERPAGEDSC';
$modversion['config'][4]['formtype'] = 'select';
$modversion['config'][4]['valuetype'] = 'int';
$modversion['config'][4]['default'] = 10;
$modversion['config'][4]['options'] = ['6' => 6, '10' => 10, '16' => 16, '20' => 20, '26' => 26, '30' => 30, '50' => 50];

$modversion['config'][5]['name'] = 'logo_width';
$modversion['config'][5]['title'] = '_MI_MYMEDIA_LOGOWIDTH';
$modversion['config'][5]['description'] = '_MI_MYMEDIA_LOGOWIDTHDSC';
$modversion['config'][5]['formtype'] = 'textbox';
$modversion['config'][5]['valuetype'] = 'text';
$modversion['config'][5]['default'] = '160';

$modversion['config'][6]['name'] = 'informations';
$modversion['config'][6]['title'] = '_MI_MYMEDIA_DEFAULTEXT';
$modversion['config'][6]['description'] = '_MI_MYMEDIA_DEFAULTEXTDSC';
$modversion['config'][6]['formtype'] = 'textarea';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = _MI_MYMEDIA_DEFAULTEXTEXP;

/*
$modversion['config'][7]['name'] = 'dateformat';
$modversion['config'][7]['title'] = '_MI_MYMEDIA_DATEFORMAT';
$modversion['config'][7]['description'] = '_MI_MYMEDIA_DATEFORMATDSC';
$modversion['config'][7]['formtype'] = 'textbox';
$modversion['config'][7]['valuetype'] = 'text';
$modversion['config'][7]['default'] = 'd-M-Y H:i';
*/

$modversion['config'][8]['name'] = 'adminhits';
$modversion['config'][8]['title'] = '_MI_MYMEDIA_ALLOWADMINHITS';
$modversion['config'][8]['description'] = '_MI_MYMEDIA_ALLOWADMINHITSDSC';
$modversion['config'][8]['formtype'] = 'yesno';
$modversion['config'][8]['valuetype'] = 'int';
$modversion['config'][8]['default'] = 0;

$modversion['config'][9]['name'] = 'maxfilesize';
$modversion['config'][9]['title'] = '_MI_MYMEDIA_MAXFILESIZE';
$modversion['config'][9]['description'] = '_MI_MYMEDIA_MAXFILESIZEDSC';
$modversion['config'][9]['formtype'] = 'textbox';
$modversion['config'][9]['valuetype'] = 'int';
$modversion['config'][9]['default'] = 250000;

$modversion['config'][10]['name'] = 'maximgwidth';
$modversion['config'][10]['title'] = '_MI_MYMEDIA_IMGWIDTH';
$modversion['config'][10]['description'] = '_MI_MYMEDIA_IMGWIDTHDSC';
$modversion['config'][10]['formtype'] = 'textbox';
$modversion['config'][10]['valuetype'] = 'int';
$modversion['config'][10]['default'] = 800;

$modversion['config'][11]['name'] = 'maximgheight';
$modversion['config'][11]['title'] = '_MI_MYMEDIA_IMGHEIGHT';
$modversion['config'][11]['description'] = '_MI_MYMEDIA_IMGHEIGHTDSC';
$modversion['config'][11]['formtype'] = 'textbox';
$modversion['config'][11]['valuetype'] = 'int';
$modversion['config'][11]['default'] = 600;

$modversion['config'][12]['name'] = 'sbmediadir';
$modversion['config'][12]['title'] = '_MI_MYMEDIA_MEDIADIR';
$modversion['config'][12]['description'] = '_MI_MYMEDIA_MEDIADIRDSC';
$modversion['config'][12]['formtype'] = 'textbox';
$modversion['config'][12]['valuetype'] = 'text';
$modversion['config'][12]['default'] = 'modules/' . $modversion['dirname'] . '/images/media';

$modversion['config'][13]['name'] = 'sbuploaddir';
$modversion['config'][13]['title'] = '_MI_MYMEDIA_UPLOADDIR';
$modversion['config'][13]['description'] = '_MI_MYMEDIA_UPLOADDIRDSC';
$modversion['config'][13]['formtype'] = 'textbox';
$modversion['config'][13]['valuetype'] = 'text';
$modversion['config'][13]['default'] = 'modules/' . $modversion['dirname'] . '/images/uploads';

$modversion['config'][14]['name'] = 'logo_align';
$modversion['config'][14]['title'] = '_MI_MYMEDIA_LOGO_ALIGN';
$modversion['config'][14]['description'] = '_MI_MYMEDIA_LOGO_ALIGNDSC';
$modversion['config'][14]['formtype'] = 'select';
$modversion['config'][14]['valuetype'] = 'text';
$modversion['config'][14]['default'] = 'center';
$modversion['config'][14]['options'] = ['_MI_MYMEDIA_LOGO_ALIGN_LEFT' => 'left', '_MI_MYMEDIA_LOGO_ALIGN_CENTER' => 'center', '_MI_MYMEDIA_LOGO_ALIGN_RIGHT' => 'right'];

$modversion['config'][15]['name'] = 'extended_option';
$modversion['config'][15]['title'] = '_MI_MYMEDIA_EXTOPT';
$modversion['config'][15]['description'] = '_MI_MYMEDIA_EXTOPTDSC';
$modversion['config'][15]['formtype'] = 'yesno';
$modversion['config'][15]['valuetype'] = 'int';
$modversion['config'][15]['default'] = 1;

$modversion['config'][16]['name'] = 'option_title';
$modversion['config'][16]['title'] = '_MI_MYMEDIA_EXTOPT_TITLE';
//$modversion['config'][16]['description'] = '_MI_MYMEDIA_EXTOPTDSC_TITLE';
$modversion['config'][16]['formtype'] = 'yesno';
$modversion['config'][16]['valuetype'] = 'int';
$modversion['config'][16]['default'] = 1;

$modversion['config'][17]['name'] = 'option_main';
$modversion['config'][17]['title'] = '_MI_MYMEDIA_EXTOPT_MAIN';
//$modversion['config'][17]['description'] = '_MI_MYMEDIA_EXTOPTDSC_MAIN';
$modversion['config'][17]['formtype'] = 'yesno';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = 1;

$modversion['config'][18]['name'] = 'option_logo';
$modversion['config'][18]['title'] = '_MI_MYMEDIA_EXTOPT_LOGO';
//$modversion['config'][18]['description'] = '_MI_MYMEDIA_EXTOPTDSC_LOGO';
$modversion['config'][18]['formtype'] = 'yesno';
$modversion['config'][18]['valuetype'] = 'int';
$modversion['config'][18]['default'] = 1;

$modversion['config'][19]['name'] = 'option_block';
$modversion['config'][19]['title'] = '_MI_MYMEDIA_EXTOPT_BLOCK';
//$modversion['config'][19]['description'] = '_MI_MYMEDIA_EXTOPTDSC_BLOCK';
$modversion['config'][19]['formtype'] = 'yesno';
$modversion['config'][19]['valuetype'] = 'int';
$modversion['config'][19]['default'] = 1;

$modversion['config'][20]['name'] = 'option_back2index';
$modversion['config'][20]['title'] = '_MI_MYMEDIA_EXTOPT_BACK2INDEX';
$modversion['config'][20]['description'] = '_MI_MYMEDIA_EXTOPTDSC_BACK2INDEX';
$modversion['config'][20]['formtype'] = 'yesno';
$modversion['config'][20]['valuetype'] = 'int';
$modversion['config'][20]['default'] = 1;

$modversion['config'][21]['name'] = 'wysiwyg';
$modversion['config'][21]['title'] = '_MI_MYMEDIA_WYSIWYG';
$modversion['config'][21]['description'] = '_MI_MYMEDIA_WYSIWYGDSC';
$modversion['config'][21]['formtype'] = 'yesno';
$modversion['config'][21]['valuetype'] = 'int';
$modversion['config'][21]['default'] = 0;

$modversion['config'][22]['name'] = 'tags';
$modversion['config'][22]['title'] = '_MI_MYMEDIA_TAGS';
$modversion['config'][22]['description'] = '_MI_MYMEDIA_TAGSDSC';
$modversion['config'][22]['formtype'] = 'yesno';
$modversion['config'][22]['valuetype'] = 'int';
$modversion['config'][22]['default'] = 1;

$modversion['config'][23]['name'] = 'tags_new';
$modversion['config'][23]['title'] = '_MI_MYMEDIA_TAGS_NEW';
$modversion['config'][23]['description'] = '_MI_MYMEDIA_TAGSDSC_NEW';
$modversion['config'][23]['formtype'] = 'textbox';
$modversion['config'][23]['valuetype'] = 'int';
$modversion['config'][23]['default'] = 7;

$modversion['config'][24]['name'] = 'tags_pop';
$modversion['config'][24]['title'] = '_MI_MYMEDIA_TAGS_POP';
$modversion['config'][24]['description'] = '_MI_MYMEDIA_TAGSDSC_POP';
$modversion['config'][24]['formtype'] = 'textbox';
$modversion['config'][24]['valuetype'] = 'int';
$modversion['config'][24]['default'] = 100;

$modversion['config'][25]['name'] = 'moduleMetaKeywords';
$modversion['config'][25]['title'] = '_MI_MYMEDIA_META_KEYWORDS';
$modversion['config'][25]['description'] = '_MI_MYMEDIA_META_KEYWORDS_DSC';
$modversion['config'][25]['formtype'] = 'textarea';
$modversion['config'][25]['valuetype'] = 'text';
$modversion['config'][25]['default'] = '';

$modversion['config'][26]['name'] = 'moduleMetaDescription';
$modversion['config'][26]['title'] = '_MI_MYMEDIA_META_DESCRIPTION';
$modversion['config'][26]['description'] = '_MI_MYMEDIA_META_DESC_DSC';
$modversion['config'][26]['formtype'] = 'textarea';
$modversion['config'][26]['valuetype'] = 'text';
$modversion['config'][26]['default'] = '';

$modversion['config'][27]['name'] = 'index_logo';
$modversion['config'][27]['title'] = '_MI_MYMEDIA_INDEX_LOGO';
$modversion['config'][27]['description'] = '_MI_MYMEDIA_INDEXDSC_LOGO';
$modversion['config'][27]['formtype'] = 'textbox';
$modversion['config'][27]['valuetype'] = 'text';
$modversion['config'][27]['default'] = XOOPS_URL . '/modules/' . $modversion['dirname'] . '/images/mymedia_banner.gif';

$modversion['config'][28]['name'] = 'index_mymedia';
$modversion['config'][28]['title'] = '_MI_MYMEDIA_INDEX_CONTENT';
$modversion['config'][28]['description'] = '_MI_MYMEDIA_INDEXDSC_CONTENT';
$modversion['config'][28]['formtype'] = 'textbox';
$modversion['config'][28]['valuetype'] = 'text';
$modversion['config'][28]['default'] = '';

$modversion['config'][29]['name'] = 'navlink_type';
$modversion['config'][29]['title'] = '_MI_MYMEDIA_NAV_LINKS';
$modversion['config'][29]['description'] = '_MI_MYMEDIA_NAVDSC_LINKS';
$modversion['config'][29]['formtype'] = 'select';
$modversion['config'][29]['valuetype'] = 'text';
$modversion['config'][29]['default'] = 'list';
$modversion['config'][29]['options'] = ['_MI_MYMEDIA_NAV_LINKS_NONE' => 'none', '_MI_MYMEDIA_NAV_LINKS_LIST' => 'list', '_MI_MYMEDIA_NAV_LINKS_PATH' => 'path'];

$modversion['config'][30]['name'] = 'media_popup';
$modversion['config'][30]['title'] = '_MI_MYMEDIA_MEDIA_DISPLAY';
$modversion['config'][30]['description'] = '_MI_MYMEDIA_MEDIA_DISPLAYDSC';
$modversion['config'][30]['formtype'] = 'select';
$modversion['config'][30]['valuetype'] = 'text';
$modversion['config'][30]['default'] = 'both';
$modversion['config'][30]['options'] = ['_MI_MYMEDIA_MEDIA_POPUP' => 'popup', '_MI_MYMEDIA_MEDIA_PAGE' => 'page', '_MI_MYMEDIA_MEDIA_BOTH' => 'both'];

$modversion['config'][7]['name'] = 'custom';
$modversion['config'][7]['title'] = '_MI_MYMEDIA_CUSTOM';
$modversion['config'][7]['description'] = '_MI_MYMEDIA_CUSTOMDSC';
$modversion['config'][7]['formtype'] = 'textbox';
$modversion['config'][7]['valuetype'] = 'text';
$modversion['config'][7]['default'] = '480|360';

$modversion['config'][31]['name'] = 'media_size';
$modversion['config'][31]['title'] = '_MI_MYMEDIA_MEDIA_SIZE';
$modversion['config'][31]['description'] = '_MI_MYMEDIA_MEDIADSC_SIZE';
$modversion['config'][31]['formtype'] = 'select';
$modversion['config'][31]['valuetype'] = 'text';
$modversion['config'][31]['default'] = 'medium';
$modversion['config'][31]['options'] = [
'_MI_MYMEDIA_SIZE_DEFAULT' => 'default',
                                            '_MI_MYMEDIA_SIZE_CUSTOM' => 'custom',
'_MI_MYMEDIA_SIZE_TVSMALL' => 'tv_small',
'_MI_MYMEDIA_SIZE_TVMEDIUM' => 'tv_medium',
'_MI_MYMEDIA_SIZE_TVBIG' => 'tv_big',
'_MI_MYMEDIA_SIZE_MVSMALL' => 'mv_small',
'_MI_MYMEDIA_SIZE_MVMEDIUM' => 'mv_medium',
'_MI_MYMEDIA_SIZE_MVBIG' => 'mv_big',
];

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'content.php';
$modversion['comments']['itemName'] = 'id';

// Comment callback functions
// $modversion['comments']['callbackFile'] = 'include/comment_functions.php';
// $modversion['comments']['callback']['approve'] = 'page_com_approve';
// $modversion['comments']['callback']['update'] = 'page_com_update';

// Notification
$modversion['hasNotification'] = 0;
?>
