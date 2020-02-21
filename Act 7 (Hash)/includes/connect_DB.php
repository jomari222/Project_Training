<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 8/31/2018
 * Time: 10:12 AM
 */

    $server = "localhost";
    $username = "root";
    $password = "";
    $dbName = "login_db";

    $con = mysqli_connect($server, $username, $password, $dbName)
                or die("Failed To Connect".$con->connect_error);
?>