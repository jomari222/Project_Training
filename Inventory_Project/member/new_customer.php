<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/7/2020
 * Time: 3:29 PM
 */
session_start();

$fUsername = $_SESSION['username'];

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

if($fUsername == null)
{
    header('Location:login_member.php');
}
include_once('includes/db_connection_member.php');
$db = new db_connection_member();
$db->db_select_member($fUsername);
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
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php"><i class="fa fa-home fa-lg"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button id="dropdrop" class="btn btn-dark dropdown-toggle text-white" type="button" data-toggle="dropdown"><i class="fa fa-user-alt fa-lg"></i>       Customer<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-dark">
                                <li class="nav-item active">
                                    <a class="nav-link text-white" href="new_customer.php"><i class="fa fa-user-circle fa-lg"></i> New Customer</a>
                                    <a class="nav-link text-white" href="customer.php"><i class="fa fa-user-check fa-lg"></i> Customer List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.php"><i class="fa fa-clipboard fa-lg"></i> Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-minus fa-lg"></i>       Expenses<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-dark">
                                <li class="nav-item active">
                                    <a class="nav-link text-white" href="new_expense.php"><i class="fa fa-minus-circle fa-lg"></i> New Expense</a>
                                    <a class="nav-link text-white" href="expenses.php"><i class="fa fa-minus-square fa-lg"></i> Expenses List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-list-alt fa-lg"></i>       Reports<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-dark">
                                <li class="nav-item active">
                                    <a class="nav-link text-white" href=""><i class="fa fa-clipboard-check fa-lg"></i> Today Sale</a>
                                    <a class="nav-link text-white" href=""><i class="fa fa-clipboard-check fa-lg"></i> Monthly Sale</a>
                                    <a class="nav-link text-white" href=""><i class="fa fa-clipboard-check fa-lg"></i> Total Sale</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="dropdown">
                    <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle fa-lg"></i> <?php $db->get_fullname_login(); ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right bg-dark">
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
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form action="includes/add_customer.php" method="POST" class="needs-validation" novalidate>
            <div class="card bg-dark">
                <div class="card-header bg-dark">
                    <h1 class="text-center text-white">New Customer</h1>
                </div>
                <div class="card-body" id="card_body">
                    <div class="row">
                        <div class="col-md-6" id="col_information">
                            <div class="form-group">
                                <h3 class="">Information</h3>
                                <hr>
                                <label id="lbl_first_name">First name: </label>
                                <input type="text" class="form-control" id="txtFirst_name" name="fFirst_name" pattern="[^\s][a-zA-Z]+( [a-zA-Z]+)*[^\s]+" placeholder="Enter First name" onkeypress="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <br>
                                <label id="lbl_first_name">Last name: </label>
                                <input type="text" class="form-control" id="txtLast_name" name="fLast_name" pattern="[^\s][a-zA-Z]+( [a-zA-Z]+)*[^\s]+" placeholder="Enter Last name" onkeypress="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <br>
                                <label id="lbl_store_name">Store name: </label>
                                <input type="text" class="form-control" id="txtStore_name" name="fStore_name" placeholder="Enter Store name" onkeypress="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <br>
                                <div class="form-group">
                                    <label id="lblPhone_number">Phone number: </label>
                                    <input type="text" class="form-control" id="txtPhone_number" name="fPhone_number_registration" placeholder="Enter Phone number" pattern="[0]{1}[9]{1}[0-9]{9}" onkeypress="return AvoidSpace()" maxlength="11" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <div class="text-muted">Ex: 09123456789</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="">Address</h3>
                            <hr>
                            <label id="">Region:
                                <select name="select_region" id="slc_region" class="btn btn-dark dropdown-toggle form-control" required>

                                </select>
                            </label>
                            <label id="">Province:
                                <select name="select_province" id="slc_province" name="select_province" class="btn btn-dark dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <label id="">Municipality:
                                <select name="select_city_mun" id="slc_citymun" class="btn btn-dark dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <label id="">Barangay:
                                <select name="select_brgy" id="slc_brgy" class="btn btn-dark dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <div class="form-group">
                                <label id="lblAddresss">Address: </label>
                                <input type="text" class="form-control" id="txtAddress" name="fAddress" placeholder="Enter address" disabled required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <div class="text-muted">House Number/Street (Ex: #111 Upper Street).</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
                <div class="card-footer" id="card_footer">
                    <button class="btn btn-block btn-dark" type="submit" id="btnInsert_customer" name="buttonInsert_customer">Insert</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-1">

    </div>
</div>
<br>
</body>
</html>
