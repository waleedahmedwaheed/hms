<?php include("../../conn/db.php"); 
 include("../../functions.php"); 

 $res_id = $_GET["res_id"];
 
	if(isset($_GET["o_id"]))
	{
		$insertSQL = "SELECT * FROM `order` where o_id = '".$_GET["o_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$o_id = $row["o_id"];
		$u_id = $row["u_id"];
		$waiter = $row["waiter"];
		$tbl_id = $row["tbl_id"];
		$date = $row["date"];
		$time = $row["time"];
		$bill = $row["bill"];
		$extra = $row["extra"];
		$discount = $row["discount"];

	}

	$now = date('Y-m-d');
	//echo $ntime = date("h:i:sa");
	
	date_default_timezone_set("Asia/Karachi");
	$ntime = date("h:i:s");
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
	width: 46%;
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
                    <h1 class="page-header">Orders</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Orders
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" id="userForm" >
                                        
										<div class="form-group">
                                    <?php if(!isset($_GET["res_id"])){ ?>	
											<label>Table</label>
                                             <select name="tbl_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM tables where tbl_status=0 order by tbl_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["tbl_id"]; ?>" <?php if($tbl_id==$rowsu["tbl_id"]){ echo "selected";} ?>><?php echo $rowsu["tbl_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
									<?php } else { ?>
										<label>Room</label>
										<input type="text" class="form-control" value="<?php echo get_title(res_room,$res_id); ?>" disabled />
										<input type="hidden" name="res_id" class="form-control" value="<?php echo $res_id; ?>"  />
									<?php } ?>	
                                        </div>
										
										
										<div class="form-group">
                                            <label>Waiter</label>
                                             <select name="waiter" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM users where u_status=0 and role_id = '5' order by username";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["u_id"]; ?>" <?php if($waiter==$rowsu["u_id"]){ echo "selected";} ?>><?php echo $rowsu["username"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
										
										<div class="form-group">
                                            <label>Date</label>
                         <input class="form-control" type="date" name="date" 
						 <?php if(isset($_GET["o_id"]))
						 { ?>
						 value="<?php echo $date; ?>"
						 <?php } else { ?>
						 value="<?php echo $now; ?>"
						 <?php } ?>
						 >
                                        </div>
										
										<div class="form-group">
                                            <label>Time</label>
                         <input class="form-control" type="time" name="time" 
						 <?php if(isset($_GET["o_id"]))
						 { ?>
						 value="<?php echo $time; ?>"
						 <?php } else { ?>
						 value="<?php echo $ntime; ?>"
						 <?php } ?>
						 >
                                        </div>
										
										<div class="form-group">
                                            <label>Extra Charges</label>
                         <input class="form-control" type="text" name="extra" value="<?php echo $extra; ?>">
                                        </div>
										
										<div class="form-group">
                                            <label>Discount</label>
                         <input class="form-control" type="text" name="discount" value="<?php echo $discount; ?>">
                                        </div>
										
										<div class="form-group">
                                            <label>Bill</label>
                        <select name="bill" class="form-control" required>
											<option value="">--Select--</option>
											<option value="0" <?php if($bill=='0'){ echo "selected";} ?>>Unpaid</option>
											<option value="1" <?php if($bill=='1'){ echo "selected";} ?>>Paid</option>
											</select>
                                        </div>
										
										<div class="form-group" style="width:60%">
										 <?php if(isset($_GET["o_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="o_id" value="<?php echo $_GET["o_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["o_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="orders.php" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="orders.php" class="btn btn-default">  New  </a>
										<?php } ?>	
										</div>
									</form>
									
									<span id="response"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_orders.php"); ?>
							
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
url: "save_order.php",	  // Url to which the request is send
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
		
        xmlhttp.open("GET","view_orders.php",true);
        xmlhttp.send();
		
		
}
});

}));
});


</script>

</body>

</html>
