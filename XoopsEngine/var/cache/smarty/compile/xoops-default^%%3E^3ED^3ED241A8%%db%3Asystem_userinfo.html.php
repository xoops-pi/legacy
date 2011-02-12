<?php /* Smarty version 2.6.22, created on 2011-02-12 15:41:31
         compiled from db:system_userinfo.html */ ?>
<?php if ($this->_tpl_vars['user_ownpage'] == true): ?>

<form name="usernav" action="user.php" method="post">

<br /><br />

<table width="70%" align="center" border="0">
  <tr align="center">
    <td><input type="button" value="<?php echo $this->_tpl_vars['lang_editprofile']; ?>
" onclick="location='edituser.php'" />
    <input type="button" value="<?php echo $this->_tpl_vars['lang_avatar']; ?>
" onclick="location='edituser.php?op=avatarform'" />
    <input type="button" value="<?php echo $this->_tpl_vars['lang_inbox']; ?>
" onclick="location='viewpmsg.php'" />

    <?php if ($this->_tpl_vars['user_candelete'] == true): ?>
    <input type="button" value="<?php echo $this->_tpl_vars['lang_deleteaccount']; ?>
" onclick="location='user.php?op=delete'" />
    <?php endif; ?>

    <input type="button" value="<?php echo $this->_tpl_vars['lang_logout']; ?>
" onclick="location='user.php?op=logout'" /></td>
  </tr>
</table>
</form>

<br /><br />
<?php elseif ($this->_tpl_vars['xoops_isadmin'] != false): ?>

<br /><br />

<table width="70%" align="center" border="0">
  <tr align="center">
    <td><input type="button" value="<?php echo $this->_tpl_vars['lang_editprofile']; ?>
" onclick="location='<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/system/admin.php?fct=users&amp;uid=<?php echo $this->_tpl_vars['user_uid']; ?>
&amp;op=modifyUser'" />
    <input type="button" value="<?php echo $this->_tpl_vars['lang_deleteaccount']; ?>
" onclick="location='<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/system/admin.php?fct=users&amp;op=delUser&amp;uid=<?php echo $this->_tpl_vars['user_uid']; ?>
'" />
  </tr>
</table>

<br /><br />
<?php endif; ?>

<table width="100%" border="0" cellspacing="5">
  <tr valign="top">
    <td width="50%">
      <table class="outer" cellpadding="4" cellspacing="1" width="100%">
        <tr>
          <th colspan="2" align="center"><?php echo $this->_tpl_vars['lang_allaboutuser']; ?>
</th>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_avatar']; ?>
</td>
          <td align="center" class="even"><img src="<?php echo $this->_tpl_vars['user_avatarurl']; ?>
" alt="Avatar" /></td>
        </tr>
        <tr>
          <td class="head"><?php echo $this->_tpl_vars['lang_realname']; ?>
</td>
          <td align="center" class="odd"><?php echo $this->_tpl_vars['user_realname']; ?>
</td>
        </tr>
        <tr>
          <td class="head"><?php echo $this->_tpl_vars['lang_website']; ?>
</td>
          <td class="even"><?php echo $this->_tpl_vars['user_websiteurl']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_email']; ?>
</td>
          <td class="odd"><?php echo $this->_tpl_vars['user_email']; ?>
</td>
        </tr>
        <?php if (! $this->_tpl_vars['user_ownpage'] == true): ?>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_privmsg']; ?>
</td>
          <td class="even"><?php echo $this->_tpl_vars['user_pmlink']; ?>
</td>
        </tr>
        <?php endif; ?>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_icq']; ?>
</td>
          <td class="odd"><?php echo $this->_tpl_vars['user_icq']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_aim']; ?>
</td>
          <td class="even"><?php echo $this->_tpl_vars['user_aim']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_yim']; ?>
</td>
          <td class="odd"><?php echo $this->_tpl_vars['user_yim']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_msnm']; ?>
</td>
          <td class="even"><?php echo $this->_tpl_vars['user_msnm']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_location']; ?>
</td>
          <td class="odd"><?php echo $this->_tpl_vars['user_location']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_occupation']; ?>
</td>
          <td class="even"><?php echo $this->_tpl_vars['user_occupation']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_interest']; ?>
</td>
          <td class="odd"><?php echo $this->_tpl_vars['user_interest']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_extrainfo']; ?>
</td>
          <td class="even"><?php echo $this->_tpl_vars['user_extrainfo']; ?>
</td>
        </tr>
      </table>
    </td>
    <td width="50%">
      <table class="outer" cellpadding="4" cellspacing="1" width="100%">
        <tr valign="top">
          <th colspan="2" align="center"><?php echo $this->_tpl_vars['lang_statistics']; ?>
</th>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_membersince']; ?>
</td>
          <td align="center" class="even"><?php echo $this->_tpl_vars['user_joindate']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_rank']; ?>
</td>
          <td align="center" class="odd"><?php echo $this->_tpl_vars['user_rankimage']; ?>
<br /><?php echo $this->_tpl_vars['user_ranktitle']; ?>
</td>
        </tr>
        <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_posts']; ?>
</td>
          <td align="center" class="even"><?php echo $this->_tpl_vars['user_posts']; ?>
</td>
        </tr>
    <tr valign="top">
          <td class="head"><?php echo $this->_tpl_vars['lang_lastlogin']; ?>
</td>
          <td align="center" class="odd"><?php echo $this->_tpl_vars['user_lastlogin']; ?>
</td>
        </tr>
      </table>
      <br />
      <table class="outer" cellpadding="4" cellspacing="1" width="100%">
        <tr valign="top">
          <th colspan="2" align="center"><?php echo $this->_tpl_vars['lang_signature']; ?>
</th>
        </tr>
        <tr valign="top">
          <td class="even"><?php echo $this->_tpl_vars['user_signature']; ?>
</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<!-- start module search results loop -->
<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>

<br style="clear: both;" />
<h4><?php echo $this->_tpl_vars['module']['name']; ?>
</h4>

  <!-- start results item loop -->
  <?php $_from = $this->_tpl_vars['module']['results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>

  <img src="<?php echo $this->_tpl_vars['result']['image']; ?>
" alt="<?php echo $this->_tpl_vars['module']['name']; ?>
" /><b><a href="<?php echo $this->_tpl_vars['result']['link']; ?>
" title="<?php echo $this->_tpl_vars['result']['title']; ?>
"><?php echo $this->_tpl_vars['result']['title']; ?>
</a></b><br /><small>(<?php echo $this->_tpl_vars['result']['time']; ?>
)</small><br />

  <?php endforeach; endif; unset($_from); ?>
  <!-- end results item loop -->

<?php echo $this->_tpl_vars['module']['showall_link']; ?>



<?php endforeach; endif; unset($_from); ?>
<!-- end module search results loop -->