<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/5/2019
 * Time: 8:16 AM
 */
if(isset($_POST['buttonLogin']))
{
    $fUsername = $_POST['fUsername'];
    $fPassword = $_POST['fPassword'];

    include_once('connect_DB.php');


    //$sql = "SELECT * FROM tbluser WHERE BINARY fUsername = '".$fUsername."'";
    //$result = mysqli_query($con, $sql) or die('Query Error'.$con->error);

    //$row = mysqli_fetch_array($result);

    $sql = sprintf("SELECT * FROM tbluser WHERE BINARY fUsername ='%s'", mysqli_real_escape_string($con,$fUsername));
    $result = mysqli_query($con, $sql) or die('Query Error'.$con->error);

	$row = mysqli_fetch_array($result);

    /*$stmt = $con->prepare('SELECT * FROM tbluser WHERE BINARY fUsername = ?');
    $stmt->bind_param('s', $fUsername);
    $fUsername = "''1''";
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    while ($row = $result->fetch_assoc())
    {

    }*/

    if($row['fUsername'] == $fUsername && password_verify($fPassword,$row['fPassword']))
    {
        session_start();
        $_SESSION['Username'] = $fUsername;
		header('Location: ../mainpage.php');
    }
    else
    {
        Message("Your Username or Password is invalid");
    }

    include_once('disconnect_DB.php');
}
function Message($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%207/index.php"; setTimeout(window.location.pathname, 0);</script>';
}
?>
