<?php include("../../conn/db.php"); 
 include("../../functions.php"); 

	if(isset($_GET["bh_id"]))
	{
		$insertSQL = "SELECT * FROM booking_hall where bh_id='".$_GET["bh_id"]."' and bh_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bh_id = $row["bh_id"];
		$tax = $row["tax"];
		$discount = $row["discount"];
		$cus_name = $row["cus_name"];
		$cus_cnic = $row["cus_cnic"];
		$cus_phone = $row["cus_phone"];
		$entry_date = $row["entry_date"];
		
		
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
                    <h1 class="page-header">Hall Booking</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Hall Booking
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" id="userForm" >
										
										<div class="form-group">
                                            <label>Name </label>
											<input type="text" class="form-control" name="cus_name" value="<?php echo $cus_name; ?>" required />
										</div>
										
										<div class="form-group">
                                            <label>CNIC </label>
											<input type="text" class="form-control" name="cus_cnic" maxlength="13" pattern="[0-9]{13}" title="Enter Number Only" value="<?php echo $cus_cnic; ?>" required />
										</div>
										
										<div class="form-group">
                                            <label>Phone </label>
											<input type="text" class="form-control" name="cus_phone" maxlength="11" pattern="[0-9]{11}" title="Enter Number Only" value="<?php echo $cus_phone; ?>" required />
										</div>
										
										<div class="form-group">
                                            <label>Date </label>
											<input type="date" class="form-control" name="entry_date" value="<?php echo $entry_date; ?>" required />
										</div>
										
										<div class="form-group" style="width:60%">
										 <?php if(isset($_GET["bh_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="bh_id" value="<?php echo $_GET["bh_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["bh_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="bookings.php" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="bookings.php" class="btn btn-default">  New  </a>
										<?php } ?>	
									</form>
									
									</div>
									
								<span id="response"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_bookings.php"); ?>
							
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
url: "save_booking.php",	  // Url to which the request is send
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
		
        xmlhttp.open("GET","view_bookings.php",true);
        xmlhttp.send();
		
		
}
});

}));
});


</script>

</body>

</html>
