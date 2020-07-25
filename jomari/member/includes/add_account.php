<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/1/2020
 * Time: 3:16 PM
 */
session_start();
$fPhone_number = $_SESSION['Phone_number'];
if(isset($_POST['buttonAdd_Account']))
{
    //Information
    $addActivation_code = $_POST['fAdd_Activation_Code'];
    $addUsername = $_POST['fAdd_Username'];
    $addPassword = $_POST['fAdd_Password'];
    $addSponsor = $_POST['fAdd_Sponsor_Username'];
    //Regex
    $value_Add_Activation_code = preg_match("/^[a-zA-Z0-9]+$/", $addActivation_code);
    $value_Add_Username = preg_match("/^[a-zA-Z0-9' -]+([a-zA-Z0-9' -]+)*[^\s]+$/", $addUsername);
    $value_Add_Password = preg_match("/^[a-zA-Z0-9]+$/", $addPassword);
    $value_Add_Sponsor_Username = preg_match("/^[a-zA-Z0-9' -]+([a-zA-Z0-9' -]+)*[^\s]+$/", $addSponsor);

    if($value_Add_Activation_code == 1 && $value_Add_Username == 1 && $value_Add_Password == 1 && $value_Add_Sponsor_Username == 1)
    {
        $addPassword = password_hash($addPassword, PASSWORD_BCRYPT);

        include_once('db_connection_member.php');
        $db_add_account = new db_connection_member();
        $db_add_account->db_select_member_login_phone_number($fPhone_number);
        $db_add_account->db_select_member_account_add($addActivation_code, $addUsername, $addPassword, $addSponsor);
    }
    else
    {
        session_destroy();
        header('Location: ../login_member.php');
    }
}
?>