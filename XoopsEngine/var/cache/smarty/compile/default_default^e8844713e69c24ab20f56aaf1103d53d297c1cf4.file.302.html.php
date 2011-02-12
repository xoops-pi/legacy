<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:40:12
         compiled from "E:/wamp/www/XoopsEngine/usr/apps/default/templates/302.html" */ ?>
<?php /*%%SmartyHeaderCode:302384d56a9dc8e9fb3-57184002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8844713e69c24ab20f56aaf1103d53d297c1cf4' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/usr/apps/default/templates/302.html',
      1 => 1282457508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '302384d56a9dc8e9fb3-57184002',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php XOOPS::registry("view")->headLink(array('href' => "app/default/resources/scripts/redirect.css", 'rel' => "stylesheet", 'type' => "text/css"), "append");?>
<div id="xo-wrapper" class="container center">
    <div id="xoops-redirect">
        <div class="message">
            <?php echo $_smarty_tpl->getVariable('message')->value;?>

            <br />
            <?php echo XOOPS::registry("view")->htmlImage("app/default/resources/images/loading_indicator.gif", $_smarty_tpl->getVariable('message')->value, array());?>
        </div>
        <div class="notreload">
            <?php echo $_smarty_tpl->getVariable('lang_ifnotreload')->value;?>

        </div>
    </div>
</div>
