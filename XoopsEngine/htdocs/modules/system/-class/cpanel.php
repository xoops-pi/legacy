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
 * Xoops Cpanel class
 *
 * @copyright   The XOOPS Project http://sf.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package     system
 * @subpackage  class
 * @since       2.3.0
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @version     $Id: cpanel.php 2182 2008-09-26 13:02:56Z phppp $
 */

class XoopsSystemCpanel
{
    /**
     * Reference to GUI object
     */
    var $gui;

    //var $instance;

    function __construct()
    {
        $this->loadGui( @$GLOBALS["xoopsConfig"]["cpanel"] );
    }

    function XoopsSystemCpanel()
    {
        $this->__construct();
    }

    function &getInstance()
    {
        static $instance;
        global $xoopsConfig;

        if (!isset($instance)) {
            $class = __CLASS__;
            $instance =& new $class();
        }

        return $instance;
    }

    function loadGui($gui)
    {
        if (!empty($gui)) {
            $class = "XoopsGui" . ucfirst($gui);
            if (!class_exists($class)) {
                include dirname(__FILE__) . "/gui/{$gui}/{$gui}.php";
            }
            if (class_exists($class)) {
                if ( call_user_func( array($class, "validate") ) ) {
                    $this->gui =& new $class();
                }
            }
        }
        if (!isset($this->gui)) {
            include_once dirname(__FILE__) . "/gui/default/default.php";
            $this->gui =& new XoopsGuiDefault();
        }
    }

    function getGuis()
    {
        $guis = array();
        xoops_load("XoopsLists");
        $lists = XoopsLists::getDirListAsArray( dirname(__FILE__) . "/gui/" );
        foreach (array_keys($lists) as $gui) {
            if (@include_once dirname(__FILE__) . "/gui/{$gui}/{$gui}.php") {
                if ( class_exists( $class = "XoopsGui" . ucfirst($gui) ) ) {
                    if ( call_user_func( array($class, "validate") ) ) {
                        $guis[$gui] = $gui;
                    }
                }
            }
        }
        return $guis;
    }

    function flush()
    {
        $guis = XoopsSystemCpanel::getGuis();
        foreach ($guis as $gui) {
            include_once dirname(__FILE__) . "/gui/{$gui}/{$gui}.php";
            if ( class_exists( $class = "XoopsGui" . ucfirst($gui) ) ) {
                call_user_func( array($class, "flush") );
            }
        }
    }
}

?>