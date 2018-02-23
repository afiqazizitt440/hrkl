<?php

include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date('Y-m-d');
    if (!empty($_POST)) {
        //get the current location of the employee
        $lat = mysqli_real_escape_string($con, $_POST["lat"]);
        $lng = mysqli_real_escape_string($con, $_POST["lng"]);
        //date
        $reasonout = mysqli_real_escape_string($con, $_POST["reasonout"]);
        $attendancedate = mysqli_real_escape_string($con, $_POST["attendancedate"]);
        $date = explode("-", $attendancedate);
        $dated = $date[2]; //day
        $datem = $date[1]; //month
        $datey = $date[0]; //year
        //time
        $timeout = mysqli_real_escape_string($con, $_POST["timeout"]);
        $timeout24h = date("H:i:s", strtotime($timeout)); //12 h to 24 h
        $time = explode(":", $timeout24h);
        $timeouth = $time[0]; //hours
        $timeoutm = $time[1]; //minutes
        $timeouts = $time[2]; //seconds
        $timeoutconverted = mktime($timeouth, $timeoutm, $timeouts, $datem, $dated, $datey, -1); //converted to mktime format

        $query = "select branchid from employeeinformation where email='$email'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $branchid = $row["branchid"];
            $query2 = "select * from branch where branchid='$branchid'";
            $result2 = mysqli_query($con, $query2);
            while ($row2 = mysqli_fetch_array($result2)) {
                $openhours = $row2["openhours"];
                $openhours24h = date("H:i:s", strtotime($openhours)); //12 h to 24 h
                $open = explode(":", $openhours24h);
                $openhoursh = $open[0]; //hours
                $openhoursm = $open[1]; //minutes
                $openhourss = $open[2]; //seconds
                $openhoursconverted = mktime($openhoursh, $openhoursm, $openhourss, $datem, $dated, $datey, -1); //converted to mktime format

                $query3 = "select * from attendancerecord where email='$email' and attendancedate='$attendancedate'";
                $result3 = mysqli_query($con, $query3);
                while ($row3 = mysqli_fetch_array($result3)) {
                    $timein = $row3["timein"]; //retrieve the value to get calculate
                    $timein24h = date("H:i:s", strtotime($timein));
                    $time2 = explode(":", $timein24h);
                    $timeinh = $time2[0];
                    $timeinm = $time2[1];
                    $timeins = $time2[2];
                    $timeinconverted = mktime($timeinh, $timeinm, $timeins, $datem, $dated, $datey, -1);
                    
                    //retrieve the employee working branch
                    $latoffice = $row2["gmaplat"];
                    $lngoffice = $row2["gmaplng"];
                    
                    //calculate the distance between two points based on lat & lng 
                    $theta = $lngoffice - $lng;
                    $miles = (sin(deg2rad($latoffice)) * sin(deg2rad($lat))) + (cos(deg2rad($latoffice)) * cos(deg2rad($lat)) * cos(deg2rad($theta)));
                    $miles = acos($miles);
                    $miles = rad2deg($miles);
                    $miles = $miles * 60 * 1.1515;
                    $kilometers = $miles * 1.609344;
                    //end of calculate distance between 2 points f()
                    if ($kilometers <= 0.1){ // check whether the employee is near the office or not...
                    if ($timeinconverted <= $openhoursconverted) { //check whether the employee is early or not
                    // even if the employee time in earlier than 9.00 am, total should always start on business hours
                    //calculate the total hours worked for that day
                    $total = strtotime($timeout24h) - strtotime($openhours24h);
                    $hours = floor($total / 60 / 60); //get the total hours
                    $mins = round(($total - ($hours * 60 * 60)) / 60); //get the total minutes
                    $query4 = "update attendancerecord set timeout='$timeout24h',totalhours='$hours',totalmins='$mins',reasonout='$reasonout' where email='$email' and attendancedate='$attendancedate'";
                    if (mysqli_query($con, $query4)) {
                        header("Location: AttendanceComplete.php");
                    } else {
                        header("Refresh:0");
                    }
                } else {
                    //calculate the total hours worked for that day
                    $total = strtotime($timeout24h) - strtotime($timein24h);
                    $hours = floor($total / 60 / 60); //get the total hours
                    $mins = round(($total - ($hours * 60 * 60)) / 60); //get the total minutes
                    $query5 = "update attendancerecord set timeout='$timeout24h',totalhours='$hours',totalmins='$mins',reasonout='$reasonout' where email='$email' and attendancedate='$attendancedate'";
                    if (mysqli_query($con, $query5)) {
                        header("Location: AttendanceComplete.php");
                    } else {
                        header("Refresh:0");
                    }
                }
                } else {
                    echo "<script type='text/javascript'>alert('You are not near the office. Unable to record attendance.');
              window.location.href='AttendanceOutt.php';
              </script>";
                }
                }
                
            }
        }
    }
} else {
    header("Location: ../index.php");
}
?>