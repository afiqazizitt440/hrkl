<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date('Y-m-d');
    $date = explode("-", $currentdate);
    $month = $date[1];
    $year = $date[0];
    switch ($month) {
        case 1: $monthString = "January";
            break;
        case 2: $monthString = "February";
            break;
        case 3: $monthString = "March";
            break;
        case 4: $monthString = "April";
            break;
        case 5: $monthString = "May";
            break;
        case 6: $monthString = "June";
            break;
        case 7: $monthString = "July";
            break;
        case 8: $monthString = "August";
            break;
        case 9: $monthString = "September";
            break;
        case 10: $monthString = "October";
            break;
        case 11: $monthString = "November";
            break;
        case 12: $monthString = "December";
            break;
        default: $monthString = "Invalid month";
            break;
    }
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
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script><!--Load the AJAX API-->
        <title>Attendance Summary</title>
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

            $(function () {
                $("#curve_chart").hide();
                $("#show").on("click", function () {
                    $("#curve_chart").toggle();
                });
            });
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages': ['corechart']});
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Date', 'Time In'],
                    ['2004', 1000]
                ]);
                var options = {
                    title: 'Attendance Summary',
                    curveType: 'function',
                    legend: {position: 'bottom'}
                };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
            }

        </script>
        <style type="text/css">
            input { 
                text-align: center; 
            }
        </style>
    </head>
    <?php include "navbar.php";?>

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand">Employee Attendance Summary</span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>

            <!--Content -->
            <div class="row">
                <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                    <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                        <div class="panel panel-primary">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                    Daily Attendance Summary
                                </h2>
                            </div>
                            <div class="panel-body">
                                <h3>
                                    <?php echo $_SESSION["empname"]; ?>
                                </h3>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Summary Attendance : <?php echo $monthString . " " . $year; ?></h4>
                                    <!--<button id="show">Show</button>
                                    <div id="curve_chart"></div>-->
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Attendance date</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $query = "select * from attendancerecord where email='$email' and month(attendancedate)='$month'";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $time1 = explode(":", $row["timein"]);
                                                    $timeinh = $time1[0];
                                                    $timeinm = $time1[1];
                                                    $time2 = explode(":", $row["timeout"]);
                                                    $timeouth = $time2[0];
                                                    $timeoutm = $time2[1];
                                                    ?>
                                                    <td><?php echo $row["attendancedate"]; ?></td>
                                                    <td><?php echo $timeinh .":".$timeinm ?></td>
                                                    <td><?php echo $timeouth .":".$timeoutm ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
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
