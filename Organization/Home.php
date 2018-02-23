<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $query = "select company.comname, company.idcom, company.logo, admin_org.email, personalinformation.empname, employeeimage.img from company join admin_org on company.idcom = admin_org.idcom
join personalinformation on admin_org.email = personalinformation.email 
join employeeimage on admin_org.email = employeeimage.email where admin_org.email='$email'";
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
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Dashboard</title>
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
        $background = "../images/hr-background.jpg";

        while ($res = mysqli_fetch_array($result)) {
            // fetch the data from database
            ?>
            <style type="text/css">

                body {
                    background-image: url('<?php echo $background; ?>');
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
            </div>
        </nav>
        <br/><br/><br/><br/>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand">Welcome, <?php echo $_SESSION["empname"]; ?> </span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>

            <div class="col col-lg-2" align="left">
                <div class="panel panel-default">
                    <div class="panel-heading panel-warning">User Panel</div>
                    <div class="panel-body"><center><?php
                            if (!empty($res["img"]) && is_file('../Employee/employeepictures/' . $res["img"])) {
                                echo"<img src='../Employee/employeepictures/" . $res["img"] . "' class='img img-responsive img-thumbnail'/>";
                            } else {
                                echo "<img src='https://guarddome.com/assets/images/profile-img.jpg'  class='img img-responsive img-thumbnail' alt='Default Profile Pic'/>";
                            }
                            ?>
                        </center>
                    </div>
                    <center>
                        <a href="EditInformation.php" class="link">Edit Profile</a><br/>
                        <a href="ChangePassword.php" class="link">Change Password</a>
                    </center><br/>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <div class="col col-lg-10" class="pull-right">
                <div class="panel panel-default">
                    <div class="panel-heading panel-warning">Company Information</div>
                    <div class="panel-body">
                        <?php
                            echo"<center><img src='logo/" . $res["logo"] . "' class='img img-responsive' width='304' height='236'/></center>";
                        ?>
                        <h3 align="center"><?php echo $res['comname']; ?></h3>
                    </div>
                    <center>

                    </center><br/>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="panel panel-default">
                <div class="panel-heading panel-warning" align="center">Management Panel</div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <td align="center">
                                    <a href="CompanySettings.php">
                                        <i class="fa fa-cogs fa-5x img-responsive center-block table-hover"></i>
                                        <p class="label-entrypoint ">Company Settings</p>
                                    </a>
                                </td>
                                <td align="center">
                                    <a href="ManageAttendance.php">
                                        <i class="fa fa-check-square-o fa-5x img-responsive center-block table-hover"></i>
                                        <p class="label-entrypoint ">Manage Attendance <br/>& Overtime</p>
                                    </a>
                                </td>
                                <td align="center">
                                    <a href="/leave/policies">
                                        <i class="fa fa-plane fa-5x img-responsive center-block table-hover"></i>
                                        <p class="label-entrypoint ">Leave Settings</p>
                                    </a>
                                </td>
                                <td align="center">
                                    <a href="BranchList.php">
                                        <i class="fa fa-code-fork fa-5x img-responsive center-block table-hover"></i>
                                        <p class="label-entrypoint ">Manage Branches</p>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <script src="../js/bootstrap.min.js"></script>
        <?php
    }
    ?> 
</body>
</html>
