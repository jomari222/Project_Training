<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/25/2020
 * Time: 2:14 PM
 */
session_start();
if(!isset($_SESSION['username_admin']))
{
    $_SESSION['username_admin'] = null;
}
$fPhone_number = $_SESSION['username_admin'];
if($_SESSION['username_admin'] != null)
{
    header('Location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jomari</title>

    <script src="js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

    <script src="js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <script src="js/dataTables.buttons.js"></script>

    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <script src="fontawesome/js/all.js"></script>

    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid">
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <br>
        <br>
        <div class="container-md p-4" id="dvLogin">
            <form id="frmLogin" action="includes/login.php" method="POST" class="needs-validation" novalidate>
                <div class="card bg-dark">
                    <div class="card-header bg-dark">
                        <h1 class="text-center text-white">LOGIN FORM</h1>
                    </div>
                    <div class="card-body" id="card_body">
                        <div class="form-group">
                            <p id="lblUsername">Username: </p>
                            <div class="input-group">
                                <span class="" id="username_icon"><i class="fa fa-user fa-lg" id="icon_username"></i></span>
                                <input type="text" class="form-control" id="txtUsername" name="fUsername_admin" placeholder="Enter Username" maxlength="60" value="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p id="lblPassword">Password: </p>
                            <div class="input-group">
                                <span class="" id="password_icon"><i class="fa fa-lock fa-lg" id="icon_password"></i></span>
                                <input type="password" class="form-control" id="txtPassword" name="fPassword" placeholder="Enter Password" maxlength="60" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <label id="lblshowpassword">
                                <input type="checkbox" class="form-check-input" id="chkShowPass" onclick="togglePassword()"/> Show Password
                            </label>
                        </div>
                    </div>
                    <div class="card-footer" id="card_footer">
                        <button class="btn btn-block btn-dark" type="submit" id="btnLogin" name="buttonLogin">LOGIN</button>
                    </div>
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<br>
</body>
</html>
