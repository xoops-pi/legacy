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
 * Inserts the URL of a file resource customizable by themes
 *
 * This plug-in works like the {@link smarty_compiler_appUrl() appUrl} plug-in,
 * except that it is intended to generate the URL of resource files customizable by
 * themes.
 *
 * Here the current theme is asked to check if a custom version of the requested file exists, and
 * if one is found its URL is returned. Otherwise, the request will be passed to the
 * theme parents one by one. Ultimately, if no custom version has been found, the resource
 * default URL location will be returned.
 *
 * <b>Note:</b> the themes inheritance system can generate many filesystem accesses depending
 * on your themes configuration. Because of this, the use of the dynamic syntax with this plug-in
 * is not possible right now.
 */
function smarty_compiler_resourceUrl($argStr, &$compiler)
{
    global $xoops;

    $argStr = trim($argStr);

    // If the argStr contains no template variable, static URL section, thus build the url at compilation time
    if (strpos($argStr, "$") === false) {
        $path = XOOPS::registry('view')->resourcePath($argStr);
        //return 'echo "' . addslashes($xoops->url($path)) . '";';
        return '?>' . $xoops->url($path) . '<?php';
    } else {
        $url = $compiler->_parse_var_props($argStr);
        $str = "\$GLOBALS['xoops']->url(XOOPS::registry('view')->resourcePath({$url}))";
        return "echo {$str};";
    }
}


?>