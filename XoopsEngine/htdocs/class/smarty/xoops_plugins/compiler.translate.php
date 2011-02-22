<?php
/**
 * XOOPS smarty compiler plugin
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
 * Load locale translation
 *
 *
 * <b>Static address generation</b>:<br>
 *
 * <code>
 * // Load local translation
 * <{translation file[ domain:key]}>
 * // Load global translation
 * <{translation file global}>
 * </code>
 *
 * <b>Dynamic loading</b>:<br>
 *
 * <code>
 * <{translation $file domain:key}>
 * <{translation $file $domain:$key}>
 * </code>
 */


function smarty_compiler_translate($argStr, $compiler)
{
    $argStr = trim($argStr);
    $segs = explode(' ', $argStr);
    $path = $segs[0];
    if (!empty($segs[1])) {
        $domain = $segs[1];
    } else {
        $domain = "theme:" . XOOPS::registry("view")->getTheme();
    }
    
    if (strpos($domain, "$") === false) {
        $domain = $compiler->_dequote($domain);
        $path = $compiler->_dequote($path);
        XOOPS::registry('translate')->loadTranslation($path, $domain);
        return "";
    } else {
        $domain = $compiler->_parse_var_props($domain);
        $path = $compiler->_parse_var_props($path);
        $str = "XOOPS::registry('translate')->loadTranslation({$domain}, {$path})";
        return "echo {$str};";
    }
}