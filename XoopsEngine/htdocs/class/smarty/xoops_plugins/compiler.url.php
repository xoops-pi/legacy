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
 * Inserts the URL of an application page
 *
 * This plug-in allows you to generate a module location URL. It uses any URL rewriting
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
 * // Generate an URL using a physical path (not recommended)
 * <{url /modules/something/yourpage.php vara=vala varb=valb}>
 * </code>
 *
 * <b>Dynamic address generation</b>:<br>
 * The is the slowest mode, and its use should be prevented unless necessary. Here,
 * the URL is generated dynamically each time the template is displayed, thus allowing
 * you to use the value of a template variable in the location string. To use it, you
 * must surround your location with double-quotes ("), and use the
 * {@link http://www.smarty.net/manual/en/language.syntax.quotes.php Smarty quoted strings}
 * syntax to insert variables values.
 *
 * <code>
 * // Use the value of the $sortby template variable in the URL
 * <{url "/modules/something/yourpage.php?order=`$sortby`"}>
 * // Generate an URL using smarty variables in parameters
 * <{url /modules/$xoops_dirname/yourpage.php vara=$vala varb=$valb}>
 * </code>
 */
function smarty_compiler_url($argStr, &$compiler)
{
    global $xoops;
    $argStr_string = trim($argStr);
    list($url, $params_string) = explode(' ', $argStr_string, 2);
    if (isset($params_string)) {
        $params = $compiler->_parse_attrs($params_string);
        foreach ($params as $k => $v) {
            $params[$k] = $compiler->_dequote($v);
        }
    }

    // If URL section contains no template variabl, static URL section, thus build the url at compilation time
    if (strpos($argStr, "$") === false) {
        // '.' expanded to current requested URI
        if ($url == '.') {
            $url = $_SERVER['REQUEST_URI'];
        } else {
            $url = $xoops->url($url);
        }
        // If parameters available, append them
        if (isset($params)) {
            $url = $xoops->buildUrl($url, $params);
        }
        //return 'echo "' . addslashes(htmlspecialchars($url)) . '";';
        return '?>' . htmlspecialchars($url) . '<?php';
    }

    // If URL section contains template variabls, expand them and introduce dynamic url builder for runtime
    $url = $compiler->_parse_var_props($url);
    $url = "\$GLOBALS['xoops']->url({$url})";

    if (isset($params)) {
        $pars = array();
        foreach ($params as $k => $v) {
            $pars[] = var_export($k, true) . " => {$v}";
        }
        $url = "\$GLOBALS['xoops']->buildUrl({$url}, ";
        $url .= "array(" . implode(", ", $pars) . "))";
    }
    return "echo $url;";
}

?>