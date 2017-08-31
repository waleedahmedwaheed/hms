<?php include("../../conn/db.php"); 

	if(isset($_POST["submit"]))
	{
		
		$date_from = $_POST["date_from"];
		$date_to = $_POST["date_to"];
		$id=1;
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
	width: 46%;
    float: left;
    margin-right: 10px;
}

@media screen {
	.only_print{
	display:none;
	}
	table{
		font-size:12px;
	}
	
}


@media print {
    a:link:after,
    a:visited:after {
        content: "" !important;
		opacity : 0 ;
    }
	table{
		font-size:12px;
	}
	
	 .no_print {
        display:none;
    }

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
                            Orders
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="order_rpt.php" >
                                        
										
										
										
										<div class="form-group">
                                            <label>From</label>
                         <input class="form-control" type="date" name="date_from" value="<?php echo $date_from; ?>">
                                        </div>
										
										<div class="form-group">
                                            <label>To</label>
                         <input class="form-control" type="date" name="date_to" value="<?php echo $date_to; ?>">
                                        </div>
										
										
                                        <button type="submit" name="submit" class="btn btn-success">Search </button>
										
										</div>
									</form>
									
								</div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
<button type="submit" style="float:right;" onclick="tableToExcel('dataTables-example', 'Order Report')" ><img src="img/xls.png" title="Convert To Exel" width=25> </button>	
<button style="float:right;"  onclick="printContent('print')"><img src="img/print.png" title="Print" width=25></button>
							<div class="dataTable_wrapper" id="print">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
									<tr>

							<td colspan="9" style="text-align:center"><b style="font-size: 20px;"> Orders </b></td> 
							
							</tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Table / Room</th>
                                            <th>Waiter</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Extra Charges</th>
                                            <th>Discount</th>
                                            <th>Bill</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
						<?php
				$insertSQL = "SELECT * FROM `order` where status = '0' and `date` between '$date_from' and '$date_to'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$o_id 		 = $row["o_id"];
				$res_id 	 = $row["res_id"];
				$tbl_id		 = $row["tbl_id"];
				$date		 = $row["date"];
				$waiter		 = $row["waiter"];
				$time		 = $row["time"];
				$bill		 = $row["bill"];
				$extra		 = $row["extra"];
				$discount	 = $row["discount"];
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php if($tbl_id<>0){ echo get_title(table,$tbl_id); } else { echo "Room ".get_title(res_room,$res_id);} ?></td>
                                            <td><?php echo get_title(username,$waiter); ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $time; ?></td>
                                            <td><?php echo $extra; ?></td>
                                            <td><?php echo $discount; ?></td>
                                            <td><?php switch($bill)
											{
													case 0:
													echo "Unpaid";
													break;
													case 1:
													echo "Paid";
													break;	
											}	
											?></td>
											<td><?php echo number_format(get_title(order_tot,$o_id),2); ?></td>
                                        </tr>
									
                                        
				<?php } ?>					
                                     </tbody>
                                </table>
                            </div>
							
							
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


</body>

</html>
