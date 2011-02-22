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
 * Inserts a headStyle element
 * @see @Zend_View_Helper_HeadStyle
 *
 * <code>
 * <{headStyle content=$content placement=append media=screen title='for test'}>
 * </code>
 */
function smarty_compiler_headStyle($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = $compiler->_parse_attrs($argStr);
    if (empty($params['content'])) return false;

    $content = $params['content'];
    unset($params['content']);

    $placement = '"append"';
    if (!empty($params['placement'])) {
        $placement = $params['placement'];
        unset($params['placement']);
    }

    $pars = array();
    foreach ($params as $k => $v) {
        $pars[] = var_export($k, true) . " => {$v}";
    }
    $str = "XOOPS::registry(\"view\")->headStyle({$content}, {$placement}, array(" . implode(", ", $pars) . "));";

    return $compiler->insertNonCache($str);
}
?>