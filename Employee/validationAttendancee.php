<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    if (!empty($_POST)) {
        $output = '';
        $attendancedate = mysqli_real_escape_string($con, $_POST["attendancedate"]);
        $timein = mysqli_real_escape_string($con, $_POST["timein"]);
        $timein24h = date("H:i:s", strtotime($timein)); //12 h to 24 h
        
        $connectedip = mysqli_real_escape_string($con, $_POST["connectedip"]);
        $lat = mysqli_real_escape_string($con, $_POST["lat"]);
        $lng = mysqli_real_escape_string($con, $_POST["lng"]);
        $reasonlate = mysqli_real_escape_string($con, $_POST["reasonlate"]);
        $via = mysqli_real_escape_string($con, $_POST["via"]);
        $query = "insert into attendancerecord(email,attendancedate,timein,reasonlate,lat,lng,connectedip,via) values('$email','$attendancedate','$timein24h','$reasonlate','$lat','$lng','$connectedip','$via')";
        if ($con->multi_query($query)) {
            header("Location: AttendanceOut.php");
        } else {
            echo "<script type='type/javascript'>alert('Something wrong on' " . mysqli_errno($con) . ");</script>'";
        }
    }
} else {
    header("Location: ../index.php");
}
?>