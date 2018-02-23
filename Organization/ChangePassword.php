<?php
session_start();
include "../util/connection.php";
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date("Y-m-d");
    $currenttime = date("g:i A");
} else {
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <title>Password Panel</title>
        <script>
            function CheckPassword(inputtxt)
            {
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                if (inputtxt.value.match(passw))
                {
                    return true;
                } else
                {
                    alert('Password must contain at least one numeric digit, one uppercase, and one lowercase letter.')
                    return false;
                }
            }

            $(function () {
                $(".katalaluan").keyup(function () {
                    var PasswordVal = $('.newpass').val();
                    var ConfirmPasswordVal = $('.checkpass').val();
                    if (PasswordVal != ConfirmPasswordVal && ConfirmPasswordVal.length > 0 && PasswordVal.length > 0) {
                        $('.ShowPasswordNotMatchesError').show();
                        $('#bt-submit').attr('disabled', true);
                        this.submit();
                    } else {
                        $('.ShowPasswordNotMatchesError').hide();
                        $('#bt-submit').attr('disabled', false);
                        this.submit();
                    }
                });
            });
        </script>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .required:after {
                color: red;
                content: ' *';
            }
        </style>
    </head>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="Home.php">Dashboard</a></li>
                    <li><a href="Employees.php">Organization</a></li>
                    <li><a href="ManageAttendance.php">Attendance</a></li>
                    <li><a href="LeaveSettings.php">Leave</a></li>
                    <li><a href="#contact">Payroll</a></li>
                    <li><a href="#contact">Calendar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["empname"]; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-envelope"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
            </nav>
            <br/><br/><br/><br/>
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="container">
                            <div class="navbar-header">
                                <span class="navbar-brand"></span>
                            </div>
                            <p class="navbar-text"></p>
                        </div>
                    </nav>
                    <!-- welcome content -->
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-warning"></div>
                            <div class="panel-body">
                                <table align="center" class="table table-responsive">
                                    <form id="change" name="change" accept-charset="UTF-8" action="validationForm.php" method="post">
                                        <div class="alert alert-danger alert-dismissable alert-xs ShowPasswordNotMatchesError" style="display:none;">
                                            <i class="fa fa-exclamation-circle"></i>
                                            New Password and Re-type Password field must be<strong> same.</strong>
                                        </div>
                                        <tr>
                                            <td><label class="required">Current Password</label></td><td><input name="pass" id="pass" placeholder="Current Password" type="password" required></td>
                                        </tr>
                                        <tr>
                                            <td><label class="required">New Password</label></td><td><input name="newpass" id="newpass" placeholder="New Password" type="password" class="katalaluan newpass" required></td>
                                        <tr>
                                            <td><label class="required">Re-type Password</label></td><td><input name="checkpass" id="checkpass" placeholder="Re-Type Password" type="password" class="katalaluan checkpass" onkeyup="" required></td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" class="btn btn-warning" id="bt-submit" value="Change Password" onclick="return CheckPassword(document.change.newpass)"/></td>
                                        </tr>
                                    </form>
                                </table>
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <script src="../js/jquery.min.js"></script>  
            <script src="../js/bootstrap.min.js"></script>
            <?php
            //}
            ?> 
            </body>
            </html>
