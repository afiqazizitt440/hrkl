<?php
include "../util/connection.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST["deptid"]))
{
    $output = '';
    $query = "select * from dept where deptid='" .$_POST["deptid"]."'";
    $result = mysqli_query($con, $query);
    $output .= '
    <div class="table-responsive">
            <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
                <tr>
                <td width="30%"><label>Department ID</label></td>
                <td width="70%">'.$row["deptid"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Department Name</label></td>
                <td width="70%">'.$row["deptname"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Description</label></td>
                <td width="70%">'.$row["description"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Branch</label></td>
                <td width="70%">'.$row["branchid"].'</td>
                </tr>
                ';          
    }
    $output .= '
            </table>
            </div>
            ';
    echo $output;
}else {
       header("Location: admin.php");
}
?>
