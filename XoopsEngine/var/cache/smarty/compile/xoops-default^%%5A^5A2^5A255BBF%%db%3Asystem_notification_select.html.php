<?php /* Smarty version 2.6.22, created on 2011-02-12 15:41:26
         compiled from db:system_notification_select.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'db:system_notification_select.html', 20, false),)), $this); ?>
<?php if ($this->_tpl_vars['xoops_notification']['show']): ?>
<form name="notification_select" action="<?php echo $this->_tpl_vars['xoops_notification']['target_page']; ?>
" method="post">
<h4 style="text-align:center;"><?php echo $this->_tpl_vars['lang_activenotifications']; ?>
</h4>
<input type="hidden" name="not_redirect" value="<?php echo $this->_tpl_vars['xoops_notification']['redirect_script']; ?>
" />
<input type="hidden" name="XOOPS_TOKEN_REQUEST" value="<?php echo $GLOBALS['xoopsSecurity']->createToken(); ?>" />
<table class="outer">
  <tr><th colspan="3"><?php echo $this->_tpl_vars['lang_notificationoptions']; ?>
</th></tr>
  <tr>
    <td class="head"><?php echo $this->_tpl_vars['lang_category']; ?>
</td>
    <td class="head"><input name="allbox" id="allbox" onclick="xoopsCheckAll('notification_select','allbox');" type="checkbox" value="<?php echo $this->_tpl_vars['lang_checkall']; ?>
" /></td>
    <td class="head"><?php echo $this->_tpl_vars['lang_events']; ?>
</td>
  </tr>
  <?php $_from = $this->_tpl_vars['xoops_notification']['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['outer']['iteration']++;
?>
  <?php $_from = $this->_tpl_vars['category']['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['inner'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['inner']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['event']):
        $this->_foreach['inner']['iteration']++;
?>
  <tr>
    <?php if (($this->_foreach['inner']['iteration'] <= 1)): ?>
    <td class="even" rowspan="<?php echo $this->_foreach['inner']['total']; ?>
"><?php echo $this->_tpl_vars['category']['title']; ?>
</td>
    <?php endif; ?>
    <td class="odd">
    <?php echo smarty_function_counter(array('assign' => 'index'), $this);?>

    <input type="hidden" name="not_list[<?php echo $this->_tpl_vars['index']; ?>
][params]" value="<?php echo $this->_tpl_vars['category']['name']; ?>
,<?php echo $this->_tpl_vars['category']['itemid']; ?>
,<?php echo $this->_tpl_vars['event']['name']; ?>
" />
    <input type="checkbox" id="not_list[]" name="not_list[<?php echo $this->_tpl_vars['index']; ?>
][status]" value="1" <?php if ($this->_tpl_vars['event']['subscribed']): ?>checked="checked"<?php endif; ?> />
    </td>
    <td class="odd"><?php echo $this->_tpl_vars['event']['caption']; ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
  <?php endforeach; endif; unset($_from); ?>
  <tr>
    <td class="foot" colspan="3" align="center"><input type="submit" name="not_submit" value="<?php echo $this->_tpl_vars['lang_updatenow']; ?>
" /></td>
  </tr>
</table>
<div align="center">
<?php echo $this->_tpl_vars['lang_notificationmethodis']; ?>
:&nbsp;<?php echo $this->_tpl_vars['user_method']; ?>
&nbsp;&nbsp;[<a href="<?php echo $this->_tpl_vars['editprofile_url']; ?>
" title="<?php echo $this->_tpl_vars['lang_change']; ?>
"><?php echo $this->_tpl_vars['lang_change']; ?>
</a>]
</div>
</form>
<?php endif; ?>