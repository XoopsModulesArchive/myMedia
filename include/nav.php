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

echo "

<div id='navcontainer'>
<ul style='padding: 1px 0; margin-left: 0; font: bold 12px Verdana, sans-serif; '>

<li style='list-style: none; margin: 0; display: inline; '>
<a href='../index.php'  style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #DDE; text-decoration: none;'>
"
     . _AM_MYMEDIA_NAV_MAIN
     . "</a></li>

<li style='list-style: none; margin: 0; display: inline; '><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod="
     . $xoopsModule->getVar('mid')
     . "' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #DDE; text-decoration: none; '>"
     . _AM_MYMEDIA_NAV_PREFERENCES
     . '</a></li>';

if (!isset($id)) {
    echo "<li style='list-style: none; margin: 0; display: inline; '>
<a href='index.php' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #FFF; text-decoration: none; '>
" . _AM_MYMEDIA_NAV_LIST . '</a></li>';
} else {
    echo "<li style='list-style: none; margin: 0; display: inline; '>
<a href='index.php' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #DDE; text-decoration: none; '>
" . _AM_MYMEDIA_NAV_LIST . '</a></li>';
}

echo "<li style='list-style: none; margin: 0; display: inline; '>
<a href='content.php' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #DDE; text-decoration: none; '>
" . _AM_MYMEDIA_NAV_CREATE . '</a></li>';

if (isset($id) && $id) {
    echo "<li style='list-style: none; margin: 0; display: inline; '>
<a href='../content.php?id=$id&pid=$pid' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #FFF; text-decoration: none; '>
" . _AM_MYMEDIA_NAV_SEE . '</a></li>';
}

echo "<li style='list-style: none; margin: 0; display: inline; '>
<a href='help.php' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: #DDE; text-decoration: none; '>
" . _MI_MYMEDIA_NAV_HELP . '</a></li></ul></div><hr>';

?>

