<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:39:22
         compiled from "E:/wamp/www/XoopsEngine/usr/apps/system/templates/admin/module_available.html" */ ?>
<?php /*%%SmartyHeaderCode:51544d56a9aaee5177-85024873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd96092f567a057754d5ba009ba7cdf65a58c416e' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/usr/apps/system/templates/admin/module_available.html',
      1 => 1293605195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51544d56a9aaee5177-85024873',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('modules_install')->value){?>
<h3><?php echo XOOPS::_("Modules Available for Installation");?></h3>
<table>
    <tr>
        <th><?php echo XOOPS::_('Logo');?></th>
        <th><?php echo XOOPS::_('Name');?></th>
        <th><?php echo XOOPS::_('Version');?></th>
        <th><?php echo XOOPS::_('Status');?></th>
        <th><?php echo XOOPS::_('Install');?></th>
        <th><?php echo XOOPS::_('Clone');?></th>
    </tr>
<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['dirname'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules_install')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
 $_smarty_tpl->tpl_vars['dirname']->value = $_smarty_tpl->tpl_vars['module']->key;
?>
    <tr>
        <td><?php echo XOOPS::registry("view")->htmlImage((isset($_smarty_tpl->tpl_vars['module']->value['logo']) ? $_smarty_tpl->tpl_vars['module']->value['logo'] : null), (isset($_smarty_tpl->tpl_vars['module']->value['name']) ? $_smarty_tpl->tpl_vars['module']->value['name'] : null), array());?>
        <td><?php echo (isset($_smarty_tpl->tpl_vars['module']->value['name']) ? $_smarty_tpl->tpl_vars['module']->value['name'] : null);?>

        <td><?php echo (isset($_smarty_tpl->tpl_vars['module']->value['version']) ? $_smarty_tpl->tpl_vars['module']->value['version'] : null);?>

            <?php if ((isset($_smarty_tpl->tpl_vars['module']->value['upgrade']) ? $_smarty_tpl->tpl_vars['module']->value['upgrade'] : null)>0){?>
                <br /><a href="<?php echo (isset($_smarty_tpl->tpl_vars['module']->value['download']) ? $_smarty_tpl->tpl_vars['module']->value['download'] : null);?>
" rel="external" title="<?php echo XOOPS::_('Upgrade');?>"><?php echo XOOPS::_('Upgrade');?></a>
            <?php }?>
        <td><?php echo (isset($_smarty_tpl->tpl_vars['module']->value['status']) ? $_smarty_tpl->tpl_vars['module']->value['status'] : null);?>

        <td><a href="<?php echo XOOPS::registry('view')->url(array('module' => 'system', 'controller' => 'module', 'action' => 'install', 'dirname' => (isset($_smarty_tpl->tpl_vars['dirname']->value) ? $_smarty_tpl->tpl_vars['dirname']->value : null)), 'admin'); ?>" title="<?php echo XOOPS::_('Install');?>"><?php echo XOOPS::_('Install');?></a>
        <td>
            <?php if ((isset($_smarty_tpl->tpl_vars['module']->value['type']) ? $_smarty_tpl->tpl_vars['module']->value['type'] : null)=="app"){?>
                <a href="<?php echo XOOPS::registry('view')->url(array('module' => 'system', 'controller' => 'module', 'action' => 'clone', 'parent' => (isset($_smarty_tpl->tpl_vars['dirname']->value) ? $_smarty_tpl->tpl_vars['dirname']->value : null)), 'admin'); ?>" title="<?php echo XOOPS::_('Clone');?>"><?php echo XOOPS::_('Clone');?></a>
            <?php }?>
    </tr>
<?php }} ?>
</table>
<?php }else{ ?>
    <?php echo XOOPS::_("There is no module available.");?>
<?php }?>