<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 3/23/2020
 * Time: 11:51 AM
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

$ID = $_GET['ID'];
$db->db_select_product_id($ID);

if(!filter_var($_GET['ID'], FILTER_VALIDATE_INT))
{
    header('Location:inventory.php');
    die();
}

$db->db_select_product_product_id($ID);

if(isset($_POST['buttonChangePrice']))
{
    $newPrice = $_POST['fNewPrice'];

    $value_newPrice = filter_var($newPrice, FILTER_VALIDATE_FLOAT);
    if($value_newPrice == 1)
    {
        include_once('includes/message.php');

        $db->db_update_product_price($ID, $newPrice);

        MessageBackInventory('Price has been change.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_member.php');
    }
}

if(isset($_POST['buttonAdd_Stock']))
{
    $addStock = $_POST['fAdd_Stock'];

    $value_addStock = filter_var($addStock, FILTER_VALIDATE_INT);
    if($value_addStock == 1)
    {
        include_once('includes/message.php');

        $db->db_select_Add_product_stock($ID,$addStock);

        MessageBackInventory('Stock has been added.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_member.php');
    }
}

if(isset($_POST['buttonMinus_Stock']))
{
    $minusStock = $_POST['fAdd_Stock'];

    $value_minusStock = filter_var($minusStock, FILTER_VALIDATE_INT);
    if($value_minusStock == 1)
    {
        include_once('includes/message.php');

        $db->db_select_Minus_product_stock($ID,$minusStock);

        MessageBackInventory('Stock has been deducted.');
    }
    else
    {
        session_start();
        session_destroy();
        header('Location: login_member.php');
    }
}

if($ID == null)
{
    header('Location:inventory.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jomari</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.3.1.js"></script>
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
        <form id="" action="includes/back_to_inventory.php" method="POST">
            <button class="btn btn-dark" type="submit" id="btnbacktoinventory" name="buttonbacktoinventory"><a class="fa fa-chevron-left fa-lg"></a> BACK</button>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="card bg-dark">
            <div class="card-header text-center text-white bg-dark">
                <h3 class="">Modify</h3>
            </div>
            <div class="card-body" id="card_body">
                <h1 class="text-center"><?php $db->get_product_name() ?></h1>
                <hr>
                <div class="row">
                    <div class="col-md-6" id="col_change_price">
                        <h2 class="text-center">Change Price</h2>
                        <h2 class="text-center"><?php $db->get_product_price(); ?></h2>
                        <hr>
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label id="lbl_Price">Price:
                                            <input type="number" class="form-control" id="txtNewPrice" name="fNewPrice" placeholder="Amount" min="0.00" step="any" value="" required/>
                                        </label>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-md-5">
                                        <br>
                                        <button class="btn btn-block btn-dark" type="submit" id="btnChangePrice" name="buttonChangePrice">Change Price</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-center">Add/Remove Stock</h2>
                                    <h2 class="text-center"><?php $db->get_product_stock(); ?></h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="txt_Amount">
                                            <label style="width: 100%" id="lbl_Add_Stock">Add Stock:
                                                <input type="number" class="form-control" id="txtAdd_Stock" name="fAdd_Stock" placeholder="" min="1" max="9999" value="" required/>
                                            </label>
                                        </div>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-md-5">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-block btn-dark" type="submit" id="btnAdd_Stock" name="buttonAdd_Stock"><i class="fa fa-plus fa-lg"></i></button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-block btn-dark" type="submit" id="btnMinus_Stock" name="buttonMinus_Stock"><i class="fa fa-minus fa-lg"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
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
