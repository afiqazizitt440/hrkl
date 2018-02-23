<?php
$background = "../images/hr-background.jpg";
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .alert {
                width:30%;    
            }

            .wrapper {    
                margin-top: 80px;
                margin-bottom: 20px;
            }

            .form-signin {
                max-width: 420px;
                padding: 30px 38px 66px;
                margin: 0 auto;
                background-color: #eee;
                border: 3px dotted rgba(0,0,0,0.1);  
            }

            .form-signin-heading {
                text-align:center;
                margin-bottom: 30px;
            }

            .form-control {
                position: relative;
                font-size: 16px;
                height: auto;
                padding: 10px;
            }

            input[type="text"] {
                margin-bottom: 0px;
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
            }

            input[type="password"] {
                margin-bottom: 20px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }

            .colorgraph {
                height: 7px;
                border-top: 0;
                background: #c4e17f;
                border-radius: 5px;
                background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            }
        </style>

        <div class = "container">
            <div class="wrapper">
                <center><img src="../images/human resources.png" class="img img-thumbnail"><br/><br/>
                    <div class="alert alert-danger alert-dismissable"> 
                        <i class="fa fa-exclamation-circle"></i>
                        Invalid credentials.
                    </div>
                    <a href="../index.php"><button class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Login</button></a>
                </center>
            </div>
        </div>
    </body>
    <!-- Bootstrap core JavaScript
================================================== -->
    <script src="../js/jquery.min.js"></script>  
    <script src="../js/bootstrap.min.js"></script>
</html>
