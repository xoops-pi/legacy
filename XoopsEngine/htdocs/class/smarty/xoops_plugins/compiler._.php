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
 * Inserts a gettext translation
 *
 * <code>
 * // Generate a static translation
 * <{_ This is a test}>
 * // Generate a dynamic translation
 * <{_ $xo_message}>
 * </code>
 */
function smarty_compiler__($argStr, $compiler)
{
    global $xoops;

    $message = trim($argStr);

    // static
    if (false && strpos($message, "$") === false) {
        // Remove quotes
        $message = $compiler->_dequote($message);
        $translation = XOOPS::_($message);
        return 'echo "' . addslashes($translation) . '";';
    } else {
        $message = $compiler->_parse_var_props($message);
        $str = "XOOPS::_($message)";
        return "echo {$str};";
    }
}
?>