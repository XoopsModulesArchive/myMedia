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

function myMedia_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB, $xoopsUser;

    $sql = 'SELECT id, uid, datesub, subject, informations, groups  FROM ' . $xoopsDB->prefix('myMedia') . ' WHERE offline = 1 ';

    if (0 != $userid) {
        $sql .= ' AND uid=' . $userid . ' ';
    }

    // because count() returns 1 even if a supplied variable

    // is not an array, we must check if $querryarray is really an array

    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((informations LIKE '%$queryarray[0]%' OR subject LIKE '%$queryarray[0]%' )";

        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";

            $sql .= "(informations LIKE '%$queryarray[$i]%' OR subject LIKE '%$queryarray[$i]%')";
        }

        $sql .= ') ';
    }

    $sql .= 'ORDER BY datesub DESC';

    $result = $xoopsDB->queryF($sql, $limit, $offset);

    $ret = [];

    $i = 0;

    $group = is_object($xoopsUser) ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];

    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $groups = explode(' ', $myrow['groups']);

        if (count(array_intersect($group, $groups)) > 0) {
            $ret[$i]['image'] = 'images/mymedia.gif';

            $ret[$i]['link'] = 'content.php?id=' . $myrow['id'] . '';

            $ret[$i]['title'] = $myrow['subject'];

            $ret[$i]['time'] = $myrow['datesub'];

            $ret[$i]['uid'] = $myrow['uid'];

            $i++;
        }
    }

    return $ret;
}

?>
