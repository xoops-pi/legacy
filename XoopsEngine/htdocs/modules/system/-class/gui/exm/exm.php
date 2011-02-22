<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

xoops_load("gui", "system");

/**
 * Xoops Cpanel EXM GUI class
 *
 * @copyright   The XOOPS project http://sf.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package     system
 * @usbpackage  GUI
 * @since       2.3.0
 * @author      Mamba <mambax7@gmail.com>
 * @version     $Id: exm.php 2758 2009-02-03 09:38:41Z phppp $
 */

class XoopsGuiExm extends /* implements */ XoopsSystemGui
{
    /**
     * Reference to template object
     */
    var $template;

    /**
     * Holding navigation
     */
    var $navigation;

    var $menu;

    function __construct()
    {
        include_once XOOPS_ROOT_PATH . '/class/template.php';
        $this->template = new XoopsTpl();
    }

    function XoopsGuiExm()
    {
        $this->__construct();
    }

    function validate()
    {
        return true;
    }

    function generateMenu()
    {
        return true;
    }

    function header()
    {
        global $xoopsConfig, $xoopsUser, $xoopsModule;
        xoops_loadLanguage('cpanel', 'system');
        xoops_loadLanguage('modinfo', 'system');
        xoops_loadLanguage('admin', 'system');

        if (!@include_once XOOPS_ROOT_PATH . "/modules/system/class/gui/exm/language/" . $xoopsConfig['language'] . '/admin.php') {
            include_once XOOPS_ROOT_PATH . "/modules/system/class/gui/exm/language/english/admin.php";
        }

        if (!headers_sent()) {
            header('Content-Type:text/html; charset='._CHARSET);
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }

        $tpl = $this->template;
        $tpl->assign('lang_cp', _CPHOME);
        $tpl->assign('system_options', _AD_SYSOPTIONS);
        $tpl->assign('lang_banners', _MD_AM_BANS);
        $tpl->assign('lang_blocks', _MD_AM_BKAD);
        $tpl->assign('lang_groups', _MD_AM_ADGS);
        $tpl->assign('lang_images', _MD_AM_IMAGES);
        $tpl->assign('lang_modules', _MD_AM_MDAD);
        $tpl->assign('lang_preferences', _MD_AM_PREF);
        $tpl->assign('lang_smilies', _MD_AM_SMLS);
        $tpl->assign('lang_ranks', _MD_AM_RANK);
        $tpl->assign('lang_edituser', _MD_AM_USER);
        $tpl->assign('lang_finduser', _MD_AM_FINDUSER);
        $tpl->assign('lang_mailuser', _MD_AM_MLUS);
        $tpl->assign('lang_avatars', _MD_AM_AVATARS);
        $tpl->assign('lang_tpls', _MD_AM_TPLSETS);
        $tpl->assign('lang_comments', _MD_AM_COMMENTS);
        $tpl->assign('lang_insmodules', _AD_INSTALLEDMODULES);
        $tpl->assign('xoops_sitename', $xoopsConfig['sitename']);

        $lang = '';
        if (file_exists(XOOPS_ROOT_PATH . '/modules/system/class/gui/exm/css/' . _LANGCODE . '.css')) {
            $lang .= '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/modules/system/class/gui/exm/css/' . _LANGCODE . '.css" />';
        }
        if (file_exists(XOOPS_ROOT_PATH . '/language/' . $xoopsConfig["language"] . '/style.css')) {
            $lang .= '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/language/' . $xoopsConfig["language"] . '/style.css" />';
        }
        $tpl->assign('xoops_lang', $lang);

        // ADD MENU *****************************************

        //Add  CONTROL PANEL  Menu  items
        $menu = array();
        $menu[0]['link'] = XOOPS_URL;
        $menu[0]['title'] = _YOURHOME;
        $menu[0]['absolute'] = 1;
        $menu[1]['link'] = XOOPS_URL . "/admin.php?xoopsorgnews=1";
        $menu[1]['title'] = "XOOPS News";
        $menu[1]['absolute'] = 1;
        $menu[1]['icon'] = XOOPS_URL . '/modules/system/class/gui/exm/images/xoops.png';
        $menu[2]['link'] = XOOPS_URL . "/user.php?op=logout";
        $menu[2]['title'] = _LOGOUT;
        $menu[2]['absolute'] = 1;
        $menu[2]['icon'] = XOOPS_URL . '/modules/system/class/gui/exm/images/logout.png';
        $tpl->append('navitems', array('link' => XOOPS_URL . '/admin.php', 'text' => _CPHOME, 'menu' => $menu));

        //add SYSTEM  Menu items
        include dirname(__FILE__) . '/menu.php';
        $system_options = $adminmenu;
        foreach (array_keys($adminmenu) as $item) {
            $system_options[$item]['link'] = empty($adminmenu[$item]['absolute']) ? XOOPS_URL . "/modules/system/" . $adminmenu[$item]['link'] : $adminmenu[$item]['link'];
            $system_options[$item]['icon'] = empty($adminmenu[$item]['icon_small']) ? '' : XOOPS_URL . "/modules/system/class/gui/exm/" . $adminmenu[$item]['icon_small'];
            unset($system_options[$item]['icon_small']);
        }
        $tpl->append('navitems', array('link' => XOOPS_URL.'/modules/system/admin.php', 'text' => _AD_SYSOPTIONS, 'menu' => $system_options));

        if (empty($xoopsModule) || 'system' == $xoopsModule->getVar('dirname', 'n')) {
            $modpath = XOOPS_URL . '/admin.php';
            $modname = _AD_SYSOPTIONS;
            $modid = 1;
            $moddir = 'system';

            $mod_options = $adminmenu;
            foreach (array_keys($mod_options) as $item) {
                $mod_options[$item]['link'] = empty($mod_options[$item]['absolute']) ? XOOPS_URL . "/modules/system/" . $mod_options[$item]['link'] : $mod_options[$item]['link'];
                $mod_options[$item]['icon'] = empty($mod_options[$item]['icon']) ? '' : XOOPS_URL . "/modules/system/class/gui/exm/" . $mod_options[$item]['icon'];
                unset($mod_options[$item]['icon_small']);
            }
        } else {
            $moddir = $xoopsModule->getVar('dirname', 'n');
            $modpath = XOOPS_URL . '/modules/' . $moddir;
            $modname = $xoopsModule->getVar('name');
            $modid = $xoopsModule->getVar('mid');

            $mod_options = $xoopsModule->getAdminMenu();
            foreach (array_keys($mod_options) as $item) {
                $mod_options[$item]['link'] = empty($mod_options[$item]['absolute']) ? XOOPS_URL . "/modules/{$moddir}/" . $mod_options[$item]['link'] : $mod_options[$item]['link'];
                $mod_options[$item]['icon'] = empty($mod_options[$item]['icon']) ? '' : XOOPS_URL . "/modules/system/class/gui/exm/" . $mod_options[$item]['icon'];
            }
        }

        $tpl->assign('mod_options', $mod_options);
        $tpl->assign('modpath', $modpath);
        $tpl->assign('modname', $modname);
        $tpl->assign('modid', $modid);
        $tpl->assign('moddir', $moddir);

        // add MODULES  Menu items
        $module_handler =& xoops_gethandler('module');
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('hasadmin', 1));
        $criteria->add(new Criteria('isactive', 1));
        $criteria->setSort('mid');
        $mods = $module_handler->getObjects($criteria);

        $menu = array();
        $moduleperm_handler =& xoops_gethandler('groupperm');
        foreach ($mods as $mod) {
            $rtn = array();
            $sadmin = $moduleperm_handler->checkRight('module_admin', $mod->getVar('mid'), $xoopsUser->getGroups());
            if ($sadmin) {
                $info = $mod->getInfo();
                if (!empty($info['adminindex'])) {
                    $rtn['link'] = XOOPS_URL . '/modules/'. $mod->getVar('dirname', 'n') . '/' . $info['adminindex'];
                } else {
                    $rtn['link'] = XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $mod->getVar('mid');
                }
                $rtn['title'] = $mod->name();
                $rtn['absolute'] = 1;
                if (isset($info['icon']) && $info['icon'] != '' ) {
                    $rtn['icon'] = XOOPS_URL . '/modules/' . $mod->getVar('dirname', 'n') . '/' . $info['icon'];
                }
            }
            $menu[] = $rtn;
        }
        $tpl->append('navitems', array('link' => XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin', 'text' => _MD_AM_MDAD, 'dir' => $mod->getVar('dirname', 'n'), 'menu' => $menu));

        //add OPTIONS/Links Menu Items
        $menu = array();
        $menu[] = array(
            'link'      => "http://www.xoops.org",
            'title'     => "XOOPS",
            'absolute'  => 1,
            'icon'     => XOOPS_URL . '/modules/system/class/gui/exm/images/xoops.png');
        $menu[] = array(
            'link'      => "http://www.xoops.org/modules/library/",
            'title'     => _AD_XOOPSTHEMES,
            'absolute'  => 1,
            'icon'     => XOOPS_URL . '/modules/system/class/gui/exm/images/tweb.png');
        $menu[] = array(
            'link'      => "http://www.xoops.org/modules/repository/",
            'title'     => _MD_AM_MDAD,
            'absolute'  => 1,
            'icon'     => XOOPS_URL . '/modules/system/class/gui/exm/images/xoops.png');
        $menu[] = array(
            'link'      => "http://sourceforge.net/projects/xoops/",
            'title'     => "Sourceforge",
            'absolute'  => 1);

        $tpl->append('navitems', array('link' => XOOPS_URL . '/admin.php','text' => _AD_INTERESTSITES, 'menu' => $menu));

        echo $tpl->fetch(XOOPS_ROOT_PATH . '/modules/system/class/gui/exm/templates/admin/system_adm_header.html');
        echo $tpl->fetch(XOOPS_ROOT_PATH . '/modules/system/class/gui/exm/templates/admin/system_adm_navbar.html');
        echo "<div id='containBodyCP'><br /><div id='bodyCP'>";

        if (is_object($xoopsModule) || !empty($_GET['xoopsorgnews'])) {
            return;
        }

        foreach ($mods as $mod) {
            $rtn = array();
            $moduleperm_handler =& xoops_gethandler('groupperm');
            $sadmin = $moduleperm_handler->checkRight('module_admin', $mod->getVar('mid'), $xoopsUser->getGroups());
            if ($sadmin) {
                $info = $mod->getInfo();
                if (!empty($info['adminindex'])) {
                    $rtn['link'] = XOOPS_URL . '/modules/'. $mod->getVar('dirname', 'n') . '/' . $info['adminindex'];
                } else {
                    $rtn['link'] = XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $mod->getVar('mid');
                }
                $rtn['title'] = $mod->getVar('name');
                $rtn['absolute'] = 1;
                if (isset($info['icon_big'])) {
                    $rtn['icon'] = XOOPS_URL . '/modules/' . $mod->getVar('dirname', 'n') . '/' . $info['icon_big'];
                } elseif (isset($info['image'])) {
                    $rtn['icon'] = XOOPS_URL . '/modules/' . $mod->getVar('dirname', 'n') . '/' . $info['image'];
                }
            }
            $tpl->append('modules', $rtn);
        }

        echo $tpl->fetch(XOOPS_ROOT_PATH . '/modules/system/class/gui/exm/templates/admin/system_indexcp.html');
    }

    function footer()
    {
        echo $this->template->fetch(XOOPS_ROOT_PATH . '/modules/system/class/gui/exm/templates/admin/system_adm_footer.html');
        echo $GLOBALS['xoopsLogger']->render('');
        ob_end_flush();
        return true;
    }
}

?>