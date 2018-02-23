<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $idcom = $_SESSION["idcom"];
    $query = "select personalinformation.email,personalinformation.icno,personalinformation.empname,employeeinformation.*,employeeimage.img,userprofile.* from personalinformation
            join employeeinformation on personalinformation.email = employeeinformation.email 
            join employeeimage on employeeinformation.email = employeeimage.email
            join userprofile on employeeimage.email = userprofile.email
            where employeeinformation.idcom='$idcom' and userprofile.is_admin = 0 order by employeeid asc;";
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
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <title>Organization</title>
        <script>
            $(document).ready(function () {
                $('#add').click(function () {
                    $('#insert').val("Insert");
                    $('#insert_form')[0].reset();
                });
                $(document).on('click', '.edit_data', function () {
                    var email = $(this).attr("id");
                    $.ajax({
                        url: "fetch.php",
                        method: "post",
                        data: {email: email},
                        dataType: "json",
                        success: function (data) {
                            $('#icno').val(data.icno);
                            $('#empname').val(data.empname);
                            $('#gender').val(data.gender);
                            $('#religion').val(data.religion);
                            $('#maritalstatus').val(data.maritalstatus);
                            $('#telno').val(data.telno);
                            $('#address').val(data.address);
                            $('#poscode').val(data.poscode);
                            $('#state').val(data.state);
                            $('#dob').val(data.dob);
                            $('#passportno').val(data.passportno);
                            $('#nationality').val(data.nationality);
                            $('#employeeid').val(data.employeeid);
                            $('#branchid').val(data.branchid);
                            $('#branchid2').val(data.branchid2);
                            $('#branchid3').val(data.branchid3);
                            $('#branchid4').val(data.branchid4);
                            $('#branchid5').val(data.branchid5);
                            $('#jobcategory').val(data.jobcategory);
                            $('#datejoin').val(data.datejoin);
                            $('#dateresign').val(data.dateresign);
                            $('#datetransfer').val(data.datetransfer);
                            $('#datepromote').val(data.datepromote);
                            $('#acno').val(data.acno);
                            $('#bankname').val(data.bankname);
                            $('#epfno').val(data.epfno);
                            $('#socsono').val(data.socsono);
                            $('#taxno').val(data.taxno);
                            $('#email').val(data.email);
                            $('#insert').val("Updatee");
                        }
                    });
                });

                $('#insert_form').on("submit", function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: "insert.php",
                        method: "post",
                        data: $('#insert_form').serialize(),
                        beforeSend: function () {
                            $('#insert').val("Updating...");
                        },
                        success: function (data) {
                            $('#editEmployee').modal('hide');
                            $('#editEmployee .close').click();
                            $('#employeeTable').html(data);
                            alert("Updated successfully..!");
                            location.reload();
                        }
                    });

                }); //end of edit employee data modal

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

                //start of add employee modal
                $(document).on('click', '.add_data', function () {
                    $('#add_form').on("submit", function (event) {
                        event.preventDefault();

                        if ($('#employee_id').val() == "")
                        {
                            alert("Employee ID is required..!");
                        } else if ($('#pass_').val() == "")
                        {
                            alert("Password is required..!");
                        } else if ($('#email_').val() == "")
                        {
                            alert("Email is required..!");
                        } else if ($('#emp_name').val() == "")
                        {
                            alert("Employee Name is required..!");
                        } else
                        {
                            $.ajax({
                                url: "create.php",
                                method: "POST",
                                data: $('#add_form').serialize(),
                                beforeSend: function () {
                                    $('#bt-insert').val("Creating Profile..");
                                },
                                success: function (data) {

                                    $('#add_form')[0].reset();
                                    $('#add_data_Modal').modal('hide');
                                    $('#add_data_Modal .close').click();
                                    $('#employeeTable').html(data);
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
            });
            
            function setDob() {
                var ic = document.getElementById('icno').value;

                if (ic.match(/^(\d{2})(\d{2})(\d{2})-?\d{2}-?\d{4}$/)) {
                    var year = RegExp.$1;
                    var month = RegExp.$2;
                    var day = RegExp.$3;
                    console.log(year, month, day);

                    var now = new Date().getFullYear().toString();

                    var decade = now.substr(0, 2);
                    if (now.substr(2, 2) > year) {
                        year = parseInt(decade.concat(year.toString()), 10);
                    }
                    var date = new Date(year, (month - 1), day, 0, 0, 0, 0);
                    year = date.getFullYear();
                    document.getElementById('dob').value = year+"-"+month+"-"+day;
                    
                } else {
                    alert("Please follow the format on your identification card.");
                }
            }

        </script>
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

            /*search button */
            .search-form .form-group {
                float: right !important;
                transition: all 0.35s, border-radius 0s;
                width: 32px;
                height: 32px;
                background-color: #fff;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
                border-radius: 25px;
                border: 1px solid #ccc;
            }
            .search-form .form-group input.form-control {
                padding-right: 20px;
                border: 0 none;
                background: transparent;
                box-shadow: none;
                display:block;
            }
            .search-form .form-group input.form-control::-webkit-input-placeholder {
                display: none;
            }
            .search-form .form-group input.form-control:-moz-placeholder {
                /* Firefox 18- */
                display: none;
            }
            .search-form .form-group input.form-control::-moz-placeholder {
                /* Firefox 19+ */
                display: none;
            }
            .search-form .form-group input.form-control:-ms-input-placeholder {
                display: none;
            }
            .search-form .form-group:hover,
            .search-form .form-group.hover {
                width: 100%;
                border-radius: 4px 25px 25px 4px;
            }
            .search-form .form-group span.form-control-feedback {
                position: absolute;
                top: -1px;
                right: -2px;
                z-index: 2;
                display: block;
                width: 34px;
                height: 34px;
                line-height: 34px;
                text-align: center;
                color: #3596e0;
                left: initial;
                font-size: 14px;
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
            <h2>Employees Profile List</h2>
            <br/>
            <div class="row">
                <div class="col-md-4 col-md-offset-3 pull-right">
                    <form action="SearchEmployee.php" class="search-form">
                        <div class="form-group has-feedback">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" id="search" placeholder="Enter the Employee ID then hit the enter button">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pull-right">
                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-sm add_data"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee</button>
            </div>
            <br/>
            <div id="employeeTable">
                <table class="table table-responsize table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Employee ID</th>
                            <th>IC No.</th>
                            <th>Employee Name</th>
                            <th>Email</th>
                            <th>Profile Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) !== 0) {
                            echo '<center>Showing <span style="font-size:15px;">' . mysqli_num_rows($result) . '</span> records.</center><br/> ';
                            while ($res = mysqli_fetch_array($result)) {
                                // output data of each row
                                ?>
                                <tr>
                                    <td><?php echo $res['employeeid']; ?></td>
                                    <td><?php echo $res['icno']; ?></td>
                                    <td><?php echo $res['empname']; ?></td>
                                    <td><a href="EditEmail.php?empemail=<?php echo $res['email']; ?>"><?php echo $res['email']?></a></td>
                                    <td><?php echo $res['pass']; ?></td>
                                    <!--button hijau kuning merah-->

                                    <td>
                                        <button type="button" title="Edit" name="edit" id="<?php echo $res['email']; ?>" class="edit_data btn btn-success btn-sm" data-toggle="modal"  data-target="#editEmployee"><span class="glyphicon glyphicon-pencil"></span></button>

                                        <button type="button" title="Details" name="view" id="<?php echo $res['email']; ?>" class="view_data btn btn-warning btn-sm" data-toggle="modal"  data-target="#viewEmployee"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                                        <a href="delete.php?email=<?php echo $res['email']; ?>"><button type="button" title="Delete" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash"></span></button></a></td>
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
        <!-- Modal Employee Details -->
        <div id="viewEmployee" class="modal fade">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Employee Information</h4>
                    </div>
                    <div class="modal-body" id="employeeDetail">
                        <center><div class="loader"></div></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Employee -->
        <div id="editEmployee" class="modal fade">  
            <div class="modal-dialog modal-lg">  
                <div class="modal-content">  
                    <div class="modal-header">  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h4 class="modal-title">Employee Information</h4>  
                    </div>  
                    <div class="modal-body">  
                        <form method="post" id="insert_form">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="4">Personal Information<input type="hidden" name="email" id="email"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>IC No.</label></td>
                                        <td><input type="text" name="icno" id="icno" class="form-control" onchange="setDob()"/></td>
                                        <td><label>Employee Name</label></td>
                                        <td><input type="text" name="empname" id="empname" class="form-control" required/></td>
                                    </tr>
                                    <tr>
                                        <td><label>Gender</label></td>
                                        <td><select name="gender" id="gender" class="form-control">
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select></td>
                                        <td><label>Religion</label></td>
                                        <td><select name="religion" id="religion" class="form-control">
                                                <option value="ISLAM">Islam</option>
                                                <option value="CHRISTIAN">Christian</option>
                                                <option value="HINDU">Hindu</option>
                                                <option value="BUDDHA">Buddha</option>
                                                <option value="OTHERS">Others</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><label>Marital Status</label></td>
                                        <td><select name="maritalstatus" id="maritalstatus" class="form-control">
                                                <option value="SINGLE">Single</option>
                                                <option value="ENGAGED">Engaged</option>
                                                <option value="MARRIED">Married</option>
                                                <option value="DIVORCED">Divorced</option>
                                            </select></td>
                                        <td><label>Mobile Number</label></td>
                                        <td><input type="text" name="telno" id="telno" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>Address</label></td>
                                        <td><input type="text" name="address" id="address" class="form-control"/></td>
                                        <td><label>Poscode</label></td>
                                        <td><input type="text" name="poscode" id="poscode" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>State</label></td>
                                        <td><select name="state" id="state" class="form-control">
                                                <option value="WP KUALA LUMPUR">WP KUALA LUMPUR</option>
                                                <option value="WP LABUAN">WP LABUAN</option>
                                                <option value="PUTRAJAYA">PUTRAJAYA</option>
                                                <option value="JOHOR">JOHOR</option>
                                                <option value="KEDAH">KEDAH</option>
                                                <option value="KELANTAN">KELANTAN</option>
                                                <option value="MELAKA">MELAKA</option>
                                                <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                                                <option value="PAHANG">PAHANG</option>
                                                <option value="PERAK">PERAK</option>
                                                <option value="PERLIS">PERLIS</option>
                                                <option value="PULAU PINANG">PULAU PINANG</option>
                                                <option value="SABAH">SABAH</option>
                                                <option value="SARAWAK">SARAWAK</option>
                                                <option value="SELANGOR">SELANGOR</option>
                                                <option value="TERENGGANU">TERENGGANU</option>
                                            </select></td>
                                        <td><label>Date of Birth</label></td>
                                        <td><input type="date" name="dob" id="dob" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>Passport No</label></td>
                                        <td><input type="text" name="passportno" id="passportno" class="form-control"/></td>
                                        <td><label>Nationality</label></td>
                                        <td><select name="nationality" id="nationality" class="form-control">
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="The Bahamas">The Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="People 's Republic of China">People 's Republic of China</option>
                                                <option value="Republic of China">Republic of China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos(Keeling) Islands">Cocos(Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="The Gambia">The Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea - Bissau">Guinea - Bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="North Korea">North Korea</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="Kosovo">Kosovo</option>
                                                <option value="Kuawait">Kuwait</option>
                                                <option value="Kyryzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagasar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesi">Micronesia</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Nagorno - Kabarkh">Nagorno - Karabakh</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Turkish Republic of Northern Cyprus">Turkish Republic of Northern Cyprus</option>
                                                <option value="Northern Mariana">Northern Mariana</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn Islands">Pitcairn Islands</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Barthelemy">Saint Barthelemy</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Martin">Saint Martin</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="Somaliland">Somaliland</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Ossetia">South Ossetia</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard">Svalbard</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor - Leste">Timor - Leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Transnistria Pridnestrovie">Transnistria Pridnestrovie</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tristan da Cunha">Tristan da Cunha</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City">Vatican City</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="British Virgin Islands">British Virgin Islands</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="US Virgin Islands">US Virgin Islands</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select></td>
                                    </tr>
                                </table><br/>
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="6">Employment Information</td>
                                    </tr>
                                    <tr>
                                        <td><label>Employee ID</label></td>
                                        <td><input type="text" name="employeeid" id="employeeid" class="form-control" required/></td>
                                        <td><label>Job Category</label></td>
                                        <td><select name="jobcategory" id="jobcategory" class="form-control">
                                                <option value="">Please select the job category</option>
                                                <option value="Executive">EXECUTIVE</option>
                                                <option value="Non-Executive">NON-EXECUTIVE</option>
                                                <option value="Intern">INTERN</option> 
                                            </select><br/></td>
                                        <td rowspan="6"><label>Employee Working Branch</label></td>
                                        <td rowspan="6"><select name="branchid" id="branchid" class="form-control">
                                                <option value="">Please select the branch</option>
                                                <?php
                                                    $query2 = "select * from branch where idcom='$idcom'";
                                                    $result2 = mysqli_query($con, $query2);
                                                    while ($row = mysqli_fetch_array($result2)) {
                                                        echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                                    }
                                                ?>
                                            </select><br/>
                                            <select name="branchid2" id="branchid2" class="form-control">
                                                <option value="">select the branch</option>
                                                <?php
                                                $query2 = "select * from branch where idcom='$idcom'";
                                                $result2 = mysqli_query($con, $query2);
                                                while ($row = mysqli_fetch_array($result2)) {
                                                    echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                                }
                                                ?>
                                            </select><br/>
                                            <select name="branchid3" id="branchid3" class="form-control">
                                                <option value="">select the branch</option>
                                                <?php
                                                $query2 = "select * from branch where idcom='$idcom'";
                                                $result2 = mysqli_query($con, $query2);
                                                while ($row = mysqli_fetch_array($result2)) {
                                                    echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                                }
                                                ?>
                                            </select><br/>
                                            <select name="branchid4" id="branchid4" class="form-control">
                                                <option value="">select the branch</option>
                                                <?php
                                                $query2 = "select * from branch where idcom='$idcom'";
                                                $result2 = mysqli_query($con, $query2);
                                                while ($row = mysqli_fetch_array($result2)) {
                                                    echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                                }
                                                ?>
                                            </select><br/>
                                            <select name="branchid5" id="branchid5" class="form-control">
                                                <option value="">select the branch</option>
                                                <?php
                                                $query2 = "select * from branch where idcom='$idcom'";
                                                $result2 = mysqli_query($con, $query2);
                                                while ($row = mysqli_fetch_array($result2)) {
                                                    echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                                }
                                                ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        
                                        <td><label>Date Join</label></td>
                                        <td><input type="date" name="datejoin" id="datejoin" class="form-control"/></td>
                                        <td><label>Date Resign</label></td>
                                        <td><input type="date" name="dateresign" id="dateresign" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>Date Promote</label></td>
                                        <td><input type="date" name="datepromote" id="datepromote" class="form-control"/></td>
                                        <td><label>Date Transfer</label></td>
                                        <td><input type="date" name="datetransfer" id="datetransfer" class="form-control"/></td>
                                    </tr>
                                </table><br/>
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="4">Compensation</td>
                                    </tr>
                                    <tr>
                                        <td><label>Bank Account No.</label></td>
                                        <td><input type="text" name="acno" id="acno" class="form-control"/></td>
                                        <td><label>Bank Name</label></td>
                                        <td><input type="text" name="bankname" id="bankname" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>EPF No.</label></td>
                                        <td><input type="text" name="epfno" id="epfno" class="form-control"/></td>
                                        <td><label>SOCSO No.</label></td>
                                        <td><input type="text" name="socsono" id="socsono" class="form-control"/></td>
                                    </tr>
                                    <tr>
                                        <td><label>Tax No.</label></td>
                                        <td><input type="text" name="taxno" id="taxno" class="form-control"/></td>
                                    </tr>                                   
                                </table>
                                <!--permission condition-->
                                <table class="table table-bordered">
                                    <tr>
                                        <td><label>Admin Access</label></td>
                                        <td>
                                            <select name="admincond" id="admincond" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <!--c permission condition-->
                            </div>
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                        </form>  
                    </div>  
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close.</button>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- End of modal Edit Employee -->

        <!-- Modal Add Employee-->
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Employee Information</h4>
                    </div>
                    <div class="modal-body">
                        <p class="">The field with * is required.</p>
                        <form method="post" id="add_form">
                            <input type="text" name="employee_id" id="employee_id" placeholder="Employee ID *" class="form-control"/><br/>
                            <input type="text" name="ic_no" id="ic_no" placeholder="IC No." class="form-control"/><br/>
                            <input type="password" name="pass_" id="pass_" placeholder="Create Password *" class="form-control"/><br/>
                            <input type="text" name="emp_name" id="emp_name" placeholder="Employee Name *" class="form-control" /><br/>
                            <input type="text" name="email_" id="email_" placeholder="Employee Email *" class="form-control" /><br/>
                            <input type="text" name="tel_no" id="tel_no" placeholder="Employee Mobile No." class="form-control" /><br/>         
                            <input type="text" name="passport_no" id="passport_no" placeholder="Employee Passport No." class="form-control" /><br/>
                            <select name="nationality_" id="nationality_" class="form-control">
                                <option value="">--- Please Select Nationality ---</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="The Bahamas">The Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="People 's Republic of China">People 's Republic of China</option>
                                <option value="Republic of China">Republic of China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos(Keeling) Islands">Cocos(Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="Gabon">Gabon</option>
                                <option value="The Gambia">The Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea - Bissau">Guinea - Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="North Korea">North Korea</option>
                                <option value="South Korea">South Korea</option>
                                <option value="Kosovo">Kosovo</option>
                                <option value="Kuawait">Kuwait</option>
                                <option value="Kyryzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagasar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesi">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Nagorno - Kabarkh">Nagorno - Karabakh</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Turkish Republic of Northern Cyprus">Turkish Republic of Northern Cyprus</option>
                                <option value="Northern Mariana">Northern Mariana</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn Islands">Pitcairn Islands</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Barthelemy">Saint Barthelemy</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin">Saint Martin</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="Somaliland">Somaliland</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Ossetia">South Ossetia</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard">Svalbard</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor - Leste">Timor - Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Transnistria Pridnestrovie">Transnistria Pridnestrovie</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tristan da Cunha">Tristan da Cunha</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City">Vatican City</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="British Virgin Islands">British Virgin Islands</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="US Virgin Islands">US Virgin Islands</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select><br/>
                            <input type="submit" name="bt-insert" id="bt-insert" class="btn btn-success btn-sm btn-block" value="Create Profile"/></a>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- End of modal Add Employee -->
        <!-- Bootstrap core JavaScript
   ================================================== -->
        <script src="../js/jquery.min.js"></script>  
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
