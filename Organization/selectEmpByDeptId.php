<?php

include "../util/connection.php";
session_start();
?>
<script type="text/javascript">
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
</script>
<?php

if (isset($_POST["deptid"])) {
    $deptid = $_POST["deptid"];
    $idcom = $_SESSION["idcom"];
    $output = '';
    $query = "select deptname,branchid from dept where deptid='$deptid'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $deptname = $row["deptname"];
        $branchid = $row["branchid"];
        $query2 = "select personalinformation.*,employeeinformation.* from personalinformation 
join employeeinformation on personalinformation.email = employeeinformation.email where employeeinformation.deptid ='$deptid'";
        $result2 = mysqli_query($con, $query2);
        echo '<h4>' . $branchid . ' <br/><br/>Selected department : ' . $deptname . '</h4>
    <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                <th><label>Employee Name</label></th>
                <th><label>IC Number</label></th>
                <th><label>Action</label></th>
                </tr>';
        if (mysqli_num_rows($result2) !== 0) {
            while ($row2 = mysqli_fetch_array($result2)) {
                echo '
                <tr>
                <td>' . $row2["empname"] . '</td>
                <td>' . $row2["icno"] . '</td>
                <td><button type="button" title="Details" name="view" id="' . $row2['email'] . '" class="view_data btn btn-warning btn-sm" data-toggle="modal"  data-target="#viewEmployee"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                    <a href="removeEmployee.php?email=' . $row2["email"] . '"><button type="button" class="btn btn-danger btn-sm" title="Remove from this department"><span class="glyphicon glyphicon-remove"></span></button></a></td>    
                </tr>
                ';
            }
            echo '
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
        } else {
            echo '<center>No employees assigned on this department. Please assigned one <a href="EmployeeList.php"><span style="font-size:20px;">here</span></a>.</center>';
            die();
        }
    }
} else {
    header("Location: admin.php");
}
?>