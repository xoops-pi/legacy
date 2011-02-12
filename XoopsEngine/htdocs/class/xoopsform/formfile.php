<?php
// $Id: formfile.php 1217 2008-01-01 17:04:41Z phppp $
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
 * A file upload field
 * 
 * @author	Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 XOOPS.org
 * 
 * @package		kernel
 * @subpackage	form
 */
class XoopsFormFile extends XoopsFormElement {

	/**
     * Maximum size for an uploaded file
	 * @var	int	
	 * @access	private
	 */
	var $_maxFileSize;

	/**
	 * Constructor
	 * 
	 * @param	string	$caption		Caption
	 * @param	string	$name			"name" attribute
	 * @param	int		$maxfilesize	Maximum size for an uploaded file
	 */
	function XoopsFormFile($caption, $name, $maxfilesize) {
		$this->setCaption($caption);
		$this->setName($name);
		$this->_maxFileSize = intval($maxfilesize);
	}

	/**
	 * Get the maximum filesize
	 * 
	 * @return	int
	 */
	function getMaxFileSize() {
		return $this->_maxFileSize;
	}

	/**
	 * prepare HTML for output
	 * 
	 * @return	string	HTML
	 */
	function render() {
    	$ele_name = $this->getName();
		return "<input  " . ($this->getDisabled() ? "disabled " : "") . "type='hidden' name='MAX_FILE_SIZE' value='".$this->getMaxFileSize()."' /><input type='file' name='".$ele_name."' id='".$ele_name."'".$this->getExtra()." /><input type='hidden' name='xoops_upload_file[]' id='xoops_upload_file[]' value='".$ele_name."' />";
	}
}
?>