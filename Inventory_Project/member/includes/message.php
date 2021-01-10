<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/14/2020
 * Time: 12:23 PM
 */

function MessageBackLogin($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/login_member.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoCustomerList($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/customer.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackMain($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/index.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoExpenseList($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/expenses.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackAccount($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/account.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackInventory($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/inventory.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoTransaction($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/transaction.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoAccount($msg,$ID)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/member/account.php?ID='.$ID.'"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackAccountID($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); setTimeout(window.location.pathname, 0);</script>';
}
function MessageCancelOrder($msg,$order_id)
{
    include_once('db_connection_member.php');
    $db = new db_connection_members();

    echo '<script type="text/javascript">if((confirm("'.$msg.'"))){ var meth = "'.$db->db_update_order_cancel($order_id).'"; location.pathname = "Inventory_Project/member/account.php"; setTimeout(window.location.pathname, 0);}</script>';
}
?>