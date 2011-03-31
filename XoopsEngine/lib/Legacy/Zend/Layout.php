<?php
/**
 * Zend Framework for Xoops Engine
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
 * @category        Xoops_Zend
 * @package         Layout
 * @version         $Id$
 */

class Legacy_Zend_Layout extends Xoops_Zend_Layout
{
    /**#@+ legacy theme variables */
    /**
     * The name of this theme
     * @var string
     */
    public $folderName = '';

    /**
    * Page construction plug-ins to use
    * @var array
    * @access public
    */
    protected $plugins = array('pagebuilder' => 'Legacy_Pagebuilder');

    /**
     * Physical path of this theme folder
     * @var string
     */
    protected $path = '';
    protected $url = '';
    /** #@- */

    /**
     * Layout theme
     * @var string
     */
    protected $theme = 'legacy';

    /**
     * Helper class
     * @var string
     */
    //protected $_helperClass = 'Xoops_Zend_Layout_Controller_Action_Helper_Layout';

    /**
     * Layout view
     * @var string
     */
    protected $_layout = 'theme';

    /**
     * Plugin class
     * @var string
     */
    //protected $_pluginClass = 'Xoops_Zend_Layout_Controller_Plugin_Layout';

    protected $metaList = array(
            //"doctype"       => "__XOOPS_THEME_DOCTYPE__",
            //"headTitle"     => "__XOOPS_THEME_HEAD_TITLE__",
            //"headMeta"      => "__XOOPS_THEME_HEAD_META__",
            "headLink"      => "__XOOPS_THEME_HEAD_LINK__",
            "headScript"    => "__XOOPS_THEME_HEAD_SCRIPT__",
            "headStyle"     => "__XOOPS_THEME_HEAD_STYLE__",
    );

    /**
     * Constructor
     *
     * Accepts either:
     * - A string path to layouts
     * - An array of options
     * - A Zend_Config object with options
     *
     * Layout script path, either as argument or as key in options, is
     * required.
     *
     * If mvcEnabled flag is false from options, simply sets layout script path.
     * Otherwise, also instantiates and registers action helper and controller
     * plugin.
     *
     * @param  string|array|Zend_Config $options
     * @return void
     */
    public function ______construct($options = null, $initMvc = false)
    {
        if (null !== $options) {
            if (is_string($options)) {
                $this->setTheme($options);
            } elseif (is_array($options)) {
                $this->setOptions($options);
            } elseif ($options instanceof Zend_Config) {
                $this->setConfig($options);
            } else {
                //require_once 'Zend/Layout/Exception.php';
                throw new Zend_Layout_Exception('Invalid option provided to constructor');
            }
        }

        $this->_initVarContainer();

        if ($initMvc) {
            $this->_setMvcEnabled(true);
            $this->_initMvc();
        } else {
            $this->_setMvcEnabled(false);
        }
    }

    /**
     * Static method for initialization with MVC support
     *
     * @param  string|array|Zend_Config $options
     * @return Zend_Layout
     */
    public static function ____startMvc($options = null)
    {
        if (null === self::$_mvcInstance) {
            self::$_mvcInstance = new self($options, true);
        } else {
            if (is_string($options)) {
                self::$_mvcInstance->setLayoutPath($options);
            } elseif (is_array($options) || $options instanceof Zend_Config) {
                self::$_mvcInstance->setOptions($options);
            }
        }

        return self::$_mvcInstance;
    }

    /**
     * Initialize front controller plugin
     *
     * @return void
     */
    protected function _____initPlugin()
    {
        $pluginClass = $this->getPluginClass();
        $plugin = new $pluginClass($this);

        if ($this->plugin === true) {
            $this->plugin = $plugin;
            return;
        } else {
            $this->plugin = $plugin;
        }
        $front = Zend_Controller_Front::getInstance();
        if (!$front->hasPlugin($pluginClass)) {
            $front->registerPlugin(
                // register to run last | BUT before the ErrorHandler (if its available)
                $plugin,
                99
           );
        }
    }

    /**
     * Initialize action helper
     *
     * @return void
     */
    protected function _____initHelper()
    {
        $helperClass = $this->getHelperClass();
        if (!Zend_Controller_Action_HelperBroker::hasHelper('layout')) {
            $this->helper = new $helperClass($this);
            Zend_Controller_Action_HelperBroker::getStack()->offsetSet(-90, $this->helper);
        } else {
            $this->helper = Zend_Controller_Action_HelperBroker::getHelper('layout');
        }
    }

    /**
     * Initialize placeholder container for layout vars
     *
     * @return Zend_View_Helper_Placeholder_Container
     */
    protected function _____initVarContainer()
    {
        if (null === $this->_container) {
            $this->_container = array();
        }

        return $this->_container;
    }

    /**
     * Set flag for block render
     *
     * @param  boolean $enable
     * @return Zend_Layout
     */
    public function ____setBlock($enable)
    {
        $this->_blockRender = (bool) $enable;
        return $this;
    }

    /**
     * Set navigation section
     *
     * @param  bool|string $section
     * @return Zend_Layout
     */
    public function ____setNavigation($section)
    {
        /*
        if (empty($section)) {
            $this->loader["navigation"] = false;
        }
        */
        $this->navigation = $section;
        return $this;
    }

    /**
     * Set layout script to use
     *
     * Note: enables layout by default, can be disabled
     *
     * @param  string $name
     * @param  boolean $enabled
     * @return Zend_Layout
     */
    public function ____setLayout($name, $enabled = true)
    {
        parent::setLayout($name, $enabled);
        return $this;
    }

    public function ____getViewScriptPath()
    {
        if (empty($this->_viewScriptPath)) {
            $this->_viewScriptPath = "theme/" . $this->theme;
        }

        return $this->_viewScriptPath;
    }


    /**
     * Assign one or more layout variables
     *
     * @param  mixed $spec Assoc array or string key; if assoc array, sets each
     * key as a layout variable
     * @param  mixed $value Value if $spec is a key
     * @return Zend_Layout
     * @throws Zend_Layout_Exception if non-array/string value passed to $spec
     */
    public function ____assign($spec, $value = null)
    {
        if (is_array($spec)) {
            $this->_container = array_merge($this->_container, $spec);
            /*
            $orig = $this->_container->getArrayCopy();
            $merged = array_merge($orig, $spec);
            $this->_container->exchangeArray($merged);
            */
            return $this;
        }

        if (is_string($spec)) {
            //$this->getView()->getEngine()->append("layout", $spec);
            if (empty($this->_container[$spec])) {
                $this->_container[$spec] = $value;
            } else {
                $this->_container[$spec] .= $value;
            }
            return $this;
        }

        //require_once 'Zend/Layout/Exception.php';
        throw new Zend_Layout_Exception('Invalid values passed to assign()');
    }

    /**
     * Render layout
     *
     * Sets internal script path as last path on script path stack, assigns
     * layout variables to view, determines layout name using inflector, and
     * renders layout view script.
     *
     * $name will be passed to the inflector as the key 'script'.
     *
     * @param  mixed $name  layout or template to render
     * @return mixed
     */
    public function render($name = null)
    {
        static $registered;
        // Load locale translation
        //XOOPS::service('translate')->loadTranslation("main", "theme:" . $this->theme);

        $template = $this->getView()->getEngine();
        $template->caching = 0;
        $template->setCacheId();
        $template->setCompileId($this->theme);
        $template->assign($this->_container);
        $template->template_dir = array(
            XOOPS::path("theme") . "/" . $this->theme,
            XOOPS::path("theme"),
        );
        //$template->assign($this->metaList);

        if (!$registered) {
            //$template->register_function("blocks", array($this, "loadBlocks"));
            $template->register_function("navigation", array($this, "loadNavigation"));
            $template->register_outputfilter(array($this, "loadHead"));

            $this->folderName = $this->theme;
            $this->path = Xoops::path('theme') . '/' . $this->theme;
            $this->url = Xoops::path('url') . '/' . $this->theme;
            $template->assign_by_ref('xoTheme', $this);

            $registered = true;
        }

        $name = !is_null($name) ? $name : $this->getLayout();
        //$path = is_file($name) ? $name : "theme/" . $name . "." . $this->getViewSuffix();
        $path = is_file($name) ? $name : $name . "." . $this->getViewSuffix();
        return $template->fetch($path);
    }

    public function ____setTheme($theme = "default")
    {
        /*
        if ("default" != $theme) {
            if (!array_key_exists($theme, XOOPS::service("registry")->theme->read())) {
                return $this;
            }
        }
        */

        $this->theme = $theme;
        return $this;
    }

    public function ____getTheme()
    {
        return $this->theme;
    }

    public function ____setCache($options)
    {
        $this->cacheOptions = $options;
    }

    /**
     * Load cache object
     *
     * @return Xoops_Zend_Cache
     */
    public function ____cache()
    {
        if (!is_object($this->cache)) {
            $this->cache = XOOPS::registry('cache');
        }
        return $this->cache;
    }

    /**
     * Set page cache level
     *
     * @param   string  $level  potential values: user, role, language, public by default
     * @return  void
     */
    public function ____cacheLevel($level = null)
    {
        if (!is_null($level)) {
            $this->cacheLevel = $level;
        }
        return $this->cacheLevel;
    }

    /**
     * Skip page cache
     *
     * @return  void
     */
    public function ____skipCache($flag = true)
    {
        $this->skipCache = (bool) $flag;
    }

    /**
     * Set plugin
     *
     * @param  array    $options
     * @return Zend_Layout
     */
    public function ____setPlugin($options)
    {
        if (!empty($options['class'])) {
            $this->setPluginClass($options['class']);
        }
        if (isset($options['register'])) {
            $this->plugin = empty($options['register']) ? true : false;
        }
    }

    public function ____assemble($request)
    {
        if ($request->isXmlHttpRequest() || $request->isFlashRequest()) {
            $this->setLayout("empty");
        } elseif (!$this->getLayout()) {
            $this->setLayout("layout");
        }

        // Assemble various contents
        $fullContent = $this->render();

        return $fullContent;
    }

    /**
     * Initialize view variables
     *
     * @return void
     */
    public function initView()
    {
        global $xoopsUser, $xoopsConfig, $xoopsModule;
        $template = $this->getView()->getEngine();

        /**#@+
         * Legacy data
         */
        $variables = array();
        // User data
        if (isset($xoopsUser)) {
            $variables += array(
                'xoops_isuser'  => true,
                'xoops_userid'  => $xoopsUser->getVar('uid'),
                'xoops_uname'   => $xoopsUser->getVar('uname'),
                'xoops_isadmin' => $xoopsUser->isAdmin()
            );
        } else {
            $variables += array(
                'xoops_isuser'  => false,
                'xoops_isadmin' => false
            );
        }

        // Site data
        $variables += array(
            'xoops_url'         => XOOPS::url('www'),
            'xoops_rootpath'    => XOOPS::path('www'),
            'xoops_langcode'    => XOOPS::config('language'),
            'xoops_upload_url'  => XOOPS::url('upload'),
            'xoops_sitename'    => htmlspecialchars(XOOPS::config('sitename'), ENT_QUOTES),
            'xoops_dirname'     => isset($xoopsModule) ? $xoopsModule->getVar('dirname') : 'system',
        );
        foreach ($variables as $key => $val) {
            $template->assign($key, $val);
        }
        /**#@-*/

        $this->loadMeta();

        //$this->getView()->doctype('XHTML1_TRANSITIONAL');
    }

    protected function initHead()
    {
        global $xoopsModule, $xoopsOptions;
        $view = $this->getView();
        //$view->doctype('XHTML1_TRANSITIONAL');

        // Page meta tags
        $headMeta = array();
        $config = XOOPS::service('registry')->config->read('', "meta");
        foreach ($config as $key => $value) {
            $headMeta["xoops_" . $key] = $value;
            /*
            if (substr($key, 0, 5) == "meta_") {
                $name = substr($key, 5);
                $view->headMeta()->appendName($name, $value);
            } else {
                $headMeta["xoops_" . $key] = $value;
                //$this->assign("xoops_" . $key, $value);
            }
            */
        }

        /*
        $view->headMeta()->appendName("generator", "XOOPS");
        $view->headMeta()->appendHttpEquiv("content-language", XOOPS::config('language'));
        $view->headMeta()->appendHttpEquiv("content-type", "text/html; charset=" . XOOPS::config('charset'));

        $view->headTitle()->setSeparator(" - ");
        // "xoops_pagetitle" is deprecated, for backward compat only
        if (!empty($xoopsOptions['xoops_pagetitle'])) {
            $view->headTitle($xoopsOptions['xoops_pagetitle']);
        } elseif (isset($xoopsModule)) {
            $view->headTitle($xoopsModule->getVar('name'));
        } else {
            $view->headTitle(XOOPS::config('slogan'));
        }
        // Append site name to head title
        $view->headTitle(XOOPS::config('sitename'));
        $headMeta["xoops_pagetitle"] = (string) $view->headTitle();

        $view->headLink()->prependStylesheet("theme/" . $this->theme . "/style.css", "all");
        $view->headLink()->prependStylesheet("xoops.css", "all");
        $view->headLink()->appendAlternate("backend.php", "application/rss+xml", "XOOPS feed");
        $view->headLink(array(
            "rel"   => "favicon",
            "type"  => "image/ico",
            "href"  => "favicon.ico"
        ));

        $view->headScript()->prependFile("include/xoops.js");
        */


        $pagetitle = array();
        if (!empty($xoopsOptions['xoops_pagetitle'])) {
            $pagetitle[] = $xoopsOptions['xoops_pagetitle'];
        } elseif (isset($xoopsModule)) {
            $pagetitle[] = $xoopsModule->getVar('name');
        } else {
            $pagetitle[] = XOOPS::config('slogan');
        }
        // Append site name to head title
        $pagetitle[] = XOOPS::config('sitename');
        $headMeta["xoops_pagetitle"] = implode(' - ', $pagetitle);

        // "xoops_module_header" is deprecated, for backward compat only
        if (XOOPS::registry('xoops_module_header')) {
            $headMeta["xoops_module_header"] = XOOPS::registry('xoops_module_header');
        }
        return $headMeta;
    }

    public function loadHead($data, $complier, $template = null)
    {
        $view = $this->getView();
        $meta = '';
        foreach ($this->metaList as $func => $tag) {
            $meta .= $view->$func();
        }
        if (!empty($meta)) {
            $pos = strpos($data, '</head>');
            $data = substr($data, 0, $pos) . $meta . substr($data, $pos);
        }
        return $data;
    }

    private function ____loadMeta()
    {
        if ($cache = $this->getCacheInfo()) {
            $cacheKey = "meta_{$cache['cache_id']}";
            if (!empty($cache['expire'])) {
                $metaCache = $this->cache()->read($cacheKey);
            }
        }
        $meta = $this->initHead();
        if (!empty($metaCache)) {
            $meta = array_merge($metaCache, $meta);
            XOOPS::service('logger')->log("Meta is cached", 'debug');
        } elseif ($cache) {
            $cacheKey = "meta_{$cache['cache_id']}";
            $this->cache()->write($meta, $cacheKey, $cache['expire']);
        }

        $this->assign($meta);
    }

    public function loadNavigation($params = null, $smarty = null, $template = null)
    {
        /*
        if (empty($params["assign"])) {
            return false;
        }
        */
        if (empty($this->navigation)) {
            return;
        }

        if ($cache = $this->getCacheInfo()) {
            $cacheKey = "navigation_{$cache['cache_id']}";
            if (!empty($cache['expire'])) {
                //$navigation = $this->cache()->read($cacheKey, 'role');
                $navigation = $this->cache()->read($cacheKey);
            }
        }
        if (empty($navigation)) {
            $view = $this->getView();
            //$request = XOOPS::registry("frontController")->getRequest();
            $module = isset($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : '';
            $config = XOOPS::service("registry")->navigation->read($this->navigation, $module);
            $container = new Xoops_Zend_Navigation($config);
            $view->navigation($container);
            $ulClass = empty($params["ulClass"]) ? 'jd_menu' : $params["ulClass"];
            $navigation = array(
                "menu"          => $view->navigation()->menu()->setUlClass($ulClass)->render(),
                "breadcrumbs"   => $view->navigation()->breadcrumbs()->setMinDepth(0)->setLinkLast(false)->render()
            );
            if ($cache) {
                //$this->cache()->write($navigation, $cacheKey, $cache['expire'], 'role');
                $this->cache()->write($navigation, $cacheKey, $cache['expire']);
            }
        } else {
            XOOPS::service('logger')->log("Navigation is cached", 'debug');
        }
        if (empty($params["assign"])) {
            return $navigation;
        }
        $template = isset($template) ?: $smarty;
        $template->assign($params["assign"], $navigation);
        return;
    }

    public function loadBlocks($params, $smarty, $template)
    {
        if (empty($params["assign"])) {
            return false;
        }
        $request = XOOPS::registry("frontController")->getRequest();
        $blocks = $this->getView()->blocks($request);
        $template->assign($params["assign"], $blocks);
        return;
    }


    /**
     * Return a web resource file path
     *
     * Path options:
     * theme/, module/, app/, www/apps
     *
     * @param string $path
     * @return string
     */
    public function ____resourcePath($path, $isAbsolute = false)
    {
        // themes/themeName/modules/moduleName/templates/template.html, themes/themeName/app/moduleName/templates/template.html
        // themes/themeName/modules/moduleName/module.js, themes/themeName/app/moduleName/app.js
        // themes/themeName/modules/moduleName/images/img.png, themes/themeName/app/moduleName/images/img.png

        // File name prepended with resource type, for db:file.name, file:file.name or app:file.name
        // Or full path under WIN: C:\Path\To\Template
        // Return directly
        if (!empty($path) && false !== strpos($path, ":")) {
            return $path;
        }

        $path       = trim($path, "/");
        $section    = "";
        $module     = "";
        $append     = "";
        $segs = explode("/", $path, 2);
        $section = $segs[0];
        if (!empty($segs[1])) {
            $append = $segs[1];
        }
        if (isset(static::$paths[$section])) {
            $sectionPath = (empty(static::$paths[$section]) ? "" : static::$paths[$section] . "/") . $append;
        } else {
            $sectionPath = $path;
        }
        $theme_path = XOOPS::path("theme") . "/{$this->theme}/{$sectionPath}";
        // Found in theme
        if (file_exists($theme_path)) {
            return $isAbsolute ? $theme_path : "theme/{$this->theme}/{$sectionPath}";
        }
        // Check for application resource path
        if ("app" == $section && !empty($append)) {
            $app_resource_path = XOOPS::path("www/apps") . "/" . $append;
            // Found in www/apps
            if (file_exists($app_resource_path)) {
                return $isAbsolute ? $app_resource_path : "www/apps/" . $append;
            }
            $segs = explode("/", $append, 2);
            $module = $segs[0];
            $dirname = Xoops::service('module')->getDirectory($module);
            // Check parent in www/apps
            if ($dirname && strcmp($dirname, $module)) {
                $parent_append = $dirname . (empty($segs[1]) ? "" : "/" . $segs[1]);
                $parent_resource_path = XOOPS::path("www/apps") . "/" . $parent_append;
                // Found parent in www/apps
                if (file_exists($parent_resource_path)) {
                    return $isAbsolute ? $parent_resource_path : "www/apps/" . $parent_append;
                }
                // Return parent original file
                return $isAbsolute ? XOOPS::path("app/" . $parent_append) : "app/" . $parent_append;
            // Check original, actually not necessary
            } else {
            }
        }
        // Check for plugin resource path
        if ("plugin" == $section && !empty($append)) {
            $plugin_resource_path = XOOPS::path("www/plugins") . "/" . $append;
            // Found in www/plugins
            if (file_exists($app_resource_path)) {
                return $isAbsolute ? $app_resource_path : "www/plugins/" . $append;
            }
            // Return original file
            return $isAbsolute ? XOOPS::path("plugin/" . $append) : "plugin/" . $append;
        }

        return false;
    }

    /**
     * Load content from response container
     *
     * @param  Zend_Controller_Response_Abstract $response
     * @retrun boolean
     */
    public function ____setContent($response)
    {
        $content = $response->getBody(true);
        $response->clearBody();
        $contentKey = $this->getContentKey();
        $extensionKey = $this->getExtensionKey();

        if (isset($content['default'])) {
            $content[$contentKey] = $content['default'];
        }
        if (isset($content[$extensionKey])) {
            $content[$contentKey] .= $content[$extensionKey];
        }
        if ('default' != $contentKey) {
            unset($content['default']);
        }
        $this->assign($content);

        return true;

        $template = $this->getView()->getEngine();
        $cache = array('template' => $template->currentTemplate);

        return $cache;
    }

    public function ____setCacheInfo($info)
    {
        $this->cacheInfo = $info;
    }

    public function ____getCacheInfo()
    {
        if (!isset($this->cacheInfo) && $this->plugin) {
            $this->cacheInfo = $this->plugin->loadCacheInfo();
        }

        return $this->cacheInfo;
    }

    /**
     * Set extension key
     *
     * Key in namespace container denoting extension content
     *
     * @param  string $extensionKey
     * @return Zend_Layout
     */
    public function ____setExtensionKey($extensionKey)
    {
        $this->_extensionKey = (string) $extensionKey;
        return $this;
    }

    /**
     * Retrieve extension key
     *
     * @return string
     */
    public function ____getExtensionKey()
    {
        return $this->_extensionKey;
    }

    /** #@+ Legacy theme methods */
    public function loadPlugins()
    {
        foreach ($this->plugins as $key => $plugin) {
            if (!is_object($plugin)) {
                $plugin = new $plugin($this);
            }
            $plugin->init();
        }

        return $this;
    }

    public function setPlugins($plugins = array())
    {
        $this->plugins = $plugins;
        return $this;
    }

    /**
     * Load theme specific language constants
     *
     * @param string    $type       language type, like 'main', 'admin'; Needs to be declared in theme xo-info.php
     * @param string    $language   specific language
     */
    public function addLanguage($type = "main", $language = null)
    {
        return Xoops::service('translate')->loadTranslation($type, 'theme:' . $this->theme, $language);
    }

    public function addScript($src = '', $attributes = array(), $content = '')
    {
        $this->getView()->addScript($src, $attributes, $content);
        return;
    }

    /**
     * Add StyleSheet or CSS code to the document head
     * @param string $src path to .css file
     * @param array $attributes name => value paired array of attributes such as title
     * @param string $content CSS code to output between the <style> tags (in case $src is empty)
     *
     * @return void
     */
    public function addStylesheet($src = '', $attributes = array(), $content = '')
    {
        $this->getView()->addStylesheet($src, $attributes, $content);
        return;
    }

    /**
      * Add a <link> to the header
      * @param string    $rel        Relationship from the current doc to the anchored one
      * @param string    $href        URI of the anchored document
      * @param array        $attributes    Additional attributes to add to the <link> element
      */
    public function addLink($rel, $href = '', $attributes = array())
    {
        $this->getView()->addLink($rel, $href, $attributes);
        return;
    }

    /**
     * Set a meta http-equiv value
     */
    public function addHttpMeta($name, $value = null)
    {
        if (isset($value)) {
            return $this->addMeta('http', $name, $value);
        }
    }

    /**
     * Change output page meta-information
     */
    public function addMeta($type = 'meta', $name = '', $value = '')
    {
        $this->getView()->addMeta($type, $name, $value);
        return;
    }
    /** #@- */
}