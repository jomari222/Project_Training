<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/31/2020
 * Time: 9:05 PM
 */
session_start();

$fPhone_number = $_SESSION['Phone_number'];

$inactive = 3600;

if(isset($_SESSION['timeout']) )
{
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive)
    {
        session_destroy();
        header("Location: login_member.php");
    }
}
$_SESSION['timeout'] = time();

if($fPhone_number == null)
{
    header('Location:login_member.php');
}
include_once('includes/db_connection_member.php');
$db_select_user = new db_connection_member();
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
                    <li class="nav-item">
                        <a class="nav-link" href="mainpage_member.php"><i class="fa fa-clipboard-list fa-lg"></i> Dashboard</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="account.php"><i class="fa fa-user-alt fa-lg"></i>  Accounts</a>
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
<br>
<div class="row">
    <div class="col-md-4">
        <div class="container-md p-5 text-white" id="dvLogin">
            <h1 id="" class="text-center">Add account</h1>
            <br>
            <form action="includes/add_account.php" method="POST" class="needs-validation" novalidate>
                <div class="form-group">
                    <p id="">Activation Code: </p>
                    <input type="text" class="form-control" id="txtAdd_Activation_Code" name="fAdd_Activation_Code" pattern="^[a-zA-Z0-9]+" maxlength="20" minlength="20" required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <p id="lblCode">Username: </p>
                    <input type="text" class="form-control" id="txtAdd_Username" name="fAdd_Username" pattern="^[a-zA-Z0-9]+([a-zA-Z0-9]+)*[^\s]+" maxlength="60" required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <p>Password:</p>
                    <input class="form-control" type="password" id="txtAdd_Password" name="fAdd_Password" pattern="^[a-zA-Z0-9]+" value="" minlength="6" maxlength="60" data-toggle="tooltip" data-placement="right" title="Minimum of 6 characters" required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field (at least 6 characters).</div>
                </div>
                <div class="form-group">
                    <p id="">Sponsor's username: </p>
                    <input type="text" class="form-control" id="txtAdd_Sponsor_Username" name="fAdd_Sponsor_Username" pattern="^[a-zA-Z0-9]+([a-zA-Z0-9]+)*[^\s]+" maxlength="60" required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button class="btn btn-block btn-info" type="submit" id="btnAdd_Account" name="buttonAdd_Account">Add</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div id="dvemployeelist" class="container-md p-5 text-white">
            <form id="frmemployeelist" action="" method="POST">
                <div class="row">
                    <div class="col-md-8">
                        <h1 id="lblEmployeeList">Accounts</h1>
                    </div>
                </div>
                <div class="table-responsive-md">
                    <table class="table-bordered table-dark table-striped display" id="table_employee">
                        <thead>
                        <tr class="tableheaders">
                            <th class="linement"> Username</th>
                            <th class="linement"> Activation Code </th>
                            <th class="linement"> Sponsor </th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="tableheaders">
                            <th class="linement"> Username</th>
                            <th class="linement"> Activation Code </th>
                            <th class="linement"> Sponsor </th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $db_select_user->db_select_account_table_procedure(); ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-4">
        <div class="container-md p-5 text-white" id="dvLogin">
            <h1 id="" class="text-center">Add address</h1>
            <br>
            <form action="includes/add_address.php" method="POST" class="needs-validation" novalidate>
                <label id="">Region:
                    <select name="select_region" id="slc_region" onchange="" class="btn btn-info dropdown-toggle form-control" required>

                    </select>
                </label>
                <label id="">Province:
                    <select id="slc_province" name="select_province" class="btn btn-info dropdown-toggle form-control" disabled required>

                    </select>
                </label>
                <label id="">Municipality:
                    <select id="slc_citymun" name="select_city_mun" class="btn btn-info dropdown-toggle form-control" disabled required>

                    </select>
                </label>
                <label id="">Barangay:
                    <select id="slc_brgy" name="select_brgy" class="btn btn-info dropdown-toggle form-control" disabled required>

                    </select>
                </label>
                <div class="form-group">
                    <p id="lblSponsor">Address: </p>
                    <input type="text" class="form-control" id="txtAddress" name="fAddress" pattern="" placeholder="Enter address" disabled required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <div class="text-muted">House Number/Street (Ex: #111 Upper Street).</div>
                </div>
                <button class="btn btn-block btn-info" type="submit" id="btnAdd_Address" name="buttonAdd_Address">Add</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div id="dvhomeaddress" class="container-md p-5 text-white">
            <form id="frmaddresslist" action="" method="POST">
                <div class="row">
                    <div class="col-md-8">
                        <h1 id="lblAddress">Home Address</h1>
                    </div>
                </div>
                <div class="table-responsive-md">
                    <table class="table-bordered table-dark table-striped display" id="table_Address">
                        <thead>
                        <tr class="tableheaders">
                            <th class="linement"> Region </th>
                            <th class="linement"> Province </th>
                            <th class="linement"> Municipality </th>
                            <th class="linement"> Barangay </th>
                            <th class="linement"> Address </th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="tableheaders">
                            <th class="linement"> Region </th>
                            <th class="linement"> Province </th>
                            <th class="linement"> Municipality </th>
                            <th class="linement"> Barangay </th>
                            <th class="linement"> Address </th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $db_select_user->db_select_home_location_table_procedure(); ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<br>
</body>
<?php include_once("includes/footer.php") ?>
</html>
