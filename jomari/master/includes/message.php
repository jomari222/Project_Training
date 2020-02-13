<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/14/2020
 * Time: 12:23 PM
 */

function MessageBackLogin($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "jomari/master/login_master.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackMainpage($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "jomari/master/mainpage_master.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackCodeMaker($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "jomari/master/code_activation_maker.php"; setTimeout(window.location.pathname, 0);</script>';
}
?>