<?php
// $Id: formhiddentoken.php 1217 2008-01-01 17:04:41Z phppp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
if (!defined('XOOPS_ROOT_PATH')) {
    die("XOOPS root path not defined");
}
/**
 *
 * @author      Kazumi Ono  <onokazu@xoops.org>
 * @copyright   copyright (c) 2000-2005 XOOPS.org
 */
/**
 * A hidden token field
 *
 *
 * @author      Kazumi Ono  <onokazu@xoops.org>
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @copyright   copyright (c) 2000-2005 XOOPS.org
 */
class XoopsFormHiddenToken extends XoopsFormHidden {

    /**
     * Constructor
     *
     * @param   string  $name   "name" attribute
     */
    function XoopsFormHiddenToken($name = 'XOOPS_FORM_TOKEN', $timeout = 0)
    {
        //$this->XoopsFormHidden($name . '_REQUEST', $GLOBALS['xoopsSecurity']->createToken($timeout, $name));
        $name = $name ?: $this->form->getName();
        $token = isset($GLOBALS['xoopsSecurity']) ? $GLOBALS['xoopsSecurity']->createToken($timeout, $name) : "";
        //$token = $GLOBALS['xoopsSecurity']->createToken($timeout, $name);
        $this->XoopsFormHidden($name, $token);
    }
}