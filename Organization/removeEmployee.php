<?php

include "../util/connection.php";
session_start();
if (isset($_GET["email"])) {
    $output = '';
    $email = $_GET["email"];
    $query = "update employeeinformation set deptid=NULL where email='$email'";

    if (mysqli_query($con, $query)) {
        echo "<script type='text/javascript'>alert('Successfully Removed!');</script>
                <center><div class='loader'></div><br/>
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
<script type='text/javascript'>window.history.go(-1);</script>;
                ";
    } else {
        echo "<script type='text/javascript'>alert('Error while removing employee.');</script>;
                <center><div class='loader'></div><br/>
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
<script type='text/javascript'>window.history.go(-1);</script>
                ";
    }
} else {
       header("Location: admin.php");
}
?>