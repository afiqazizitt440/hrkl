<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentdate = date("Y-m-d");
    $currenttime = date("g:i A");
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
    </head>
    <script type="text/javascript">
        $(document).ready(function () {
        $(document).on('click', '.view_data', function () { //start of view employee data modal
            var idapproval = $(this).attr("id");
            var idleave = $('idleave').val();
            if (idapproval != '')
            {
                $.ajax({
                    url: 'selectDetail.php',
                    method: 'post',
                    data: {idapproval: idapproval,
                           idleave: idleave 
                },
                    success: function (data) {
                        $('#approvalDetail').html(data);
                        //$('#viewDetails').modal("show");
                    }
                });
            }
        });// end of view employee data modal
    });
    </script>
    <body>
        <?php
        $que = "select staffleaveapproval.*,employeeinformation.employeeid,employeeinformation.email,staffleaveinfo.leavename from staffleaveapproval join employeeinformation
               on staffleaveapproval.employeeid = employeeinformation.employeeid join staffleaveinfo on staffleaveapproval.idleave = staffleaveinfo.idleave
               where staffleaveapproval.status = 'Pending' order by staffleaveapproval.dateapplied desc";
        $rss = mysqli_query($con, $que);
        $nrows = mysqli_num_rows($rss);
        $output = "<h2>Leave Approval</h2><div class='table-responsive'><table class='table table-bordered'>";
        $output .= "<tr><th>Date Applied</th><th>Employee ID</th><th>Leave Type</th><th>Action</th></tr>";
        if ($nrows != 0) {
            while ($r = mysqli_fetch_array($rss)) {
                $app = strtotime($r['dateapplied']);
                $date = date('Y-m-d', $app);
                $output .= "<tr><td>" . $date . "</td>"
                        . "<td>" . $r['employeeid'] . "</td>"
                        . "<td>" . $r['leavename'] . "</td>"
                        . "<td><button type='button' name='view' id='".$r['idapproval']."' title='Details' class='view_data btn btn-xs btn-info' data-toggle='modal' data-target='#viewDetails'><span class='glyphicon glyphicon-menu-hamburger'></span> View Details</button></td></tr>";
            }
            echo $output;
            echo "</table></div>";
        } else {
            echo "No leave to be approve.";
            die();
        }
        ?>
        <!-- Modal Employee Details -->
        <div id="viewDetails" class="modal fade">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Details</h4>
                    </div>
                    <div class="modal-body" id="approvalDetail">
                        <center><div class="loader"></div></center>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

