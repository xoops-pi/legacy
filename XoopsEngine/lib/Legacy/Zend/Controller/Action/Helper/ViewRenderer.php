<?PHP
/**
 * Zend Framework for Xoops Engine
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Xoops Engine http://www.xoopsengine.org
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @since           3.0
 * @category        Xoops_Zend
 * @package         Controller
 * @version         $Id$
 */

class Legacy_Zend_Controller_Action_Helper_ViewRenderer extends Xoops_Zend_Controller_Action_Helper_ViewRenderer
{
    /**
     * Get a view script based on an action and/or other variables
     *
     * Uses values found in current request if no values passed in $vars.
     *
     * If {@link $_noController} is set, uses {@link $_viewScriptPathNoControllerSpec};
     * otherwise, uses {@link $_viewScriptPathSpec}.
     *
     * @param  string $action
     * @param  array  $vars
     * @return string
     */
    public function getViewScript($action = null, array $vars = array())
    {
        if (!isset($this->viewScript)) {
            $vars['template'] = null;
            // Accept legacy content template
            if (!isset($vars['template']) && !empty($GLOBALS['xoopsOption']['template_main'])) {
                $template_main = $GLOBALS['xoopsOption']['template_main'];
                if (false == strpos($template_main, ":")) {
                    $template_main = 'db:' . $template_main;
                }
                $vars['template'] = $template_main;
            }

            // Accept custom template set in action
            if (!isset($vars['template']) && isset($this->template)) {
                $vars['template'] = $this->template;
            }

            $this->viewScript = $vars['template'] ?: "";
        }

        return $this->viewScript;
    }
}