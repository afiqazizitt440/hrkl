<?php
$background = "../images/hr-background.jpg";
?>
<style type="text/css">
    body {
        background-image: url('<?php echo $background; ?>');
    }
</style>
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
                <li ><a href="Home.php">Dashboard</a></li>
                <li><a href="Employees.php">Organization</a></li>
                <li><a href="ManageAttendance.php">Attendance</a></li>
                <li class="active"><a href="LeaveSettings.php">Leave</a></li>
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

