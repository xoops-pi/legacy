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
 * Inserts a headMeta element
 * @see @Zend_View_Helper_HeadMeta
 *
 * <code>
 * <{headMeta key=keywords content="xoops, zend, meta" type=name lang=en scheme=test}>
 * </code>
 */
function smarty_compiler_headMeta($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = $compiler->_parse_attrs($argStr);
    if (empty($params['content'])) return false;
    $str = "XOOPS::registry(\"view\")->headMeta(";
    $str .= $params['content'];
    unset($params['content']);
    if (!empty($params['key'])) {
        $str .= ", " . $params['key'];
        unset($params['key']);
    } else {
        $str .= ", null";
    }
    if (!empty($params['type'])) {
        $str .= ", " . $params['type'];
        unset($params['type']);
    } else {
        $str .= ", 'name'";
    }
    if (!empty($params['placement'])) {
        $placement = $params['placement'];
        unset($params['placement']);
    }
    $pars = array();
    foreach ($params as $k => $v) {
        $pars[] = var_export($k, true) . " => {$v}";
    }
    $str .= ", array(" . implode(", ", $pars) . ")";
    if (!empty($placement)) {
        $str .= ", " . $placement;
    }
    $str .= ")";

    return $compiler->insertNonCache("{$str};");
}
?>