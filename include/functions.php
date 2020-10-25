<?php

/**
 * $Id: functions.php,v 1.1 2006/03/28 01:43:16 mikhail Exp $
 * Module: Soapbox
 * Version: v 1.4
 * Release Date: 17 March 2004
 * Author: hsalazar
 * Licence: GNU
 * @param mixed $image
 * @param mixed $path
 * @param mixed $imgsource
 * @param mixed $alttext
 */

/**
 * getLinkedUnameFromId()
 *
 * @return
 **/
function displayimage($image = 'blank.gif', $path = '', $imgsource = '', $alttext = '')
{
    global $xoopsConfig, $xoopsUser, $xoopsModule;

    $showimage = '';

    /**
     * Check to see if link is given
     */

    if ($path) {
        $showimage = '<a href=' . $path . '>';
    }

    /**
     * checks to see if the file is valid else displays default blank image
     */

    if (!is_dir(XOOPS_ROOT_PATH . '/' . $imgsource . '/' . $image) && file_exists(XOOPS_ROOT_PATH . '/' . $imgsource . '/' . $image)) {
        $showimage .= '<img src=' . XOOPS_URL . '/' . $imgsource . '/' . $image . " border='0' alt=" . $alttext . '></a>';
    } else {
        if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
            $showimage .= "<img src=images/brokenimg.png border='0' alt='" . _AM_SB_ISADMINNOTICE . "'></a>";
        } else {
            $showimage .= "<img src=images/blank.png border='0' alt=" . $alttext . '></a>';
        }
    }

    // clearstatcache();

    return $showimage;
}

function uploading($allowed_mimetypes, $httppostfiles, $redirecturl = 'index.php', $num = 0, $dir = 'uploads', $redirect = 0)
{
    require_once XOOPS_ROOT_PATH . '/class/uploader.php';

    global $xoopsConfig, $xoopsModuleConfig, $_POST;

    $maxfilesize = $xoopsModuleConfig['maxfilesize'];

    $maxfilewidth = $xoopsModuleConfig['maximgwidth'];

    $maxfileheight = $xoopsModuleConfig['maximgheight'];

    $uploaddir = XOOPS_ROOT_PATH . '/' . $dir . '/';

    $uploader = new XoopsMediaUploader($uploaddir, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);

    if ($uploader->fetchMedia($_POST['xoops_upload_file'][$num])) {
        if (!$uploader->upload()) {
            $errors = $uploader->getErrors();

            redirect_header($redirecturl, 1, $errors);
        } else {
            if ($redirect) {
                redirect_header($redirecturl, '1', 'Image Uploaded');
            }
        }
    } else {
        $errors = $uploader->getErrors();

        redirect_header($redirecturl, 1, $errors);
    }
}

function htmlarray($thishtmlmyMedia, $thepath)
{
    global $xoopsConfig, $wfsConfig;

    $file_array = filesarray($thepath);

    echo "<select size='1' name='htmlmyMedia'>";

    echo "<option value='-1'>------</option>";

    foreach ($file_array as $htmlmyMedia) {
        if ($htmlmyMedia == $thishtmlmyMedia) {
            $opt_selected = "selected='selected'";
        } else {
            $opt_selected = '';
        }

        echo "<option value='" . $htmlmyMedia . "' $opt_selected>" . $htmlmyMedia . '</option>';
    }

    echo '</select>';

    return $htmlmyMedia;
}

function filesarray($filearray)
{
    $files = [];

    $dir = opendir($filearray);

    while (false !== ($file = readdir($dir))) {
        if ((!preg_match('/^[.]{1,2}$/', $file) && preg_match('/[.htm|.html|.xhtml]$/i', $file) && !is_dir($file))) {
            if ('cvs' != mb_strtolower($file) && !is_dir($file)) {
                $files[$file] = $file;
            }
        }
    }

    closedir($dir);

    asort($files);

    reset($files);

    return $files;
}

function getuserForm($user)
{
    global $xoopsDB, $xoopsConfig;

    echo "<select name='author'>";

    echo "<option value='-1'>------</option>";

    $result = $xoopsDB->queryF('SELECT uid, uname FROM ' . $xoopsDB->prefix('users') . ' ORDER BY uname');

    while (list($uid, $uname) = $xoopsDB->fetchRow($result)) {
        if ($uid == $user) {
            $opt_selected = "selected='selected'";
        } else {
            $opt_selected = '';
        }

        echo "<option value='" . $uid . "' $opt_selected>" . $uname . '</option>';
    }

    echo '</select></div>';
}

?>
