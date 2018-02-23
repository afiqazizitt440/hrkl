<?php
include "../util/connection.php";
//set where you want to store files
//in this example we keep file in folder upload 
//$HTTP_POST_FILES['ufile']['name']; = upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    if (isset($_POST["bt-submit"])) {
        $target_dir = "../Employee/employeepictures/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], "../Employee/employeepictures/" . $_FILES['image']['name']);
       
        $con = mysqli_connect("localhost", "root", "", "klezcar_hr");
        $query = "update employeeimage set img = '" . $_FILES['image']['name'] . "' where email='$email'";
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $uploadOk = 0;
            echo "<script type='text/javascript'>alert('Your file is too large.');
              window.location.href='EditInformation.php';
              </script>";
        } else {
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } else {
                // Allow certain file formats
                if (mysqli_query($con, $query)) {
                    echo "<script type='text/javascript'>alert('Successfully uploaded.');
              window.location.href='EditInformation.php';
              </script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error while uploading.');
              window.location.href='EditInformation.php';
              </script>";
                }
            }
        }
    }else {
       header("Location: admin.php");
    }
} else {
    header("Location: admin.php");
}
?>