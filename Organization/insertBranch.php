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
    $branchid = mysqli_real_escape_string($con, $_POST["branchid"]);
    $branchlocation = mysqli_real_escape_string($con, $_POST["branchlocation"]);
    $gmaplat = mysqli_real_escape_string($con, $_POST["gmaplat"]);
    $gmaplng = mysqli_real_escape_string($con, $_POST["gmaplng"]);
    $openhours = mysqli_real_escape_string($con, $_POST["openhours"]);
    //$openhoursconverted = date("H:i:s", strtotime($openhours)); //12 h to 24 h
    $closehours = mysqli_real_escape_string($con, $_POST["closehours"]);
    //$closehoursconverted = date("H:i:s", strtotime($closehours)); //12 h to 24 h
    $state = mysqli_real_escape_string($con, $_POST["state"]);
    $staticip = mysqli_real_escape_string($con, $_POST["staticip"]);

        $query = "
        update branch
        set branchlocation='$branchlocation',
            gmaplat='$gmaplat',
            gmaplng='$gmaplng',    
            state='$state',
            staticip='$staticip',
            openhours='$openhours',
            closehours='$closehours'    
        where branchid = '".$_POST["branchid"]."'";

    if(mysqli_query($con, $query))
    {
        $select_query = "select * from branch";
        $result = mysqli_query($con, $select_query);
        $output .= '
                <center><div class="loader"></div><br/>
                <style>
.loader {
  border: 8px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid #000000;
  width: 70px;
  height: 70px;
  -webkit-animation: spin 2s linear infinite;
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
