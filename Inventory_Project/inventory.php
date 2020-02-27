<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/27/2020
 * Time: 9:25 AM
 */
include_once('includes/db_connection.php');
$db = new db_connection();
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
                        <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg"></i> Main Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href=""><i class="fa fa-clipboard fa-lg"></i> Inventory</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10 text-center">
        <form id="" action="" method="POST">
            <h1 id="lblList">STOCKS</h1>
            <div class="table-responsive-md">
                <table width="100%" class="table-bordered table-dark table-striped display" id="table_Accounts">
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
    <div class="col-md-1">
    </div>
</div>
</body>
</html>