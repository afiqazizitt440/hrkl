<?php

include "../util/connection.php";
if (!empty($_POST)) {
    $output = '';
    $icno = mysqli_real_escape_string($con, $_POST["icno"]);
    $empname = mysqli_real_escape_string($con, $_POST["empname"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $religion = mysqli_real_escape_string($con, $_POST["religion"]);
    $maritalstatus = mysqli_real_escape_string($con, $_POST["maritalstatus"]);
    $telno = mysqli_real_escape_string($con, $_POST["telno"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);
    $poscode = mysqli_real_escape_string($con, $_POST["poscode"]);
    $state = mysqli_real_escape_string($con, $_POST["state"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $passportno = mysqli_real_escape_string($con, $_POST["passportno"]);
    $nationality = mysqli_real_escape_string($con, $_POST["nationality"]);
    $acno = mysqli_real_escape_string($con, $_POST["acno"]);
    $bankname = mysqli_real_escape_string($con, $_POST["bankname"]);

    //ref key
    $email = mysqli_real_escape_string($con, $_POST["email"]);

    $query = "update personalinformation set icno='$icno',empname='$empname',gender='$gender',religion='$religion',maritalstatus='$maritalstatus',telno='$telno',address='$address', poscode='$poscode', state='$state', dob='$dob',passportno='$passportno',nationality='$nationality' where email='$email';";
    $query .= "update employeefinancial set acno='$acno',bankname='$bankname' where email='$email';";
    if ($con->multi_query($query)) {
        echo "<script type='text/javascript'>alert('Updated Successfully.');
              window.location.href='employeeInformation.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>alert('Error while updating.Changes failed.');
              window.location.href='employeeInformation.php';
              </script>";
    }
} else {
    header("Location: ../index.php");
}
?>