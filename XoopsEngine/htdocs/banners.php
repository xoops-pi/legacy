<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code 
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XOOPS Banner management file
 *
 * The relevant functionality will be re-designed in XOOPS 3.0
 *
 * @copyright   The Xoops project http://www.xoops.org/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Kazumi Ono <webmaster@myweb.ne.jp>
 * @author      Taiwen Jiang <phppp@users.sourceforge.net>
 * @author      DuGris aka L. Jen <http://www.dugris.info>
 * @author      Kris <kris@frxoops.org>
 * @since       2.0
 * @version     $Id: banners.php 1529 2008-05-01 08:14:55Z phppp $
 */

$xoopsOption['pagetype'] = "banners";

include "mainfile.php";

/********************************************/
/* Function to let your client login to see */
/* the stats                                */
/********************************************/
function clientlogin()
{
    global $xoopsDB, $xoopsLogger, $xoopsConfig;
    include "header.php";
    $GLOBALS["xoTheme"]->addStylesheet(null, null, '
        #login_window  {
            max-width:                          480px;
            margin:                             1em auto;
            background-color:                   #f8f8f8;
            color:                              inherit;
            border:                             1px solid #000;
        }
        #login_window  h2 {
            margin:                             .5em;
            padding:                            130px 0 0;
            background:                         url( images/password.png) no-repeat center top;
            text-align:                         center;
        }
        .login_form  .credentials {
            margin:                             .5em 1em;
            padding:                            1em;
            background-color:                   #ccc;
            color:                              inherit;
        }
        .login_form  .credentials label {
            display:                            inline-block;
            width:                              33%;
            margin:                             1px;
        }
        .login_form  .credentials input {
            width:                              50%;
            margin:                             1px;
            padding:                            1px;
            border:                             1px solid #000;
        }
        .login_form  .credentials input:focus {
            border:                             1px solid #2266cc;
        }
        .login_form  .actions {
            padding:                            1.5em .5em .5em;
            text-align:                         center;
        }
        .login_info {
            margin:                             .5em 1em;
            text-align:                         center;
        }
        .content_title {
            font-size:                          1.2em;
        }
    ');
    echo "<div id='login_window'>
          <h2 class='content_title'>"._BANNERS_LOGIN_TITLE."</h2>
          <form method='post' action='banners.php' class='login_form'>
          <div class='credentials'>
          <label for='login_form-login'>"._BANNERS_LOGIN_LOGIN."</label>
          <input type='text' name='login' id='login_form-login' value='' /><br />
          <label for='login_form-password'>"._BANNERS_LOGIN_PASS."</label>
          <input type='password' name='pass' id='login_form-password' value='' /><br />
          </div>
          <div class='actions'><input type='hidden' name='op' value='Ok' /><button type='submit'>"._BANNERS_LOGIN_OK."</button></div>
          <div class='login_info'>"._BANNERS_LOGIN_INFO."</div>".
          $GLOBALS['xoopsSecurity']->getTokenHTML("BANNER_LOGIN")."
          </form></div>";
    include "footer.php";
}

/*********************************************/
/* Function to display the banners stats for */
/* each client                               */
/*********************************************/
function bannerstats()
{
    global $xoopsDB, $xoopsConfig, $xoopsLogger;
    if ($_SESSION['banner_login'] == "" || $_SESSION['banner_pass'] == "") {
        redirect_header("banners.php", 2, 'No login data detected');
        exit();
    }
    $result = $xoopsDB->query(sprintf("SELECT cid, name, passwd FROM %s WHERE login=%s", $xoopsDB->prefix("bannerclient"), $xoopsDB->quoteString($_SESSION['banner_login'])));
    list($cid, $name, $passwd) = $xoopsDB->fetchRow($result);
    if ( $_SESSION['banner_pass'] == $passwd ) {
        include "header.php";
        $GLOBALS["xoTheme"]->addStylesheet(null, null, '
            #bannerstats {}
            #bannerstats td {
                text-align: center;
            }
        ');

        echo "<div id='bannerstats'>
              <h4 class='content_title'>".sprintf( _BANNERS_TITLE , $name )."</h4><hr />
              <table summary=''>
              <caption>".sprintf( _BANNERS_TITLE , $name )."</caption>
              <thead><tr>
              <td>ID</td>
              <td>"._BANNERS_IMP_MADE."</td>
              <td>"._BANNERS_IMP_TOTAL."</td>
              <td>"._BANNERS_IMP_LEFT."</td>
              <td>"._BANNERS_CLICKS."</td>
              <td>"._BANNERS_PER_CLICKS."</td>
              <td>"._BANNERS_FUNCTIONS."</td></tr></thead>
              <tfoot><tr><td colspan='7'></td></tr></tfoot>";

        $result = $xoopsDB->query("select bid, imptotal, impmade, clicks, date from ".$xoopsDB->prefix("banner")." where cid=$cid");
        $i = 0;
        while ( list($bid, $imptotal, $impmade, $clicks, $date) = $xoopsDB->fetchRow($result) ) {
            if ( $impmade == 0 ) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
            }
            if ( $imptotal == 0 ) {
                $left = _BANNERS_UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            $class = ($i % 2 == 0) ? 'even' : 'odd';
            echo "<tbody><tr class='$class'>
                  <td>$bid</td>
                  <td>$impmade</td>
                  <td>$imptotal</td>
                  <td>$left</td>
                  <td>$clicks</td>
                  <td>$percent%</td>
                  <td><a href='banners.php?op=EmailStats&amp;cid=$cid&amp;bid=$bid' title='" . _BANNERS_STATS . "'>" . _BANNERS_STATS . "</a></td></tr></tbody>";
            $i++;
        }
        echo "</table>
              <br /><br />
              <h4 class='content_title'>". _BANNERS_FOW_IN . htmlspecialchars( $xoopsConfig['sitename'] ). "</h4><hr />";

        $result = $xoopsDB->query("select bid, imageurl, clickurl, htmlbanner, htmlcode from ".$xoopsDB->prefix("banner")." where cid=$cid");
        while ( list($bid, $imageurl, $clickurl,$htmlbanner, $htmlcode) = $xoopsDB->fetchRow($result) ) {
            $numrows = $xoopsDB->getRowsNum($result);
            if ($numrows>1) {
                echo "<br />";
            }
            if (!empty($htmlbanner) && !empty($htmlcode)) {
                echo $myts->displayTarea($htmlcode);
            } else {
                if (strtolower(substr($imageurl, strrpos($imageurl, "."))) == ".swf") {
                    echo "<object type='application/x-shockwave-flash' width='468' height='60' data='{$imageurl}'>";
                    echo "<param name='movie' value='{$imageurl}' />";
                    echo "<param name='quality' value='high' />";
                    echo "</object>";
                } else {
                    echo "<img src='$imageurl' alt='' />";
                }
            }
            echo "<br /><strong>" . _BANNERS_ID . $bid . "</strong><br />" .
            sprintf(_BANNERS_SEND_STATS, 'banners.php?op=EmailStats&amp;cid='.$cid.'&amp;bid='.$bid) . "<br />";
            if (!$htmlbanner) {
                $clickurl = htmlspecialchars($clickurl, ENT_QUOTES);
                echo sprintf(_BANNERS_POINTS, $clickurl) . "<br />
                <form action='banners.php' method='post'>". _BANNERS_URL . "
                <input type='text' name='url' size='50' maxlength='200' value='$clickurl' />
                <input type='hidden' name='bid' value='$bid' />
                <input type='hidden' name='cid' value='$cid' />
                <input type='submit' name='op' value='". _BANNERS_CHANGE ."' />" .
                $GLOBALS['xoopsSecurity']->getTokenHTML("BANNER_EDIT") . "</form>";
            }
        }

        /* Finnished Banners */
        echo "<br />";
        if($result = $xoopsDB->query("select bid, impressions, clicks, datestart, dateend from ".$xoopsDB->prefix("bannerfinish")." where cid=$cid")) {
            echo "<h4 class='content_title'>" . sprintf(_BANNERS_FINISHED, $name) . "</h4><hr />
                  <table summary=''>
                  <caption>" . sprintf(_BANNERS_FINISHED, $name) . "</caption>
                  <thead><tr>
                  <td>ID</td>
                  <td>"._BANNERS_IMP_MADE."</td>
                  <td>"._BANNERS_CLICKS."</td>
                  <td>"._BANNERS_PER_CLICKS."</td>
                  <td>"._BANNERS_STARTED."</td>
                  <td>"._BANNERS_ENDED."</td></tr></thead>
                  <tfoot><tr><td colspan='6'></td></tr></tfoot>";

            $i=0;
            while ( list($bid, $impressions, $clicks, $datestart, $dateend) = $xoopsDB->fetchRow($result) ) {
                $percent = substr(100 * $clicks / $impressions, 0, 5);
                $class = ($i % 2 == 0) ? 'even' : 'odd';
                echo "<tbody><tr class='$class'>
                      <td>$bid</td>
                      <td>$impressions</td>
                      <td>$clicks</td>
                      <td>$percent%</td>
                      <td>".formatTimestamp($datestart)."</td>
                      <td>".formatTimestamp($dateend)."</td></tr></tbody>";
            }
            echo "</table></div>";
        }
        include "footer.php";
    } else {
        redirect_header("banners.php",2);
        exit();
    }
}

/*********************************************/
/* Function to let the client E-mail his     */
/* banner Stats                              */
/*********************************************/
function EmailStats($cid, $bid)
{
    global $xoopsDB, $xoopsConfig;
    if ($_SESSION['banner_login'] != "" && $_SESSION['banner_pass'] != "") {
        $cid = intval($cid);
        $bid = intval($bid);
        if ($result2 = $xoopsDB->query(sprintf("select name, email, passwd from %s where cid=%u AND login=%s", $xoopsDB->prefix("bannerclient"), $cid, $xoopsDB->quoteString($_SESSION['banner_login'])))) {
            list($name, $email, $passwd) = $xoopsDB->fetchRow($result2);
            if ($_SESSION['banner_pass'] == $passwd) {
                if ($email == "") {
                    redirect_header("banners.php", 3, sprintf( _BANNERS_MAIL_ERROR, $name) );
                    exit();
                } else {
                    if ($result = $xoopsDB->query("select bid, imptotal, impmade, clicks, imageurl, clickurl, date from ".$xoopsDB->prefix("banner")." where bid=$bid and cid=$cid")) {
                        list($bid, $imptotal, $impmade, $clicks, $imageurl, $clickurl, $date) = $xoopsDB->fetchRow($result);
                        if ( $impmade == 0 ) {
                            $percent = 0;
                        } else {
                            $percent = substr(100 * $clicks / $impmade, 0, 5);
                        }
                        if ( $imptotal == 0 ) {
                            $left = _BANNERS_UNLIMITED;
                            $imptotal = _BANNERS_UNLIMITED;
                        } else {
                            $left = $imptotal-$impmade;
                        }
                        $fecha = date("F jS Y, h:iA.");
                        $subject = sprintf(_BANNERS_MAIL_SUBJECT , $xoopsConfig['sitename'] );
                        $message = sprintf(_BANNERS_MAIL_MESSAGE , $xoopsConfig['sitename'], $name, $bid, $imageurl, $clickurl, $imptotal, $impmade, $left, $clicks, $percent, $fecha);
                        $xoopsMailer =& xoops_getMailer();
                        $xoopsMailer->useMail();
                        $xoopsMailer->setToEmails($email);
                        $xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
                        $xoopsMailer->setFromName($xoopsConfig['sitename']);
                        $xoopsMailer->setSubject($subject);
                        $xoopsMailer->setBody($message);
                        $xoopsMailer->send();
                        redirect_header("banners.php?op=Ok", 3, _BANNERS_MAIL_OK);
                        exit();
                    }
                }
            }
        }
    }
    redirect_header("banners.php",2);
    exit();
}

/*********************************************/
/* Function to let the client to change the  */
/* url for his banner                        */
/*********************************************/
function change_banner_url_by_client($cid, $bid, $url)
{
    global $xoopsDB;
    if ($_SESSION['banner_login'] != "" && $_SESSION['banner_pass'] != "" && $url != "") {
        $cid = intval($cid);
        $bid = intval($bid);
        $sql = sprintf("select passwd from %s where cid=%u and login=%s", $xoopsDB->prefix("bannerclient"), $cid, $xoopsDB->quoteString($_SESSION['banner_login']));
        if ($result = $xoopsDB->query($sql)) {
            list($passwd) = $xoopsDB->fetchRow($result);
            if ( $_SESSION['banner_pass'] == $passwd ) {
                $sql = sprintf("update %s set clickurl=%s where bid=%u AND cid=%u", $xoopsDB->prefix("banner"), $xoopsDB->quoteString($url), $bid, $cid);
                if ($xoopsDB->query($sql)) {
                    redirect_header("banners.php?op=Ok", 3, "URL has been changed.");
                    exit();
                }
            }
        }
    }
    redirect_header("banners.php",2);
    exit();
}

function clickbanner($bid)
{
    global $xoopsDB;
    $bid = intval($bid);
    if ($bid > 0) {
        if ($GLOBALS['xoopsSecurity']->checkReferer()) {
            if ($bresult = $xoopsDB->query("select clickurl from ".$xoopsDB->prefix("banner")." where bid=$bid")) {
                list($clickurl) = $xoopsDB->fetchRow($bresult);
                $xoopsDB->queryF("update ".$xoopsDB->prefix("banner")." set clicks=clicks+1 where bid=$bid");
                header ('Location: '.$clickurl);
            }
        }
    }
    exit();
}
$op = '';
if (!empty($_POST['op'])) {
  $op = $_POST['op'];
} elseif (!empty($_GET['op'])) {
  $op = $_GET['op'];
}
$myts =& MyTextSanitizer::getInstance();
switch ( $op ) {
case "click":
    $bid = 0;
    if (!empty($_GET['bid'])) {
        $bid = intval($_GET['bid']);
    }
    clickbanner($bid);
    break;
case "Ok":
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if ( !$GLOBALS['xoopsSecurity']->check(true, false, "BANNER_LOGIN") ) {
            redirect_header("banners.php", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
            exit();
        }

        $_SESSION['banner_login'] = $myts->stripslashesGPC(trim($_POST['login']));
        $_SESSION['banner_pass'] = $myts->stripslashesGPC(trim($_POST['pass']));
    }
    bannerstats();
    break;
case _BANNERS_CHANGE:
    if (!$GLOBALS['xoopsSecurity']->check(true, false, "BANNER_EDIT")) {
        redirect_header("banners.php", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        exit();
    }
    $bid = $cid = 0;
    if (!empty($_POST['url'])) {
        $url = $myts->stripslashesGPC(trim($_POST['url']));
    }
    if (!empty($_POST['bid'])) {
        $bid = intval($_POST['bid']);
    }
    if (!empty($_POST['cid'])) {
        $cid = intval($_POST['cid']);
    }
    change_banner_url_by_client($cid, $bid, $url);
    break;
case "EmailStats":
    $bid = $cid = 0;
    if (!empty($_GET['bid'])) {
        $bid = intval($_GET['bid']);
    }
    if (!empty($_GET['cid'])) {
        $cid = intval($_GET['cid']);
    }
    EmailStats($cid, $bid);
    break;
case "login":
default:
    clientlogin();
    break;
}

?>