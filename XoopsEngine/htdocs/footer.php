<?php
/**
 * XOOPS global footer file
 *
 * See the enclosed file license.txt for licensing information.
 * If you did not receive this file, get it at http://www.fsf.org/copyleft/gpl.html
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU General Public License (GPL)
 * @package     core
 * @since       3.0
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @version     $Id$
 */

class_exists("XOOPS") or die('XOOPS engine is not avilable');

//include_once XOOPS::path('www') . '/include/notification_select.php';

XOOPS::registry('frontController')->postDispatch();
exit();

/**/
XOOPS::registry('viewRenderer')->setNeverRender(false);
XOOPS::registry('viewRenderer')->postDispatch();
$content = ob_get_clean();

$response = XOOPS::registry('frontController')->getResponse();
$response->appendBody($content);
$request = XOOPS::registry('frontController')->getRequest();

$plugin = XOOPS::registry('layout')->plugin;
$plugin->setRequest($request);
$plugin->setResponse($response);
$plugin->postDispatch($request);

$response->sendResponse();
/**/
exit();