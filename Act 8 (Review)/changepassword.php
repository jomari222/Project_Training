<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/17/2019
 * Time: 2:13 PM
 */
if(isset($_POST['buttonChange']))
{
    $fUsername = $_POST['fChangeUsername'];
    $fPassword = $_POST['fChangePassword'];

    include_once('db_connection.php');

    $db_Update = new db_connection();

    $db_Update->db_update_tbluser($fUsername, $fPassword);
}
?>