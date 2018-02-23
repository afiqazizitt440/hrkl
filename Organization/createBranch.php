<?php
include "../util/connection.php";
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
if (!empty($_POST)) {
    $output = '';
    $idcom = $_SESSION["idcom"];
    $branch_id = mysqli_real_escape_string($con, $_POST["branch_id"]);
    $branch_location = mysqli_real_escape_string($con, $_POST["branch_location"]);
    $openhours = mysqli_real_escape_string($con,$_POST["open_hours"]);
    //$openhoursconverted = date("H:i:s", strtotime($openhours)); //12 h to 24 h
    $closehours = mysqli_real_escape_string($con,$_POST["close_hours"]);
    //$closehoursconverted = date("H:i:s", strtotime($closehours)); //12 h to 24 h
    $state = mysqli_real_escape_string($con, $_POST["state_"]);
    $query = "insert into branch(branchid,branchlocation,openhours,closehours,state,idcom) 
            values('$branch_id', '$branch_location', '$openhours','$closehours','$state','$idcom')";
    
    if (mysqli_query($con, $query)) {
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
}else {
       header("Location: admin.php");
}
?>

