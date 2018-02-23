<?php

include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $empname = $_SESSION["empname"];
    if ($_GET["empemail"] != null){
    $empemail = $_GET["empemail"];
    $background = "../images/hr-background.jpg";
    }else{
      header("Location: EmployeeList.php");  
    }
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
        <title>Organization</title>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .profile-user-pic{
                float: none;
                margin: 0 auto;
                width: 50%;
                height: 50%
            }


        </style>
        <script>
        function back() {
                window.history.back();
            }
        </script>
    </head>
    <body>
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
                        <li><a href="Home.php">Dashboard</a></li>
                        <li class="active"><a href="Employees.php">Organization</a></li>
                        <li><a href="ManageAttendance.php">Attendance</a></li>
                        <li><a href="LeaveSettings.php">Leave</a></li>
                        <li><a href="#contact">Payroll</a></li>
                        <li><a href="#contact">Calendar</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $empname ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-envelope"></i> Contact Support</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div id="main">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="container">
                            <div class="navbar-header">
                                <span class="navbar-brand">Employee Panel</span>
                            </div>
                            <p class="navbar-text"></p>
                        </div>
                    </nav>
                    <!-- edit profile panel -->
                    <div class="container" style=" background-color: white;">
                        <h1 class="page-header">Edit Email</h1>
                        <div class="row">
                                <!-- edit form column -->
                                <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                                    <div class="alert alert-danger alert-dismissable">
                                        <a class="panel-close close" data-dismiss="alert">X</a> 
                                        <i class="fa fa-exclamation-circle"></i>
                                        All fields must be <strong>filled.</strong>
                                    </div>
                                    <h3>Email Information</h3>
                                    <form action="updateEmail.php" method="post" class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <!--<label class="col-lg-3 control-label">Email :</label>-->
                                            <div class="col-lg-8">
                                                <label>Email</label><input name="empemail" id="empemail" class="form-control" value="<?php echo $empemail ?>" readonly/>
                                            </div>
                                            <div class="col-lg-8">
                                                <label>New Email</label><input name="newemail" id="newemail" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                                <button class="btn btn-success" type="submit" onclick="return confirm('Are you sure you want to change email for <?php echo $empemail; ?> ?')">Save Changes</button>
                                                <span></span>
                                                <input class="btn btn-default" value="Cancel" onclick="back()"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end of edit profile panel -->
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript
        ================================================== -->
            <script src="../js/jquery.min.js"></script>  
            <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
