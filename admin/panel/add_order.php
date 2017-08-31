<?php include("../../conn/db.php"); 

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
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="save_order.php">
                                        
										<div class="form-group">
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
                                        </div>
										
										
										<div class="form-group">
                                            <label>Waiter</label>
                                             <select name="waiter" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM users where u_status=0 order by username";
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
                         <input class="form-control" type="date" name="date" value="<?php echo $date; ?>">
                                        </div>
										
										<div class="form-group">
                                            <label>Time</label>
                         <input class="form-control" type="time" name="time" value="<?php echo $time; ?>">
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
										
										 <?php if(isset($_GET["o_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="o_id" value="<?php echo $_GET["o_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["o_id"]))
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
