<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/8/2020
 * Time: 7:21 PM
 */
if(isset($_POST['buttonInsert_User']))
{
    //Information
    $Add_Firstname = $_POST['fFirst_name'];
    $Add_Lastname = $_POST['fLast_name'];
    $Add_fContact_number = $_POST['fPhone_number_registration'];
    $Add_fUsername = $_POST['fUsername'];
    $Add_Password = $_POST['fPassword'];
    $Add_Position = $_POST['select_position'];
    //Password
    $Add_Password = password_hash($Add_Password, PASSWORD_BCRYPT);
    //Uppercase
    $Add_Firstname = strtoupper($Add_Firstname);
    $Add_Lastname = strtoupper($Add_Lastname);

    include_once('db_connection_master.php');
    $db = new db_connection_master();
    $db->db_insert_account($Add_Firstname,$Add_Lastname,$Add_fContact_number,$Add_fUsername,$Add_Password,$Add_Position);

    include_once('message.php');
    MessageGotoUserList('User has been added.');
}
?>