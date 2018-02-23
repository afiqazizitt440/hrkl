<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $query = "select * from staffleaveinfo";
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
        <title>Leave</title>
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <style type="text/css">
            body {
                background-image: url('<?php echo $background; ?>');
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

            .msg {border:1px solid #bbb; padding:5px; margin:10px 0px; background:#eee;}
        </style>
        <script type="text/javascript">
            //update leave settings
            $(document).ready(function () {
                $('#add').click(function () {
                    $('#insert').val("Insert");
                    $('#insert_form')[0].reset();
                });
                $(document).on('click', '.edit_data', function () {
                    var idleave = $(this).attr("id");
                    $.ajax({
                        url: "fetchLeave.php",
                        method: "post",
                        data: {idleave: idleave},
                        dataType: "json",
                        success: function (data) {
                            $('#idleave').val(data.idleave);
                            $('#leavename').val(data.leavename);
                            $('#leavedescription').val(data.leavedescription);
                            $('#entitlement').val(data.entitlement);
                            $('#enttype').val(data.enttype);
                            $('#insert').val("Save Changes");
                        }
                    });
                });

                $('#insert_form').on("submit", function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: "updateLeave.php",
                        method: "post",
                        data: $('#insert_form').serialize(),
                        beforeSend: function () {
                            $('#insert').val("Saving...");
                        },
                        success: function (data) {
                            $('#editLeave').modal('hide');
                            $('#editLeave.close').click();
                            alert("Saved successfully..!");
                            location.reload();
                        }
                    });

                }); //end of edit employee data modal

                //start of add leave modal
                $(document).on('click', '.add_data', function () {
                    $('#add_form').on("submit", function (event) {
                        event.preventDefault();
                        if ($('#leave_name').val() != "") {
                            $.ajax({
                                url: "createLeave.php",
                                method: "POST",
                                data: $('#add_form').serialize(),
                                beforeSend: function () {
                                    $('#bt-insert').val("Adding Leave Type..");
                                },
                                success: function (data) {
                                    $('#add_form')[0].reset();
                                    $('#add_data_Modal').modal('hide');
                                    $('#add_data_Modal .close').click();
                                    location.reload();
                                    alert("Leave Type added Successfully..!");
                                }
                            }); // end of ajax
                        } else {
                            alert("Leave name is required");
                        }
                    });
                });//end of add leave modals

            });

            function remove(leaveid) {
                event.preventDefault();
                if (confirm("Are you sure you want to remove?") == true) {
                    $.ajax({
                        type: "POST",
                        url: "deleteLeave.php",
                        data: {
                            leaveid:leaveid
                        },
                        success: function (dta)
                        {
                            var data = JSON.parse(dta);
                            alert(data);
                            window.location.href = "LeaveSettings.php";
                        }

                    });
                } else {
                    return 0;
                }
            }



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
                    <li ><a href="Home.php">Dashboard</a></li>
                    <li><a href="Employees.php">Organization</a></li>
                    <li><a href="ManageAttendance.php">Attendance</a></li>
                    <li class="active"><a href="LeaveSettings.php">Leave</a></li>
                    <li><a href="#contact">Payroll</a></li>
                    <li><a href="#contact">Calendar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["empname"]; ?> <span class="caret"></span></a>
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
    <div id="main">
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
                <div class="container" style=" background-color: white;">
                    <h1 class="page-header">Leave Settings</h1>
                    <div class="row">
                        <!-- edit form column -->
                        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                            <h3>Leave Information</h3>
                            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-md add_data"><span class="glyphicon glyphicon-plus"></span> Add Leave Type</button>
                            <br/><br/>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                
                                echo "<fieldset><input type='hidden' name='_idleave_' id='_idleave_' value='" . $row['idleave'] . "' /><legend>" . $row['leavename'] . " <button type='button' title='Edit' name='edit' id=" . $row['idleave'] . " class='edit_data btn btn-info btn-xs' data-toggle='modal'  data-target='#editLeave'><span class='glyphicon glyphicon-pencil'></span></button>
                                      <button type='button' name='delete' id='delete' class='btn btn-danger btn-xs' onclick='remove(".$row['idleave'].")'><span class='glyphicon glyphicon-trash'></span></button>
                                      </legend>Description: <br/>" . $row['leavedescription'] . "<br/>Entitlement : <span style='font-size:20px;'>" . $row['entitlement'] . "</span> " . $row['enttype'] . "<br/></fieldset><br/><br/>";
                            }
                            ?>

                        </div>
                    </div>
                    <!-- end of edit profile panel -->
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- Modal Edit Leave -->
        <div id="editLeave" class="modal fade">  
            <div class="modal-dialog modal-lg">  
                <div class="modal-content">  
                    <div class="modal-header">  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h4 class="modal-title">Leave Information</h4>             
                    </div>  
                    <div class="modal-body">  
                        <form method="post" id="insert_form">
                            <div class="table-responsive" style="display:block">
                                <table class="table table-bordered">
                                    <tr>
                                    <input type="hidden" name="idleave" id="idleave"/>
                                    <td><label>Leave Name</label></td>
                                    <td colspan="2"><input type="text" name="leavename" id="leavename" class="form-control" required/></td>
                                    </tr>
                                    <tr>
                                        <td><label>Leave Description</label></td>
                                        <td colspan="2"><textarea name="leavedescription" id="leavedescription" class="form-control" rows="5"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label>Entitlement</label></td>
                                        <td width="30%"><input type="number" name="entitlement" id="entitlement" size="2" maxlength="2" required class="form-control"/></td>
                                        <td><select name="enttype" id="enttype" class="form-control">
                                                <option value="Day(s)">Day(s)</option>
                                                <option value="Hour(s)">Hour(s)</option>
                                            </select></td>    
                                    </tr>
                                </table>
                            </div>
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                        </form>  
                    </div>  
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- End of modal Edit Leave -->

        <!-- Modal Add Leave -->
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Leave Information</h4>
                    </div>
                    <div class="modal-body">
                        <p class="">Add Leave Type for your Organization</p>
                        <form method="post" id="add_form">
                            <input type="text" name="leave_name" id="leave_name" placeholder="Leave Name *" class="form-control"/><br/>
                            <textarea name="leave_description" id="leave_description" placeholder="Description about the leave" class="form-control"></textarea><br/>
                            <input type="number" name="entitlement_" id="entitlement_" placeholder="Entitlement *" class="form-control"/><br/>
                            <select name="ent_type" id="ent_type" class="form-control">
                                <option value="Day(s)">Day(s)</option>
                                <option value="Hour(s)">Hour(s)</option>
                            </select><br/>   
                            <input type="submit" name="bt-insert" id="bt-insert" class="btn btn-success btn-sm btn-block" value="Add Leave Type"/></a>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of modal Add Leave -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
