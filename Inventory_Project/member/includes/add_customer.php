<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/9/2020
 * Time: 4:41 PM
 */
if(isset($_POST['buttonInsert_customer']))
{
    //Information
    $Add_Firstname = $_POST['fFirst_name'];
    $Add_Lastname = $_POST['fLast_name'];
    $Add_Storename = $_POST['fStore_name'];
    $Add_Phone_number = $_POST['fPhone_number_registration'];
    //Address
    $Add_Region = $_POST['select_region'];
    $Add_Province = $_POST['select_province'];
    $Add_City_mun = $_POST[''];
    $Add_Brgy = $_POST['select_brgy'];
    $Add_Address = $_POST['fAddress'];
    //Uppercase
    $Add_Firstname = strtoupper($Add_Firstname);
    $Add_Lastname = strtoupper($Add_Lastname);
    $Add_Storename = strtoupper($Add_Storename);

    include_once('db_connection_member.php');
    $db = new db_connection_member();
    $db->db_insert_customer($Add_Firstname,$Add_Lastname,$Add_Storename,$Add_Phone_number,$Add_Region,$Add_Province,$Add_City_mun,$Add_Brgy,$Add_Address);

    include_once('message.php');
    MessageGotoCustomerList('Customer has been added.');
}
?>