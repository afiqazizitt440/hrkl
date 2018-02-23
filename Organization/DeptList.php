<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $idcom = $_SESSION["idcom"];
    $query = "select * from dept where idcom='$idcom' order by branchid desc";
    $result = mysqli_query($con, $query);
} else {
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <title>Organization</title>
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .loader {
                border: 8px solid #FFFFFF;
                border-radius: 50%;
                border-top: 8px solid #C0C0C0;
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
        <script>
            $(document).ready(function () {
                $('#add').click(function () {
                    $('#insert').val("Insert");
                    $('#insert_form')[0].reset();
                });
                $(document).on('click', '.edit_data', function () {
                    var deptid = $(this).attr("id");
                    $.ajax({
                        url: "fetchDept.php",
                        method: "post",
                        data: {deptid: deptid},
                        dataType: "json",
                        success: function (data) {
                            $('#deptid').val(data.deptid);
                            $('#deptname').val(data.deptname);
                            $('#description').val(data.description);
                            $('#insert').val("Update");
                        }
                    });
                });

                $('#insert_form').on("submit", function (event) {
                    event.preventDefault();

                    $.ajax({
                        url: "insertDept.php",
                        method: "post",
                        data: $('#insert_form').serialize(),
                        beforeSend: function () {
                            $('#insert').val("Updating...");
                        },
                        success: function (data) {
                            $('#editDept').modal('hide');
                            $('#editDept .close').click();
                            $('#deptTable').html(data);
                            alert("Updated successfully..!");
                            location.reload();
                        }
                    });

                }); //end of edit employee data modal

                $(document).on('click', '.view_data', function () { //start of view employee data modal
                    var deptid = $(this).attr("id");
                    if (deptid != '')
                    {
                        $.ajax({
                            url: 'selectDept.php',
                            method: 'post',
                            data: {deptid: deptid},
                            success: function (data) {
                                $('#deptDetail').html(data);
                                $('#viewDept').modal("show");
                            }
                        });
                    }
                });// end of view employee data modal

                //start of add employee modal
                $(document).on('click', '.add_data', function () {
                    $('#add_form').on("submit", function (event) {
                        event.preventDefault();

                        if ($('#dept_id').val() == "")
                        {
                            alert("Department ID is required..!");
                        } else if ($('#dept_name').val() == "")
                        {
                            alert("Department Name is required..!");
                        } else
                        {
                            $.ajax({
                                url: "createDept.php",
                                method: "POST",
                                data: $('#add_form').serialize(),
                                beforeSend: function () {
                                    $('#bt-insert').val("Creating Profile..");
                                },
                                success: function (data) {

                                    $('#add_form')[0].reset();
                                    $('#add_data_Modal').modal('hide');
                                    $('#add_data_Modal .close').click();
                                    $('#deptTable').html(data);
                                    location.reload();
                                    alert("Profile Created Successfully..!");
                                }
                            });
                        }
                    });
                });//end of add modal

                //start of checkall checkbox f()
                $('#checkall').change(function () {
                    $("input:checkbox").prop('checked', $(this).prop("checked"));
                });
                //end of checkall checkbox f()

                // start of delete modal
                $(document).ready(function () {

                    $('#btn_delete').click(function () {

                        if (confirm("Are you sure you want to delete this?"))
                        {
                            var deptid = [];

                            $(':checkbox:checked').each(function (i) {
                                deptid[i] = $(this).val();
                            });

                            if (deptid.length === 0) //tell you if the array is empty
                            {
                                alert("Please Select at least one checkbox that you want to delete..!");
                            } else
                            {
                                $.ajax({
                                    url: 'deleteDept.php',
                                    method: 'POST',
                                    data: {deptid: deptid},
                                    success: function ()
                                    {
                                        for (var i = 0; i < deptid.length; i++)
                                        {
                                            $('tr#' + deptid[i] + '').css('background-color', '#ccc');
                                            $('tr#' + deptid[i] + '').fadeOut('slow');
                                            location.reload();

                                        }
                                        alert("Deleted Successfully...!")
                                    }

                                });
                            }

                        } else
                        {
                            return false;
                        }
                    });

                });
                //end of delete modal
            });

        </script>
    </head>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="Home.php">Dashboard</a></li>
                    <li class="active"><a href="Employees.php">Organization</a></li>
                    <li><a href="ManageAttendance.php">Attendance</a></li>
                    <li><a href="LeaveSettings.php">Leave</a></li>
                    <li><a href="#contact">Payroll</a></li>
                    <li><a href="#contact">Calendar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["empname"]; ?>  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-envelope"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand"></span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
        </div>
        <div class="container-fluid" style="background:white;" >
            <h2>Department Profile List</h2>
            <br/>
            <div align="right">
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-sm add_data"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Department</button>
            </div>
            <br/>
            <div id="deptTable">
                <table class="table table-responsize table-bordered table-hover">
                    <thead class="table-warning">
                    <th class="col-check"><input type="checkbox" id="checkall" onclick="test()"/></th>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Branch</th>
                    <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) !== 0) {
                            echo '<center>Showing <span style="font-size:15px;">' . mysqli_num_rows($result) . '</span> records.</center><br/> ';
                        while ($res = mysqli_fetch_array($result)) {
                            // output data of each row
                            ?>
                            <tr>
                                <td><input type="checkbox" name="deptid[]" class="delete_dept checkthis" value="<?php echo $res["deptid"]; ?>" /></td>
                                <td><?php echo $res['deptid']; ?></td>
                                <td><?php echo $res['deptname']; ?></td>
                                <td><?php echo $res['branchid']; ?></td>
                                <td align="center"><button type="button" name="edit" id="<?php echo $res['deptid']; ?>" class="edit_data btn btn-success btn-sm" data-toggle="modal"  data-target="#editDept"><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>
                                <td align="center"><button type="button" name="view" id="<?php echo $res['deptid']; ?>" class="view_data btn btn-warning btn-sm" data-toggle="modal"  data-target="#viewDept"><span class="glyphicon glyphicon-menu-hamburger"></span> Details</button></td>
                            </tr>
                            <?php
                        }
                        } else {
                            echo '<center>No records found.</center>';
                            die();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Department Details -->
        <div id="viewDept" class="modal fade">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Department Information</h4>
                    </div>
                    <div class="modal-body" id="deptDetail">
                        <center><div class="loader"></div></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Department -->
        <div id="editDept" class="modal fade">  
            <div class="modal-dialog">  
                <div class="modal-content">  
                    <div class="modal-header">  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h4 class="modal-title">Department Information</h4>  
                    </div>  
                    <div class="modal-body">  
                        <form method="post" id="insert_form">
                            <input type="text" name="deptid" id="deptid" class="form-control" readonly/><br/>
                            <input type="text" name="deptname" id="deptname" placeholder="Department Name *" class="form-control" required/><br/>
                            <textarea name="description" id="description" placeholder="Description about department" class="form-control" required></textarea><br/>

                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                        </form>  
                    </div>  
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- End of modal Edit Department -->

        <!-- Modal Add Department -->
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Department Information</h4>
                    </div>
                    <div class="modal-body">
                        <p class="">Create a profile for a department</p>
                        <form method="post" id="add_form">
                            <input type="text" name="dept_id" id="dept_id" placeholder="Department ID *"class="form-control"/><br/>
                            <input type="text" name="dept_name" id="dept_name" placeholder="Department Name *" class="form-control"/><br/>
                            <textarea name="description" id="description" placeholder="Description about department" class="form-control"></textarea><br/>
                            <select name="branchid" id="branchid" class="form-control">
                                <option value="">Please select the branch</option>
                                <?php
                                $query2 = "select * from branch where idcom='$idcom'";
                                $result2 = mysqli_query($con, $query2);
                                while ($row = mysqli_fetch_array($result2)) {
                                    echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                }
                                ?>
                            </select><br/>
                            <input type="hidden" name="idcom" id="idcom" value="<?php echo $_SESSION["idcom"]; ?>" />
                            <input type="submit" name="bt-insert" id="bt-insert" class="btn btn-success btn-sm btn-block" value="Create Profile"/></a>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of modal Add Department -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script src="../js/jquery.min.js"></script>  
        <script src="../js/bootstrap.min.js"></script>
</html>
