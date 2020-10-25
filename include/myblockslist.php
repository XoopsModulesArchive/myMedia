<?php

/**
 * $Id: myblockslist.php,v 1.1 2006/03/28 01:43:16 mikhail Exp $
 * Module: SmartPartner
 * Author: The SmartFactory <www.smartfactory.ca>
 * Licence: GNU
 */

// ------------------------------------------------------------------------- //
//                            myblocksadmin.php                              //
//                - XOOPS block admin for each modules -                     //
//                          GIJOE <http://www.peak.ne.jp>                   //
// ------------------------------------------------------------------------- //

//require_once "../../../include/cp_header.php";
require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';

$xoops_system_path = XOOPS_ROOT_PATH . '/modules/system';

// get blocks owned by the module
$block_arr = &XoopsBlock::getByModule($xoopsModule->mid());

function list_blocks()
{
    global $block_arr, $xoopsModule;

    $count = '0';

    echo _AM_MYMEDIA_BLOCK_MYMEDIA . ' : ';

    // blocks displaying loop

    foreach (array_keys($block_arr) as $i) {
        $count = $count + 1;

        $title = $block_arr[$i]->getVar('title');

        $name = $block_arr[$i]->getVar('name');

        $bid = $block_arr[$i]->getVar('bid');

        // visible and side

        if (1 != $block_arr[$i]->getVar('visible')) {
            $ssel = '#DDD';

            $color = '#666';
        } else {
            $ssel = '#4C4';

            $color = '#FFF';
        }

        // displaying part

        echo "<li style='list-style: none; margin: 0; display: inline; '>
				<a href='../../system/admin.php?fct=blocksadmin&amp;op=edit&amp;bid=$bid' style='padding: 1px 0.5em; margin-left: 1px; border: 1px solid #778; background: $ssel; color: $color; text-decoration: none;' title='" . $name . "'>" . $title . '</a></li>';

        if (4 == $count) {
            echo '<br><br>' . _AM_MYMEDIA_BLOCK_MENU . ' : ';
        }
    }
}

echo "<a href='../../system/admin.php?fct=blocksadmin&selmod=-1&selgrp=2&selvis=1'>" . _AM_MYMEDIA_BLOCK_LINK . '</a> :<ul>';
list_blocks();
echo '</ul>';
?>
