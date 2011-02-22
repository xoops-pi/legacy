<?php
/**
 * XOOPS smarty resource plugin
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The Xoops Engine http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @since           3.0
 * @package         Xoops_Smarty
 * @version         $Id$
 */
 
/**
 * Smarty app resource handler
 * -------------------------------------------------------------
 */
function smarty_resource_app_source($tpl_name, &$tpl_source, &$smarty)
{
    if ($tplPath = smarty_resource_app_getpath($tpl_name, $smarty)) {
        if ($tpl_source = file_get_contents($tplPath)) {
            $smarty->realTemplatePath = $tplPath;
            return true;
        }
    }
    return false;
}

function smarty_resource_app_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    if ($tplPath = smarty_resource_app_getpath($tpl_name, $smarty)) {
        if ($tpl_timestamp = filemtime($tplPath)) {
            return true;
        }
    }
    return false;
}

function smarty_resource_app_secure($tpl_name, &$smarty)
{
    return true;
}

function smarty_resource_app_trusted($tpl_name, &$smarty)
{
    return false;
}

function smarty_resource_app_getpath($tpl_name, &$smarty)
{
    global $xoops;

    list($module, $template) = explode("/", $tpl_name, 2);
    $path = XOOPS::registry("view")->resourcePath("app/{$module}/templates/{$template}");
    return $xoops->path($path);
}



?>