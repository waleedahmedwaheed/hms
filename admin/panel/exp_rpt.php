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
						<?php 
					if(isset($_POST["submit"]))
						{	
						?>
						<div id="txtHint" style="margin-top:20px;">
							
							
<button type="submit" style="float:right;" onclick="tableToExcel('dataTables-example', 'Expense Report')" ><img src="img/xls.png" title="Convert To Exel" width=25> </button>	
<button style="float:right;"  onclick="printContent('print')"><img src="img/print.png" title="Print" width=25></button>
							<div class="dataTable_wrapper" id="print">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='50' data-order='[[2, "desc"]]'>
                                    <thead>
									
									<tr>

							<td colspan="6" style="text-align:center"><b style="font-size: 20px;"> Expenses </b></td> 
							
							</tr>
							
                                        <tr>
							<th width="3%" > # </th>			
							<th width="10%" nowrap> Date </th>			
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
						<td width="3%"> <?php echo $i = $i + 1; ?> </td>
						<td width="10%" nowrap><?php echo date("jS F, Y", strtotime("$value")); ?></td>
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
				$col_sub_total = $col_sub_total + $exp_amounts;
				
				}
				///////inner foreach///////////
				}
				?>
				<td align="right"><?php echo number_format($sub_exp_amounts,2); ?></td>
				<?php $sub_exp_amounts = 0; ?>	
                </tr>
				<?php 
				/////////foreach//////////////
				} ?>			
				<tr class="odd gradeX">
					<th colspan="2"> Sub Total </th>
					<?php
					foreach($arr_ei_id as $value_ei_id)
				{
					?>
					<td align="left"><b><?php echo number_format(get_exp(exp_amt,$date_from,$date_to,$value_ei_id),2); ?></b></td>
				<?php
				}
				?>
					<td align="right"><b><?php echo number_format($col_sub_total,2); ?></b></td>
				</tr>	
                                     </tbody>
                                </table>
                            </div>
							
							
							</div>
						<?php } ?>	
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
