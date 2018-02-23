<?php

include "../util/connection.php";
if (!empty($_POST)) {
    $output = '';
    //admin-org info
    $empname = mysqli_real_escape_string($con, $_POST["empname"]);
    $icno = mysqli_real_escape_string($con, $_POST["icno"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $pass = mysqli_real_escape_string($con, $_POST["pass"]);
    $telno = mysqli_real_escape_string($con, $_POST["telno"]);

    //company info
    $idcom = mysqli_real_escape_string($con, $_POST["idcom"]);
    $comname = mysqli_real_escape_string($con, $_POST["comname"]);
    $regno = mysqli_real_escape_string($con, $_POST["regno"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);

    $check = "select email from admin_org where email='$email'";
    $result = mysqli_query($con, $check);
    $res = mysqli_fetch_array($result);
    if ($res["email"] !== $email) {
        //query for executing into admin-org table
        $query = "insert into admin_org(email,pass,idcom) values('$email', '$pass','$idcom');";
        $query .= "insert into userprofile(email,pass,idcom) values('$email','$pass','$idcom');";
        $query .= "insert into company(idcom,comname,regno,location) values('$idcom','$comname','$regno','$location');";
        $query .= "insert into personalinformation(empname,email,telno) values('$empname','$email','$telno');";
        $query .= "insert into employeeinformation(email,idcom) values('$email','$idcom');";
        $query .= "insert into employeefinancial(email) values('$email');";
        $query .= "insert into employeeimage(email) values('$email')";
        $query .= "insert into branch(branchid,state) values('Headquarters','$location');";

        //message for user 
        if ($con->multi_query($query)) {
            echo "<script type='text/javascript'>alert('Account Created Successfully');
              window.location.href='admin.php';
              </script>";
        } else {
            echo "<script type='text/javascript'>alert('Error while creating records');
              window.location.href='admin.php';
              </script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('" . $email . "' already exists');
             window.history.back();
              </script>";
    }
} else {
    header("Location: admin.php");
}
?>

