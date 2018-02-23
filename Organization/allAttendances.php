<?php

error_reporting(0);
@ini_set('display_errors', 0);
include "../util/connection.php";
session_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    if ($_POST["branch"] != null || $_POST["month"] != null || $_POST["year"] != null) {
        $branchid = mysqli_real_escape_string($con, $_POST["branch"]);
        $month = mysqli_real_escape_string($con, $_POST["month"]);
        $year = mysqli_real_escape_string($con, $_POST["year"]);
        echo "<h2>Attendance Report Summary : ".$branchid."</h2>";
        switch ($month) {
        case 1: $monthString = "January";
            break;
        case 2: $monthString = "February";
            break;
        case 3: $monthString = "March";
            break;
        case 4: $monthString = "April";
            break;
        case 5: $monthString = "May";
            break;
        case 6: $monthString = "June";
            break;
        case 7: $monthString = "July";
            break;
        case 8: $monthString = "August";
            break;
        case 9: $monthString = "September";
            break;
        case 10: $monthString = "October";
            break;
        case 11: $monthString = "November";
            break;
        case 12: $monthString = "December";
            break;
        default: $monthString = "Invalid month";
            break;
        }
        echo "<h4>".$monthString." ".$year."</h4>";
        /* $query1 = "select email from employeeinformation where branchid='$branchid' or branchid2='$branchid' or branchid3='$branchid' or branchid4='$branchid' or branchid5='$branchid'";
          $result1 = mysqli_query($con, $query1); */

        /* while ($row1 = mysqli_fetch_array($result1)) {
          $temp = $row1['email'];
          $query2 = "select userprofile.*,personalinformation.empname,employeeinformation.*,attendancerecord.* from userprofile join personalinformation on userprofile.email = personalinformation.email
          join employeeinformation on personalinformation.email = employeeinformation.email join attendancerecord on employeeinformation.email = attendancerecord.email where
          (userprofile.email = '$temp' and year(attendancerecord.attendancedate)='$year' and month(attendancerecord.attendancedate)='$month') order by attendancerecord.attendancedate asc"; */

        $q = "select * from userprofile join personalinformation on userprofile.email = personalinformation.email join employeeinformation on personalinformation.email = employeeinformation.email where 
            (employeeinformation.branchid = '$branchid' or employeeinformation.branchid2 = '$branchid' or employeeinformation.branchid3 = '$branchid' or employeeinformation.branchid4 = '$branchid' or employeeinformation.branchid5 = '$branchid' ) 
             and employeeinformation.email in (SELECT email FROM employeeinformation GROUP BY email HAVING COUNT(email)=1)";
        //var_dump($q);die();
        /* $result2 = mysqli_query($con, $query2);
          while ($row2 = mysqli_fetch_array($result2)) {
          echo "Employee name : '".$row2['empname']."'";
          if (mysqli_num_rows($result2) !== 0) {
          echo '<td>' . $row2["attendancedate"] . '</td>
          <tr><td>' . $row2["timein"] . '</td></tr>
          <tr><td>' . $row2["timeout"] . '</td></tr>
          <tr><td>' . $row2["totalhours"] . '</td></tr>
          <td>' . $row2["totalmins"] . '</td>';
          echo '</tr>';
          } else {
          echo '<center>No records found.</center>';
          die();
          }
          echo "</table>";
          } */

        $result = mysqli_query($con, $q);

        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                //check the number of days in the $month
                $noofdays = date("t", mktime(0, 0, 0, $month, 1, $year));
                //display the employee name and id
                echo "<br/>Employee Name : " . $row['empname'] . "<br/>Employee ID : " . $row['employeeid'] . "<br/><table class='table-responsive' style='padding-bottom:10px;'><tr><td>Date</td>";


                //date loop
                for ($i = 1; $i <= $noofdays; $i++) {
                    echo "<td><center>" . $i . "</center></td>";
                }
                echo "</tr><tr><td>Time In</td>";
                for ($j = 1; $j <= $noofdays; $j++) {
                    /* $query = "select userprofile.*,personalinformation.empname,employeeinformation.*,attendancerecord.*,date_format(attendancerecord.attendancedate, '%Y, %c, %e') as attdate
                      from userprofile join personalinformation on userprofile.email = personalinformation.email
                      join employeeinformation on personalinformation.email = employeeinformation.email join attendancerecord on employeeinformation.email = attendancerecord.email where
                      (userprofile.email = '" . $row['email'] . "' and year(attendancerecord.attendancedate)='$year' and month(attendancerecord.attendancedate)='$month')order by attendancerecord.attendancedate asc;"; */
                    $query = "select * ,date_format(attendancedate, '%Y, %c, %e') as attdate from attendancerecord where
                            (email = '" . $row["email"] . "' and year(attendancedate)='$year' and month(attendancedate)='$month' AND DAY( attendancedate ) =  '$j')";

                    if (!($rs = mysqli_query($con, $query))) {
                        $dayatt = "";
                    } else {
                        $rs = mysqli_query($con, $query);
                        $r = mysqli_fetch_array($rs);

                        $date = explode(",", $r['attdate']);
                        $dayti = $date[2];
                    }
                    /*
                      $getday = date("j", mktime(0, 0, 0, $month, $day, $year));
                     */
                    //echo $j;
                    if ($j != $dayti) {
                        echo "<td></td>";
                    } else {
                        $time1 = explode(":", $r["timein"]);
                        $timeinh = $time1[0];
                        $timeinm = $time1[1];
                        echo "<td>" . $timeinh . ":" . $timeinm . "</td>";
                    }
                }
                echo "</tr><tr><td>Time Out</td>";
                for ($k = 1; $k <= $noofdays; $k++) {
                    /* $query = "select userprofile.*,personalinformation.empname,employeeinformation.*,attendancerecord.*,date_format(attendancerecord.attendancedate, '%Y, %c, %e') as attdate
                      from userprofile join personalinformation on userprofile.email = personalinformation.email
                      join employeeinformation on personalinformation.email = employeeinformation.email join attendancerecord on employeeinformation.email = attendancerecord.email where
                      (userprofile.email = '" . $row['email'] . "' and year(attendancerecord.attendancedate)='$year' and month(attendancerecord.attendancedate)='$month')order by attendancerecord.attendancedate asc;"; */
                    $query2 = "select * ,date_format(attendancedate, '%Y, %c, %e') as attdate from attendancerecord where
                            (email = '" . $row["email"] . "' and year(attendancedate)='$year' and month(attendancedate)='$month' AND DAY( attendancedate ) =  '" . $k . "')";

                    if (!($rs2 = mysqli_query($con, $query2))) {
                        $dayatt2 = "";
                    } else {
                        $rs2 = mysqli_query($con, $query2);
                        $r2 = mysqli_fetch_array($rs2);

                        $date2 = explode(",", $r2['attdate']);
                        $dayto = $date2[2];
                    }

                    /*
                      $getday = date("j", mktime(0, 0, 0, $month, $day, $year));
                     */
                    //echo $j;
                    if ($k != $dayto) {
                        echo "<td></td>";
                    } else {
                        $time2 = explode(":", $r2["timeout"]);
                        $timeouth = $time2[0];
                        $timeoutm = $time2[1];
                        echo "<td>" . $timeouth . ":" . $timeoutm . "</td>";
                    }
                }

                echo "</tr></table>";
            }
        } else {
            echo '<br/>No records found. Please make sure to select all the dropdown given.<br/><br/><br/>';
            die();
        }
    } else {
        echo '<br/>No records found. Please make sure to select all the dropdown given.<br/><br/><br/>';
        die();
        //} */
    }
    echo "<br>";
} else {
    header("Location: admin.php");
}
?>