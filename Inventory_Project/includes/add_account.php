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
    $addActivation_code = $_POST['fAdd_Activation_Code'];
    $addUsername = $_POST['fAdd_Username'];
    $addPassword = $_POST['fAdd_Password'];
    $addSponsor = $_POST['fAdd_Sponsor_Username'];

    $addPassword = password_hash($addPassword, PASSWORD_BCRYPT);

    include_once('db_connection_memberss.php');
    $db_add_account = new db_connection_members();
    $db_add_account->db_select_member_login_phone_number($fPhone_number);
    $db_add_account->db_select_member_account_add($addActivation_code, $addUsername, $addPassword, $addSponsor);
}
?>