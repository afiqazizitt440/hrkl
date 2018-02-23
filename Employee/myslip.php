<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    
    $queryq = "select * from staffinfosalary where email='$email'";
    $datac = mysqli_query($con, $queryq);
    $data = mysqli_fetch_object($datac);
    $id= $data->staffid;

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
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }
        </style>
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

            function month()
                {
                  mth=document.getElementById("mth").value;
                  yr=document.getElementById("yr").value;
                  si=document.getElementById("si").value;
                    
                  window.location.href=("payrollslip.php?mth="+mth+"&yr="+yr+"&id="+si+"");

                }
        </script>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

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

            /*Styles for left navbar*/
            div.inner-background {
                background: url(klematis.jpg) repeat;
                border: 2px solid black;
            }

            div.transbox {
                margin: 30px;
                background-color: #ffffff;
                border: 1px solid black;
                opacity: 0.6;
                filter: alpha(opacity=60); /* For IE8 and earlier */
            }

            div.transbox p {
                margin: 5%;
                font-weight: bold;
                color: #000000;
            }

            /* The side navigation menu */
            .sidenav {
                height: 100%; /* 100% Full-height */
                width: 0; /* 0 width - change this with JavaScript */
                position: fixed; /* Stay in place */
                z-index: 1; /* Stay on top */
                top: 0;
                left: 0;
                background-color: #111; /* Black*/
                overflow-x: hidden; /* Disable horizontal scroll */
                padding-top: 60px; /* Place content 60px from the top */
                transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
            }

            /* The navigation menu links */
            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s
            }

            /* When you mouse over the navigation links, change their color */
            .sidenav a:hover, .offcanvas a:focus{
                color: #f1f1f1;
            }

            /* Position and style the close button (top right corner) */
            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }

            f
        </style>

    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="employeeProfile.php">Home</a>
            <a href="Attendance.php">Attendance</a>
            <a href="Overtime.php">Overtime</a>
            <a href="#">Task</a>
            <a href="#">Leave</a>
            <a href="logout.php">Log Out</a>
        </div>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <!-- Use any element to open the sidenav -->
                    <button type="button" onclick="openNav()" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                </div>
                <p class="navbar-text"></p>
            </div>
        </nav>

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
                        <div class="row profile col-md-12" align="center">
                            <div class="profile-sidebar">
                                <div class="profile-user-pic">
                                    
                                </div>
                                    <div class="profile-user-title">
                                        
                                        <div class="profile-user-job">
                                            <label>Month</label>
                                            <select name="mth" id="mth">
                                                                              <option value="0">Select Month</option>
                                                                              <option value="01">January</option>
                                                                              <option value="02">Febuary</option>
                                                                              <option value="03">March</option>
                                                                              <option value="04">April</option>
                                                                              <option value="05">May</option>
                                                                              <option value="06">June</option>
                                                                              <option value="07">Julai</option>
                                                                              <option value="08">Ogos</option>
                                                                              <option value="09">September</option>
                                                                              <option value="10">Oktober</option>
                                                                              <option value="11">November</option>
                                                                              <option value="12">December</option>
                                            </select>
                                        </br>
                                            <input type="hidden" name="si" id="si" value="<?php echo $id; ?>">
                                            <label>Year</label>
                                            <select name="yr" id="yr">
                                                  <option value="00">Select Year</option>
                                                  <option value="2017">2017</option>
                                                  <option value="2018">2018</option>
                                                  <option value="2019">2019</option>
                                                  <option value="2020">2020</option>
                                            </select>
                                        </div>
                                        <div class="profile-user-buttons">
                                            <button onclick="month()">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
