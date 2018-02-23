<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
} else {
    header("Location: admin.php");
}
if(!empty($_POST))
{
    $output = '';
    $idleave = mysqli_real_escape_string($con, $_POST["idleave"]);
    $leavename = mysqli_real_escape_string($con, $_POST["leavename"]);
    $leavedescription = mysqli_real_escape_string($con, $_POST["leavedescription"]);
    $entitlement = mysqli_real_escape_string($con, $_POST["entitlement"]);
    $enttype = mysqli_real_escape_string($con, $_POST["enttype"]);

        $query = "
        update staffleaveinfo
        set leavename='$leavename',
            leavedescription='$leavedescription',
            entitlement='$entitlement',
            enttype='$enttype'    
        where idleave = '".$_POST["idleave"]."'";

    if(mysqli_query($con, $query))
    {
        $select_query = "select * from staffleaveinfo";
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