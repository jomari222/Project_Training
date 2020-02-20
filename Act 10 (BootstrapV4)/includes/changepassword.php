<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/20/2019
 * Time: 6:01 PM
 */
if(isset($_POST['buttonConfirm']))
{
    session_start();
    $fUsername = $_SESSION['Username'];

    $currentPassword = $_POST['fCurrentPassword'];
    $newPassword = $_POST['fNewPassword'];
    $verifyPassword = $_POST['fVerifyPassword'];

    if($newPassword != $verifyPassword)
    {
        include_once('message.php');
        MessageBackMainpage("Verification password doesn't match to your new password");
    }
    else
    {
        include_once('db_connection.php');
        $db_update_user = new db_connection();

        $db_update_user->db_update_tbluser($fUsername, $verifyPassword, $currentPassword);
    }
}
?>