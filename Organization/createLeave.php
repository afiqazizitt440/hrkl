<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
} else {
    header("Location: admin.php");
}
if (!empty($_POST)) {
    $output = '';
    $leave_name = mysqli_real_escape_string($con, $_POST["leave_name"]);
    $leave_description = mysqli_real_escape_string($con, $_POST["leave_description"]);
    $entitlement_ = mysqli_real_escape_string($con, $_POST["entitlement_"]);
    $ent_type = mysqli_real_escape_string($con, $_POST["ent_type"]);
    
    $query = "insert into staffleaveinfo(leavename,leavedescription,entitlement,enttype) values('$leave_name', '$leave_description', '$entitlement_', '$ent_type');";
    if (mysqli_query($con, $query)){
        $query2 = "select idleave from staffleaveinfo order by idleave desc limit 1";
        $result = mysqli_query($con, $query2);
        $rs2 = mysqli_fetch_array($result);
        $idleave = $rs2['idleave'];
        //add column in staff leave table
        $query3 = "alter table staffleave add leave".$idleave." int(11) default 0";
        if (mysqli_query($con, $query3)){
           echo "<script type='text/javascript'>alert('Leave Type Successfully Added');
              window.location.href='LeaveSettings.php';
              </script>"; 
        }else{
            $query4 = "delete from staffleaveinfo where idleave='$idleave'";
            mysqli_query($con, $query4);
            echo "<script type='text/javascript'>alert('Error while adding Leave Type..!');
              window.location.href='LeaveSettings.php';
              </script>";
        }
    }
    
} else {
       echo "<script type='text/javascript'>alert('Undefined Index');
              window.location.href='admin.php';
              </script>";
}
?>
