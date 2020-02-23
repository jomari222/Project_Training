<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/25/2020
 * Time: 3:39 PM
 */
session_start();
$fPhone_number = $_SESSION['Phone_number_admin'];

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

if($fPhone_number == null)
{
    header('Location:login_master.php');
}
include_once('includes/db_connection.php');
$db_select_user = new db_connection();
$db_select_user->db_select_member_mainpage($fPhone_number);
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

    <link rel="stylesheet" type="text/css" href="css/mydesign.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid bg-dark">
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid bg-info" id="nav_bar">
            <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                <ul class="navbar-nav mr-md-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="code_activation_maker.php"><i class="fa fa-file-alt fa-lg"></i> Code Generation</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button id="dropdrop" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle fa-lg"></i> <?php $db_select_user->get_first_name(); ?> <?php $db_select_user->get_last_name(); ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right bg-info">
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
    <div class="col-2">

    </div>
    <div class="col-md-4">
        <div class="container-md p-5 text-white" id="dvLogin">
            <h1 id="lblLoginform" class="text-center">Activation Code</h1>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-info" onclick="saveTextAsFile()" type="submit" id="btnGenerate_Code" name="buttonGenerate_Code">Generate</button>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inline">
                            <p id="lblQty">Qty: </p>
                            <input style="width: 50%;" type="number" class="form-control" id="txtQty" name="fQuantity" value="1" max="100" min="1"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-5">
        <div class="container-md p-5 text-white" id="">
            <h1 id="" class="text-center">Generated Activation Codes</h1>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    include_once('includes/db_connection.php');
                    $add_Used = 0;
                    $db_insert = new db_connection();
                    if(isset($_POST['buttonGenerate_Code']))
                    {
                    ?>
                        <div style="width: 80%" class="" id="dv_text_area">
                            <textarea type="text" class="form-control" id="txtActivation_Code_" name="fActivation_Code_" rows="20" readonly><?php $db_insert->generate_activation_code($_POST['fQuantity'], $add_Used); ?></textarea>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button onclick="Copy()" class="btn btn-info btn-block" id="btnCopy" name="buttonCopy">Copy</button>
                                </div>
                                <div class="col-md-6">
                                    <button onclick="download()" class="btn btn-info btn-block" id="btnDownload" name="buttonDownload">Download</button>
                                </div>
                            </div>
                        </div>
                    <br>
                    <?php
                        /*else
                        {
                            include_once('db_connection.php');
                            $db_insert = new db_connection();
                            $db_insert->db_select_code_activation($add_Activation_code, $add_Used);
                        }*/
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">

    </div>
</div>
<br>
<br>
</body>
<?php include_once("includes/footer.php") ?>
</html>
