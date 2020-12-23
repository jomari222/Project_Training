<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 17/05/2020
 * Time: 11:07 AM
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

if (empty($_GET['ID'])):
    header("Location: customer.php");
    die();
endif;

$ID = $db->base64_url_decode($_GET['ID']);

$db->db_select_id($ID);

if(!filter_var($ID, FILTER_VALIDATE_INT))
{
    header('Location:customer.php');
    die();
}

$db->db_select_customer_customer_id($ID);

if(isset($_POST['buttonUpdatePhoneNumber']))
{
    $phone_number = $_POST['fPhone_number'];

    $value_phone_number = preg_match("/^[0][9][0-9]{9}$/", $phone_number);

    if($value_phone_number == 1)
    {
        include_once('includes/message.php');

        $db->db_update_customer_phone_number($ID,$phone_number);

        MessageGotoCustomerList('Contact number has been updated.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_member.php');
    }
}

if(isset($_POST['buttonUpdateAddress']))
{
    $region = $_POST['select_region'];
    $province = $_POST['select_province'];
    $city = $_POST['select_city_mun'];
    $barangay = $_POST['select_brgy'];
    $unit = $_POST['fAddress'];

    $value_unit = preg_match("/^[A-Za-z0-9 #]+$/", $unit);
    if($value_unit == 1)
    {
        include_once('includes/message.php');

        $db->db_update_customer_address($ID,$region,$province,$city,$barangay,$unit);

        MessageGotoCustomerList('Address has been updated.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_member.php');
    }
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JICSAM</title>

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
<br>
<div class="row">
    <div class="col-md-4">
        <form id="" action="includes/back_to_main.php" method="POST">
            <button class="btn btn-dark" type="submit" id="btnbacktomain" name="buttonbacktomain"><a class="fa fa-chevron-left fa-lg"></a> BACK</button>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="card bg-dark">
            <div class="card-header text-center text-white bg-dark">
                <h3 class="">Modify</h3>
            </div>
            <div class="card-body" id="card_body">
                <div class="text-center">
                    <h1 id="lblList"><?php $db->get_fullname(); ?></h1>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6" id="col_change_price">
                        <h2 class="text-center">Update Phone number</h2>
                        <hr>
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label id="lblPhone_number">Phone number:
                                            <input type="text" class="form-control" id="txtPhone_number" name="fPhone_number" placeholder="Enter Phone number" pattern="[0]{1}[9]{1}[0-9]{9}" onkeypress="return AvoidSpace()" maxlength="11" required/>
                                            <div class="text-muted">Ex: 09123456789</div>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </label>
                                    </div>
                                    <div class="col-md-5">
                                        <br>
                                        <button class="btn btn-block btn-dark" type="submit" id="btnUpdatePhoneNumber" name="buttonUpdatePhoneNumber">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-center">Update Address</h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label id="">Region:
                                            <select id="slc_region" name="select_region" class="btn btn-dark dropdown-toggle form-control" required>

                                            </select>
                                        </label>
                                        <label id="">Province:
                                            <select id="slc_province" name="select_province" class="btn btn-dark dropdown-toggle form-control" disabled required>

                                            </select>
                                        </label>
                                        <label id="">Municipality:
                                            <select id="slc_citymun" name="select_city_mun" class="btn btn-dark dropdown-toggle form-control" disabled required>

                                            </select>
                                        </label>
                                        <label id="">Barangay:
                                            <select id="slc_brgy" name="select_brgy" class="btn btn-dark dropdown-toggle form-control" disabled required>

                                            </select>
                                        </label>
                                        <div class="form-group">
                                            <label id="lblAddresss">Address: </label>
                                            <input type="text" class="form-control" id="txtAddress" name="fAddress" placeholder="Enter address" disabled required/>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                            <div class="text-muted">House Number/Street (Ex: #111 Upper Street).</div>
                                        </div>
                                        <br>
                                        <button class="btn btn-block btn-dark" type="submit" id="btnUpdateAddress" name="buttonUpdateAddress">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
<br>
</body>
</html>
