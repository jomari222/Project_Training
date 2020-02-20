<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/20/2019
 * Time: 5:26 PM
 */
if(isset($_POST['buttonAddEmployee']))
{
    $addFirst_name = $_POST['fAddFirstname'];
    $addLast_name = $_POST['fAddLastname'];
    $addGender = $_POST['fAddGender'];
    $addPosition = $_POST['fAddPosition'];
    $addUsername = $_POST['fAddUsername'];
    $addPassword = $_POST['fAddPassword'];

    $addPassword = password_hash($addPassword, PASSWORD_BCRYPT);

    if($addGender == "Male")
    {
        $add_Gender = 1;
    }
    else
    {
        $add_Gender = 0;
    }

    if($addPosition == 'Employee')
    {
        $add_Position = 2;
    }
    else
    {
        $add_Position = 1;
    }

    $addStatus = 1;
    $addFirst_name = strtoupper($addFirst_name);
    $addLast_name = strtoupper($addLast_name);

    include_once('db_connection.php');
    $db_insert = new db_connection();
    $db_insert->db_select_all_tblemployee();
    $addEmployee_id = $db_insert->employee_id_add;
    $db_insert->db_insert_tbluser($addEmployee_id, $addUsername, $addPassword);
    $db_insert->db_insert_tblemployee($addEmployee_id, $addFirst_name, $addLast_name, $add_Gender, $add_Position, $addStatus);
}
?>