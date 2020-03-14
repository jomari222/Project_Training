<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/13/2020
 * Time: 12:40 PM
 */
if(isset($_POST['buttonAddNewProduct']))
{
    $Add_ProductName = $_POST['fProductName'];
    $Add_ProductPrice = $_POST['fNewProductPrice'];
    $Add_ProductStock = $_POST['fAddNewProduct_Stock'];

    include_once('db_connection_master.php');
    $db = new db_connection_master();

    $db->db_insert_product($Add_ProductName,$Add_ProductPrice,$Add_ProductStock);

    include_once('message.php');
    MessageGotoProductList('Product has been added.');
}
?>