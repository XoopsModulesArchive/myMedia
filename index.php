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
//                  myMedia v2.3								//
//  ------------------------------------------------------------------------ 	//

// This script is used to display the myMedias list
require_once 'header.php';
require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
require_once XOOPS_ROOT_PATH . '/header.php';
$startart = isset($_GET['startart']) ? intval($_GET['startart']) : 0;
$GLOBALS['xoopsOption']['template_main'] = 'mymedia_index.html';
$myts = MyTextSanitizer::getInstance();

//Rediriger l'index vers un myMedia ou une url spécifique
if ($xoopsModuleConfig['index_mymedia']) {
    if ((eregi('http://', $xoopsModuleConfig['index_mymedia']))
        || (eregi('https://', $xoopsModuleConfig['index_mymedia']))) {
        header('location: ' . $xoopsModuleConfig['index_mymedia']);

        exit();
    }  

    $result = $xoopsDB->queryF('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('myMedia') . ' WHERE id = ' . $xoopsModuleConfig['index_mymedia'] . '');

    [$numrows] = $xoopsDB->fetchRow($result);

    if ($numrows > 0) {
        header('location: content.php?id=' . $xoopsModuleConfig['index_mymedia']);

        exit();
    }
}

//Affiche le nom du module et le texte d'introduction
$xoopsTpl->assign('module_name', $xoopsModule->getVar('name'));
$xoopsTpl->assign('textindex', $myts->displayTarea($xoopsModuleConfig['textindex']));

// Module Banner
if ($xoopsModuleConfig['index_logo']) {
    $banner = '<img src="' . $xoopsModuleConfig['index_logo'] . '" alt="' . $xoopsModule->getVar('name') . '">';
} else {
    $banner = '';
}
$xoopsTpl->assign('banner', $banner);

//Calcul le nombre et la lageur des colonnes
$xoopsTpl->assign('columns', $xoopsModuleConfig['columns']);
$xoopsTpl->assign('width', 100 / $xoopsModuleConfig['columns']);

// Vérifier les permissions par groupe
$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];

// Affiche les myMedias
$result = $xoopsDB->queryF('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('myMedia') . ' WHERE offline = 1 AND hidden = 1 AND pid = 0');

[$numrows] = $xoopsDB->fetchRow($result);

$count = 1;

if ($numrows > 0) { // That is, if there ARE myMedias in the system
    $sql = 'SELECT id, pid, subject, groups, artimage, datesub, counter, uid FROM ' . $xoopsDB->prefix('myMedia') . ' WHERE offline = 1 AND hidden = 1 AND pid = 0 ORDER BY ' . $xoopsModuleConfig['order'] . '';

    $result = $xoopsDB->queryF($sql, $xoopsModuleConfig['perpage'], $startart);

    while (list($id, $pid, $subject, $groups, $artimage, $datesub, $counter, $uid) = $xoopsDB->fetchRow($result)) {
        $groups = explode(' ', $groups);

        if (count(array_intersect($group, $groups)) > 0) {
            $info = [];

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

            //Défini la largeur des logos

            if ($artimage) {
                $info['logo'] = XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $artimage;

                if ($xoopsModuleConfig['logo_width']) {
                    $logo = $info['logo'];

                    $image_size = getimagesize("$logo");

                    $width = $image_size[0];

                    if ($xoopsModuleConfig['logo_width'] <= $width) {
                        $info['logo_width'] = "width='" . $xoopsModuleConfig['logo_width'] . "'";
                    } else {
                        $info['logo_width'] = '';
                    }
                }
            } else {
                $info['logo'] = XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/images/uploads/blank.gif';

                $info['logo_width'] = '';
            }

            $info['subject'] = $myts->displayTarea($subject);

            $info['tag'] = $tag;

            $info['link'] = "<a href='" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/content.php?id=$id'>";

            $info['numrows'] = $count++;

            $pagenav = new XoopsPageNav($numrows, $xoopsModuleConfig['perpage'], $startart, 'startart', 'id =' . $id);

            $xoopsTpl->assign('pagenav', $pagenav->renderNav());

            if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {
                $info['adminlink'] = "<a href='../" . $xoopsModule->dirname() . "/admin/index.php'><img src='images/icon/edit.gif' alt='" . _MYMEDIA_EDIT . "'></a> <a href='../" . $xoopsModule->dirname() . "/admin/content.php'><img src='images/icon/add.gif' alt='" . _MYMEDIA_ADD . "'></a>";
            } else {
                $info['adminlink'] = '';
            }

            $xoopsTpl->append('infos', $info);

            unset($info);
        }
    }
}

// MetaTag Generator
$nul = '1';
createMetaTags($xoopsModuleConfig['moduleMetaDescription'], $xoopsModuleConfig['textindex'], $xoopsModuleConfig['moduleMetaDescription']);

require_once XOOPS_ROOT_PATH . '/footer.php';
?>
