<?php
session_start();
include "../util/connection.php";
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $background = "../images/hr-background.jpg";
    $query = "select userprofile.*,employeeimage.* from userprofile join employeeimage on userprofile.email = employeeimage.email where userprofile.email='$email'";
    $result = mysqli_query($con, $query);
} else {
    header("Location: ../index.php");
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
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <title>Home</title>
        <script>
            /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                button.style.visibility = hidden;
            }

            /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <style type="text/css">
            .profile{
                margin: 10px 0;
            }
            .profile-sidebar{
                padding: 20px 0 5px 0;
                background: #fff;
            }
            .profile-user-pic{
                float: none;
                margin: 0 auto;
                width: 50%;
                height: 50%
            }
            .profile-user-job{
                text-transform: uppercase;
                color: #5babd1;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 15px;
            }
            .profile-user-title{
                text-align: center;
                margin-top: 20px;
            }
            .profile-user-name{
                color: #5a73a1;
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 7px;
            }
            .profile-user-buttons{
                text-align: center;
                margin-top: 10px;
            }

        </style>
    </head>
    <body>
        <?php include "navbar.php";?>

        <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
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
                    <div class="container">
                        <div class="row profile col-md-3">
                            <div class="profile-sidebar">
                                <div class="profile-user-pic">
                                    <?php
                                    while ($res = mysqli_fetch_array($result)) {
                                        // fetch the data from database
                                            if (!empty($res["img"]) && is_file('employeepictures/' .$res["img"])) {
                                                echo"<center><img src='employeepictures/" . $res["img"] . "' class='img img-responsive img-thumbnail'></center>";
                                            } else {
                                                echo "<center><img src='employeepictures/default.jpg'  class='img img-responsive img-thumbnail' alt='Default Profile Pic'></center>";
                                            }
                                    }
                                        ?>
                                </div>
                                    <div class="profile-user-title">
                                        <div class="profile-user-name">
                                            <?php echo $_SESSION["empname"]; ?>
                                        </div>
                                        <div class="profile-user-job">
                                            Jobs
                                        </div>
                                        <div class="profile-user-buttons">
                                            <a href="employeeInformation.php"><button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-cog"></span> Edit Information</button></a>
                                            <a href="ChangePassword.php"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-lock"></span> Change Password</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Task Panel -->
                            <div class="panel panel-default">
                                <div class="panel-heading panel-warning">Task</div>
                                <div class="panel-body">
                                </div>
                                <div class="panel-footer"></div>
                            </div>
                            <!-- End of Task Panel -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap core JavaScript
        ================================================== -->
            <script src="../js/jquery.min.js"></script>  
            <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
