<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:39:24
         compiled from "E:/wamp/www/XoopsEngine/htdocs/themes/default/admin.html" */ ?>
<?php /*%%SmartyHeaderCode:195684d56a9ac5fc862-61355450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ddf5f97d82647e72388372030ed306a1f1e582a' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/htdocs/themes/default/admin.html',
      1 => 1287825962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195684d56a9ac5fc862-61355450',
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

</head>
<body id="<?php echo $_smarty_tpl->getVariable('xoops_dirname')->value;?>
" class="<?php echo $_smarty_tpl->getVariable('xoops_langcode')->value;?>
">

<!-- Start Header -->
<table cellspacing="0">
    <tr id="header">
        <td id="headerlogo"><a href="<?php echo XOOPS::url('www/', true);?>" title="<?php echo $_smarty_tpl->getVariable('xoops_sitename')->value;?>
"><img src="<?php echo XOOPS::url(XOOPS::registry('view')->resourcePath('xoops-logo.png'));?>" alt="<?php echo $_smarty_tpl->getVariable('xoops_sitename')->value;?>
" /></a></td>
        <td id="headerbanner"><?php echo XOOPS::registry("view")->Widget('xoops_banner', array());?></td>
    </tr>
    <tr>
        <td id="headerbar" colspan="2">&nbsp;</td>
    </tr>
</table>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['navigation'][0][0]->loadNavigation(array('assign'=>'navigation'),$_smarty_tpl->smarty,$_smarty_tpl);?>


<?php if ($_smarty_tpl->getVariable('navigation')->value){?>
    <?php $_template = new Xoops_Smarty_Template("navigation.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
<!-- End header -->

<table cellspacing="0">
    <tr>
        <?php if (($_smarty_tpl->getVariable('side_menu')->value !== null)){?>
        <td id="leftcolumn">
        <!-- Start left blocks loop -->
            <?php $_template = new Xoops_Smarty_Template("side_menu.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        <!-- End left blocks loop -->
        </td>
        <?php }?>

        <td id="centercolumn">
            <!-- Start content module page -->
            <?php if ($_smarty_tpl->getVariable('xoops_contents')->value&&($_smarty_tpl->getVariable('xoops_contents')->value!=' ')){?><div id="content"><?php echo $_smarty_tpl->getVariable('xoops_contents')->value;?>
</div><?php }?>
            <!-- End content module -->
        </td>

    </tr>
</table>

<!-- Start footer -->
<table cellspacing="0">
<tr id="footerbar">
    <td><?php echo $_smarty_tpl->getVariable('xoops_footer')->value;?>
</td>
</tr>
</table>
<!-- End footer -->
</body>
</html>