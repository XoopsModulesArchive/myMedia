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

// Function used to display a myMedia inside a block
// Parameters passed to this function :
// 1) max length of myMedia's mymedia
// 2) myMedia to display

function a_myMedia_show($options)
{
    global $xoopsDB, $xoopsUser;

    $block = [];

    $myts = MyTextSanitizer::getInstance();

    $logo_width = '';

    $module = 'myMedia';

    require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/functions_block.php';

    // Mise à Zero des variables

    $group = is_object($xoopsUser) ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];

    $where = 'id=' . $options[1];

    $order = '';

    $media = '';

    $rand = 0;

    $readmymedia = '';

    $blocks = '1';

    $artimage_url = myMedia_getmoduleoption('sbuploaddir');

    if ('center' != myMedia_getmoduleoption('logo_align')) {
        $align = myMedia_getmoduleoption('logo_align');

        $artimage_align = 'align="' . $align . '"';
    } else {
        $artimage_align = '';
    }

    // Afficher un myMedia au hasard

    if ('random' == $options[1]) {
        $result = $xoopsDB->queryF(
            'SELECT COUNT(*) 
											FROM ' . $xoopsDB->prefix('myMedia') . ' 
											WHERE offline = 1'
        );

        [$total] = $xoopsDB->fetchRow($result);

        $total = $total - 1;

        $rand = random_int(0, $total);

        $where = 'offline = 1';
    }

    // Afficher un myMedia pour chaque jours de l'année

    if ('day' == $options[1]) {
        $rand = date('z');

        $where = 'offline = 1';
    }

    // Afficher un myMedia pour chaque semaine de l'année

    if ('week' == $options[1]) {
        $rand = date('W');

        $where = 'offline = 1 AND pid = 0';
    }

    // Afficher un myMedia pour chaque jour de la semaine

    if ('week_day' == $options[1]) {
        $rand = date('w');

        $where = 'offline = 1  AND pid = 0';
    }

    // Afficher le dernier myMedia

    if ('latest' == $options[1]) {
        $order = 'ORDER BY datesub DESC';

        $where = 'offline = 1';
    }

    // Afficher le myMedia le plus lu

    if ('read' == $options[1]) {
        $order = 'ORDER BY counter DESC';

        $where = 'offline = 1';
    }

    // Afficher un myMedia lié

    if ('linked' == $options[1]) {
        $mymedia_link = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $where = 'id=' . $mymedia_link;
    }

    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('myMedia') . " WHERE $where $order";

    $result = $xoopsDB->queryF($sql, 1, $rand);

    // Vérifier l'existence de myMedia

    if ($xoopsDB->getRowsNum($result) <= 0) {
        return '';
        exit();
    }

    $myrow = $xoopsDB->fetchArray($result);

    // Vérifier permissions d'accès

    $groups = explode(' ', $myrow['groups']);

    if (count(array_intersect($group, $groups)) <= 0) {
        return '';
        exit();
    }

    // Création des liens et du contenu

    $html = !empty($myrow['nohtml']) ? 0 : 1;

    $smiley = !empty($myrow['nosmiley']) ? 0 : 1;

    $xcode = !empty($myrow['noxcode']) ? 0 : 1;

    $informations = $myrow['informations'];

    // MEDIA FILES

    // Media

    if ($myrow['media_url'] and !$options[4]) {
        $media_url = $myrow['media_url'];

        $media_size = 'width = "160" height="200"';

        require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/media.php';

        $block['media'] = $media;
    } elseif ('blank.gif' != $myrow['media'] and '' != $myrow['media'] and !$options[4]) {
        $media_url = XOOPS_URL . '/' . myMedia_getmoduleoption('sbmediadir') . '/' . $myrow['media'];

        $media_size = 'width = "160"';

        require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/media.php';

        $block['media'] = $media;
    } else {
        $media_url = '';

        $block['media'] = '';
    }

    //Logo width

    if ('1' == $options[3]) {
        if (myMedia_getmoduleoption('logo_width')) {
            $logo = XOOPS_ROOT_PATH . '/' . $artimage_url . '/' . $myrow['artimage'];

            $image_size = getimagesize("$logo");

            $width = $image_size[0];

            $height = $image_size[1];

            if (myMedia_getmoduleoption('logo_width') <= $width) {
                $logo_width = 'width="' . myMedia_getmoduleoption('logo_width') . '"';
            } else {
                $logo_width = 'width="' . $width . '"';
            }
        }

        // Logo align

        if ('center' == myMedia_getmoduleoption('logo_align')) {
            $artimage_align = '';

            $align = "<div align='center'>";

            $align02 = '</div>';
        } else {
            $artimage_align = 'align="' . myMedia_getmoduleoption('logo_align') . '"';

            $align = '';

            $align02 = '';
        }
    }

    if (($myrow['media'] or $myrow['media_url']) and $myrow['artimage'] and 'blank.gif' != $myrow['artimage'] and $options[3] and $options[4]) {
        require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/media.php';

        $image = $align . '
	<a href="' . XOOPS_URL . '/modules/' . $module . '/include/popup.php?id=' . $myrow['id'] . " \" target=\"wclose\" onclick=\"window.open('', 'wclose', 'width=" . $width_pop . ', height=' . $height_pop . ", toolbar=no, status=no, scrollbars=yes, resizable=yes, left=50, top=50')\">
	<img src=\"" . XOOPS_URL . '/' . $artimage_url . '/' . $myrow['artimage'] . '" alt="' . $myrow['subject'] . '" ' . $logo_width . ' ' . $artimage_align . '></a>' . $align02;
    } elseif ($myrow['artimage'] and 'blank.gif' != $myrow['artimage'] and $options[3]) {
        $image = $align . '
	<a href="' . XOOPS_URL . '/modules/' . $module . '/content.php?id=' . $myrow['id'] . '">
	<img src="' . XOOPS_URL . '/' . $artimage_url . '/' . $myrow['artimage'] . '" alt="' . $myrow['subject'] . $width_pop . '" ' . $logo_width . ' ' . $artimage_align . '></a>' . $align02;

        $block['media'] = '';
    } elseif ($options[3]) {
        require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/media.php';

        $image = $align . "
	<a href='" . $block['media'] . "' target=\"wclose\" onclick=\"window.open('', 'wclose', 'width=" . $width_pop . ', height=' . $height_pop . ", toolbar=no, status=no, scrollbars=yes, resizable=yes, left=50, top=50')\">
- " . $myrow['subject'] . ' - </a>' . $align02;
    } else {
        $image = '';
    }

    if ('1' == $options[2]) {
        $subject = '<br><b>' . $myrow['subject'] . '</b></center><br>';

    //	$subject = '<a href="'.XOOPS_URL.'/modules/'.$module.'/content.php?id='.$myrow['id'].'">'.$myrow['subject'].'</a></div><br>';
    } else {
        $subject = '</div>';
    }

    if ('linked' != $options[1]) {
        $readmymedia = '<a href="' . XOOPS_URL . '/modules/' . $module . '/content.php?id=' . $myrow['id'] . '">' . _MB_MYMEDIA_READMORE . '</a>';
    }

    // Affichage du contenu en fonction de la balise [blockbreak]

    $mymediaext = explode('[blockbreak]', $informations);

    $story_myMedias = count($mymediaext);

    $block['link'] = '';

    if (1 == $story_myMedias) {
        $mymedia = $informations;
    } else {
        $mymedia = $mymediaext[0];

        $block['link'] = $readmymedia;
    }

    if (mb_strlen($mymedia) >= $options[0]) {
        $block['link'] = $readmymedia;

        $goon = '...';
    } else {
        $goon = '';
    }

    $block['texte'] = $image . $subject . xoops_substr($myts->displayTarea($mymedia, $html, $smiley, $xcode), 0, $options[0], '') . $goon;

    return $block;
}

function a_myMedia_edit($options)
{
    global $xoopsDB;

    $lst = '';

    $sql = 'SELECT subject, id, pid FROM ' . $xoopsDB->prefix('myMedia') . ' ORDER BY subject ASC';

    $result = $xoopsDB->queryF($sql);

    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $selected = '';

        if ($myrow['id'] == $options[1]) {
            $selected = ' selected ';
        }

        $lst .= "<option value='" . $myrow['id'] . "' " . $selected . '>' . $myrow['subject'] . '</option>';
    }

    $form = _MB_MYMEDIA_MAXLENGTH . '&nbsp;<input type="text" size="4" name="options[0]" value="' . $options[0] . '">&nbsp;' . _MB_MYMEDIA_CHAR;

    $form .= '<br>' . _MB_MYMEDIA_SELECT_MYMEDIA . '&nbsp;<select name="options[1]">';

    $form .= '<option value="random"';

    if ('random' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_RANDOM . '</option>';

    $form .= '<option value="latest"';

    if ('latest' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_LATEST . '</option>';

    $form .= '<option value="read"';

    if ('read' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_POP . '</option>';

    $form .= '<option value="linked"';

    if ('linked' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_LINKED . '</option>';

    $form .= '<option value="day"';

    if ('day' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_DAY . '</option>';

    $form .= '<option value="week"';

    if ('week' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_WEEK . '</option>';

    $form .= '<option value="week_day"';

    if ('week_day' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_WEEKDAY . '</option>';

    $form .= '<option value= "0"';

    if ('0' == $options[1]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_SELECT_NONE . '</option>';

    $form .= '' . $lst . '';

    $form .= '</select><br>';

    $form .= _MB_MYMEDIA_SHOWTITLE . "&nbsp;<input type='radio' id='options[2]' name='options[2]' value='1'";

    if (1 == $options[2]) {
        $form .= ' checked';
    }

    $form .= '>&nbsp;' . _YES . "&nbsp;<input type='radio' id='options[2]' name='options[2]' value='0'";

    if (0 == $options[2]) {
        $form .= ' checked';
    }

    $form .= '>&nbsp;' . _NO . '<br>';

    $form .= _MB_MYMEDIA_SHOWLOGO . "&nbsp;<input type='radio' id='options[3]' name='options[3]' value='1'";

    if (1 == $options[3]) {
        $form .= ' checked';
    }

    $form .= '>&nbsp;' . _YES . "&nbsp;<input type='radio' id='options[3]' name='options[3]' value='0'";

    if (0 == $options[3]) {
        $form .= ' checked';
    }

    $form .= '>&nbsp;' . _NO . '<br>';

    $form .= _MB_MYMEDIA_POPUP . "&nbsp;<input type='radio' id='options[4]' name='options[4]' value='1'";

    if (1 == $options[4]) {
        $form .= ' checked';
    }

    $form .= '>&nbsp;' . _YES . "&nbsp;<input type='radio' id='options[4]' name='options[4]' value='0'";

    if (0 == $options[4]) {
        $form .= ' checked';
    }

    $form .= '>&nbsp;' . _NO . '';

    return $form;
}

function a_myMedia_menu_show($options)
{
    global $xoopsDB, $xoopsUser, $xoopsModule;

    $module = 'myMedia';

    require_once XOOPS_ROOT_PATH . '/modules/' . $module . '/include/functions_block.php';

    $myts = MyTextSanitizer::getInstance();

    $block = [];

    $block['format'] = $options[0];

    $myMedia['artimage_size'] = $options[1];

    $myMedia['columns'] = $options[2];

    $artimage_url = myMedia_getmoduleoption('sbuploaddir');

    $select = ' AND pid = 0';

    if ('linked' == $options[3]) {
        $linked = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($linked) {
            $sql = $xoopsDB->query(
                'SELECT id, pid
		FROM ' . $xoopsDB->prefix('myMedia') . " 
		WHERE pid = $linked OR id = $linked"
            );

            while (false !== ($myrow = $xoopsDB->fetchArray($sql))) {
                $pid = $myrow['pid'];
            }

            $options[3] = 'id';

            $select = "AND (id = $pid OR pid = $pid)";
        }
    }

    $group = is_object($xoopsUser) ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];

    $result = $xoopsDB->query(
        'SELECT id, pid, subject, offline, groups, artimage, datesub, counter 
		FROM ' . $xoopsDB->prefix('myMedia') . " 
		WHERE offline = 1 $select
		ORDER BY $options[3]"
    );

    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $groups = explode(' ', $myrow['groups']);

        if (count(array_intersect($group, $groups)) > 0) {
            if ('counter DESC' == $options[3]) {
                $title = htmlspecialchars($myrow['subject']) . ' (' . $myrow['counter'] . ')';
            } else {
                $title = htmlspecialchars($myrow['subject']);
            }

            $myMedia['subject'] = $title;

            $myMedia['link'] = XOOPS_URL . '/modules/' . $module . '/content.php?id=' . $myrow['id'];

            if ('' != $myrow['artimage']) {
                $myMedia['artimage'] = XOOPS_URL . '/' . $artimage_url . '/' . $myrow['artimage'];
            } else {
                $myMedia['artimage'] = XOOPS_URL . '/' . $artimage_url . '/blank.gif';
            }

            $block['mymedias'][] = $myMedia;
        }
    }

    if ('linked' != $options[3] or $linked) {
        return $block;
    }
}

function a_myMedia_menu_edit($options)
{
    $form = _MB_MYMEDIA_FORMAT . '&nbsp;<select name="options[]">';

    $form .= '<option value="menu"';

    if ('menu' == $options[0]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_MENU . '</option>';

    $form .= '<option value="list"';

    if ('list' == $options[0]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_LIST . '</option>';

    $form .= '<option value="pic"';

    if ('pic' == $options[0]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_PIC . '</option>';

    $form .= '</select><br>';

    $form .= '' . _MB_MYMEDIA_PICSIZE . "<input type='text' size='4' name='options[1]' value='" . $options[1] . "'><br>";

    $form .= _MB_MYMEDIA_COLUMNS . '&nbsp;<select name="options[]">';

    $form .= '<option value="1"';

    if ('1' == $options[2]) {
        $form .= ' selected="selected"';
    }

    $form .= '>1</option>';

    $form .= '<option value="2"';

    if ('2' == $options[2]) {
        $form .= ' selected="selected"';
    }

    $form .= '>2</option>';

    $form .= '<option value="3"';

    if ('3' == $options[2]) {
        $form .= 'selected="selected"';
    }

    $form .= '>3</option>';

    $form .= '<option value="4"';

    if ('4' == $options[2]) {
        $form .= 'selected="selected"';
    }

    $form .= '>4</option>';

    $form .= '<option value="5"';

    if ('5' == $options[2]) {
        $form .= 'selected="selected"';
    }

    $form .= '>5</option>';

    $form .= '<option value="6"';

    if ('6' == $options[2]) {
        $form .= 'selected="selected"';
    }

    $form .= '>6</option>';

    $form .= '</select><br>';

    $form .= _MB_MYMEDIA_ORDER . '&nbsp;<select name="options[]">';

    $form .= '<option value="subject ASC"';

    if ('subject ASC' == $options[3]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_ORDER_SUBJECT_ASC . '</option>';

    $form .= '<option value="subject DESC"';

    if ('subject DESC' == $options[3]) {
        $form .= ' selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_ORDER_SUBJECT_DESC . '</option>';

    $form .= '<option value="datesub ASC"';

    if ('datesub ASC' == $options[3]) {
        $form .= 'selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_ORDER_DATE_ASC . '</option>';

    $form .= '<option value="datesub DESC"';

    if ('datesub DESC' == $options[3]) {
        $form .= 'selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_ORDER_DATE_DESC . '</option>';

    $form .= '<option value="counter DESC"';

    if ('counter DESC' == $options[3]) {
        $form .= 'selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_ORDER_COUNTER . '</option>';

    $form .= '<option value="linked"';

    if ('linked' == $options[3]) {
        $form .= 'selected="selected"';
    }

    $form .= '>' . _MB_MYMEDIA_ORDER_LINKED . '</option>';

    $form .= '</select>';

    return $form;
}

?>
