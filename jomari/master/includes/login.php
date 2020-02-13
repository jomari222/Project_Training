<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/17/2019
 * Time: 10:14 AM
 */
if(isset($_POST['buttonLogin']))
{
    $fPhone_number = $_POST['fPhone_number_admin'];
    $fPassword = $_POST['fPassword'];

    include_once('db_connection.php');
    $db_select_user = new db_connection();
    session_start();
    $db_select_user->db_select_member_login_phone_number($fPhone_number);
    $db_select_user->db_select_account_login($fPassword);
}
?>