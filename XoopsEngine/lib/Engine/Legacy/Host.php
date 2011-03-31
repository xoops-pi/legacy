<?php
/**
 * XOOPS host and path container class
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Xoops Engine http://www.xoopsengine.org/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @package         Xoops_Core
 * @since           3.0
 * @version         $Id$
 */

namespace Engine\Legacy;

class Host extends \Engine\Xoops\Host
{
    /**
     * Constructor
     *
     * @param  array    $hostVars   configurations for virtual hosts or section name in host configuration file: null - to load from configuration file and look up automatically; string - to load rom configuration file with specified section; empty string - to skip host configuration
     * @return void
     */
    public function __construct($hostVars = array())
    {
        parent::__construct($hostVars);

        /**#@+
         * For backward compat
         */
        // Backward compatibility
        defined("XOOPS_PATH") || define("XOOPS_PATH", $this->path('lib'));
        define("XOOPS_URL", $this->url('www'));
        define("XOOPS_ROOT_PATH", $this->path('www'));
        define("XOOPS_VAR_PATH", $this->path('var'));
        define("XOOPS_THEME_PATH", $this->path('www') . '/themes');
        define("XOOPS_THEME_URL", $this->url('www') . '/themes');
        define("XOOPS_UPLOAD_PATH", $this->path('www') . '/uploads');
        define("XOOPS_UPLOAD_URL", $this->url('www') . '/uploads');
        define("XOOPS_COMPILE_PATH", $this->path('var') . '/cache/smarty/compile');
        define("XOOPS_CACHE_PATH", $this->path('var') . '/cache/system');
        /*#@-*/
    }

    /**
     * Build URL
     *
     * @param   array   $params
     * @param   string  $route  route name
     * @param   bool    $reset  Whether or not to reset the route defaults with those provided
     * @return  string  assembled URI
     */
    public function assembleUrl($params = array(), $route = 'legacy', $reset = true, $encode = true)
    {
        $route = $route ?: 'legacy';
        return Xoops::registry("router")->assemble($params, $route, $reset, $encode);
    }
}