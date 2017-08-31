<?php include("../../conn/db.php"); 
 include("../../functions.php"); 
 
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
		$cus_name = $row["cus_name"];
		$cus_cnic = $row["cus_cnic"];
		$cus_phone = $row["cus_phone"];
		
		
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

thead,tfoot th
{
    font-size: 18px;
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
                    <h1 class="page-header">Booking Detail</h1>
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
                                            <th>Booking Date</th>
                                            <th><?php echo date("jS F, Y", strtotime("$b_date")); ?></th>
                                        </tr>
                                    </thead>
									
									<tfoot>
                                        <tr>
                                            <th>Net Total</th>
                                            <th><?php echo 1000; ?></th>
                                        </tr>
                                    </tfoot>
									
                                    <tbody>
                                        <tr class="success">
                                            <th>Name</th>
                                            <td><?php echo $cus_name; ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>CNIC</th>
                                            <td><?php echo $cus_cnic; ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <th>Phone</th>
                                            <td><?php echo $cus_phone; ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <th>Hall</th>
                                            <td><?php echo $b; ?></td>
                                        </tr>
										<tr class="success">
                                            <th>Menu</th>
                                            <td><?php echo $address; ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>Time In - Out</th>
                                            <td><?php echo $time_in." - ".$time_out; ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <th>Total Persons / % per head</th>
                                            <td><?php echo $total_person." / ".$head_rate. "%"; ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <th>Other Detail</th>
                                            <td><?php echo $other_desc; ?></td>
                                        </tr>
										<tr class="success">
                                            <th>Other Rate</th>
                                            <td><?php echo $other_rate; ?></td>
                                        </tr>
                                        <tr class="info">
                                            <th>Tax</th>
                                            <td><?php echo $tax; ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <th>Discount</th>
                                            <td><?php echo $discount; ?></td>
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
