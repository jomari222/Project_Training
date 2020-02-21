<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/12/2019
 * Time: 11:10 AM
 */

session_start();
$fUsername = $_SESSION['Username'];

if(isset($_POST['buttonBacktoInfo']))
{
    $createnewpassword = 0;
    header('Location: ../mainpage.php');
}
if(isset($_POST['buttonConfirm']))
{
    $fCurrentPassword = $_POST['fCurrentPassword'];
    $fNewPassword = $_POST['fNewPassword'];
    $fVerifyPassword = $_POST['fVerifyPassword'];

    if($fNewPassword != $fVerifyPassword)
    {
        MessageBack("Verification password is doesn't match to your new password");
    }
    else
    {
        include_once('connect_DB.php');

        $sql6 = "SELECT * FROM tbluser WHERE BINARY fUsername = '".$fUsername."'";
        $result6 = mysqli_query($con, $sql6) or die('Query Error'.$con->error);

        $row6 = mysqli_fetch_array($result6);

        if($row6['fUsername'] == $fUsername && password_verify($fCurrentPassword,$row6['fPassword']))
        {
            $fVerifyPassword = password_hash($fVerifyPassword, PASSWORD_BCRYPT);
            $sql7 = "UPDATE tbluser SET fPassword = '".$fVerifyPassword."' WHERE fUsername='".$fUsername."'";
            $result7 = mysqli_query($con, $sql7) or die('Query Error'.$con->error);

            $createnewpassword = 0;

            MessageBack("Password has been successfully change");
        }
        else
        {
            MessageBack("Current password is incorrect");
        }

        include_once('disconnect_DB.php');
    }
}
function MessageBack($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%206/mainpage.php"; setTimeout(window.location.pathname, 1);</script>';
}
?>