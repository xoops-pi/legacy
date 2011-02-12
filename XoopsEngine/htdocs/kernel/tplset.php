<?php
// $Id: tplset.php 1217 2008-01-01 17:04:41Z phppp $
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
class XoopsTplset extends XoopsObject
{

	function XoopsTplset()
	{
		$this->XoopsObject();
		$this->initVar('tplset_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('tplset_name', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('tplset_desc', XOBJ_DTYPE_TXTBOX, null, false, 255);
		$this->initVar('tplset_credits', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('tplset_created', XOBJ_DTYPE_INT, 0, false);
	}
}

/**
* XOOPS tplset handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS tplset class objects.
*
*
* @author  Kazumi Ono <onokazu@xoops.org>
*/

class XoopsTplsetHandler extends XoopsObjectHandler
{

    function &create($isNew = true)
    {
        $tplset = new XoopsTplset();
        if ($isNew) {
            $tplset->setNew();
        }
        return $tplset;
    }

    function &get($id)
    {
        $tplset = false;
    	$id = intval($id);
        if ($id > 0) {
            $sql = 'SELECT * FROM '.$this->db->prefix('tplset').' WHERE tplset_id='.$id;
            if (!$result = $this->db->query($sql)) {
                return $tplset;
            }
            $numrows = $this->db->getRowsNum($result);
            if ($numrows == 1) {
                $tplset = new XoopsTplset();
                $tplset->assignVars($this->db->fetchArray($result));
            }
        }
        return $tplset;
    }

    function &getByName($tplset_name)
    {
        $tplset = false;
    	$tplset_name = trim($tplset_name);
        if ($tplset_name != '') {
            $sql = 'SELECT * FROM '.$this->db->prefix('tplset').' WHERE tplset_name='.$this->db->quoteString($tplset_name);
            if (!$result = $this->db->query($sql)) {
                return $tplset;
            }
            $numrows = $this->db->getRowsNum($result);
            if ($numrows == 1) {
                $tplset = new XoopsTplset();
                $tplset->assignVars($this->db->fetchArray($result));
            }
        }
        return $tplset;
    }

    function insert(&$tplset)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($tplset, 'xoopstplset')) {
            return false;
        }
        if (!$tplset->isDirty()) {
            return true;
        }
        if (!$tplset->cleanVars()) {
            return false;
        }
        foreach ($tplset->cleanVars as $k => $v) {
            ${$k} = $v;
        }
        if ($tplset->isNew()) {
            $tplset_id = $this->db->genId('tplset_tplset_id_seq');
            $sql = sprintf("INSERT INTO %s (tplset_id, tplset_name, tplset_desc, tplset_credits, tplset_created) VALUES (%u, %s, %s, %s, %u)", $this->db->prefix('tplset'), $tplset_id, $this->db->quoteString($tplset_name), $this->db->quoteString($tplset_desc), $this->db->quoteString($tplset_credits), $tplset_created);
        } else {
            $sql = sprintf("UPDATE %s SET tplset_name = %s, tplset_desc = %s, tplset_credits = %s, tplset_created = %u WHERE tplset_id = %u", $this->db->prefix('tplset'), $this->db->quoteString($tplset_name), $this->db->quoteString($tplset_desc), $this->db->quoteString($tplset_credits), $tplset_created, $tplset_id);
        }
        if (!$result = $this->db->query($sql)) {
            return false;
        }
        if (empty($tplset_id)) {
            $tplset_id = $this->db->getInsertId();
        }
		$tplset->assignVar('tplset_id', $tplset_id);
        return true;
    }

    function delete(&$tplset)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($tplset, 'xoopstplset')) {
            return false;
        }

        $sql = sprintf("DELETE FROM %s WHERE tplset_id = %u", $this->db->prefix('tplset'), $tplset->getVar('tplset_id'));
        if (!$result = $this->db->query($sql)) {
            return false;
        }
        $sql = sprintf("DELETE FROM %s WHERE tplset_name = %s", $this->db->prefix('imgset_tplset_link'), $this->db->quoteString($tplset->getVar('tplset_name')));
        $this->db->query($sql);
        return true;
    }

    function getObjects($criteria = null, $id_as_key = false)
    {
        $ret = array();
        $limit = $start = 0;
        $sql = 'SELECT * FROM '.$this->db->prefix('tplset');
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere().' ORDER BY tplset_id';
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }
        while ($myrow = $this->db->fetchArray($result)) {
            $tplset = new XoopsTplset();
            $tplset->assignVars($myrow);
            if (!$id_as_key) {
                $ret[] =& $tplset;
            } else {
                $ret[$myrow['tplset_id']] =& $tplset;
            }
            unset($tplset);
        }
        return $ret;
    }


    function getCount($criteria = null)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->db->prefix('tplset');
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere();
        }
        if (!$result =& $this->db->query($sql)) {
            return 0;
        }
        list($count) = $this->db->fetchRow($result);
        return $count;
    }

    function getList($criteria = null)
	{
        $ret = array();
		$tplsets = $this->getObjects($criteria, true);
		foreach (array_keys($tplsets) as $i) {
            $ret[$tplsets[$i]->getVar('tplset_name')] = $tplsets[$i]->getVar('tplset_name');
        }
		return $ret;
	}
}
?>