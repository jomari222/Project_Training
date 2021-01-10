<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/16/2020
 * Time: 5:34 PM
 */
session_start();
$fPhone_number = $_SESSION['Phone_number'];
if(isset($_POST['buttonAdd_Address']))
{
    $addRegion = $_POST['select_region'];
    $addProvince = $_POST['select_province'];
    $addCity = $_POST['select_city_mun'];
    $addBrgy = $_POST['select_brgy'];
    $addAddress = $_POST['fAddress'];

    include_once('db_connection_memberss.php');
    $db_add_account = new db_connection_members();
    $db_add_account->db_select_member_login_phone_number($fPhone_number);
    $db_add_account->db_insert_home_address($addRegion, $addProvince, $addCity, $addBrgy, $addAddress);
}
?>