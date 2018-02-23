<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../util/connection.php";
if(!empty($_POST))
{
    $output = '';
    $message = '';
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
    $employeeid = mysqli_real_escape_string($con, $_POST["employeeid"]);
    $branchid = mysqli_real_escape_string($con, $_POST["branchid"]);
    $branchid2 = mysqli_real_escape_string($con, $_POST["branchid2"]);
    $branchid3 = mysqli_real_escape_string($con, $_POST["branchid3"]);
    $branchid4 = mysqli_real_escape_string($con, $_POST["branchid4"]);
    $branchid5 = mysqli_real_escape_string($con, $_POST["branchid5"]);
    $jobcategory = mysqli_real_escape_string($con, $_POST["jobcategory"]);
    $datejoin = mysqli_real_escape_string($con, $_POST["datejoin"]);
    $dateresign = mysqli_real_escape_string($con, $_POST["dateresign"]);
    $datetransfer = mysqli_real_escape_string($con, $_POST["datetransfer"]);
    $datepromote = mysqli_real_escape_string($con, $_POST["datepromote"]);
    $acno = mysqli_real_escape_string($con, $_POST["acno"]);
    $bankname = mysqli_real_escape_string($con, $_POST["bankname"]);
    $epfno = mysqli_real_escape_string($con, $_POST["epfno"]);
    $socsono = mysqli_real_escape_string($con, $_POST["socsono"]);
    $taxno = mysqli_real_escape_string($con, $_POST["taxno"]);

    $admincond = mysqli_real_escape_string($con, $_POST["admincond"]);//admin cond
    
    
    //ref key
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    

        $query = "update personalinformation set icno='$icno',empname='$empname',gender='$gender',religion='$religion',maritalstatus='$maritalstatus',telno='$telno',address='$address', poscode='$poscode', state='$state', dob='$dob',passportno='$passportno',nationality='$nationality' where email='$email';";

        $query .= "update employeeinformation set employeeid='$employeeid',branchid='$branchid',branchid2='$branchid2',branchid3='$branchid3',branchid4='$branchid4',branchid5='$branchid5',jobcategory='$jobcategory',datejoin='$datejoin',dateresign='$dateresign',datetransfer='$datetransfer',datepromote='$datepromote' where email='$email';";

        $query .= "update employeefinancial set acno='$acno',bankname='$bankname',epfno='$epfno',socsono='$socsono',taxno='$taxno' where email='$email';";
        //new table condition
        $query .= "update user_condition set email='$email',access_cond='$admincond' where email='$email';";

    if($con->multi_query($query))
    {
        $select_query = "select * from userprofile";
        $output .= '
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
                ';
    }
    echo $output;
} else {
       header("Location: admin.php");
}
?>