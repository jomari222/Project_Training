<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/19/2019
 * Time: 9:10 PM
 */
if(isset($_POST['buttonLogout']))
{
    session_start();
    session_destroy();
    header('Location: ../index.php');
}
if(isset($_POST['buttonChangePassword']))
{
    session_start();
    $_SESSION['createnewpassword'] = 1;
    header('Location: ../mainpage.php');
}
?>