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
 * @subpackage      Resource
 * @version         $Id$
 */

class Legacy_Zend_Application_Resource_Translate extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $options = $this->getOptions();
        $bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('module');
        $bootstrap->bootstrap('config');

        $options['adapter'] = isset($options['adapter']) ? $options['adapter'] : 'legacy';
        $options['language'] = Xoops::config('language');
        $options['locale'] = Xoops::config('locale');

        $options['disableNotices'] = isset($options['disableNotices']) ? $options['disableNotices'] : true;
        $options['tag'] = isset($options['tag']) ? $options['tag'] : 'Xoops_Translate';
        $load = array();
        if (isset($options['load'])) {
            $load = $options['load'];
            unset($options['load']);
        }
        $moduleLoad = array();
        if (isset($options['module'])) {
            $moduleLoad = $options['module'];
            unset($options['module']);
        }

        $translate = Xoops::service('translate', $options);

        foreach ($load as $data => $loader) {
            $loader = is_array($loader) ?: array();
            $_options = !isset($loader['options']) ? array() : $loader['options'];
            $_locale = empty($loader['locale']) ? null : $loader['locale'];
            $translate->loadTranslation($data, "", $_locale, $_options);
        }

        if (!empty($GLOBALS['xoopsOption']['pagetype'])) {
            $translate->loadTranslation($GLOBALS['xoopsOption']['pagetype']);
        }

        $moduleInfo = Xoops::service('module')->loadInfo($GLOBALS['xoopsModule']->getVar('dirname'));
        $moduleTranslate = !empty($moduleInfo['translate'])
                            ? $moduleInfo['translate']
                            : ($moduleLoad ?: array());

        if (empty($moduleTranslate['data']) || "info" == $moduleTranslate['data']) {
            return;
        }
        XOOPS::service("translate")->loadTranslation($moduleTranslate['data'], $GLOBALS['xoopsModule']->getVar('dirname'));
    }
}