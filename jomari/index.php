<!DOCTYPE html>
<?php

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jomari</title>

    <script src="js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <script src="fontawesome/js/all.js"></script>

    <link rel="stylesheet" type="text/css" href="css/mydesign.css">
</head>
<body class="container-fluid bg-dark">
<?php include_once("includes/header.php") ?>
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid bg-info" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg"></i> Main Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="fa fa-phone-square-alt fa-lg"></i> Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="member/login_member.php"><i class="fa fa-sign-in-alt fa-lg"></i> Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-1"></div>
    <div class="col-3">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="text-white text-center">Company Name</h3>
            </div>
            <div class="card-body" id="card_body">
                <h4 class="text-white"></h4>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="text-white text-center">Join us now!</h3>
            </div>
            <div class="card-body" id="card_body">
                <h4 class="text-white">Be a member, <span id="" onclick=""><a href="member/registration.php">Register</a> now!</span></h4>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="text-white text-center">News and Events</h3>
            </div>
            <div class="card-body" id="card_body">
                <h4 class="text-white"></h4>
            </div>
        </div>
    </div>
</div>
<br>
</body>
<?php include_once("includes/footer.php") ?>
</html>
