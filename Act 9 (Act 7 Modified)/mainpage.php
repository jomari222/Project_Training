<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/19/2019
 * Time: 8:38 PM
 */
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
<html>
<head>
    <title>Act 9</title>
    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body>
<div id="dvmainbody">
    <?php if($_SESSION['createnewpassword'] == 0){ ?>
    <div id="dvmainpage">
        <form id="frmmainpage" action="includes/logout.php" method="POST">
            <h1 id="lblInformation">INFORMATION</h1>
            <p>Employee ID: <input type="text" name="fEmployeeID" value="<?php $db_select_employee->get_employee_id(); ?>" disabled/></p>
            <p style="padding-left: 12px">First Name: <input type="text" name="fFirstname"
                                                             value="<?php $db_select_employee->get_first_name() ?>" style="width: 72%"
                                                             disabled/></p>
            <p style="padding-left: 12px">Last Name: <input type="text" name="fLastname"
                                                            value="<?php $db_select_employee->get_last_name() ?>" style="width: 72%"
                                                            disabled/></p>
            <p style="padding-left: 36px">Gender: <input type="text" name="fGender" value="<?php $db_select_employee->get_gender() ?>"
                                                         style="width: 77%" disabled/></p>
            <p style="padding-left: 34px">Positon: <input type="text" name="fPosition" id="txtPosition"
                                                          value="<?php $db_select_employee->get_position() ?>" style="width: 77%"
                                                          disabled/></p>
            <button type="Submit" id="btnChangePassword" name="buttonChangePassword">Change<br>Password</button>
            <button type="Submit" id="btnLogout" name="buttonLogout">LOGOUT</button>
            <br>
        </form>
    </div>
    <?php }; ?>
    <div id="dvemployeelist">
        <form id="frmemployeelist" action="" method="POST">
            <h1 id="lblEmployeeList">LIST OF EMPLOYEE</h1>
            <table class="tblEmployeeList" id="table_employee" onload="myDeleteUpdate()">
                <tr class="tableheaders">
                    <th class="linement"> Employee ID </th>
                    <th class="linement"> First Name </th>
                    <th class="linement"> Last Name </th>
                    <th class="linement"> Gender </th>
                    <th class="linement"> Position </th>
                </tr>
                <?php $db_select_employee->db_select_table_tblemployee(); ?>
            </table>
            <br>
        </form>
    </div>
    <?php if($db_select_employee->position_id == 1){ ?>
    <div id="dvaddemployee">
        <form id="frmaddemployee" action="includes/addemployee.php" method="POST">
            <h1 id="lblAddEmployee">Employee</h1>
            <p>Employee ID: <input type="text" name="fAddEmployeeID" value="<?php echo $db_select_employee->employee_id_add ?>" disabled/></p>
            <p style="padding-left: 12px">First Name: <input type="text" name="fAddFirstname" value="" style="width: 72%" pattern="[^'\x22][^1-9]+" required/></p>
            <p style="padding-left: 12px">Last Name: <input type="text" name="fAddLastname" value="" style="width: 72%" pattern="[^'\x22][^1-9]+" required/></p>
            <p style="padding-left: 12px">Username: <input type="text" name="fAddUsername" value="" style="width: 72%" pattern="[^'\x22]+" maxlength="20" required/></p>
            <p style="padding-left: 12px">Password: <input type="password" id="txtPasswordmain" name="fAddPassword" value="" style="width: 72%" minlength="6" maxlength="60" required/></p>
            <label id="lblshowpasswordmain"><input type="checkbox" id="chkShowPassmain" onclick="togglePasswordmain()"/> Show Password</label>
            <p style="padding-left: 36px">Gender:
                <select name="fAddGender" required>
                    <option value="Male"> Male </option>
                    <option value="Female"> Female </option>
                </select>
            </p>
            <p style="padding-left: 34px">Positon:
                <select name="fAddPosition" id="txtAddPosition" required>
                    <option value="Employee"> Employee </option>
                    <option value="Administrator"> Administrator </option>
                </select>
            </p>
            <br>
            <button type="Submit" id="btnAddEmployee" name="buttonAddEmployee">Add Employee</button>
            <br>
        </form>
    </div>
    <?php }; ?>
    <?php if($_SESSION['createnewpassword']== 1){ ?>
    <div id="dvchangepassword">
        <form id="frmchangepassword" action="includes/changepassword.php" method="POST">
            <button type="Submit" id="btnBacktoInfo" name="buttonBacktoInfo" formnovalidate>BACK</button>
            <p style="padding-left: 12px">Current password: <br><input type="password" id="txtCurrentPassword" name="fCurrentPassword" value="" style="width: 72%" required/></p>
            <p style="padding-left: 12px">New password: <br><input type="password" id="txtNewPassword" name="fNewPassword" value="" style="width: 72%" minlength="6" maxlength="60" required/></p>
            <label id="lblshowpasswordnew"><input type="checkbox" id="chkShowPassnew" onclick="togglePasswordnew()"/> Show Password</label>
            <p style="padding-left: 12px">Verify password: <br><input type="password" id="txtVerifyPassword" name="fVerifyPassword" value="" style="width: 72%" minlength="6" maxlength="60" required/></p>
            <button type="Submit" id="btnConfirm" name="buttonConfirm">CONFIRM</button>
        </form>
    </div>
    <?php }; ?>
</div>
</body>
</html>
