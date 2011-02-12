<?php
/**
 * XOOPS entry file
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @version     $Id: mainfile.dist.php 2634 2009-01-10 03:38:45Z phppp $
 */

if (!defined("XOOPS_MAINFILE_INCLUDED")) {
    define("XOOPS_MAINFILE_INCLUDED", 1);

    // Physical path to system library (readonly) directory WITHOUT trailing slash
    define('XOOPS_PATH', 'E:/wamp/www/xoops/xoops_lib');

    // Backend support for persistent data, valid values: apc, memcached, memcache
    define("XOOPS_PERSIST", "apc");

    include XOOPS_PATH . '/Xoops.php';
    return XOOPS::boot("perfect");
}