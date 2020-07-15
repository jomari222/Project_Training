<?php
$Str = "Jomari";

$Value = preg_match("/^[a-zA-Z]+([a-zA-Z]+)*[^\s]+$/", $Str);

if($Value == 1)
{
    echo $Str;
    echo " Valid ";
}
else
{
    echo $Str;
    echo " invalid ";
}

$number = "0938625912222";
$Value2 = preg_match("/^[0][9][0-9]{9}$/u", $number);

if($Value2 == 1)
{
    echo $number;
    echo " Valid ";
}
else
{
    echo " Invalid ";
}

$Add_fUsername = "jomari_213_";
$value_Add_fUsername = preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9]+)*[^\s]+$/", $Add_fUsername);

if($value_Add_fUsername == 1)
{
    echo $Add_fUsername;
    echo " Valid ";
}
else
{
    echo " Invalid ";
}

$Add_ProductPrice = "500";
$value_Add_ProductPrice = preg_match("/^[1-9]+[0-9]+(?:\.[0-9]{1,3})?$/", $Add_ProductPrice);

if($value_Add_ProductPrice == 1)
{
    echo $Add_ProductPrice;
    echo " Valid ";
}
else
{
    echo " Invalid ";
}

$Add_Customer_ID = "90.1";
if(!filter_var($Add_Customer_ID, FILTER_VALIDATE_INT))
{
    echo " Invalid ";
}
else
{
    echo $Add_Customer_ID;
    echo " Valid ";
}

$date_delivered = "29-01-2020";
$value_date_delivered = preg_match("/^\d{2}-\d{2}-\d{4}$/", $date_delivered);
if($value_date_delivered == 1)
{
    echo $date_delivered;
    echo " Valid ";
}
else
{
    echo $date_delivered;
    echo " Invalid ";
}
?>