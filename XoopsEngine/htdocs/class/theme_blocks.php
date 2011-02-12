<?php
/**
 * xos_logos_PageBuilder component class file
 *
 * @copyright   The XOOPS project http://www.xoops.org/
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package      xos_logos
 * @subpackage   xos_logos_PageBuilder
 * @version     $Id: theme_blocks.php 2902 2009-03-05 07:13:07Z phppp $
 * @author       Skalpa Keo <skalpa@xoops.org>
 * @since        2.3.0
 */
/**
 * This file cannot be requested directly
 */
if ( !defined( 'XOOPS_ROOT_PATH' ) )    exit();

include_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
include_once XOOPS_ROOT_PATH . '/class/template.php';

/**
 * xos_logos_PageBuilder main class
 *
 * @package     xos_logos
 * @subpackage  xos_logos_PageBuilder
 * @author      Skalpa Keo
 * @since       2.3.0
 */
class xos_logos_PageBuilder
{

    var $theme = false;

    var $blocks = array();

    function xoInit( $options = array() )
    {
        $this->retrieveBlocks();
        if ( $this->theme ) {
            $this->theme->template->assign_by_ref( 'xoBlocks', $this->blocks );
        }
        return true;
    }

    /**
     * Called before a specific zone is rendered
     */
    function preRender( $zone = '' )
    {
    }
    /**
     * Called after a specific zone is rendered
     */
    function postRender( $zone = '' )
    {
    }

    function retrieveBlocks()
    {
        global $xoopsUser, $xoopsModule, $xoopsConfig;

        $startMod = ( $xoopsConfig['startpage'] == '--' ) ? 'system' : $xoopsConfig['startpage'];
        if ( @is_object( $xoopsModule ) ) {
            list( $mid, $dirname ) = array( $xoopsModule->getVar('mid'), $xoopsModule->getVar('dirname') );
            $isStart = ( substr( $_SERVER['PHP_SELF'], -9 ) == 'index.php' && $xoopsConfig['startpage'] == $dirname );
        } else {
            list( $mid, $dirname ) = array( 0, 'system' );
            $isStart = !@empty( $GLOBALS['xoopsOption']['show_cblock'] );
        }

        $groups = @is_object( $xoopsUser ) ? $xoopsUser->getGroups() : array( XOOPS_GROUP_ANONYMOUS );

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
        foreach ( $oldzones as $zone ) {
            $this->blocks[$zone] = array();
        }
        if ( $this->theme ) {
            $template =& $this->theme->template;
            $backup = array( $template->caching, $template->cache_lifetime );
        } else {
            $template = new XoopsTpl();
        }
        $xoopsblock = new XoopsBlock();
        $block_arr = array();
        $block_arr = $xoopsblock->getAllByGroupModule( $groups, $mid, $isStart, XOOPS_BLOCK_VISIBLE);
        foreach ( $block_arr as $block ) {
            $side = $oldzones[ $block->getVar('side') ];
            if ( $var = $this->buildBlock( $block, $template ) ) {
                $this->blocks[$side][$var["id"]] = $var;
            }
        }
        if ( $this->theme ) {
            list( $template->caching, $template->cache_lifetime ) = $backup;
        }
    }

    function generateCacheId($cache_id)
    {
        if ($this->theme) {
            $cache_id = $this->theme->generateCacheId($cache_id);
        }
        return $cache_id;
    }

    function buildBlock( $xobject, &$template )
    {
        // The lame type workaround will change
        // bid is added temporarily as workaround for specific block manipulation
        $block = array(
            'id'        => $xobject->getVar( 'bid' ),
            'module'    => $xobject->getVar( 'dirname' ),
            'title'     => $xobject->getVar( 'title' ),
            //'name'        => strtolower( preg_replace( '/[^0-9a-zA-Z_]/', '', str_replace( ' ', '_', $xobject->getVar( 'name' ) ) ) ),
            'weight'    => $xobject->getVar( 'weight' ),
            'lastmod'   => $xobject->getVar( 'last_modified' ),
        );

        $xoopsLogger = XoopsLogger::instance();

        $bcachetime = intval( $xobject->getVar('bcachetime') );
        if (empty($bcachetime)) {
            $template->caching = 0;
        } else {
            $template->caching = 2;
            $template->cache_lifetime = $bcachetime;
        }
        $template->setCompileId($xobject->getVar( 'dirname', 'n' ));
        $tplName = ( $tplName = $xobject->getVar('template') ) ? "db:$tplName" : "db:system_block_dummy.html";
        $cacheid = $this->generateCacheId( 'blk_' . $xobject->getVar('bid')/*, $xobject->getVar( 'show_func', 'n' )*/ );

        if ( !$bcachetime || !$template->is_cached( $tplName, $cacheid ) ) {
            $xoopsLogger->addBlock( $xobject->getVar('name') );
            if ( $bresult = $xobject->buildBlock() ) {
                $template->assign( 'block', $bresult );
                $block['content'] = $template->fetch( $tplName, $cacheid );
            } else {
                $block = false;
            }
        } else {
            $xoopsLogger->addBlock( $xobject->getVar('name'), true, $bcachetime );
            $block['content'] = $template->fetch( $tplName, $cacheid );
        }
        $template->setCompileId();
        return $block;
    }
}
?>