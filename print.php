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

// Script used to print a myMedia's mymedia
require dirname(__DIR__, 2) . '/mainfile.php';

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

$myts = MyTextSanitizer::getInstance();
$sql = 'SELECT * FROM ' . $xoopsDB->prefix($xoopsModule->getVar('dirname')) . " where id=$id";
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

$html = !empty($myrow['nohtml']) ? 0 : 1;
$smiley = !empty($myrow['nosmiley']) ? 0 : 1;
$xcode = !empty($myrow['noxcode']) ? 0 : 1;
$block = !empty($myrow['noblock']) ? 0 : 1;

// Module Banner
if ($xoopsModuleConfig['index_logo']) {
    $banner = '<img src="' . $xoopsModuleConfig['index_logo'] . '" alt="' . $xoopsModule->getVar('name') . '">';
} else {
    $banner = '';
}

// Datas
$sitename = $xoopsConfig['sitename'];
$subject = $myts->displayTarea($myrow['subject']);
$uid = $myrow['uid'];
$username = XoopsUser::getUnameFromId($uid);
$datesub = $myrow['datesub'];
$date = formatTimestamp($datesub, 'm');

if ('center' != $xoopsModuleConfig['logo_align'] && $myrow['artimage']) {
    $logo_align = "align='" . $xoopsModuleConfig['logo_align'] . "'";

    $logo = "<img src='" . XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $myrow['artimage'] . "' " . $logo_align . '>';
} elseif ('center' == $xoopsModuleConfig['logo_align'] && $myrow['artimage']) {
    $logo = "<div align='center'><img src='" . XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $myrow['artimage'] . "'></div>";
} else {
    $logo = '';
}

if (!XOOPS_USE_MULTIBYTES) {
    $myMediatext = explode('[blockbreak]', $myrow['informations']);

    $block_myMedias = count($myMediatext);

    if (1 != $block_myMedias) {
        if (0 == $block) {
            $myrow['informations'] = ereg_replace("\[blockbreak\]", '', $myrow['informations']);

            $texte = $myts->displayTarea($myrow['informations'], $html, $smiley, $xcode);
        } else {
            $texte = $myts->displayTarea($myMediatext[1], $html, $smiley, $xcode);
        }
    } else {
        $texte = $myts->displayTarea($myrow['informations'], $html, $smiley, $xcode);
    }
}

echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
echo "<html>\n<head>\n";
echo '<title>' . _MYMEDIA_COMEFROM . ' ' . $xoopsConfig['sitename'] . "</title>\n";
echo "<meta http-equiv='Content-Type' mymedia='text/html; charset=" . _CHARSET . "'>\n";
echo "<meta name='AUTHOR' mymedia='" . $xoopsConfig['sitename'] . "'>\n";
echo "<meta name='COPYRIGHT' mymedia='Copyright (c) 2001 by " . $xoopsConfig['sitename'] . "'>\n";
echo "<meta name='DESCRIPTION' mymedia='" . $xoopsConfig['slogan'] . "'>\n";
echo "<meta name='GENERATOR' mymedia='" . XOOPS_VERSION . "'>\n\n\n";

echo "<body bgcolor='#ffffff' text='#000000' onload='window.print()'>
	 <div style='width: 650px; border: 1px solid #000; padding: 20px;'>
	 <div style='text-align: center; display: block; margin: 0 0 6px 0;'><h2 style='margin: 0;'>" . $banner . "</h2></div>
				<div style='text-align: center; display: block; padding-bottom: 12px; margin: 0 0 6px 0; border-bottom: 2px solid #ccc;'></div>
				<div></div>
				" . $logo . "<p align='center'><b>" . $subject . '</b></p>
				<p>' . $texte . "</p>
				<div style='padding-top: 12px; border-top: 2px solid #ccc;'></div>
				<p><font size='1'>" . _MYMEDIA_COMEFROM . $xoopsConfig['sitename'] . ' : 
' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/content.php?id=' . $id . '</font></p>
		</div>
	<br>';

echo '<br>
		  </body>
		  </html>';

?>
