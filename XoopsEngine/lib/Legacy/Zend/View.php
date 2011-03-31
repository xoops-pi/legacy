<?php
/**
 * Legacy View
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
 * @package         Legacy_Core
 * @version         $Id$
 */

class Legacy_Zend_View extends Xoops_Zend_View
{
    protected $engineClass = 'Legacy_Smarty_Engine';

    /**
     * Layout theme
     * @var string
     */
    //protected $theme = 'legacy';
    protected $themeClass = 'Legacy_Theme';
    protected $themeEngine;

    /**
     * Return list of all assigned variables
     *
     * Returns all public properties of the object. Reflection is not used
     * here as testing reflection properties for visibility is buggy.
     *
     * @return array
     */
    public function getVars()
    {
        return $this->getEngine()->get_template_vars();
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via {@link assign()} or
     * property overloading ({@link __set()}).
     *
     * @return void
     */
    public function clearVars()
    {
        $this->getEngine()->clear_all_assign();
    }

    public function loadTheme($options = array())
    {
        if (!isset($this->themeEngine)) {
            $this->themeEngine = Xoops::registry('layout');
        }
        $this->themeEngine->setOptions($options);
        return $this->themeEngine;
    }

    /**
     * Includes the view script in a scope with only public $this variables.
     *
     * @param string The view script to execute.
     */
    protected function _run()
    {
        $template = func_get_arg(0);
        if (empty($template)) {
            return "";
        }

        return $this->getEngine()->display($template);
    }
}