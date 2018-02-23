<?php
include "../util/connection.php";
session_start();
// Grab User submitted information
$email = $_POST["email_"];
$pass = $_POST["pass_"];

$query = "SELECT * FROM userprofile WHERE email = '$email'";
$result = mysqli_query($con, $query);

//fetch from conditon table
$querycond = "SELECT access_cond FROM user_condition WHERE email = '$email'";
$resultcond = mysqli_query($con, $querycond);

while ($res = mysqli_fetch_array($result)) 
{
    if ($res["email"] == $email && $res["pass"] == $pass) 
    {
                  $result2 = mysqli_query($con, "select userprofile.email,userprofile.idcom, personalinformation.empname from userprofile join personalinformation on userprofile.email = personalinformation.email where userprofile.email = '$email'");

                  $row2 = mysqli_fetch_array($result2);
                  $_SESSION["email"] = $email;
                  $_SESSION["idcom"] = $row2["idcom"];
                  $_SESSION["empname"] = $row2["empname"];

                  if($resultcond == 0)
                  {
                    echo "<br/><br/><br/><center><div class='loader'></div><br/>
                            <style>
                          .loader {
                            border: 8px solid #f3f3f3;
                            border-radius: 50%;
                            border-top: 8px solid #ff9999;
                            width: 70px;
                            height: 70px;
                            -webkit-animation: spin 1.5s linear infinite;
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
                          </center><br/>
                                      <script type='text/javascript'>
                                        window.location.href='employeeProfile.php';
                                        </script>";
                  }
                  else
                  {
                    echo "<br/><br/><br/><center><div class='loader'></div><br/>
                            <style>
                          .loader {
                            border: 8px solid #f3f3f3;
                            border-radius: 50%;
                            border-top: 8px solid #ff9999;
                            width: 70px;
                            height: 70px;
                            -webkit-animation: spin 1.5s linear infinite;
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
                          </center><br/>
                                      <script type='text/javascript'>
                                        window.location.href='employeeProfileAdmin.php';
                                        </script>";
                  }
    } 
}
echo "<br/><br/><br/><center>Please wait...
</style>
</center><br/>
            <script type='text/javascript'>
              window.location.href='errorLogin.php';
              </script>";
?>

