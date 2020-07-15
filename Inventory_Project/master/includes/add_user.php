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
    //Uppercase
    $Add_Firstname = strtoupper($Add_Firstname);
    $Add_Lastname = strtoupper($Add_Lastname);
    //Regex
    $value_Add_fContact_number = preg_match("/^[0][9][0-9]{9}$/", $Add_fContact_number);
    $value_Add_Firstname = preg_match("/^[a-zA-Z]+([a-zA-Z]+)*[^\s]+$/", $Add_Firstname);
    $value_Add_Lastname = preg_match("/^[a-zA-Z]+([a-zA-Z]+)*[^\s]+$/", $Add_Lastname);
    $value_Add_fUsername = preg_match("/^[a-zA-Z0-9]+([_ a-zA-Z0-9]+)*[^\s]+$/", $Add_fUsername);
    $value_Add_Password = preg_match("/^[a-zA-Z0-9]+$/", $Add_Password);

    if($value_Add_fContact_number == 1 && $value_Add_Firstname == 1 && $value_Add_Lastname == 1 && $value_Add_fUsername == 1 && $value_Add_Password == 1)
    {
        //Password
        $Add_Password = password_hash($Add_Password, PASSWORD_BCRYPT);

        include_once('db_connection_master.php');
        $db = new db_connection_master();
        $db->db_insert_account($Add_Firstname,$Add_Lastname,$Add_fContact_number,$Add_fUsername,$Add_Password,$Add_Position);

        include_once('message.php');
        MessageGotoUserList('User has been added.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: ../login_master.php');
    }
}
?>