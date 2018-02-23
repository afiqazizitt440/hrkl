<?php
session_start();
include "../util/connection.php";
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date("Y-m-d");
    $currenttime = date("g:i A");
} else {
    header("Location: ../index.php");
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
        <title>Password Panel</title>
        <script>

            /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                button.style.visibility = hidden;
            }

            /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }

            function CheckPassword(inputtxt)
            {
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                if (inputtxt.value.match(passw))
                {
                    return true;
                } else
                {
                    alert('Password must contain at least one numeric digit, one uppercase, and one lowercase letter.')
                    return false;
                }
            }

            $(function () {
                $(".katalaluan").keyup(function () {
                    var PasswordVal = $('.newpass').val();
                    var ConfirmPasswordVal = $('.checkpass').val();
                    if (PasswordVal != ConfirmPasswordVal && ConfirmPasswordVal.length > 0 && PasswordVal.length > 0) {
                        $('.ShowPasswordNotMatchesError').show();
                        $('#bt-submit').attr('disabled', true);
                        this.submit();
                    } else {
                        $('.ShowPasswordNotMatchesError').hide();
                        $('#bt-submit').attr('disabled', false);
                        this.submit();
                    }
                });
            });
        </script>
        <style type="text/css">

            .required:after {
                color: red;
                content: ' *';
            }
        </style>
    </head>
    <?php include "navbar.php";?>

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand">Employee Password Changer</span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
            <!-- welcome content -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading panel-warning"></div>
                    <div class="panel-body">
                        <table align="center" class="table table-responsive">
                            <form id="change" name="change" accept-charset="UTF-8" action="validationForm.php" method="post">
                                <div class="alert alert-danger alert-dismissable alert-xs ShowPasswordNotMatchesError" style="display:none;">
                                    <i class="fa fa-exclamation-circle"></i>
                                    New Password and Re-type Password field must be<strong> same.</strong>
                                </div>
                                <tr>
                                    <td><label class="required">Current Password</label></td><td><input name="pass" id="pass" placeholder="Current Password" type="password" required></td>
                                </tr>
                                <tr>
                                    <td><label class="required">New Password</label></td><td><input name="newpass" id="newpass" placeholder="New Password" type="password" class="katalaluan newpass" required></td>
                                <tr>
                                    <td><label class="required">Re-type Password</label></td><td><input name="checkpass" id="checkpass" placeholder="Re-Type Password" type="password" class="katalaluan checkpass" onkeyup="" required></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-warning" id="bt-submit" value="Change Password" onclick="return CheckPassword(document.change.newpass)"/></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="../js/jquery.min.js"></script>  
    <script src="../js/bootstrap.min.js"></script>
    <?php
    //}
    ?> 
</body>
</html>
