<?php
include "../util/connection.php";
$query = "select * from company order by idcom desc";
$result = mysqli_query($con, $query);
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
        <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>');</script>
        <?php
        $background = "images/hr-background.jpg";
        ?>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }
        </style>
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
                <a class="navbar-brand" href="#"><i class="fa fa-home"></i></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="CompList.php">Dashboard</a></li>
                    <li><a href=".php"></a></li>
                    <li><a href="#contact">Attendance</a></li>
                    <li><a href="#contact">Leave</a></li>
                    <li><a href="#contact">Payroll</a></li>
                    <li><a href="#contact">Calendar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/preferences"><i class="fa fa-cog"></i> Preferences</a></li>
                            <li><a href="/help/support"><i class="fa fa-envelope"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><a href="/auth/logout"><i class="icon-off"></i> Logout</a></li>
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
                        <span class="navbar-brand">Hi, </span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
        </div>
        <div class="container-fluid" style="background:white;" >
            <h2>Employees Profile List</h2>
            <br/>
            <div align="right">
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-sm add_data"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee</button>
            </div>
            <br/>
            <div id="employeeTable">
                <table class="table table-responsize table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th class="col-check"><input type="checkbox" id="checkall" onclick="test()"/></th>
                            <th>Employee ID</th>
                            <th>IC No.</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($result)) {
                            // output data of each row
                            ?>
                            <tr>
                                <td><input type="checkbox" name="employeeid[]" class="delete_employee checkthis" value="<?php echo $res["employeeid"]; ?>" /></td>
                                <td><?php echo $res['employeeid']; ?></td>
                                <td><?php echo $res['icno']; ?></td>
                                <td align="center"><button type="button" name="edit" id="<?php echo $res['employeeid']; ?>" class="update_data btn btn-success btn-sm edit_data" data-toggle="modal"  data-target="#editEmployee"><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>
                                <td align="center"><button type="button" name="view" id="<?php echo $res['employeeid']; ?>" class="view_data btn btn-warning btn-sm view_data" data-toggle="modal"  data-target="#viewEmployee"><span class="glyphicon glyphicon-menu-hamburger"></span> Details</button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
