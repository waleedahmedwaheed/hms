<?php include("../../conn/db.php"); 
include("../../functions.php"); 

	
	if(isset($_GET["bd_id"]))
	{
		$insertSQL = "SELECT * FROM booking_detail where bd_id='".$_GET["bd_id"]."' and bd_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bd_id = $row["bd_id"];
		$bh_id = $row["bh_id"];
		$hl_id = $row["hl_id"];
		$mn_id = $row["mn_id"];
		$total_person = $row["total_person"];
		$head_rate = $row["head_rate"];
		$other_desc = $row["other_desc"];
		$other_rate = $row["other_rate"];
		$time_in = $row["time_in"];
		$time_out = $row["time_out"];
		$b_date = $row["b_date"];
	}
	
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
	
	if(isset($_GET["sr_id"]))
	{
		$insertSQL = "SELECT * FROM `service_rec` where sr_id = '".$_GET["sr_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bd_id = $row["bd_id"];
		$hs_id = $row["hs_id"];
		$res_id = $row["res_id"];
		$sr_id = $row["sr_id"];

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
                    <h1 class="page-header">Services</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Services
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" id="userForm" >
                                        
										<div class="form-group">
                                            <label>Services</label>
                                             <select name="hs_id" id="hs_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM hall_service where hs_status=0 order by hs_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["hs_id"]; ?>" <?php if($hs_id==$rowsu["hs_id"]){ echo "selected";} ?>><?php echo $rowsu["hs_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
										<?php
										if(isset($_GET["bd_id"]))
										{
										?>
										<input type="hidden" name="bd_id" value="<?php echo $bd_id; ?>" />
										<?php
										} 
										else if(isset($_GET["res_id"])) 
										{
										?>
										<input type="hidden" name="res_id" value="<?php echo $res_id; ?>" />
										<?php 
										} 
										?>
										
										 <?php if(isset($_GET["sr_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="sr_id" value="<?php echo $_GET["sr_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["sr_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="oservices.php?bd_id=<?php echo $bd_id; ?>" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="oservices.php?bd_id=<?php echo $bd_id; ?>" class="btn btn-default">  New  </a>
										<?php } ?>	
										<button type="button" title="Back" class="btn btn-default btn-circle" style="float: right;">
										<a href="booking_details.php?bh_id=<?php echo $bh_id; ?>"> <i class="fa fa-chevron-circle-left"></i> </a></button>
									</form>
                                
								<span id="response"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_oservices.php"); ?>
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
url: "save_oservices.php",	  // Url to which the request is send
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
		
        var bd_id = <?php if(isset($_GET["bd_id"])) { echo $bd_id; } else if(isset($_GET["res_id"])) { echo $res_id; } ?>;
		//alert(bd_id);
        xmlhttp.open("GET","view_oservices.php?<?php if(isset($_GET["bd_id"])) { echo "bd_id"; } else if(isset($_GET["res_id"])) { echo "res_id"; } ?>="+bd_id,true);
        xmlhttp.send();
		
		
}
});

}));
});


</script>
	

	
</body>
</html>
