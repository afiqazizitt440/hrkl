<?php
session_start();
include "../util/connection.php";
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $background = "../images/hr-background.jpg";
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
        <style type="text/css">
            /* 
Generic Styling, for Desktops/Laptops 
            */
            table { 
                width: 100%; 
                border-collapse: collapse; 
            }
            /* Zebra striping */
            tr:nth-of-type(odd) { 
                background: #eee; 
            }
            th { 
                background: #333; 
                color: white; 
                font-weight: bold; 
            }
            td, th { 
                padding: 6px; 
                border: 1px solid #ccc; 
                text-align: left; 
            }
            /* 
            Max width before this PARTICULAR table gets nasty
            This query will take effect for any screen smaller than 760px
            and also iPads specifically.
            */
            @media 
            only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px)  {

                /* Force table to not be like tables anymore */
                table, thead, tbody, th, td, tr { 
                    display: block; 
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                thead tr { 
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr { border: 1px solid #ccc; }

                td { 
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee; 
                    position: relative;
                    padding-left: 50%; 
                }

                td:before { 
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%; 
                    padding-right: 10px; 
                    white-space: nowrap;
                }

                /*
                Label the data
                td:nth-of-type(1):before { content: "Employee Name"; }
                td:nth-of-type(2):before { content: "IC No"; }
                td:nth-of-type(3):before { content: "Action"; }
                */

            }
            
            .msg {border:1px solid #bbb; padding:5px; margin:10px 0px; background:#eee;}
        </style>
        <title>Leave</title>
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
        <script>
            $(function () {
                $("#applyleave").click(function () {
                    $('#tableEmployee').load('ApplyLeave.php');
                });
            });
            
            $(function () {
                $("#leavehistory").click(function () {
                    $('#tableEmployee').load('LeaveHistory.php');
                });
            });
            
            $(function () {
                $("#approveleave").click(function () {
                    $('#tableEmployee').load('LeaveApproval.php');
                });
            });
        </script>
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
                                <span class="navbar-brand">Leave Panel</span>
                            </div>
                            <p class="navbar-text"></p>
                        </div>
                    </nav>
                    <div class="container">
                        <!-- Panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-warning">Leave</div>
                            <div class="panel-body">
                                <div class="container-fluid" style="background:white;" >
                                    <div class="col-md-2" id="navarea"> <!-- left panel -->
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4>Category</h4>
                                                <input type="button" name="leavehistory" id="leavehistory" value="Leave History" class="btn btn-warning"/><br/><br/>
                                                <input type="button" name="applyleave" id="applyleave" value="Apply Leave" class="btn btn-info" />
                                                <?php
                                                $query = "select jobcategory from employeeinformation where email='$email'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_array($result);
                                                $exec = 'Executive';
                                                if( $row['jobcategory'] == $exec)
                                                    echo "<br/><br/><input type='button' name='approveleave' id='approveleave' value='Leave Approval' class='btn btn-success' />";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10"> <!-- right panel -->
                                        <div class="panel-body">
                                            <div id="tableEmployee">
                                                Please Select Category.
                                                <!-- External content -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
