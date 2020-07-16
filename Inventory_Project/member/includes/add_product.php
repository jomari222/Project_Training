<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/13/2020
 * Time: 12:40 PM
 */
if(isset($_POST['buttonAddNewProduct']))
{
    //Information
    $Add_ProductName = $_POST['fProductName'];
    $Add_ProductPrice = $_POST['fNewProductPrice'];
    $Add_ProductStock = $_POST['fAddNewProduct_Stock'];
    //Regex
    $value_Add_ProductPrice = preg_match("/^[1-9]+[0-9]+(?:\.[0-9]{1,2})?$/", $Add_ProductPrice);
    $value_Add_ProductName = preg_match("/^[a-zA-Z0-9]+([\s]+[a-zA-Z0-9]+)+$/", $Add_ProductName);

    if($value_Add_ProductPrice == 1 && $value_Add_ProductName == 1 && filter_var($Add_ProductStock, FILTER_VALIDATE_INT))
    {
        include_once('db_connection_member.php');
        $db = new db_connection_member();

        $db->db_insert_product($Add_ProductName,$Add_ProductPrice,$Add_ProductStock);

        include_once('message.php');
        MessageGotoProductList('Product has been added.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: ../login_master.php');
    }
}
?>