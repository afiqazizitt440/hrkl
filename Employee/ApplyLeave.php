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
        <title></title>
    </head>
    <body>
        <style>
            /* Reset Select */
            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                -ms-appearance: none;
                appearance: none;
                outline: 0;
                box-shadow: none;
                border: 0 !important;
                background: #2c3e50;
                background-image: none;
            }
            /* Custom Select */
            .select {
                position: relative;
                display: inline-block;
                width: 20em;
                height: 3em;
                line-height: 3;
                background: #2c3e50;
                overflow: hidden;
                border-radius: .25em;
            }
            select {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0 0 0 .5em;
                color: #fff;
                cursor: pointer;
            }
            select::-ms-expand {
                display: none;
            }
            /* Arrow */
            .select::after {
                content: '\25BC';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                padding: 0 1em;
                background: #34495e;
                pointer-events: none;
            }
            /* Transition */
            .select:hover::after {
                color: #f39c12;
            }
            .select::after {
                -webkit-transition: .25s all ease;
                -o-transition: .25s all ease;
                transition: .25s all ease;
            }

        </style>
        <script>
            /*$("#bt-submit").click(function (event) {
             event.preventDefault();
             var branch = $("#branch").val();
             var month = $("#month").val();
             var year = $("#year").val();
             if (branch == "")
             {
             alert("Branch is required..!");
             } else if (month == "")
             {
             alert("Month is required..!");
             } else if (year == "")
             {
             alert("Year is required..!");
             }
             $.ajax({
             type: "POST",
             url: "allAttendances.php",
             data: {
             branch: branch,
             month: month,
             year: year
             },
             beforeSend: function () {
             $('#bt-submit').val("Please Wait..");
             $('#bt-submit').attr("disabled", true);
             },
             success: function (dta)
             {
             $('#displayAttendance').html(dta);
             $('#bt-submit').val("Generate Attendance Report");
             $('#bt-submit').attr("disabled", false);
             }
             
             });
             });*/
            //retrieve from displayEntitlement
            function showEntitlement(str) {
                if (str == "") {
                    document.getElementById("leaveoutput").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("leaveoutput").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getEntitlement.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
            //end of display entitlement

            //start of calculate no of days
            function calculate() {
                //get both dates
                var start = document.getElementById("startdate").value;
                var end = document.getElementById("enddate").value;
                //split() both dates
                var d1 = start.split("-");
                var d2 = end.split("-");

                //convert both dates to epoch
                var from = new Date(d1[0], d1[1], d1[2]);
                var to = new Date(d2[0], d2[1], d2[2]);

                //calculate the number of days
                var days = (to - from);
                var noofdays = ((days / 86400) / 1000) + 1;
                if (noofdays > 0) {
                    document.getElementById("noofdays").value = noofdays;
                } else {
                    document.getElementById("noofdays").value = "";
                    alert("Invalid date period!");
                }
            }

            function nonull() {
                var idleave = document.getElementById("idleave").value; //type of leave..
                var startdate = document.getElementById("startdate").value; //start date of the leave....
                var enddate = document.getElementById("enddate").value; //end date of the leave...
                var noofdays = document.getElementById("noofdays").value; //number of days of the leave....
                var reason = document.getElementById("reason").value; //reason of the leave....
                var attachments = document.getElementById("attachments").value; //additional attachments for leave....

                if (idleave == "" || idleave == null) {
                    alert("Please Select Leave Type..!");
                    return false;
                } else if (startdate == "" || startdate == null) {
                    alert("Start Date is required..!");
                    return false;
                } else if (enddate == "" || enddate == null) {
                    alert("End Date is required..!");
                    return false;
                } else if (noofdays == "" || noofdays == null) {
                    alert("Pleas enter a valid date..!");
                    return false;
                } else if (reason == "" || reason == null) {
                    alert("Reason is required..!");
                    return false;
                } else if (attachments == "" || attachments == null) {
                    alert("Please upload a valid file as it is required..!");
                    return false;
                }
            }
            
        </script>
        <fieldset>
            <legend>Leave Application Form</legend>
            <form method="post" action="leaveForm.php" enctype="multipart/form-data">    
                <div class="select">
                    <select name="idleave" id="idleave" onchange="showEntitlement(this.value)">
                        <option value=''>--Select Leave Type--</option>
<?php
$query = "select * from staffleaveinfo";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    echo '<option value="' . $row['idleave'] . '">' . $row['leavename'] . '</option>';
}
?>
                    </select></div><div id="leaveoutput"></div><br/>
                <label>Start Date</label><input type="date" name="startdate" id="startdate" class="form-control"/><br/>
                <label>End Date</label><input type="date" name="enddate" id="enddate" onchange="calculate()" class="form-control"/><br/>
                <label># of Days/Hours</label><input type="text" name="noofdays" id="noofdays" class="form-control" readonly/><br/>
                <label>Reason</label><input type="text" name="reason" id="reason" class="form-control"/><br/>
                <label>Supporting Attachments</label><input type="file" name="attachments" id="attachments" class="form-control"/><br/>
                <input type="submit" name="bt-submit" id="bt-submit" value="Submit Leave Application" class="btn btn-info" onclick="return nonull();"/>
            </form>
        </fieldset>
        <br/>

    </body>
</html>
