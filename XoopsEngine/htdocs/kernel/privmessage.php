<?php
// $Id: privmessage.php 1370 2008-03-04 03:09:58Z phppp $
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
	exit();
}
/**
 * {description}
 *
 * @package		kernel
 *
 * @author		Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 The XOOPS Project (http://www.xoops.org)
 *
 * @version		$Id: privmessage.php 1370 2008-03-04 03:09:58Z phppp $
 */
class XoopsPrivmessage extends XoopsObject
{

/**
 * constructor
 **/
    function XoopsPrivmessage()
    {
        $this->XoopsObject();
        $this->initVar('msg_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('msg_image', XOBJ_DTYPE_OTHER, 'icon1.gif', false, 100);
        $this->initVar('subject', XOBJ_DTYPE_TXTBOX, null, true, 255);
        $this->initVar('from_userid', XOBJ_DTYPE_INT, null, true);
        $this->initVar('to_userid', XOBJ_DTYPE_INT, null, true);
        $this->initVar('msg_time', XOBJ_DTYPE_OTHER, null, false);
        $this->initVar('msg_text', XOBJ_DTYPE_TXTAREA, null, true);
        $this->initVar('read_msg', XOBJ_DTYPE_INT, 0, false);
    }
}

/**
 * XOOPS private message handler class.
 *
 * This class is responsible for providing data access mechanisms to the data source
 * of XOOPS private message class objects.
 *
 * @package		kernel
 *
 * @author		Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 The XOOPS Project (http://www.xoops.org)
 *
 * @version		$Revision: 1217 $ - $Date: 2008-01-02 01:04:41 +0800 (星期三, 02 一月 2008) $
 */
class XoopsPrivmessageHandler extends XoopsObjectHandler
{

/**
 * Create a new {@link XoopsPrivmessage} object
 * @param 	bool 	$isNew 	Flag as "new"?
 * @return 	object
 **/
    function &create($isNew = true)
    {
        $pm = new XoopsPrivmessage();
        if ($isNew) {
            $pm->setNew();
        }
        return $pm;
    }

/**
 * Load a {@link XoopsPrivmessage} object
 * @param 	int 	$id ID of the message
 * @return 	object
 **/
    function &get($id)
    {
        $pm = false;
    	$id = intval($id);
        if ($id > 0) {
            $sql = 'SELECT * FROM '.$this->db->prefix('priv_msgs').' WHERE msg_id='.$id;
            if (!$result = $this->db->query($sql)) {
                return $pm;
            }
            $numrows = $this->db->getRowsNum($result);
            if ($numrows == 1) {
                $pm = new XoopsPrivmessage();
                $pm->assignVars($this->db->fetchArray($result));
            }
        }
        return $pm;
    }

/**
 * Insert a message in the database
 *
 * @param 	object 	$pm		{@link XoopsPrivmessage} object
 * @param 	bool 	$force 	flag to force the query execution skip request method check, which might be required in some situations
 * @return 	bool
 **/
    function insert(&$pm, $force = false)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($pm, 'xoopsprivmessage')) {
            return false;
        }

        if (!$pm->isDirty()) {
            return true;
        }
        if (!$pm->cleanVars()) {
            return false;
        }
        foreach ($pm->cleanVars as $k => $v) {
            ${$k} = $v;
        }
        if ($pm->isNew()) {
            $msg_id = $this->db->genId('priv_msgs_msg_id_seq');
            $sql = sprintf("INSERT INTO %s (msg_id, msg_image, subject, from_userid, to_userid, msg_time, msg_text, read_msg) VALUES (%u, %s, %s, %u, %u, %u, %s, %u)", $this->db->prefix('priv_msgs'), $msg_id, $this->db->quoteString($msg_image), $this->db->quoteString($subject), $from_userid, $to_userid, time(), $this->db->quoteString($msg_text), 0);
        } else {
            $sql = sprintf("UPDATE %s SET msg_image = %s, subject = %s, from_userid = %u, to_userid = %u, msg_text = %s, read_msg = %u WHERE msg_id = %u", $this->db->prefix('priv_msgs'), $this->db->quoteString($msg_image), $this->db->quoteString($subject), $from_userid, $to_userid, $this->db->quoteString($msg_text), $read_msg, $msg_id);
        }
        $queryFunc = empty($force)?"query":"queryF";
		if (!$result = $this->db->{$queryFunc}($sql)) {
			return false;
		}
        if (empty($msg_id)) {
            $msg_id = $this->db->getInsertId();
        }
		$pm->assignVar('msg_id', $msg_id);
        return true;
    }

/**
 * Delete from the database
 * @param 	object 	$pm 	{@link XoopsPrivmessage} object
 * @return 	bool
 **/
    function delete(&$pm)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($pm, 'xoopsprivmessage')) {
            return false;
        }

        if (!$result = $this->db->query(sprintf("DELETE FROM %s WHERE msg_id = %u", $this->db->prefix('priv_msgs'), $pm->getVar('msg_id')))) {
            return false;
        }
        return true;
    }

/**
 * Load messages from the database
 * @param 	object 	$criteria 	{@link CriteriaElement} object
 * @param 	bool 	$id_as_key 	use ID as key into the array?
 * @return 	array	Array of {@link XoopsPrivmessage} objects
 **/
    function getObjects($criteria = null, $id_as_key = false)
    {
        $ret = array();
        $limit = $start = 0;
        $sql = 'SELECT * FROM '.$this->db->prefix('priv_msgs');
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere();
            $sort = !in_array($criteria->getSort(), array('msg_id', 'msg_time', 'from_userid')) ? 'msg_id' : $criteria->getSort();
            $sql .= ' ORDER BY '.$sort.' '.$criteria->getOrder();
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }
        while ($myrow = $this->db->fetchArray($result)) {
            $pm = new XoopsPrivmessage();
            $pm->assignVars($myrow);
			if (!$id_as_key) {
            	$ret[] =& $pm;
			} else {
				$ret[$myrow['msg_id']] =& $pm;
			}
            unset($pm);
        }
        return $ret;
    }

/**
 * Count message
 * @param 	object 	$criteria = null 	{@link CriteriaElement} object
 * @return 	int
 **/
    function getCount($criteria = null)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->db->prefix('priv_msgs');
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere();
        }
        if (!$result = $this->db->query($sql)) {
            return 0;
        }
        list($count) = $this->db->fetchRow($result);
        return $count;
    }

/**
 * Mark a message as read
 * @param 	object 	$pm 	{@link XoopsPrivmessage} object
 * @return 	bool
 **/
    function setRead(&$pm)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($pm, 'xoopsprivmessage')) {
            return false;
        }

		$sql = sprintf("UPDATE %s SET read_msg = 1 WHERE msg_id = %u", $this->db->prefix('priv_msgs'), $pm->getVar('msg_id'));
        if (!$this->db->queryF($sql)) {
            return false;
        }
        return true;
    }
}
?>