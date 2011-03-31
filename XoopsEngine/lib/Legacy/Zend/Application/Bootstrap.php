<?php
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
 * @package         Application
 * @subpackage      Bootstrap
 * @version         $Id$
 */

class Legacy_Zend_Application_Bootstrap extends Xoops_Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Get the plugin loader for resources
     *
     * @return Zend_Loader_PluginLoader_Interface
     */
    public function getPluginLoader()
    {
        if ($this->_pluginLoader === null) {
            $options = array(
                'Zend_Application_Resource'         => XOOPS::path('lib') . '/Zend/Application/Resource',
                'Xoops_Zend_Application_Resource'   => XOOPS::path('lib') . '/Xoops/Zend/Application/Resource',
                'Legacy_Zend_Application_Resource'  => XOOPS::path('lib') . '/Legacy/Zend/Application/Resource',
            );

            $this->_pluginLoader = new Xoops_Zend_Loader_PluginLoader($options);
        }

        return $this->_pluginLoader;
    }

}