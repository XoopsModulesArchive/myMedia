<?php

/**
 * Returns a module's option
 *
 * Return's a module's option
 *
 * @param string $option module option's name
 * @param mixed $repmodule
 * @author  Hervé Thouzard
 */
function myMedia_getmoduleoption($option, $repmodule = 'myMedia')
{
    global $xoopsModuleConfig, $xoopsModule;

    static $tbloptions = [];

    if (is_array($tbloptions) && array_key_exists($option, $tbloptions)) {
        return $tbloptions[$option];
    }

    $retval = false;

    if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
        if (isset($xoopsModuleConfig[$option])) {
            $retval = $xoopsModuleConfig[$option];
        }
    } else {
        $moduleHandler = xoops_getHandler('module');

        $module = $moduleHandler->getByDirname($repmodule);

        $configHandler = xoops_getHandler('config');

        if ($module) {
            $moduleConfig = $configHandler->getConfigsByCat(0, $module->getVar('mid'));

            if (isset($moduleConfig[$option])) {
                $retval = $moduleConfig[$option];
            }
        }
    }

    $tbloptions[$option] = $retval;

    return $retval;
} ?>
