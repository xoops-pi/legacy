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
 * Inserts a view helper
 *
 * <b>Static call</b>:<br>
 *
 * <code>
 * <{helper helperName var1=val1 var2=val2}>
 * </code>
 *
 * <b>Dynamic call</b>:<br>
 *
 * <code>
 * // Call a view helper with a specified helper and variables
 * <{helper helperName var1=$val1 var2=val2}>
 * // Call a view helper with a helper variable and variables
 * <{helper $helperName var1=val1 var2=val2}>
 * <{helper helperName var1=val1 var2=$val2}>
 * </code>
 */
function smarty_compiler_helper($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = array();
    $data = explode(' ', $argStr, 2);
    $helperName = empty($data[0]) ? "default" : $data[0];
    // Parse to retreive the parameters
    if (!empty($data[1])) {
        $params = $compiler->_parse_attrs($data[1]);
    }

    // If the argStr contains no template variable, for static call
    if (strpos($argStr, "$") === false) {
        // Remove quotes
        $helperName = $compiler->_dequote($helperName);
        //Xoops_result($params);
        foreach ($params as $k => $v) {
            $params[$k] = $compiler->_dequote($v);
        }
        //Xoops_result($params);
        // load the helper
        $helper = XOOPS::registry('view')->getHelper($helperName);
        // call the helper method
        $content = call_user_func_array(
            array($helper, $helperName),
            $params
        );
        //return 'echo "' . addslashes($content) . '";';
        return '?>' . $content . '<?php';
    } else {
        $helperName = $compiler->_parse_var_props($helperName);
        $pars = array();
        foreach ($params as $k => $v) {
            $pars[] = var_export($k, true) . " => {$v}";
        }
        $str = "\$helper = XOOPS::registry('view')->getHelper(\$helperName);" . PHP_EOL;
        $str .= "echo call_user_func_array(" . PHP_EOL;
        $str .= "   array(\$helper, \$helperName)," . PHP_EOL;
        $str .= "   array(" . implode(", ", $pars) . ")" . PHP_EOL;
        $str .= ");" . PHP_EOL;        
        return $str;
    }
}
?>