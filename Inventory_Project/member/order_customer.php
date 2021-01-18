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
//ORDER SUBMIT Malunggay
if(isset($_POST['buttonOrderMalunggay']))
{
    date_default_timezone_set('Asia/Manila');
    $date_ordered = date("Y-m-d H:i:s");

    $Add_Customer_ID = $ID;

    $Add_Product_ID = 2;

    $Add_Product_amount = $_POST['fAmount_Malunggay'];
    $Add_Quantity= $_POST['fQty_Malunggay'];
    $Add_Discount = 0;
    $Add_Total_amount = $_POST['fTotalAmount_Malunggay'];

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
            MessageOrderCustomerComplete('Order has been added.');
        }
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_members.php');
    }
}

//ORDER SUBMIT Mangosteen
if(isset($_POST['buttonOrderMangosteen']))
{
    date_default_timezone_set('Asia/Manila');
    $date_ordered = date("Y-m-d H:i:s");

    $Add_Customer_ID = $ID;

    $Add_Product_ID = 1;

    $Add_Product_amount = $_POST['fAmount_Mangosteen'];
    $Add_Quantity= $_POST['fQty_Mangosteen'];
    $Add_Discount = 0;
    $Add_Total_amount = $_POST['fTotalAmount_Mangosteen'];

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
            MessageOrderCustomerComplete('Order has been added.');
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
                    <li class="nav-item">
                        <a class="nav-link" href="account.php"><i class="fa fa-home fa-lg"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item active">
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
    <div class="col-md-1">

    </div>
    <div class="col-md-5">
        <div class="row container" id="bg-green_product">
            <form id="" action="" method="POST">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-white" align="center" id="">Malunggay and Banaba</h1>
                            <hr>
                            <img src="images/Malunggay_and_banaba.jpg" alt="Malunggay and banaba" id="malunggay_img" width="716" height="960">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 id="lbl_Amount" class="text-white">Amount
                                        <?php $db->Malunggay_Price(); ?>
                                        <input type="text" class="form-control" id="txtAmount_Malunggay" name="fAmount_Malunggay" placeholder="Amount" value="<?php echo $db->Malunggay_and_Banaba_Price; ?>" readonly required/>
                                    </h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="width: 100%" id="lblQty" class="text-white">Quantity
                                        <input type="number" class="form-control" id="txtQty_Malunggay" onkeypress="multiply_qty_amount_Malunggay()" oninput="multiply_qty_amount_Malunggay()" name="fQty_Malunggay" placeholder="Quantity" value="" max="9999" min="1" required/>
                                    </h3>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-white">Total
                                        <input type="text" class="form-control" id="txtTotalAmount_Malunggay" name="fTotalAmount_Malunggay" placeholder="Total amount" value="" readonly required/>
                                    </h2>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-success btn-block" type="submit" id="btnOrderMalunggay" name="buttonOrderMalunggay">Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row container" id="bg-green_product">
            <form id="" action="" method="POST">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-white" align="center" id="">Mangosteen Purple Corn</h1>
                            <hr>
                            <img src="images/Mangosteen_purple_corn.jpg" alt="Mangosteen purple corn" id="malunggay_img" width="720" height="960">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 id="lbl_Amount" class="text-white">Amount
                                        <?php $db->Mangosteen_Price(); ?>
                                        <input type="text" class="form-control" id="txtAmount_Mangosteen" name="fAmount_Mangosteen" placeholder="Amount" value="<?php echo $db->Mangosteen_Purple_Corn_Price; ?>" readonly required/>
                                    </h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="width: 100%" id="lblQty" class="text-white">Quantity
                                        <input type="number" class="form-control" id="txtQty_Mangosteen" onkeypress="multiply_qty_amount_Mangosteen()" oninput="multiply_qty_amount_Mangosteen()" name="fQty_Mangosteen" placeholder="Quantity" value="" max="9999" min="1" required/>
                                    </h3>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-white">Total
                                        <input type="text" class="form-control" id="txtTotalAmount_Mangosteen" name="fTotalAmount_Mangosteen" placeholder="Total amount" value="" readonly required/>
                                    </h2>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-success btn-block" type="submit" id="btnOrderMangosteen" name="buttonOrderMangosteen">Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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