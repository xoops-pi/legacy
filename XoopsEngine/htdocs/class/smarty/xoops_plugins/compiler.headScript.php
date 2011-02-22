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
 * Inserts a headScript element
 * @see @Zend_View_Helper_HeadScript
 *
 * <code>
 * <{headScript src='src' source='source' placement='append' type='text/javascript' defer=defer charset=utf-8 language=en-US}>
 * </code>
 */
function smarty_compiler_headScript($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = $compiler->_parse_attrs($argStr);
    if (empty($params['source']) && empty($params['src'])) return false;
    if (empty($params['source'])) {
        $mode = '"file"';
        $spec = $params['src'];
        unset($params['src']);
    } else {
        $mode = '"script"';
        $spec = $params['source'];
        unset($params['source']);
    }

    $placement = '"append"';
    if (!empty($params['placement'])) {
        $placement = $params['placement'];
        unset($params['placement']);
    }

    if (!empty($params['type'])) {
        $type = $params['type'];
        unset($params['type']);
    }

    $pars = array();
    foreach ($params as $k => $v) {
        $pars[] = var_export($k, true) . " => {$v}";
    }
    $str = "XOOPS::registry(\"view\")->headScript({$mode}, {$spec}, {$placement}";
    $str .= ", array(" . implode(", ", $pars) . ")";
    if (!empty($type)) {
        $str .= ", " . $type;
    }
    $str .= ");";

    return $compiler->insertNonCache($str);
}
?>