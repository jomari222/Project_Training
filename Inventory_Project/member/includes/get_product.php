<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/25/2020
 * Time: 2:21 PM
 */
$product_id = intval($_GET['product_id']);
include_once('db_connection_member.php');
$db = new db_connection_member();
$db->db_select_product_amount($product_id);
?>