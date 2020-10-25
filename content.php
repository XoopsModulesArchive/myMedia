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

// Script used to display a myMedia's mymedia, for example when it was too short
// on the main myMedia
require_once 'header.php';

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
$GLOBALS['xoopsOption']['template_main'] = 'mymedia_item.html';

require_once XOOPS_ROOT_PATH . '/header.php';

$icon = '';

$sql = 'SELECT * FROM ' . $xoopsDB->prefix('myMedia') . " where id=$id";
$result = $xoopsDB->queryF($sql);

if ($xoopsDB->getRowsNum($result) <= 0) {    // myMedia can't be found
    redirect_header('index.php', 2, _MYMEDIA_NOT_FOUND);

    exit();
}

$myrow = $xoopsDB->fetchArray($result);

// Module Banner
if ($xoopsModuleConfig['index_logo']) {
    $banner = '<img src="' . $xoopsModuleConfig['index_logo'] . '" alt="' . $xoopsModule->getVar('name') . '">';
} else {
    $banner = '';
}
$xoopsTpl->assign('banner', $banner);
$count = 2;

//Calcul le nombre et la lageur des colonnes
$xoopsTpl->assign('columns', $xoopsModuleConfig['columns']);
$xoopsTpl->assign('width', 100 / $xoopsModuleConfig['columns']);

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
$blocks = '';
$pid = $myrow['pid'];
$info['subject'] = $myts->displayTarea($myrow['subject']);

$info['notitle'] = $myrow['notitle'];
$info['displaylogo'] = $myrow['nologo'];
$info['option_back2index'] = (($myrow['hidden']) && ($xoopsModuleConfig['option_back2index']));
$info['cancomment'] = $myrow['cancomment'];

$counter = $myrow['counter'];
$tmpuser = XoopsUser::getUnameFromId($myrow['uid']);
$datesub = $myrow['datesub'];
$datesub = formatTimestamp($datesub, 'm') . " $tmpuser";

require_once 'include/mediasize.php';

// Media
if ($myrow['media_url'] and 'popup' != $xoopsModuleConfig['media_popup']) {
    $media_url = $myrow['media_url'];

    require_once 'include/media.php';

    $info['media'] = $media;
} elseif ('blank.gif' != $myrow['media'] and '' != $myrow['media'] and 'popup' != $xoopsModuleConfig['media_popup']) {
    $media_url = XOOPS_URL . '/' . $xoopsModuleConfig['sbmediadir'] . '/' . $myrow['media'];

    require_once 'include/media.php';

    $info['media'] = $media;
} else {
    $media_url = $myrow['media_url'];

    $info['media'] = '';
}

// Image align
if ('center' == $xoopsModuleConfig['logo_align']) {
    $artimage_align = '';

    $align = "<div align='center'>";

    $align02 = '</div>';
} else {
    $artimage_align = 'align="' . $xoopsModuleConfig['logo_align'] . '"';

    $align = '';

    $align02 = '';
}

if (('blank.gif' != $myrow['media'] or $myrow['media_url']) and $myrow['artimage'] and 'page' != $xoopsModuleConfig['media_popup']) {
    require_once 'include/mediasize.php';

    $width_pop = $width_s + 80;

    $height_pop = $height_s + 80;

    //			$logo		=	XOOPS_URL . '/'. $xoopsModuleConfig['sbuploaddir'] .'/'. $myrow["artimage"];

    //			$image_size =  	getimagesize("$logo");

    //			$width_pop 	=	$image_size[0] + $width_s + 10;

    //			$height_pop	=	$image_size[1]+ $height_s + 300;

    $info['logo'] = $align . '
<a href="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/include/popup.php?id=' . $myrow['id'] . " \" target=\"wclose\" onclick=\"window.open('', 'wclose', 'width=" . $width_pop . ', height=' . $height_pop . ", toolbar=no, status=no, scrollbars=yes, resizable=yes, left=50, top=50')\">
	<img src=\"" . XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $myrow['artimage'] . '" alt="' . $myrow['subject'] . '" ' . $artimage_align . '><br>' . _MYMEDIA_CLICKHERE . '</a>' . $align02;
} elseif ($myrow['artimage']) {
    $info['logo'] = $align . '<img src="' . XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $myrow['artimage'] . '" alt="' . $myrow['subject'] . '" ' . $artimage_align . '>' . $align02;
} else {
    $info['logo'] = $align . '<img src="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/images/blank.gif" alt="' . $myrow['subject'] . '">' . $align02;
}

// if (!XOOPS_USE_MULTIBYTES)
// {
$myMediatext = explode('[blockbreak]', $myrow['informations']);
$block_pages = count($myMediatext);

if (1 != $block_pages) {
    if (0 == $block) {
        $myrow['informations'] = ereg_replace("\[blockbreak\]", '', $myrow['informations']);

        $bodytext = $myts->displayTarea($myrow['informations'], $html, $smiley, $xcode);
    } else {
        $bodytext = $myts->displayTarea($myMediatext[1], $html, $smiley, $xcode);
    }
} else {
    $bodytext = $myts->displayTarea($myrow['informations'], $html, $smiley, $xcode);
}
// }

// pagebreak
$contentpage = isset($_GET['page']) ? intval($_GET['page']) : 0;
$contenttext = explode('[pagebreak]', $bodytext);
$content_pages = count($contenttext);
$info['texte'] = '';
if ($content_pages > 1) {
    require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

    $pagenav = new XoopsPageNav($content_pages, 1, $contentpage, 'page', 'id=' . $id);

    $xoopsTpl->assign('pagenav', $pagenav->renderNav());

    $xoopsTpl->assign('page', _MYMEDIA_PAGE);

    if (0 == $contentpage) {
        $info['texte'] = $info['texte'] . $contenttext[$contentpage] . '<br><br>';
    } else {
        $info['texte'] = $contenttext[$contentpage] . '<br><br>';
    }
} else {
    $info['texte'] = $info['texte'] . '<br><br>' . $bodytext;
}

// Nav Link
if ($myrow['offline']) {
    $offline = "<img src='images/icon/online.gif' alt='" . _MYMEDIA_ONLINE . "'>";

    $online = '1';

    $path = "<br><a href='index.php'>" . $xoopsModule->getVar('name') . '</a> > ' . $myts->displayTarea($info['subject']) . '<br><br>';
} else {
    $offline = "<img src='images/icon/offline.gif' alt='" . _MYMEDIA_OFFLINE . "'>";

    $online = '0';
}

// Admin link & infos

if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
    $info['adminlink'] = "$offline&nbsp;|&nbsp;<a href='" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/admin/content.php?op=mod&id=$id'><img src='images/icon/edit.gif' alt='" . _MYMEDIA_EDIT . "'></a>&nbsp;|&nbsp;
<a href='" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/admin/content.php?op=del&id=$id'><img src='images/icon/delete.gif' alt='" . _MYMEDIA_DELETE . "'></a>&nbsp;|&nbsp;
<a href='" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/print.php?id=$id' target='_blank'><img src='images/icon/print.gif' alt='" . _MYMEDIA_PRINT . "'></a>";

    $info['infos'] = "($datesub) | ($counter " . _READS . ')<br>' . $icon . " [ <a href='" . $media_url . "' target='_blank'>" . $media_url . '</a> ]';
} else {
    $info['adminlink'] = "<a href='" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/print.php?id=$id' target='_blank'><img src='images/icon/print.gif' alt='" . _MYMEDIA_PRINT . "'></a>";

    $info['infos'] = '';
}

// MetaTag Generator
createMetaTags($info['subject'], $myrow['informations'], $online);

if (!$xoopsUser || ($xoopsUser->isAdmin($xoopsModule->mid()) && 1 == $xoopsModuleConfig['adminhits'])) {
    $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('myMedia') . " SET counter=counter+1 WHERE id = $id ");
}

if ($myrow['offline'] and $myrow['hidden']) {
    $xoopsTpl->assign('list', _MYMEDIA_LIST);

    $xoopsTpl->assign('index', _MYMEDIA_INDEX);

    $xoopsTpl->assign('navlink', $path);

    $xoopsTpl->assign('navlink_type', $xoopsModuleConfig['navlink_type']);

    // List des autres myMedias disponibles

    if (0 == $pid) {
        $pid = $id;
    }

    if ($xoopsModuleConfig['logo_width']) {
        $xoopsModuleConfig['logo_width'] = $xoopsModuleConfig['logo_width'] / 3;
    }

    $sql = 'SELECT id, subject, groups, artimage, datesub, counter, uid, pid 
		FROM ' . $xoopsDB->prefix('myMedia') . " 
		WHERE offline = 1 AND hidden = 1 AND (pid = $pid OR id = $pid OR pid = $id) OR pid = 0
		ORDER BY " . $xoopsModuleConfig['order'];

    $listing = $xoopsDB->queryF($sql);

    while (list($ids, $subject, $groups, $artimage, $datesub, $counter, $uid, $pid) = $xoopsDB->fetchRow($listing)) {
        $groups = explode(' ', $groups);

        if (count(array_intersect($group, $groups)) > 0) {
            $liste = [];

            //Défini la largeur des logos

            if ($artimage and 'list' == $xoopsModuleConfig['navlink_type'] and $xoopsModuleConfig['tags']) {
                $logo = XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $artimage;

                $image_size = getimagesize("$logo");

                $logo_width = $image_size[0];

                $logo_width = $logo_width / 3;

                if ($xoopsModuleConfig['logo_width']) {
                    if ($xoopsModuleConfig['logo_width'] <= $logo_width) {
                        $logo_width = " width='" . $xoopsModuleConfig['logo_width'] . "'";
                    } else {
                        $logo_width = " width='" . $logo_width . "'";
                    }
                }

                $logo = '<img src="' . XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $artimage . '" alt="' . $myts->displayTarea($subject) . '" align="absmiddle"' . $logo_width . '>';
            } else {
                $logo = '';
            }

            // Détermine les icons à afficher

            $tag = '';

            if (1 == $xoopsModuleConfig['tags']) {
                $time = time();

                $startdate = (time() - (86400 * $xoopsModuleConfig['tags_new']));

                if ($startdate < $datesub) {
                    $tmpuser = XoopsUser::getUnameFromId($uid);

                    $datesub = formatTimestamp($datesub, 'm') . " $tmpuser";

                    $new = '&nbsp;<img src="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/images/icon/new.gif" alt="' . $datesub . '">';
                } else {
                    $new = '';
                }

                if ($counter >= $xoopsModuleConfig['tags_pop']) {
                    $pop = '&nbsp;<img src="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/images/icon/pop.gif" alt="' . $counter . '&nbsp;' . _READS . '">';
                } else {
                    $pop = '';
                }

                $tag = $pop . $new;
            }

            $subject = $myts->displayTarea($subject);

            $liste['tag'] = $tag;

            if ($count == $xoopsModuleConfig['perpage']) {
                $liste['numrows'] = 1;

                $count = 1;
            } else {
                $liste['numrows'] = 0;

                $count++;
            }

            if ($ids != $id) {
                $liste['link'] = $logo . "<a href='" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/content.php?id=$ids'><nobr>" . $myts->displayTarea($subject) . '</nobr></a>';
            } else {
                $liste['link'] = $logo . "<font color='red'><i><nobr>" . $myts->displayTarea($subject) . '</nobr></i></font>';
            }
        }

        $xoopsTpl->append('liste', $liste);

        unset($liste);
    }
} else {
    $xoopsTpl->assign('navlink', '');

    $xoopsTpl->assign('navlink_type', 'none');
}

$xoopsTpl->assign('infos', $info);

require_once XOOPS_ROOT_PATH . '/include/comment_view.php';
require_once XOOPS_ROOT_PATH . '/footer.php';
?>
