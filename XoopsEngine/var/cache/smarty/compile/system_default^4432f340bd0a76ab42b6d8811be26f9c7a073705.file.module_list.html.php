<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:41:15
         compiled from "E:/wamp/www/XoopsEngine/usr/apps/system/templates/admin/module_list.html" */ ?>
<?php /*%%SmartyHeaderCode:53244d56aa1b05b5d1-57614073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4432f340bd0a76ab42b6d8811be26f9c7a073705' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/usr/apps/system/templates/admin/module_list.html',
      1 => 1293612383,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53244d56aa1b05b5d1-57614073',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_tmp1=$_smarty_tpl->getVariable('modules_active')->value;?><?php if (!empty($_tmp1)){?>
<h3><?php echo XOOPS::_("Active Modules");?></h3>
<?php echo $_smarty_tpl->getVariable('modules_active')->value;?>

<?php }?>

<?php $_tmp2=$_smarty_tpl->getVariable('modules_inactive')->value;?><?php if (!empty($_tmp2)){?>
<h3><?php echo XOOPS::_("Inactive Modules");?></h3>
<table>
    <tr>
        <th><?php echo XOOPS::_('Logo');?></th>
        <th><?php echo XOOPS::_('Name');?></th>
        <th><?php echo XOOPS::_('Version');?></th>
        <th><?php echo XOOPS::_('Status');?></th>
        <th><?php echo XOOPS::_('Synchronize');?></th>
        <th><?php echo XOOPS::_('Activate');?></th>
        <th><?php echo XOOPS::_('Uninstall');?></th>
        <th><?php echo XOOPS::_('Clone');?></th>
    </tr>
<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['dirname'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules_inactive')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
 $_smarty_tpl->tpl_vars['dirname']->value = $_smarty_tpl->tpl_vars['module']->key;
?>
    <tr>
        <td><?php echo XOOPS::registry("view")->htmlImage((isset($_smarty_tpl->tpl_vars['module']->value['logo']) ? $_smarty_tpl->tpl_vars['module']->value['logo'] : null), (isset($_smarty_tpl->tpl_vars['module']->value['name']) ? $_smarty_tpl->tpl_vars['module']->value['name'] : null), array('width' => 120));?>
        <td><?php echo (isset($_smarty_tpl->tpl_vars['module']->value['name']) ? $_smarty_tpl->tpl_vars['module']->value['name'] : null);?>

        <td><?php echo (isset($_smarty_tpl->tpl_vars['module']->value['version']) ? $_smarty_tpl->tpl_vars['module']->value['version'] : null);?>

            <?php if ((isset($_smarty_tpl->tpl_vars['module']->value['upgrade']) ? $_smarty_tpl->tpl_vars['module']->value['upgrade'] : null)>0){?>
                <br /><a href="<?php echo (isset($_smarty_tpl->tpl_vars['module']->value['download']) ? $_smarty_tpl->tpl_vars['module']->value['download'] : null);?>
" rel="external" title="<?php echo XOOPS::_('Upgrade');?>"><?php echo XOOPS::_('Upgrade');?></a>
            <?php }?>
        <td><?php $_tmp3=(isset($_smarty_tpl->tpl_vars['module']->value['parent']) ? $_smarty_tpl->tpl_vars['module']->value['parent'] : null);?><?php if (!empty($_tmp3)){?><?php echo (isset($_smarty_tpl->tpl_vars['module']->value['parent']) ? $_smarty_tpl->tpl_vars['module']->value['parent'] : null);?>
<br /><?php }?>
            <?php echo (isset($_smarty_tpl->tpl_vars['module']->value['status']) ? $_smarty_tpl->tpl_vars['module']->value['status'] : null);?>

        <td><a href="<?php echo XOOPS::registry('view')->url(array('module' => 'system', 'controller' => 'module', 'action' => 'synchronize', 'dirname' => (isset($_smarty_tpl->tpl_vars['dirname']->value) ? $_smarty_tpl->tpl_vars['dirname']->value : null)), 'admin'); ?>" title="<?php echo XOOPS::_('Synchronize');?>"><?php echo XOOPS::_('Synchronize');?></a>
        <td><a href="<?php echo XOOPS::registry('view')->url(array('module' => 'system', 'controller' => 'module', 'action' => 'activate', 'dirname' => (isset($_smarty_tpl->tpl_vars['dirname']->value) ? $_smarty_tpl->tpl_vars['dirname']->value : null)), 'admin'); ?>" title="<?php echo XOOPS::_('Activate');?>"><?php echo XOOPS::_('Activate');?></a>
        <td><a href="<?php echo XOOPS::registry('view')->url(array('module' => 'system', 'controller' => 'module', 'action' => 'uninstall', 'dirname' => (isset($_smarty_tpl->tpl_vars['dirname']->value) ? $_smarty_tpl->tpl_vars['dirname']->value : null)), 'admin'); ?>" title="<?php echo XOOPS::_('Uninstall');?>"><?php echo XOOPS::_('Uninstall');?></a>
        <td>
            <?php $_tmp4=(isset($_smarty_tpl->tpl_vars['module']->value['parent']) ? $_smarty_tpl->tpl_vars['module']->value['parent'] : null);?><?php if (empty($_tmp4)&&(isset($_smarty_tpl->tpl_vars['module']->value['type']) ? $_smarty_tpl->tpl_vars['module']->value['type'] : null)=="app"){?>
                <a href="<?php echo XOOPS::registry('view')->url(array('module' => 'system', 'controller' => 'module', 'action' => 'clone', 'parent' => (isset($_smarty_tpl->tpl_vars['dirname']->value) ? $_smarty_tpl->tpl_vars['dirname']->value : null)), 'admin'); ?>" title="<?php echo XOOPS::_('Clone');?>"><?php echo XOOPS::_('Clone');?></a>
            <?php }?>
    </tr>
<?php }} ?>
</table>
<?php }?>
