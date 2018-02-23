<?php

include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date("Y-m-d");
    $currenttime = date("g:i A");
    if (isset($_POST["bt-submit"])) {
        //get the employee id of the user....
     
        $query = "select employeeid from employeeinformation where email='$email'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $employeeid = $row['employeeid'];

        //retrieve the leave info that the user applied...
        $idleave = mysqli_real_escape_string($con, $_POST['idleave']);
        $query2 = "select * from staffleaveinfo where idleave = '$idleave'";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_array($result2);

        //put the retrieved info into variables....
        $leavename = $row2['leavename'];
        $leavedescription = $row2['leavedescription'];
        $entitlement = $row2['entitlement'];
        $enttype = $row2['enttype'];

        //retrieve the information from the form....
        $dateapplied = $currentdate;
        $startdate = mysqli_real_escape_string($con, $_POST['startdate']);
        $enddate = mysqli_real_escape_string($con, $_POST['enddate']);
        $noofdays = mysqli_real_escape_string($con, $_POST['noofdays']);
        $reason = mysqli_real_escape_string($con, $_POST['reason']);
        
        //explode() both dates
        /*$d1 = explode("-",$startdate);
        $d2 = explode("-",$currentdate);
        
        //convert both dates to epoch
        $condate = strtotime($startdate);
        $formdate = strtotime($currentdate);
        
        //calculate the number of days
        $days = ($condate - $formdate);
        $checkdays = $days / 86400;
        $submitdue = 3; //due days for submitting form
        if ($checkdays < $submitdue) {
            echo "<script type='text/javascript'>alert('Your leave application form must be submit ".$submitdue." days before the start date.');
              window.history.back();
              </script>";
        } else {*/  
        $name = $_FILES['attachments']['name'];
        $size = $_FILES['attachments']['size'];
        $type = $_FILES['attachments']['type'];
        $temp = $_FILES['attachments']['tmp_name'];
        move_uploaded_file($temp, "leaveattachments/" . $name);
        //insert the information about the applied leave into db...
        $query3 = "insert into staffleaveapproval(employeeid,idleave,dateapplied,startdate,enddate,noofdays,reason,attachments,status) 
            values('$employeeid', '$idleave', '$dateapplied','$startdate','$enddate', '$noofdays', '$reason', '$name', 'Pending')";
        if (mysqli_query($con, $query3) == true) {
            //upload attachments part....
            /* if ($_FILES['attachments']['error'] !== UPLOAD_ERR_OK) {
              die("Error while uploading file with error " . $_FILES['file']['error']);
              }
              $finfo = finfo_open(FILEINFO_MIME_TYPE);
              $mime = finfo_file($finfo, $_FILES['attachments']['tmp_name']);
              $ok = false;
              switch ($mime) {
              case 'image/jpeg';
              case 'application/pdf';
              $ok = true;
              default:
              die("Only PDF is allowed..!");
              }
             */
            // Check file size
            // Allow certain file formats
            /* if ($file_type != "application/pdf" || $file_type != "application/doc") {
              $query6 = "delete from staffleaveapproval where idapproval='$temp'";
              $result6 = mysqli_query($con, $query6);
              echo "Sorry, only DOC/PDF files are allowed.";
              $uploadOk = 0;
              } else {
              // Allow certain file formats
              if ($con->multi_query($query5)) {
              echo "<script type='text/javascript'>alert('Successfully Submitted.');
              window.location.href='Leave.php';
              </script>";
              } else {
              echo "<script type='text/javascript'>alert('Error while uploading document.');
              window.location.href='Leave.php';
              </script>";
              }
              } */
            echo "<script type='text/javascript'>alert('Leave Application Form Successfully Submitted.');
              window.location.href='Leave.php';
              </script>";
        } else {
            echo "<script type='text/javascript'>alert('Error while submitting application..!');
              window.location.href='Leave.php';
              </script>";
        }
        }
    }
//}
?>