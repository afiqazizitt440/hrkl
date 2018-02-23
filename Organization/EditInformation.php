<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $empname = $_SESSION["empname"];
    $background = "../images/hr-background.jpg";
    $query = "SELECT admin_org.*,personalinformation.*,employeeinformation.employeeid,employeefinancial.acno,employeefinancial.bankname,employeeimage.img FROM admin_org 
join personalinformation on admin_org.email = personalinformation.email
join employeeinformation on personalinformation.email = employeeinformation.email
join employeefinancial on employeeinformation.email = employeefinancial.email
join employeeimage on employeefinancial.email = employeeimage.email
where admin_org.email='$email'";

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
        <title>Dashboard</title>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .profile-user-pic{
                float: none;
                margin: 0 auto;
                width: 50%;
                height: 50%
            }


        </style>
        <script>
        function back() {
                window.history.back();
            }
        </script>
    </head>
    <body>
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
                        <li class="active"><a href="Home.php">Dashboard</a></li>
                        <li><a href="Employees.php">Organization</a></li>
                        <li><a href="ManageAttendance.php">Attendance</a></li>
                        <li><a href="LeaveSettings.php">Leave</a></li>
                        <li><a href="#contact">Payroll</a></li>
                        <li><a href="#contact">Calendar</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $empname ?> <span class="caret"></span></a>
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

        <div id="main">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="container">
                            <div class="navbar-header">
                                <span class="navbar-brand">Employee Panel</span>
                            </div>
                            <p class="navbar-text"></p>
                        </div>
                    </nav>
                    <!-- edit profile panel -->
                    <div class="container" style=" background-color: white;">
                        <h1 class="page-header">Edit Profile</h1>
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="text-center">
                                    <div class="profile-user-pic">
                                        <?php
                                        while ($res = mysqli_fetch_array($result)) {
                                            // fetch the data from database
                                            if (!empty($res["img"]) && is_file('../Employee/employeepictures/' . $res["img"])) {
                                                echo"<img src='../Employee/employeepictures/" . $res["img"] . "' class='img img-responsive img-thumbnail'>";
                                            } else {
                                                echo "<img src='../Employee/employeepictures/default.jpg'  class='img img-responsive img-thumbnail' alt='Default Profile Pic'>";
                                            }
                                            ?>
                                        </div>
                                        <h6>Upload a different photo...</h6>
                                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                            <input type="file" name="image" id="image" class="text-center center-block well well-sm">
                                            <button type="submit" class="btn btn-primary" name="bt-submit">Upload <span class="glyphicon glyphicon-upload"></span></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- edit form column -->
                                <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                                    <div class="alert alert-info alert-dismissable">
                                        <a class="panel-close close" data-dismiss="alert">okay</a> 
                                        <i class="fa fa-exclamation-circle"></i>
                                        All fields must be <strong>filled.</strong>
                                    </div>
                                    <h3>Personal Information</h3>
                                    <form action="updateInformation.php" method="post" class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <!--<label class="col-lg-3 control-label">Email :</label>-->
                                            <div class="col-lg-8">
                                                <input name="email" id="email" class="form-control" value="<?php echo $res['email']; ?>" type="hidden"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Employee ID :</label>
                                            <div class="col-lg-8">
                                                <input name="employeeid" class="form-control" value="<?php echo $res['employeeid']; ?>" type="text" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">IC Number :</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" name="icno" id="icno" value="<?php echo $res['icno']; ?>" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Full Name :</label>
                                            <div class="col-lg-8">
                                                <input name="empname" class="form-control" value="<?php echo $res['empname']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Gender :</label>
                                            <div class="col-lg-8">
                                                <div class="ui-select">
                                                    <select name="gender" id="gender" class="form-control">
                                                        <?php $bg = $res["gender"]; ?>
                                                        <option value="" <?php if ($bg == null) echo 'selected="selected"'; ?>>--- Please Select Gender ---</option>
                                                        <option value="MALE" <?php if ($bg == "MALE") echo 'selected="selected"'; ?>>Male</option>
                                                        <option value="FEMALE" <?php if ($bg == "FEMALE") echo 'selected="selected"'; ?>>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Religion :</label>
                                            <div class="col-lg-8">
                                                <div class="ui-select">
                                                    <select name="religion" class="form-control">
                                                        <?php $areligion = $res["religion"]; ?>
                                                        <option value="" <?php if ($areligion == null) echo 'selected="selected"'; ?>>--- Please Select Your Religion ---</option>
                                                        <option value="ISLAM" <?php if ($areligion == "ISLAM") echo 'selected="selected"'; ?>>Islam</option>
                                                        <option value="CHRISTIAN" <?php if ($areligion == "CHRISTIAN") echo 'selected="selected"'; ?>>Christian</option>
                                                        <option value="HINDU" <?php if ($areligion == "HINDU") echo 'selected="selected"'; ?>>Hindu</option>
                                                        <option value="BUDDHA" <?php if ($areligion == "BUDDHA") echo 'selected="selected"'; ?>>Buddha</option>
                                                        <option value="OTHERS" <?php if ($areligion == "OTHERS") echo 'selected="selected"'; ?>>Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Marital Status :</label>
                                            <div class="col-lg-8">
                                                <div class="ui-select">
                                                    <select name="maritalstatus" class="form-control">
                                                        <?php $mstatus = $res["maritalstatus"]; ?>
                                                        <option value="" <?php if ($mstatus == null) echo 'selected="selected"'; ?>>--- Please Select Marital Status ---</option>
                                                        <option value="SINGLE" <?php if ($mstatus == "SINGLE") echo 'selected="selected"'; ?>>Single</option>
                                                        <option value="ENGAGED" <?php if ($mstatus == "ENGAGED") echo 'selected="selected"'; ?>>Engaged</option>
                                                        <option value="MARRIED" <?php if ($mstatus == "MARRIED") echo 'selected="selected"'; ?>>Married</option>
                                                        <option value="DIVORCED" <?php if ($mstatus == "DIVORCED") echo 'selected="selected"'; ?>>Divorced</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Mobile Number :</label>
                                            <div class="col-lg-8">
                                                <input name="telno" id="email" class="form-control" value="<?php echo $res['telno']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Address :</label>
                                            <div class="col-lg-8">
                                                <input name="address" id="address" class="form-control" value="<?php echo $res['address']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Poscode :</label>
                                            <div class="col-lg-8">
                                                <input name="poscode" id="poscode" class="form-control" value="<?php echo $res['poscode']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">State :</label>
                                            <div class="col-lg-8">
                                                <select name="state" id="state" class="form-control">
                                                    <?php $valloc = $res["state"]; ?>
                                                    <option value="WP KUALA LUMPUR" <?php if ($valloc == "WP KUALA LUMPUR") echo 'selected="selected"'; ?>>WP KUALA LUMPUR</option>
                                                    <option value="WP LABUAN" <?php if ($valloc == "WP LABUAN") echo 'selected="selected"'; ?>>WP LABUAN</option>
                                                    <option value="PUTRAJAYA" <?php if ($valloc == "WP PUTRAJAYA") echo 'selected="selected"'; ?>>PUTRAJAYA</option>
                                                    <option value="JOHOR" <?php if ($valloc == "JOHOR") echo 'selected="selected"'; ?>>JOHOR</option>
                                                    <option value="KEDAH" <?php if ($valloc == "KEDAH") echo 'selected="selected"'; ?>>KEDAH</option>
                                                    <option value="KELANTAN" <?php if ($valloc == "KELANTAN") echo 'selected="selected"'; ?>>KELANTAN</option>
                                                    <option value="MELAKA" <?php if ($valloc == "MELAKA") echo 'selected="selected"'; ?>>MELAKA</option>
                                                    <option value="NEGERI SEMBILAN" <?php if ($valloc == "NEGERI SEMBILAN") echo 'selected="selected"'; ?>>NEGERI SEMBILAN</option>
                                                    <option value="PAHANG" <?php if ($valloc == "PAHANG") echo 'selected="selected"'; ?>>PAHANG</option>
                                                    <option value="PERAK" <?php if ($valloc == "PERAK") echo 'selected="selected"'; ?>>PERAK</option>
                                                    <option value="PERLIS" <?php if ($valloc == "PERLIS") echo 'selected="selected"'; ?>>PERLIS</option>
                                                    <option value="PULAU PINANG" <?php if ($valloc == "PULAU PINANG") echo 'selected="selected"'; ?>>PULAU PINANG</option>
                                                    <option value="SABAH" <?php if ($valloc == "SABAH") echo 'selected="selected"'; ?>>SABAH</option>
                                                    <option value="SARAWAK" <?php if ($valloc == "SARAWAK") echo 'selected="selected"'; ?>>SARAWAK</option>
                                                    <option value="SELANGOR" <?php if ($valloc == "SELANGOR") echo 'selected="selected"'; ?>>SELANGOR</option>
                                                    <option value="TERENGGANU" <?php if ($valloc == "TERENGGANU") echo 'selected="selected"'; ?>>TERENGGANU</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Date of Birth :</label>
                                            <div class="col-lg-8">
                                                <input name="dob" id="dob" class="form-control" value="<?php echo $res['dob']; ?>" type="date"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Passport Number :</label>
                                            <div class="col-lg-8">
                                                <input name="passportno" id="passportno" class="form-control" value="<?php echo $res['passportno']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Nationality :</label>
                                            <div class="col-lg-8">
                                                <select name="nationality" class="form-control">
                                                    <?php $nation = $res["nationality"]; ?>
                                                    <option value="" <?php if ($nation == "") echo 'selected="selected"'; ?>>--- Please Select Nationality ---</option>
                                                    <option value="Afghanistan" <?php if ($nation == "Afghanistan") echo 'selected="selected"'; ?>>Afghanistan</option>
                                                    <option value="Albania" <?php if ($nation == "Albania") echo 'selected="selected"'; ?>>Albania</option>
                                                    <option value="Algeria" <?php if ($nation == "Algeria") echo 'selected="selected"'; ?>>Algeria</option>
                                                    <option value="American Samoa" <?php if ($nation == "American Samoa") echo 'selected="selected"'; ?>>American Samoa</option>
                                                    <option value="Andorra" <?php if ($nation == "Andorra") echo 'selected="selected"'; ?>>Andorra</option>
                                                    <option value="Angola" <?php if ($nation == "Angola") echo 'selected="selected"'; ?>>Angola</option>
                                                    <option value="Anguilla" <?php if ($nation == "Anguilla") echo 'selected="selected"'; ?>>Anguilla</option>
                                                    <option value="Antigua and Barbuda" <?php if ($nation == "Antigua and Barbuda") echo 'selected="selected"'; ?>>Antigua and Barbuda</option>
                                                    <option value="Argentina" <?php if ($nation == "Argentina") echo 'selected="selected"'; ?>>Argentina</option>
                                                    <option value="Armenia" <?php if ($nation == "Armenia") echo 'selected="selected"'; ?>>Armenia</option>
                                                    <option value="Aruba" <?php if ($nation == "Aruba") echo 'selected="selected"'; ?>>Aruba</option>
                                                    <option value="Australia" <?php if ($nation == "Australia") echo 'selected="selected"'; ?>>Australia</option>
                                                    <option value="Austria" <?php if ($nation == "Austria") echo 'selected="selected"'; ?>>Austria</option>
                                                    <option value="Azerbaijan" <?php if ($nation == "Azerbaijan") echo 'selected="selected"'; ?>>Azerbaijan</option>
                                                    <option value="The Bahamas" <?php if ($nation == "The Bahamas") echo 'selected="selected"'; ?>>The Bahamas</option>
                                                    <option value="Bahrain" <?php if ($nation == "Bahrain") echo 'selected="selected"'; ?>>Bahrain</option>
                                                    <option value="Bangladesh" <?php if ($nation == "Bangladesh") echo 'selected="selected"'; ?>>Bangladesh</option>
                                                    <option value="Barbados" <?php if ($nation == "Barbados") echo 'selected="selected"'; ?>>Barbados</option>
                                                    <option value="Belarus" <?php if ($nation == "Belarus") echo 'selected="selected"'; ?>>Belarus</option>
                                                    <option value="Belgium" <?php if ($nation == "Belgium") echo 'selected="selected"'; ?>>Belgium</option>
                                                    <option value="Belize" <?php if ($nation == "Belize") echo 'selected="selected"'; ?>>Belize</option>
                                                    <option value="Benin" <?php if ($nation == "Benin") echo 'selected="selected"'; ?>>Benin</option>
                                                    <option value="Bermuda" <?php if ($nation == "Bermuda") echo 'selected="selected"'; ?>>Bermuda</option>
                                                    <option value="Bhutan" <?php if ($nation == "Bhutan") echo 'selected="selected"'; ?>>Bhutan</option>
                                                    <option value="Bolivia" <?php if ($nation == "Bolivia") echo 'selected="selected"'; ?>>Bolivia</option>
                                                    <option value="Bosnia and Herzegovina" <?php if ($nation == "Bosnia and Herzegovina") echo 'selected="selected"'; ?>>Bosnia and Herzegovina</option>
                                                    <option value="Botswana" <?php if ($nation == "Botswana") echo 'selected="selected"'; ?>>Botswana</option>
                                                    <option value="Brazil" <?php if ($nation == "Brazil") echo 'selected="selected"'; ?>>Brazil</option>
                                                    <option value="Brunei" <?php if ($nation == "Brunei") echo 'selected="selected"'; ?>>Brunei</option>
                                                    <option value="Bulgaria" <?php if ($nation == "Bulgaria") echo 'selected="selected"'; ?>>Bulgaria</option>
                                                    <option value="Burkina Faso" <?php if ($nation == "Burkina Faso") echo 'selected="selected"'; ?>>Burkina Faso</option>
                                                    <option value="Burundi" <?php if ($nation == "Burundi") echo 'selected="selected"'; ?>>Burundi</option>
                                                    <option value="Cambodia" <?php if ($nation == "Cambodia") echo 'selected="selected"'; ?>>Cambodia</option>
                                                    <option value="Cameroon" <?php if ($nation == "Cameroon") echo 'selected="selected"'; ?>>Cameroon</option>
                                                    <option value="Canada" <?php if ($nation == "Canada") echo 'selected="selected"'; ?>>Canada</option>
                                                    <option value="Cape Verde" <?php if ($nation == "Cape Verde") echo 'selected="selected"'; ?>>Cape Verde</option>
                                                    <option value="Cayman Islands" <?php if ($nation == "Cayman Islands") echo 'selected="selected"'; ?>>Cayman Islands</option>
                                                    <option value="Central African Republic" <?php if ($nation == "Central African Republic") echo 'selected="selected"'; ?>>Central African Republic</option>
                                                    <option value="Chad" <?php if ($nation == "Chad") echo 'selected="selected"'; ?>>Chad</option>
                                                    <option value="Chile" <?php if ($nation == "Chile") echo 'selected="selected"'; ?>>Chile</option>
                                                    <option value="People 's Republic of China" <?php if ($nation == "People 's Republic of China") echo 'selected="selected"'; ?>>People 's Republic of China</option>
                                                    <option value="Republic of China" <?php if ($nation == "Republic of China") echo 'selected="selected"'; ?>>Republic of China</option>
                                                    <option value="Christmas Island" <?php if ($nation == "Christmas Island") echo 'selected="selected"'; ?>>Christmas Island</option>
                                                    <option value="Cocos(Keeling) Islands" <?php if ($nation == "Cocos(Keeling) Islands") echo 'selected="selected"'; ?>>Cocos(Keeling) Islands</option>
                                                    <option value="Colombia" <?php if ($nation == "Colombia") echo 'selected="selected"'; ?>>Colombia</option>
                                                    <option value="Comoros" <?php if ($nation == "Comoros") echo 'selected="selected"'; ?>>Comoros</option>
                                                    <option value="Congo" <?php if ($nation == "Congo") echo 'selected="selected"'; ?>>Congo</option>
                                                    <option value="Cook Islands" <?php if ($nation == "Cook Islands") echo 'selected="selected"'; ?>>Cook Islands</option>
                                                    <option value="Costa Rica" <?php if ($nation == "Costa Rica") echo 'selected="selected"'; ?>>Costa Rica</option>
                                                    <option value="Cote d'Ivoire" <?php if ($nation == "Cote d'Ivoire") echo 'selected="selected"'; ?>>Cote d'Ivoire</option>
                                                    <option value="Croatia" <?php if ($nation == "Croatia") echo 'selected="selected"'; ?>>Croatia</option>
                                                    <option value="Cuba" <?php if ($nation == "Cuba") echo 'selected="selected"'; ?>>Cuba</option>
                                                    <option value="Cyprus" <?php if ($nation == "Cyprus") echo 'selected="selected"'; ?>>Cyprus</option>
                                                    <option value="Czech Republic" <?php if ($nation == "Czech Republic") echo 'selected="selected"'; ?>>Czech Republic</option>
                                                    <option value="Denmark" <?php if ($nation == "Denmark") echo 'selected="selected"'; ?>>Denmark</option>
                                                    <option value="Djibouti" <?php if ($nation == "Djibouti") echo 'selected="selected"'; ?>>Djibouti</option>
                                                    <option value="Dominica" <?php if ($nation == "Dominica") echo 'selected="selected"'; ?>>Dominica</option>
                                                    <option value="Dominican Republic" <?php if ($nation == "Dominican Republic") echo 'selected="selected"'; ?>>Dominican Republic</option>
                                                    <option value="Ecuador" <?php if ($nation == "Ecuador") echo 'selected="selected"'; ?>>Ecuador</option>
                                                    <option value="Egypt" <?php if ($nation == "Egypt") echo 'selected="selected"'; ?>>Egypt</option>
                                                    <option value="El Salvador" <?php if ($nation == "El Salvador") echo 'selected="selected"'; ?>>El Salvador</option>
                                                    <option value="Equatorial Guinea" <?php if ($nation == "Equatorial Guinea") echo 'selected="selected"'; ?>>Equatorial Guinea</option>
                                                    <option value="Eritrea" <?php if ($nation == "Eritrea") echo 'selected="selected"'; ?>>Eritrea</option>
                                                    <option value="Estonia" <?php if ($nation == "Estonia") echo 'selected="selected"'; ?>>Estonia</option>
                                                    <option value="Ethiopia" <?php if ($nation == "Ethiopia") echo 'selected="selected"'; ?>>Ethiopia</option>
                                                    <option value="Falkland Islands" <?php if ($nation == "Falkland Islands") echo 'selected="selected"'; ?>>Falkland Islands</option>
                                                    <option value="Faroe Islands" <?php if ($nation == "Faroe Islands") echo 'selected="selected"'; ?>>Faroe Islands</option>
                                                    <option value="Fiji" <?php if ($nation == "Fiji") echo 'selected="selected"'; ?>>Fiji</option>
                                                    <option value="Finland" <?php if ($nation == "Finland") echo 'selected="selected"'; ?>>Finland</option>
                                                    <option value="France" <?php if ($nation == "France") echo 'selected="selected"'; ?>>France</option>
                                                    <option value="French Polynesia" <?php if ($nation == "French Polynesia") echo 'selected="selected"'; ?>>French Polynesia</option>
                                                    <option value="Gabon" <?php if ($nation == "Gabon") echo 'selected="selected"'; ?>>Gabon</option>
                                                    <option value="The Gambia" <?php if ($nation == "The Gambia") echo 'selected="selected"'; ?>>The Gambia</option>
                                                    <option value="Georgia" <?php if ($nation == "Georgia") echo 'selected="selected"'; ?>>Georgia</option>
                                                    <option value="Germany" <?php if ($nation == "Germany") echo 'selected="selected"'; ?>>Germany</option>
                                                    <option value="Ghana" <?php if ($nation == "Ghana") echo 'selected="selected"'; ?>>Ghana</option>
                                                    <option value="Gibraltar" <?php if ($nation == "Gibraltar") echo 'selected="selected"'; ?>>Gibraltar</option>
                                                    <option value="Greece" <?php if ($nation == "Greece") echo 'selected="selected"'; ?>>Greece</option>
                                                    <option value="Greenland" <?php if ($nation == "Greenland") echo 'selected="selected"'; ?>>Greenland</option>
                                                    <option value="Grenada" <?php if ($nation == "Grenada") echo 'selected="selected"'; ?>>Grenada</option>
                                                    <option value="Guadeloupe" <?php if ($nation == "Guadeloupe") echo 'selected="selected"'; ?>>Guadeloupe</option>
                                                    <option value="Guam" <?php if ($nation == "Guam") echo 'selected="selected"'; ?>>Guam</option>
                                                    <option value="Guatemala" <?php if ($nation == "Guatemala") echo 'selected="selected"'; ?>>Guatemala</option>
                                                    <option value="Guernsey" <?php if ($nation == "Guernsey") echo 'selected="selected"'; ?>>Guernsey</option>
                                                    <option value="Guinea" <?php if ($nation == "Guinea") echo 'selected="selected"'; ?>>Guinea</option>
                                                    <option value="Guinea - Bissau" <?php if ($nation == "Guinea - Bissau") echo 'selected="selected"'; ?>>Guinea - Bissau</option>
                                                    <option value="Guyana" <?php if ($nation == "Guyana") echo 'selected="selected"'; ?>>Guyana</option>
                                                    <option value="Haiti" <?php if ($nation == "Haiti") echo 'selected="selected"'; ?>>Haiti</option>
                                                    <option value="Honduras" <?php if ($nation == "Honduras") echo 'selected="selected"'; ?>>Honduras</option>
                                                    <option value="Hong Kong" <?php if ($nation == "Hong Kong") echo 'selected="selected"'; ?>>Hong Kong</option>
                                                    <option value="Hungary" <?php if ($nation == "Hungary") echo 'selected="selected"'; ?>>Hungary</option>
                                                    <option value="Iceland" <?php if ($nation == "Iceland") echo 'selected="selected"'; ?>>Iceland</option>
                                                    <option value="India" <?php if ($nation == "India") echo 'selected="selected"'; ?>>India</option>
                                                    <option value="Indonesia" <?php if ($nation == "Indonesia") echo 'selected="selected"'; ?>>Indonesia</option>
                                                    <option value="Iran" <?php if ($nation == "Iran") echo 'selected="selected"'; ?>>Iran</option>
                                                    <option value="Iraq" <?php if ($nation == "Iraq") echo 'selected="selected"'; ?>>Iraq</option>
                                                    <option value="Ireland" <?php if ($nation == "Ireland") echo 'selected="selected"'; ?>>Ireland</option>
                                                    <option value="Israel" <?php if ($nation == "Israel") echo 'selected="selected"'; ?>>Israel</option>
                                                    <option value="Italy" <?php if ($nation == "Italy") echo 'selected="selected"'; ?>>Italy</option>
                                                    <option value="Jamaica" <?php if ($nation == "Jamaica") echo 'selected="selected"'; ?>>Jamaica</option>
                                                    <option value="Japan" <?php if ($nation == "Japan") echo 'selected="selected"'; ?>>Japan</option>
                                                    <option value="Jersey" <?php if ($nation == "Jersey") echo 'selected="selected"'; ?>>Jersey</option>
                                                    <option value="Jordan" <?php if ($nation == "Jordan") echo 'selected="selected"'; ?>>Jordan</option>
                                                    <option value="Kazakhstan" <?php if ($nation == "Kazakhstan") echo 'selected="selected"'; ?>>Kazakhstan</option>
                                                    <option value="Kenya" <?php if ($nation == "Kenya") echo 'selected="selected"'; ?>>Kenya</option>
                                                    <option value="Kiribati" <?php if ($nation == "Kiribati") echo 'selected="selected"'; ?>>Kiribati</option>
                                                    <option value="North Korea" <?php if ($nation == "North Korea") echo 'selected="selected"'; ?>>North Korea</option>
                                                    <option value="South Korea" <?php if ($nation == "South Korea") echo 'selected="selected"'; ?>>South Korea</option>
                                                    <option value="Kosovo" <?php if ($nation == "Kosovo") echo 'selected="selected"'; ?>>Kosovo</option>
                                                    <option value="Kuawait" <?php if ($nation == "Kuawait") echo 'selected="selected"'; ?>>Kuwait</option>
                                                    <option value="Kyryzstan" <?php if ($nation == "Kyryzstan") echo 'selected="selected"'; ?>>Kyrgyzstan</option>
                                                    <option value="Laos" <?php if ($nation == "Laos") echo 'selected="selected"'; ?>>Laos</option>
                                                    <option value="Latvia" <?php if ($nation == "Latvia") echo 'selected="selected"'; ?>>Latvia</option>
                                                    <option value="Lebanon" <?php if ($nation == "Lebanon") echo 'selected="selected"'; ?>>Lebanon</option>
                                                    <option value="Lesotho" <?php if ($nation == "Lesotho") echo 'selected="selected"'; ?>>Lesotho</option>
                                                    <option value="Liberia" <?php if ($nation == "Liberia") echo 'selected="selected"'; ?>>Liberia</option>
                                                    <option value="Libya" <?php if ($nation == "Libya") echo 'selected="selected"'; ?>>Libya</option>
                                                    <option value="Liechtenstein" <?php if ($nation == "Liechtenstein") echo 'selected="selected"'; ?>>Liechtenstein</option>
                                                    <option value="Lithuania" <?php if ($nation == "Lithuania") echo 'selected="selected"'; ?>>Lithuania</option>
                                                    <option value="Luxembourg" <?php if ($nation == "Luxembourg") echo 'selected="selected"'; ?>>Luxembourg</option>
                                                    <option value="Macau" <?php if ($nation == "Macau") echo 'selected="selected"'; ?>>Macau</option>
                                                    <option value="Macedonia" <?php if ($nation == "Macedonia") echo 'selected="selected"'; ?>>Macedonia</option>
                                                    <option value="Madagascar" <?php if ($nation == "Madagascar") echo 'selected="selected"'; ?>>Madagasar</option>
                                                    <option value="Malawi" <?php if ($nation == "Malawi") echo 'selected="selected"'; ?>>Malawi</option>
                                                    <option value="Malaysia" <?php if ($nation == "Malaysia") echo 'selected="selected"'; ?>>Malaysia</option>
                                                    <option value="Maldives" <?php if ($nation == "Maldives") echo 'selected="selected"'; ?>>Maldives</option>
                                                    <option value="Mali" <?php if ($nation == "Mali") echo 'selected="selected"'; ?>>Mali</option>
                                                    <option value="Malta" <?php if ($nation == "Malta") echo 'selected="selected"'; ?>>Malta</option>
                                                    <option value="Marshall Islands" <?php if ($nation == "Marshall Islands") echo 'selected="selected"'; ?>>Marshall Islands</option>
                                                    <option value="Martinique" <?php if ($nation == "Martinique") echo 'selected="selected"'; ?>>Martinique</option>
                                                    <option value="Mauritania" <?php if ($nation == "Mauritinia") echo 'selected="selected"'; ?>>Mauritania</option>
                                                    <option value="Mauritius" <?php if ($nation == "Mauritius") echo 'selected="selected"'; ?>>Mauritius</option>
                                                    <option value="Mayotte" <?php if ($nation == "Mayotte") echo 'selected="selected"'; ?>>Mayotte</option>
                                                    <option value="Mexico" <?php if ($nation == "Mexico") echo 'selected="selected"'; ?>>Mexico</option>
                                                    <option value="Micronesi" <?php if ($nation == "Micronesi") echo 'selected="selected"'; ?>>Micronesia</option>
                                                    <option value="Moldova" <?php if ($nation == "Moldova") echo 'selected="selected"'; ?>>Moldova</option>
                                                    <option value="Monaco" <?php if ($nation == "Monaco") echo 'selected="selected"'; ?>>Monaco</option>
                                                    <option value="Mongolia" <?php if ($nation == "Mongolia") echo 'selected="selected"'; ?>>Mongolia</option>
                                                    <option value="Montenegro" <?php if ($nation == "Montenegro") echo 'selected="selected"'; ?>>Montenegro</option>
                                                    <option value="Montserrat" <?php if ($nation == "Montserrat") echo 'selected="selected"'; ?>>Montserrat</option>
                                                    <option value="Morocco" <?php if ($nation == "Morocco") echo 'selected="selected"'; ?>>Morocco</option>
                                                    <option value="Mozambique" <?php if ($nation == "Mozambique") echo 'selected="selected"'; ?>>Mozambique</option>
                                                    <option value="Myanmar" <?php if ($nation == "Myanmar") echo 'selected="selected"'; ?>>Myanmar</option>
                                                    <option value="Nagorno - Kabarkh" <?php if ($nation == "Nagorno - Kabarkh") echo 'selected="selected"'; ?>>Nagorno - Karabakh</option>
                                                    <option value="Namibia" <?php if ($nation == "Namibia") echo 'selected="selected"'; ?>>Namibia</option>
                                                    <option value="Nauru" <?php if ($nation == "Nauru") echo 'selected="selected"'; ?>>Nauru</option>
                                                    <option value="Nepal" <?php if ($nation == "Nepal") echo 'selected="selected"'; ?>>Nepal</option>
                                                    <option value="Netherlands" <?php if ($nation == "Netherlands") echo 'selected="selected"'; ?>>Netherlands</option>
                                                    <option value="Netherlands Antilles" <?php if ($nation == "Netherlands Antilles") echo 'selected="selected"'; ?>>Netherlands Antilles</option>
                                                    <option value="New Caledonia" <?php if ($nation == "New Caledonia") echo 'selected="selected"'; ?>>New Caledonia</option>
                                                    <option value="New Zealand" <?php if ($nation == "New Zealand") echo 'selected="selected"'; ?>>New Zealand</option>
                                                    <option value="Nicaragua" <?php if ($nation == "Nicaragua") echo 'selected="selected"'; ?>>Nicaragua</option>
                                                    <option value="Niger" <?php if ($nation == "Niger") echo 'selected="selected"'; ?>>Niger</option>
                                                    <option value="Nigeria" <?php if ($nation == "Nigeria") echo 'selected="selected"'; ?>>Nigeria</option>
                                                    <option value="Niue" <?php if ($nation == "Niue") echo 'selected="selected"'; ?>>Niue</option>
                                                    <option value="Norfolk Island" <?php if ($nation == "Norfolk Island") echo 'selected="selected"'; ?>>Norfolk Island</option>
                                                    <option value="Turkish Republic of Northern Cyprus" <?php if ($nation == "Turkish Republic of Northern Cyprus") echo 'selected="selected"'; ?>>Turkish Republic of Northern Cyprus</option>
                                                    <option value="Northern Mariana" <?php if ($nation == "Northern Mariana") echo 'selected="selected"'; ?>>Northern Mariana</option>
                                                    <option value="Norway" <?php if ($nation == "Norway") echo 'selected="selected"'; ?>>Norway</option>
                                                    <option value="Oman" <?php if ($nation == "Oman") echo 'selected="selected"'; ?>>Oman</option>
                                                    <option value="Pakistan" <?php if ($nation == "Pakistan") echo 'selected="selected"'; ?>>Pakistan</option>
                                                    <option value="Palau" <?php if ($nation == "Palau") echo 'selected="selected"'; ?>>Palau</option>
                                                    <option value="Palestine" <?php if ($nation == "Palestine") echo 'selected="selected"'; ?>>Palestine</option>
                                                    <option value="Panama" <?php if ($nation == "Panama") echo 'selected="selected"'; ?>>Panama</option>
                                                    <option value="Papua New Guinea" <?php if ($nation == "Papua New Guinea") echo 'selected="selected"'; ?>>Papua New Guinea</option>
                                                    <option value="Paraguay" <?php if ($nation == "Paraguay") echo 'selected="selected"'; ?>>Paraguay</option>
                                                    <option value="Peru" <?php if ($nation == "Peru") echo 'selected="selected"'; ?>>Peru</option>
                                                    <option value="Philippines" <?php if ($nation == "Phillippines") echo 'selected="selected"'; ?>>Philippines</option>
                                                    <option value="Pitcairn Islands" <?php if ($nation == "Pitcairn Islands") echo 'selected="selected"'; ?>>Pitcairn Islands</option>
                                                    <option value="Poland" <?php if ($nation == "Poland") echo 'selected="selected"'; ?>>Poland</option>
                                                    <option value="Portugal" <?php if ($nation == "Portugal") echo 'selected="selected"'; ?>>Portugal</option>
                                                    <option value="Puerto Rico" <?php if ($nation == "Puerto Rico") echo 'selected="selected"'; ?>>Puerto Rico</option>
                                                    <option value="Qatar" <?php if ($nation == "Qatar") echo 'selected="selected"'; ?>>Qatar</option>
                                                    <option value="Romania" <?php if ($nation == "Romania") echo 'selected="selected"'; ?>>Romania</option>
                                                    <option value="Russia" <?php if ($nation == "Russia") echo 'selected="selected"'; ?>>Russia</option>
                                                    <option value="Rwanda" <?php if ($nation == "Rwanda") echo 'selected="selected"'; ?>>Rwanda</option>
                                                    <option value="Saint Barthelemy" <?php if ($nation == "Saint Barthelemy") echo 'selected="selected"'; ?>>Saint Barthelemy</option>
                                                    <option value="Saint Helena" <?php if ($nation == "Saint Helena") echo 'selected="selected"'; ?>>Saint Helena</option>
                                                    <option value="Saint Kitts and Nevis" <?php if ($nation == "Saint Kitts and Nevis") echo 'selected="selected"'; ?>>Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia" <?php if ($nation == "Saint Lucia") echo 'selected="selected"'; ?>>Saint Lucia</option>
                                                    <option value="Saint Martin" <?php if ($nation == "Saint Martin") echo 'selected="selected"'; ?>>Saint Martin</option>
                                                    <option value="Saint Pierre and Miquelon" <?php if ($nation == "Saint Pierre and Miquelon") echo 'selected="selected"'; ?>>Saint Pierre and Miquelon</option>
                                                    <option value="Saint Vincent and the Grenadines" <?php if ($nation == "Saint Vincent and the Grenadines") echo 'selected="selected"'; ?>>Saint Vincent and the Grenadines</option>
                                                    <option value="Samoa" <?php if ($nation == "Samoa") echo 'selected="selected"'; ?>>Samoa</option>
                                                    <option value="San Marino" <?php if ($nation == "San Marino") echo 'selected="selected"'; ?>>San Marino</option>
                                                    <option value="Sao Tome and Principe" <?php if ($nation == "Sao Tome and Principe") echo 'selected="selected"'; ?>>Sao Tome and Principe</option>
                                                    <option value="Saudi Arabia" <?php if ($nation == "Saudi Arabia") echo 'selected="selected"'; ?>>Saudi Arabia</option>
                                                    <option value="Senegal" <?php if ($nation == "Senegal") echo 'selected="selected"'; ?>>Senegal</option>
                                                    <option value="Serbia" <?php if ($nation == "Serbia") echo 'selected="selected"'; ?>>Serbia</option>
                                                    <option value="Seychelles" <?php if ($nation == "Seychelles") echo 'selected="selected"'; ?>>Seychelles</option>
                                                    <option value="Sierra Leone" <?php if ($nation == "Sierra Leone") echo 'selected="selected"'; ?>>Sierra Leone</option>
                                                    <option value="Singapore" <?php if ($nation == "Singapore") echo 'selected="selected"'; ?>>Singapore</option>
                                                    <option value="Slovakia" <?php if ($nation == "Slovakia") echo 'selected="selected"'; ?>>Slovakia</option>
                                                    <option value="Slovenia" <?php if ($nation == "Slovenia") echo 'selected="selected"'; ?>>Slovenia</option>
                                                    <option value="Solomon Islands" <?php if ($nation == "Solomon Islands") echo 'selected="selected"'; ?>>Solomon Islands</option>
                                                    <option value="Somalia" <?php if ($nation == "Somalia") echo 'selected="selected"'; ?>>Somalia</option>
                                                    <option value="Somaliland" <?php if ($nation == "Somaliland") echo 'selected="selected"'; ?>>Somaliland</option>
                                                    <option value="South Africa" <?php if ($nation == "South Africa") echo 'selected="selected"'; ?>>South Africa</option>
                                                    <option value="South Ossetia" <?php if ($nation == "South Ossetia") echo 'selected="selected"'; ?>>South Ossetia</option>
                                                    <option value="Spain" <?php if ($nation == "Spain") echo 'selected="selected"'; ?>>Spain</option>
                                                    <option value="Sri Lanka" <?php if ($nation == "Sri Lanka") echo 'selected="selected"'; ?>>Sri Lanka</option>
                                                    <option value="Sudan" <?php if ($nation == "Sudan") echo 'selected="selected"'; ?>>Sudan</option>
                                                    <option value="Suriname" <?php if ($nation == "Suriname") echo 'selected="selected"'; ?>>Suriname</option>
                                                    <option value="Svalbard" <?php if ($nation == "Svalbard") echo 'selected="selected"'; ?>>Svalbard</option>
                                                    <option value="Swaziland" <?php if ($nation == "Swaziland") echo 'selected="selected"'; ?>>Swaziland</option>
                                                    <option value="Sweden" <?php if ($nation == "Sweden") echo 'selected="selected"'; ?>>Sweden</option>
                                                    <option value="Switzerland" <?php if ($nation == "Switzerland") echo 'selected="selected"'; ?>>Switzerland</option>
                                                    <option value="Syria" <?php if ($nation == "Syria") echo 'selected="selected"'; ?>>Syria</option>
                                                    <option value="Taiwan" <?php if ($nation == "Taiwan") echo 'selected="selected"'; ?>>Taiwan</option>
                                                    <option value="Tajikistan" <?php if ($nation == "Tajikistan") echo 'selected="selected"'; ?>>Tajikistan</option>
                                                    <option value="Tanzania" <?php if ($nation == "Tanzania") echo 'selected="selected"'; ?>>Tanzania</option>
                                                    <option value="Thailand" <?php if ($nation == "Thailand") echo 'selected="selected"'; ?>>Thailand</option>
                                                    <option value="Timor - Leste" <?php if ($nation == "Timor - Leste") echo 'selected="selected"'; ?>>Timor - Leste</option>
                                                    <option value="Togo" <?php if ($nation == "Togo") echo 'selected="selected"'; ?>>Togo</option>
                                                    <option value="Tokelau" <?php if ($nation == "Tokelau") echo 'selected="selected"'; ?>>Tokelau</option>
                                                    <option value="Tonga" <?php if ($nation == "Tonga") echo 'selected="selected"'; ?>>Tonga</option>
                                                    <option value="Transnistria Pridnestrovie" <?php if ($nation == "Transnistria Pridnestrovie") echo 'selected="selected"'; ?>>Transnistria Pridnestrovie</option>
                                                    <option value="Trinidad and Tobago" <?php if ($nation == "Trinidad and Tobago") echo 'selected="selected"'; ?>>Trinidad and Tobago</option>
                                                    <option value="Tristan da Cunha" <?php if ($nation == "Tristan da Cunha") echo 'selected="selected"'; ?>>Tristan da Cunha</option>
                                                    <option value="Tunisia" <?php if ($nation == "Tunisia") echo 'selected="selected"'; ?>>Tunisia</option>
                                                    <option value="Turkey" <?php if ($nation == "Turkey") echo 'selected="selected"'; ?>>Turkey</option>
                                                    <option value="Turkmenistan" <?php if ($nation == "Turkmenistan") echo 'selected="selected"'; ?>>Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands" <?php if ($nation == "Turks and Caicos Islands") echo 'selected="selected"'; ?>>Turks and Caicos Islands</option>
                                                    <option value="Tuvalu" <?php if ($nation == "Tuvalu") echo 'selected="selected"'; ?>>Tuvalu</option>
                                                    <option value="Uganda" <?php if ($nation == "Uganda") echo 'selected="selected"'; ?>>Uganda</option>    
                                                    <option value="Ukraine" <?php if ($nation == "Ukraine") echo 'selected="selected"'; ?>>Ukraine</option>
                                                    <option value="United Arab Emirates" <?php if ($nation == "United Arab Emirates") echo 'selected="selected"'; ?>>United Arab Emirates</option>
                                                    <option value="United Kingdom" <?php if ($nation == "United Kingdom") echo 'selected="selected"'; ?>>United Kingdom</option>
                                                    <option value="United States" <?php if ($nation == "United States") echo 'selected="selected"'; ?>>United States</option>
                                                    <option value="Uruguay" <?php if ($nation == "Uruguay") echo 'selected="selected"'; ?>>Uruguay</option>
                                                    <option value="Uzbekistan" <?php if ($nation == "Uzbekistan") echo 'selected="selected"'; ?>>Uzbekistan</option>
                                                    <option value="Vanuatu" <?php if ($nation == "Vanuatu") echo 'selected="selected"'; ?>>Vanuatu</option>
                                                    <option value="Vatican City" <?php if ($nation == "Vatican City") echo 'selected="selected"'; ?>>Vatican City</option>
                                                    <option value="Venezuela" <?php if ($nation == "Venezuela") echo 'selected="selected"'; ?>>Venezuela</option>
                                                    <option value="Vietnam" <?php if ($nation == "Venezuela") echo 'selected="selected"'; ?>>Vietnam</option>
                                                    <option value="British Virgin Islands" <?php if ($nation == "Venezuela") echo 'selected="selected"'; ?>>British Virgin Islands</option>
                                                    <option value="Isle of Man" <?php if ($nation == "Venezuela") echo 'selected="selected"'; ?>>Isle of Man</option>
                                                    <option value="US Virgin Islands" <?php if ($nation == "US Virgin Islands") echo 'selected="selected"'; ?>>US Virgin Islands</option>
                                                    <option value="Wallis and Futuna" <?php if ($nation == "Wallis and Futuna") echo 'selected="selected"'; ?>>Wallis and Futuna</option>
                                                    <option value="Western Sahara" <?php if ($nation == "Western Sahara") echo 'selected="selected"'; ?>>Western Sahara</option>
                                                    <option value="Yemen" <?php if ($nation == "Yemen") echo 'selected="selected"'; ?>>Yemen</option>
                                                    <option value="Zambia" <?php if ($nation == "Zambia") echo 'selected="selected"'; ?>>Zambia</option>
                                                    <option value="Zimbabwe" <?php if ($nation == "Zimbabwe") echo 'selected="selected"'; ?>>Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Bank Account Number :</label>
                                            <div class="col-lg-8">
                                                <input name="acno" id="acno" class="form-control" value="<?php echo $res['acno']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Bank Name :</label>
                                            <div class="col-lg-8">
                                                <input name="bankname" id="bankname" class="form-control" value="<?php echo $res['bankname']; ?>" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                                <button class="btn btn-success" type="submit">Save Changes</button>
                                                <span></span>
                                                <input class="btn btn-default" value="Cancel" onclick="back()"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end of edit profile panel -->
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript
        ================================================== -->
            <script src="../js/jquery.min.js"></script>  
            <script src="../js/bootstrap.min.js"></script>
            <?php
        }
        ?> 
    </body>
</html>
