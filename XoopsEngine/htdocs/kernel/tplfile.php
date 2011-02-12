<?php
// $Id: tplfile.php 1217 2008-01-01 17:04:41Z phppp $
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
class XoopsTplfile extends XoopsObject
{

	function XoopsTplfile()
	{
		$this->XoopsObject();
		$this->initVar('tpl_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('tpl_refid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('tpl_tplset', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('tpl_file', XOBJ_DTYPE_TXTBOX, null, true, 100);
		$this->initVar('tpl_desc', XOBJ_DTYPE_TXTBOX, null, false, 100);
		$this->initVar('tpl_lastmodified', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('tpl_lastimported', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('tpl_module', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('tpl_type', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('tpl_source', XOBJ_DTYPE_SOURCE, null, false);
	}

	function getSource()
	{
		return $this->getVar('tpl_source');
	}

	function getLastModified()
	{
		return $this->getVar('tpl_lastmodified');
	}
}

/**
* XOOPS template file handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS template file class objects.
*
*
* @author  Kazumi Ono <onokazu@xoops.org>
*/

class XoopsTplfileHandler extends XoopsObjectHandler
{

    function &create($isNew = true)
    {
        $tplfile = new XoopsTplfile();
        if ($isNew) {
            $tplfile->setNew();
        }
        return $tplfile;
    }

    function &get($id, $getsource = false)
    {
        $tplfile = false;
    	$id = intval($id);
        if ($id > 0) {
            if (!$getsource) {
                $sql = 'SELECT * FROM '.$this->db->prefix('tplfile').' WHERE tpl_id='.$id;
            } else {
                $sql = 'SELECT f.*, s.tpl_source FROM '.$this->db->prefix('tplfile').' f LEFT JOIN '.$this->db->prefix('tplsource').' s  ON s.tpl_id=f.tpl_id WHERE f.tpl_id='.$id;
            }
            if (!$result = $this->db->query($sql)) {
                return $tplfile;
            }
            $numrows = $this->db->getRowsNum($result);
            if ($numrows == 1) {
                $tplfile = new XoopsTplfile();
                $tplfile->assignVars($this->db->fetchArray($result));
            }
        }
        return $tplfile;
    }

    function loadSource(&$tplfile)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($tplfile, 'xoopstplfile')) {
            return false;
        }

        if (!$tplfile->getVar('tpl_source')) {
            $sql = 'SELECT tpl_source FROM '.$this->db->prefix('tplsource').' WHERE tpl_id='.$tplfile->getVar('tpl_id');
            if (!$result = $this->db->query($sql)) {
                return false;
            }
            $myrow = $this->db->fetchArray($result);
            $tplfile->assignVar('tpl_source', $myrow['tpl_source']);
        }
		return true;
    }

    function insert(&$tplfile)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($tplfile, 'xoopstplfile')) {
            return false;
        }
        if (!$tplfile->isDirty()) {
            return true;
        }
        if (!$tplfile->cleanVars()) {
            return false;
        }
        foreach ($tplfile->cleanVars as $k => $v) {
            ${$k} = $v;
        }
        if ($tplfile->isNew()) {
            $tpl_id = $this->db->genId('tpltpl_file_id_seq');
            $sql = sprintf("INSERT INTO %s (tpl_id, tpl_module, tpl_refid, tpl_tplset, tpl_file, tpl_desc, tpl_lastmodified, tpl_lastimported, tpl_type) VALUES (%u, %s, %u, %s, %s, %s, %u, %u, %s)", $this->db->prefix('tplfile'), $tpl_id, $this->db->quoteString($tpl_module), $tpl_refid, $this->db->quoteString($tpl_tplset), $this->db->quoteString($tpl_file), $this->db->quoteString($tpl_desc), $tpl_lastmodified, $tpl_lastimported, $this->db->quoteString($tpl_type));
            if (!$result = $this->db->query($sql)) {
                return false;
            }
            if (empty($tpl_id)) {
                $tpl_id = $this->db->getInsertId();
            }
            if (isset($tpl_source) && $tpl_source != '') {
                $sql = sprintf("INSERT INTO %s (tpl_id, tpl_source) VALUES (%u, %s)", $this->db->prefix('tplsource'), $tpl_id, $this->db->quoteString($tpl_source));
                if (!$result = $this->db->query($sql)) {
                    $this->db->query(sprintf("DELETE FROM %s WHERE tpl_id = %u", $this->db->prefix('tplfile'), $tpl_id));
                    return false;
                }
            }
			$tplfile->assignVar('tpl_id', $tpl_id);
        } else {
            $sql = sprintf("UPDATE %s SET tpl_tplset = %s, tpl_file = %s, tpl_desc = %s, tpl_lastimported = %u, tpl_lastmodified = %u WHERE tpl_id = %u", $this->db->prefix('tplfile'), $this->db->quoteString($tpl_tplset), $this->db->quoteString($tpl_file), $this->db->quoteString($tpl_desc), $tpl_lastimported, $tpl_lastmodified, $tpl_id);
            if (!$result = $this->db->query($sql)) {
                return false;
            }
            if (isset($tpl_source) && $tpl_source != '') {
                $sql = sprintf("UPDATE %s SET tpl_source = %s WHERE tpl_id = %u", $this->db->prefix('tplsource'), $this->db->quoteString($tpl_source), $tpl_id);
                if (!$result = $this->db->query($sql)) {
                    return false;
                }
            }
        }
        return true;
    }

    function forceUpdate(&$tplfile)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($tplfile, 'xoopstplfile')) {
            return false;
        }
        if (!$tplfile->isDirty()) {
            return true;
        }
        if (!$tplfile->cleanVars()) {
            return false;
        }
        foreach ($tplfile->cleanVars as $k => $v) {
            ${$k} = $v;
        }
        if (!$tplfile->isNew()) {
            $sql = sprintf("UPDATE %s SET tpl_tplset = %s, tpl_file = %s, tpl_desc = %s, tpl_lastimported = %u, tpl_lastmodified = %u WHERE tpl_id = %u", $this->db->prefix('tplfile'), $this->db->quoteString($tpl_tplset), $this->db->quoteString($tpl_file), $this->db->quoteString($tpl_desc), $tpl_lastimported, $tpl_lastmodified, $tpl_id);
            if (!$result = $this->db->queryF($sql)) {
                return false;
            }
            if (isset($tpl_source) && $tpl_source != '') {
                $sql = sprintf("UPDATE %s SET tpl_source = %s WHERE tpl_id = %u", $this->db->prefix('tplsource'), $this->db->quoteString($tpl_source), $tpl_id);
                if (!$result = $this->db->queryF($sql)) {
                    return false;
                }
            }
			return true;
        } else {
			return false;
		}
    }

    function delete(&$tplfile)
    {
        /**
        * @TODO: Change to if (!(class_exists($this->className) && $obj instanceof $this->className)) when going fully PHP5
        */
        if (!is_a($tplfile, 'xoopstplfile')) {
            return false;
        }
        $id = $tplfile->getVar('tpl_id');
        $sql = sprintf("DELETE FROM %s WHERE tpl_id = %u", $this->db->prefix('tplfile'), $id);
        if (!$result = $this->db->query($sql)) {
            return false;
        }
        $sql = sprintf("DELETE FROM %s WHERE tpl_id = %u", $this->db->prefix('tplsource'), $id);
        $this->db->query($sql);
        return true;
    }

    function getObjects($criteria = null, $getsource = false, $id_as_key = false)
    {
        $ret = array();
        $limit = $start = 0;
        if ($getsource) {
            $sql = 'SELECT f.*, s.tpl_source FROM '.$this->db->prefix('tplfile').' f LEFT JOIN '.$this->db->prefix('tplsource').' s ON s.tpl_id=f.tpl_id';
        } else {
            $sql = 'SELECT * FROM '.$this->db->prefix('tplfile');
        }
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere().' ORDER BY tpl_refid';
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }
        while ($myrow = $this->db->fetchArray($result)) {
            $tplfile = new XoopsTplfile();
            $tplfile->assignVars($myrow);
            if (!$id_as_key) {
                $ret[] =& $tplfile;
            } else {
                $ret[$myrow['tpl_id']] =& $tplfile;
            }
            unset($tplfile);
        }
        return $ret;
    }

    function getCount($criteria = null)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->db->prefix('tplfile');
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere();
        }
        if (!$result =& $this->db->query($sql)) {
            return 0;
        }
        list($count) = $this->db->fetchRow($result);
        return $count;
    }

    function getModuleTplCount($tplset)
    {
        $ret = array();
        $sql = "SELECT tpl_module, COUNT(tpl_id) AS count FROM ".$this->db->prefix('tplfile')." WHERE tpl_tplset='".$tplset."' GROUP BY tpl_module";
        $result = $this->db->query($sql);
        if (!$result) {
            return $ret;
        }
        while ($myrow = $this->db->fetchArray($result)) {
            if ($myrow['tpl_module'] != '') {
                $ret[$myrow['tpl_module']] = $myrow['count'];
            }
        }
        return $ret;
    }

    function find($tplset = null, $type = null, $refid = null, $module = null, $file = null, $getsource = false)
    {
        $criteria = new CriteriaCompo();
        if (isset($tplset)) {
            $criteria->add(new Criteria('tpl_tplset', $tplset));
        }
        if (isset($module)) {
            $criteria->add(new Criteria('tpl_module', $module));
        }
        if (isset($refid)) {
            $criteria->add(new Criteria('tpl_refid', $refid));
        }
        if (isset($file)) {
            $criteria->add(new Criteria('tpl_file', $file));
        }
        if (isset($type)) {
            if (is_array($type)) {
                $criteria2 = new CriteriaCompo();
                foreach ($type as $t) {
                    $criteria2->add(new Criteria('tpl_type', $t), 'OR');
                }
                $criteria->add($criteria2);
            } else {
                $criteria->add(new Criteria('tpl_type', $type));
            }
        }
        return $this->getObjects($criteria, $getsource, false);
    }

    function templateExists($tplname, $tplset_name)
    {
        $criteria = new CriteriaCompo(new Criteria('tpl_file', trim($tplname)));
        $criteria->add(new Criteria('tpl_tplset', trim($tplset_name)));
        if ($this->getCount($criteria) > 0) {
            return true;
        }
        return false;
    }
}
?>