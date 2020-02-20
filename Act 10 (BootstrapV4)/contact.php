<!DOCTYPE html>
<?php

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">

    <link rel="shortcut icon" href="images/home.ico"/>

    <title>BootstrapV4</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/dataTables.buttons.js"></script>
    <script src="js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <script src="fontawesome/js/all.js"></script>

    <link rel="stylesheet" type="text/css" href="css/design.css">
    <script src="js/myscript.js"></script>
</head>
<body class="container-fluid bg-dark">
<div class="row" id="bg">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-dark" id="dark-nav">
                        <ul class="navbar-nav mr-md-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="mainpage.php"><i class="fa fa-home fa-lg"></i> Main Page</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="contact.php"><i class="fa fa-phone-square-alt fa-lg"></i> Contact Us</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form class="active" id="frmnav" action="includes/logout.php" method="POST">
                                    <a class="nav-link" href="includes/logout.php"><i class="fa fa-sign-out-alt fa-lg"></i> Logout</a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-7">
                    <br>
                    <br>
                    <div id="dvcontact" class="container-md p-5 text-white">
                        <form id="frmcontact" action="" method="POST" class="needs-validation" novalidate>
                            <h1 id="lblcontact">Contact Us</h1>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="" id="p_first_name">First Name:</p>
                                        <input class="form-control" type="text" name="fFirst_name" id="contact_First_name" value="" pattern="[^'\x22][^1-9]+" required/>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="mr-md-2" id="p_last_name">Last Name:</p>
                                        <input class="form-control" type="text" name="fLast_name" id="contact_Last_name" value="" pattern="[^'\x22][^1-9]+" required/>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="mr-md-2" id="phone_number">Phone number:</p>
                                        <input class="form-control" type="text" name="fPhone_number" value="" pattern="[0-9]+" placeholder="Ex: 09123456789" minlength="11" maxlength="11" required/>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="mr-md-2" id="email_address">Email Address:</p>
                                        <input class="form-control" type="text" id="" name="fEmail_address" value="" placeholder="Ex: yourname@gmail.com..." required/>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label id="lblMessage">Message:</label>
                                        <textarea class="form-control" id="text_area_message" rows="5" required></textarea>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-block btn-info" id="btnSend" name="">Send Message</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d402.35898905957725!2d120.6125376407753!3d16.378781703282076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1577777547973!5m2!1sen!2sph" width="450" height="560" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>
</body>
<?php include_once("includes/footer.php") ?>
</html>
