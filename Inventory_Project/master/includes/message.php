<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/14/2020
 * Time: 12:23 PM
 */

function MessageBackLogin($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/login_master.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoUserList($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/user_list.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoProductList($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/inventory.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoCustomerList($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/customer.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoExpenseList($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/expenses.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageGotoTransaction($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/transaction.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackAccount($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/account.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackAccountID($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackInventory($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Inventory_Project/master/inventory.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageCancelOrder($msg,$order_id)
{
    include_once('db_connection_master.php');
    $db = new db_connection_master();

    echo '<script type="text/javascript">if((confirm("'.$msg.'"))){ var meth = "'.$db->db_update_order_cancel($order_id).'"; location.pathname = "Inventory_Project/master/account.php"; setTimeout(window.location.pathname, 0);}</script>';
}
?>