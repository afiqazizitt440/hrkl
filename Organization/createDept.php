<?php
include "../util/connection.php";
if (!empty($_POST)) {
    $output = '';
    $dept_id = mysqli_real_escape_string($con, $_POST["dept_id"]);
    $dept_name = mysqli_real_escape_string($con, $_POST["dept_name"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $branchid = mysqli_real_escape_string($con, $_POST["branchid"]);
    $idcom = mysqli_real_escape_string($con, $_POST["idcom"]);

    $query = "insert into dept(deptid,deptname,description,branchid,idcom) 
            values('$dept_id', '$dept_name', '$description', '$branchid', '$idcom')";

    if (mysqli_query($con, $query)) {
        $select_query = "select * from dept";
        $result = mysqli_query($con, $select_query);
        $output .= '
                <center><div class="loader"></div><br/>
                <style>
.loader {
  border: 8px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid #CD5C5C;
  width: 70px;
  height: 70px;
  -webkit-animation: spin 0.75s linear infinite;
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
                ';
    }
    echo $output;
} else {
       echo "<script type='text/javascript'>alert('Undefined Index');
              window.location.href='admin.php';
              </script>";
}
?>
