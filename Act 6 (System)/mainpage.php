<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/5/2019
 * Time: 10:05 AM
 */

session_start();
$fUsername = $_SESSION['Username'];
$createnewpassword = 0;
if($fUsername == null)
{
    header('Location:index.php');
}
//Button Click
if(isset($_POST['buttonChangePassword']))
{
    $createnewpassword = 1;
}
if(isset($_POST['buttonLogout']))
{
    session_destroy();
    header('Location:index.php');
}
include_once('includes/connect_DB.php');

$sql1 = "SELECT fEmployeeID FROM tbluser WHERE fUsername = '".$fUsername."'";

$result1 = mysqli_query($con, $sql1) or die('Query Error'.$con->error);

while($row = mysqli_fetch_assoc($result1))
{
$fEmployeeID = $row['fEmployeeID'];

$sqlselect = "SELECT fEmployeeID, fFirstname, fLastname, fGender, fPosition, fStatus, fStamp FROM tblemployee WHERE fEmployeeID = '" . $fEmployeeID . "'";

$results = mysqli_query($con, $sqlselect) or die('Query Error' . $con->error);

while ($rows = mysqli_fetch_assoc($results))
{
if (!$rows['fGender']) {
    $Gender = 'Female';
} else {
    $Gender = 'Male';
}
?>

<html>
<head>
    <title>Act 6</title>
    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body>
<div id="dvmainbody">
    <?php if ($createnewpassword == 0) { ?>
        <div id="dvmainpage">
        <form id="frmmainpage" action="" method="POST">
        <h1 id="lblInformation">INFORMATION</h1>
        <p>Employee ID: <input type="text" name="fEmployeeID" value="<?php echo $rows['fEmployeeID']; ?>" disabled/></p>
        <p style="padding-left: 12px">First Name: <input type="text" name="fFirstname"
                                                         value="<?php echo $rows['fFirstname']; ?>" style="width: 72%"
                                                         disabled/></p>
        <p style="padding-left: 12px">Last Name: <input type="text" name="fLastname"
                                                        value="<?php echo $rows['fLastname']; ?>" style="width: 72%"
                                                        disabled/></p>
        <p style="padding-left: 36px">Gender: <input type="text" name="fGender" value="<?php echo $Gender ?>"
                                                     style="width: 77%" disabled/></p>
        <?php
        $fID = $rows['fPosition'];
        $_SESSION['fID'] = $fID;

        $sqlselect1 = "SELECT fPosition FROM tblempposition WHERE fID = '" . $fID . "'";

        $results1 = mysqli_query($con, $sqlselect1) or die('Query Error' . $con->error);

        while ($rows1 = mysqli_fetch_assoc($results1))
        {
            ?>
            <p style="padding-left: 34px">Positon: <input type="text" name="fPosition" id="txtPosition"
                                                          value="<?php echo $rows1['fPosition']; ?>" style="width: 77%"
                                                          disabled/></p>
            <button type="Submit" id="btnChangePassword" name="buttonChangePassword">Change<br>Password</button>
            <button type="Submit" id="btnLogout" name="buttonLogout">LOGOUT</button>
            <br>
            </form>
            </div>
            <?php
        }
    };
}
}
        ?>
        <div id="dvemployeelist">
            <form id="frmemployeelist" action="" method="POST">
                <h1 id="lblEmployeeList">LIST OF EMPLOYEE</h1>
                <table class="tblEmployeeList">
                    <tr class="tableheaders">
                        <th class="linement"> Employee ID</th>
                        <th class="linement"> First Name</th>
                        <th class="linement"> Last Name</th>
                        <th class="linement"> Gender</th>
                        <th class="linement"> Position</th>
                    </tr>
                    <?php

                    $sql2 = "SELECT fEmployeeID, fFirstname, fLastname, fGender, fPosition, fStatus, fStamp FROM tblemployee";
                    $results2 = mysqli_query($con, $sql2) or die('Query Error'.$con->error);
                    while($row2 = mysqli_fetch_assoc($results2))
                    {
                        if(!$row2['fGender'])
                        {
                            $Gender = 'Female';
                        }
                        else
                        {
                            $Gender = 'Male';
                        }
                        ?>
                        <tr>
                            <td class="linement"> <?php echo $row2['fEmployeeID']; ?> </td>
                            <td class="linement"> <?php echo $row2['fFirstname']; ?> </td>
                            <td class="linement"> <?php echo $row2['fLastname']; ?>
                            <td class="linement"> <?php echo $Gender ?> </td>
                            <?php
                            $fID = $row2['fPosition'];

                            $sql3 = "SELECT fPosition FROM tblempposition WHERE fID = '".$fID."'";

                            $results3 = mysqli_query($con, $sql3) or die('Query Error'.$con->error);

                            while($rows3 = mysqli_fetch_assoc($results3)) {
                                ?>
                                <td class="linement"> <?php echo $rows3['fPosition']; ?> </td>
                                </tr>
                                <?php
                            }
                    }
                    ?>
                </table>
                <br>
            </form>
        </div>
        <?php $fID = $_SESSION['fID']; if ($fID == 1) { ?>
            <div id="dvaddemployee" onload="buttonaddemployee">
                <form id="frmaddemployee" action="includes/addemployee.php" method="POST">
                    <h1 id="lblAddEmployee">Employee</h1>
                    <?php
                        $sqlselectemployeeID = "SELECT fEmployeeID FROM tblemployee ORDER BY fEmployeeID DESC LIMIT 1";

                        $resultselectemployeeID = mysqli_query($con, $sqlselectemployeeID) or die('Query Error'.$con->error);

                        $rowselectemployeeID = mysqli_fetch_assoc($resultselectemployeeID);

                    ?>
                        <p>Employee ID: <input type="text" name="fAddEmployeeID1" value="<?php echo $rowselectemployeeID['fEmployeeID'] + 1; ?>" disabled/></p>
                    <?php
                        $_SESSION['AddEmployeeID'] = $rowselectemployeeID['fEmployeeID'] + 1;
                        include_once('includes/disconnect_DB.php');
                    ?>
                    <p style="padding-left: 12px">First Name: <input type="text" name="fAddFirstname" value="" style="width: 72%" required/></p>
                    <p style="padding-left: 12px">Last Name: <input type="text" name="fAddLastname" value="" style="width: 72%" required/></p>
                    <p style="padding-left: 12px">Username: <input type="text" name="fAddUsername" value="" style="width: 72%" required/></p>
                    <p style="padding-left: 12px">Password: <input type="password" id="txtPasswordmain" name="fAddPassword" value="" style="width: 72%" required/></p>
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
        <?php if($createnewpassword == 1){ ?>
        <div id="dvchangepassword">
            <form id="frmchangepassword" action="includes/changepassword.php" method="POST">
                <button type="Submit" id="btnBacktoInfo" name="buttonBacktoInfo" formnovalidate>BACK</button>
                <p style="padding-left: 12px">Current password: <br><input type="password" id="txtCurrentPassword" name="fCurrentPassword" value="" style="width: 72%" required/></p>
                <p style="padding-left: 12px">New password: <br><input type="password" id="txtNewPassword" name="fNewPassword" value="" style="width: 72%" required/></p>
                <label id="lblshowpasswordnew"><input type="checkbox" id="chkShowPassnew" onclick="togglePasswordnew()"/> Show Password</label>
                <p style="padding-left: 12px">Verify password: <br><input type="password" id="txtVerifyPassword" name="fVerifyPassword" value="" style="width: 72%" required/></p>
                <button type="Submit" id="btnConfirm" name="buttonConfirm">CONFIRM</button>
            </form>
        </div>
        <?php }; ?>
    </div>
    </body>
</html>
<?php
function Message($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'")</script>';
}
?>
