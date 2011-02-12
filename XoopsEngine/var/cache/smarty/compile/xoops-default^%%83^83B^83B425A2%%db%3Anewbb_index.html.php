<?php /* Smarty version 2.6.22, created on 2011-02-12 15:41:26
         compiled from db:newbb_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'db:newbb_index.html', 38, false),)), $this); ?>
<table class="index_header" cellspacing="0" width="100%">
<tr>
	<td valign="middle">
		<div style="float: left; text-align: left;">
			<h2><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/"><?php echo $this->_tpl_vars['index_title']; ?>
</a></h2>
		</div>
		<div style="float: right; text-align: right;">
			<?php echo $this->_tpl_vars['index_desc']; ?>

		</div>
	</td>
</tr>
<?php if ($this->_tpl_vars['userstats']): ?>
<tr>
	<td>
		<!-- current time; user's last visit; user's last post -->
		<div style="float: left; text-align: left;">
			<?php echo $this->_tpl_vars['userstats']['currenttime']; ?>
 | <?php echo $this->_tpl_vars['userstats']['lastvisit']; ?>
 | <?php echo $this->_tpl_vars['userstats']['lastpost']; ?>

		</div>
		<!-- user's topics; user's posts; user's digests -->
		<div style="float: right; text-align: right;">
			<?php echo $this->_tpl_vars['userstats']['topics']; ?>
 | <?php echo $this->_tpl_vars['userstats']['posts']; ?>
 <?php if ($this->_tpl_vars['userstats']['digests']): ?>| <?php echo $this->_tpl_vars['userstats']['digests']; ?>
<?php endif; ?>
		</div>
	</td>
</tr>
<?php endif; ?>
<tr>
	<td>
		<!-- total topics; total posts; total digests -->
		<div style="float: left; text-align: left;">
			<?php echo @_MD_TOTALTOPICSC; ?>
<strong><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/list.topic.php" title="<?php echo @_MD_ALL; ?>
"><?php echo $this->_tpl_vars['stats'][0]['topic']['total']; ?>
</a></strong>
		 	| <?php echo @_MD_TOTALPOSTSC; ?>
<strong><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php" title="<?php echo @_MD_ALLPOSTS; ?>
"><?php echo $this->_tpl_vars['stats'][0]['post']['total']; ?>
</a></strong>
			<?php if ($this->_tpl_vars['stats'][0]['digest']['total']): ?>
				| <?php echo @_MD_TOTALDIGESTSC; ?>
<strong><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/list.topic.php?status=digest" title="<?php echo @_MD_TOTALDIGESTSC; ?>
"><?php echo $this->_tpl_vars['stats'][0]['digest']['total']; ?>
</a></strong>
			<?php endif; ?>
		</div>
		<!-- today topics; today posts; -->
		<div style="float: right; text-align: right;">
		 	<?php echo @_MD_TODAYTOPICSC; ?>
<strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['stats'][0]['topic']['day'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</strong>
		 	| <?php echo @_MD_TODAYPOSTSC; ?>
<strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['stats'][0]['post']['day'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</strong>
		 	| <a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=new" title="<?php echo @_MD_VIEW_NEWPOSTS; ?>
"><?php echo @_MD_VIEW_NEWPOSTS; ?>
</a>
		</div>
	</td>
</tr>
<?php if ($this->_tpl_vars['viewer_level'] > 1): ?>
<tr>
	<td>
	<div style="float: left; text-align: left;">
		<?php echo @_MD_TOPIC; ?>
: 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=active#admin" target="_self" title="<?php echo @_MD_TYPE_ADMIN; ?>
"><?php echo @_MD_TYPE_ADMIN; ?>
</a> | 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=pending#admin" target="_self" title="<?php echo @_MD_TYPE_PENDING; ?>
"><?php echo @_MD_TYPE_PENDING; ?>
</a> | 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=deleted#admin" target="_self" title="<?php echo @_MD_TYPE_DELETED; ?>
"><?php echo @_MD_TYPE_DELETED; ?>
</a>
	</div>
	
	<div style="float: right; text-align: right;">
		<?php echo @_MD_POST2; ?>
: 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=active#admin" target="_self" title="<?php echo @_MD_TYPE_ADMIN; ?>
"><?php echo @_MD_TYPE_ADMIN; ?>
</a> | 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=pending#admin" target="_self" title="<?php echo @_MD_TYPE_PENDING; ?>
"><?php echo @_MD_TYPE_PENDING; ?>
</a> | 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=deleted#admin" target="_self" title="<?php echo @_MD_TYPE_DELETED; ?>
"><?php echo @_MD_TYPE_DELETED; ?>
</a>
	</div>
	
	<br />
	<div style="float: right; text-align: right;">
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/moderate.php" target="_self" title="<?php echo @_MD_TYPE_SUSPEND; ?>
"><?php echo @_MD_TYPE_SUSPEND; ?>
</a> | 
		<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/admin/index.php" target="_self" title="<?php echo @_MD_ADMINCP; ?>
"><?php echo @_MD_ADMINCP; ?>
</a>
	</div>
	</td>
</tr>
<?php endif; ?>

</table>

<!--
<div id="index_welcome">
	<div class="title"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/"><?php echo $this->_tpl_vars['index_title']; ?>
</a></div>
	<?php if ($this->_tpl_vars['index_desc']): ?>
		<div class="desc"><?php echo $this->_tpl_vars['index_desc']; ?>
</div>
	<?php endif; ?>
	<div class="visit left">
		<?php echo $this->_tpl_vars['lang_currenttime']; ?>
 | <?php echo $this->_tpl_vars['lang_lastvisit']; ?>

	</div>
	<div class="visit right">
		<?php if ($this->_tpl_vars['stats'][0]['digest']['total']): ?>
			<strong><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=digest" title="<?php echo @_MD_TOTALDIGESTSC; ?>
"><?php echo @_MD_TOTALDIGESTSC; ?>
<?php echo $this->_tpl_vars['stats'][0]['digest']['total']; ?>
</a></strong> | 
		<?php endif; ?>
		<?php echo @_MD_TOTALTOPICSC; ?>
<strong><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php" title="<?php echo @_MD_ALL; ?>
"><?php echo $this->_tpl_vars['stats'][0]['topic']['total']; ?>
</a></strong>
		 | <?php echo @_MD_TOTALPOSTSC; ?>
<strong><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php" title="<?php echo @_MD_ALLPOSTS; ?>
"><?php echo $this->_tpl_vars['stats'][0]['post']['total']; ?>
</a></strong>
		 | <?php echo @_MD_TODAYTOPICSC; ?>
<strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['stats'][0]['topic']['day'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</strong>
		 | <?php echo @_MD_TODAYPOSTSC; ?>
<strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['stats'][0]['post']['day'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</strong>
	</div>
</div>
<div class="clear"></div>

<?php if ($this->_tpl_vars['viewer_level'] > 1): ?>
	<div class="right" style="padding: 5px;">
	
	<?php echo @_MD_TOPIC; ?>
: 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=active#admin" target="_self" title="<?php echo @_MD_TYPE_ADMIN; ?>
"><?php echo @_MD_TYPE_ADMIN; ?>
</a> | 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=pending#admin" target="_self" title="<?php echo @_MD_TYPE_PENDING; ?>
"><?php echo @_MD_TYPE_PENDING; ?>
</a> | 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewall.php?status=deleted#admin" target="_self" title="<?php echo @_MD_TYPE_DELETED; ?>
"><?php echo @_MD_TYPE_DELETED; ?>
</a>
	<br style="clear:both;" /> 
	
	<?php echo @_MD_POST2; ?>
: 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=active#admin" target="_self" title="<?php echo @_MD_TYPE_ADMIN; ?>
"><?php echo @_MD_TYPE_ADMIN; ?>
</a> | 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=pending#admin" target="_self" title="<?php echo @_MD_TYPE_PENDING; ?>
"><?php echo @_MD_TYPE_PENDING; ?>
</a> | 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewpost.php?status=deleted#admin" target="_self" title="<?php echo @_MD_TYPE_DELETED; ?>
"><?php echo @_MD_TYPE_DELETED; ?>
</a>
	<br style="clear:both;" /> 
	
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/moderate.php" target="_self" title="<?php echo @_MD_TYPE_SUSPEND; ?>
"><?php echo @_MD_TYPE_SUSPEND; ?>
</a> | 
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/admin/index.php" target="_self" title="<?php echo @_MD_ADMINCP; ?>
"><?php echo @_MD_ADMINCP; ?>
</a>
	
	</div>
	<br />
	<div class="clear"></div>
<?php endif; ?>

<div class="dropdown">
<?php if ($this->_tpl_vars['menumode'] == 0): ?>
	<?php $this->_smarty_include(array('smarty_include_tpl_file' => "db:newbb_index_menu_select.html", 'smarty_include_vars' => array()));
 ?>
<?php elseif ($this->_tpl_vars['menumode'] == 1): ?>
	<?php $this->_smarty_include(array('smarty_include_tpl_file' => "db:newbb_index_menu_hover.html", 'smarty_include_vars' => array()));
 ?>
<?php elseif ($this->_tpl_vars['menumode'] == 2): ?>
	<?php $this->_smarty_include(array('smarty_include_tpl_file' => "db:newbb_index_menu_click.html", 'smarty_include_vars' => array()));
 ?>
<?php endif; ?>
</div>
<div class="clear"></div>
<br />
-->

<!-- start forum categories -->
<?php if (count($this->_tpl_vars['categories'])):
    foreach ($this->_tpl_vars['categories'] as $this->_tpl_vars['category']):
 ?>
<table class="index_category" cellspacing="0" width="100%">
    <tr class="head">
		<td width="3%" valign="middle" align="center"><img onclick="ToggleBlockCategory('<?php echo $this->_tpl_vars['category']['cat_element_id']; ?>
', this, '<?php echo $this->_tpl_vars['category_icon']['expand']; ?>
', '<?php echo $this->_tpl_vars['category_icon']['collapse']; ?>
')" src="<?php echo $this->_tpl_vars['category']['cat_icon_display']; ?>
" alt="" /></td>
		<?php if ($this->_tpl_vars['category']['cat_image']): ?>
		<td width="8%"><img src="<?php echo $this->_tpl_vars['category']['cat_image']; ?>
" alt="<?php echo $this->_tpl_vars['category']['cat_title']; ?>
" /></td>
		<?php endif; ?>
		<td align="left">
			<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/index.php?cat=<?php echo $this->_tpl_vars['category']['cat_id']; ?>
"><?php echo $this->_tpl_vars['category']['cat_title']; ?>
</a>
			<?php if ($this->_tpl_vars['category']['cat_description']): ?><p class="desc"><?php echo $this->_tpl_vars['category']['cat_description']; ?>
</p><?php endif; ?>
		</td>
		<?php if ($this->_tpl_vars['category']['cat_sponsor']): ?>
		<td width="15%" nowrap="nowrap" align="right">
		<p class="desc"><a href="<?php echo $this->_tpl_vars['category']['cat_sponsor']['link']; ?>
" title="<?php echo $this->_tpl_vars['category']['cat_sponsor']['title']; ?>
" target="_blank"><?php echo $this->_tpl_vars['category']['cat_sponsor']['title']; ?>
</a></p>
		</td>
		<?php endif; ?>
    </tr>
</table>

<div id="<?php echo $this->_tpl_vars['category']['cat_element_id']; ?>
" style="display: <?php echo $this->_tpl_vars['category']['cat_display']; ?>
">
<table cellspacing="1" width="100%">
<?php if ($this->_tpl_vars['category']['forums']): ?>
    <tr class="head" align="center">
		<td width="5%">&nbsp;</td>
		<?php if ($this->_tpl_vars['subforum_display'] == 'expand'): ?>
		<td colspan="2" width="57%" nowrap="nowrap" align="left"><?php echo @_MD_FORUM; ?>
</td>
		<?php else: ?>
		<td width="57%" nowrap="nowrap" align="left"><?php echo @_MD_FORUM; ?>
</td>
		<?php endif; ?>
		<td width="9%" nowrap="nowrap"><?php echo @_MD_TOPICS; ?>
</td>
		<td width="9%" nowrap="nowrap"><?php echo @_MD_POSTS; ?>
</td>
		<td width="20%" nowrap="nowrap"><?php echo @_MD_LASTPOST; ?>
</td>
    </tr>
<?php endif; ?>

<!-- start forums -->

<?php if ($this->_tpl_vars['subforum_display'] == 'expand'): ?>

<?php if (count($this->_tpl_vars['category']['forums'])):
    foreach ($this->_tpl_vars['category']['forums'] as $this->_tpl_vars['forum']):
 ?>
    <tr>
      <td class="even" align="center" valign="middle"><?php echo $this->_tpl_vars['forum']['forum_folder']; ?>
</td>
      <td colspan="2" class="odd">
		<div id="index_forum">
	      	<span class="item"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewforum.php?forum=<?php echo $this->_tpl_vars['forum']['forum_id']; ?>
"><?php echo $this->_tpl_vars['forum']['forum_name']; ?>
</a>
	      	<?php if ($this->_tpl_vars['rss_enable']): ?>
			(<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/rss.php?f=<?php echo $this->_tpl_vars['forum']['forum_id']; ?>
" target="_blank" title="RSS feed">RSS</a>)
			<?php endif; ?>
	      	<br /><?php echo $this->_tpl_vars['forum']['forum_desc']; ?>

	      	</span>
			<?php if ($this->_tpl_vars['forum']['forum_moderators']): ?>
			<span class="extra">
        	<?php echo @_MD_MODERATOR; ?>
: <?php echo $this->_tpl_vars['forum']['forum_moderators']; ?>

        	</span>
        	<?php endif; ?>
        </div>
      </td>
      <td class="even" align="center" valign="middle">
      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['topic']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['topic']['day']; ?>
</strong>/<?php endif; ?>
      	<?php echo $this->_tpl_vars['forum']['forum_topics']; ?>

      </td>
      <td class="odd" align="center" valign="middle">
      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['post']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['post']['day']; ?>
</strong>/<?php endif; ?>
      	<?php echo $this->_tpl_vars['forum']['forum_posts']; ?>

      </td>
      <td class="even" align="right" valign="middle"><?php echo $this->_tpl_vars['forum']['forum_lastpost_time']; ?>
 <br />
			<?php echo $this->_tpl_vars['forum']['forum_lastpost_user']; ?>

	      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
">
		    <img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/images/subject/<?php echo $this->_tpl_vars['forum']['forum_lastpost_icon']; ?>
" alt="" />
		    </a>
	      	<?php if ($this->_tpl_vars['forum']['forum_lastpost_subject']): ?>
				<br /> 
		      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
">
		      	<?php echo $this->_tpl_vars['forum']['forum_lastpost_subject']; ?>

		      	</a>
	      	<?php endif; ?>
	  </td>
    </tr>
<?php if ($this->_tpl_vars['forum']['subforum']): ?>
    <tr class="head" >
      <td width="5%">&nbsp;</td>
      <td width="5%" align="center"><?php echo $this->_tpl_vars['img_subforum']; ?>
&nbsp;</td>
      <td colspan="4" nowrap="nowrap" align="left"><?php echo @_MD_SUBFORUMS; ?>
</td>
    </tr>
<?php if (count($this->_tpl_vars['forum']['subforum'])):
    foreach ($this->_tpl_vars['forum']['subforum'] as $this->_tpl_vars['subforum']):
 ?>
    <tr>
      <td class="odd" width="5%">&nbsp;</td>
      <td class="even" align="center" valign="middle" width="5%"><?php echo $this->_tpl_vars['subforum']['forum_folder']; ?>
</td>
      <td width="52%" class="odd">
		<div id="index_forum">
	      	<span class="item"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewforum.php?forum=<?php echo $this->_tpl_vars['subforum']['forum_id']; ?>
"><strong><?php echo $this->_tpl_vars['subforum']['forum_name']; ?>
</strong></a>
	      	<?php if ($this->_tpl_vars['rss_enable']): ?>
			(<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/rss.php?f=<?php echo $this->_tpl_vars['subforum']['forum_id']; ?>
" target="_blank" title="RSS feed">RSS</a>)
			<?php endif; ?>
	      	<br /><?php echo $this->_tpl_vars['subforum']['forum_desc']; ?>

	      	</span>
			<?php if ($this->_tpl_vars['subforum']['forum_moderators']): ?>
			<span class="extra">
        	<?php echo @_MD_MODERATOR; ?>
: <?php echo $this->_tpl_vars['subforum']['forum_moderators']; ?>

        	</span>
        	<?php endif; ?>
        </div>
	  </td>
      <td class="even" width="9%" align="center" valign="middle">
      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['subforum']['forum_id']]['topic']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['subforum']['forum_id']]['topic']['day']; ?>
</strong>/<?php endif; ?>
      	<?php echo $this->_tpl_vars['subforum']['forum_topics']; ?>

      </td>
      <td class="odd" width="9%" align="center" valign="middle">
      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['subforum']['forum_id']]['post']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['subforum']['forum_id']]['post']['day']; ?>
</strong>/<?php endif; ?>
      	<?php echo $this->_tpl_vars['subforum']['forum_posts']; ?>

      </td>
      <td class="even" width="20%" align="right" valign="middle"><?php echo $this->_tpl_vars['subforum']['forum_lastpost_time']; ?>
 <br />
		<?php echo $this->_tpl_vars['subforum']['forum_lastpost_user']; ?>

      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['subforum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['subforum']['forum_lastpost_id']; ?>
">
	    <img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/images/subject/<?php echo $this->_tpl_vars['subforum']['forum_lastpost_icon']; ?>
" alt="" />
	    </a>
      	<?php if ($this->_tpl_vars['subforum']['forum_lastpost_subject']): ?>
			<br /> 
	      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['subforum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['subforum']['forum_lastpost_id']; ?>
">
	      	<?php echo $this->_tpl_vars['subforum']['forum_lastpost_subject']; ?>

	      	</a>
      	<?php endif; ?>
	  </td>
   </tr>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php elseif ($this->_tpl_vars['subforum_display'] == 'collapse'): ?>

<?php if (count($this->_tpl_vars['category']['forums'])):
    foreach ($this->_tpl_vars['category']['forums'] as $this->_tpl_vars['forum']):
 ?>
	<tr>
		<?php if ($this->_tpl_vars['forum']['subforum']): ?>
      	<td class="even" rowspan="2" align="center" valign="middle"><?php echo $this->_tpl_vars['forum']['forum_folder']; ?>
</td>
		<?php else: ?>
      	<td class="even" align="center" valign="middle"><?php echo $this->_tpl_vars['forum']['forum_folder']; ?>
</td>
		<?php endif; ?>
      	<td class="odd">
		<div id="index_forum">
	      	<span class="item"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewforum.php?forum=<?php echo $this->_tpl_vars['forum']['forum_id']; ?>
"><?php echo $this->_tpl_vars['forum']['forum_name']; ?>
</a>
	      	<?php if ($this->_tpl_vars['rss_enable']): ?>
			(<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/rss.php?f=<?php echo $this->_tpl_vars['forum']['forum_id']; ?>
" target="_blank" title="RSS feed">RSS</a>)
			<?php endif; ?>
	      	<br /><?php echo $this->_tpl_vars['forum']['forum_desc']; ?>

	      	</span>
			<?php if ($this->_tpl_vars['forum']['forum_moderators']): ?>
			<span class="extra">
        	<?php echo @_MD_MODERATOR; ?>
: <?php echo $this->_tpl_vars['forum']['forum_moderators']; ?>

        	</span>
        	<?php endif; ?>
        </div>
        </td>
	      <td class="even" align="center" valign="middle">
	      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['topic']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['topic']['day']; ?>
</strong>/<?php endif; ?>
	      	<?php echo $this->_tpl_vars['forum']['forum_topics']; ?>

	      </td>
	      <td class="odd" align="center" valign="middle">
	      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['post']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['post']['day']; ?>
</strong>/<?php endif; ?>
	      	<?php echo $this->_tpl_vars['forum']['forum_posts']; ?>

	      </td>
      	<td class="even" align="right" valign="middle">
			<?php echo $this->_tpl_vars['forum']['forum_lastpost_time']; ?>
<br />
			<?php echo $this->_tpl_vars['forum']['forum_lastpost_user']; ?>

	      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
">
		    <img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/images/subject/<?php echo $this->_tpl_vars['forum']['forum_lastpost_icon']; ?>
" alt="" />
		    </a>
	      	<?php if ($this->_tpl_vars['forum']['forum_lastpost_subject']): ?>
				<br /> 
		      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
">
		      	<?php echo $this->_tpl_vars['forum']['forum_lastpost_subject']; ?>

		      	</a>
	      	<?php endif; ?>
    	</td>
    </tr>
	<?php if ($this->_tpl_vars['forum']['subforum']): ?>
    <tr>
     	<td class="odd" colspan="4" align="left"><?php echo @_MD_SUBFORUMS; ?>
&nbsp;<?php echo $this->_tpl_vars['img_subforum']; ?>
&nbsp;
			<?php if (count($this->_tpl_vars['forum']['subforum'])):
    foreach ($this->_tpl_vars['forum']['subforum'] as $this->_tpl_vars['subforum']):
 ?>
			&nbsp;[<a href="viewforum.php?forum=<?php echo $this->_tpl_vars['subforum']['forum_id']; ?>
"><?php echo $this->_tpl_vars['subforum']['forum_name']; ?>
</a>]
			<?php endforeach; endif; unset($_from); ?>
		</td>
	</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php else: ?>

<?php if (count($this->_tpl_vars['category']['forums'])):
    foreach ($this->_tpl_vars['category']['forums'] as $this->_tpl_vars['forum']):
 ?>
	<tr>
      	<td class="even" align="center" valign="middle"><?php echo $this->_tpl_vars['forum']['forum_folder']; ?>
</td>
      	<td class="odd">
		<div id="index_forum">
	      	<span class="item"><a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewforum.php?forum=<?php echo $this->_tpl_vars['forum']['forum_id']; ?>
"><?php echo $this->_tpl_vars['forum']['forum_name']; ?>
</a>
	      	<?php if ($this->_tpl_vars['rss_enable']): ?>
			(<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/rss.php?f=<?php echo $this->_tpl_vars['forum']['forum_id']; ?>
" target="_blank" title="RSS feed">RSS</a>)
			<?php endif; ?>
	      	<br /><?php echo $this->_tpl_vars['forum']['forum_desc']; ?>

	      	</span>
			<?php if ($this->_tpl_vars['forum']['forum_moderators']): ?>
			<span class="extra">
        	<?php echo @_MD_MODERATOR; ?>
: <?php echo $this->_tpl_vars['forum']['forum_moderators']; ?>

        	</span>
        	<?php endif; ?>
        </div>
        </td>
	      <td class="even" align="center" valign="middle">
	      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['topic']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['topic']['day']; ?>
</strong>/<?php endif; ?>
	      	<?php echo $this->_tpl_vars['forum']['forum_topics']; ?>

	      </td>
	      <td class="odd" align="center" valign="middle">
	      	<?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['post']['day']): ?><strong><?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['forum']['forum_id']]['post']['day']; ?>
</strong>/<?php endif; ?>
	      	<?php echo $this->_tpl_vars['forum']['forum_posts']; ?>

	      </td>
      	<td class="even" align="right" valign="middle"><?php echo $this->_tpl_vars['forum']['forum_lastpost_time']; ?>
 <br />
			<?php echo $this->_tpl_vars['forum']['forum_lastpost_user']; ?>

	      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
">
		    <img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/images/subject/<?php echo $this->_tpl_vars['forum']['forum_lastpost_icon']; ?>
" alt="" />
		    </a>
	      	<?php if ($this->_tpl_vars['forum']['forum_lastpost_subject']): ?>
				<br /> 
		      	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/viewtopic.php?post_id=<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
#forumpost<?php echo $this->_tpl_vars['forum']['forum_lastpost_id']; ?>
">
		      	<?php echo $this->_tpl_vars['forum']['forum_lastpost_subject']; ?>

		      	</a>
	      	<?php endif; ?>
		</td>
    </tr>
<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>
  <!-- end forums -->
</table>
</div>
<?php endforeach; endif; unset($_from); ?>
<!-- end forum categories -->

<br />
<div>
<div style="float: left; text-align: left;">
	<?php echo $this->_tpl_vars['img_forum_new']; ?>
 = <?php echo @_MD_NEWPOSTS; ?>
<br />
	<?php echo $this->_tpl_vars['img_forum']; ?>
 = <?php echo @_MD_NONEWPOSTS; ?>
<br />
</div>
<div style="float: right; text-align: right;">
	<form action="search.php" method="post" name="search" id="search">
        <input name="term" id="term" type="text" size="20" />
        <input type="hidden" name="forum" id="forum" value="all" />
        <input type="hidden" name="sortby" id="sortby" value="p.post_time desc" />
        <input type="hidden" name="searchin" id="searchin" value="both" />
        <input type="submit" name="submit" id="submit" value="<?php echo @_MD_SEARCH; ?>
" />
        <br />
        [ <a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/search.php"><?php echo @_MD_ADVSEARCH; ?>
</a> ]
	</form>
</div>
</div>
<div class="clear"></div>

<br style="clear: both;" />
<div style="float:right;text-align:right;padding-top: 5px;">
	<?php if ($this->_tpl_vars['rss_button']): ?>
	<a href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/rss.php?c=<?php echo $this->_tpl_vars['viewcat']; ?>
" target="_blank" title="RSS FEED"><?php echo $this->_tpl_vars['rss_button']; ?>
</a>
	<br />
	<?php endif; ?>
	<a href="http://xoopsforge.com" target="_blank" title="Powered by CBB v<?php echo $this->_tpl_vars['version']; ?>
"><img src="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['xoops_dirname']; ?>
/images/cbb.png" alt="Powered by CBB v<?php echo $this->_tpl_vars['version']; ?>
" title="Powered by CBB v<?php echo $this->_tpl_vars['version']; ?>
" /></a>
</div>
<div class="clear"></div>

<br />
<br />
<?php if ($this->_tpl_vars['online']): ?><?php $this->_smarty_include(array('smarty_include_tpl_file' => "db:newbb_online.html", 'smarty_include_vars' => array()));
 ?><?php endif; ?>
<?php $this->_smarty_include(array('smarty_include_tpl_file' => 'db:system_notification_select.html', 'smarty_include_vars' => array()));
 ?>
<!-- end module contents -->