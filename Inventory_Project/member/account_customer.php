<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 31/12/2020
 * Time: 5:15 PM
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
$db->db_select_customer_id();
$ID = $db->customer_id;
if($db->position_id == 1 || $db->position_id == 2)
{
    header("Location: dashboard.php");
}

if(isset($_POST['buttonInsertProduct']))
{
    date_default_timezone_set('Asia/Manila');
    $date_ordered = date("Y-m-d H:i:s");

    $Add_Customer_ID = $ID;
    $Add_Product_ID = $_POST['select_product'];
    $Add_Product_amount = $_POST['fAmount'];
    $Add_Quantity= $_POST['fQty'];
    $Add_Discount = $_POST['fDiscount'];
    $Add_Total_amount = $_POST['fTotalAmount'];

    $value_Add_Discount = preg_match("/^[0-9]$/", $Add_Discount);

    if(filter_var($Add_Total_amount, FILTER_VALIDATE_INT) && filter_var($Add_Product_ID, FILTER_VALIDATE_INT) && filter_var($Add_Product_amount, FILTER_VALIDATE_FLOAT) && filter_var($Add_Quantity, FILTER_VALIDATE_INT) && $value_Add_Discount == 1 && filter_var($Add_Total_amount, FILTER_VALIDATE_FLOAT))
    {
        $db->check_product($Add_Product_ID);
        if($Add_Quantity > $db->product_stock_order)
        {
            include_once('includes/message.php');
            MessageBackAccountID('Not enough stock.');
        }
        elseif($Add_Discount > $Add_Total_amount)
        {
            include_once('includes/message.php');
            MessageBackAccountID('Discount is not valid.');
        }
        else
        {
            $db->db_insert_order_customer_id($Add_Customer_ID,$Add_Product_ID,$Add_Quantity,$date_ordered,'',$Add_Discount,'','','',$Add_Total_amount);
            $db->db_update_produce_order_remove($Add_Product_ID,$Add_Quantity);

            include_once('includes/message.php');
            MessageBackAccountID('Order has been added.');
        }
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_members.php');
    }
}
?>
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
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="account.php"><i class="fa fa-home fa-lg"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order_customer.php"><i class="fa fa-list-alt fa-lg"></i> Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
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
<div class="row">
    <div class="col-md-12 text-center">
        <form id="" action="" method="POST">
            <h1 id="lblList">Order List</h1>
            <div class="table-responsive-md" id="table_div">
                <table width="100%" class="table-bordered table-dark table-striped display text-center" id="table_orders">
                    <thead>
                    <tr class="tableheaders">
                        <th class="linement"> Product Name </th>
                        <th class="linement"> Quantity </th>
                        <th class="linement"> Price </th>
                        <th class="linement"> Discount </th>
                        <th class="linement"> Total </th>
                        <th class="linement"> Date Ordered </th>
                        <th class="linement"> Date Delivered </th>
                        <th class="linement"> Date Paid </th>
                        <th class="linement"> Action </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr class="tableheaders">
                        <th class="linement"> Product Name </th>
                        <th class="linement"> Quantity </th>
                        <th class="linement"> Price </th>
                        <th class="linement"> Discount </th>
                        <th class="linement"> Total </th>
                        <th class="linement"> Date Ordered </th>
                        <th class="linement"> Date Delivered </th>
                        <th class="linement"> Date Paid </th>
                        <th class="linement"> Action </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php $db->db_select_table_order_customer_customer_id($ID); ?>
                    </tbody>
                </table>
            </div>
        </form>
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
