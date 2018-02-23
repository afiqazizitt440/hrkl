<?php
include "../util/connection.php";
session_start();
if (array_key_exists('email', $_SESSION) && !empty($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $idcom = $_SESSION["idcom"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $query = "select * from branch where idcom='$idcom'";
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
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>');</script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="https://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyBhuO-AuRQVU4Vw2VOO-hOPWZIhmwNWJOA&sensor=false" type="text/javascript"></script>
        <title>Organization</title>
        <?php
        $background = "../images/hr-background.jpg";
        ?>
        <style type="text/css">

            body {
                background-image: url('<?php echo $background; ?>');
            }

            .loader {
                border: 8px solid #FFFFFF;
                border-radius: 50%;
                border-top: 8px solid #C0C0C0;
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

            .ui-timepicker-container{ 
                z-index:1151 !important; 
            }
        </style>
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
        </style>
        <script type="text/javascript">
            //address locator
            var map = null;
            var geocoder = null;
            function initialize() {
                if (GBrowserIsCompatible()) {


                    if ((document.getElementById("gmaplat").value == '') || (document.getElementById("gmaplng").value == '')) {

                        var map = new GMap2(document.getElementById("map_canvas"));
                        map.setCenter(new GLatLng(37.88, -122.442626), 10);
                        geocoder = new GClientGeocoder();
                        map.setUIToDefault();
                    } else
                    {
                        var map = new GMap2(document.getElementById("map_canvas"));
                        map.setCenter(new GLatLng(document.getElementById("gmaplat").value, document.getElementById("gmaplng").value), 13);
                        map.setUIToDefault();

                        var point = new GLatLng(document.getElementById("gmaplat").value, document.getElementById("gmaplng").value);
                        // map.addOverlay(new GMarker(point));
                        var marker = new GMarker(point);
                        map.addOverlay(marker);
                        // As this is user-generated content, we display it as
                        // text rather than HTML to reduce XSS vulnerabilities.
                        marker.openInfoWindow(document.createTextNode(document.getElementById("branchlocation").value));
                    }

                    GEvent.addListener(map, "click", function (overlay, latlng) {
                        if (overlay) {
                            // ignore if we click on the info window
                            return;
                        }
                        var tileCoordinate = new GPoint();
                        var tilePoint = new GPoint();
                        var currentProjection = G_NORMAL_MAP.getProjection();
                        tilePoint = currentProjection.fromLatLngToPixel(latlng, map.getZoom());
                        tileCoordinate.x = Math.floor(tilePoint.x / 256);
                        tileCoordinate.y = Math.floor(tilePoint.y / 256);
                        var marker = new GMarker(tilePoint);
                        map.addOverlay(marker);
                        var myHtml = "Latitude: " + latlng.lat() + "<br/>Longitude: " + latlng.lng() +
                                "<br/>The Tile Coordinate is:<br/> x: " + tileCoordinate.x +
                                "<br/> y: " + tileCoordinate.y + "<br/> at zoom level " + map.getZoom();
                        document.getElementById("gmaplat").value = latlng.lat();
                        document.getElementById("gmaplng").value = latlng.lng();
                        map.openInfoWindow(latlng, myHtml);
                    });
                }
            }

            function showAddress(branchlocation) {
                if (GBrowserIsCompatible()) {

                    var map = new GMap2(document.getElementById("map_canvas"));
                    map.setCenter(new GLatLng(37.88, -122.442626), 10);
                    geocoder = new GClientGeocoder();
                    map.setUIToDefault();

                    GEvent.addListener(map, "click", function (overlay, latlng) {
                        if (overlay) {
                            // ignore if we click on the info window
                            return;
                        }
                        var tileCoordinate = new GPoint();
                        var tilePoint = new GPoint();
                        var currentProjection = G_NORMAL_MAP.getProjection();
                        tilePoint = currentProjection.fromLatLngToPixel(latlng, map.getZoom());
                        tileCoordinate.x = Math.floor(tilePoint.x / 256);
                        tileCoordinate.y = Math.floor(tilePoint.y / 256);
                        //  var marker = new GMarker(tilePoint, {draggable: true});

                        var myHtml = "Latitude: " + latlng.lat() + "<br/>Longitude: " + latlng.lng() +
                                "<br/>The Tile Coordinate is:<br/> x: " + tileCoordinate.x +
                                "<br/> y: " + tileCoordinate.y + "<br/> at zoom level " + map.getZoom();
                        document.getElementById("gmaplat").value = latlng.lat();
                        document.getElementById("gmaplng").value = latlng.lng();
                        map.clearOverlays();
                        var latlng = new GLatLng(latlng.lat(), latlng.lng());
                        map.addOverlay(new GMarker(latlng));

                        // map.addOverlay(marker); 
                        map.openInfoWindow(latlng, myHtml);
                    });
                }
                if (geocoder) {
                    geocoder.getLatLng(
                            branchlocation,
                            function (point) {
                                if (!point) {
                                    alert(branchlocation + " not found");
                                } else {

                                    map.setCenter(point, 13);
                                    var marker = new GMarker(point, {draggable: true});
                                    GEvent.addListener(marker, "dragstart", function () {
                                        map.closeInfoWindow();
                                    });

                                    GEvent.addListener(marker, "dragend", function (latlng) {


                                        var tileCoordinate = new GPoint();
                                        var tilePoint = new GPoint();
                                        var currentProjection = G_NORMAL_MAP.getProjection();
                                        tilePoint = currentProjection.fromLatLngToPixel(latlng, map.getZoom());
                                        tileCoordinate.x = Math.floor(tilePoint.x / 256);
                                        tileCoordinate.y = Math.floor(tilePoint.y / 256);

                                        var marker = new GMarker(tilePoint, {draggable: true});
                                        marker.openInfoWindowHtml("Just bouncing along...");
                                        var myHtml = "Latitude: " + latlng.lat() + "<br/>Longitude: " + latlng.lng() +
                                                "<br/>The Tile Coordinate is:<br/> x: " + tileCoordinate.x +
                                                "<br/> y: " + tileCoordinate.y + "<br/> at zoom level " + map.getZoom();
                                        document.getElementById("gmaplat").value = latlng.lat();
                                        document.getElementById("gmaplng").value = latlng.lng();

                                        //    marker.openInfoWindowHtml(latlng, myHtml);
                                        map.addOverlay(marker);
                                    });


                                    //alert(latlng.lng());

                                    map.addOverlay(marker);
                                    var center = marker.getLatLng();
                                    document.getElementById("gmaplat").value = center.lat();
                                    document.getElementById("gmaplng").value = center.lng();


                                    // As this is user-generated content, we display it as
                                    // text rather than HTML to reduce XSS vulnerabilities.
                                    marker.openInfoWindow(document.createTextNode(branchlocation));
                                }
                            }
                    );
                }
            }
        </script>
        <script>
            $(document).ready(function () {
                $('#add').click(function () {
                    $('#insert').val("Insert");
                    $('#insert_form')[0].reset();
                });
                $(document).on('click', '.edit_data', function () {
                    var branchid = $(this).attr("id");
                    $.ajax({
                        url: "fetchBranch.php",
                        method: "post",
                        data: {branchid: branchid},
                        dataType: "json",
                        success: function (data) {
                            $('#branchid').val(data.branchid);
                            $('#branchlocation').val(data.branchlocation);
                            $('#openhours').val(data.openhours);
                            $('#closehours').val(data.closehours);
                            $('#gmaplat').val(data.gmaplat);
                            $('#gmaplng').val(data.gmaplng);
                            $('#state').val(data.state);
                            $('#staticip').val(data.staticip);
                            $('#insert').val("Update");
                        }
                    });
                });

                $('#insert_form').on("submit", function (event) {
                    event.preventDefault();
                    if ($('#branchlocation').val() == "")
                    {
                        alert("Address is required..!");
                    } else if ($('#state').val() == "")
                    {
                        alert("state is required..!");
                    } else {
                        $.ajax({
                            url: "insertBranch.php",
                            method: "post",
                            data: $('#insert_form').serialize(),
                            beforeSend: function () {
                                $('#insert').val("Updating...");
                            },
                            success: function (data) {
                                $('#editBranch').modal('hide');
                                $('#editBranch .close').click();
                                $('#branchTable').html(data);
                                alert("Updated successfully..!");
                                location.reload();
                            }
                        });
                    }

                }); //end of edit employee data modal

                $(document).on('click', '.view_data', function () { //start of view employee data modal
                    var branchid = $(this).attr("id");
                    if (branchid != '')
                    {
                        $.ajax({
                            url: 'selectBranch.php',
                            method: 'post',
                            data: {branchid: branchid},
                            success: function (data) {
                                $('#branchDetail').html(data);
                                $('#viewBranch').modal("show");
                            }
                        });
                    }
                });// end of view branch data modal

                //start of add branch modal
                $(document).on('click', '.add_data', function () {
                    $('#add_form').on("submit", function (event) {
                        event.preventDefault();

                        if ($('#branch_id').val() == "")
                        {
                            alert("Branch ID is required..!");
                        } else if ($('#branch_location').val() == "")
                        {
                            alert("Branching location is required..!");
                        } else
                        {
                            $.ajax({
                                url: "createBranch.php",
                                method: "POST",
                                data: $('#add_form').serialize(),
                                beforeSend: function () {
                                    $('#bt-insert').val("Creating Profile..");
                                },
                                success: function (data) {

                                    $('#add_form')[0].reset();
                                    $('#add_data_Modal').modal('hide');
                                    $('#add_data_Modal .close').click();
                                    $('#branchTable').html(data);
                                    location.reload();
                                    alert("Profile Created Successfully..!");
                                }
                            });
                        }
                    });
                });//end of add modal

                //start of checkall checkbox f()
                $('#checkall').change(function () {
                    $("input:checkbox").prop('checked', $(this).prop("checked"));
                });
                //end of checkall checkbox f()

                // start of delete modal
                $(document).ready(function () {

                    $('#btn_delete').click(function () {

                        if (confirm("Are you sure you want to delete this?"))
                        {
                            var branchid = [];

                            $(':checkbox:checked').each(function (i) {
                                branchid[i] = $(this).val();
                            });

                            if (branchid.length === 0) //tell you if the array is empty
                            {
                                alert("Please Select at least one checkbox that you want to delete..!");
                            } else
                            {
                                $.ajax({
                                    url: 'deleteBranch.php',
                                    method: 'POST',
                                    data: {branchid: branchid},
                                    success: function ()
                                    {
                                        for (var i = 0; i < branchid.length; i++)
                                        {
                                            $('tr#' + branchid[i] + '').css('background-color', '#ccc');
                                            $('tr#' + branchid[i] + '').fadeOut('slow');
                                            location.reload();

                                        }
                                        alert("Deleted Successfully...!")
                                    }

                                });
                            }

                        } else
                        {
                            return false;
                        }
                    });

                });
                //end of delete modal

                //jquery timepicker
                $('.timepicker').timepicker({
                    timeFormat: 'HH:mm',
                    interval: 30,
                    minTime: '07',
                    maxTime: '23:00',
                    defaultTime: '11',
                    startTime: '07:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                }); // end of jquery timepicker
            });

        </script>
    </head>
    <body onload="initialize()" onunload="GUnload()">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="Home.php">Dashboard</a></li>

                    <li class="active"><a href="Employees.php">Organization</a></li>
                    <li><a href="ManageAttendance.php">Attendance</a></li>
                    <li><a href="LeaveSettings.php">Leave</a></li>
                    <li><a href="#contact">Payroll</a></li>
                    <li><a href="#contact">Calendar</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["empname"]; ?>  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-envelope"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <span class="navbar-brand"></span>
                    </div>
                    <p class="navbar-text"></p>
                </div>
            </nav>
        </div>
        <div class="container-fluid" style="background:white;" >
            <h2>Branches Profile List</h2>
            <br/>
            <div align="right">
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-sm add_data"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Branch</button>
            </div>
            <br/>
            <div id="branchTable">
                <table class="table table-responsize table-bordered table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th class="col-check"><input type="checkbox" id="checkall" onclick="test()"/></th>
                            <th>ID</th>
                            <th>Location</th>
                            <th>State</th>
                            <th colspan="2">Operating Hours (24H)</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) !== 0) {
                            echo '<center>Showing <span style="font-size:15px;">' . mysqli_num_rows($result) . '</span> records.</center><br/> ';
                        while ($res = mysqli_fetch_array($result)) {
                            // output data of each row
                            ?>
                            <tr>
                                <td><input type="checkbox" name="branchid[]" class="delete_branch checkthis" value="<?php echo $res["branchid"]; ?>" /></td>
                                <td><?php echo $res['branchid']; ?></td>
                                <td><?php echo $res['branchlocation']; ?></td>
                                <td><?php echo $res['state']; ?></td>
                                <td><?php echo $res['openhours']; ?></td>
                                <td><?php echo $res['closehours']; ?></td>
                                <td align="center"><button type="button" name="edit" id="<?php echo $res['branchid']; ?>" class="edit_data btn btn-success btn-sm" data-toggle="modal"  data-target="#editBranch" title="Edit Details"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                <td align="center"><button type="button" name="view" id="<?php echo $res['branchid']; ?>" class="view_data btn btn-warning btn-sm" data-toggle="modal"  data-target="#viewBranch" title="Show Details"><span class="glyphicon glyphicon-menu-hamburger"></span></button></td>
                            </tr>
                            <?php
                        }
                        } else {
                            echo '<center>No records found.</center>';
                            die();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Branch Details -->
        <div id="viewBranch" class="modal fade">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Branch Information</h4>
                    </div>
                    <div class="modal-body" id="branchDetail">
                        <center><div class="loader"></div></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Branch -->
        <div id="editBranch" class="modal fade">  
            <div class="modal-dialog">  
                <div class="modal-content">  
                    <div class="modal-header">  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h4 class="modal-title">Branch Information</h4>  
                    </div>  
                    <div class="modal-body">  
                        <form method="post" id="insert_form">
                            <label>Branch ID</label><input type="text" name="branchid" id="branchid" placeholder="Branch ID *"class="form-control" readonly/><br/>
                            <label>Address</label><input type="text" name="branchlocation" id="branchlocation" placeholder="Branch Location *" class="form-control" /><br/>
                            <button type="button" onclick="showAddress(branchlocation.value);" placeholder="Enter street & number,country)" class="btn btn-info"><i class="fa fa-map-marker"></i> Show Location On Map</button><br/><br/>
                            <div id="map_canvas" style="width: 500px; height: 300px" ></div><br/>
                            <label>Latitude : </label><input type="text" size="25" name="gmaplat" id="gmaplat" class="form-control" value=""/><br/>
                            <label>Longitude : </label><input type="text" size="25" name="gmaplng" id="gmaplng" class="form-control" value=""/><br/>
                            <label>Operating Hours (24H)</label><br/><input class="timepicker" name="openhours" id="openhours"/><span> - </span>
                            <input class="timepicker" name="closehours" id="closehours"/><br/><br/>
                            <label>Branch State</label><select name="state" id="state" class="form-control">
                                <option value="">Select the branch state</option>
                                <option value="PERLIS">PERLIS</option>
                                <option value="KEDAH">KEDAH</option>
                                <option value="PULAU PINANG">PULAU PINANG</option>
                                <option value="PERAK">PERAK</option>
                                <option value="SELANGOR">SELANGOR</option>
                                <option value="WP KUALA LUMPUR">WP KUALA LUMPUR</option>
                                <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                                <option value="MELAKA">MELAKA</option>
                                <option value="JOHOR">JOHOR</option>
                                <option value="PAHANG">PAHANG</option>
                                <option value="TERENGGANU">TERENGGANU</option>
                                <option value="KELANTAN">KELANTAN</option>
                                <option value="SARAWAK">SARAWAK</option>
                                <option value="SABAH">SABAH</option>
                            </select><br/>

                            <label>Public IP Address</label><input type="text" name="staticip" id="staticip" placeholder="IP Address *" class="form-control"/><br/>
                            						   
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                        </form>  
                    </div>  
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- End of modal Edit Branch -->

        <!-- Modal Add Branch -->
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Branch Information</h4>
                        <div class="modal-body">
                            <p class="">Create a profile for a branch</p>
                            <form method="post" id="add_form">

                                <label>Branch ID</label><input type="text" name="branch_id" id="branch_id" placeholder="Branch ID *"class="form-control"/><br/>
                                <label>Region</label><input type="text" name="branch_location" id="branch_location" placeholder="Branch Location *" class="form-control"/><br/>
                                <label>Operating Hours (24H)</label><br/><input class="timepicker" name="open_hours" id="openhours"/><span> - </span>
                                <input class="timepicker" name="close_hours" id="close_hours"/><br/><br/>
                                <label>Branch State</label><select name="state_" id="state_" class="form-control">
                                    <option value="">Select the branch state</option>
                                    <option value="PERLIS">PERLIS</option>
                                    <option value="KEDAH">KEDAH</option>
                                    <option value="PULAU PINANG">PULAU PINANG</option>
                                    <option value="PERAK">PERAK</option>
                                    <option value="SELANGOR">SELANGOR</option>
                                    <option value="WP KUALA LUMPUR">WP KUALA LUMPUR</option>
                                    <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                                    <option value="MELAKA">MELAKA</option>
                                    <option value="JOHOR">JOHOR</option>
                                    <option value="PAHANG">PAHANG</option>
                                    <option value="TERENGGANU">TERENGGANU</option>
                                    <option value="KELANTAN">KELANTAN</option>
                                    <option value="SARAWAK">SARAWAK</option>
                                    <option value="SABAH">SABAH</option>
                                </select><br/>

                                <input type="submit" name="bt-insert" id="bt-insert" class="btn btn-success btn-sm btn-block" value="Create Profile"/></a>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of modal Add Branch -->

            <!-- Bootstrap core JavaScript
            ================================================== -->
            <script src="../js/jquery.min.js"></script>  
            <script src="../js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
            </body>
            </html>

