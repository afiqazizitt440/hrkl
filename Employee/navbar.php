<?php 
$background = "../images/hr-background.jpg";
?>        
<style type="text/css">

    body {
        background-image: url('<?php echo $background; ?>');
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
    
</style>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="employeeProfile.php">Home</a>
    <a href="Attendance.php">Attendance</a>
    <a href="Overtime.php">Overtime</a>
    <a href="#">Task</a>
    <!--<a href="myslip.php">Pay Slip</a>-->
    <a href="Leave.php">Leave</a>
    <a href="../Organization/EmployeeList.php">Employee List</a>
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
