<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/28/2020
 * Time: 7:50 AM
 */
$product_id = intval($_GET['product_id']);
include_once('db_connection.php');
$db = new db_connection();
$db->db_select_product_price($product_id);
?>