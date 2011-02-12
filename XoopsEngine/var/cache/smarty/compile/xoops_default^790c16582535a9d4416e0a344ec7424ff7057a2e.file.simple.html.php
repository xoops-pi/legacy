<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:40:12
         compiled from "E:/wamp/www/XoopsEngine/htdocs/themes/default/simple.html" */ ?>
<?php /*%%SmartyHeaderCode:79354d56a9dcba8a48-25316000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '790c16582535a9d4416e0a344ec7424ff7057a2e' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/htdocs/themes/default/simple.html',
      1 => 1287066213,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79354d56a9dcba8a48-25316000',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('doctype')->value;?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getVariable('xoops_langcode')->value;?>
" lang="<?php echo $_smarty_tpl->getVariable('xoops_langcode')->value;?>
">
<head>
<?php echo $_smarty_tpl->getVariable('headMeta')->value;?>

<?php echo $_smarty_tpl->getVariable('headTitle')->value;?>

<?php echo $_smarty_tpl->getVariable('headLink')->value;?>

<?php echo $_smarty_tpl->getVariable('headScript')->value;?>

<?php echo $_smarty_tpl->getVariable('headStyle')->value;?>


<!-- customized header contents -->
<?php if (($_smarty_tpl->getVariable('xoops_module_header')->value !== null)){?>
    <?php echo $_smarty_tpl->getVariable('xoops_module_header')->value;?>

<?php }?>
</head>
<body>

    <!-- Start content module page -->
    <?php $_tmp1=$_smarty_tpl->getVariable('xoops_contents')->value;?><?php if (!empty($_tmp1)){?><div id="content"><?php echo $_smarty_tpl->getVariable('xoops_contents')->value;?>
</div><?php }?>
    <!-- End content module -->

</body>
</html>