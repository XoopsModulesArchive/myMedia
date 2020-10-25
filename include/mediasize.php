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

if ('default' == $myrow['media_size']) {
    $media_size = '';
}

if ('custom' == $myrow['media_size']) {
    $custom = explode('|', $xoopsModuleConfig['custom']);

    $media_size = 'width = "' . $custom[0] . '"  height = "' . $custom[1] . '"';

    $width_s = $custom[0];

    $height_s = $custom[1];
}

if ('tv_small' == $myrow['media_size']) {
    $media_size = 'width = "320" height="240"';

    $width_s = '320';

    $height_s = '240';
}
if ('tv_medium' == $myrow['media_size']) {
    $media_size = 'width = "480" height="360"';

    $width_s = '480';

    $height_s = '360';
}
if ('tv_big' == $myrow['media_size']) {
    $media_size = 'width = "800" height="600"';

    $width_s = '800';

    $height_s = '600';
}
if ('mv_small' == $myrow['media_size']) {
    $media_size = 'width = "320" height="127"';

    $width_s = '320';

    $height_s = '127';
}
if ('mv_medium' == $myrow['media_size']) {
    $media_size = 'width = "480" height="206"';

    $width_s = '480';

    $height_s = '206';
}
if ('mv_big' == $myrow['media_size']) {
    $media_size = 'width = "720" height="309"';

    $width_s = '720';

    $height_s = '309';
}
?>

