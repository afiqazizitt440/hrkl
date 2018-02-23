<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    $query = "select * from branch where idcom='$idcom'";
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
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link type = "text/css" href = "../css/bootstrap.min.css" rel = "stylesheet" />
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <title>Organization</title>
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .ui-timepicker-container{ 
                z-index:1151 !important; 
            }

            .confirm_selection {
                -webkit-transition: text-shadow 1s linear;
                -moz-transition: text-shadow 1s linear;
                -ms-transition: text-shadow 1s linear;
                -o-transition: text-shadow 1s linear;
                transition: text-shadow 1s linear;
            }
            .confirm_selection:hover,
            .confirm_selection.glow {
                text-shadow: 0 0 10px red;
            }
        </style>
        <script>
            var glow = $('.confirm_selection');
            setInterval(function () {
                glow.hasClass('glow') ? glow.removeClass('glow') : glow.addClass('glow');
            }, 1000);
            //start of add employee modal f()
            $(document).on('click', '.add_data', function () {
                $('#add_form').on("submit", function (event) {
                    event.preventDefault();

                    if ($('#employee_id').val() == "")
                    {
                        alert("Employee ID is required..!");
                    } else if ($('#pass_').val() == "")
                    {
                        alert("Password is required..!");
                    } else if ($('#emp_name').val() == "")
                    {
                        alert("Employee Name is required..!");
                    } else if ($('#email_').val() == "")
                    {
                        alert("Email is required..!");
                    }else if ($('#nationality_').val() == "")
                    {
                        alert("Nationality is required..!");
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
                                location.reload();
                                alert("Profile Created Successfully..!");
                            }
                        });
                    }
                });
            });//end of add modal

            //start of add dept modal f()
            $(document).on('click', '.add_dept', function () {
                $('#add_dept_form').on("submit", function (event) {
                    event.preventDefault();

                    if ($('#dept_id').val() == "")
                    {
                        alert("Department ID is required..!");
                    } else if ($('#dept_name').val() == "")
                    {
                        alert("Department Name is required..!");
                    } else if ($('#branchid').val() == "")
                    {
                        alert("Please select the branch for this department..!");
                    } else
                    {
                        $.ajax({
                            url: "createDept.php",
                            method: "POST",
                            data: $('#add_dept_form').serialize(),
                            beforeSend: function () {
                                $('#bt-dept').val("Creating Department Profile..");
                            },
                            success: function (data) {
                                $('#add_dept_form')[0].reset();
                                $('#add_dept_Modal').modal('hide');
                                $('#add_dept_Modal .close').click();
                                location.reload();
                                alert("Department Profile Created Successfully..!");
                            }
                        });
                    }
                });
            });//end of add dept modal

            //start of add branch modal f()
            $(document).on('click', '.add_branch', function () {
                $('#add_branch_form').on("submit", function (event) {
                    event.preventDefault();

                    if ($('#branch_id').val() == "")
                    {
                        alert("Branch ID is required..!");
                    } else if ($('#branch_location').val() == "")
                    {
                        alert("Branch location is required..!");

                    } else if ($('#region').val() == "")
                    {
                        alert("Region is required..!");

                    } else
                    {
                        $.ajax({
                            url: "createBranch.php",
                            method: "POST",
                            data: $('#add_branch_form').serialize(),
                            beforeSend: function () {
                                $('#bt-branch').val("Creating Branching Profile..");
                            },
                            success: function (data) {
                                $('#add_branch_form')[0].reset();
                                $('#add_branch_Modal').modal('hide');
                                $('#add_branch_Modal .close').click();
                                location.reload();
                                alert("Department Profile Created Successfully..!");
                            }
                        });
                    }
                });
            });//end of add branch modal

            $(document).ready(function () {
                //jquery timepicker
                $('.timepicker').timepicker({
                    timeFormat: 'HH:mm',
                    interval: 60,
                    minTime: '07',
                    maxTime: '23:00',
                    defaultTime: '11',
                    startTime: '07:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
            });
        </script>
    </head>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading panel-primary">Department<i class="fa fa-building-o pull-right"></i></div>
                    <div class="panel-body">
                        <a href="DeptList.php"><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Department List</button></a>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-sm add_dept" data-toggle="modal" data-target="#add_dept_Modal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Department</button>

                        <!-- Modal Add Department-->
                        <div id="add_dept_Modal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Department Information</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="">Create a Department Profile</p>
                                        <form id="add_dept_form" method="post">
                                            <input type="text" name="dept_id" id="dept_id" placeholder="Department ID *" class="form-control "><br/>
                                            <input type="text" name="dept_name" id="dept_name" placeholder="Department Name *" class="form-control"><br/>
                                            <textarea name="description" id="description" placeholder="Description about the department" class="form-control"></textarea><br/>
                                            <select name="branchid" id="branchid" class="form-control">
                                                <option value="">Please select the branch</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['branchid'] . "'>" . $row['branchid'] . "</option>";
                                                }
                                                ?>
                                            </select><br/>
                                            <input type="hidden" name="idcom" id="idcom" value="<?php echo $_SESSION["idcom"]; ?>" />
                                            <input type="submit" name="bt-dept" id="bt-dept" class="btn btn-success btn-sm btn-block" value="Create Department Profile"/>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div> <!-- End of modal Add Department -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="panel panel-primary">
                    <div class="panel-heading panel-primary">Employees<i class="fa fa-user-o pull-right"></i></div>
                    <div class="panel-body">
                        <a href="EmployeeList.php"><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Employee List</button></a>

                        <!-- Trigger the modal with a button -->
                        <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-sm add_data"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Employee</button>

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
                                            <select name="nationality" class="form-control">
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
                        <!-- End of modal Add Employee -->
                        <a href="ManageEmployees.php"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-user"></span> Manage Employees</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading panel-primary">Branches<i class="fa fa-code-fork pull-right"></i></div>
                    <div class="panel-body">
                        <a href="BranchList.php"><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Branches List</button></a>

                        <!-- Trigger the modal with a button -->
                        <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_branch_Modal" class="btn btn-primary btn-sm add_branch"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Branch</button>

                        <!-- Modal Add Branch-->
                        <div id="add_branch_Modal" class="modal fade">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Branch Information</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="">Please fill in the information for a company's branch</p>
                                        <form method="post" id="add_form">

                                            <label>Branch ID</label><input type="text" name="branch_id" id="branch_id" placeholder="Branch ID *"class="form-control"/><br/>
                                            <label>Region</label><input type="text" name="branch_location" id="branch_location" placeholder="Branch Location *" class="form-control"/><br/>
                                            <label>Operating Hours (24H)</label><br/><input class="timepicker" name="open_hours" id="openhours"/><span> - </span>
                                            <input class="timepicker" name="close_hours" id="close_hours"/><br/><br/>
                                            <label>Branch State</label><select name="state_" id="state_" class="form-control">
                                                <option value="">Select the branch state</option>
                                                <option value="PERLIS">PERLIS</option>
                                                <option value="KEDAH">KEDAH</option>
                                                <option value="PULAU PINANG">PULAU PINANG</option>
                                                <option value="PERAK">PERAK</option>
                                                <option value="SELANGOR">SELANGOR</option>
                                                <option value="WP KUALA LUMPUR">WP KUALA LUMPUR</option>
                                                <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                                                <option value="MELAKA">MELAKA</option>
                                                <option value="JOHOR">JOHOR</option>
                                                <option value="PAHANG">PAHANG</option>
                                                <option value="TERENGGANU">TERENGGANU</option>
                                                <option value="KELANTAN">KELANTAN</option>
                                                <option value="SARAWAK">SARAWAK</option>
                                                <option value="SABAH">SABAH</option>
                                            </select><br/>
                                            <input type="submit" name="bt-branch" id="bt-branch" class="btn btn-success btn-sm btn-block" value="Add Branch"/></a>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of modal Add Branch -->
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-collapse panel-default">
            <div class="panel-heading">Company Organization <div class="confirm_selection" style="overflow-x: hidden; overflow-y: hidden; opacity: 1;">(Under Development)</div></div>
            <div class="panel-body">
                
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="../js/jquery.min.js"></script>  
    <script src="../js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</body>
</html>

