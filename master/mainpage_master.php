<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/25/2020
 * Time: 6:02 PM
 */
session_start();
$fPhone_number = $_SESSION['Phone_number_admin'];
if($fPhone_number == null)
{
    header('Location:login_master.php');
}
include_once('includes/db_connection.php');
$db_select_user = new db_connection();
$db_select_user->db_select_member_mainpage($fPhone_number);
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
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid bg-info" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="mainpage_master.php"><i class="fa fa-clipboard-list fa-lg"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="code_activation_maker.php"><i class="fa fa-file-alt fa-lg"></i> Code Generation</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button id="dropdrop" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle fa-lg"></i> <?php $db_select_user->get_first_name(); ?> <?php $db_select_user->get_last_name(); ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right bg-info">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="includes/logout.php"><i class="fa fa-sign-out-alt fa-lg"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <hr class="line">
        <h2 class="text-white text-center">DASHBOARD</h2>
        <hr class="line">
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-info">
                    <div class="card-header">
                        <h3 class="text-center text-white">Peso Wallet</h3>
                    </div>
                    <div class="card-body" id="card_body">

                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-info">
                    <div class="card-header">
                        <h3 class="text-center text-white">Voucher Points</h3>
                    </div>
                    <div class="card-body" id="card_body">

                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<br>
</body>
<?php include_once("includes/footer.php") ?>
</html>
