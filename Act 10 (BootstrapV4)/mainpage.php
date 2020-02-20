<!DOCTYPE html>
<?php
session_start();
$fUsername = $_SESSION['Username'];
if($fUsername == null)
{
    header('Location:index.php');
}
include_once('includes/db_connection.php');
$db_select_employee = new db_connection();
$db_select_employee->db_select_user_tbluser($fUsername);
$db_select_employee->db_select_all_tblemployee();
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

    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid bg-dark">
<div class="row">
    <div class="col-md-12" id="bg">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                        <ul class="navbar-nav mr-md-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="mainpage.php"><i class="fa fa-home fa-lg"></i> Main Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php"><i class="fa fa-phone-square-alt fa-lg"></i> Contact Us</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form class="active" id="frmnav" action="includes/logout.php" method="POST">
                                    <a class="nav-link" href="includes/logout.php"><i class="fa fa-sign-out-alt fa-lg"></i> Logout</a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <div id="dvmainpage" class="container-md p-5 text-white">
                        <form id="frmmainpage" action="includes/logout.php" method="POST">
                            <h1 id="lblInformation">INFORMATION</h1>
                            <br>
                            <div class="form-group">
                                <label>Employee ID: <input style="width: 65%" type="text" name="fEmployeeID" id="txtEmployeeID" value="<?php $db_select_employee->get_employee_id(); ?>" disabled/></label>
                                <label style="padding-left: 12px">First Name: <input style="width: 68%" type="text" name="fFirstname" id="txtFirstname" value="<?php $db_select_employee->get_first_name(); ?>" disabled/></label>
                                <label style="padding-left: 14px">Last Name: <input style="width: 68%" type="text" name="fLastname" id="txtLastname" value="<?php $db_select_employee->get_last_name(); ?>" disabled/></label>
                                <label style="padding-left: 36px">Gender: <input style="width: 74%" type="text" name="fGender" id="txtGender" value="<?php $db_select_employee->get_gender(); ?>" disabled/></label>
                                <label style="padding-left: 36px">Positon: <input style="width: 74%" type="text" name="fPosition" id="txtPosition" value="<?php $db_select_employee->get_position(); ?>" disabled/></label>
                            </div>
                        </form>
                        <button class="btn btn-info" id="btnChangePassword" name="buttonChangePassword" onclick="hide_unhide()">Change Password</button>
                    </div>
                    <div id="dvchangepassword" class="container-md p-5 text-white">
                        <button id="btnBacktoInfo" class="btn btn-info" name="buttonBacktoInfo" onclick="hide_unhide()">BACK</button>
                        <form id="frmchangepassword" action="includes/changepassword.php" method="POST" class="needs-validation" novalidate>
                            <br>
                            <br>
                            <div class="form-group">
                                <p>Current password: </p>
                                <input type="password" class="form-control" id="txtCurrentPassword" name="fCurrentPassword" value="" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="form-group">
                                <p>New password: </p>
                                <input type="password" class="form-control" id="txtNewPassword" name="fNewPassword" value="" minlength="6" maxlength="60" data-toggle="tooltip" data-placement="right" title="New password must not be equal to the current password" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="form-group form-check">
                                <label id="lblshowpasswordnew"><input type="checkbox" id="chkShowPassnew" onclick="togglePasswordnew()"/> Show Password</label>
                            </div>
                            <div class="form-group">
                                <p>Verify password: </p>
                                <input type="password" class="form-control" id="txtVerifyPassword" name="fVerifyPassword" value="" minlength="6" maxlength="60" data-toggle="tooltip" data-placement="right" title="Verification password must be equal to the new password" required/>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <button type="submit" class="btn btn-info" id="btnConfirm" name="buttonConfirm">CONFIRM</button>
                        </form>
                    </div>
                    <br>
                    <?php if($db_select_employee->position_id == 1){ ?>
                        <div id="dvaddemployee" class="container-md p-5 text-white">
                            <form id="frmaddemployee" action="includes/addemployee.php" method="POST" class="needs-validation" novalidate>
                                <h1 id="lblAddEmployee">Employee</h1>
                                <br>
                                <div class="form-group">
                                    <p>Employee ID: <input style="width: 65%" type="text" id="id_Employee_ID" name="fAddEmployeeID" value="<?php echo $db_select_employee->employee_id_add ?>" disabled/></p>
                                </div>
                                <div class="form-group">
                                    <p>First Name:</p>
                                    <input class="form-control" type="text" id="id_AddFirst_name" name="fAddFirstname" value="" pattern="[^'\x22][^1-9]+" data-toggle="tooltip" data-placement="right" title="Remove unnecessary characters" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <p>Last Name:</p>
                                    <input class="form-control" type="text" id="id_AddLast_name" name="fAddLastname" value="" pattern="[^'\x22][^1-9]+" data-toggle="tooltip" data-placement="right" title="Remove unnecessary characters" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <p>Username:</p>
                                    <input class="form-control" type="text" name="fAddUsername" value="" pattern="[^'\x22][^\x32][^\s]+" onkeypress="return AvoidSpace(event)" maxlength="20" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <p>Password:</p>
                                    <input class="form-control" type="password" id="txtPasswordmain" name="fAddPassword" value="" minlength="6" maxlength="60" data-toggle="tooltip" data-placement="right" title="Minimum of 6 characters" required/>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field (at least 6 characters).</div>
                                </div>
                                <div class="form-group form-check">
                                    <label id="lblshowpasswordmain"><input type="checkbox" id="chkShowPassmain" onclick="togglePasswordmain()"/> Show Password</label>
                                </div>
                                <label>Gender:
                                    <select name="fAddGender" class="btn btn-info dropdown-toggle" required>
                                        <option value="Male"> Male </option>
                                        <option value="Female"> Female </option>
                                    </select>
                                </label>
                                <label>Positon:
                                    <select name="fAddPosition" class="btn btn-info dropdown-toggle" id="txtAddPosition" required>
                                        <option value="Employee"> Employee </option>
                                        <option value="Administrator"> Administrator </option>
                                    </select>
                                </label>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-info" id="btnAddEmployee" name="buttonAddEmployee">Add Employee</button>
                                <br>
                            </form>
                        </div>
                    <?php }; ?>
                    <br>
                </div>
                <div class="col-md-8">
                    <br>
                    <br>
                    <div id="dvemployeelist" class="container-md p-5 text-white">
                        <form id="frmemployeelist" action="" method="POST">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 id="lblEmployeeList">LIST OF EMPLOYEE</h1>
                                </div>
                            </div>
                            <div class="table-responsive-md">
                                <table class="table-bordered table-dark table-striped display" id="table_employee">
                                    <thead>
                                    <tr class="tableheaders">
                                        <th class="linement"> Employee ID </th>
                                        <th class="linement"> First Name </th>
                                        <th class="linement"> Last Name </th>
                                        <th class="linement"> Gender </th>
                                        <th class="linement"> Position </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr class="tableheaders">
                                        <th class="linement"> Employee ID </th>
                                        <th class="linement"> First Name </th>
                                        <th class="linement"> Last Name </th>
                                        <th class="linement"> Gender </th>
                                        <th class="linement"> Position </th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $db_select_employee->db_select_table_tblemployee(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>
</body>
<?php include_once("includes/footer.php") ?>
</html>
