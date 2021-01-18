<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/16/2020
 * Time: 8:54 AM
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
        header('Location:sales_report.php');
    }
    elseif($Add_Min_Date == null && $Add_Max_Date == null)
    {
        include_once('includes/message.php');
        header('Location:sales_report.php');
    }
    else
    {
        $db->date_min = $Add_Min_Date;
        $db->date_max = $Add_Max_Date;
    }
}

if(isset($_POST['buttonDebt_list']))
{
    header('Location:debt_list.php');
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
                    <li class="nav-item">
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
                        <button id="dropdrop" class="btn btn-success dropdown-toggle text-white" type="button" data-toggle="dropdown"><i class="fa fa-list-alt fa-lg"></i>       Reports<span class="caret"></span>   </button>
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
        <h1 id="lblList">Sales Report </h1>
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
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                    <form id="" action="" method="POST" class="">
                        <button style="margin-left: 25%" class="btn btn-dark" type="submit" id="btnDebt_list" name="buttonDebt_list">CREDIT LIST >></button>
                    </form>
                </div>
            </div>
            <br>
            <table width="100%" class="table-bordered table-dark table-striped display" id="table_Transactions">
                <thead>
                <tr class="tableheaders">
                    <th class="linement"> Name </th>
                    <th class="linement"> Store name </th>
                    <th class="linement"> Product </th>
                    <th class="linement"> Quantity </th>
                    <th class="linement"> Total </th>
                    <th class="linement"> Date Paid</th>
                </tr>
                </thead>
                <tfoot>
                <tr class="tableheaders">
                    <th class="linement"> Name </th>
                    <th class="linement"> Store name </th>
                    <th class="linement"> Product </th>
                    <th class="linement"> Quantity </th>
                    <th class="linement"> Total </th>
                    <th class="linement"> Date Paid</th>
                </tr>
                </tfoot>
                <tbody>
                <?php $db->db_select_order_table_Paid(); ?>
                </tbody>
            </table>
            <br>
            <br>
            <div class="row">
                <div class="col-md-6" id="col_change_price">
                    <hr>
                    <h4 class="center">Mangosteen Purple Corn:</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 id="">Quantity: </h4>
                            <input style="font-size: 28px" type="text" class="form-control" id="" name="" placeholder="" value="<?php if($db->Mangosteen_Purple_Corn == NULL) { $db->Mangosteen_Purple_Corn = 0; } echo $db->Mangosteen_Purple_Corn; ?>" readonly/>
                        </div>
                        <div class="col-md-6">
                            <h4 id="">Sales: </h4>
                            <input style="font-size: 28px" type="text" class="form-control" id="" name="" placeholder="" value="<?php $Mangosteen_Purple_Corn_Sale = number_format($db->Mangosteen_Purple_Corn_Sale, 2, '.', ','); echo "₱".$Mangosteen_Purple_Corn_Sale; ?>" readonly/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <hr>
                    <h4 class="center">Malunggay and Banaba: </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 id="">Quantity: </h4>
                            <input style="font-size: 28px" type="text" class="form-control" id="" name="" placeholder="" value="<?php if($db->Malunggay_and_Banaba == NULL) { $db->Malunggay_and_Banaba = 0; } echo $db->Malunggay_and_Banaba; ?>" readonly/>
                        </div>
                        <div class="col-md-6">
                            <h4 id="">Sales: </h4>
                            <input style="font-size: 28px" type="text" class="form-control" id="" name="" placeholder="" value="<?php $Malunggay_and_Banaba_Sale     = number_format($db->Malunggay_and_Banaba_Sale, 2, '.', ','); echo "₱".$Malunggay_and_Banaba_Sale; ?>" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-3">
                    <h2 id="">Total Quantity: </h2>
                    <input style="font-size: 28px" type="text" class="form-control" id="" name="" placeholder="" value="<?php echo $db->total_orders_modified; ?>" readonly/>
                </div>
                <div class="col-md-3">
                    <h2 id="">Total Sales: </h2>
                    <input style="font-size: 28px" type="text" class="form-control" id="" name="" placeholder="" value="<?php $TTotalSales = number_format($db->total_sales_modified, 2, '.', ','); echo "₱".$TTotalSales; ?>" readonly/>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
</body>
</html>
