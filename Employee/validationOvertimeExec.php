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
    $currentdate = date('m/d/Y h:i:s a', time());
    if (!empty($_POST)) {
        $output = '';
        //date
        $attendancedateot = mysqli_real_escape_string($con, $_POST["attendancedateot"]);
        $date = explode("-", $attendancedateot);
        $dated = $date[2]; //day
        $datem = $date[1]; //month
        $datey = $date[0]; //year
        //time
        $timeinot = mysqli_real_escape_string($con, $_POST["timeinot"]);
        $timein24h = date("H:i:s", strtotime($timeinot)); //12 h to 24 h
        
        $connectedip = mysqli_real_escape_string($con, $_POST["connectedip"]);
        $lat = mysqli_real_escape_string($con, $_POST["lat"]); //latitute
        $lng = mysqli_real_escape_string($con, $_POST["lng"]); //longitude
        $via = mysqli_real_escape_string($con, $_POST["via"]);
        $reasonot = mysqli_real_escape_string($con, $_POST["reasonot"]);
        //firstly, get the branch of that employee
        $branchid = mysqli_real_escape_string($con, $_POST["branchid"]);
        $query = "select * from branch where branchid='$branchid'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
                $latoffice = $row["gmaplat"];
                $lngoffice = $row["gmaplng"];
                
                //calculate the distance between two points based on lat & lng 
                    $theta = $lngoffice - $lng;
                    $miles = (sin(deg2rad($latoffice)) * sin(deg2rad($lat))) + (cos(deg2rad($latoffice)) * cos(deg2rad($lat)) * cos(deg2rad($theta)));
                    $miles = acos($miles);
                    $miles = rad2deg($miles);
                    $miles = $miles * 60 * 1.1515;
                    $kilometers = $miles * 1.609344;
                //end of calculate distance between 2 points f()
                if($kilometers <= 0.1 ){ //check wheter the employee is near the office 
                    //insert the attendance info of the employee
                    $query3 = "insert into overtimerecord(email,attendancedateot,timeinot,reasonot,lat,lng,connectedipot,via) values('$email','$attendancedateot','$timein24h','$reasonot','$lat','$lng','$connectedip','$via');";
                    if ($con->multi_query($query3)) {
                        header("Location: OvertimeExecOut.php");
                        echo '<script type="type/javascript">alert("Overtime Recorded successfully.")</script>';
                    } else {
                        header("Refresh:0");
                    }
                } else {
                    echo "<script type='text/javascript'>alert('You are not near the office. Unable to record Time In.');
              window.location.href='OvertimeExec.php';
              </script>";
                }
            
        }
    }
} else {
    header("Location: ../index.php");
}
?>