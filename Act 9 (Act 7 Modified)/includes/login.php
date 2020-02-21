<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/17/2019
 * Time: 10:14 AM
 */
if(isset($_POST['buttonLogin']))
{
    $fUsername = $_POST['fUsername'];
    $fPassword = $_POST['fPassword'];

    include_once('db_connection.php');
    $db_select_user = new db_connection();
    session_start();
    $db_select_user->db_select_tbluser_login($fUsername, $fPassword);
}
?>