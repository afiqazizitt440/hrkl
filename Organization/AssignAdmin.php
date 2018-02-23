<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    $query = "select personalinformation.email,personalinformation.icno,personalinformation.empname,employeeinformation.*,employeeimage.img,userprofile.* from personalinformation
            join employeeinformation on personalinformation.email = employeeinformation.email 
            join employeeimage on employeeinformation.email = employeeimage.email
            join userprofile on employeeimage.email = userprofile.email
            where employeeinformation.idcom='$idcom' and userprofile.email !='$email' order by employeeid desc;";
    $result = mysqli_query($con, $query);
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
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <script>
            $(document).ready(function () {

                $(document).on('click', '.view_data', function () { //start of view employee data modal
                    var email = $(this).attr("id");
                    if (email != '')
                    {
                        $.ajax({
                            url: 'select.php',
                            method: 'post',
                            data: {email: email},
                            success: function (data) {
                                $('#employeeDetail').html(data);
                                $('#viewEmployee').modal("show");
                            }
                        });
                    }
                });// end of view employee data modal
            });

            $("#changeStatus").click(function (event) {
                event.preventDefault();
                var email = $("#email").val();
                $.ajax({
                    type: "POST",
                    url: "updateAdmin.php",
                    data: {email: email},
                    success: function (dta)
                    {
                        $('#nonadminTable').html(dta);
                    }

                });
            });
        </script>
        <title>Organization</title>
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .loader {
                border: 8px solid #FFFFFF;
                border-radius: 50%;
                border-top: 8px solid #C0C0C0;
                width: 70px;
                height: 70px;
                -webkit-animation: spin 0.75s linear infinite;
                animation: spin 0.75s linear infinite;
            }

            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        <style>
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
                    <li><a href="Home.php">Dashboard</a></li>
                    <li class="active"><a href="Employees.php">Organization</a></li>
                    <li><a href="ManageAttendance.php">Attendance</a></li>
                    <li><a href="#contact">Leave</a></li>
                    <li><a href="#contact">Payroll</a></li>
                    <li><a href="#contact">Calendar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["empname"]; ?>  <span class="caret"></span></a>
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
    <br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand"></span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
        </div>
        <div class="container-fluid" style="background:white;" >
            <h2>Employees Administrative List</h2>
            <a href="Permission.php"><button type="button" class="btn btn-primary btn-md"><i class="fa fa-arrow-left"></i> Back To Administrator List</button></a><br/><br/>
            <div id="nonadminTable">
                <table class="table table-responsize table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Branch</th>
                            <th>Administrative</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($result)) {
                            // output data of each row
                            if ($res['is_admin'] == 1) {
                                $adminno = "Admin";
                            } else {
                                $adminno = "Non-Admin";
                            }
                            ?>
                            <tr>
                                <td><?php echo $res['employeeid']; ?></td>
                                <td><?php echo $res['empname']; ?></td>
                                <td><?php echo $res['branchid']; ?></td>
                                <td><?php echo $adminno; ?><input type="button" name="changeStatus" id="changeStatus" class="btn btn-info btn-xs" value="Change"/></td>
                                <td>
                                    <button type="button" title="Details" name="view" id="<?php echo $res['email']; ?>" class="view_data btn btn-warning btn-sm" data-toggle="modal"  data-target="#viewEmployee"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Employee Details -->
        <div id="viewEmployee" class="modal fade">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Employee Information</h4>
                    </div>
                    <div class="modal-body" id="employeeDetail">
                        <center><div class="loader"></div></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
