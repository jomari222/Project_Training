<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 24/04/2020
 * Time: 11:48 AM
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

$ID = $_GET['ID'];
$order_id = $_GET['order_id'];

$db->db_select_customer_customer_id($ID);
$db->db_select_table_order_for_checking($order_id);

if(isset($_POST['buttonDeliveryDone']))
{
$date_delivered = $_POST['txtDateDelivery'];

$db->db_update_order_delivery($order_id,$date_delivered);

header("Location: account.php?ID=" .$ID);
die();
}

if(isset($_POST['buttonPaymentDone']))
{
    $date_payment = $_POST['txtDatePaid'];
    $amount = $_POST['txtAmountPaid'];

    $db->db_order_payment_checking($order_id);
    if($amount > $db->total_payment_of_order)
    {
        include_once('includes/message.php');
        MessageBackAccountID('Your payment exceeds to the order bought.');
    }
    else
    {
        $db->db_update_order_payment($order_id,$date_payment,$amount);

        header("Location: account.php?ID=" . $ID);
        die();
    }
}
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

    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid">
<br>
<br>
<div class="row">
    <div class="col-md-4">
        <button class="btn btn-dark" type="submit" onclick="history.go(-1)" id="btnbacktocustomer" name="buttonbacktocustomer"><a class="fa fa-chevron-left fa-lg"></a> BACK</button>
    </div>
</div>
<br>
<hr>
<div class="col-md-12 text-center">
    <h1 id="lblList" name=""><?php $db->get_fullname(); ?></h1>
    <h1><?php $db->get_order_id_product_name(); ?></h1>
    <h1>Total: <?php $db->price_bought(); ?></h1>
    <h1>Credit: <?php $db->get_credit(); ?></h1>
    <h1>Last Paid: <?php $db->get_last_date(); ?></h1>
</div>
<hr>
<div id="frmpopup_modify">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-4">
            <form class="modal-content" action="" method="post">
                <div class="container">
                    <h1>Delivery</h1>
                    <hr>
                    <label><b>Date Delivered</b></label>
                    <?php if($db->order_id_delivery_date == '0000-00-00') { ?>
                        <input type="date" placeholder="Enter Date" name="txtDateDelivery" required>
                        <div class="clearfix">
                            <button name="buttonDeliveryDone" type="submit" class="signupbtn">Done</button>
                        </div>
                    <?php } else { ?>
                        <input type="date" placeholder="Enter Date" name="txtDateDelivery" value="<?php echo $db->order_id_delivery_date; ?>" readonly>
                        <div class="clearfix">
                            <button name="buttonDeliveryDone" type="submit" class="signupbtn" disabled>Done</button>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form class="modal-content" action="" method="post">
                <div class="container">
                    <h1>Payment</h1>
                    <hr>
                    <label><b>Date Paid</b></label>
                    <?php if($db->order_id_delivery_date != '0000-00-00' && $db->payment_received != $db->price_bought) { ?>
                        <input type="date" placeholder="Enter Date" name="txtDatePaid" required>

                        <label><b>Amount</b></label>
                        <input type="text" class="form-control" placeholder="Enter Amount" name="txtAmountPaid" required>

                        <div class="clearfix">
                            <button name="buttonPaymentDone" type="submit" class="signupbtn">Done</button>
                        </div>
                    <?php } else { ?>
                        <input type="date" placeholder="Enter Date" name="txtDatePaid" value="<?php echo $db->order_id_payment_date; ?>" readonly>

                        <label><b>Amount</b></label>
                        <input type="text" class="form-control" placeholder="Enter Amount" name="txtAmountPaid" value="<?php echo $db->paid_amount; ?>" readonly>

                        <div class="clearfix">
                            <button name="buttonPaymentDone" type="submit" class="signupbtn" disabled>Done</button>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
<br>
</body>
</html>
