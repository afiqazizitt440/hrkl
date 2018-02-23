<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>-->
<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
} else {
    header("Location: ../index.php");
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_POST["idapproval"])) {
    $output = '';
    $query = "select * from 
            staffleaveapproval join staffleaveinfo on staffleaveapproval.idleave = staffleaveinfo.idleave 
            join employeeinformation on staffleaveapproval.employeeid = employeeinformation.employeeid
            join personalinformation on employeeinformation.email = personalinformation.email
            join staffleave on employeeinformation.employeeid = staffleave.employeeid
            where staffleaveapproval.idapproval =" . $_POST["idapproval"] . "";
    $result = mysqli_query($con, $query);
    $output .= '
    <div class="table-responsive">
            <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $idleave = $row['idleave'];
        $dayused = $row['leave' . $idleave];
        $available = $row['entitlement'] - $dayused;
        $noofdays = $row['noofdays'];
        $employeeid = $row["employeeid"];
        $output .= '
                <tr>
                <td colspan="4"> 
                Employee Information
                </td>
                </tr>
                <tr>
                <td><label>IC No.</label></td>
                <td >' . $row["icno"] . '</td>
                <td><label>Employee Name</label></td>
                <td>' . $row["empname"] . '</td>
                </tr>
                <tr>
                <td><label>Gender</label></td>
                <td>' . $row["gender"] . '</td>
                <td><label>Religion</label></td>
                <td>' . $row["religion"] . '</td>
                </tr>
                <tr>
                <td><label>Mobile Number</label></td>
                <td>' . $row["telno"] . '</td>
                <td><label>Address</label></td>
                <td>' . $row["address"] . '</td>
                </tr>
                <tr>
                <td><label>Poscode</label></td>
                <td>' . $row["poscode"] . '</td>
                <td><label>State</label></td>
                <td>' . $row["state"] . '</td>
                </tr>
                <tr>
                <td><label>Nationality</label></td>
                <td>' . $row["nationality"] . '</td>
                </tr>
                <tr>
                <td><label>Employee ID</label></td>
                <td>' . $row["employeeid"] . '</td>
                <td><label>Job Category</label></td>
                <td>' . $row["jobcategory"] . '</td>
                </tr>
                <tr>
                <td><label>Employee Working Branch</label></td>
                <td>' . $row["branchid"] . '</td>
                <td><label>Other Branches (if available)</label></td>
                <td>' . $row["branchid2"] . ' - ' . $row["branchid3"] . ' - ' . $row["branchid4"] . ' - ' . $row["branchid5"] . '</td>
                </tr>
                </table><br/>
                <table class="table table-bordered">
                <tr>
                <td colspan="6">Leave Application</td>
                </tr>
                <tr>
                <td><label>Leave Type Applied</label></td>
                <td>' . $row['leavename'] . '</td>
                <td><label>Leave Entitlement</label></td>
                <td>' . $row['entitlement'] . '</td>
                <td><label>Date of Application Submitted</label></td>
                <td>' . $row['dateapplied'] . '</td>
                </tr>
                <tr>
                <td><label>Start Date</label></td>
                <td>' . $row['startdate'] . '</td>
                <td><label>End Date</label></td>
                <td>' . $row['enddate'] . '</td>
                <td><label>Reason</label></td>
                <td>' . $row['reason'] . '</td>    
                </tr>
                <tr>
                <td><label>No. of Days Applied</label></td>
                <td>' . $row['noofdays'] . '</td>
                <td><label>No. of Days Available</label></td>
                <td>' . $available . '</td>
                <td><label>Supporting Documents</label></td>
                <td><a href="leaveattachments/'.$row["attachments"].'" target="_blank"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-download-alt"></span> &nbsp Download</button> </td>    
                </tr>
                </table>
                ';
    }
    $output .= '
            </div>
            <div class="modal-footer">
                <button type="button" name="reject" id="reject" class="btn btn-danger" onclick="check('. $_POST["idapproval"] .',0,'. $idleave .','.$noofdays.')">Reject</button>
                <button type="button" name="approve" id="approve" class="btn btn-success" onclick="check('. $_POST["idapproval"] .',1,'. $idleave .','.$noofdays.')">Approve</button>
            </div>
            ';
    echo $output;
} else {
    header("Location: admin.php");
}
?>
<script>
    function check(idapproval,status,idleave,noofdays){
        event.preventDefault();
        if (confirm("Are you sure?") == true){
        $.ajax({
            type: "POST",
            url: "updateStaffLeave.php",
            data: {
                idapproval:idapproval,
                status:status,
                idleave:idleave,
                noofdays:noofdays
            },
            success: function (dta)
            {  
              var data = JSON.parse(dta);
              alert("The application has successfully "+data['status']+".");
              window.location.href = "Leave.php";
            }

        });
    }else{
        return 0;
    }
    }
</script>