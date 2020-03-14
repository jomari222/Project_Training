<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/17/2019
 * Time: 10:14 AM
 */
if(isset($_POST['buttonLogin']))
{
    $fUsername_admin = $_POST['fUsername_admin'];
    $fPassword = $_POST['fPassword'];

    include_once('db_connection_master.php');
    $db = new db_connection_master();
    session_start();
    $db->db_select_master_login($fUsername_admin,$fPassword);
}
?>