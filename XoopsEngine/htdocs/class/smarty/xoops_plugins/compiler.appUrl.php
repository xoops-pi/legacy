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
 * // Generate an URL using a route and variables
 * <{appUrl routeName var1=val1 var2=val2}>
 * // Generate an URL using default route and variables
 * <{appUrl '' var=val}>
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
 * // Generate an URL using a route and variables
 * <{appUrl routeName var1=$val1 var2=val2}>
 * // Generate an URL using variable route and variables
 * <{appUrl $route var=val}>
 * <{appUrl $route var=$val}>
 * </code>
 */
function smarty_compiler_appUrl($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = array();
    $data = explode(' ', $argStr, 2);
    $route = empty($data[0]) ? "default" : $data[0];
    // Parse to retreive the parameters
    if (!empty($data[1])) {
        $params = $compiler->_parse_attrs($data[1]);
    }

    // If the argStr contains no template variable, static URL section, thus build the url at compilation time
    if (strpos($argStr, "$") === false) {
        // Remove quotes
        $route = $compiler->_dequote($route);
        foreach ($params as $k => $v) {
            $params[$k] = $compiler->_dequote($v);
        }
        $url = XOOPS::registry('view')->url($params, $route);
        //return 'echo "' . addslashes($url) . '";';
        return '?>' . $url . '<?php';
    } else {
        $route = $compiler->_parse_var_props($route);
        $pars = array();
        foreach ($params as $k => $v) {
            $pars[] = var_export($k, true) . " => {$v}";
        }
        $str = "XOOPS::registry('view')->url(\n";
        $str .= "array(" . implode(", ", $pars) . ")\n";
        $str .= ", {$route})";
        return "echo {$str};";
    }
}
?>