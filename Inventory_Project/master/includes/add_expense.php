<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/15/2020
 * Time: 10:51 AM
 */
if(isset($_POST['buttonInsert']))
{
    session_start();

    $fUsername = $_SESSION['username_admin'];

    date_default_timezone_set('Asia/Manila');
    $date_expense = date("Y-m-d H:i:s");

    $Add_Amount = $_POST['fAmount'];
    $Add_Remarks = $_POST['fRemarks'];

    include_once('db_connection_master.php');
    $db = new db_connection_master();
    $db->db_select_master($fUsername);
    $db->db_insert_expense($Add_Amount,$Add_Remarks,$date_expense);

    include_once('message.php');
    MessageGotoExpenseList('Expense has been added.');
}
?>