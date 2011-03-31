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

class Legacy_Zend_Application_Resource_Admin extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        global $xoopsUser, $member_handler;

        $member_handler = xoops_gethandler('member');
        $xoopsUser = $member_handler->getUser(1);
        $xoopsUser->setGroups(array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS));
    }
}