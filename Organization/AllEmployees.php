<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    $query = "select branchid from branch where idcom='$idcom'";
    $result = mysqli_query($con, $query);
} else {
    header("Location: admin.php");
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
            $("#bt-submit").click(function (event) {
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
            });
            
            $("#bt-otsubmit").click(function (event) {
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
                    url: "allOvertime.php",
                    data: {
                        branch: branch,
                        month: month,
                        year: year
                    },
                    beforeSend: function () {
                        $('#bt-otsubmit').val("Please Wait..");
                        $('#bt-otsubmit').attr("disabled", true);
                    },
                    success: function (dta)
                    {
                        $('#displayAttendance').html(dta);
                        $('#bt-otsubmit').val("Generate Overtime Report");
                        $('#bt-otsubmit').attr("disabled", false);
                    }

                });
            });
        </script>
        <div class="select">
            <select name="branch" id="branch">
                <option value=''>--Select Branch--</option>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['branchid'] . '">' . $row['branchid'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="select">
            <select name="month" id="month">
                <option value=''>--Select Month--</option>
                <option value='1'>January</option>
                <option value='2'>February</option>
                <option value='3'>March</option>
                <option value='4'>April</option>
                <option value='5'>May</option>
                <option value='6'>June</option>
                <option value='7'>July</option>
                <option value='8'>August</option>
                <option value='9'>September</option>
                <option value='10'>October</option>
                <option value='11'>November</option>
                <option value='12'>December</option>
            </select>
        </div>
        <div class="select">
            <select name="year" id="year">
                <option value=''>--Select Year--</option>
                <option value='2017'>2017</option>
                <option value='2018'>2018</option>
            </select>
        </div><br/>
        <input type="button" name="bt-submit" id="bt-submit" value="Generate Attendance Report" class="btn btn-warning"/>
        <input type="button" name="bt-otsubmit" id="bt-otsubmit" value="Generate Overtime Report" class="btn btn-info" />
    </body>
</html>
