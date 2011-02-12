<?php
// $Id: formbutton.php 1786 2008-05-28 09:56:27Z phppp $
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
 *
 * @package     kernel
 * @subpackage  form
 *
 * @author	    Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 XOOPS.org
 */
/**
 * A button
 *
 * @author	Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 XOOPS.org
 *
 * @package     kernel
 * @subpackage  form
 */
class XoopsFormButton extends XoopsFormElement
{

	/**
     * Value
	 * @var	string
	 * @access	private
	 */
	var $_value;

	/**
     * Type of the button. This could be either "button", "submit", or "reset"
	 * @var	string
	 * @access	private
	 */
	var $_type;

	/**
	 * Constructor
     *
	 * @param	string  $caption    Caption
     * @param	string  $name
     * @param	string  $value
     * @param	string  $type       Type of the button. Potential values: "button", "submit", or "reset"
	 */
	function XoopsFormButton($caption, $name, $value = "", $type = "button")
	{
		$this->setCaption($caption);
		$this->setName($name);
		$this->_type = $type;
		$this->setValue($value);
	}

	/**
	 * Get the initial value
	 *
	 * @param	bool    $encode To sanitizer the text?
     * @return	string
	 */
	function getValue($encode = false)
	{
		return $encode ? htmlspecialchars($this->_value, ENT_QUOTES) : $this->_value;
	}

	/**
	 * Set the initial value
	 *
     * @return	string
	 */
	function setValue($value)
	{
		$this->_value = $value;
	}

	/**
	 * Get the type
	 *
     * @return	string
	 */
	function getType()
	{
		return in_array( strtolower($this->_type), array("button", "submit", "reset") ) ? $this->_type : "button";
	}

	/**
	 * prepare HTML for output
	 *
     * @return	string
	 */
	function render()
	{
		return "<input " . ($this->getDisabled() ? "disabled " : "") . "type='" . $this->getType() . "' class='formButton' name='" . $this->getName() . "'  id='" . $this->getName() . "' value='" . $this->getValue() . "' title='" . $this->getValue() . "'" . $this->getExtra() . " />";
	}
}
?>