<?php

include "../util/connection.php";
session_start();
?>
<script>
    $(document).ready(function () {
        $(document).on('click', '.attendance_data', function () {
            var email = $(this).attr("id");
            if (email != '') {
                $.ajax({
                    url: "selectAttendance.php",
                    method: "post",
                    data: {email: email},
                    success: function (data) {
                        $('#attendanceDetail').html(data);
                        $('#viewAttendance').modal("show");
                    }
                });
            }
        });

        $(document).on('click', '.overtime_data', function () {
            var email = $(this).attr("id");
            if (email != '') {
                $.ajax({
                    url: "selectOvertime.php",
                    method: "post",
                    data: {email: email},
                    success: function (data) {
                        $('#overtimeDetail').html(data);
                        $('#viewOvertime').modal("show");
                    }
                });
            }
        });
        $(document).on('click', '.view_data', function () { //start of view employee data modal
            var email = $(this).attr("id");
            if (email != '')
            {
                $.ajax({
                    url: 'select.php',
                    method: 'post',
                    data: {email: email},
                    success: function (data) {
                        $('#employeeDetail').html(data);
                        $('#viewEmployee').modal("show");
                    }
                });
            }
        });// end of view employee data modal
    });
</script>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST["branchid"])) {
    $branchid = $_POST["branchid"];
    $output = '';
    $query = "select personalinformation.*,employeeinformation.*,branch.* from personalinformation 
             join employeeinformation on personalinformation.email = employeeinformation.email
             join branch on employeeinformation.branchid = branch.branchid or employeeinformation.branchid2 = branch.branchid or employeeinformation.branchid3 = branch.branchid or employeeinformation.branchid4 = branch.branchid or employeeinformation.branchid5 = branch.branchid
             where branch.branchid='$branchid' order by employeeid asc;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) !== 0){
    $output .= '
    <h4>Selected branch : ' . $branchid . '</h4>
    <div>
            <table class="table table-bordered table-responsive">
                <tr>
                <td><label>Employee ID</label></td>
                <td><label>Name</label></td>
                <td><label>IC Number</label></td>
                <td><label>Employee</label></td>
                <td><label>Attendance</label></td>
                <td><label>Overtime</label></td>
                </tr>';

    while ($row = mysqli_fetch_array($result)) {
        $output .= '
                <tr>
                <td>' . $row["employeeid"] . '</td>
                <td>' . $row["empname"] . '</td>
                <td>' . $row["icno"] . '</td>
                <td><button type="button" title="Details" name="view" id="' . $row['email'] . '" class="view_data btn btn-info btn-sm" data-toggle="modal"  data-target="#viewEmployee"><span class="glyphicon glyphicon-menu-hamburger"></span> Information</button>
                <td><button type="button" name="attendance" class="attendance_data btn btn-warning btn-sm" id="' . $row["email"] . '" data-toggle="modal" data-target="#viewAttendance"><span class="glyphicon glyphicon-calendar"></span> Records</button></td>
                <td><button type="button" name="overtime" class="overtime_data btn btn-primary btn-sm" id="' . $row["email"] . '" data-toggle="modal" data-target="#viewOvertime"><span class="glyphicon glyphicon-time"></span> Records</button></td>
                </tr>
                ';
    }
    }else {
        echo '<center>No employees assigned on <span style="font-size:20px;">'.$branchid.'</span>. Please assign one <a href="ManageEmployees.php"><span style="font-size:20px;">here</span></a>.</center>';die();
    }
    $output .= '
            </table>
            </div>
            <style>
            /* 
Generic Styling, for Desktops/Laptops 
*/
table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: #eee; 
}
th { 
  background: #333; 
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid #ccc; 
  text-align: left; 
}
/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
        td:nth-of-type(1):before { content: "Employee Name"; }
	td:nth-of-type(2):before { content: "IC No"; }
	td:nth-of-type(3):before { content: "Action"; }
	*/
	
}
            </style>
            ';
    echo $output;
} else {
    header("Location: admin.php");
}
?>
