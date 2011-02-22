<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code 
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Xoops Cpanel GUI interface class
 *
 * @copyright   The XOOPS project http://sf.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package     system
 * @subpackage  class
 * @since       2.3.0
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @version     $Id: gui.php 1459 2008-04-18 10:26:53Z phppp $
 */

class XoopsSystemGui
{
    /**
     * Reference to template object
     */
    var $template;
    
    /**
     * Holding navigation
     */
    var $navigation;

    function header() {}
    function footer() {}
    function validate() {}
    function flush() {}

    function getInstance() 
    {
        static $instance;
        global $xoopsConfig;
        
        if (!isset($instance)) {
            $class = __CLASS__;
            $instance = new $class();
        }
        
        return $instance;
    }
}

?>