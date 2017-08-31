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
                    <h1 class="page-header">Daily Expenditure Record</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daily Expenditure Record
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="daily_exp.php" >
                                        
										
										
										
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
							
							
<button type="submit" style="float:right;" onclick="tableToExcel('dataTables-example', 'Daily Expenses')" ><img src="img/xls.png" title="Convert To Exel" width=25> </button>	
<button style="float:right;"  onclick="printContent('print')"><img src="img/print.png" title="Print" width=25></button>
							<div class="dataTable_wrapper" id="print">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
									<tr>

							<td colspan="3" style="text-align:center"><b style="font-size: 20px;"> Daily Expenses </b></td> 
							
							</tr>
							
                                        <tr>
                                            <th>#</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
						<?php
				//$selectSQL = "SELECT * FROM expendeture where status = '0' and `date` between '$date_from' and '$date_to'";
				$selectSQL = "SELECT * FROM expenses where exp_date >= '$date_from' and exp_date <= '$date_to' and exp_status=0";
				mysql_select_db($database_dbconfig, $dbconfig);
				$stid = mysql_query($selectSQL, $dbconfig) or die(mysql_error());
				while($row = mysql_fetch_assoc($stid))
				{
				$exp_date 		 = $row["exp_date"];
				$exp_amount		 = $row["exp_amount"];
				$ei_id			 = $row["ei_id"];
				
				?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(exp_item,$ei_id); ?></td>
                                            <td><?php echo $exp_amount; ?></td>
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
