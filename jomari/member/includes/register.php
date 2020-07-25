<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/26/2020
 * Time: 7:26 PM
 */
if(isset($_POST['buttonRegister']))
{
    //Information
    $register_activation_code = $_POST['fActivation_code'];
    $register_phone_number = $_POST['fPhone_number_registration'];
    $register_username = $_POST['fUsername_registration'];
    $register_password = $_POST['fPassword'];
    $register_first_name = $_POST['fFirst_name'];
    $register_last_name = $_POST['fLast_name'];
    $register_sponsor = $_POST['fSponsor'];

    $register_region = $_POST['select_region'];
    $register_province = $_POST['select_province'];
    $register_city_mun = $_POST['select_region'];
    $register_brgy = $_POST['select_region'];
    $register_address = $_POST['fAddress'];
    //Regex
    $value_Add_Activation_code = preg_match("/^[a-zA-Z0-9]+$/", $register_activation_code);
    $value_Add_fContact_number = preg_match("/^[0][9][0-9]{9}$/", $register_phone_number);
    $value_Add_Username = preg_match("/^[a-zA-Z0-9' -]+([a-zA-Z0-9' -]+)*[^\s]+$/", $register_username);
    $value_Add_Password = preg_match("/^[a-zA-Z0-9]+$/", $register_password);
    $value_Add_Firstname = preg_match("/^[a-zA-Z ]+([a-zA-Z ]+)*[^\s]+$/", $register_first_name);
    $value_Add_Lastname = preg_match("/^[a-zA-Z]+([a-zA-Z]+)*[^\s]+$/", $register_last_name);
    $value_Add_Sponsor_Username = preg_match("/^[a-zA-Z0-9' -]+([a-zA-Z0-9' -]+)*[^\s]+$/", $register_sponsor);

    $value_Add_Address = preg_match("/^[A-Za-z0-9 #]+$/", $register_address);

    if($value_Add_Activation_code == 1 && $value_Add_fContact_number == 1 && $value_Add_Username == 1 && $value_Add_Password == 1 && $value_Add_Firstname == 1 && $value_Add_Lastname == 1 && $value_Add_Sponsor_Username == 1)
    {
        $register_password = password_hash($register_password, PASSWORD_BCRYPT);

        $addFirst_name = strtoupper($register_first_name);
        $addLast_name = strtoupper($register_last_name);

        $position_id = 2;
        $blocked = 0;
        $peso_wallet = 200;
        $voucher_points = 0;

        include_once ('db_connection_member.php');
        $db_register_all_info = new db_connection_member();
        $db_register_all_info->db_select_member_member_id();
        $db_register_all_info->db_select_account_insert_all_info($db_register_all_info->code_activation_id,$register_username,$register_password,$register_activation_code,$register_sponsor,$db_register_all_info->member_id_register,$register_phone_number,$addFirst_name,$addLast_name,$position_id,$blocked,$peso_wallet,$voucher_points);
        $db_register_all_info->db_insert_home_address_register($register_region,$register_province,$register_city_mun,$register_brgy,$register_address,$db_register_all_info->member_id_register);
        $db_register_all_info->db_update_code_activation($register_activation_code);
    }
    else
    {
        /*echo $value_Add_Activation_code;
        echo $value_Add_fContact_number;
        echo $value_Add_Username;
        echo $value_Add_Password;
        echo $value_Add_Firstname;
        echo $value_Add_Lastname;
        echo $value_Add_Sponsor_Username;*/
        session_start();
        session_destroy();
        header('Location: ../login_member.php');
    }
}
?>