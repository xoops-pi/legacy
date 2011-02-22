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
 * Inserts a widget
 *
 * <code>
 * <{widget blockName var1=val1 var2=val2}>
 * </code>
 */
function smarty_compiler_widget($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $data = explode(' ', $argStr, 2);
    $blockName = $data[0];
    // Parse to retreive the parameters
    $params = array();
    if (!empty($data[1])) {
        $params = $compiler->_parse_attrs($data[1]);
    }

    // If the argStr contains no template variable, static URL section, thus build the url at compilation time
    if (strpos($argStr, "$") === false) {
        // Remove quotes
        $blockName = $compiler->_dequote($blockName);
        foreach ($params as $k => $v) {
            $params[$k] = $compiler->_dequote($v);
        }
        $content = XOOPS::registry('view')->Widget($blockName, $params);
        //return empty($content) ? '' : 'echo "' . addslashes($content) . '";';
        return empty($content) ? '' : '?>' . $content . '<?php';
    } else {
        $blockName = $compiler->_parse_var_props($blockName);
        $pars = array();
        foreach ($params as $k => $v) {
            $pars[] = var_export($k, true) . " => {$v}";
        }
        $str = "echo XOOPS::registry(\"view\")->Widget({$blockName}, ";
        $str .= "array(" . implode(", ", $pars) . "));";
        return $str;
    }

}
?>