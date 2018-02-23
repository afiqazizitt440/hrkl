<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        $attendancedateot = mysqli_real_escape_string($con, $_POST["attendancedateot"]);
        $date = explode("-", $attendancedateot);
        $dated = $date[2]; //day
        $datem = $date[1]; //month
        $datey = $date[0]; //year
        //time
        $timeoutot = mysqli_real_escape_string($con, $_POST["timeoutot"]);
        $timeout24h = date("H:i:s", strtotime($timeoutot)); //12 h to 24 h
        
        $query = "select branchid from employeeinformation where email='$email'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $branchid = $row["branchid"];
            $query2 = "select * from branch where branchid='$branchid'";
            $result2 = mysqli_query($con, $query2);
            while ($row2 = mysqli_fetch_array($result2)) {
                
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
                if ($kilometers <= 0.05){ //check wheteher the employee is near the office or not...   
                    $query3 = "select timeinot from overtimerecord where email='$email' and attendancedateot='$attendancedateot'";
                    $result3 = mysqli_query($con, $query3);
                    while ($row3 = mysqli_fetch_array($result3)) {
                        //retrieve the time in of overtime
                        $timein24h = date("H:i:s", strtotime($row3["timeinot"])); //retrieve the value to get calculate
                        $total = strtotime($timeout24h) - strtotime($timein24h);
                        $hours = floor($total/60/60); //get the total hours
                        $mins = round(($total - ($hours*60*60))/60); //get the total minutes
                    $query4 = "update overtimerecord set timeoutot='$timeout24h',totalhoursot='$hours',totalminsot='$mins' where email='$email' and attendancedateot='$attendancedateot'";
                    if (mysqli_query($con, $query4)) {
                        header("Location: OvertimeComplete.php");
                    } else {
                        header("Refresh:0");
                    }
                    }
                } else {
                    echo "<script type='text/javascript'>alert('You are not near the office. Unable to record Time Out.');
              window.location.href='OvertimeOut.php';
              </script>";
                }
            }
            }
    }
} else {
    header("Location: ../index.php");
}
?>