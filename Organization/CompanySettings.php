<?php
include "../util/connection.php";
session_start();
if(array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])){
    $idcom = $_SESSION["idcom"];
    
    $query = "select * from company where idcom = '$idcom'";
    $result = mysqli_query($con, $query);

} else{
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
        ?>
        <style type="text/css">
                                                                                                                                                                                                                                                                                            
            body {
                background-image: url('<?php echo $background; ?>');
            }
        </style>
        <script>
            function confirmation() {
                if (confirm("Are you sure?") == true) {
                    return true;
                } else {
                    return false;
                }
            }
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
                    <li class="active"><a href="Home.php">Dashboard</a></li>
                    <li><a href="Employees.php">Organization</a></li>
                    <li><a href="ManageAttendance.php">Attendance</a></li>
                    <li><a href="LeaveSettings.php">Leave</a></li>
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
    <div id="main">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <span class="navbar-brand">Company Panel</span>
                        </div>
                        <p class="navbar-text"></p>
                    </div>
                </nav>
                <?php
                while ($res = mysqli_fetch_array($result)) {
                    // output data of each row
                    ?>
                    <!-- edit profile panel -->
                    <div class="container" style=" background-color: white;">
                        <h1 class="page-header">Company Settings</h1>
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="text-center">
                                    <?php
                                            if (!empty($res["logo"]) && is_file('logo/' .$res["logo"])) {
                                                echo"<center><img src='logo/" . $res["logo"] . "' class='img img-responsive img-thumbnail'></center>";
                                            } else { 
                                            echo "<center><img src='logo/nologo.png'  class='img img-responsive' alt='Default Logo Pic'></center>";
                                            }
                                            ?>
                                        
                                        <h6>Upload Company Logo</h6>
                                        <form action="uploadLogo.php" method="post" enctype="multipart/form-data">
                                            <input type="file" name="image" id="image" class="text-center center-block well well-sm">
                                            <button type="submit" class="btn btn-primary" name="bt-submit">Upload <span class="glyphicon glyphicon-upload"></span></button>
                                        </form>
                                        </div>
                                </div>
                            <!-- edit form column -->
                            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                                <h3>Company Information</h3>
                                <form action="updateCompany.php" method="post" class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Company ID :</label>
                                        <div class="col-lg-6">
                                            <input name="idcom" id="idcom" class="form-control" value="<?php echo $res['idcom']; ?>" type="text" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Company Name :</label>
                                        <div class="col-lg-6">
                                            <input name="comname" id="comname" class="form-control" value="<?php echo $res['comname']; ?>" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Company Registration #:</label>
                                        <div class="col-lg-6">
                                            <input name="regno" id="regno" class="form-control" value="<?php echo $res['regno']; ?>" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">HQ Location :</label>
                                        <div class="col-lg-6">
                                            <select name="location" id="location" class="form-control">
                                                <?php $valloc = $res["location"]; ?>
                                                <option value="WP KUALA LUMPUR" <?php if ($valloc == "WP KUALA LUMPUR") echo 'selected="selected"'; ?>>WP KUALA LUMPUR</option>
                                                <option value="WP LABUAN" <?php if ($valloc == "WP LABUAN") echo 'selected="selected"'; ?>>WP LABUAN</option>
                                                <option value="PUTRAJAYA" <?php if ($valloc == "WP PUTRAJAYA") echo 'selected="selected"'; ?>>PUTRAJAYA</option>
                                                <option value="JOHOR" <?php if ($valloc == "JOHOR") echo 'selected="selected"'; ?>>JOHOR</option>
                                                <option value="KEDAH" <?php if ($valloc == "KEDAH") echo 'selected="selected"'; ?>>KEDAH</option>
                                                <option value="KELANTAN" <?php if ($valloc == "KELANTAN") echo 'selected="selected"'; ?>>KELANTAN</option>
                                                <option value="MELAKA" <?php if ($valloc == "MELAKA") echo 'selected="selected"'; ?>>MELAKA</option>
                                                <option value="NEGERI SEMBILAN" <?php if ($valloc == "NEGERI SEMBILAN") echo 'selected="selected"'; ?>>NEGERI SEMBILAN</option>
                                                <option value="PAHANG" <?php if ($valloc == "PAHANG") echo 'selected="selected"'; ?>>PAHANG</option>
                                                <option value="PERAK" <?php if ($valloc == "PERAK") echo 'selected="selected"'; ?>>PERAK</option>
                                                <option value="PERLIS" <?php if ($valloc == "PERLIS") echo 'selected="selected"'; ?>>PERLIS</option>
                                                <option value="PULAU PINANG" <?php if ($valloc == "PULAU PINANG") echo 'selected="selected"'; ?>>PULAU PINANG</option>
                                                <option value="SABAH" <?php if ($valloc == "SABAH") echo 'selected="selected"'; ?>>SABAH</option>
                                                <option value="SARAWAK" <?php if ($valloc == "SARAWAK") echo 'selected="selected"'; ?>>SARAWAK</option>
                                                <option value="SELANGOR" <?php if ($valloc == "SELANGOR") echo 'selected="selected"'; ?>>SELANGOR</option>
                                                <option value="TERENGGANU" <?php if ($valloc == "TERENGGANU") echo 'selected="selected"'; ?>>TERENGGANU</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-6">
                                            <input type="submit" class="btn btn-success" value="Save Changes" onclick="return confirmation()"/>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end of edit profile panel -->
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
</body>
</html>
