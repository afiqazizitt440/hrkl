<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];

    if (isset($_GET["branchid"])) {
        $branchid = $_GET["branchid"];
        $deptid = $_GET["deptid"];
        $output = '';
        $query = "select personalinformation.*,employeeinformation.*,employeefinancial.*,employeeimage.* from             
        personalinformation join employeeinformation on personalinformation.email = employeeinformation.email
        join employeefinancial on employeeinformation.email = employeefinancial.email
        join employeeimage on employeefinancial.email = employeeimage.email
        where employeeinformation.branchid = '$branchid' and employeeinformation.deptid is null and employeeinformation.idcom = '$idcom'";
    } else {
        header("Location: admin.php");
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
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
        </script>
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
            <h4><?php echo $branchid ?></h4>
            <?php
            $query2 = "select deptname from dept where deptid = '$deptid'";
            $result2 = mysqli_query($con, $query2);
            while ($res2 = mysqli_fetch_array($result2)) {
                $deptname = $res2["deptname"];
                ?>
                <h4>Selected department : <?php echo $deptname;
        }
            ?></h4>
            <a href="ManageEmployees.php"><button type="button" class="btn btn-primary btn-md"><i class="fa fa-arrow-left"></i> Back To Manage Employees</button></a><br/><br/>
            <div class="alert alert-warning alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">x</a> 
                <i class="fa fa-exclamation-circle"></i>
                If the employee has been assigned into the branch, but the employee doesn't exist here, please make sure the employee hasn't been assigned to another department. <strong>If the employee has been assigned to another department in another branch, please make sure to remove the employee from the previous department first. </strong>
            </div>
            <h3>Unassigned Employees List</h3>
            <div id="employeeTable">
                <?php
                $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) !== 0){
                            ?>
                <table class="table table-responsize table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Employee ID</th>
                            <th>IC No.</th>
                            <th>Employee Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($result)) {
                            // output data of each row
                            ?>
                            <tr>
                                <td><?php echo $res['employeeid']; ?></td>
                                <td><?php echo $res['icno']; ?></td>
                                <td><?php echo $res['empname']; ?></td>
                                <td><button type="button" title="Details" name="view" id="<?php echo $res['email']; ?>" class="view_data btn btn-warning btn-sm" data-toggle="modal"  data-target="#viewEmployee"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                                    <a href="UpdateEmployeesDept.php?email=<?= $res["email"] ?>&deptid=<?= $deptid ?>"><button type="button" title="Assign to this department" class="btn btn-success btn-sm" onclick="return confirm('Are you sure to assign <?= $res["empname"]; ?> to this department ?');"><i class="fa fa-check"></i></button></a></td>
                            </tr>
                            <?php
                        }
                        }else{
                            echo '<center>No results found as unassigned employees in branch <span style="font-size:20px;">'.$branchid.'</span>.</center><br/>';
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
