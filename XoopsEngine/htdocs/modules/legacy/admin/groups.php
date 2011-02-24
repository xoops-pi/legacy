<?php
function displayGroups()
{
    xoops_cp_header();
    //OpenTable();
    echo "<h4>"._AM_EDITADG."</h4>";
    $member_handler =& xoops_gethandler('member');
    $groups = $member_handler->getGroups();
    echo "<table class='outer' width='40%' cellpadding='4' cellspacing='1'><tr><th colspan='2'>"._AM_EDITADG."</th></tr>";
    $count = count($groups);
    for ($i = 0; $i < $count; $i++) {
        $id = $groups[$i]->getVar('groupid');
        echo '<tr><td class="head">'.$groups[$i]->getVar('name').'</td>';
        echo '<td class="even"><a href="group.php?op=modify&amp;g_id='.$id.'">'._AM_MODIFY.'</a>';
        if (XOOPS_GROUP_ADMIN == $id || XOOPS_GROUP_USERS == $id || XOOPS_GROUP_ANONYMOUS == $id) {
            echo '</td></tr>';
        } else {
            echo '&nbsp;<a href="group.php?op=del&amp;g_id='.$id.'">'._AM_DELETE.'</a></td></tr>';
        }
    }
    echo "</table>";
    $name_value = "";
    $desc_value = "";
    $s_cat_value = '';
    $a_mod_value = array();
    $r_mod_value = array();
    $r_block_value = array();
    $op_value = "add";
    $submit_value = _AM_CREATENEWADG;
    $g_id_value = "";
    $type_value = "";
    $form_title = _AM_CREATENEWADG;
    include __DIR__ . "/groupform.php";
    //CloseTable();
    xoops_cp_footer();
}

function modifyGroup($g_id)
{
    $userstart = $memstart = 0;
    if ( !empty($_POST['userstart']) ) {
        $userstart = intval($_POST['userstart']);
    } elseif (!empty($_GET['userstart'])) {
        $userstart = intval($_GET['userstart']);
    }
    if ( !empty($_POST['memstart']) ) {
        $memstart = intval($_POST['memstart']);
    } elseif (!empty($_GET['memstart'])) {
        $memstart = intval($_GET['memstart']);
    }
    xoops_cp_header();
    echo '<a href="group.php">'. _AM_GROUPSMAIN .'</a>&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;'. _AM_MODIFYADG.'<br /><br />';
    $member_handler =& xoops_gethandler('member');
    $thisgroup = $member_handler->getGroup($g_id);
    $name_value = $thisgroup->getVar("name", "E");
    $desc_value = $thisgroup->getVar("description", "E");
    /*
    $moduleperm_handler =& xoops_gethandler('groupperm');
    $a_mod_value = $moduleperm_handler->getItemIds('module_admin', $thisgroup->getVar('groupid'));
    $r_mod_value = $moduleperm_handler->getItemIds('module_read', $thisgroup->getVar('groupid'));

    $gperm_handler =& xoops_gethandler('groupperm');
    $r_block_value = $gperm_handler->getItemIds('block_read', $g_id);
    */
    $op_value = "update";
    $submit_value = _AM_UPDATEADG;
    $g_id_value = $thisgroup->getVar("groupid");
    $type_value = $thisgroup->getVar("group_type", "E");
    $form_title = _AM_MODIFYADG;
    /*
    if (XOOPS_GROUP_ADMIN == $g_id) {
        $s_cat_disable = true;
    }

    $sysperm_handler =& xoops_gethandler('groupperm');
    $s_cat_value = $sysperm_handler->getItemIds('system_admin', $g_id);
    */

    include __DIR__ . "/groupform.php";
    echo "<br /><h4>"._AM_EDITMEMBER."</h4>";
    $usercount = $member_handler->getUserCount(new Criteria('level', 0, '>'));
    $member_handler =& xoops_gethandler('member');
    $membercount = $member_handler->getUserCountByGroup($g_id);
    if ($usercount < 200 && $membercount < 200) {
        // do the old way only when counts are small
        $mlist = array();
        $members = $member_handler->getUsersByGroup($g_id, false);
        if (count($members) > 0) {
            $member_criteria = new Criteria('uid', "(".implode(',', $members).")", "IN");
            $member_criteria->setSort('uname');
            $mlist = $member_handler->getUserList($member_criteria);
        }
        $criteria = new Criteria('level', 0, '>');
        $criteria->setSort('uname');
        $userslist = $member_handler->getUserList($criteria);
        $users = array_diff($userslist, $mlist);
        echo '<table class="outer">
        <tr><th align="center">'._AM_NONMEMBERS.'<br />';

        echo '</th><th></th><th align="center">'._AM_MEMBERS.'<br />';
        echo '</th></tr>
        <tr><td class="even">
        <form action="group.php" method="post">
        <select name="uids[]" size="10" multiple="multiple">'."\n";
        foreach ($users as $u_id => $u_name) {
            echo '<option value="'.$u_id.'">'.$u_name.'</option>'."\n";
        }
        echo '</select>';
        echo "</td><td align='center' class='odd'>
        <input type='hidden' name='op' value='addUser' />
        <input type='hidden' name='fct' value='groups' />
        <input type='hidden' name='groupid' value='".$thisgroup->getVar("groupid")."' />
        <input type='submit' name='submit' value='"._AM_ADDBUTTON."' />
        </form><br />
        <form action='group.php' method='post' />
        <input type='hidden' name='op' value='delUser' />
        <input type='hidden' name='fct' value='groups' />
        <input type='hidden' name='groupid' value='".$thisgroup->getVar("groupid")."' />
        <input type='submit' name='submit' value='"._AM_DELBUTTON."' />
        </td>
        <td class='even'>";
        echo "<select name='uids[]' size='10' multiple='multiple'>";
        foreach ($mlist as $m_id => $m_name) {
            echo '<option value="'.$m_id.'">'.$m_name.'</option>'."\n";
        }
        echo "</select>";
        echo '</td></tr>
        </form>
        </table>';
    } else {
        $members = $member_handler->getUsersByGroup($g_id, false, 200, $memstart);
        $mlist = array();
        if (count($members) > 0) {
            $member_criteria = new Criteria('uid', "(".implode(',', $members).")", "IN");
            $member_criteria->setSort('uname');
            $mlist = $member_handler->getUserList($member_criteria);
        }
        echo '<a href="users.php?group='.$g_id.'">'._AM_FINDU4GROUP.'</a><br />';
        echo '<form action="group.php" method="post">
        <table class="outer">
        <tr><th align="center">'._AM_MEMBERS.'<br />';
        $nav = new XoopsPageNav($membercount, 200, $memstart, "memstart", "op=modify&amp;g_id=".$g_id);
        echo $nav->renderNav(4);
        echo "</th></tr>
        <tr><td class='even' align='center'>
        <input type='hidden' name='op' value='delUser' />
        <input type='hidden' name='groupid' value='".$thisgroup->getVar("groupid")."' />
        <input type='hidden' name='memstart' value='".$memstart."' />
        <select name='uids[]' size='10' multiple='multiple'>";
        foreach ($mlist as $m_id => $m_name ) {
            echo '<option value="'.$m_id.'">'.$m_name.'</option>'."\n";
        }
        echo "</select><br />
        <input type='submit' name='submit' value='"._DELETE."' />
        </td></tr>
        </table>
        </form>";
    }
    //CloseTable();
    xoops_cp_footer();
}