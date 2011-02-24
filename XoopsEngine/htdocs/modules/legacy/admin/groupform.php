<?php
// $Id: groupform.php 2067 2008-09-12 03:42:35Z phppp $
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

include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

$name_text = new XoopsFormText(_AM_NAME, "name", 30, 50, $name_value);
$desc_text = new XoopsFormTextArea(_AM_DESCRIPTION, "desc", $desc_value);
/*

$s_cat_checkbox = new XoopsFormCheckBox(_AM_SYSTEMRIGHTS, "system_catids[]", $s_cat_value);
$s_cat_checkbox->columns = 5;
include_once(XOOPS_ROOT_PATH.'/modules/system/constants.php');
require_once XOOPS_ROOT_PATH."/class/xoopslists.php";
$admin_dir = XOOPS_ROOT_PATH."/modules/system/admin/";
$dirlist = XoopsLists::getDirListAsArray($admin_dir);
foreach ($dirlist as $file) {
    include XOOPS_ROOT_PATH.'/modules/system/admin/'.$file.'/xoops_version.php';
    if (!empty($modversion['category'])) {
        $s_cat_checkbox->addOption($modversion['category'], $modversion['name']);
    }
    unset($modversion);
}
unset($dirlist);

$a_mod_checkbox = new XoopsFormCheckBox(_AM_ACTIVERIGHTS, "admin_mids[]", $a_mod_value);
$a_mod_checkbox->columns = 5;
$module_handler =& xoops_gethandler('module');
$criteria = new CriteriaCompo(new Criteria('hasadmin', 1));
$criteria->add(new Criteria('isactive', 1));
$criteria->add(new Criteria('dirname', 'system', '<>'));
$a_mod_checkbox->addOptionArray($module_handler->getList($criteria));

$r_mod_checkbox = new XoopsFormCheckBox(_AM_ACCESSRIGHTS, "read_mids[]", $r_mod_value);
$r_mod_checkbox->columns = 5;
$criteria = new CriteriaCompo(new Criteria('hasmain', 1));
$criteria->add(new Criteria('isactive', 1));
$r_mod_checkbox->addOptionArray($module_handler->getList($criteria));

$criteria = new CriteriaCompo(new Criteria('isactive', 1));
$criteria->setSort("mid");
$criteria->setOrder("ASC");
$module_list = $module_handler->getList($criteria);
$module_list[0] = _AM_CUSTOMBLOCK;

$block_handler = xoops_getHandler("block");
$blocks_obj = $block_handler->getObjects(new Criteria("mid", "('" . implode("', '", array_keys($module_list)) . "')", "IN"), true);

$blocks_module = array();
foreach (array_keys($blocks_obj) as $bid) {
    $title = $blocks_obj[$bid]->getVar("title");
    $blocks_module[$blocks_obj[$bid]->getVar('mid')][$blocks_obj[$bid]->getVar('bid')] = empty($title) ? $blocks_obj[$bid]->getVar("name") : $title;
}
ksort($blocks_module);

$r_block_tray = new XoopsFormElementTray(_AM_BLOCKRIGHTS, "<br /><br />");
foreach (array_keys($blocks_module) as $mid) {
    $new_blocks_array = array();
    foreach ($blocks_module[$mid] as $key => $value) {
        $new_blocks_array[$key] = "<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=blocksadmin&amp;op=edit&amp;bid={$key}' title='ID: {$key}' rel='external'>{$value}</a>";
    }
    $r_block_checkbox = new XoopsFormCheckBox('<strong>' . $module_list[$mid] . '</strong><br />', "read_bids[]", $r_block_value);
    $r_block_checkbox->columns = 5;
    $r_block_checkbox->addOptionArray($new_blocks_array);
    $r_block_tray->addElement($r_block_checkbox);
    unset($r_block_checkbox);
}

$fct_hidden = new XoopsFormHidden("fct", "groups");
*/
$op_hidden = new XoopsFormHidden("op", $op_value);
$submit_button = new XoopsFormButton("", "groupsubmit", $submit_value, "submit");
$form = new XoopsThemeForm($form_title, "groupform", "group.php", "post", true);
$form->addElement($name_text);
$form->addElement($desc_text);
$form->addElement($op_hidden);
/*
$form->addElement($s_cat_checkbox);
$form->addElement($a_mod_checkbox);
$form->addElement($r_mod_checkbox);
//$form->addElement($r_block_tray);
$form->addElement($fct_hidden);
*/
if ( !empty($g_id_value) ) {
    $g_id_hidden = new XoopsFormHidden("g_id", $g_id_value);
    $form->addElement($g_id_hidden);
}

$form->addElement($submit_button);
$form->setRequired($name_text);
$form->display();
?>