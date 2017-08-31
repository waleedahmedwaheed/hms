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
                    <h1 class="page-header">Reservation Detail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
									 <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Reservation Date</th>
                                            <th><?php echo date("jS F, Y", strtotime("$res_date")); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="success">
                                            <th>Arrival Date</th>
                                            <td><?php echo date("jS F, Y", strtotime("$arrival")); ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>Guest Name</th>
                                            <td><?php echo $guest_name; ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <th>Accompanied by</th>
                                            <td><?php echo $accompany; ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <th>NIC number</th>
                                            <td><?php echo $nic; ?></td>
                                        </tr>
										<tr class="success">
                                            <th>Address</th>
                                            <td><?php echo $address; ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>Room no</th>
                                            <td><?php echo $room_no; ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <th>Rent per night</th>
                                            <td><?php echo $rent; ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <th>Purpose of visit</th>
                                            <td><?php echo $purpose; ?></td>
                                        </tr>
										<tr class="success">
                                            <th>Reference (if any)</th>
                                            <td><?php echo $reference; ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>Days need to stay</th>
                                            <td><?php echo $total_days; ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <th>Mobile No</th>
                                            <td><?php echo $mobile_no; ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <th>Vehicle No</th>
                                            <td><?php echo $vehicle_no; ?></td>
                                        </tr>
										<tr class="success">
                                            <th>Check out date</th>
                                            <td><?php echo date("jS F, Y", strtotime("$check_out_date")); ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>Check out time</th>
                                            <td><?php echo date('h:i:s A',strtotime("$check_out")); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
								</div>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
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


</body>

</html>
