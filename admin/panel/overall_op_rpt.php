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
                                    <form method="post" action="inc_rpt.php" >
                                        
										
										
										
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
				$insertSQL = "SELECT distinct(ei_id) FROM expenses where exp_status = '0' order by ei_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1_ = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$total_no = mysql_num_rows($Result1_);
				$arr_ei_id = array();
				while($row_e = mysql_fetch_assoc($Result1_))
				{
				$ei_id 		 = $row_e["ei_id"];	
				$arr_ei_id[] = $row_e["ei_id"];	
				?>	
				<th><?php echo get_title(exp_item,$ei_id); ?></th>
				<?php
				}
				$arr_ei_id_ =  implode( ',', $arr_ei_id );
				
				/*foreach($arr_ei_id as $value_ei_id)
				{
					echo $value_ei_id."<br>";
				}*/
				?>
				<th> Restaurant </th>
				<th> Hotel </th>
				<th> Hall </th>
                            <th width="10%" nowrap> Sub Total </th>        
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
				<?php
				
				$date_from_ = strtotime($date_from . ' -1 day');
				$date_to_ = strtotime($date_to . ' +1 day');
				
				
function list_days($date_from_,$date_to_){
    $arr_days = array();
    $day_passed = ($date_to_ - $date_from_); //seconds
    $day_passed = ($day_passed/86400); //days

    $counter = 1;
    $day_to_display = $date_from_;
    while($counter < $day_passed){
        $day_to_display += 86400;
        //echo date("F j, Y \n", $day_to_display);
        $arr_days[] = date('o-m-d',$day_to_display);
        $counter++;
    }

    return $arr_days;
}

//print_r(list_days($date_from_,$date_to_));
$arr = list_days($date_from_,$date_to_);
				
				foreach($arr as $value)
				{ 
					//echo $value . "<br />\n";
				?>

                                        <tr class="odd gradeX">
                                            <td width="10%" nowrap><?php echo $value; //echo date("jS F, Y", strtotime("$value")); ?></td>
                                            <?php
					foreach($arr_ei_id as $value_ei_id)
				{
					//echo $arr_ei_id_;
				$insertSQLs = "SELECT COALESCE(SUM(exp_amount),0) as exp_amount FROM expenses where exp_date = '$value' and ei_id='$value_ei_id'
				and exp_status = '0' order by ei_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1s_exp = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());	 
				$total_no_ = mysql_num_rows($Result1s_exp);
				while($rows_exp = mysql_fetch_assoc($Result1s_exp))
				{
				$exp_amounts		 = $rows_exp["exp_amount"];
				$sub_exp_amounts = $sub_exp_amounts + $exp_amounts;
				?>
					<td><?php echo number_format($exp_amounts,2); ?></td>
				<?php	
				$sub_exp_amounts = 0;
				}
				}
				?>
				<td><?php echo number_format(get_sum(restaurant,$value),2); ?></td>	
				<td><?php echo number_format(get_sum(hotel,$value),2); ?></td>	
				<td><?php echo number_format(get_sum(hall,$value),2); ?></td>	
				<td align="right"><?php echo number_format($sub_exp_amounts,2); ?></td>
					
                                        </tr>
									
                <?php 
				/////////foreach//////////////
				} ?>					
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
