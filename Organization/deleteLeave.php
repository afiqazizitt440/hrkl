<?php

//deleteLeave.php
include "../util/connection.php";
if ($_POST['leaveid'] != null) {
    $data = array( 
        "idleave" => $_POST['leaveid'],
        "msg1" => "Successfully Removed",
        "msg2" => "Error while removing"
    );
    $query = "delete from staffleaveinfo where idleave = '".$data['idleave']."';";
    $query .= "alter table staffleave drop leave".$data['idleave'].";";
    if ($con->multi_query($query)){
        echo json_encode($data['msg1']);
    } else {
        echo json_encode($data['msg2']);
    }
} else {
    header("Location: admin.php");
}
?>