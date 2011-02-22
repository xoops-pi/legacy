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
 * Xoops Cpanel default GUI class
 *
 * @copyright   The XOOPS project http://sf.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package     system
 * @usbpackage  GUI
 * @since       2.3.0
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @version     $Id: default.php 2902 2009-03-05 07:13:07Z phppp $
 */

class XoopsGuiDefault extends /* implements */ XoopsSystemGui
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
    }

    function XoopsGuiDefault()
    {
        $this->__construct();
    }

    function validate()
    {
        return true;
    }

    function flush()
    {
        xoops_load("cache");
        XoopsCache::delete("adminmenu_" . __CLASS__);
    }

    /**
     * @access  private
     */
    function loadMenu()
    {
        if ($this->menu) return $this->menu;

        xoops_load("cache");
        if (!$this->menu = XoopsCache::read("adminmenu_" . __CLASS__)) {
            $this->generateMenu();
        }

        $this->menu = XoopsCache::read("adminmenu_" . __CLASS__);
        return $this->menu;
    }

    /**
     * @access  private
     *
     */
    function generateMenu()
    {
        $module_handler =& xoops_gethandler('module');
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('hasadmin', 1));
        $criteria->add(new Criteria('isactive', 1));
        $criteria->setSort('mid');
        $mods = $module_handler->getObjects($criteria);
        $modules = array();
        foreach ($mods as $mod) {
            $mid            = $mod->getVar('mid');
            $module_name    = $mod->getVar('name');
            $module_dirname = $mod->getVar('dirname', 'n');

            $menus = array();
            if ($adminmenu = $mod->getAdminMenu()) {
                foreach ( $adminmenu as $menuitem ) {
                    $menuitem['target'] = @trim($menuitem['target']);
                    $menuitem['title'] = @trim($menuitem['title']);
                    $menuitem['link'] = @trim($menuitem['link']);
                    $menus[] = array(
                        "title"     => $menuitem['title'],
                        "target"    => empty($menuitem['target']) ? "" : ( ($menuitem['target'] == "new" || $menuitem['target'] == "_blank") ?" rel='external'" : " target='" . $menuitem['target'] . "'"),
                        "link"      => empty($menuitem['link']) ? "#"
                                        :  (!empty($menuitem['absolute']) ? $menuitem['link']
                                            : XOOPS_URL . "/modules/" . $module_dirname . "/" . $menuitem['link']
                                            ),
                        );
                }
            }

            if ($mod->getVar('hasnotification') || is_array( $mod->getInfo('config') ) || is_array( $mod->getInfo('comments') )) {
                $menus[] = array(
                    'link'      => XOOPS_URL . "/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $mid,
                    'title'     => _PREFERENCES,
                    'target'    => "",
                    );
            }
            $module_menu = "";
            if ( count($menus) > 0 ) {
                $module_menu .= "<div><strong>" . _MD_CPANEL_QUICKLINKS . "</strong><ul>";
                foreach ( $menus as $menuitem ) {
                    $module_menu .= "<li><a href='{$menuitem['link']}' title='{$menuitem['title']}'{$menuitem['target']}>" . $menuitem['title'] . "</a></li>";
                }
                $module_menu .= "</ul></div>";
            }
            $module_img = "<img class='admin_layer_img' src='" . XOOPS_URL . "/modules/" . $module_dirname . "/" . $mod->getInfo('image') . "' alt='' />";
            $module_desc  =     "<div>" .
                                "<a href='javascript: xoopsToggleDisplay(\"mb-{$mid}-desc\")' title='" . _DESCRIPTION . "'>" . $module_img .
                                " <span id='mb-{$mid}-desc-label'>&raquo;</span></a>" .
                                "</div>" .
                                "<div id='mb-{$mid}-desc' style='display: none;'>" .
                                "<strong>" . _AUTHOR . "</strong><br />" . $mod->getInfo('author') .
                                "<br /><strong>" . _VERSION . "</strong> - " . round($mod->getVar('version')/100 , 2) .
                                "<br /><strong>" . _DESCRIPTION . "</strong><br />" . $mod->getInfo('description') .
                                "</div>";

            $modules[$mid] = array(
                                "name"      => $module_name,
                                "dirname"   => $module_dirname,
                                "content"   => "<div class='module-menu-content'>" . $module_menu . "<br />" . $module_desc . "</div>",
                                );
        }
        xoops_load("cache");
        XoopsCache::write("adminmenu_" . __CLASS__, $modules);
    }

    function header()
    {
        global $xoopsConfig, $xoopsUser;

        $GLOBALS['xoopsTpl'] = XOOPS::registry('view')->getEngine();
        $GLOBALS['xoTheme'] = XOOPS::registry('view')->loadTheme()->setTheme('legacy');

        $frontController = XOOPS::registry('frontController');
        $frontController->preDispatch();
        $template = XOOPS::registry('view')->getEngine();
        $navigation = Xoops::registry('layout')->loadNavigation(array('assign' => 'navigation'), $template);
        $navigationTemplate = $GLOBALS['xoTheme']->getTheme() . '/navigation.html';
        $navigation = $template->fetch($navigationTemplate);

        xoops_loadLanguage("cpanel", "system");

        if (!headers_sent()) {
            header('Content-Type:text/html; charset=' . _CHARSET);
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }

        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
        echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="' . _LANGCODE . '" lang="' . _LANGCODE . '">
        <head>
        <meta http-equiv="content-type" content="text/html; charset=' . _CHARSET . '" />
        <meta http-equiv="content-language" content="' . _LANGCODE . '" />
        <title>' . htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES) . ' Administration</title>
        <meta name="author" content="XOOPS" />
        <meta name="copyright" content="XOOPS &copy; 2001-' . date("Y") . '" />
        <meta name="generator" content="XOOPS" />
        <link rel="shortcut icon" type="image/ico" href="' . XOOPS_URL . '/favicon.ico" />
        <script type="text/javascript" src="' . XOOPS_URL . '/include/xoops.js"></script>';

        foreach (array('headLink', 'headScript', 'headStyle') as $item) {
            echo XOOPS::registry('view')->$item();
        }

        /*
        '<script type="text/javascript">
        function xoopsVariableDefined(variable) {
            try { var isDefined = (eval(variable) != "undefined") }
            catch(e) { var isDefined = false }
            return isDefined;
        }

        function xoopsToggleDisplay(id) {
            if (!xoopsVariableDefined("xoopsToggleLabel")) {
                var toggle_innerHTML = new Array("&raquo;", "&laquo;");
            } else {
                var toggle_innerHTML = xoopsToggleLabel;
            }
            var elestyle = xoopsGetElementById(id).style;
            var label = xoopsGetElementById(id+"-label");
            if (elestyle.display == "none") {
                elestyle.display = "block";
                label.innerHTML = toggle_innerHTML[1];
            } else {
                elestyle.display = "none";
                label.innerHTML = toggle_innerHTML[0];
            }
        }
        </script>
        ';
        */
        echo '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/xoops.css" />';
        echo '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/modules/system/class/gui/default/css/style.css" />';
        if (file_exists(XOOPS_ROOT_PATH . '/modules/system/class/gui/default/css/' . _LANGCODE . '.css')) {
            echo '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/modules/system/class/gui/default/css/' . _LANGCODE . '.css" />';
        }
        if (file_exists(XOOPS_ROOT_PATH . '/language/' . $xoopsConfig["language"] . '/style.css')) {
            echo '<link rel="stylesheet" type="text/css" media="all" href="' . XOOPS_URL . '/language/' . $xoopsConfig["language"] . '/style.css" />';
        }
        /*
        $moduleperm_handler =& xoops_gethandler('groupperm');
        $admin_mids = $moduleperm_handler->getItemIds('module_admin', $xoopsUser->getGroups());
        $xoops_admin_menu = $this->loadMenu();
        */
        ?>

        <?php
            /*
            $logo = file_exists(XOOPS_THEME_PATH . "/" . $GLOBALS['xoopsConfig']['theme_set'] . "/images/logo23.gif")
                    ? XOOPS_THEME_URL . "/" . $GLOBALS['xoopsConfig']['theme_set'] . "/images/logo23.gif"
                    : XOOPS_URL . "/images/logo23.gif";
            */
            echo "</head>
            <body>";
            /*
            "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
              <tr>
                <td bgcolor='#2a75c5' background='" . XOOPS_URL . "/modules/system/class/gui/default/images/xo-banner_bg.png'><a href='http://xoops.sourceforge.net/' rel='external'><img src='" . XOOPS_URL . "/modules/system/class/gui/default/images/xoops-logo.png' alt='" . htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES) . "' /></a></td>
                <td align='right' bgcolor='#9F009F' background='" . XOOPS_URL . "/modules/system/class/gui/default/images/xo-banner_bg.png' colspan='2'><img src='" . XOOPS_URL . "/modules/system/class/gui/default/images/xoops23.gif' alt='' /></td>
              </tr>
              <tr>
                <td align='left' colspan='3' class='bg5'>
                  <table border='0' width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td width='1%'><img src='" . XOOPS_URL."/modules/system/class/gui/default/images/hbar_left.gif' width='16' height='23' /></td>
                        <td class='hbar_middle'>
                            &nbsp;&laquo; <a href='" . XOOPS_URL . "/'>" . _YOURHOME . "</a>
                            &nbsp;|&nbsp;<a href='" . XOOPS_URL . "/admin.php'>" . _CPHOME . "</a>
                            &nbsp;|&nbsp;<strong>XOOPS &raquo;</strong>
                            &nbsp;<a href='" . XOOPS_URL . "/admin.php?xoopsorgnews=1' title='" . _MD_CPANEL_NEWS_DESC . "'>" . _MD_CPANEL_NEWS . "</a>
                            &nbsp;&sdot;&nbsp;<a href='http://sourceforge.net/projects/xoops/' rel='external' title='" . _MD_CPANEL_PROJECT_DESC . "'>" . _MD_CPANEL_PROJECT . "</a>
                            &nbsp;&sdot;&nbsp;<a href='http://xoops.sourceforge.net/' rel='external' title='" . _MD_CPANEL_COMMUNITY_DESC . "'>" . _MD_CPANEL_COMMUNITY . "</a>
                            &nbsp;&sdot;&nbsp;<a href='http://www.xoops.org/modules/xoopspartners/' rel='external' title='" . _MD_CPANEL_LOCAL_DESC . "'>" . _MD_CPANEL_LOCAL . "</a>
                        </td>
                        <td class='hbar_middle' align='right'><a href='" . XOOPS_URL . "/user.php?op=logout'>" . _LOGOUT . "</a>&nbsp;</td>
                        <td width='1%'><img src='" . XOOPS_URL . "/modules/system/class/gui/default/images/hbar_right.gif' width='10' height='23' /></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>";
            */
            echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
              <tr><td>";
            echo $navigation;
            echo "</td></tr><tr>";
              /*
                "<td width='2%' valign='top' class='bg5 bg_menu' align='center'></td>
                <td width='15%' valign='top' class='bg5' align='left'><img src='" . XOOPS_URL . "/modules/system/class/gui/default/images/menu.gif' /><br />
                  <table border='0' cellpadding='4' cellspacing='0' width='100%'><tr><td>";

            $current_mid = (isset($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]) ? $GLOBALS["xoopsModule"]->getVar("mid") : 0;
            foreach ( array_keys($xoops_admin_menu) as $mid ) {
                if ( !in_array($mid, $admin_mids) ) {
                    continue;
                }
                echo "<h5>" .
                        "<a href='javascript: xoopsToggleDisplay(\"mb-{$mid}\")' title='dirname: " . $xoops_admin_menu[$mid]["dirname"] . "'>" .
                        "<span id='mb-{$mid}-label' style='padding-right: 5px;'>" .
                        ( ($mid == $current_mid) ? "&laquo;" : "&raquo;" ) .
                        "</span>" .
                        $xoops_admin_menu[$mid]["name"] .
                        "</a></h5>";
                echo "<div id='mb-{$mid}'" . ( ($mid == $current_mid) ? "" : " style='display: none;'") . ">" . $xoops_admin_menu[$mid]["content"] . "</div>";
            }
            echo "
                  </td></tr></table>
                  <br />
                </td>";
                */
                echo "<td align='left' valign='top' width='100%'>
                  <div class='content'><br />\n";

    }

    function footer()
    {
        global $xoopsConfig, $xoopsLogger;
        // Home page of administration area
        if (false === strpos($_SERVER['REQUEST_URI'], '?') && false === strpos($_SERVER['REQUEST_URI'], '/modules/') && substr($_SERVER['REQUEST_URI'], -9) == "admin.php") {
            $string_pattern = "<div><span style='width: 250px; text-align: right; float: left; padding-right: 5px;'>%s</span> - <span>%s</span></div>";
            echo "<h2><a href='javascript: xoopsToggleDisplay(\"overview\");'>" . _MD_CPANEL_OVERVIEW . " <span id='overview-label'>&laquo;</span></a></h2>";
            echo "<div id='overview'>";
            printf($string_pattern, sprintf(_MD_CPANEL_VERSION, "XOOPS"), XOOPS_VERSION);
            printf($string_pattern, sprintf(_MD_CPANEL_VERSION, "PHP"), PHP_VERSION);
            printf($string_pattern, sprintf(_MD_CPANEL_VERSION, "MySQL"), mysql_get_server_info());
            printf($string_pattern, sprintf(_MD_CPANEL_VERSION, "Server API"), PHP_SAPI);
            printf($string_pattern, sprintf(_MD_CPANEL_VERSION, "OS"), PHP_OS);
            echo "<br />";
            printf($string_pattern, 'safe_mode', ini_get( 'safe_mode' ) ? 'On' : 'Off');
            printf($string_pattern, 'register_globals', ini_get( 'register_globals' ) ? 'On' : 'Off');
            printf($string_pattern, 'magic_quotes_gpc', ini_get( 'magic_quotes_gpc' ) ? 'On' : 'Off');
            printf($string_pattern, 'allow_url_fopen', ini_get( 'allow_url_fopen' ) ? 'On' : 'Off');
            printf($string_pattern, 'fsockopen', function_exists( 'fsockopen' ) ? 'On' : 'Off');
            printf($string_pattern, 'allow_call_time_pass_reference', ini_get( 'allow_call_time_pass_reference' ) ? 'On' : 'Off');
            printf($string_pattern, 'post_max_size', ini_get( 'post_max_size' ));
            printf($string_pattern, 'max_input_time', ini_get( 'max_input_time' ));
            printf($string_pattern, 'output_buffering', ini_get( 'output_buffering' ));
            printf($string_pattern, 'max_execution_time', ini_get( 'max_execution_time' ));
            printf($string_pattern, 'memory_limit', ini_get( 'memory_limit' ));
            printf($string_pattern, 'file_uploads', ini_get( 'file_uploads' ) ? 'On' : 'Off');
            printf($string_pattern, 'upload_max_filesize', ini_get( 'upload_max_filesize' ));
            echo "</div>";

            echo "<h3><a href='javascript: xoopsToggleDisplay(\"extensions\")'>" . _MD_CPANEL_PHPEXTENSIONS . " <span id='extensions-label'>&raquo;</span></a></h3>";
            echo "<div id='extensions' style='display: none; padding-left: 10px;'><ul>";
            $extensions = get_loaded_extensions();
            foreach ($extensions as $ext) {
                echo "<li style='width: 45%; float: left;'>" . $ext . "</li>";
            }
            echo "</ul></div>";
            echo "<br style='clear: both;'>";
        }
        echo"
                  </div><br />
                </td>";

                //"<td width='1%' class='bg_content'></td>";
              echo "</tr>";
              /*
              "<tr>
                <td align='center' colspan='4' class='bg5' height='15'>
                  <table border='0' width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                      <td width='1%'><img src='" . XOOPS_URL . "/modules/system/class/gui/default/images/hbar_left.gif' width='16' height='23' /></td>
                      <td width='98%' class='hbar_middle' align='center'><div class='fontSmall'>Powered by&nbsp;" . XOOPS_VERSION . " &copy; 2001-" . date("Y") . " <a href='http://xoops.sourceforge.net/' rel='external'>The XOOPS Project</a></div></td><td width='1%'><img src='" . XOOPS_URL . "/modules/system/class/gui/default/images/hbar_right.gif' width='10' height='23' /></td>
                    </tr>
                  </table>
                </td>
              </tr>";
              */
        echo "</table>";
        echo "
            </body>
          </html>
        ";
        //echo $GLOBALS['xoopsLogger']->render( '' );
        ob_end_flush();

        XOOPS::registry('frontController')->postDispatch();
    }
}

?>