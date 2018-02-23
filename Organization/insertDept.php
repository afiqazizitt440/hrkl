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
    $deptname = mysqli_real_escape_string($con, $_POST["deptname"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $deptid = mysqli_real_escape_string($con, $_POST["deptid"]);

        $query = "
        update dept
        set deptname='$deptname',
            description='$description'
        where deptid = '".$_POST["deptid"]."'";

    if(mysqli_query($con, $query))
    {
        $select_query = "select * from dept";
        $result = mysqli_query($con, $select_query);
        $output .= '
                <center><div class="loader"></div><br/>
                <style>
.loader {
  border: 8px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid #CD5C5C;
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
