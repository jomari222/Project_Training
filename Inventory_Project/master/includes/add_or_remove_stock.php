<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/1/2020
 * Time: 8:10 AM
 */
if(isset($_POST['buttonAdd_Stock']))
{
    include_once('message.php');
    include_once('db_connection_master.php');
    $db = new db_connection_master();

    $product_id = $_POST['select_product_add_or_remove_stock'];
    $addStock = $_POST['fAdd_Stock'];

    $db->db_select_Add_product_stock($product_id,$addStock);

    MessageBackInventory('Stock has been added.');
}

if(isset($_POST['buttonMinus_Stock']))
{
    include_once('message.php');
    include_once('db_connection_master.php');
    $db = new db_connection_master();

    $product_id = $_POST['select_product_add_or_remove_stock'];
    $minusStock = $_POST['fAdd_Stock'];

    $db->db_select_Minus_product_stock($product_id,$minusStock);

    MessageBackInventory('Stock has been deducted.');
}
?>