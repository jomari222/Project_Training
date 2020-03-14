<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/14/2020
 * Time: 12:23 PM
 */

function MessageBackLogin($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "jomari/member/login_member.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackMainpage($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "jomari/member/mainpage_member.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackMain($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/index.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackAccount($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/account.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackInventory($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/inventory.php"; setTimeout(window.location.pathname, 0);</script>';
}
?>