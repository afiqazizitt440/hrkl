<?php
include "../util/connection.php";
if (!empty($_GET["email"])) {
    $email = mysqli_real_escape_string($con, $_GET["email"]);
    $deptid = mysqli_real_escape_string($con, $_GET["deptid"]);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   $query = "update employeeinformation set deptid='$deptid' where email='$email'";
   if (mysqli_query($con, $query)){
       echo "<script type='text/javascript'>alert('Successfully Assigned!');</script>
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
              <script type='text/javascript'>window.history.go(-1);
              </script>"; 
   }else {
       echo "<script type='text/javascript'>alert('Error while assigning employee.');</script>
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
              <script type='text/javascript'>window.history.go(-1);
              </script>"; 
   }
   
}else {
       header("Location: admin.php");
}
?>