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
 * Inserts the URL of a locale resource
 *
 * This plug-in allows you to generate an application URL. It uses any URL rewriting
 * mechanism and rules you'll have configured for the system.
 *
 * To ensure this can be as optimized as possible, it accepts 2 modes of operation:
 *
 * <b>Static address generation</b>:<br>
 * This is the default mode and fastest mode. When used, the URL is generated during
 * the template compilation, and statically written in the compiled template file.
 * To use it, you just need to provide a location in a format XOOPS understands.
 *
 * <code>
 * // Generate a locale URL mapping a domain resoruce
 * <{localeUrl path[ domain:key]}>
 * // Generate a locale URL mapping a globale resoruce
 * <{localeUrl path global}>
 * </code>
 *
 * <b>Dynamic address generation</b>:<br>
 * The is the slowest mode, and its use should be prevented unless necessary. Here,
 * the URL is generated dynamically each time the template is displayed, thus allowing
 * you to use the value of a template variable in the location string. To use it, you
 * must surround your location with double-quotes ("), and use the
 * {@link http://smarty.php.net/manual/en/language.syntax.quotes.php Smarty quoted strings}
 * syntax to insert variables values.
 *
 * <code>
 * // Generate a locale URL mapping a domain resoruce with variable path
 * <{localeUrl $path domain:key}>
 * // Generate a locale URL mapping a variable domain resoruce with path
 * <{localeUrl $path $domain:$key}>
 * </code>
 */
function smarty_compiler_localeUrl($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    //list($domain, $path) = explode(' ', $argStr, 2);
    $segs = explode(' ', $argStr);
    $path = $segs[0];
    if (!empty($segs[1])) {
        $domain = $segs[1];
    } else {
        $domain = "theme:" . XOOPS::registry("view")->getTheme();
    }
    
    // If the argStr contains no template variable, static URL section, thus build the url at compilation time
    if (strpos($domain, "$") === false) {
        // Remove quotes
        $domain = $compiler->_dequote($domain);
        if (!$url = XOOPS::localeUrl($domain)) {
            return false;
        }
        $path = $compiler->_dequote($path);
        $url .= "/" . $path;
        //return 'echo "' . addslashes($url) . '";';
        return '?>' . $url . '<?php';
    } else {
        $domain = $compiler->_parse_var_props($domain);
        $path = $compiler->_parse_var_props($path);
        $str = "XOOPS::localeUrl({$domain}, {$path})";
        return "echo {$str};";
    }
}
?>