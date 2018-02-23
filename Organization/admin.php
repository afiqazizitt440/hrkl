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
        <title>HR Management System</title>
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <script src="../js/jquery.min.js"></script>   
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            a:link
            {
                color:#FFFFFF;
            }

            a:visited
            {
                color:#FFFFFF;
            }

            a:hover 
            {
                color:#FFFFFF;
            }

            #regContainer{
                margin-top: 3%;  
            }

            .panel-login {
                border-color: #ccc;
                background-color: #f9f8f8;
                -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
                -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
                box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            }
            .panel-login>.panel-heading {
                text-align:center;
            }
            .panel-login>.panel-heading a{
                text-decoration: none;
                font-weight: bold;
                font-size: 28px;
                -webkit-transition: all 0.1s linear;
                -moz-transition: all 0.1s linear;
                transition: all 0.1s linear;
            }
            .panel-login>.panel-heading a.active{
                font-size: 34px;
            }
            .panel-login>.panel-heading hr{
                margin-top: 10px;
                margin-bottom: 0px;
                clear: both;
                border: 0;
                height: 1px;
                background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
                background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
                background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
                background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            }
            .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
                height: 45px;
                border: 1px solid #ddd;
                font-size: 16px;
                -webkit-transition: all 0.1s linear;
                -moz-transition: all 0.1s linear;
                transition: all 0.1s linear;
            }
            .panel-login input:hover,
            .panel-login input:focus {
                outline:none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
                border-color: #ccc;
            }
            .btn-login {
                background-color:#3D9DB3;
                outline: none;
                color: #fff;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #2d92a9;
            }
            .btn-login:hover,
            .btn-login:focus {
                color: #fff;
                background-color: #198da8;
                border-color: #53A3CD;
            }
            .btn-register {
                background-color: #17ae47;
                outline: none;
                color: #fff;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #1CB94A;
            }
            .btn-register:hover,
            .btn-register:focus {
                color: #fff;
                background-color: #1CA347;
                border-color: #1CA347;
            }
            .panel-heading a{
                font-size: 48px;
                color: rgb(6, 106, 117);
                padding: 2px 0 10px 0;
                font-weight: bold;
                text-align: center;
                padding-bottom: 30px;
            }

            .panel-heading a{
                background: -webkit-repeating-linear-gradient(-45deg, 
                    rgb(18, 83, 93) , 
                    rgb(18, 83, 93) 20px, 
                    rgb(64, 111, 118) 20px, 
                    rgb(64, 111, 118) 40px, 
                    rgb(18, 83, 93) 40px);
                -webkit-text-fill-color: transparent;
                -webkit-background-clip: text;
            }

            [data-tip] {
                position:relative;

            }
            [data-tip]:before {
                content:'';
                /* hides the tooltip when not hovered */
                display:none;
                content:'';
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-bottom: 5px solid #1a1a1a;	
                position:absolute;
                top:30px;
                left:350px;
                z-index:8;
                font-size:0;
                line-height:0;
                width:0;
                height:0;
            }
            [data-tip]:after {
                display:none;
                content:attr(data-tip);
                position:absolute;
                top:35px;
                left:0px;
                padding:5px 5px;
                background:#1a1a1a;
                color:#fff;
                z-index:9;
                font-size: 0.9em;
                height:25px;
                line-height:18px;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                white-space:nowrap;
                word-wrap:normal;
            }
            [data-tip]:hover:before,
            [data-tip]:hover:after {
                display:block;
            }
        </style>
        <script>
            $(function () {

                $('#login-form-link').click(function (e) {
                    $("#login-form").delay(100).fadeIn(100);
                    $("#register-form").fadeOut(100);
                    $('#register-form-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });
                $('#register-form-link').click(function (e) {
                    $("#register-form").delay(100).fadeIn(100);
                    $("#login-form").fadeOut(100);
                    $('#login-form-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });

            });

        </script>
    </head>
    <div id="regContainer" class="container">
        <center><img src="../images/human resources.png" class="img img-thumbnail"></center><br/>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--Start of login form-->
                                <form id="login-form" action="validationadmin.php" method="post" style="display: block;">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email_" id="email_" class="form-control" placeholder="Email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="pass_" id="pass_" class="form-control" placeholder="Password"/>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" class="form-control btn btn-login" value="Login">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Start of register form-->
                                <form id="register-form" action="createCompany.php" method="post" role="form" style="display: none;">
                                    <p class="text-center">Register here if you are the HR/owner of the company.</p>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="empname" id="empname" class="form-control" placeholder="Full Name"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="icno" id="icno" class="form-control" placeholder="NRIC"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Create Password"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="telno" id="telno"  class="form-control" placeholder="Tel. No."/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="label" align="center"><br/></label>
                                        <div data-tip="Note that this is a unique ID and cannot be change after registered">
                                            <div class="col-sm-12">
                                                <input type="text" name="idcom" id="idcom"  class="form-control" placeholder="Create a unique ID for your company">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="comname" id="comname"  class="form-control" placeholder="Company Name"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="regno" id="regno" class="form-control" placeholder="Company Registration Number"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <select name="location" id="location" class="form-control">
                                                <option value="">Select the Headquarters location</option>
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" class="form-control btn btn-register" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#"><p align="center" class="link">Privacy & Policy</p></a>

    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
