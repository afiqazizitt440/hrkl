<?php
//delete.php
include "../util/connection.php";
if(isset($_POST["deptid"]))
{
 foreach($_POST["deptid"] as $deptid)
 {
  $query = "DELETE FROM dept WHERE deptid = '".$deptid."'";
  mysqli_query($con, $query);
 }
}else {
       header("Location: admin.php");
}
?>