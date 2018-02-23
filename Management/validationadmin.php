<?php
include "../util/connection.php";
// Grab User submitted information
$username = $_POST["username_"];
$pass = $_POST["pass_"];

// Make sure we connected successfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysql_select_db("klezcar_hr",$con);

$result = mysql_query("SELECT * FROM admin WHERE username = '$username'");

$row = mysql_fetch_array($result);

if($row["username"]==$username && $row["pass"]==$pass){
    header('Location: CompList.php');
}    
else
    header('Location: errorAdmin.php');
?>