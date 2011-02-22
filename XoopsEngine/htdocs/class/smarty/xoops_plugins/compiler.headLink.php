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
 * Inserts a headLink element
 * @see @Zend_View_Helper_HeadLink
 *
 * <code>
 * <{headLink href='href' extras='extras'}>
 * <{headLink href='href' rel='stylesheet' extras='extras'}>
 * <{headLink href='href' rel='alternate' extras='extras'}>
 * </code>
 */
function smarty_compiler_headLink($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = $compiler->_parse_attrs($argStr);
    if (empty($params['href'])) return false;

    if (empty($params['rel'])) {
        $params['rel'] = '"stylesheet"';
        $params['type'] = '"text/css"';
    }

    $placement = '"append"';
    if (!empty($params['placement'])) {
        $placement = $params['placement'];
        unset($params['placement']);
    }

    $pars = array();
    foreach ($params as $k => $v) {
        $pars[] = var_export($k, true) . " => {$v}";
    }
    $str = "XOOPS::registry(\"view\")->headLink(array(" . implode(", ", $pars) . "), {$placement});";

    return $compiler->insertNonCache($str);
}
?>