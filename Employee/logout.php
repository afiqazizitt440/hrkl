<?php
session_start();
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
        <title>HR Management System</title>
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" /> 
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
        </style>
    </head>
    <body>
        <?php
// remove all session variables
        session_unset();

// destroy the session 
        session_destroy();
        ?>
        <div id="regContainer" class="container">
            <center><img src="../images/human resources.png" class="img img-thumbnail"></center><br/>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="alert alert-success alert-dismissable"> 
                        <i class="fa fa-check-square"></i>
                        Successfully Logged Out
                    </div>
                    <center><a href="../index.php"><button class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Back to Login Page</button></a></center>
                </div>
            </div>
        </div>
        <br/><a href="#"><p align="center" class="link">Privacy & Policy</p></a>


        <!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
