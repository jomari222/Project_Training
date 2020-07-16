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

    $fUsername = $_SESSION['username'];

    date_default_timezone_set('Asia/Manila');
    $date_expense = date("Y-m-d H:i:s");

    $Add_Amount = $_POST['fAmount'];
    $Add_Remarks = $_POST['fRemarks'];

    if(filter_var($Add_Amount, FILTER_VALIDATE_FLOAT))
    {
        include_once('db_connection_member.php');
        $db = new db_connection_member();
        $db->db_select_member($fUsername);
        $db->db_insert_expense($Add_Amount,$Add_Remarks,$date_expense);

        include_once('message.php');
        MessageGotoExpenseList('Expense has been added.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: ../login_member.php');
    }
}
?>