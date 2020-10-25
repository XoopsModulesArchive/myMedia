<?php

/**
 * $Id: comment_functions.php,v 1.1 2006/03/28 01:43:16 mikhail Exp $
 * Module: SmartSection
 * Author: marcan <marcan@notrevie.ca>
 * Licence: GNU
 * @param mixed $item_id
 * @param mixed $total_num
 */
function myMedia_com_update($item_id, $total_num)
{
    /*$db = &XoopsDatabaseFactory::getDatabaseConnection();
    $sql = 'UPDATE ' . $db->prefix('smartsection_items') . ' SET comments = ' . $total_num . ' WHERE itemid = ' . $item_id;
    $db->query($sql);*/
}

function myMedia_com_approve(&$comment)
{
    // notification mail here
}

?>
