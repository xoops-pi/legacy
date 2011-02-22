<?php
/**
 * Application resource
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
 * @package         Application
 * @subpackage      Resource
 * @version         $Id$
 */

class Legacy_Zend_Application_Resource_Db extends Zend_Application_Resource_ResourceAbstract
{
    const DEFAULT_REGISTRY_KEY = 'db';

    /**
     * Defined by Zend_Application_Resource_Resource
     *
     * @return Zend_Db_Adapter_Abstract|null
     */
    public function init()
    {
        $options = $this->getOptions();

        if (!isset($options['profiler']['class'])) {
            $options['profiler']['class'] = "Xoops_Zend_Db_Profiler";
        }
        if (!isset($options['profiler']['class'])) {
            $options['profiler']['class'] = "Xoops_Zend_Db_Profiler";
        }
        if (!isset($options['profiler']['enabled'])) {
            $options['profiler']['enabled'] = (XOOPS::config('environment') == "production") ? false : true;
        }
        if (empty($options['profiler']['enabled'])) {
            $options['profiler'] = false;
        }
        $db = Xoops_Zend_Db::factory($options['adapter'], $options);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Xoops_Zend_Db_Table::setDefaultMetadataCache(XOOPS::persist()->getHandler());

        //$options['prefix'] = $db->prefix(Xoops_Zend_Db::getPrefix('core'));
        $GLOBALS['xoopsDB'] = new Xoops_Zend_Db_Legacy($db, $options);
    }
}