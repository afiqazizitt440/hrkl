<?php
include "../util/connection.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST["branchid"]))
{
    $output = '';
    $query = "select * from branch where branchid='" .$_POST["branchid"]."'";
    $result = mysqli_query($con, $query);
    $output .= '
    <div class="table-responsive">
            <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
                <tr>
                <td width="30%"><label>Branch ID</label></td>
                <td width="70%">'.$row["branchid"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Address</label></td>
                <td width="70%">'.$row["branchlocation"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Latitude</label></td>
                <td width="70%">'.$row["gmaplat"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Longitude</label></td>
                <td width="70%">'.$row["gmaplng"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>State</label></td>
                <td width="70%">'.$row["state"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>Operating Hours (24H)</label></td>
                <td width="50%">'.$row["openhours"].' - '.$row["closehours"].'</td>
                </tr>
                <tr>
                <td width="30%"><label>IP Address</label></td>
                <td width="70%">'.$row["staticip"].'</td>
                </tr>
                ';          
    }
    $output .= '
            </table>
            </div>
            ';
    echo $output;
}else{
    header("Location: admin.php");
}

?>
