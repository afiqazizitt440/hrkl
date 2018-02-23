<?php
include "../util/connection.php";
session_start();
// Grab User submitted information
$email = $_POST["email_"];
$pass = $_POST["pass_"];

$result = mysqli_query($con, "SELECT * FROM admin_org WHERE email = '$email'");

$row = mysqli_fetch_array($result);

if($row["email"]==$email && $row["pass"]==$pass){
    $result2 = mysqli_query($con, "select admin_org.email,admin_org.idcom, personalinformation.empname from admin_org join personalinformation on admin_org.email = personalinformation.email where admin_org.email = '$email'");
    $row2 = mysqli_fetch_array($result2);
    $_SESSION["email"] = $email;
    $_SESSION["idcom"] = $row2["idcom"];
    $_SESSION["empname"] = $row2["empname"];
    header("Location: Home.php");
}    
else
    header('Location: errorAdmin.php');
?>