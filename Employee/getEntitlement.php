<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $q = intval($_GET['q']);

        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        $sql = "SELECT * FROM staffleaveinfo WHERE idleave = '" . $q . "'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $entitlement = $row['entitlement'];
            $enttype = $row['enttype'];
            echo "<label>Description : </label> ".$row['leavedescription'];
            echo "<br/><br/><label>Total Entitlement Per Year : </label> " . $entitlement. " " . $enttype;
        }
        
        $sql2 = "select staffleave.leave".$q." from staffleave join employeeinformation on
                staffleave.employeeid = employeeinformation.employeeid where employeeinformation.email = '$email'";
        $rs = mysqli_query($con, $sql2);
        $r = mysqli_fetch_array($rs);
        $used = $r['leave'.$q];
        $available = $entitlement - $used;
        echo "<br/><label>Your Available Entitlement : </label> ".$available. " " .$enttype;
        mysqli_close($con);
} 
?>


