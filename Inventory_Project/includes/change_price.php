<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/1/2020
 * Time: 8:11 AM
 */
if(isset($_POST['buttonChangePrice']))
{
    include_once('message.php');
    include_once('db_connection.php');
    $db = new db_connection();

    $product_id = $_POST['select_product_change_price'];
    $newPrice = $_POST['fNewPrice'];

    $db->db_update_product_price($product_id, $newPrice);

    MessageBackInventory('Price has been change.');
}
?>