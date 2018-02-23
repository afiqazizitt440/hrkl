<?php
include "../util/connection.php";
session_start();
$idcom = $_SESSION["idcom"];
if (!empty($_POST)) {
    $output = '';
    //get the parameter
    $employeeid = mysqli_real_escape_string($con, $_POST["employee_id"]);
    $icno = mysqli_real_escape_string($con, $_POST["ic_no"]);
    $pass = mysqli_real_escape_string($con, $_POST["pass_"]);
    $empname = mysqli_real_escape_string($con, $_POST["emp_name"]);
    $email = mysqli_real_escape_string($con, $_POST["email_"]);
    $telno = mysqli_real_escape_string($con, $_POST["tel_no"]);
    $passportno = mysqli_real_escape_string($con, $_POST["passport_no"]);
    $nationality = mysqli_real_escape_string($con, $_POST["nationality_"]);
    
    //insert query
    $query = "insert into userprofile(email,pass,idcom,is_admin) values('$email', '$pass', '$idcom',0);";
    $query .= "insert into personalinformation(icno,empname,email,telno,passportno,nationality) values('$icno','$empname','$email','$telno','$passportno','$nationality');";
    $query .= "insert into employeeinformation(employeeid,email,idcom) values('$employeeid','$email','$idcom');";
    $query .= "insert into employeefinancial(email) values('$email');";
    $query .= "insert into employeeimage(email) values('$email');";
    
    if ($con->multi_query($query)){
        echo '
                <center><div class="loader"></div><br/>
                <style>
.loader {
  border: 8px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid #3498db;
  width: 70px;
  height: 70px;
  -webkit-animation: spin 0.75s linear infinite;
  animation: spin 0.75s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</center><br/>
<script>location.reload();</script>
                ';
    } else {
        echo mysqli_error($con);die();
    }
    
}else {
       header("Location: admin.php");
}
?>