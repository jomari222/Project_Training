<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/26/2020
 * Time: 6:02 PM
 */
include_once('includes/db_connection_member.php');
$db_select_location = new db_connection_member();
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
    <script src="js/Philippines.json"></script>
</head>
<body class="container-fluid bg-dark text-white" id="bodbod">
<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form id="" action="includes/register.php" method="POST" class="needs-validation" novalidate>
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="text-center text-white">Create your own account</h3>
                </div>
                <div class="card-body" id="card_body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p id="lblActivation_code">Activation Code: </p>
                                <input type="text" class="form-control" id="txtActivation_pin" name="fActivation_code" placeholder="Enter Activation Code" onkeypress="return AvoidSpace()" maxlength="20" minlength="20" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="form-group">
                                <p id="lblPhone_number">Phone number: </p>
                                <input type="text" class="form-control" id="txtPhone_number" name="fPhone_number_registration" placeholder="Enter Phone number" pattern="[0]{1}[9]{1}[0-9]{9}" onkeypress="return AvoidSpace()" maxlength="11" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <div class="text-muted">Ex: 09123456789</div>
                            </div>
                            <div class="form-group">
                                <p id="lblUsername">Username: </p>
                                <input type="text" class="form-control" id="txtUsername" name="fUsername_registration" onkeypress="return AvoidSpace()" placeholder="Enter Username" maxlength="60" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field. (Ex: 09123456789)</div>
                            </div>
                            <div class="form-group">
                                <p id="lblPassword">Password: </p>
                                <input type="password" class="form-control" id="txtPassword" name="fPassword" onkeypress="return AvoidSpace()" placeholder="Enter Password" maxlength="60" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="form-group form-check">
                                <label id="lblshowpassword">
                                    <input type="checkbox" class="form-check-input" id="chkShowPass" onclick="togglePassword()"/> Show Password
                                </label>
                            </div>
                            <div class="form-group">
                                <p id="lblFirst_name">First Name: </p>
                                <input type="text" class="form-control" id="txtFirst_name" name="fFirst_name" placeholder="Enter first name" pattern="[^\s][a-zA-Z]+( [a-zA-Z]+)*[^\s]+" maxlength="25" minlength="2" value="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="form-group">
                                <p id="lblLast_name">Last Name: </p>
                                <input type="text" class="form-control" id="txtLast_name" name="fLast_name" placeholder="Enter last name" pattern="[^\s][a-zA-Z]+( [a-zA-Z]+)*[^\s]+" maxlength="25" minlength="2" value="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-6" id="">
                            <label id="">Region:
                                <select name="select_region" id="slc_region" onchange="" class="btn btn-info dropdown-toggle form-control" required>

                                </select>
                            </label>
                            <label id="">Province:
                                <select id="slc_province" name="select_province" class="btn btn-info dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <label id="">Municipality:
                                <select id="slc_citymun" class="btn btn-info dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <label id="">Barangay:
                                <select id="slc_brgy" class="btn btn-info dropdown-toggle form-control" disabled required>

                                </select>
                            </label>
                            <div class="form-group">
                                <p id="lblSponsor">Address: </p>
                                <input type="text" class="form-control" id="txtAddress" name="fAddress" placeholder="Enter address" disabled required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <div class="text-muted">House Number/Street (Ex: #111 Upper Street).</div>
                            </div>
                            <div class="form-group">
                                <p id="lblSponsor">Sponsor: </p>
                                <input type="text" class="form-control" id="txtSponsor" name="fSponsor" onkeypress="return AvoidSpace()" placeholder="Enter sponsor's username" maxlength="60" value="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="card_footer">
                    <button class="btn btn-block btn-info" type="submit" id="btnRegister" name="buttonRegister">REGISTER</button>
                    <br>
                    <div class="text-center">
                        <span id="" onclick="">Already have an account? <a href="login_member.php">Log In</a> now!</span>
                    </div>
                    <br>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
<br>
<br>
</body>
<?php include_once("includes/footer.php") ?>
</html>
