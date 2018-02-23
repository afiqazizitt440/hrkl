<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date("Y-m-d");
    $currenttime = date("g:i A");
} else {
    header("Location: index.php");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($_POST['status'] == 1){
    $data = array( 
        "idapproval" => $_POST['idapproval'],
        "status" => 'Approved',
        "idleave" => $_POST['idleave'],
        "noofdays" => $_POST['noofdays']
    );
    //retrieve the current no of days used on applied leave
    $first = "select staffleaveapproval.employeeid,staffleave.leave".$data['idleave']." from staffleaveapproval
            join staffleave on staffleaveapproval.employeeid = staffleave.employeeid where staffleaveapproval.idapproval='".$data['idapproval']."'";
    $rs1 = mysqli_query($con, $first);
    while($r1 = mysqli_fetch_array($rs1)){
    $employeeid = $r1['employeeid'];    
    $used = $r1['leave'.$data['idleave']]; //days that the employee has used...
    }
    //add the no of days applied to the current no of days....
    $updated = $used + $data['noofdays'];
    //retrieve the information of the approval authority..
    $second = "select empname from personalinformation where email='$email'";
    $rs2 = mysqli_query($con, $second);
    $r2 = mysqli_fetch_array($rs2);
    $empname = $r2['empname'];
    
    $query = "update staffleaveapproval set status='".$data['status']."',remarksby='$empname',dateremarks='$currentdate' where idapproval='".$data['idapproval']."';";
    $query .= "update staffleave set leave".$data['idleave']." ='".$updated."' where employeeid='".$employeeid."';";
    $con->multi_query($query);
}
if ($_POST['status'] == 0){
    $data = array( 
        "idapproval" => $_POST['idapproval'],
        "status" => 'Rejected',
        "idleave" => $_POST['idleave'],
        "noofdays" => $_POST['noofdays']
    );
   
    $first2 = "select empname from personalinformation where email='$email'";
    $rs = mysqli_query($con, $first2);
    $r = mysqli_fetch_array($rs);
    $empname = $r['empname'];
    
    $query2 = "update staffleaveapproval set status='".$data['status']."',remarksby='$empname',dateremarks='$currentdate' where idapproval='".$data['idapproval']."'";
    $rs2 = mysqli_query($con, $query2);  
    
} 
echo json_encode($data);

?>
