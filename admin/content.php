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
//                  myMedia v1.0								//
//  ------------------------------------------------------------------------ 	//

require_once 'admin_header.php';

$myts = MyTextSanitizer::getInstance();
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/functions.php';
require_once XOOPS_ROOT_PATH . '/class/wysiwyg/formwysiwygtextarea.php';

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

// -- Edit function -- //
function editarticle($id = '')
{
    global $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL;

    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/functions.php';

    /**
     * Clear all variables before we start
     */

    if (!isset($noblock)) {
        $noblock = $xoopsModuleConfig['option_block'];
    } else {
        $notitle = intval($noblock);
    }

    if (!isset($nohtml)) {
        $nohtml = 0;
    } else {
        $nohtml = intval($nohtml);
    }

    if (!isset($nosmiley)) {
        $nosmiley = 0;
    } else {
        $nosmiley = intval($nosmiley);
    }

    if (!isset($noxcode)) {
        $noxcode = 0;
    } else {
        $noxcode = intval($noxcode);
    }

    if (!isset($notitle)) {
        $notitle = $xoopsModuleConfig['option_title'];
    } else {
        $notitle = intval($notitle);
    }

    if (!isset($nologo)) {
        $nologo = $xoopsModuleConfig['option_logo'];
    } else {
        $nologo = intval($nologo);
    }

    if (!isset($nomain)) {
        $nomain = $xoopsModuleConfig['option_main'];
    } else {
        $nomain = intval($nomain);
    }

    if (!isset($offline)) {
        $offline = 1;
    } else {
        $offline = intval($offline);
    }

    if (!isset($counter)) {
        $counter = 0;
    }

    if (!isset($hidden)) {
        $hidden = 1;
    }

    if (!isset($media)) {
        $media = 'blank.gif';
    } else {
        $media = intval($media);
    }

    if (!isset($media_url)) {
        $media_url = '';
    } else {
        $media_url = intval($media_url);
    }

    if (!isset($media_s)) {
        $media_s = $xoopsModuleConfig['media_size'];
    } else {
        $media_s = intval($media_s);
    }

    if (!isset($cancomment)) {
        $cancomment = 1;
    }

    if (!isset($informations)) {
        $informations = $xoopsModuleConfig['informations'];
    } else {
        $informations = '';
    }

    if (!isset($subject)) {
        $subject = '';
    }

    if (!isset($pid)) {
        $pid = 0;
    } else {
        $pid = intval($pid);
    }

    if (!isset($artimage)) {
        $artimage = 'blank.gif';
    } else {
        $artimage = intval($artimage);
    }

    // if ( isset( $_GET['pid'] ) ) $pid = $_GET['pid'];

    // if ( isset( $_POST['pid'] ) ) $pid = $_POST['pid'];

    require_once '../include/nav.php';

    // If there is a parameter, and the id exists, retrieve data: we're editing a myMedia

    if ($id) {
        $result = $xoopsDB->queryF('SELECT * FROM ' . $xoopsDB->prefix('myMedia') . " WHERE id = $id");

        [$id, $pid, $uid, $datesub, $subject, $informations, $nohtml, $nosmiley, $noxcode, $notitle, $nologo, $nomain, $noblock, $counter, $offline, $media, $media_url, $media_s, $cancomment, $artimage, $groups, $hidden] = $xoopsDB->fetchrow($result);

        if (!$xoopsDB->getRowsNum($result)) {
            redirect_header('index.php', 1, _AM_MYMEDIA_NOMYMEDIATOEDIT);

            exit();
        }

        $myts = MyTextSanitizer::getInstance();

        $sform = new XoopsThemeForm(_AM_MYMEDIA_MODMYMEDIA . ': ' . $myts->displayTarea($subject), 'op', xoops_getenv('PHP_SELF'));

        $groups = explode(' ', $groups);
    } else { // there's no parameter, so we're adding a myMedia
        $sform = new XoopsThemeForm(_AM_MYMEDIA_CREATING, 'op', xoops_getenv('PHP_SELF'));

        $memberHandler = xoops_getHandler('member');

        $xoopsgroups = $memberHandler->getGroups();

        $count = count($xoopsgroups);

        $groups = [];

        for ($i = 0; $i < $count; $i++) {
            $groups[] = $xoopsgroups[$i]->getVar('groupid');
        }
    }

    $sform->setExtra('enctype="multipart/form-data"');

    // Subject

    // This part is common to edit/add

    $sform->addElement(new XoopsFormText(_AM_MYMEDIA_SUBJECT, 'subject', 50, 80, $subject), true);

    // Parent files

    $db = XoopsDatabaseFactory::getDatabaseConnection();

    $xt = new XoopsTree($db->prefix('myMedia'), 'id', 'pid');

    ob_start();

    $xt->makeMySelBox('subject', 'id', $pid, 1, 'pid');

    $sform->addElement(new XoopsFormLabel(_AM_MYMEDIA_PARENT, ob_get_contents()));

    ob_end_clean();

    // Bodytext

    if (1 == $xoopsModuleConfig['wysiwyg']) {
        $wysiwyg_text_area = new XoopsFormWysiwygTextArea(_AM_MYMEDIA_BODY, 'informations', $informations, '100%', '400px', '');

        $wysiwyg_text_area->setUrl('/class/wysiwyg');

        $wysiwyg_text_area->setSkin('default');

        $sform->addElement($wysiwyg_text_area, true);
    } else {
        $sform->addElement(new XoopsFormDhtmlTextArea(_AM_MYMEDIA_BODY, 'informations', $informations, 15, 60));
    }

    // OFFLINE

    // Code to take article offline, for maintenance purposes

    $offline_radio = new XoopsFormRadioYN(_AM_MYMEDIA_SWITCHOFFLINE, 'offline', $offline, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

    $sform->addElement($offline_radio);

    // GROUPS

    $sform->addElement(new XoopsFormSelectGroup(_AM_MYMEDIA_GROUPS, 'groups', true, $groups, 5, true));

    // IMAGE

    // The myMedia CAN have its own image :)

    // First, if the myMedia's image doesn't exist, set its value to the blank file

    if (!file_exists(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $artimage) || !$artimage) {
        $artimage = 'blank.gif';
    } else {
        $artimage = $artimage;
    }

    // Code to create the image selector

    $graph_array = &XoopsLists:: getImgListAsArray(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['sbuploaddir']);

    $artimage_select = new XoopsFormSelect('', 'artimage', $artimage);

    $artimage_select->addOptionArray($graph_array);

    $artimage_select->setExtra("onchange='showImgSelected(\"image5\", \"artimage\", \"" . $xoopsModuleConfig['sbuploaddir'] . '", "", "' . XOOPS_URL . "\")'");

    $artimage_tray = new XoopsFormElementTray(_AM_MYMEDIA_SELECT_IMG, '&nbsp;');

    $artimage_tray->addElement($artimage_select);

    $artimage_tray->addElement(new XoopsFormLabel('', "<br><br><img src='" . XOOPS_URL . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $artimage . "' name='image5' id='image5' alt='" . $artimage . "'>"));

    $sform->addElement($artimage_tray);

    // Code to call the file browser to select an image to upload

    $sform->addElement(new XoopsFormFile(_AM_MYMEDIA_UPLOADIMAGE, 'cimage', $xoopsModuleConfig['maxfilesize']), false);

    // MEDIA

    // The myMedia CAN have its own media

    // First, if the myMedia's media doesn't exist, set its value to the blank file

    if (file_exists(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['sbmediadir'] . '/' . $media)) {
        $media = $media;
    } else {
        $media = 'blank.gif';
    }

    // Code to create the media selector

    $media_array = &XoopsLists:: getFileListAsArray(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['sbmediadir']);

    $media_select = new XoopsFormSelect('', 'media', $media);

    $media_select->addOptionArray($media_array);

    $media_tray = new XoopsFormElementTray(_AM_MYMEDIA_SELECT_MEDIA, '&nbsp;');

    $media_tray->addElement($media_select);

    $sform->addElement($media_tray);

    // MEDIA URL

    // Code for direct media url

    $sform->addElement(new XoopsFormText(_AM_MYMEDIA_MEDIA, 'media_url', 80, 255, $media_url), false);

    if (1 == $xoopsModuleConfig['extended_option']) {
        // MEDIA SIZE

        // Code to create the media size selector

        $media_s_array = [
            'default' => _AM_MYMEDIA_SELECT_DEFAULT,
'custom' => _AM_MYMEDIA_SELECT_CUSTOM,
'tv_small' => _AM_MYMEDIA_SELECT_TVSMALL,
'tv_medium' => _AM_MYMEDIA_SELECT_TVMEDIUM,
'tv_big' => _AM_MYMEDIA_SELECT_TVBIG,
'mv_small' => _AM_MYMEDIA_SELECT_MVSMALL,
'mv_medium' => _AM_MYMEDIA_SELECT_MVMEDIUM,
'mv_big' => _AM_MYMEDIA_SELECT_MVBIG,
        ];

        $media_s_select = new XoopsFormSelect('', 'media_s', $media_s);

        $media_s_select->addOptionArray($media_s_array);

        $media_s_tray = new XoopsFormElementTray(_AM_MYMEDIA_MEDIA_SIZE, '&nbsp;');

        $media_s_tray->addElement($media_s_select);

        $sform->addElement($media_s_tray);

        // COMMENTS

        // Code to allow comments

        $addcomments_radio = new XoopsFormRadioYN(_AM_MYMEDIA_ALLOWCOMMENTS, 'cancomment', $cancomment, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

        $sform->addElement($addcomments_radio);

        // TITLE

        // Code to display or hidde title in the myMedia

        $notitle_radio = new XoopsFormRadioYN(_AM_MYMEDIA_NOTITLE, 'notitle', $notitle, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

        $sform->addElement($notitle_radio);

        // LOGO

        // Code to display or hidde image

        $nologo_radio = new XoopsFormRadioYN(_AM_MYMEDIA_NOLOGO, 'nologo', $nologo, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

        $sform->addElement($nologo_radio);

        // MAIN MENU

        // Code to display or hidde link in the main menu

        $nomain_radio = new XoopsFormRadioYN(_AM_MYMEDIA_NOMAIN, 'nomain', $nomain, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

        $sform->addElement($nomain_radio);

        // HIDE IN INDEX

        $hidden_radio = new XoopsFormRadioYN(_AM_MYMEDIA_HIDDEN, 'hidden', $hidden, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

        $sform->addElement($hidden_radio);

        // ARTICLE IN BLOCK

        // Code to put article in block

        $block_radio = new XoopsFormRadioYN(_AM_MYMEDIA_BLOCK, 'noblock', $noblock, ' ' . _AM_MYMEDIA_YES . '', ' ' . _AM_MYMEDIA_NO . '');

        $sform->addElement($block_radio);

        //COUNTER

        $sform->addElement(new XoopsFormText(_AM_MYMEDIA_COUNTER, 'counter', 5, 11, $counter), true);

        // VARIOUS OPTIONS

        // VARIOUS OPTIONS

        $options_tray = new XoopsFormElementTray(_AM_MYMEDIA_OPTIONS, '<br>');

        $html_checkbox = new XoopsFormCheckBox('', 'nohtml', $nohtml);

        $html_checkbox->addOption(1, _AM_MYMEDIA_NOHTML);

        $options_tray->addElement($html_checkbox);

        $smiley_checkbox = new XoopsFormCheckBox('', 'nosmiley', $nosmiley);

        $smiley_checkbox->addOption(1, _AM_MYMEDIA_NOSMILEY);

        $options_tray->addElement($smiley_checkbox);

        $xcodes_checkbox = new XoopsFormCheckBox('', 'noxcode', $noxcode);

        $xcodes_checkbox->addOption(1, _AM_MYMEDIA_NOXCODE);

        $options_tray->addElement($xcodes_checkbox);

        $sform->addElement($options_tray);
    }

    $sform->addElement(new XoopsFormHidden('id', $id));

    $button_tray = new XoopsFormElementTray('', '');

    $hidden = new XoopsFormHidden('op', 'addart');

    $button_tray->addElement($hidden);

    if (!$id) { // there's no id? Then it's a new myMedia
        $butt_create = new XoopsFormButton('', '', _AM_MYMEDIA_SUBMIT, 'submit');

        $butt_create->setExtra('onclick="this.form.elements.op.value=\'addart\'"');

        $button_tray->addElement($butt_create);

        $butt_clear = new XoopsFormButton('', '', _AM_MYMEDIA_CLEAR, 'reset');

        $button_tray->addElement($butt_clear);

        $butt_cancel = new XoopsFormButton('', '', _AM_MYMEDIA_CANCEL, 'button');

        $butt_cancel->setExtra('onclick="history.go(-1)"');

        $button_tray->addElement($butt_cancel);
    } else { // else, we're editing an existing article
        $butt_create = new XoopsFormButton('', '', _AM_MYMEDIA_MODIFY, 'submit');

        $butt_create->setExtra('onclick="this.form.elements.op.value=\'addart\'"');

        $button_tray->addElement($butt_create);

        $butt_cancel = new XoopsFormButton('', '', _AM_MYMEDIA_CANCEL, 'button');

        $butt_cancel->setExtra('onclick="history.go(-1)"');

        $button_tray->addElement($butt_cancel);
    }

    $sform->addElement($button_tray);

    $sform->display();

    unset($hidden);
}

/* -- Available operations -- */
switch ($op) {
    case 'mod':
        xoops_cp_header();
        $id = isset($_POST['id']) ? intval($_POST['id']) : intval($_GET['id']);

        editarticle($id);
        break;
    case 'addart':
        $id = (isset($_POST['id'])) ? intval($_POST['id']) : 0;
        $pid = isset($pid) ? intval($pid) : 0;

        $block = (isset($_POST['noblock'])) ? intval($_POST['noblock']) : 0;
        $offline = (isset($_POST['offline'])) ? intval($_POST['offline']) : 0;
        $media = $myts->addSlashes($_POST['media']);
        $media_url = $myts->addSlashes($_POST['media_url']);
        $media_s = $_POST['media_s'];
        $cancomment = isset($_POST['cancomment']) ? intval($_POST['cancomment']) : 1;
        $hidden = isset($_POST['hidden']) ? intval($_POST['hidden']) : 1;
        $notitle = isset($notitle) ? intval($notitle) : $xoopsModuleConfig['option_title'];
        $nologo = isset($nologo) ? intval($nologo) : $xoopsModuleConfig['option_logo'];
        $nomain = isset($nomain) ? intval($nomain) : $xoopsModuleConfig['option_main'];
        $noblock = isset($noblock) ? intval($noblock) : $xoopsModuleConfig['option_block'];
        $counter = isset($counter) ? intval($counter) : 0;
        $nohtml = isset($nohtml) ? intval($nohtml) : 0;
        $nosmiley = isset($nosmiley) ? intval($nosmiley) : 0;
        $noxcode = isset($noxcode) ? intval($noxcode) : 0;
        $artimage = (isset($_POST['artimage'])) ? intval($_POST['artimage']) : 0;
        $subject = htmlspecialchars($_POST['subject']);
        $informations = $myts->addSlashes($_POST['informations']);
        $date = time();
        $groups = $_POST['groups'];
        $groups = (is_array($groups)) ? implode(' ', $groups) : '';

        // ARTICLE IMAGE
        // Define variables
        $error = 0;
        $word = null;
        $uid = $xoopsUser->uid();
        $submit = 1;
        $datesub = time();
        if ('' != $HTTP_POST_FILES['cimage']['name']) {
            require_once XOOPS_ROOT_PATH . '/class/uploader.php';

            if (file_exists(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['sbuploaddir'] . '/' . $HTTP_POST_FILES['cimage']['name'])) {
                redirect_header('index.php', 1, _AM_MYMEDIA_FILEEXISTS);
            }

            $allowed_mimetypes = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png'];

            uploading($allowed_mimetypes, $HTTP_POST_FILES['cimage']['name'], 'index.php', 0, $xoopsModuleConfig['sbuploaddir']);

            $artimage = $HTTP_POST_FILES['cimage']['name'];
        } elseif ('blank.gif' != $_POST['artimage']) {
            $artimage = $myts->addSlashes($_POST['artimage']);
        } else {
            $artimage = 'blank.gif';
        }

        // Save to database
        if (!$id) {
            if ($xoopsDB->queryF(
                'INSERT INTO '
                . $xoopsDB->prefix('myMedia')
                . " ( pid, uid, datesub, subject, informations, nohtml, nosmiley, noxcode, notitle,  nologo, nomain, noblock, artimage, cancomment, media, media_url, media_size, offline, groups, hidden ) VALUES ('$pid', '$uid', '$datesub', '$subject', '$informations', '$nohtml', '$nosmiley', '$noxcode', '$notitle', '$nologo', '$nomain', '$noblock', '$artimage', '$cancomment', '$media','$media_url', '$media_s', '$offline', '$groups', '$hidden' )"
            )) {
                redirect_header('index.php', 1, _AM_MYMEDIA_MYMEDIACREATED);
            } else {
                redirect_header('index.html', 1, _AM_MYMEDIA_MYMEDIANOTCREATED);
            }
        } else {  // That is, $id exists, thus we're editing an article
            // Vérifier la validité de l'insert

            $sql = $xoopsDB->queryF(
                'SELECT COUNT(*) 
			FROM ' . $xoopsDB->prefix('myMedia') . ' 
			WHERE id = ' . $pid . ' AND pid = ' . $id . ''
            );

            [$numrows] = $xoopsDB->fetchRow($sql);

            if ($numrows > 0 or $pid == $id) {
                redirect_header('index.html', 3, _AM_MYMEDIA_MYMEDIACANTPARENT);
            }

            if ($xoopsDB->queryF(
                'UPDATE '
                . $xoopsDB->prefix('myMedia')
                . " SET uid='$uid', datesub='$datesub', subject = '$subject', pid = '$pid', informations = '$informations', nohtml = '$nohtml', nosmiley = '$nosmiley', noxcode = '$noxcode', notitle = '$notitle', nologo = '$nologo', nomain = '$nomain', noblock = '$noblock', artimage = '$artimage', cancomment = '$cancomment', media = '$media', media_url = '$media_url', media_size='$media_s' , offline = '$offline', groups='$groups', counter='$counter', hidden='$hidden' WHERE id = '$id'"
            )) {
                redirect_header('index.php', 1, _AM_MYMEDIA_MYMEDIAMODIFIED);
            } else {
                redirect_header('index.php', 1, _AM_MYMEDIA_MYMEDIANOTUPDATED);
            }
        }
        exit();
        break;
    case 'del':
        $confirm = (isset($confirm)) ? 1 : 0;
        if ($confirm) {
            $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('myMedia') . " WHERE id = $id");

            xoops_comment_delete($xoopsModule->getVar('mid'), $id);

            redirect_header('index.php', 1, sprintf(_AM_MYMEDIA_MYMEDIADELETED, $subject));

            exit();
        }  
            $id = (isset($_POST['id'])) ? intval($_POST['id']) : intval($id);
            $result = $xoopsDB->queryF('SELECT id, subject FROM ' . $xoopsDB->prefix('myMedia') . " WHERE id = $id");
            [$id, $subject] = $xoopsDB->fetchrow($result);
            xoops_cp_header();
            xoops_confirm(['op' => 'del', 'id' => $id, 'confirm' => 1, 'subject' => $subject], 'content.php', _AM_MYMEDIA_DELETETHISMYMEDIA . '<br><br>' . $subject, _AM_MYMEDIA_DELETE);
            xoops_cp_footer();

        exit();
        break;
    case 'default':
    default:
        xoops_cp_header();
        editarticle();
        break;
}
xoops_cp_footer();
?>
