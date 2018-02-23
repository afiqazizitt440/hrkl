<?php
include "../util/connection.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST["email"]))
{
    $output = '';
    $query = "select personalinformation.*,employeeinformation.*,employeefinancial.*,employeeimage.img from personalinformation
join employeeinformation on personalinformation.email = employeeinformation.email
join employeefinancial on employeeinformation.email = employeefinancial.email
join employeeimage on employeefinancial.email = employeeimage.email
where personalinformation.email = '" .$_POST["email"]."'";
    $result = mysqli_query($con, $query);
    $output .= '
    <div class="table-responsive">
            <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
                <tr>    
                <td colspan="4"><center><img src="../Employee/employeepictures/'.$row["img"].'" width="150" height="100" class="img img-responsive img-thumbnail"></center></td>
                </tr>
                <tr>
                <td colspan="4"> 
                Personal Information
                </td>
                </tr>
                <tr>
                <td><label>IC No.</label></td>
                <td >'.$row["icno"].'</td>
                <td><label>Employee Name</label></td>
                <td>'.$row["empname"].'</td>
                </tr>
                <tr>
                <td><label>Gender</label></td>
                <td>'.$row["gender"].'</td>
                <td><label>Religion</label></td>
                <td>'.$row["religion"].'</td>
                </tr>
                <tr>
                <td><label>Marital Status</label></td>
                <td>'.$row["maritalstatus"].'</td>
                <td><label>Email</label></td>
                <td>'.$row["email"].'</td>
                </tr>
                <tr>
                <td><label>Mobile Number</label></td>
                <td>'.$row["telno"].'</td>
                <td><label>Address</label></td>
                <td>'.$row["address"].'</td>
                </tr>
                <tr>
                <td><label>Poscode</label></td>
                <td>'.$row["poscode"].'</td>
                <td><label>State</label></td>
                <td>'.$row["state"].'</td>
                </tr>
                <tr>
                <td><label>Date of Birth</label></td>
                <td>'.$row["dob"].'</td>
                <td><label>Passport No</label></td>
                <td>'.$row["passportno"].'</td>
                </tr>
                <tr>
                <td><label>Nationality</label></td>
                <td>'.$row["nationality"].'</td>
                </tr>
                </table><br/>
                <table class="table table-bordered">
                <tr>
                <td colspan="4">Employment Information</td>
                </tr>
                <tr>
                <td><label>Employee ID</label></td>
                <td>'.$row["employeeid"].'</td>
                <td><label>Job Category</label></td>
                <td>'.$row["jobcategory"].'</td>
                </tr>
                <tr>
                <td><label>Date Join</label></td>
                <td>'.$row["datejoin"].'</td>
                <td><label>Date Resign</label></td>
                <td>'.$row["dateresign"].'</td>
                </tr>
                <tr>
                <td><label>Date Transfer</label></td>
                <td>'.$row["datetransfer"].'</td>
                <td><label>Date Promote</label></td>
                <td>'.$row["datepromote"].'</td>
                </tr>
                <tr>
                <td><label>Employee Working Branch</label></td>
                <td>'.$row["branchid"].'</td>
                <td><label>Other Branches (if available)</label></td>
                <td>'.$row["branchid2"].' - '.$row["branchid3"].' - '.$row["branchid4"].' - '.$row["branchid5"].'</td>
                </tr>
                </table><br/>
                <table class="table table-bordered">
                <tr>
                <td colspan="4">Compensation</td>
                </tr>
                <tr>
                <td><label>Bank Account No.</label></td>
                <td>'.$row["acno"].'</td>
                <td><label>Bank Name</label></td>
                <td>'.$row["bankname"].'</td>
                </tr>
                <tr>
                <td><label>EPF No.</label></td>
                <td>'.$row["epfno"].'</td>
                <td><label>SOCSO No.</label></td>
                <td>'.$row["socsono"].'</td>
                </tr>
                <tr>
                <td><label>Tax No.</label></td>
                <td>'.$row["taxno"].'</td>
                </tr>
                ';          
    }
    $output .= '
            </table>
            </div>
            ';
    echo $output;
} else {
       header("Location: admin.php");
}
?>