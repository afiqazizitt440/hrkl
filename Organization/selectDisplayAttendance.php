<?php
include "../util/connection.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST["email"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $start = mysqli_real_escape_string($con, $_POST["start"]);
    $end = mysqli_real_escape_string($con, $_POST["end"]);
    $query = "select *,TIME_FORMAT(timein,'%H:%i') as timeinsim, TIME_FORMAT(timeout,'%H:%i') as timeoutsim from attendancerecord where email = '$email' and attendancedate >= '$start' and attendancedate <= '$end'";
    $query2 = "select sum(totalhours) as totalhours,sum(totalmins) as totalmins from attendancerecord where email='$email' and attendancedate >= '$start' and attendancedate <= '$end'";
    $result2 = mysqli_query($con, $query2);

    $output = '
    <div>
            Attendance Record from <span style="font-size:20px;">' . $start . '</span> to <span style="font-size:20px;">' . $end . '</span>.<br/>';
    while ($row2 = mysqli_fetch_array($result2)) {
        if ($row2["totalhours"] === null && $row2["totalmins"] === null) {
            $totalhours = 0;
            $totalmins = 0;
        } else {
            $totalhours = $row2["totalhours"];
            $totalmins = $row2["totalmins"];
            while ( $totalmins >= 60 ){
                $totalmins = $totalmins - 60;
                $totalhours++;
            }
        }
    }
    $output .= 'Total Working Hours : <span style="font-size:20px;">' . $totalhours . '</span> Hours <span style="font-size:20px;">' . $totalmins . '</span> Minutes.<br/>
                <table class="table table-bordered table-responsive">
                <tr>
                <td width="100px"><label>Date</label></td>
                <td><label>Time In</label></td>
                <td><label>Reason Late (Available if Late)</label></td>
                <td><label>Time Out</label></td>
                <td><label>Reason Out Early (Available if Time Out Early)</label></td>
                <td><label>Total Hours</label></td>
                <td><label>Total Minutes</label></td>
                </tr>';
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) !== 0){
    $output .= '<span style="font-size:20px;">'.mysqli_num_rows($result).'</span> records found. ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '  
                <tr>
                <td>' . $row["attendancedate"] . '</td>
                <td>' . $row["timeinsim"] . '</td>
                <td>' . $row["reasonlate"] . '</td>
                <td>' . $row["timeoutsim"] . '</td>
                <td>' . $row["reasonout"] . '</td>
                <td>' . $row["totalhours"] . '</td>
                <td>' . $row["totalmins"] . '</td>
                </tr>
                ';
    }
    }else {
        echo '<center>No records found.</center>';die();
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