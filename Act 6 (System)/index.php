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
    header('Location:mainpage.php');
}
?>
<html>
	<head>
		<title>Act 6</title>
		<link rel="stylesheet" type="text/css" href="css/design.css">
		<script src="js/myscript.js"></script>
	</head>
	<body>
		<div id="dvLogin">
			<form id="frmLogin" action="includes/login.php" method="POST">
				<img src="images/profileIcon.png" id="imgProfIcon"/>
				<h1 id="lblLoginform">LOGIN FORM</h1>
				<p id="lblUsername">Username: </p>
				<input type="text" id="txtUsername" name="fUsername" placeholder="Enter Username" maxlength="20" value="<?php echo $fUsername;?>" required/>
				<p id="lblPassword">Password: </p>
				<input type="password" id="txtPassword" name="fPassword" placeholder="Enter Password" maxlength="20" required/>
				<br>
                <label id="lblshowpassword"><input type="checkbox" id="chkShowPass" onclick="togglePassword()"/> Show Password</label>
				<br>
				<button type="Submit" id="btnLogin" name="buttonLogin">LOGIN</button>
				<br>
				<br>
                <br>
				<span id="lblForgotPass" onclick="forgotPassword()">Forgot <a href="#">Password?</a></span>
			</form>
		</div>
	</body>
</html>