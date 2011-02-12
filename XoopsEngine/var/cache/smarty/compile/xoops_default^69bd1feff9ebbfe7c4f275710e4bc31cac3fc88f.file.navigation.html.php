<?php /* Smarty version Smarty-3.0.0, created on 2011-02-12 15:39:26
         compiled from "E:/wamp/www/XoopsEngine/htdocs/themes/default/navigation.html" */ ?>
<?php /*%%SmartyHeaderCode:235294d56a9ae7e7027-32225548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69bd1feff9ebbfe7c4f275710e4bc31cac3fc88f' => 
    array (
      0 => 'E:/wamp/www/XoopsEngine/htdocs/themes/default/navigation.html',
      1 => 1287452548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235294d56a9ae7e7027-32225548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php XOOPS::registry("view")->jQuery(array("extensions/jdMenu/jquery.dimensions.js","extensions/jdMenu/jquery.positionBy.js","extensions/bgiframe/jquery.bgiframe.min.js","extensions/jdMenu/jquery.jdMenu.js","extensions/jdMenu/jquery.jdMenu.css"));?>

<div class="topbar">
    <div id="top-menu"><?php echo (isset($_smarty_tpl->getVariable('navigation')->value['menu']) ? $_smarty_tpl->getVariable('navigation')->value['menu'] : null);?>
</div>
    <div id="top-navigation"><?php echo (isset($_smarty_tpl->getVariable('navigation')->value['breadcrumbs']) ? $_smarty_tpl->getVariable('navigation')->value['breadcrumbs'] : null);?>
</div>
</div>
