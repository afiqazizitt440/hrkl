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
        $attendancedate = mysqli_real_escape_string($con, $_POST["attendancedate"]);
        $date = explode("-", $attendancedate);
        $dated = $date[2]; //day
        $datem = $date[1]; //month
        $datey = $date[0]; //year
        //time
        $timeout = mysqli_real_escape_string($con, $_POST["timeout"]);
        $timeout24h = date("H:i:s", strtotime($timeout)); //12 h to 24 h
        $out = explode(":", $timeout24h);
        $timeouth = $out[0]; //hours
        $timeoutm = $out[1]; //minutes
        $timeouts = $out[2]; //seconds
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

                $closehours = $row2["closehours"];
                $closehours24h = date("H:i:s", strtotime($closehours)); //12 h to 24 h
                $close = explode(":", $closehours24h);
                $closehoursh = $close[0]; //hours
                $closehoursm = $close[1]; //minutes
                $closehourss = $close[2]; //seconds
                $closehoursconverted = mktime($closehoursh, $closehoursm, $closehourss, $datem, $dated, $datey, -1); //converted to mktime format
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
                if ($kilometers <= 0.1) { //check wheteher the employee is near the office or not...   
                    //if ($timeoutconverted < $closehoursconverted) { //if the employee is early
                        $query3 = "select timein from attendancerecord where email='$email' and attendancedate='$attendancedate'";
                        $result3 = mysqli_query($con, $query3);
                        while ($row3 = mysqli_fetch_array($result3)) {
                            $timein24h = date("H:i:s", strtotime($row3["timein"])); //retrieve the value to get calculate
                            //convert time to mktime()
                            $in = explode(":", $timein24h);
                            $timeinh = $in[0];
                            $timeinm = $in[1];
                            $timeins = $in[2];
                            $timeinconverted = mktime($timeinh, $timeinm, $timeins, $datem, $dated, $datey, -1);
                            if ($timeinconverted <= $openhoursconverted) { //check whether the employee is early or not
                                // // even if the employee time in earlier than 9.00 am, total should always start on business hours
                                //calculate the total hours worked for that day
                                $total = strtotime($timeout24h) - strtotime($openhours24h);
                                $hours = floor($total / 60 / 60); //get the total hours
                                $mins = round(($total - ($hours * 60 * 60)) / 60); //get the total minutes
                                $query4 = "update attendancerecord set timeout='$timeout24h',totalhours='$hours',totalmins='$mins' where email='$email' and attendancedate='$attendancedate'";
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
                                $query5 = "update attendancerecord set timeout='$timeout24h',totalhours='$hours',totalmins='$mins' where email='$email' and attendancedate='$attendancedate'";
                                if (mysqli_query($con, $query5)) {
                                    header("Location: AttendanceComplete.php");
                                } else {
                                    header("Refresh:0");
                                }
                            }
                        }
                    /*} else {
                        echo "<script type='text/javascript'>alert('Please state the reason of your early timeout in the space provided.');
              window.location.href='AttendanceOutt.php';
              </script>";
                    }*/
                } else {
                    echo "<script type='text/javascript'>alert('You are not near the office. Unable to record attendance.');
              window.location.href='AttendanceOut.php';
              </script>";
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
}
?>