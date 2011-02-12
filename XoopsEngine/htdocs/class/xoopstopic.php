<?php
// $Id: xoopstopic.php 2644 2009-01-10 06:34:29Z phppp $
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
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";

class XoopsTopic
{
    var $table;
    var $topic_id;
    var $topic_pid;
    var $topic_title;
    var $topic_imgurl;
    var $prefix; // only used in topic tree
    var $use_permission=false;
    var $mid; // module id used for setting permission

    function XoopsTopic($table, $topicid=0)
    {
        $this->db = $GLOBALS['xoopsDB'];
        $this->table = $table;
        if ( is_array($topicid) ) {
            $this->makeTopic($topicid);
        } elseif ( $topicid != 0 ) {
            $this->getTopic(intval($topicid));
        } else {
            $this->topic_id = $topicid;
        }
    }

    function setTopicTitle($value)
    {
        $this->topic_title = $value;
    }

    function setTopicImgurl($value)
    {
        $this->topic_imgurl = $value;
    }

    function setTopicPid($value)
    {
        $this->topic_pid = $value;
    }

    function getTopic($topicid)
    {
        $topicid = intval($topicid);
        $sql = "SELECT * FROM ".$this->table." WHERE topic_id=".$topicid."";
        $array = $this->db->fetchArray($this->db->query($sql));
        $this->makeTopic($array);
    }

    function makeTopic($array)
    {
        foreach($array as $key=>$value){
            $this->$key = $value;
        }
    }

    function usePermission($mid)
    {
        $this->mid = $mid;
        $this->use_permission = true;
    }

    function store()
    {
        $myts =& MyTextSanitizer::getInstance();
        $title = "";
        $imgurl = "";
        if ( isset($this->topic_title) && $this->topic_title != "" ) {
            $title = $myts->addSlashes($this->topic_title);
        }
        if ( isset($this->topic_imgurl) && $this->topic_imgurl != "" ) {
            $imgurl = $myts->addSlashes($this->topic_imgurl);
        }
        if ( !isset($this->topic_pid) || !is_numeric($this->topic_pid) ) {
            $this->topic_pid = 0;
        }
        if ( empty($this->topic_id) ) {
            $this->topic_id = $this->db->genId($this->table."_topic_id_seq");
            $sql = sprintf("INSERT INTO %s (topic_id, topic_pid, topic_imgurl, topic_title) VALUES (%u, %u, '%s', '%s')", $this->table, $this->topic_id, $this->topic_pid, $imgurl, $title);
        } else {
            $sql = sprintf("UPDATE %s SET topic_pid = %u, topic_imgurl = '%s', topic_title = '%s' WHERE topic_id = %u", $this->table, $this->topic_pid, $imgurl, $title, $this->topic_id);
        }
        if ( !$result = $this->db->query($sql) ) {
            ErrorHandler::show('0022');
        }
        if ( $this->use_permission == true ) {
            if ( empty($this->topic_id) ) {
                $this->topic_id = $this->db->getInsertId();
            }
            $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
            $parent_topics = $xt->getAllParentId($this->topic_id);
            if ( !empty($this->m_groups) && is_array($this->m_groups) ){
                foreach ( $this->m_groups as $m_g ) {
                    $moderate_topics = XoopsPerms::getPermitted($this->mid, "ModInTopic", $m_g);
                    $add = true;
                    // only grant this permission when the group has this permission in all parent topics of the created topic
                    foreach($parent_topics as $p_topic){
                        if ( !in_array($p_topic, $moderate_topics) ) {
                            $add = false;
                            continue;
                        }
                    }
                    if ( $add == true ) {
                        $xp = new XoopsPerms();
                        $xp->setModuleId($this->mid);
                        $xp->setName("ModInTopic");
                        $xp->setItemId($this->topic_id);
                        $xp->store();
                        $xp->addGroup($m_g);
                    }
                }
            }
            if ( !empty($this->s_groups) && is_array($this->s_groups) ){
                foreach ( $s_groups as $s_g ) {
                    $submit_topics = XoopsPerms::getPermitted($this->mid, "SubmitInTopic", $s_g);
                    $add = true;
                    foreach($parent_topics as $p_topic){
                        if ( !in_array($p_topic, $submit_topics) ) {
                            $add = false;
                            continue;
                        }
                    }
                    if ( $add == true ) {
                        $xp = new XoopsPerms();
                        $xp->setModuleId($this->mid);
                        $xp->setName("SubmitInTopic");
                        $xp->setItemId($this->topic_id);
                        $xp->store();
                        $xp->addGroup($s_g);
                    }
                }
            }
            if ( !empty($this->r_groups) && is_array($this->r_groups) ){
                foreach ( $r_groups as $r_g ) {
                    $read_topics = XoopsPerms::getPermitted($this->mid, "ReadInTopic", $r_g);
                    $add = true;
                    foreach($parent_topics as $p_topic){
                        if ( !in_array($p_topic, $read_topics) ) {
                            $add = false;
                            continue;
                        }
                    }
                    if ( $add == true ) {
                        $xp = new XoopsPerms();
                        $xp->setModuleId($this->mid);
                        $xp->setName("ReadInTopic");
                        $xp->setItemId($this->topic_id);
                        $xp->store();
                        $xp->addGroup($r_g);
                    }
                }
            }
        }
        return true;
    }

    function delete()
    {
        $sql = sprintf("DELETE FROM %s WHERE topic_id = %u", $this->table, $this->topic_id);
        $this->db->query($sql);
    }

    function topic_id()
    {
        return $this->topic_id;
    }

    function topic_pid()
    {
        return $this->topic_pid;
    }

    function topic_title($format="S")
    {
        $myts =& MyTextSanitizer::getInstance();
        switch($format){
            case "S":
            case "E":
                $title = $myts->htmlSpecialChars($this->topic_title);
                break;
            case "P":
            case "F":
                $title = $myts->htmlSpecialChars($myts->stripSlashesGPC($this->topic_title));
                break;
        }
        return $title;
    }

    function topic_imgurl($format="S")
    {
        $myts =& MyTextSanitizer::getInstance();
        switch($format){
            case "S":
            case "E":
                $imgurl = $myts->htmlSpecialChars($this->topic_imgurl);
                break;
            case "P":
            case "F":
                $imgurl = $myts->htmlSpecialChars($myts->stripSlashesGPC($this->topic_imgurl));
                break;
        }
        return $imgurl;
    }

    function prefix()
    {
        if ( isset($this->prefix) ) {
            return $this->prefix;
        }
    }

    function getFirstChildTopics()
    {
        $ret = array();
        $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
        $topic_arr = $xt->getFirstChild($this->topic_id, "topic_title");
        if ( is_array($topic_arr) && count($topic_arr) ) {
            foreach($topic_arr as $topic){
                $ret[] = new XoopsTopic($this->table, $topic);
            }
        }
        return $ret;
    }

    function getAllChildTopics()
    {
        $ret = array();
        $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
        $topic_arr = $xt->getAllChild($this->topic_id, "topic_title");
        if ( is_array($topic_arr) && count($topic_arr) ) {
            foreach($topic_arr as $topic){
                $ret[] = new XoopsTopic($this->table, $topic);
            }
        }
        return $ret;
    }

    function getChildTopicsTreeArray()
    {
        $ret = array();
        $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
        $topic_arr = $xt->getChildTreeArray($this->topic_id, "topic_title");
        if ( is_array($topic_arr) && count($topic_arr) ) {
            foreach($topic_arr as $topic){
                $ret[] = new XoopsTopic($this->table, $topic);
            }
        }
        return $ret;
    }

    function makeTopicSelBox($none=0, $seltopic=-1, $selname="", $onchange="")
    {
        $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
        if ( $seltopic != -1 ) {
            $xt->makeMySelBox("topic_title", "topic_title", $seltopic, $none, $selname, $onchange);
        } elseif ( !empty($this->topic_id) ) {
            $xt->makeMySelBox("topic_title", "topic_title", $this->topic_id, $none, $selname, $onchange);
        } else {
            $xt->makeMySelBox("topic_title", "topic_title", 0, $none, $selname, $onchange);
        }
    }

    //generates nicely formatted linked path from the root id to a given id
    function getNiceTopicPathFromId($funcURL)
    {
        $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
        $ret = $xt->getNicePathFromId($this->topic_id, "topic_title", $funcURL);
        return $ret;
    }

    function getAllChildTopicsId()
    {
        $xt = new XoopsTree($this->table, "topic_id", "topic_pid");
        $ret = $xt->getAllChildId($this->topic_id, "topic_title");
        return $ret;
    }

    function getTopicsList()
    {
        $result = $this->db->query('SELECT topic_id, topic_pid, topic_title FROM '.$this->table);
        $ret = array();
        $myts =& MyTextSanitizer::getInstance();
        while ($myrow = $this->db->fetchArray($result)) {
            $ret[$myrow['topic_id']] = array('title' => $myts->htmlspecialchars($myrow['topic_title']), 'pid' => $myrow['topic_pid']);
        }
        return $ret;
    }

    function topicExists($pid, $title) {
        $sql = "SELECT COUNT(*) from ".$this->table." WHERE topic_pid = ".intval($pid)." AND topic_title = '".trim($title)."'";
        $rs = $this->db->query($sql);
        list($count) = $this->db->fetchRow($rs);
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>