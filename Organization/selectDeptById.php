<?php
include "../util/connection.php";
session_start();
?>
<script>
    $(document).ready(function () {
    $('.openEmployee').click(function () {
                    var deptid = $(this).attr("id");
                    $.ajax({
                        url: "selectEmpByDeptId.php",
                        method: "post",
                        data: {deptid:deptid},                       
                        success: function (data) {
                            $('#tableDept').html(data);
                        }
                    });
            });
        });
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST["branchid"]))
{
    $output = '';
    $branchid = $_POST["branchid"];
    $query = "select * from dept where branchid='$branchid'";
    $result = mysqli_query($con, $query);
    $output .= '
    <h4>Selected branch : '.$branchid.'</h4>
    <div>
            <table class="table table-bordered table-responsive">
                <tr>
                <th>Department Name</th>
                <th>Description</th>
                <th>Action</th>
                </tr>';
    if (mysqli_num_rows($result) !== 0){
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
                <tr>
                <td>'.$row["deptname"].'</td>
                <td>'.$row["description"].'</td>
                <td><button type="button" class="openEmployee btn btn-warning btn-sm" id="'.$row["deptid"].'"><span class="glyphicon glyphicon-list"></span> Employees List</button>
                    <a href="AssignEmployees.php?branchid='.$branchid.'&deptid='.$row["deptid"].'"><button type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Assign Employees</button></a></td>    
                </tr>
                ';          
    }
    }else {
        echo '<center>No department assigned on <span style="font-size:20px;">'.$branchid.'</span>. Please create one <a href="DeptList.php"><span style="font-size:20px;">here</span></a>.</center>';die();
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
}else {
       header("Location: admin.php");
}
?>