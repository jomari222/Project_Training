<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/20/2019
 * Time: 6:01 PM
 */
if(isset($_POST['buttonBacktoInfo']))
{
    session_start();
    $_SESSION['createnewpassword'] = 0;
    header('Location: ../mainpage.php');
}
if(isset($_POST['buttonConfirm']))
{
    session_start();
    $fUsername = $_SESSION['Username'];

    $currentPassword = $_POST['fCurrentPassword'];
    $newPassword = $_POST['fNewPassword'];
    $verifyPassword = $_POST['fVerifyPassword'];

    if($newPassword != $verifyPassword)
    {
        MessageBack("Verification password doesn't match to your new password");
    }
    else
    {
        include_once('db_connection.php');
        $db_update_user = new db_connection();

        $db_update_user->db_update_tbluser($fUsername, $verifyPassword, $currentPassword);
    }
}
function MessageBack($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%209%20(Act%207%20Modified)/mainpage.php"; setTimeout(window.location.pathname, 0);</script>';
    $_SESSION['createnewpassword'] = 1;
}
?>