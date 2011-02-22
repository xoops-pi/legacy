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
 * Inserts jQuery files
 *
 * <code>
 * <{jQuery file=[file1, file2, "$path/file3"]}>
 * </code>
 */
function Smarty_Compiler_JQuery($args, $compiler)
{
    $args = $compiler->_parse_attrs($args);
    $files = empty($args['file']) ? array() : explode('|', $compiler->_dequote($args['file']));
    array_unshift($files, 'jquery.min.js');

    //Debug::e(is_string($_attr["file"]));
    //Debug::e($params);
    $str = "XOOPS::registry(\"view\")->jQuery(array('";
    $str .= implode("', '", array_unique($files));
    $str .= "'))";
    return $str;
}