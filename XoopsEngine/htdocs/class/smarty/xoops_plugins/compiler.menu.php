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
 * Inserts a named menu
 *
 * <code>
 * <{menu navigationName var1=val1 var2=val2 ...}>
 * </code>
 */
function smarty_compiler_menu($argStr, $compiler)
{
    global $xoops;

    $argStr = trim($argStr);
    $params = $compiler->_parse_attrs($argStr);
    if (empty($params["navigation"])) {
        return "";
    }
    foreach ($params as $k => &$v) {
        $v = $compiler->_dequote($v);
    }

    $view = XOOPS::registry("view");
    $module = XOOPS::registry("frontController")->getRequest()->getModuleName();
    $config = XOOPS::service("registry")->navigation->read($params["navigation"], $module);
    //XOOPS::loadClass('Xoops_Zend_Navigation');
    $container = new Xoops_Zend_Navigation($config);
    $view->navigation($container);
    $ulClass = empty($params["ulClass"]) ? 'jd_menu' : $params["ulClass"];
    $menu = $view->navigation()->menu()->setUlClass($ulClass)->render();
    
    //return 'echo "' . addslashes($menu) . '";';
    return '?>' . $menu . '<?php';

}
?>