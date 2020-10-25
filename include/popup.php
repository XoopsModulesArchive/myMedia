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

// Script used to display a media in a pop up
global $xoopsDB, $xoopsUser;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
}

if (!isset($id)) {
    redirect_header('index.php', 2, _MYMEDIA_PL_SELECT);

    exit();
}
require_once '../../../mainfile.php';
$myts = MyTextSanitizer::getInstance();
$module = 'myMedia';
$blocks = 'pop';
require_once XOOPS_ROOT_PATH . '/header.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/functions_block.php';

$sql = 'SELECT * FROM ' . $xoopsDB->prefix('myMedia') . " where id=$id";
$result = $xoopsDB->queryF($sql);

if ($xoopsDB->getRowsNum($result) <= 0) {    // myMedia can't be found
    redirect_header('index.php', 2, _MYMEDIA_NOT_FOUND);

    exit();
}

$myrow = $xoopsDB->fetchArray($result);

$info = [];

$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];
$groups = explode(' ', $myrow['groups']);
if (count(array_intersect($group, $groups)) <= 0) {
    redirect_header('index.php', 2, _NOPERM);

    exit();
}

if ($myrow['notitle']) {
    $info['subject'] = '<br><b>' . $myts->displayTarea($myrow['subject']) . '</b><br>';
} else {
    $info['subject'] = '';
}

require_once 'mediasize.php';

// Media
if ($myrow['media_url']) {
    $media_url = $myrow['media_url'];

    require_once 'media.php';

    $info['media'] = $media;
} elseif ('blank.gif' != $myrow['media'] and '' != $myrow['media']) {
    $media_url = XOOPS_URL . '/' . myMedia_getmoduleoption('sbmediadir') . '/' . $myrow['media'];

    require_once 'media.php';

    $info['media'] = $media;
} else {
    $media_url = '';

    $info['media'] = '';
}

// Display Logo
/*
// Image align
if (myMedia_getmoduleoption('logo_align') == "center") {
$artimage_align = '';
$align = "<div align='center'>";
$align02 = "</div>";
} else {
$artimage_align = 'align="'.myMedia_getmoduleoption('logo_align').'"';
$align = "";
$align02 = "";
}

if ($myrow["artimage"] AND $myrow["nologo"]){
	$info['logo'] = $align.'<img src="'.XOOPS_URL . '/'. myMedia_getmoduleoption('sbuploaddir') .'/'. $myrow['artimage'].'" alt="'.$myrow['subject'].'" '.$artimage_align.'>'.$align02;
} else { 
	$info['logo'] = $align.'<img src="'.XOOPS_URL . '/modules/' . $module . '/images/blank.gif" alt="'.$myrow['subject'].'">'.$align02;
}
*/

$info['logo'] = '';

echo '
<body bgcolor=#FFFFFF>
<div align="center">
' . $info['logo'] . '
<font color="#000000" face="arial">' . $info['subject'] . '</font>
' . $info['media'] . '
</div>
</body>';
?>
