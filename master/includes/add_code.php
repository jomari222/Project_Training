<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 1/25/2020
 * Time: 4:39 PM
 */
include_once('db_connection.php');
$qty = $_POST['fQuantity'];
$add_Used = 0;
$db_insert = new db_connection();
if(isset($_POST['buttonAdd_Code']))
{
    for($i = 1; $i<=$qty; $i++)
    {
        $db_insert->db_select_activation_code();
        $db_insert->generate_activation_code();
        echo '<input type="text" class="form-control" id="txtActivation_Code_" name="fActivation_Code_" value='.$db_insert->activation_code_list.' />';
    }
    /*else
    {
        include_once('db_connection.php');
        $db_insert = new db_connection();
        $db_insert->db_select_code_activation($add_Activation_code, $add_Used);
    }*/
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jomari</title>

    <script src="../js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.js"></script>

    <script src="../js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <script src="../js/dataTables.buttons.js"></script>

    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
    <script src="../fontawesome/js/all.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/mydesign.css">
    <script src="../js/myscript.js"></script>
</head>
<body>
<div class="container-md p-5 text-white" id="">
    <h1 id="" class="text-center">Generated Activation Codes</h1>
    <div class="row">
        <div class="col-md-12" id="Activation_Code_List">
            <?php for($i = 1; $i<=$qty; $i++)
            { ?>

            <?php }; ?>
        </div>
    </div>
</div>
</body>
</html>
