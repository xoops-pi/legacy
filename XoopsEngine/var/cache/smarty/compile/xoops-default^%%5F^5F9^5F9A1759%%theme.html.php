<?php /* Smarty version 2.6.22, created on 2011-02-12 15:41:26
         compiled from E:/wamp/www/XoopsEngine/htdocs/themes/legacy/theme.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['xoops_langcode']; ?>
" lang="<?php echo $this->_tpl_vars['xoops_langcode']; ?>
">
<head>
    <!-- Assign Theme name -->
    <?php $this->assign('theme_name', $this->_tpl_vars['xoTheme']->folderName); ?>

    <!-- Title and meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="content-language" content="<?php echo $this->_tpl_vars['xoops_langcode']; ?>
" />
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $this->_tpl_vars['xoops_charset']; ?>
" />
    <title><?php if ($this->_tpl_vars['xoops_pagetitle'] != ''): ?><?php echo $this->_tpl_vars['xoops_pagetitle']; ?>
 - <?php endif; ?><?php echo $this->_tpl_vars['xoops_sitename']; ?>
</title>
    <meta name="robots" content="<?php echo $this->_tpl_vars['xoops_meta_robots']; ?>
" />
    <meta name="keywords" content="<?php echo $this->_tpl_vars['xoops_meta_keywords']; ?>
" />
    <meta name="description" content="<?php echo $this->_tpl_vars['xoops_meta_description']; ?>
" />
    <meta name="rating" content="<?php echo $this->_tpl_vars['xoops_meta_rating']; ?>
" />
    <meta name="author" content="<?php echo $this->_tpl_vars['xoops_meta_author']; ?>
" />
    <meta name="copyright" content="<?php echo $this->_tpl_vars['xoops_meta_copyright']; ?>
" />
    <meta name="generator" content="XOOPS" />

    <!-- Rss -->
    <link rel="alternate" type="application/rss+xml" title="" href="<?php echo '/XoopsEngine/htdocs/backend.php'; ?>" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/ico" href="<?php 
echo '/XoopsEngine/htdocs/themes/legacy/icons/favicon.ico'; ?>" />
    <link rel="icon" type="image/png" href="<?php 
echo '/XoopsEngine/htdocs/themes/legacy/icons/favicon.png'; ?>" />
    <!-- Sheet Css -->
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<?php echo '/XoopsEngine/htdocs/xoops.css'; ?>" />
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<?php 
echo '/XoopsEngine/htdocs/themes/legacy/style.css'; ?>" />

    <!-- customized header contents -->
    <?php echo $this->_tpl_vars['xoops_module_header']; ?>

</head>
<body id="<?php echo $this->_tpl_vars['xoops_dirname']; ?>
" class="<?php echo $this->_tpl_vars['xoops_langcode']; ?>
">

<!-- Start Header -->
<table cellspacing="0">
    <tr id="header">
        <td id="headerlogo"><a href="<?php echo '/XoopsEngine/htdocs/'; ?>" title="<?php echo $this->_tpl_vars['xoops_sitename']; ?>
"><img src="<?php 
echo '/XoopsEngine/htdocs/themes/legacy/xoops-logo.png'; ?>" alt="<?php echo $this->_tpl_vars['xoops_sitename']; ?>
" /></a></td>
        <td id="headerbanner"><?php echo $this->_tpl_vars['xoops_banner']; ?>
</td>
    </tr>
    <tr>
        <td id="headerbar" colspan="2">&nbsp;</td>
    </tr>
</table>
<!-- End header -->

<table cellspacing="0">
    <tr>
        <!-- Start left blocks loop -->
        <?php if ($this->_tpl_vars['xoops_showlblock']): ?>
            <td id="leftcolumn">
            <?php $_from = $this->_tpl_vars['xoBlocks']['canvas_left']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                <?php $this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockleft.html", 'smarty_include_vars' => array()));
 ?>
            <?php endforeach; endif; unset($_from); ?>
            </td>
        <?php endif; ?>
        <!-- End left blocks loop -->

        <td id="centercolumn">
            <!-- Display center blocks if any -->
            <?php if ($this->_tpl_vars['xoBlocks']['page_topleft'] || $this->_tpl_vars['xoBlocks']['page_topcenter'] || $this->_tpl_vars['xoBlocks']['page_topright']): ?>
                <table cellspacing="0">
                    <tr>
                        <td id="centerCcolumn" colspan="2">
                        <!-- Start center-center blocks loop -->
                        <?php $_from = $this->_tpl_vars['xoBlocks']['page_topcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                            <?php $this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockcenter_c.html", 'smarty_include_vars' => array()));
 ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <!-- End center-center blocks loop -->
                        </td>
                    </tr>
                    <tr>
                        <td id="centerLcolumn">
                        <!-- Start center-left blocks loop -->
                        <?php $_from = $this->_tpl_vars['xoBlocks']['page_topleft']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                            <?php $this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockcenter_l.html", 'smarty_include_vars' => array()));
 ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <!-- End center-left blocks loop -->
                        </td>
                        <td id="centerRcolumn">
                        <!-- Start center-right blocks loop -->
                        <?php $_from = $this->_tpl_vars['xoBlocks']['page_topright']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                            <?php $this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockcenter_r.html", 'smarty_include_vars' => array()));
 ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <!-- End center-right blocks loop -->
                        </td>
                    </tr>
                </table>
            <?php endif; ?>
            <!-- End center top blocks loop -->

            <!-- Start content module page -->
            <?php if ($this->_tpl_vars['xoops_contents'] && ( $this->_tpl_vars['xoops_contents'] != ' ' )): ?><div id="content"><?php echo $this->_tpl_vars['xoops_contents']; ?>
</div><?php endif; ?>
            <!-- End content module -->

            <!-- Start center bottom blocks loop -->
            <?php if ($this->_tpl_vars['xoBlocks']['page_bottomleft'] || $this->_tpl_vars['xoBlocks']['page_bottomright'] || $this->_tpl_vars['xoBlocks']['page_bottomcenter']): ?>
                <table cellspacing="0">
                    <?php if ($this->_tpl_vars['xoBlocks']['page_bottomcenter']): ?>
                        <tr>
                            <td id="bottomCcolumn" colspan="2">
                            <?php $_from = $this->_tpl_vars['xoBlocks']['page_bottomcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockcenter_c.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                            <?php endforeach; endif; unset($_from); ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($this->_tpl_vars['xoBlocks']['page_bottomleft'] || $this->_tpl_vars['xoBlocks']['page_bottomright']): ?>
                        <tr>
                            <td id="bottomLcolumn">
                            <?php $_from = $this->_tpl_vars['xoBlocks']['page_bottomleft']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockcenter_l.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                            <?php endforeach; endif; unset($_from); ?>
                            </td>

                            <td id="bottomRcolumn">
                                <?php $_from = $this->_tpl_vars['xoBlocks']['page_bottomright']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockcenter_r.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            <?php endif; ?>
            <!-- End center bottom blocks loop -->
        </td>

        <?php if ($this->_tpl_vars['xoops_showrblock']): ?>
            <td id="rightcolumn">
            <!-- Start right blocks loop -->
            <?php $_from = $this->_tpl_vars['xoBlocks']['canvas_right']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
                <?php $this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['theme_name'])."/theme_blockright.html", 'smarty_include_vars' => array()));
 ?>
            <?php endforeach; endif; unset($_from); ?>
            <!-- End right blocks loop -->
            </td>
        <?php endif; ?>
    </tr>
</table>

<!-- Start footer -->
<table cellspacing="0">
<tr id="footerbar">
    <td><?php echo $this->_tpl_vars['xoops_footer']; ?>
</td>
</tr>
</table>
<!-- End footer -->

<!--{xo-logger-output}-->
</body>
</html>