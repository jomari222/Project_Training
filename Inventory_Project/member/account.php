<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/27/2020
 * Time: 10:59 AM
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

if (empty($_GET['ID'])):
    header("Location: customer.php");
    die();
endif;

$ID = $db->base64_url_decode($_GET['ID']);


$db->db_select_id($ID);

if(!filter_var($ID, FILTER_VALIDATE_INT))
{
    header('Location:customer.php');
    die();
}

$db->db_select_customer_customer_id($ID);

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
        header('Location: login_member.php');
    }
}
?>
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
<br>
<br>
<div class="row">
    <div class="col-md-4">
        <form id="" action="includes/back_to_main.php" method="POST">
            <button class="btn btn-dark" type="submit" id="btnbacktomain" name="buttonbacktomain"><a class="fa fa-chevron-left fa-lg"></a> BACK</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <form id="" action="" method="POST">
            <h1 id="lblList"><?php $db->get_fullname(); ?></h1>
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
                    <?php $db->db_select_table_order_customer_id($ID); ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <br>
        <div class="card bg-dark">
            <div class="card-header text-center text-white bg-dark">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="">Product</h3>
                    </div>
                </div>
            </div>
            <div class="card-body" id="card_body">
                <div class="row">
                    <form id="" action="" method="POST">
                        <div class="col-md-12" id="">
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                        <label id="">Product name:
                                            <select name="select_product" id="slc_product" onchange="showProduct(this.value)" class="btn btn-dark dropdown-toggle form-control" required>
                                                <?php $db->db_select_product(); ?>
                                            </select>
                                        </label>
                                    </form>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="txt_Amount">
                                            <label id="lbl_Amount">Amount:
                                                <input type="text" class="form-control" id="txtAmount" name="fAmount" placeholder="Amount" value="" readonly required/>
                                            </label>
                                        </div>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="width: 100%" id="lblQty">Quantity:
                                            <input type="number" class="form-control" id="txtQty" onkeypress="multiply_qty_amount()" oninput="multiply_qty_amount()" name="fQty" placeholder="Quantity" value="" max="9999" min="1" disabled required/>
                                        </label>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="txt_TotalAmount">
                                            <label id="lbl_Amount">Total amount:
                                                <input type="text" class="form-control" id="txtTotalAmount" name="fTotalAmount" placeholder="Total amount" value="" readonly required/>
                                            </label>
                                        </div>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-md-5">
                                        <label id="lblDiscount">Discount:
                                            <input type="number" class="form-control" id="txtDiscount" onkeypress="subtract_discount_amount()" oninput="subtract_discount_amount()" name="fDiscount" placeholder="Discount" required/>
                                        </label>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-block btn-dark" type="submit" id="btnInsertProduct" name="buttonInsertProduct">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
