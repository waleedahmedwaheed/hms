<?php include("../../conn/db.php"); 

	if(isset($_GET["res_id"]))
	{
		$insertSQL = "SELECT * FROM reserve where res_id = '".$_GET["res_id"]."' and res_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$res_id 	= $row["res_id"];
		$res_date 	= $row["res_date"];
		$arrival 	= $row["arrival"];
		$guest_name = $row["guest_name"];
		$accompany	= $row["accompany"];
		$nic		= $row["nic"];
		$address	= $row["address"];
		$room_no	= $row["room_no"];
		$rent		= $row["rent"];
		$purpose	= $row["purpose"];
		$reference	= $row["reference"];
		$total_days	= $row["total_days"];
		$mobile_no	= $row["mobile_no"];
		$vehicle_no	= $row["vehicle_no"];
		$check_out	= $row["check_out"];
		$check_out_date	= $row["check_out_date"];
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin HMS</title>

   <?php include("header.php"); ?>

	  <style>
.form-group{
	width: 30%;
    float: left;
    margin-right: 10px;
}
</style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin HMS</a>
            </div>
            <!-- /.navbar-header -->

           <?php include("topbar.php") ?>
           
		<?php include("sidebar.php"); ?>
		
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reservation</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Reservation
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" id="userForm" >
                                        <div class="form-group">
                                            <label>Reservation Date</label>
                                            <input class="form-control" type="date" name="res_date" value="<?php echo $res_date; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Arrival Date</label>
                                            <input class="form-control" type="date" name="arrival" value="<?php echo $arrival; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Guest Name</label>
                                            <input class="form-control" type="text" name="guest_name" value="<?php echo $guest_name; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Accompanied by</label>
                                            <input class="form-control" type="text" name="accompany" value="<?php echo $accompany; ?>">
                                        </div>
										<div class="form-group">
                                            <label>NIC number</label>
                                            <input class="form-control" type="text" name="nic" maxlength="13" value="<?php echo $nic; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
                                        </div>
										
										  <div class="form-group">
                                            <label> Room No </label>
                                              <select name="room_no" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM rooms where rm_status=0 order by room_no";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["room_no"]; ?>" <?php if($room_no==$rowsu["room_no"]){ echo "selected";} ?>><?php echo $rowsu["room_no"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Rent per night</label>
                                            <input class="form-control" type="text" name="rent" value="<?php echo $rent; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Purpose of visit</label>
                                            <input class="form-control" type="text" name="purpose" value="<?php echo $purpose; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Reference (if any)</label>
                                            <input class="form-control" type="text" name="reference" value="<?php echo $reference; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Days need to stay</label>
                                            <input class="form-control" type="number" name="total_days" value="<?php echo $total_days; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Mobile No</label>
                                            <input class="form-control" type="text" name="mobile_no" value="<?php echo $mobile_no; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Vehicle No</label>
                                            <input class="form-control" type="text" name="vehicle_no" value="<?php echo $vehicle_no; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Check Out date</label>
                                            <input class="form-control" type="date" name="check_out_date" value="<?php echo $check_out_date; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Check Out time</label>
                                            <input class="form-control" type="time" name="check_out" value="<?php echo $check_out; ?>">
                                        </div>
										
										<div class="form-group" style="width:60%">
										 <?php if(isset($_GET["res_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="res_id" value="<?php echo $_GET["res_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["res_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="reservation.php" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="reservation.php" class="btn btn-default">  New  </a>
										<?php } ?>
										</div>	
									</form>
                                
								</div>
									
								<span id="response"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_reserve.php"); ?>
							
							</div>
							
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include("scripts.php"); ?>
	
	<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "save_reserve.php",	  // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#loader").hide();
$('#userForm')[0].reset();
//window.location = 'add_category.php';
$("#response").html(data);


if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
        };
		
        xmlhttp.open("GET","view_reserve.php",true);
        xmlhttp.send();
		
		
}
});

}));
});


</script>

</body>

</html>
