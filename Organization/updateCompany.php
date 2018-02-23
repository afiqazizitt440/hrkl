<?php
include "../util/connection.php";
if(!empty($_POST)){
    $idcom = mysqli_real_escape_string($con, $_POST["idcom"]);
    $comname = mysqli_real_escape_string($con, $_POST["comname"]);
    $regno = mysqli_real_escape_string($con, $_POST["regno"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);
    
    $query = "UPDATE company SET comname='$comname',regno='$regno',location='$location' WHERE idcom='$idcom';";
    
    //message for user 
    $message = "Updated successfully.";
    $errormsg = "Error while Error while updating";
    if (mysqli_query($con, $query)) {
        echo "<script type='text/javascript'>alert('$message');
            
              window.location.href='CompanySettings.php?idcom=$idcom';
              </script>";
    }else{
        echo "<script type='text/javascript'>alert('$errormsg');
              window.location.href='CompanySettings.php?idcom=$idcom';
              </script>";
    }
    mysqli_close($con);
}else {
      header("Location: admin.php");
}
?>
