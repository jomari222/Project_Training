<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/6/2020
 * Time: 3:51 PM
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
if($db->position_id == 3)
{
    header("Location: account_customer.php");
}

if(isset($_POST['buttonSearch_Date']))
{
    $Add_Min_Date = $_POST['name_min_date'];
    $Add_Max_Date = $_POST['name_max_date'];

    if($Add_Min_Date == "" && $Add_Max_Date == "")
    {
        include_once('includes/message.php');
        MessageGotoTransaction('Please fill up the dates properly.');
    }
    elseif($Add_Min_Date == null && $Add_Max_Date == null)
    {
        include_once('includes/message.php');
        MessageGotoTransaction('Please fill up the dates properly.');
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
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php"><i class="fa fa-home fa-lg"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer.php"><i class="fa fa-user-check fa-lg"></i> Customer List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory.php"><i class="fa fa-warehouse fa-lg"></i> Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="transaction.php"><i class="fa fa-clipboard fa-lg"></i> Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button id="dropdrop" class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-minus fa-lg"></i>       Expenses<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right" id="dropdrop">
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
                    <li class="dropdown">
                        <button id="dropdrop" class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-list-alt fa-lg"></i>       Reports<span class="caret"></span>   </button>
                        <ul class="dropdown-menu dropdown-menu-right" id="dropdrop">
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="sales_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Sales Report</a>
                                <a class="nav-link text-white" href="stock_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Stock Report</a>
                                <a class="nav-link text-white" href="delivery_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Delivery Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <button id="dropdrop" class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle fa-lg"></i> <?php $db->get_fullname_login(); ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" id="dropdrop">
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
    <div class="col-md-12">
        <h1 id="lblList">Transactions </h1>
        <div class="table-responsive-md" id="table_div">
            <label>Date:</label>
            <br>
            <form id="" action="" method="POST" class="form-inline">
                <label>From:</label>
                <input style="margin-left: 1%" type="date" id="min-date" class="date-range-filter" name="name_min_date" placeholder="From: yyyy-mm-dd">
                <label style="margin-left: 1%" >To:</label>
                <input style="margin-left: 1%" type="date" id="max-date" class="date-range-filter" name="name_max_date" placeholder="To: yyyy-mm-dd">
                <button style="margin-left: 1%" class="btn btn-dark" type="submit" id="btnSearch_Date" name="buttonSearch_Date">Search</button>
            </form>
            <br>
            <table width="100%" class="table-bordered table-dark table-striped display" id="table_Transactions">
                <thead>
                <tr class="tableheaders">
                    <th class="linement"> Name </th>
                    <th class="linement"> Store name </th>
                    <th class="linement"> Product </th>
                    <th class="linement"> Quantity </th>
                    <th class="linement"> Total </th>
                    <th class="linement"> Date ordered</th>
                </tr>
                </thead>
                <tfoot>
                <tr class="tableheaders">
                    <th class="linement"> Name </th>
                    <th class="linement"> Store name </th>
                    <th class="linement"> Product </th>
                    <th class="linement"> Quantity </th>
                    <th class="linement"> Total </th>
                    <th class="linement"> Date ordered</th>
                </tr>
                </tfoot>
                <tbody>
                <?php $db->db_select_order_table(); ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>
</body>
</html>
