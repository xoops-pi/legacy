<?php

include "../../../include/cp_header.php";

//xoops_cp_header();

if ( !is_object($xoopsUser) || !is_object($xoopsModule) || !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
    //exit("Access Denied");
} else {
    include_once __DIR__ . "/groups.php";
    $op = "display";
    $op = isset($_GET['op']) ? $_GET['op'] : (isset($_POST['op']) ? $_POST['op'] : 'display');

    switch ($op) {
    case "modify":
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
        modifyGroup($_GET['g_id']);
        break;
    case "update":
        $member_handler =& xoops_gethandler('member');
        $group = $member_handler->getGroup($_POST['g_id']);
        $group->setVar('name', $_POST['name']);
        $group->setVar('description', $_POST['desc']);
        if (!$member_handler->insertGroup($group)) {
            xoops_cp_header();
            echo $group->getHtmlErrors();
            xoops_cp_footer();
        } else {
            redirect_header("group.php",1,_AM_DBUPDATED);
        }
        break;
    case "add":
        if (empty($_POST['name'])) {
            xoops_cp_header();
            echo _AM_UNEED2ENTER;
            xoops_cp_footer();
            exit();
        }
        $member_handler =& xoops_gethandler('member');
        $group =& $member_handler->createGroup();
        $group->setVar('name', $_POST['name']);
        $group->setVar('description', $_POST['desc']);
        if (!$member_handler->insertGroup($group)) {
            xoops_cp_header();
            echo $group->getHtmlErrors();
            xoops_cp_footer();
        } else {
            redirect_header("group.php",1,_AM_DBUPDATED);
        }
        break;
    case "del":
        xoops_cp_header();
        xoops_confirm(array('fct' => 'groups', 'op' => 'delConf', 'g_id' => $_GET['g_id']), 'group.php', _AM_AREUSUREDEL);
        xoops_cp_footer();
        break;
    case "delConf":
        $g_id = intval($_POST['g_id']);
        if (intval($g_id) > 0 && !in_array($g_id, array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS, XOOPS_GROUP_ANONYMOUS))) {
            $member_handler =& xoops_gethandler('member');
            $group = $member_handler->getGroup($g_id);
            $member_handler->deleteGroup($group);
            $gperm_handler =& xoops_gethandler('groupperm');
            $gperm_handler->deleteByGroup($g_id);
        }
        redirect_header("group.php",1,_AM_DBUPDATED);
        break;
    case "addUser":
        $groupid = intval($_POST['groupid']);
        $uids = $_POST['uids'];
        $member_handler = xoops_gethandler('member');
        $size = count($uids);
        for ( $i = 0; $i < $size; $i++ ) {
            $member_handler->addUserToGroup($groupid, $uids[$i]);
        }
        redirect_header("group.php?op=modify&amp;g_id=".$groupid."",0,_AM_DBUPDATED);
        break;
    case "delUser":
        $groupid = intval($_POST['groupid']);
        $memstart = isset($_POST['memstart']) ? intval($_POST['memstart']) : 0;
        if ($groupid > 0) {
            $member_handler =& xoops_gethandler('member');
            if ($groupid == XOOPS_GROUP_ADMIN) {
                if ($member_handler->getUserCountByGroup($groupid) > count($uids)){
                    $member_handler->removeUsersFromGroup($groupid, $uids);
                }
            } else {
                $member_handler->removeUsersFromGroup($groupid, $uids);
            }
            redirect_header('group.php?op=modify&amp;g_id='.$groupid.'&amp;memstart='.$memstart,0,_AM_DBUPDATED);
        }
        break;
    case "display":
        default:
        displayGroups();
        break;
    }
}
//xoops_cp_footer();
