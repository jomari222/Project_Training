<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/19/2019
 * Time: 9:10 PM
 */
session_start();
session_destroy();
header('Location: ../login_member.php');
?>