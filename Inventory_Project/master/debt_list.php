<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 29/05/2020
 * Time: 2:35 PM
 */
session_start();

$fUsername = $_SESSION['username_admin'];

$inactive = 3600;

if(isset($_SESSION['timeout']) )
{
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive)
    {
        session_destroy();
        header("Location: login_master.php");
    }
}
$_SESSION['timeout'] = time();

if($fUsername == null)
{
    header('Location:login_master.php');
}
include_once('includes/db_connection_master.php');
$db = new db_connection_master();
$db->db_select_master($fUsername);

if(isset($_POST['buttonSearch_Date']))
{
    $Add_Min_Date = $_POST['name_min_date'];
    $Add_Max_Date = $_POST['name_max_date'];

    if($Add_Min_Date == "" && $Add_Max_Date == "")
    {
        include_once('includes/message.php');
        header('Location:debt_list.php');
    }
    elseif($Add_Min_Date == null && $Add_Max_Date == null)
    {
        include_once('includes/message.php');
        header('Location:debt_list.php');
    }
    else
    {
        $db->date_min = $Add_Min_Date;
        $db->date_max = $Add_Max_Date;
    }
}
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
<br>
<div class="row">
    <div class="col-md-4">
        <form id="" action="includes/back_sales_report.php" method="POST">
            <button class="btn btn-dark" type="submit" id="btnbacktosales_report" name="buttonbacktosales_report"><a class="fa fa-chevron-left fa-lg"></a> BACK</button>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h1 id="lblList">Debt Report </h1>
        <div class="table-responsive-md" id="table_div">
            <label>Date:</label>
            <br>
            <div class="row">
                <div class="col-md-8">
                    <form id="" action="" method="POST" class="form-inline">
                        <label>From:</label>
                        <input style="margin-left: 1%" type="date" id="min-date" class="date-range-filter" name="name_min_date" placeholder="From: yyyy-mm-dd">
                        <label style="margin-left: 1%" >To:</label>
                        <input style="margin-left: 1%" type="date" id="max-date" class="date-range-filter" name="name_max_date" placeholder="To: yyyy-mm-dd">
                        <button style="margin-left: 1%" class="btn btn-dark" type="submit" id="btnSearch_Date" name="buttonSearch_Date">Search</button>
                    </form>
                </div>
            </div>
            <br>
            <table width="100%" class="table-bordered table-dark table-striped display" id="table_Transactions">
                <thead>
                <tr class="tableheaders">
                    <th class="linement"> Name </th>
                    <th class="linement"> Product </th>
                    <th class="linement"> Quantity </th>
                    <th class="linement"> Total </th>
                    <th class="linement"> Date Ordered</th>
                    <th class="linement"> Paid Payment </th>
                    <th class="linement"> Credit </th>
                    <th class="linement"> Last Payment</th>
                </tr>
                </thead>
                <tfoot>
                <tr class="tableheaders">
                    <th class="linement"> Name </th>
                    <th class="linement"> Product </th>
                    <th class="linement"> Quantity </th>
                    <th class="linement"> Total </th>
                    <th class="linement"> Date Ordered</th>
                    <th class="linement"> Paid Payment </th>
                    <th class="linement"> Credit </th>
                    <th class="linement"> Last Payment</th>
                </tr>
                </tfoot>
                <tbody>
                <?php $db->db_select_order_table_Credit(); ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>
</body>
</html>
