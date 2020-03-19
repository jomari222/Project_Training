<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/27/2020
 * Time: 9:25 AM
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
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid bg-dark" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php"><i class="fa fa-home fa-lg"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-users fa-lg"></i> Users<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-dark">
                                <li class="nav-item active">
                                    <a class="nav-link text-white" href="new_user.php"><i class="fa fa-user-circle fa-lg"></i> New User</a>
                                    <a class="nav-link text-white" href="user_list.php"><i class="fa fa-user-check fa-lg"></i> User List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-alt fa-lg"></i>       Customer<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-dark">
                                <li class="nav-item active">
                                    <a class="nav-link text-white" href="new_customer.php"><i class="fa fa-user-circle fa-lg"></i> New Customer</a>
                                    <a class="nav-link text-white" href="customer.php"><i class="fa fa-user-check fa-lg"></i> Customer List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item active">
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
                            <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-minus fa-lg"></i>       Expenses<span class="caret"></span>   </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-dark">
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
                        <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-list-alt fa-lg"></i>       Reports<span class="caret"></span>   </button>
                        <ul class="dropdown-menu dropdown-menu-right bg-dark">
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="sales_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Sales Report</a>
                                <a class="nav-link text-white" href="stock_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Stock Report</a>
                                <a class="nav-link text-white" href="return_item_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Returned Item Report</a>
                                <a class="nav-link text-white" href="delivery_report.php"><i class="fa fa-clipboard-check fa-lg"></i> Delivery Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <button id="dropdrop" class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle fa-lg"></i> <?php $db->get_fullname_login(); ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right bg-dark">
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
    <div class="col-md-4">
        <div class="card bg-dark">
            <div class="card-header text-center text-white bg-dark">
                <h3 class="">Modify</h3>
            </div>
            <div class="card-body" id="card_body">
                <h2 class="text-center">Change Price</h2>
                <hr>
                <form action="includes/change_price.php" method="POST" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-12">
                        <label id="">Product name:
                            <select name="select_product_change_price" id="slc_product_inventory_change_price" onchange="" class="btn btn-dark dropdown-toggle form-control" required>
                                <?php $db->db_select_product(); ?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <label id="lbl_Price">Price:
                                <input type="number" class="form-control" id="txtNewPrice" name="fNewPrice" placeholder="Amount" value="" disabled required/>
                            </label>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="col-md-5">
                            <br>
                            <button class="btn btn-block btn-dark" type="submit" id="btnChangePrice" name="buttonChangePrice" disabled>Change Price</button>
                        </div>
                    </div>
                </div>
            </form>
                <form action="includes/add_or_remove_stock.php" method="POST" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center">Add/Remove Stock</h2>
                            <hr>
                            <label id="">Product name:
                                <select name="select_product_add_or_remove_stock" id="slc_product_inventory_add_or_remove_stock" onchange="" class="btn btn-dark dropdown-toggle form-control" required>
                                    <?php $db->db_select_product(); ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7">
                                <div id="txt_Amount">
                                    <label style="width: 100%" id="lbl_Add_Stock">Add Stock:
                                        <input type="number" class="form-control" id="txtAdd_Stock" name="fAdd_Stock" placeholder="" min="1" max="9999" value="" disabled required/>
                                    </label>
                                </div>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col-md-5">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-dark" type="submit" id="btnAdd_Stock" name="buttonAdd_Stock" disabled><i class="fa fa-plus fa-lg"></i></button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-dark" type="submit" id="btnMinus_Stock" name="buttonMinus_Stock" disabled><i class="fa fa-minus fa-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 text-center">
        <form id="" action="" method="POST">
            <h1 id="lblList">STOCKS</h1>
            <div class="table-responsive-md" id="table_div">
                <table width="100%" class="table-bordered table-dark table-striped display" id="table_Inventory">
                    <thead>
                    <tr class="tableheaders">
                        <th class="linement"> Product Name </th>
                        <th class="linement"> Price </th>
                        <th class="linement"> Stock </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr class="tableheaders">
                        <th class="linement"> Product Name </th>
                        <th class="linement"> Price </th>
                        <th class="linement"> Stock </th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <?php $db->db_select_product_table(); ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <form action="includes/add_product.php" method="POST" class="needs-validation" novalidate>
            <div class="card bg-dark">
                <div class="card-header text-center text-white bg-dark">
                    <h3 class="">New Product</h3>
                </div>
                <div class="card-body" id="card_body">
                    <label id="lbl_ProductName">Product Name: </label>
                    <input type="text" class="form-control" id="txtProductName" name="fProductName" placeholder="Enter Product Name" onkeypress="" required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <label id="lbl_ProductName">Price: </label>
                    <input type="text" class="form-control" id="txtNewProductPrice" name="fNewProductPrice" placeholder="Enter Price" onkeypress="" required/>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <br>
                    <label style="width: 100%" id="lbl_Add_Stock">Add Stock:</label>
                    <input type="number" class="form-control" id="txtAddNewProduct_Stock" name="fAddNewProduct_Stock" placeholder="" min="0" max="9999" value="" required/>
                </div>
                <div class="card-footer" id="card_footer">
                    <button class="btn btn-block btn-dark" type="submit" id="btnAddNewProduct" name="buttonAddNewProduct">Add New Product</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
</body>
</html>