<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    } else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
            /* 
Generic Styling, for Desktops/Laptops 
            */
            table { 
                width: 100%; 
                border-collapse: collapse; 
            }
            /* Zebra striping */
            tr:nth-of-type(odd) { 
                background: #eee; 
            }
            th { 
                background: #333; 
                color: white; 
                font-weight: bold; 
            }
            td, th { 
                padding: 6px; 
                border: 1px solid #ccc; 
                text-align: left; 
            }
            /* 
            Max width before this PARTICULAR table gets nasty
            This query will take effect for any screen smaller than 760px
            and also iPads specifically.
            */
            @media 
            only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px)  {

                /* Force table to not be like tables anymore */
                table, thead, tbody, th, td, tr { 
                    display: block; 
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                thead tr { 
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr { border: 1px solid #ccc; }

                td { 
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee; 
                    position: relative;
                    padding-left: 50%; 
                }

                td:before { 
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%; 
                    padding-right: 10px; 
                    white-space: nowrap;
                }

                /*
                Label the data
                td:nth-of-type(1):before { content: "Employee Name"; }
                td:nth-of-type(2):before { content: "IC No"; }
                td:nth-of-type(3):before { content: "Action"; }
                */

            }
            
            .msg {border:1px solid #bbb; padding:5px; margin:10px 0px; background:#eee;}
        </style>
    <body>
        <?php 
        $q = "select staffleaveapproval.*,employeeinformation.employeeid,staffleaveinfo.leavename from staffleaveapproval join employeeinformation
               on staffleaveapproval.employeeid = employeeinformation.employeeid join staffleaveinfo on staffleaveapproval.idleave = staffleaveinfo.idleave
               where employeeinformation.email = '$email' order by staffleaveapproval.dateapplied DESC";
        $rs = mysqli_query($con, $q);
        $numrows = mysqli_num_rows($rs);
        $output = "<h2>Your Leave History</h2><div class='table-responsive'><table class='table table-bordered'>";
        $output .= "<tr><th>Date Applied</th><th>Leave Type</th><th>Start Date</th><th>End Date</th><th>Reason</th><th>Status</th><th>Remarks By</th><th>Date Remarks</th></tr>";
        if ($numrows != 0){
        while ($r = mysqli_fetch_array($rs)) {
            $output .= "<tr><td>".$r['dateapplied']."</td>"
                    ."<td>".$r['leavename']."</td>"
                     ."<td>".$r['startdate']."</td>"
                    ."<td>".$r['enddate']."</td>"
                    ."<td>".$r['reason']."</td>"
                    ."<td>".$r['status']."</td>"
                    ."<td>".$r['remarksby']."</td>"
                    ."<td>".$r['dateremarks']."</td></tr>"; 
        }
        echo $output;
        echo "</table></div>";
        } else {
            echo "You never applied for leave. No records found.";die();
        }
        ?>
    </body>
</html>

