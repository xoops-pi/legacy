<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:41:21
         compiled from "E:/wamp/www/XoopsEngine/usr/apps/user/templates/blocks/account.html" */ ?>
<?php /*%%SmartyHeaderCode:112914d56aa2149e452-83139964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7996414fdd551c3df3d29bdc067479a637aa9f1a' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/usr/apps/user/templates/blocks/account.html',
      1 => 1287581003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112914d56aa2149e452-83139964',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php XOOPS::registry("view")->headLink(array('href' => "app/user/resources/scripts/block.css", 'rel' => "stylesheet", 'type' => "text/css"), "append");?>

<div class="account-block">
<?php $_tmp1=(isset($_smarty_tpl->getVariable('block')->value['user']) ? $_smarty_tpl->getVariable('block')->value['user'] : null);?><?php if (!empty($_tmp1)){?>
    <div class="avatar"><?php echo (isset($_smarty_tpl->getVariable('block')->value['user']['avatar']) ? $_smarty_tpl->getVariable('block')->value['user']['avatar'] : null);?>
</div>
    <div class="user">
        <div class="name"><a href="<?php echo (isset($_smarty_tpl->getVariable('block')->value['user']['link']) ? $_smarty_tpl->getVariable('block')->value['user']['link'] : null);?>
" title="<?php echo (isset($_smarty_tpl->getVariable('block')->value['user']['name']) ? $_smarty_tpl->getVariable('block')->value['user']['name'] : null);?>
"><?php echo (isset($_smarty_tpl->getVariable('block')->value['user']['name']) ? $_smarty_tpl->getVariable('block')->value['user']['name'] : null);?>
</a></div>
        <div class="action"><a href="<?php echo (isset($_smarty_tpl->getVariable('block')->value['link_logout']) ? $_smarty_tpl->getVariable('block')->value['link_logout'] : null);?>
" title="<?php echo XOOPS::_('Logout');?>"><?php echo XOOPS::_('Logout');?></a></div>
    </div>
<?php }else{ ?>
    <div class="user">
        <div class="action"><a href="<?php echo (isset($_smarty_tpl->getVariable('block')->value['link_login']) ? $_smarty_tpl->getVariable('block')->value['link_login'] : null);?>
" title="<?php echo XOOPS::_('Login');?>"><?php echo XOOPS::_('Login');?></a></div>
        <div class="action"><a href="<?php echo (isset($_smarty_tpl->getVariable('block')->value['link_register']) ? $_smarty_tpl->getVariable('block')->value['link_register'] : null);?>
" title="<?php echo XOOPS::_('Register');?>"><?php echo XOOPS::_('Register');?></a></div>
    </div>
<?php }?>
</div>
