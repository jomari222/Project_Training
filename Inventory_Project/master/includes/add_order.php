<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 4/3/2020
 * Time: 2:10 PM
 */
if(isset($_POST['buttonInsertProduct']))
{
    date_default_timezone_set('Asia/Manila');
    $date_ordered = date("Y-m-d H:i:s");

    $Add_Customer_ID = $_POST['fCustomer_ID'];
    $Add_Product_ID = $_POST['select_product'];
    $Add_Product_amount = $_POST['fAmount'];
    $Add_Quantity = $_POST['fQty'];
    $Add_Discount = $_POST['fDiscount'];
    $Add_Total_amount = $_POST['fTotalAmount'];
    //Regex
    if(filter_var($Add_Total_amount, FILTER_VALIDATE_FLOAT) && filter_var($Add_Discount, FILTER_VALIDATE_FLOAT) && filter_var($Add_Product_amount, FILTER_VALIDATE_FLOAT) && filter_var($Add_Quantity, FILTER_VALIDATE_INT))
    {
        include_once('db_connection_master.php');
        $db = new db_connection_master();
        $db->db_insert_order_customer_id($Add_Customer_ID,$Add_Product_ID,$Add_Quantity,$date_ordered,'',$Add_Discount,'','','',$Add_Total_amount);

        include_once('message.php');
        MessageBackAccountID('Order has been added.', $Add_Customer_ID);
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: ../login_master.php');
    }
}
?>