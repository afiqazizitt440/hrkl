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
    $empname = $_SESSION["empname"];
    if($_POST['empemail'] != null){
    //staff ref email
    $empemail = mysqli_real_escape_string($con, $_POST['empemail']);
    //staff new email
    $newemail = mysqli_real_escape_string($con, $_POST['newemail']);
    
    $query = "update userprofile set email='$newemail' where email='$empemail';";
    $query .= "update personalinformation set email='$newemail' where email='$empemail';";
    $query .= "update employeeinformation set email='$newemail' where email='$empemail';";
    $query .= "update employeefinancial set email='$newemail' where email='$empemail';";
    $query .= "update employeeimage set email='$newemail' where email='$empemail';";
    $query .= "update attendancerecord set email='$newemail' where email='$empemail';";
    $query .= "update overtimerecord set email='$newemail' where email='$empemail';";
    if ($con->multi_query($query)){
        echo "<script type='text/javascript'>alert('Email ".$empemail." has been updated to ".$newemail."');
              window.location.href='EmployeeList.php';
              </script>";
    }else{
       echo "<script type='text/javascript'>alert('Error while updating.Changes failed.');
              window.location.href='EditEmail.php';
              </script>"; 
    } 
    }else{
        header("Location: EmployeeList.php");
    }
    
    } else {
    header("Location: admin.php");
}
?>