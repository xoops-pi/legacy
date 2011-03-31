<?php
/**
 * XOOPS SMARTY compiler
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
 * @package         Xoops_Smarty
 * @version         $Id$
 */

/**
 * Template compiling class
 */
require_once SMARTY_DIR . 'Smarty_Compiler.class.php';

class Legacy_Smarty_Compiler extends Smarty_Compiler
{
    public function insertNonCache($cacheAtttrs)
    {
        $id = md5(uniqid(__CLASS__));
        $type = 'xoopsNoCache';
        $this->_plugins[$type][$id] = array(null, null, null, null, false);
        $code = $this->_push_cacheable_state($type, $id)
                . $cacheAtttrs
                . $this->_pop_cacheable_state($type, $id);
        $this->_plugins[$type][$id] = null;

        return $code;
    }

}