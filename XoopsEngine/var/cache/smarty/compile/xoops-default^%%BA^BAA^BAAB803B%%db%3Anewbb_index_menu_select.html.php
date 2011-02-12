<?php /* Smarty version 2.6.22, created on 2011-02-12 15:41:26
         compiled from db:newbb_index_menu_select.html */ ?>
	<select
		name="mainoption" id="mainoption"
		class="menu"
		onchange="if(this.options[this.selectedIndex].value.length >0 )	{ window.document.location=this.options[this.selectedIndex].value;}"
	>
		<option value=""><?php echo @_MD_MAINFORUMOPT; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['mark_read']; ?>
"><?php echo @_MD_MARK_ALL_FORUMS; ?>
&nbsp;<?php echo @_MD_MARK_READ; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['mark_unread']; ?>
"><?php echo @_MD_MARK_ALL_FORUMS; ?>
&nbsp;<?php echo @_MD_MARK_UNREAD; ?>
</option>
		<option value="">--------</option>
		<option value="<?php echo $this->_tpl_vars['post_link']; ?>
"><?php echo @_MD_VIEW; ?>
&nbsp;<?php echo @_MD_ALLPOSTS; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['newpost_link']; ?>
"><?php echo @_MD_VIEW; ?>
&nbsp;<?php echo @_MD_NEWPOSTS; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['all_link']; ?>
"><?php echo @_MD_VIEW; ?>
&nbsp;<?php echo @_MD_ALL; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['digest_link']; ?>
"><?php echo @_MD_VIEW; ?>
&nbsp;<?php echo @_MD_DIGEST; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['unreplied_link']; ?>
"><?php echo @_MD_VIEW; ?>
&nbsp;<?php echo @_MD_UNREPLIED; ?>
</option>
		<option value="<?php echo $this->_tpl_vars['unread_link']; ?>
"><?php echo @_MD_VIEW; ?>
&nbsp;<?php echo @_MD_UNREAD; ?>
</option>
		<option value="">--------</option>
		<?php if (count($this->_tpl_vars['menumode_other'])):
    foreach ($this->_tpl_vars['menumode_other'] as $this->_tpl_vars['menu']):
 ?>
		<option value="<?php echo $this->_tpl_vars['menu']['link']; ?>
"><?php echo $this->_tpl_vars['menu']['title']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_tpl_vars['forum_index_cpanel']): ?>
		<option value="">--------</option>
		<option value="<?php echo $this->_tpl_vars['forum_index_cpanel']['link']; ?>
"><?php echo $this->_tpl_vars['forum_index_cpanel']['name']; ?>
</option>
		<?php endif; ?>
	</select>