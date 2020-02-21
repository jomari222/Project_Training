<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['Username']))
{
    $_SESSION['Username'] = null;
}
$fUsername = $_SESSION['Username'];
if($_SESSION['Username'] != null)
{
    header('login.php');
}

//include_once("namespace.php");
//Hello();
include_once("datamanager.php");
include_once("db_connection.php");
//Objects or Instantiation
/*$firstname = new AddingOfEmployee();
$lastname = new AddingOfEmployee();
$setfirstname = new AddingOfEmployee();
$sumoftwonum = new AddingOfEmployee();
$subtraction = new AddingOfEmployee();
$multiply = new AddingOfEmployee();
$division = new AddingOfEmployee();
$modulo = new AddingOfEmployee();
$printData = new RetreiveAll_Data();

$test=array(2);

$test[0]=new Data2();
$test[1]=new Data3();
$test[2]=new Data4();

for($i=0;$i<3;$i++)
{
    $test[$i]->run();
}

$printData->PrintALL();
$sumoftwonum->setaddition("2", "5");
$sumoftwonum->getaddition();
$subtraction->setsubtraction("2", "5");
$subtraction->getsubtraction();
$multiply->setmultiplication("2", "5");
$multiply->getmultiplication();
$division->setdivision("2", "5");
$division->getdivision();
$modulo->setmodulo("2", "5");
$modulo->getmodulo();

$firstname->firstname();
$lastname->lastname();

$setfirstname->setfirstname("<br>Jimmy");
$setfirstname->getfirstname();

/*$num = new Practice("<br><br>300<br>");
$num->show_num();
$num = new Practice1("<br><br>200<br>");
$num->show_num();
*/
$db_connection = new db_connection();
$db_connection->db_select_tblemployee('4');
$db_connection->get_employee_id();
$db_connection->get_first_name();
$db_connection->get_last_name();
$db_connection->get_gender();
$db_connection->get_status();
$db_connection->db_select_tblempposition('2');
$db_connection->get_position();

//$employee_data = new employee_data();
//$employee_data->get_employee_id();
//$employee_data->get_first_name();
//$db_connection->db_insert("tbluser (fEmployeeID, fUsername, fPassword)VALUES(10, 'JOJO', 'LEE')");
//$db_connection->db_insert_tbluser("10","JOJO","ROCK")
?>
<html>
	<head>
		<title>Act 8</title>
	</head>
	<body>
    <form id="" action="login.php" method="POST">
        <h1 id="lblLoginform">LOGIN FORM</h1>
        <p id="lblUsername">Username: </p>
        <input type="text" id="txtUsername" name="fUsername" placeholder="Enter Username" value="" required/>
        <p id="lblPassword">Password: </p>
        <input type="password" id="txtPassword" name="fPassword" placeholder="Enter Password" required/>
        <br>
        <br>
        <button type="Submit" id="btnLogin" name="buttonLogin">LOGIN</button>
    </form>
    </body>
</html>