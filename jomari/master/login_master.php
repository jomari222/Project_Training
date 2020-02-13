<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/25/2020
 * Time: 2:14 PM
 */
session_start();
if(!isset($_SESSION['Phone_number_admin']))
{
    $_SESSION['Phone_number_admin'] = null;
}
$fPhone_number = $_SESSION['Phone_number_admin'];
if($_SESSION['Phone_number_admin'] != null)
{
    header('Location:code_activation_maker.php');
}
?>
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

    <link rel="stylesheet" type="text/css" href="css/mydesign.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid bg-dark">
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="container-md p-5 text-white" id="dvLogin">
            <form id="frmLogin" action="includes/login.php" method="POST" class="needs-validation" novalidate>
                <h1 id="lblLoginform" class="text-center">LOGIN FORM</h1>
                <div class="form-group">
                    <p id="lblUsername">Phone number: </p>
                    <div class="input-group">
                        <span class="" id="mobile_icon"><i class="fa fa-mobile-alt fa-lg" id="icon_mobile"></i></span>
                        <input type="text" class="form-control" id="txtPhone_number" name="fPhone_number_admin" placeholder="Enter Username or Phone number" maxlength="60" value="" required/>
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
            </form>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<br>
<br>
</body>
<?php include_once("includes/footer.php") ?>
</html>
