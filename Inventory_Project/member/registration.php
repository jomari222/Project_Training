<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/7/2020
 * Time: 3:29 PM
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JICSAM</title>
    <link rel="shortcut icon" href="images/Jicsam-Logo_title.png" />

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
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form action="includes/add_customer.php" method="POST" class="needs-validation" novalidate>
            <div class="card" id="bg-green">
                <div class="card-header">
                    <h1 class="text-center text-white">Registration Form</h1>
                </div>
                <div class="card-body" id="card_body">
                    <div class="row">
                        <div class="col-md-6" id="col_information">
                            <div class="form-group">
                                <h3 class="" id="font_green">Information</h3>
                                <hr>
                                <div class="form-group">
                                    <label id="lbl_first_name">First name: </label>
                                    <input type="text" class="form-control" id="txtFirst_name" name="fFirst_name" pattern="[^\s][a-zA-Z]+( [a-zA-Z]+)*[^\s]+" placeholder="Enter First name" onkeypress="" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field correctly.</div>
                                </div>
                                <div class="form-group">
                                    <label id="lbl_first_name">Last name: </label>
                                    <input type="text" class="form-control" id="txtLast_name" name="fLast_name" pattern="[^\s][a-zA-Z]+( [a-zA-Z]+)*[^\s]+" placeholder="Enter Last name" onkeypress="" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field correctly.</div>
                                </div>
                                <div class="form-group">
                                    <label id="lblUsername">Username: </label>
                                    <input type="text" class="form-control" id="txtUsername" name="fUsername" pattern="^[a-zA-Z0-9]+([a-zA-Z0-9]+)*[^\s]+" onkeypress="" placeholder="Enter Username" maxlength="60" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field correctly.</div>
                                </div>
                                <div class="form-group">
                                    <label id="lblPassword">Password: </label>
                                    <input type="password" class="form-control" id="txtPassword" name="fPassword" pattern="^[a-zA-Z0-9]+" onkeypress="return AvoidSpace()" placeholder="Enter Password" maxlength="60" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field correctly.</div>
                                </div>
                                <div class="form-group form-check">
                                    <label id="lblshowpassword">
                                        <input type="checkbox" class="form-check-input" id="chkShowPass" onclick="togglePassword()"/> Show Password
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label id="lblPhone_number">Phone number: </label>
                                    <input type="text" class="form-control" id="txtPhone_number" name="fPhone_number_registration" placeholder="Enter Phone number" pattern="[0]{1}[9]{1}[0-9]{9}" onkeypress="return AvoidSpace()" maxlength="11"/>
                                    <div class="text-muted">Ex: 09123456789</div>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field correctly.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="lbl_store_name">Store name: </label>
                                <input type="text" class="form-control" id="txtStore_name" name="fStore_name" placeholder="Enter Store name" pattern="[^\s][a-zA-Z0-9' -]+( [a-zA-Z0-9 ' -]+)*[^\s]+" onkeypress=""/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field correctly.</div>
                            </div>
                            <h3 class="" id="font_green">Address</h3>
                            <hr>
                            <label id="lbl_address">Region:
                                <select name="select_region" id="slc_region" class="btn btn-success dropdown-toggle text-white form-control" required>

                                </select>
                            </label>
                            <label id="lbl_address">Province:
                                <select name="select_province" id="slc_province" name="select_province" class="btn btn-success text-white dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <label id="lbl_address">Municipality:
                                <select name="select_city_mun" id="slc_citymun" class="btn btn-success text-white dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <label id="lbl_address">Barangay:
                                <select name="select_brgy" id="slc_brgy" class="btn btn-success text-white dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <div class="form-group">
                                <label id="lbl_address">Address: </label>
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
                    <button class="btn btn-success text-white btn-block" type="submit" id="btnInsert_customer" name="buttonInsert_customer">Register</button>
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
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
