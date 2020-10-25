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

require_once 'admin_header.php';
$myts = MyTextSanitizer::getInstance();
$op = '';

foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

switch ($op) {
    case 'default':
    default:
        require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

        $startart = isset($_GET['startart']) ? intval($_GET['startart']) : 0;
        $datesub = isset($_GET['datesub']) ? intval($_GET['datesub']) : 0;

        xoops_cp_header();
        require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
        $module_id = $xoopsModule->getVar('mid');

        global $xoopsUser, $xoopsConfig, $xoopsDB, $xoopsModuleConfig, $xoopsModule, $id;

        $myts = MyTextSanitizer::getInstance();
        require_once '../include/nav.php';
        echo '<br><a href="help.php"><img src="../images/logo.gif" align="right" alt="' . _MI_MYMEDIA_NAV_HELP . '"></a>';
        require_once '../include/myblockslist.php';

        /* -- Code to show existing myMedias -- */
        echo '<br><br>';
        echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_MYMEDIA_LIST . '</legend><br>';

        // To create existing myMedias table
        $resultA1 = $xoopsDB->queryF('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('myMedia'));
        [$numrows] = $xoopsDB->fetchRow($resultA1);

        $sql = 'SELECT id, pid, subject, left(informations, 32) as xinformations, media, media_url, right(media_url, 16) as xmedia_url, counter, offline 
			FROM ' . $xoopsDB->prefix('myMedia') . '
			ORDER BY id DESC';
        $resultA2 = $xoopsDB->queryF($sql, $xoopsModuleConfig['perpage'], $startart);

        echo "<table width='100%' cellspacing=1 cellpadding=3 border=0 class = outer>";
        echo '<tr>';
        echo "<td width='40' class='bg3' align='center'><b>" . _AM_MYMEDIA_ID . '</b></td>';
        echo "<td width='40' class='bg3' align='center'><b>" . _AM_MYMEDIA_PID . '</b></td>';
        echo "<td width='20%' class='bg3' align='center'><b>" . _AM_MYMEDIA_SUBJECT . '</b></td>';
        echo "<td class='bg3' align='center'><b>" . _AM_MYMEDIA_MEDIATYPE . '</b></td>';
        echo "<td class='bg3' align='center'><b>" . _AM_MYMEDIA_MEDIAURL . '</b></td>';
        echo "<td class='bg3' align='center'><b>" . _AM_MYMEDIA_BEGIN . '</b></td>';
        echo "<td class='bg3' align='center'><b>" . _AM_MYMEDIA_COUNTER . '</b></td>';
        echo "<td class='bg3' align='center'><b>" . _AM_MYMEDIA_LINE . '</b></td>';
        echo "<td width='60' class='bg3' align='center'><b>" . _AM_MYMEDIA_ACTIONS . '</b></td>';
        echo '</tr>';

        if ($numrows > 0) { // That is, if there ARE myMedias in the system
            while (list($id, $pid, $subject, $xinformations, $media, $media_url, $xmedia_url, $counter, $offline) = $xoopsDB->fetchrow($resultA2)) {
                $modify = "	<a href='content.php?op=mod&id=" . $id . '&pid=' . $pid . "'>
						<img src=" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/images/icon/edit.gif ALT='" . _AM_MYMEDIA_EDIT . "'>
						</a>";

                $delete = "	<a href='content.php?op=del&id=" . $id . '&pid=' . $pid . "'>
						<img src=" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/images/icon/delete.gif ALT='" . _AM_MYMEDIA_DELETE . "'>
						</a>";

                if ($media_url) {
                    $media_link = "<a href='" . $media_url . "' title='" . $media_url . "' target='_blank'>..." . $xmedia_url . '</a>';
                } else {
                    $media_link = '';
                }

                //	if ($pid == 0){$pid = $id;

                //		} else {$pid = $pid;}

                echo '<tr>';

                echo "<td class='head' align='center'>" . $id . '</td>';

                echo "<td class='head' align='center'>" . $pid . '</td>';

                echo "<td class='even' align='left'><a href='../content.php?id=$id&pid=$pid'>" . $myts->displayTarea($subject) . '</a></td>';

                echo "<td class='even' align='left'>" . $media . '</td>';

                echo "<td class='even' align='left'>" . $media_link . '</td>';

                echo "<td class='even' align='left'>" . strip_tags($xinformations) . '...</td>';

                echo "<td class='even' align='center'>" . $counter . '</td>';

                if (0 == $offline) {
                    echo "<td class='even' align='center'><img src=" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/images/icon/offline.gif alt='" . _AM_MYMEDIA_OFFLINE . "'></td>";
                } else {
                    echo "<td class='even' align='center'><img src=" . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . "/images/icon/online.gif alt='" . _AM_MYMEDIA_ONLINE . "'></td>";
                }

                echo "<td class='even' align='center'> $modify $delete </td>";

                echo '</tr>';
            }
        } else { // that is, $numrows = 0, there's no columns yet
            echo '<tr>';

            echo "<td class='head' align='center' colspan= '9'>" . _AM_MYMEDIA_NO_MYMEDIA . '</td>';

            echo '</tr>';
        }
        echo "<tr><td  class='even' align='center' colspan = '9'><form name='addmyMedia' method='post' action='content.php'><input type='submit' name='go' value='" . _AM_MYMEDIA_CREATE . "'></form></td></tr>";
        echo "</table>\n";
        $pagenav = new XoopsPageNav($numrows, $xoopsModuleConfig['perpage'], $startart, 'startart', 'id =' . $id);

        echo '<div style="text-align:center;">' . $pagenav->renderNav() . '</div>';
        echo '</fieldset>';
        echo "<br>\n";
}
xoops_cp_footer();

?>
