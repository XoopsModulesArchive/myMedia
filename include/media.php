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

require_once XOOPS_ROOT_PATH . '/modules/myMedia/include/mediasize.php';
$width_pop = $width_s + 80;
$height_pop = $height_s + 80;

if (eregi('swf', mb_substr($media_url, -3))) {
    // Flash

    $icon = '<a href="' . $media_url . '" target="_blank"><img src="' . XOOPS_URL . '/modules/myMedia/images/icon/flash.gif"></a>';

    $media = '
<!-- BEGIN flash -->
<object 
	classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 	codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/ 
	swflash.cab#version=6,0,40,0" 
	;="" 
	' . $media_size . '
>

<param name="movie" value="' . $media_url . '">
<param name="quality" value="high">

<embed 
	src="' . $media_url . '" 
	quality="high" 
	pluginsmyMedia="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" 
	;="" 
	type="application/x-shockwave-flash" 
	' . $media_size . ' 
>
</object>
<!-- END flash -->
';
} elseif (eregi('jpg', mb_substr($media_url, -3)) or eregi('jpeg', mb_substr($media_url, -4)) or eregi('gif', mb_substr($media_url, -3)) or eregi('png', mb_substr($media_url, -3)) or eregi('tif', mb_substr($media_url, -3))) {
    // jpg, gif, png, tiff

    $icon = '<a href="' . $media_url . '" target="_blank"><img src="' . XOOPS_URL . '/modules/myMedia/images/icon/image.gif" alt=".$media_url."></a>';

    if ('1' == $blocks) {
        $image_size = getimagesize("$media_url");

        $width = $image_size[0];

        $height = $image_size[1];

        $width_pop = $image_size[0] + 40;

        $height_pop = $image_size[1] + 65;

        if (myMedia_getmoduleoption('logo_width') <= $width) {
            $media_size = 'width="' . myMedia_getmoduleoption('logo_width') . '"';
        } else {
            $media_size = 'width="' . $width . '"';
        }

        $picture = ' <a href="' . XOOPS_URL . '/modules/' . $module . '/include/popup.php?id=' . $myrow['id'] . " \" target=\"wclose\" onclick=\"window.open('', 'wclose', 'width=" . $width_pop . ', height=' . $height_pop . ", toolbar=no, status=no, scrollbars=yes, resizable=yes, left=50, top=50')\">
	<img src=\"" . $media_url . '" alt="' . $myrow['subject'] . '" ' . $media_size . '></a> ';
    } else {
        $image_size = getimagesize("$media_url");

        $width_pop = $image_size[0] + 40;

        $height_pop = $image_size[1] + 65;

        $picture = ' <img src="' . $media_url . '" alt="' . $myrow['subject'] . '"> ';
    }

    $media = "
<div align='center'>
" . $picture . ' 
</div>
';
} elseif (eregi('mov', mb_substr($media_url, -3))) {
    // MOV

    $icon = '<a href="' . $media_url . '" target="_blank"><img src="' . XOOPS_URL . '/modules/myMedia/images/icon/mov.gif"></a>';

    $media = '
<!-- BEGIN mov -->

<object 
	classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" 
	codebase="http://www.apple.com/qtactivex/qtplugin.cab" 
	' . $media_size . '>
  
<param name="src" value="' . $media_url . '">  
<param name="volume" value="100%">  
<param name="bgcolor" value="#FFFFFF">  
<param name="cache" value="true">
<param name="loop" value="false">
<param name="controller" value="true">
<param name="autoplay" value="true">
<param name="type" value="video/quicktime">
<param name="pluginsmyMedia" value="http://www.apple.com/quicktime/dowload/">
<embed src="' . $media_url . '" 
volume="100%"
bgcolor="#FFFFFF" 
loop="false" 
controller="true" 
autoplay="true" 
type="video/quicktime" 
pluginsmyMedia="http://www.apple.com/quicktime/dowload/" bgcolor="#000000"
align="center" 
' . $media_size . '
>
</object>
<!-- END mov -->
';
} elseif (eregi('ram', mb_substr($media_url, -3)) or eregi('rm', mb_substr($media_url, -3))) {
    // RAM - RM

    $icon = '<a href="' . $media_url . '" target="_blank"><img src="' . XOOPS_URL . '/modules/myMedia/images/icon/mov.gif"></a>';

    $media = '
<!-- BEGIN ram/rm -->
<object 
id="RVOCX" 
classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" 
' . $media_size . '
>
<param name="src" value="' . $media_url . '">
<param name="autostart" value="true">
<param name="controls" value="imagewindow,all">
<param name="console" value="one">
<embed 
type="audio/x-pn-realaudio-plugin" 
src="' . $media_url . '"
' . $media_size . '
autostart="true" 
controls="imagewindow,all"
console="one">
</embed>
</object>

<!-- END ram/rm -->
';
} else {
    // Media player - wav, mp3

    if (eregi('mp3', mb_substr($media_url, -3)) or eregi('wav', mb_substr($media_url, -3))) {
        $media_size = 'width="300" height="45"';

        $radio = '<img src="' . XOOPS_URL . '/modules/myMedia/images/radio.gif"><br>';

        $icon = '<a href="' . $media_url . '" target="_blank"><img src="' . XOOPS_URL . '/modules/myMedia/images/icon/sound.gif"></a>';
    } else {
        $radio = '';

        $icon = '<a href="' . $media_url . '" target="_blank"><img src="' . XOOPS_URL . '/modules/myMedia/images/icon/video.gif"></a>';
    }

    $media = '
<!-- BEGIN wmp -->
<object
	ID="player" 
	' . $media_size . '
	classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95"
	CODEBASE="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715" 
	standby="Loading Microsoft® Windows® Media Player components..." type="application/x-oleobject">

<param name="FileName" VALUE="' . $media_url . '">
<param name="AutoStart" VALUE="True">
<param name="Loop" VALUE="False">
<param name="Bgcolor" value="#FFFFFF"> 
<param name="ShowControls" VALUE="True">
<param name="AutoSize" VALUE="False">
<param name="ShowStatusBar" VALUE="False">
<param name="AnimationAtStart" VALUE="True">
<param name="TransparentAtStart" VALUE="True">
<param name="enableContextMenu" VALUE="False">
<param name="AllowChangeDisplaySize" VALUE="True">
<param name="SendPlayStateChangeEvents" VALUE="True">
<param name="DisplaySize" VALUE="2">
' . $radio . '
<embed 
	type="video/x-ms-asf-plugin" 	
	pluginsmyMedia="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" 
	src="' . $media_url . '" 
	name="MediaPlayer" 
	bgcolor="#FFFFFF"
	autostart="1" 
	loop="0"
	showcontrols="1" 
	AutoSize="1" 
	windowless="1"
	animationatstart="1"
	transparentatstart="1"
	enableContextMenu="0"
	AllowChangeDisplaySize="1" 
	DisplaySize="4" 
	' . $media_size . ' 
>
</object>
<!-- END wmp -->
';
}
?>

