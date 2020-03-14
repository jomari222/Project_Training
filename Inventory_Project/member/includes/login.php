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

    include_once('db_connection_member.php');
    $db = new db_connection_member();
    session_start();
    $db->db_select_member_login($fUsername, $fPassword);
}
?>