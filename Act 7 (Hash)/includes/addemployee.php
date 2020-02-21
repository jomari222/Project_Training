<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/12/2019
 * Time: 12:46 PM
 */
if(isset($_POST['buttonAddEmployee']))
{
    session_start();
    include_once('connect_DB.php');
    $faddEmployeeID = $_SESSION['AddEmployeeID'];
    $faddFirstname = $_POST['fAddFirstname'];
    $faddLastname = $_POST['fAddLastname'];
    $faddGender = $_POST['fAddGender'];
    $faddPosition = $_POST['fAddPosition'];
    $faddUsername = $_POST['fAddUsername'];
    $faddPassword = $_POST['fAddPassword'];

    $faddPassword = password_hash($faddPassword, PASSWORD_BCRYPT);

    if($faddGender == "Male")
    {
        $addGender = 1;
    }
    else
    {
        $addGender = 0;
    }

    if($faddPosition == 'Employee')
    {
        $addPosition = 2;
    }
    else
    {
        $addPosition = 1;
    }

    $faddStatus = 1;

    include_once('includes/connect_DB.php');

    $sql4 = "INSERT INTO tbluser (fEmployeeID, fUsername, fPassword)VALUES('".$faddEmployeeID."', '".$faddUsername."', '".$faddPassword."')";

    $results4 = mysqli_query($con, $sql4) or die('Query Error'.$con->error);

    $sql5 = "INSERT INTO tblemployee (fEmployeeID ,fFirstname, fLastname, fGender, fPosition, fStatus)VALUES('".$faddEmployeeID."' ,'".$faddFirstname."', '".$faddLastname."', '".$addGender."', '".$addPosition."', '".$faddStatus."')";

    $results5 = mysqli_query($con, $sql5) or die('Query Error'.$con->error);

    include_once('disconnect_DB.php');

    header('Location: ../mainpage.php');
}
?>