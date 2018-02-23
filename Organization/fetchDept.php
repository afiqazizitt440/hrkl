<?php
//fetch.php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../util/connection.php";
if(isset($_POST["deptid"]))
{
    $query = "select * from dept where deptid = '" .$_POST["deptid"]. "'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}else {
       header("Location: admin.php");
}
   
?>