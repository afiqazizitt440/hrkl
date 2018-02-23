<?php

include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    if (!empty($_POST)) {

        $output = '';
        //date
        $attendancedate = mysqli_real_escape_string($con, $_POST["attendancedate"]);
        $date = explode("-", $attendancedate);
        $dated = $date[2]; //day
        $datem = $date[1]; //month
        $datey = $date[0]; //year
        //time
        $timein = mysqli_real_escape_string($con, $_POST["timein"]);
        $timein24h = date("H:i:s", strtotime($timein)); //12 h to 24 h
        $time = explode(":", $timein24h);
        $timeinh = $time[0]; //hours
        $timeinm = $time[1]; //minutes
        $timeins = $time[2]; //seconds
        $timeinconverted = mktime($timeinh, $timeinm, $timeins, $datem, $dated, $datey, -1); //converted to mktime format

        $connectedip = mysqli_real_escape_string($con, $_POST["connectedip"]);
        $lat = mysqli_real_escape_string($con, $_POST["lat"]); //latitute
        $lng = mysqli_real_escape_string($con, $_POST["lng"]); //longitude
        $via = mysqli_real_escape_string($con, $_POST["via"]);

        //firstly, get the branch of that employee
        $query = "select branchid from employeeinformation where email='$email'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            //then, check the info about the branch
            if (!is_null($row["branchid"])){
            $branchid = $row["branchid"];
            $query2 = "select * from branch where branchid='$branchid'";
            $result2 = mysqli_query($con, $query2);
            while ($row2 = mysqli_fetch_array($result2)) {
                $latoffice = $row2["gmaplat"];
                $lngoffice = $row2["gmaplng"];
                $openhours = $row2["openhours"];
                $openhours24h = date("H:i:s", strtotime($openhours) + 600); //12 h to 24
                $open = explode(":", $openhours24h);
                $openhoursh = $open[0]; //hours
                $openhoursm = $open[1]; //minutes
                $openhourss = $open[2]; //seconds
                $openhoursconverted = mktime($openhoursh, $openhoursm, $openhourss, $datem, $dated, $datey, -1); //converted to mktime format
                }
                //calculate the distance between two points based on lat & lng 
                    $theta = $lngoffice - $lng;
                    $miles = (sin(deg2rad($latoffice)) * sin(deg2rad($lat))) + (cos(deg2rad($latoffice)) * cos(deg2rad($lat)) * cos(deg2rad($theta)));
                    $miles = acos($miles);
                    $miles = rad2deg($miles);
                    $miles = $miles * 60 * 1.1515;
                    $kilometers = $miles * 1.609344;
                //end of calculate distance between 2 points f()
                if($kilometers <= 0.10 ){ //check whether the employee is near the office 
                if ($timeinconverted <= $openhoursconverted) { //if the employee is early
                    //insert the attendance info of the employee
                    $query3 = "insert into attendancerecord(email,attendancedate,timein,lat,lng,connectedip,via) values('$email','$attendancedate','$timein24h','$lat','$lng','$connectedip','$via');";
                    if ($con->multi_query($query3)) {
                        header("Location: AttendanceOut.php");
                        echo '<script type="type/javascript">alert("Attendance Recorded successfully.")</script>';
                    } else {
                        header("Refresh:0");
                    }
                } else { //if the employee is late
                    echo "<script type='text/javascript'>alert('Please state the reason of your lateness/work shift in the space provided.');
              window.location.href='Attendancee.php';
              </script>";
                } 
            } else {
                echo "<script type='text/javascript'>alert('You are not near the office. Unable to record attendance.');
              window.location.href='Attendance.php';
              </script>";
            }        
    }else {
       echo "<script type='text/javascript'>alert('Your Manager has not set you to any branch. Please ask them to input your branch information.');
              window.location.href='Attendance.php';
              </script>";     
    }
}
} else {
    header("Location: ../index.php");
}
} else {
    header("Location: ../index.php");
}
?>