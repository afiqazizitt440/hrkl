<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    if (isset($_POST["pass"])) {
        $pass = mysqli_real_escape_string($con, $_POST["pass"]);
        $checkpass = mysqli_real_escape_string($con, $_POST["checkpass"]);
        $query = "select * from admin_org where email='$email'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            if ($pass === $row["pass"]) {
                $query2 = "update admin_org set pass='$checkpass' where email='$email'";
                if (mysqli_query($con, $query2)) {
                    echo "<script type='text/javascript'>alert('Successfully changed the password.');
              window.location.href='ChangePassword.php';
              </script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error while changing the password.');
              window.location.href='ChangePassword.php';
              </script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Invalid Current Password.');
              window.location.href='ChangePassword.php';
              </script>";
            }
        }
    } else {
       header("Location: admin.php");
    }
} else {
    header("Location: admin.php");
}
?>