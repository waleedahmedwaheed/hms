<?php include("../../conn/db.php"); 

	if(isset($_GET["bh_id"]))
	{
		$insertSQL = "SELECT * FROM booking_hall where bh_id='".$_GET["bh_id"]."' and bh_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bh_id = $row["bh_id"];
		$hl_id = $row["hl_id"];
		$mn_id = $row["mn_id"];
		$total_person = $row["total_person"];
		$head_rate = $row["head_rate"];
		$other_desc = $row["other_desc"];
		$other_rate = $row["other_rate"];
		$tax = $row["tax"];
		$discount = $row["discount"];
		$time_in = $row["time_in"];
		$time_out = $row["time_out"];
		$b_date = $row["b_date"];
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
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="save_booking.php">
                                        <div class="form-group">
                                            <label> Hall </label>
                                              <select name="hl_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM halls where hl_status=0 order by hl_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["hl_id"]; ?>" <?php if($hl_id==$rowsu["hl_id"]){ echo "selected";} ?>><?php echo $rowsu["hl_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
										  <div class="form-group">
                                            <label> Menu </label>
                                              <select name="mn_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM menu_hall where mn_status=0 order by mn_desc";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["mn_id"]; ?>" <?php if($mn_id==$rowsu["mn_id"]){ echo "selected";} ?>><?php echo $rowsu["mn_id"]." - ".$rowsu["mn_desc"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="b_date" value="<?php echo $b_date; ?>" />
                                        </div>
										
										<div class="form-group">
                                            <label>Time in </label>
                                            <input type="time" class="form-control" name="time_in" value="<?php echo $time_in; ?>" style="width:40%" />
										</div>
										
										<div class="form-group">
                                            <label>Time out </label>
											<input type="time" class="form-control" name="time_out" value="<?php echo $time_out; ?>" style="width:40%" />
										</div>
										
										<div class="form-group">
                                            <label>Total Persons </label>
											<input type="text" class="form-control" name="total_person" value="<?php echo $total_person; ?>" />
										</div>
										
										<div class="form-group">
                                            <label>% per head rate</label>
                                            <input type="text" class="form-control" name="head_rate" value="<?php echo $head_rate; ?>" />
                                        </div>
										
										<div class="form-group">
                                            <label>Other Detail</label>
                                            <textarea class="form-control" name="other_desc" > <?php echo $other_desc; ?> </textarea>
                                        </div>
										
										<div class="form-group">
                                            <label>Other Rate</label>
                                            <input type="text" class="form-control" name="other_rate" value="<?php echo $other_rate; ?>" />
                                        </div>
										
										<div class="form-group">
                                            <label>Tax</label>
                                            <input type="text" class="form-control" name="tax" value="<?php echo $tax; ?>" />
                                        </div>
										
										<div class="form-group">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" name="discount" value="<?php echo $discount; ?>" />
                                        </div>
										
										
										
										 <?php if(isset($_GET["bh_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="bh_id" value="<?php echo $_GET["bh_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["bh_id"]))
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
