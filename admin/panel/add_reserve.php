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

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="save_reserve.php">
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
                                            <input class="form-control" type="text" name="nic" value="<?php echo $nic; ?>">
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
										
										 <?php if(isset($_GET["res_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="res_id" value="<?php echo $_GET["res_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["res_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-default">Update </button>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-default">Insert </button>
										<?php } ?>	
									</form>
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

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
