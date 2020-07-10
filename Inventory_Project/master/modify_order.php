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

if (empty($_GET['order_id'])):
    header("Location: customer.php");
    die();
endif;

$order_id = $db->base64_url_decode($_GET['order_id']);
$db->db_select_order_id($order_id,$ID);

if(!filter_var($order_id, FILTER_VALIDATE_INT))
{
    header('Location:customer.php');
    die();
}

$db->db_select_customer_customer_id($ID);
$db->db_select_table_order_for_checking($order_id);

if(isset($_POST['buttonDeliveryDone']))
{
    $date_delivered = $_POST['txtDateDelivery'];

    $value_date_delivered = preg_match("/^\d{2}-\d{2}-\d{4}$/", $date_delivered);

    if($value_date_delivered == 1)
    {
        $db->db_order_payment_checking($order_id);

        if($date_delivered >= $db->date_ordered)
        {
            $db->db_update_order_delivery($order_id,$date_delivered);

            header("Location: account.php?ID=" . $_GET['ID']);
            die();
        }
        else
        {
            include_once('includes/message.php');
            MessageBackAccountID('Your date entry is invalid.');
        }
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_master.php');
    }
}

if(isset($_POST['buttonPaymentDone']))
{
    $date_payment = $_POST['txtDatePaid'];
    $amount = $_POST['txtAmountPaid'];

    $value_date_payment = preg_match("/^\d{2}-\d{2}-\d{4}$/", $date_payment);
    $value_amount = filter_var($amount, FILTER_VALIDATE_FLOAT);

    if($value_date_payment == 1 && $value_amount == 1)
    {
        $db->db_order_payment_checking($order_id);
        if($amount > $db->total_payment_of_order)
        {
            include_once('includes/message.php');
            MessageBackAccountID('Your payment exceeds to the order bought.');
        }
        elseif($date_payment < $db->date_delivered)
        {
            include_once('includes/message.php');
            MessageBackAccountID('Your date entry is invalid.');
        }
        else
        {
            $db->db_update_order_payment($order_id,$date_payment,$amount);

            header("Location: account.php?ID=" . $_GET['ID']);
            die();
        }
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_master.php');
    }
}

if(isset($_POST['buttonCancelOrder']))
{
    include_once('includes/message.php');
    MessageCancelOrder("Are you sure?",$order_id) ;
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
            <div class="container modal-content">
                <form class="" action="" method="post">
                    <?php if($db->order_id_delivery_date == '0000-00-00' && $db->cancelled == 0) { ?>
                        <div class="clearfix">
                            <button name="buttonCancelOrder" type="submit" class="signupbtn">Cancel Order</button>
                        </div>
                    <?php } else { ?>
                        <div class="clearfix">
                            <button name="buttonCancelOrder" type="submit" class="signupbtn" disabled>Cancel Order</button>
                        </div>
                    <?php } ?>
                    <hr style="width: 100%">
                    <h1>Delivery</h1>
                    <hr>
                </form>
                <form class="" action="" method="post">
                    <label><b>Date Delivered</b></label>
                    <?php if($db->order_id_delivery_date == '0000-00-00' && $db->cancelled == 0) { ?>
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
                </form>
            </div>
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
                        <input type="number" class="form-control" placeholder="Enter Amount" name="txtAmountPaid" min="1" step="any" required>

                        <div class="clearfix">
                            <button name="buttonPaymentDone" type="submit" class="signupbtn">Done</button>
                        </div>
                    <?php } else { ?>
                        <input type="date" placeholder="Enter Date" name="txtDatePaid" value="<?php echo $db->order_id_payment_date; ?>" readonly>

                        <label><b>Amount</b></label>
                        <input type="number" class="form-control" placeholder="Enter Amount" name="txtAmountPaid" min="1" step="any" value="<?php echo $db->paid_amount; ?>" readonly>

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
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
