<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/14/2020
 * Time: 12:23 PM
 */

function MessageBackIndex($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%2010%20(BootstrapV4)/index.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackMainpage($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%2010%20(BootstrapV4)/mainpage.php"; setTimeout(window.location.pathname, 0);</script>';
}
?>