<?php

include "../util/connection.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>

    $("#btn-submit").click(function (event) {
        event.preventDefault();
        var email = $("#email").val();
        var start = $("#start").val();
        var end = $("#end").val();
        $.ajax({
            type: "POST",
            url: "selectDisplayOvertime.php",
            data: {
                email: email,
                start: start,
                end: end
            },
            beforeSend: function () {
                $('#btn-submit').val("Please Wait..");
                $('#btn-submit').attr("disabled", true);
            },
            success: function (dta)
            {
                $('#displayOvertime').html(dta);
                $('#btn-submit').val("Generate Records");
                $('#btn-submit').attr("disabled", false);
            }

        });
    });

</script>
<?php

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $query = "select personalinformation.*,employeeinformation.* from personalinformation join employeeinformation on personalinformation.email = employeeinformation.email where personalinformation.email = '$email'";
    //$query2 = "select personalinformation.*,attendancerecord.* from personalinformation join attendancerecord on personalinformation.email = attendancerecord.email where personalinformation.email = '$email'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $empname = $row["empname"];
        $empid = $row["employeeid"];
    }
    $output = '<table class="table table-responsive"><tr><th>Employee Name</th><td>' . $empname . '</td><th>Employee ID</th><td>' . $empid . '</td></tr></table>
               <form name="overtime" id="overtime" method="post"><input type="hidden" name="email" id="email" value="' . $email . '"/><br/>
               <label>From : </label><input type="date" name="start" id="start"/>
               <label>To : </label><input type="date" name="end" id="end" />
               <input type="button" name="btn-submit" id="btn-submit" value="Generate Records" class="btn btn-success btn-sm"/></form>
               <br/>
               <div id="displayOvertime"></div>';
    echo $output;
} else {
    header("Location: admin.php");
}
?>