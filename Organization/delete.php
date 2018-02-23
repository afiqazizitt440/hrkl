<?php
include "../util/connection.php";
//delete.php
if(isset($_GET["email"]))
{
    //check whether the email is exists on admin or the user table
    $email = $_GET["email"];
    $check = "select * from admin_org where email= $email;";
    $result = mysqli_query($con, $check);
    if ( $result > 0 ){ //admin       
  $query = "DELETE FROM admin_org WHERE email = '".$email."';";
  $query .= "delete from personalinformation where email= '".$email."';";
  $query .= "delete from employeeinformation where email= '".$email."';";
  $query .= "delete from employeefinancial where email= '".$email."';";
  $query .= "delete from employeeimage where email= '".$email."';";
  $con->multi_query($query);
  echo "<script type='text/javascript'>alert('Deleted Successfully');
              window.location.href='EmployeeList.php';</script>";
  
} else { //non-admin  
  $query = "DELETE FROM userprofile WHERE email = '".$email."';";
  $query .= "delete from personalinformation where email= '".$email."';";
  $query .= "delete from employeeinformation where email= '".$email."';";
  $query .= "delete from employeefinancial where email= '".$email."';";
  $query .= "delete from employeeimage where email= '".$email."';";
  $con->multi_query($query);
  echo "<script type='text/javascript'>alert('Removed Successfully');
              window.location.href='EmployeeList.php';</script>";
 }
}else {
      header("Location: admin.php");
}

?>
