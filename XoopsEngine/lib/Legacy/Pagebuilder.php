<?php
/**
 * XOOPS legacy page builder
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Xoops Engine http://www.xoopsengine.org
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @since           3.0
 * @package         Legacy
 * @version         $Id$
 */

/**
 * Legacy_PageBuilder component class file
 *
 * @copyright       The XOOPS project http://www.xoops.org/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @version         $Id: theme_blocks.php 2902 2009-03-05 07:13:07Z phppp $
 * @author          Skalpa Keo <skalpa@xoops.org>
 * @since           2.3.0
 */
if (!defined('XOOPS_ROOT_PATH'))    exit();

include_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';

class Legacy_Pagebuilder
{
    protected $theme;

    var $blocks = array();

    public function __construct($theme = null)
    {
        $this->theme = $theme;
    }

    public function getTemplate()
    {
        return $this->theme->getView()->getEngine();
    }

    public function init($options = array())
    {
        $this->retrieveBlocks();
        $this->getTemplate()->assign_by_ref('xoBlocks', $this->blocks);
        return true;
    }

    function retrieveBlocks()
    {
        global $xoopsUser, $xoopsModule, $xoopsConfig;

        $startMod = ($xoopsConfig['startpage'] == '--') ? 'system' : $xoopsConfig['startpage'];
        if (@is_object($xoopsModule)) {
            list($mid, $dirname) = array($xoopsModule->getVar('mid'), $xoopsModule->getVar('dirname'));
            $isStart = (substr($_SERVER['PHP_SELF'], -9) == 'index.php' && $xoopsConfig['startpage'] == $dirname);
        } else {
            list($mid, $dirname) = array(0, 'system');
            $isStart = !empty($GLOBALS['xoopsOption']['show_cblock']);
        }

        $groups = isset($xoopsUser) && is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);

        $oldzones = array(
            XOOPS_SIDEBLOCK_LEFT                => 'canvas_left',
            XOOPS_SIDEBLOCK_RIGHT               => 'canvas_right',
            XOOPS_CENTERBLOCK_LEFT              => 'page_topleft',
            XOOPS_CENTERBLOCK_CENTER            => 'page_topcenter',
            XOOPS_CENTERBLOCK_RIGHT             => 'page_topright',
            XOOPS_CENTERBLOCK_BOTTOMLEFT        => 'page_bottomleft',
            XOOPS_CENTERBLOCK_BOTTOM            => 'page_bottomcenter',
            XOOPS_CENTERBLOCK_BOTTOMRIGHT       => 'page_bottomright',
       );
        foreach ($oldzones as $zone) {
            $this->blocks[$zone] = array();
        }
        $template = $this->getTemplate();
        /*
        if ($this->theme) {
            $template = $this->theme->template;
        } else {
            $template = new Legacy_Smarty_Engine();
        }
        */
        $backup = array($template->caching, $template->cache_lifetime);
        $xoopsblock = new XoopsBlock();
        $block_arr = array();
        $block_arr = $xoopsblock->getAllByGroupModule($groups, $mid, $isStart, XOOPS_BLOCK_VISIBLE);
        foreach ($block_arr as $block) {
            $side = $oldzones[ $block->getVar('side') ];
            if ($var = $this->buildBlock($block, $template)) {
                $this->blocks[$side][$var["id"]] = $var;
            }
        }
        list($template->caching, $template->cache_lifetime) = $backup;
        $template->assign('xoops_showlblock', !empty($this->blocks['canvas_left']));
        $template->assign('xoops_showrblock', !empty($this->blocks['canvas_right']));
    }

    function generateCacheId($cache_id)
    {
        if ($this->theme) {
            $cache_id = $this->theme->generateCacheId($cache_id);
        }
        return $cache_id;
    }

    function buildBlock($xobject, &$template)
    {
        // The lame type workaround will change
        // bid is added temporarily as workaround for specific block manipulation
        $block = array(
            'id'        => $xobject->getVar('bid'),
            'module'    => $xobject->getVar('dirname'),
            'title'     => $xobject->getVar('title'),
            //'name'        => strtolower(preg_replace('/[^0-9a-zA-Z_]/', '', str_replace(' ', '_', $xobject->getVar('name')))),
            'weight'    => $xobject->getVar('weight'),
            'lastmod'   => $xobject->getVar('last_modified'),
       );

        $xoopsLogger = XoopsLogger::instance();

        $bcachetime = intval($xobject->getVar('bcachetime'));
        if (empty($bcachetime)) {
            $template->caching = 0;
        } else {
            $template->caching = 2;
            $template->cache_lifetime = $bcachetime;
        }
        $template->setCompileId($xobject->getVar('dirname', 'n'));
        $tplName = ($tplName = $xobject->getVar('template')) ? 'db:' . $tplName : "db:legacy/block_dummy.html";
        $cacheid = $this->generateCacheId('blk_' . $xobject->getVar('bid')/*, $xobject->getVar('show_func', 'n')*/);

        if (!$bcachetime || !$template->is_cached($tplName, $cacheid)) {
            $xoopsLogger->addBlock($xobject->getVar('name'));
            if ($bresult = $xobject->buildBlock()) {
                $template->assign('block', $bresult);
                $block['content'] = $template->fetch($tplName, $cacheid);
            } else {
                $block = false;
            }
        } else {
            $xoopsLogger->addBlock($xobject->getVar('name'), true, $bcachetime);
            $block['content'] = $template->fetch($tplName, $cacheid);
        }
        $template->setCompileId();
        return $block;
    }
}