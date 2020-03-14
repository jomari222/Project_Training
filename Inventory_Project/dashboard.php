<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/7/2020
 * Time: 3:14 PM
 */
include_once('includes/db_connection.php');
$db = new db_connection();
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
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid bg-dark" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php"><i class="fa fa-home fa-lg"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer.php"><i class="fa fa-user-check fa-lg"></i> Customer List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.php"><i class="fa fa-clipboard fa-lg"></i> Transactions</a>
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
<br>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark">
            <div class="card-header bg-dark">
                <h1 class="text-center text-white"><i class="fa fa-clipboard-check"></i>     Total Sale</h1>
            </div>
            <div class="card-body text-center" id="card_body">

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-header bg-dark">
            <h1 class="text-center text-white"><i class="fa fa-clipboard-check"></i>     Total Sale</h1>
        </div>
        <div class="card-body text-center" id="card_body">

        </div>
    </div>
    <div class="col-md-4">
        <div class="card-header bg-dark">
            <h1 class="text-center text-white"><i class="fa fa-clipboard-check"></i>     Total Sale</h1>
        </div>
        <div class="card-body text-center" id="card_body">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-4">

    </div>
</div>
</body>
</html>
