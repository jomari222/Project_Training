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

    $Add_Amount = $_POST['fAmount'];
    $Add_Remarks = $_POST['fRemarks'];

    include_once('db_connection_member.php');
    $db = new db_connection_member();
    $db->db_select_member($fUsername);
    $db->db_insert_expense($Add_Amount,$Add_Remarks);

    include_once('message.php');
    MessageGotoExpenseList('Expense has been added.');
}
?>