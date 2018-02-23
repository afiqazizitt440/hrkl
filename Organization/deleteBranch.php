<?php
include "../util/connection.php";
//delete.php
if(isset($_POST["branchid"]))
{
 foreach($_POST["branchid"] as $branchid)
 {
  $query = "DELETE FROM branch WHERE branchid = '".$branchid."'";
  mysqli_query($con, $query);
 }
}else {
       header("Location: admin.php");
}
?>
