<?php
session_start();
include "../util/connection.php";
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date("Y-m-d");
    $currenttime = date("g:i A");
    require('../util/user_info.php');
    $c_info = new Users_info;
    //$publicip = file_get_contents('https://api.ipify.org');
    $publicip = $_SERVER['REMOTE_ADDR'];
    $query = "select attendancedate from attendancerecord where email='$email' and attendancedate='$currentdate'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if (!is_null($row)) {
        header('Location: AttendanceOut.php');
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
        <title>Time In Panel</title>
        <?php

        $query2 = "select branchid from employeeinformation where email='$email'";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_array($result2);
        $branchid = $row2["branchid"];
        
        /**$query3 = "select staticip from branch where branchid='$branchid'";
        $result3 = mysqli_query($con, $query3);
        $row3 = mysqli_fetch_array($result3);
        $staticipbranch = $row3["staticip"];**/
        ?>
        <title>Employee Attendance Tracker</title>
        <script>

            /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                button.style.visibility = hidden;
            }

            /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
            
                            
            function onlocation(){
                 var lat = document.getElementById("lat").value;
                 var lng = document.getElementById("lng").value;
                 if (lat == null|| lat == "" , lng == null || lng == ""){
                     alert("Please Enable the GPS on your device. Then, refresh the browser.");
                     return false;
                 }
             }  
            
            //uncomment if get the attendance using IP Address
            /*function checkIp(){
                var connectedip = document.getElementById("connectedip").value;
                var staticipbranch = "<?php //echo $staticipbranch ?>";
                if (connectedip != staticipbranch){
                    alert("Please make sure the connection is connected to the office network before time in.");
                    return false;
                }
            }*/        
        </script>
        <style type="text/css">
            input { 
                text-align: center; 
            }

        </style>
        <script>
            var map, infoWindow, geocoder;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -34.397, lng: 150.644},
                    zoom: 17 // Why 17? suka hati la.
                });
                infoWindow = new google.maps.InfoWindow;
                geocoder = new google.maps.Geocoder;

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        $('#lat').val(pos['lat']);
                        $('#lng').val(pos['lng']);

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('You Are Here.');
                        infoWindow.open(map);
                        map.setCenter(pos);

                    }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }

        </script>
    </head>
    <?php include "navbar.php";?>

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand">Employee Attendance Tracker</span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
            <!-- welcome content -->
            <div class="row">
                <div class="col-md-5"> <!-- left panel -->
                    <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                        <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                            <p>Note that the marked location may not be as accurate if you logged in via Computer.</p>
                            <div id="map" style="width:100%;height:370px;"></div>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhuO-AuRQVU4Vw2VOO-hOPWZIhmwNWJOA&callback=initMap"></script>
                        </div>
                    </div>
                </div>

                <div class="col-md-3"> <!-- center panel -->
                    <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                        <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                            <div class="text-center">
                                <form action="validationAttendancee.php" method="post" onsubmit="return onlocation()">
                                    <h4 class="text-success">Tracker Details</h4>
                                    <input type="hidden" value="<?php echo $_SESSION["email"]; ?>" name="email" id="email"/>
                                    <label>Date </label><input type="text" name="attendancedate" id="attendancedate" value="<?php echo $currentdate; ?>" class="form-control" readonly/><br/>
                                    <label>Time </label><input type="text" name="timein" id="timein" class="form-control" value="<?php echo $currenttime; ?>" readonly/><br/>
                                    <label>Latitude </label><input type="" name="lat" id="lat" class="form-control" readonly/><br/>
                                    <label>Longitude </label><input type="text" name="lng" id="lng" class="form-control" readonly/><br/>
                                    <label>Reason for lateness/Work Shift</label><input type="text" name="reasonlate" id="reasonlate" class="form-control" required/><br/>
                                    <input type="hidden" name="connectedip" id="connectedip" value="<?php echo $publicip ?>" class="form-control" /><br/>
                                    <input type="hidden" name="via" id="via" value="<?php echo $c_info->c_Device(); ?>"/>
                                    <button class="btn btn-success btn-md" type="submit">Time In <i class="fa fa-map-marker"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4"> <!-- right panel -->
                    <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                        <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                                    <h4 class="text-success">Device Details</h4>
                                    <p>Logged in via <?php echo $c_info->c_Device(); ?></p>
                                    <label>Operating System  : <?php echo $c_info->c_OS(); ?></label><br/>
                                    <label>Browser : <?php echo $c_info->c_Browser(); ?></label><br/>
                                    <label>Local IP Address : <?php echo $c_info->c_ip(); ?></label><br/>
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
        <?php
        //}
        ?> 
    </body>
</html>
