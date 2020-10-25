<?php

/**
 * $Id: metagen.php,v 1.1 2006/03/28 01:43:16 mikhail Exp $
 * Module: myMedia
 * Author: The SmartFactory
 * Licence: GNU
 * @param mixed $text
 * @param mixed $minChar
 */
function findKeyWordsInSting($text, $minChar)
{
    $myts = MyTextSanitizer::getInstance();

    $keywords = [];

    $originalKeywords = explode(' ', $text);

    foreach ($originalKeywords as $originalKeyword) {
        $secondRoundKeywords = explode("'", $originalKeyword);

        foreach ($secondRoundKeywords as $secondRoundKeyword) {
            if (mb_strlen($secondRoundKeyword) >= $minChar) {
                if (!in_array($secondRoundKeyword, $keywords, true)) {
                    $keywords[] = trim($secondRoundKeyword);
                }
            }
        }
    }

    return $keywords;
}

function createMetaTags($title, $mymedia, $online, $minChar = 6)
{
    global $xoopsTpl, $xoopsModule, $xoopsModuleConfig;

    $myts = MyTextSanitizer::getInstance();

    $ret = '';

    $title = $myts->displayTarea($title);

    $title = $myts->undoHtmlSpecialChars(strip_tags($title));

    if (isset($mymedia)) {
        $mymedia = $myts->displayTarea(strip_tags($mymedia));

        $mymedia = $myts->undoHtmlSpecialChars($mymedia);
    }

    // Creating Meta Keywords

    if (isset($mymedia) && ('' != $title)) {
        $keywords = strip_tags($mymedia);

        $keywords = html_entity_decode($keywords);

        $keywords = $myts->undoHtmlSpecialChars($keywords);

        $keywords = eregi_replace('[[:punct:]]', ' ', $keywords);

        $keywords = eregi_replace('[[:digit:]]', ' ', $keywords);

        $keywords = str_replace('&nbsp;', '', $keywords);

        $keywords = str_replace('&euro', '', $keywords);

        $keywords = findKeyWordsInSting($keywords, $minChar);

        if (isset($xoopsModuleConfig) && isset($xoopsModuleConfig['moduleMetaKeywords']) && '' != $xoopsModuleConfig['moduleMetaKeywords']) {
            $moduleKeywords = explode(',', $xoopsModuleConfig['moduleMetaKeywords']);

            foreach ($moduleKeywords as $moduleKeyword) {
                if (!in_array($moduleKeyword, $keywords, true)) {
                    $keywords[] = trim($moduleKeyword);
                }
            }
        }

        $keywordsCount = count($keywords);

        for ($i = 0; $i < $keywordsCount; $i++) {
            $ret .= $keywords[$i];

            if ($i < $keywordsCount - 1) {
                $ret .= ', ';
            }
        }

        $xoopsTpl->assign('xoops_meta_keywords', $ret);
    }

    // Creating Meta Description

    if (isset($xoopsModuleConfig) && isset($xoopsModuleConfig['moduleMetaDescription']) && '' != $xoopsModuleConfig['moduleMetaDescription']) {
        $xoopsTpl->assign('xoops_meta_description', $xoopsModuleConfig['moduleMetaDescription']);
    }

    // Creating Page Title

    $moduleName = $myts->displayTarea($xoopsModule->name());

    if (isset($xoopsModule)) {
        $ret = '';

        if ($online) {
            $ret = $moduleName . ' : ';
        }

        if (isset($title) && ('' != $title) && (mb_strtoupper($title) != mb_strtoupper($moduleName))) {
            $ret .= $title;
        }

        $xoopsTpl->assign('xoops_myMediatitle', $ret);
    }
}

?>
