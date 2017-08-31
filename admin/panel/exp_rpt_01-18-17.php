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
                    <h1 class="page-header">Expenses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Expenses
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="exp_rpt.php" >
                                        
										
										
										
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
							
							
							<div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
							<th width="10%" nowrap> </th>			
						<?php
				echo $insertSQL = "SELECT distinct(ei_id) FROM expenses where exp_status = '0' and exp_date between '$date_from' and '$date_to' order by ei_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1_ = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$total_no = mysql_num_rows($Result1_);
				while($row_e = mysql_fetch_assoc($Result1_))
				{
				$ei_id 		 = $row_e["ei_id"];	
				?>	
				<th><?php echo get_title(exp_item,$ei_id); ?></th>
				<?php
				}
				?>
				<th> Restaurant </th>
                            <th width="10%" nowrap> Sub Total </th>        
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
				<?php
				$insertSQL = "SELECT exp_date FROM expenses where exp_status = '0' and exp_date between '$date_from' and '$date_to' group by exp_date order by ei_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
				while($row = mysql_fetch_assoc($Result1))
				{
				$exp_date 		 = $row["exp_date"];
				//$exp_amount		 = $row["exp_amount"];
				?>

                                        <tr class="odd gradeX">
                                            <td width="10%" nowrap><?php echo date("jS F, Y", strtotime("$exp_date")); ?></td>
                                            <?php
				$insertSQLs = "SELECT distinct(ei_id),IFNULL(exp_amount, 0) as exp_amount FROM expenses where exp_date = '$exp_date'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1s_exp = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());	 
				$total_no_ = mysql_num_rows($Result1s_exp);
				while($rows_exp = mysql_fetch_assoc($Result1s_exp))
				{
				$exp_amounts		 = $rows_exp["exp_amount"];
				$sub_exp_amounts = $sub_exp_amounts + $exp_amounts;
				?>
											<td><?php 
											if($sub_exp_amounts==null)
											{
												"NULL";
											}
											else
											{
											echo number_format($exp_amounts,2);
											}
											?></td>
										
				<?php }
						$col = ($total_no - $total_no_) + 1;
						if($col>1)
						{
							for($i=1;$i<$col;$i++)
							{
				?>		
					<td> <?php echo number_format(0,2); ?> </td>
						<?php 
							}
						} ?>		
					<td><?php echo number_format(get_sum(restaurant,$exp_date),2); ?></td>	
					
					<td align="right"><?php echo number_format($sub_exp_amounts,2); ?></td>
				<?php	
				$sub_exp_amounts = 0;
				?>							
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
