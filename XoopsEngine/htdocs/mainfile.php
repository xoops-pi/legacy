<?php
/**
 * XOOPS main configuration file
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


define("XOOPS_ENGINE", "legacy");

if (!defined('XOOPS_BOOTSTRAP')) {
    if (!isset($xoopsOption["nocommon"])) {
        define('XOOPS_BOOTSTRAP', 'legacy');
    } else {
        define('XOOPS_BOOTSTRAP', false);
    }
}

include __DIR__ . "/boot.php";
return;
