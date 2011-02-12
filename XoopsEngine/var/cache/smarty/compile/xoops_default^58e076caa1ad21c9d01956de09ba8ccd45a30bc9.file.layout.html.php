<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:41:19
         compiled from "E:/wamp/www/XoopsEngine/htdocs/themes/default/layout.html" */ ?>
<?php /*%%SmartyHeaderCode:220584d56aa1fed6c94-50796144%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '58e076caa1ad21c9d01956de09ba8ccd45a30bc9' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/htdocs/themes/default/layout.html',
      1 => 1289814902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '220584d56aa1fed6c94-50796144',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php XOOPS::service('translate')->loadTranslation('main', 'theme:default');?>

<!-- DocType -->
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


<!-- Load theme locale scripts, solely for demonstration -->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo XOOPS::localeUrl('theme:default', 'locale.css');?>" />

<!-- customized header contents -->
<?php if (($_smarty_tpl->getVariable('xoops_module_header')->value !== null)){?>
    <?php echo $_smarty_tpl->getVariable('xoops_module_header')->value;?>

<?php }?>
</head>
<body id="<?php echo $_smarty_tpl->getVariable('xoops_dirname')->value;?>
" class="<?php echo $_smarty_tpl->getVariable('xoops_langcode')->value;?>
">

<!-- Start Header -->
<table cellspacing="0">
    <tr id="header">
        <td id="header-logo"><a href="<?php echo XOOPS::url('www', true);?>" title="<?php echo $_smarty_tpl->getVariable('xoops_sitename')->value;?>
"><img src="<?php echo XOOPS::url(XOOPS::registry('view')->resourcePath('xoops-logo.png'));?>" alt="<?php echo $_smarty_tpl->getVariable('xoops_sitename')->value;?>
" /></a></td>
        <td id="header-banner"><?php echo XOOPS::registry("view")->Widget('xoops_banner', array());?></td>
        <td id="header-account"><?php echo XOOPS::registry("view")->Widget('account', array('size' => 's'));?></td>
    </tr>
    <tr>
        <td id="header-bar" colspan="3">&nbsp;</td>
    </tr>
</table>

<!-- Load navigation -->
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['navigation'][0][0]->loadNavigation(array('assign'=>'navigation'),$_smarty_tpl->smarty,$_smarty_tpl);?>


<?php if ($_smarty_tpl->getVariable('navigation')->value){?>
    <?php $_template = new Xoops_Smarty_Template("navigation.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
<!-- End header -->

<!-- Load blocks -->
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['blocks'][0][0]->loadBlocks(array('assign'=>'xoopsBlocks'),$_smarty_tpl->smarty,$_smarty_tpl);?>

<table cellspacing="0">
    <tr>
        <!-- Start left blocks loop -->
        <?php if (((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['left']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['left'] : null) !== null)){?>
            <td id="leftcolumn">
            <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['left']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['left'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                <?php $_template = new Xoops_Smarty_Template("block-left.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
            <?php }} ?>
            </td>
        <?php }?>
        <!-- End left blocks loop -->

        <td id="centercolumn">
            <!-- Display center blocks if any -->
            <?php if (((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['topleft']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['topleft'] : null) !== null)||((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['topcenter']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['topcenter'] : null) !== null)||((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['topright']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['topright'] : null) !== null)){?>
                <table cellspacing="0">
                    <tr>
                        <td id="centerCcolumn" colspan="2">
                        <!-- Start center-center blocks loop -->
                        <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['topcenter']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['topcenter'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                            <?php $_template = new Xoops_Smarty_Template("block-top-center.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                        <?php }} ?>
                        <!-- End center-center blocks loop -->
                        </td>
                    </tr>
                    <tr>
                        <td id="centerLcolumn">
                        <!-- Start center-left blocks loop -->
                        <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['topleft']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['topleft'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                            <?php $_template = new Xoops_Smarty_Template("block-top-left.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                        <?php }} ?>
                        <!-- End center-left blocks loop -->
                        </td>
                        <td id="centerRcolumn">
                        <!-- Start center-right blocks loop -->
                        <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['topright']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['topright'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                            <?php $_template = new Xoops_Smarty_Template("block-top-right.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                        <?php }} ?>
                        <!-- End center-right blocks loop -->
                        </td>
                    </tr>
                </table>
            <?php }?>
            <!-- End center top blocks loop -->

            <!-- Start content module page -->
            <?php if ($_smarty_tpl->getVariable('xoops_contents')->value&&($_smarty_tpl->getVariable('xoops_contents')->value!=' ')){?><div id="content"><?php echo $_smarty_tpl->getVariable('xoops_contents')->value;?>
</div><?php }?>
            <!-- End content module -->

            <!-- Start center bottom blocks loop -->
            <?php if (((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomleft']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomleft'] : null) !== null)||((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomright']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomright'] : null) !== null)||((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomcenter']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomcenter'] : null) !== null)){?>
                <table cellspacing="0">
                    <?php if (((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomcenter']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomcenter'] : null) !== null)){?>
                        <tr>
                            <td id="bottomCcolumn" colspan="2">
                            <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomcenter']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomcenter'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                                <?php $_template = new Xoops_Smarty_Template("block-bottom-center.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                            <?php }} ?>
                            </td>
                        </tr>
                    <?php }?>

                    <?php if (((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomleft']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomleft'] : null) !== null)||((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomright']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomright'] : null) !== null)){?>
                        <tr>
                            <td id="bottomLcolumn">
                            <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomleft']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomleft'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                                <?php $_template = new Xoops_Smarty_Template("block-bottom-left.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                            <?php }} ?>
                            </td>

                            <td id="bottomRcolumn">
                                <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['bottomright']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['bottomright'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                                    <?php $_template = new Xoops_Smarty_Template("block-bottom-right.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                                <?php }} ?>
                            </td>
                        </tr>
                    <?php }?>
                </table>
            <?php }?>
            <!-- End center bottom blocks loop -->
             <div class="for-locale-test"><?php echo XOOPS::_($_smarty_tpl->getVariable('xoops_sitename')->value);?></div>
        </td>

        <?php if (((isset($_smarty_tpl->getVariable('xoopsBlocks')->value['right']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['right'] : null) !== null)){?>
            <td id="rightcolumn">
            <!-- Start right blocks loop -->
            <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->getVariable('xoopsBlocks')->value['right']) ? $_smarty_tpl->getVariable('xoopsBlocks')->value['right'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
                <?php $_template = new Xoops_Smarty_Template("block-right.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
            <?php }} ?>
            <!-- End right blocks loop -->
            </td>
        <?php }?>
    </tr>
</table>

<!-- Start footer -->
<table cellspacing="0">
<tr id="footerbar">
    <td><?php echo $_smarty_tpl->getVariable('xoops_footer')->value;?>
 | <?php echo XOOPS::_('_THEME_DEFAULT_SITE');?></td>
</tr>
</table>
<!-- End footer -->

</body>
</html>