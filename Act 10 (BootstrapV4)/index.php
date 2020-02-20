<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['Username']))
{
    $_SESSION['Username'] = null;
}
$fUsername = $_SESSION['Username'];
if($_SESSION['Username'] != null)
{
    header('Location:mainpage.php');
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="images/home.ico"/>

    <title>BootstrapV4</title>

    <script src="js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

    <script src="js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <script src="js/dataTables.buttons.js"></script>

    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <script src="fontawesome/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="glyphicons/css/bootstrap-glyphicons.css">

    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid bg-dark">
<div class="row" id="bg">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <?php include_once("includes/header.php") ?>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="container-md p-5 text-white" id="dvLogin">
                    <form id="frmLogin" action="includes/login.php" method="POST" class="needs-validation" novalidate>
                        <h1 id="lblLoginform" class="text-center">LOGIN FORM</h1>
                        <div class="form-group">
                            <p id="lblUsername">Username: </p>
                            <div class="input-group">
                                <span class="" id="user_icon"><i class="fa fa-user fa-lg" id="icon_user"></i></span>
                                <input type="text" class="form-control" id="txtUsername" name="fUsername" placeholder="Enter Username" maxlength="20" value="" required/>
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
                        <button class="btn btn-block btn-info" type="submit" id="btnLogin" name="buttonLogin">LOGIN</button>
                        <br>
                        <br>
                        <span id="lblForgotPass" onclick="">Forgot <a href="#">Password?</a></span>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
</body>
<?php include_once("includes/footer.php") ?>
</html>