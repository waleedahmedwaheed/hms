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
                    <h1 class="page-header">Balance Sheet</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Balance Sheet
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="balance_sheet.php" >
                                        
										
										
										
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
							
							
<button type="submit" style="float:right;" onclick="tableToExcel('dataTables-example', 'Balance Sheet')" ><img src="img/xls.png" title="Convert To Exel" width=25> </button>	
<button style="float:right;"  onclick="printContent('print')"><img src="img/print.png" title="Print" width=25></button>
							<div class="dataTable_wrapper" id="print">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='50' data-order='[[2, "desc"]]'>
                                    <thead>
									
									<tr>

							<td colspan="5" style="text-align:center"><b style="font-size: 20px;"> Balance Sheet </b></td> 
							
							</tr>
									
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

?>
									
							<tr>

							<td colspan="4" style="text-align:right"><b> Opening Balance <?php 
							 $open_restaurant 	=  get_sum(open_restaurant,$date_from);
							 $open_hotel			=  get_sum(open_hotel,$date_from);
							 $open_hall 			=  get_sum(open_hall,$date_from);
							 $open_expense 			= get_sum(open_expense,$date_from);
							$open_income = $open_restaurant + $open_hotel + $open_hall;
							$open_bal = $open_income - $open_expense;
							//echo number_format($open_bal,2);	?></b></td> 
							<td style="text-align:right"><b><?php echo number_format($open_bal,2)." Rs";	?></b></td>	
                            </tr>
							
                                        <tr>
							<th width="3%" > # </th>			
							<th width="10%" nowrap> Date </th>			
				<th width="15%" style="text-align:right;"> Income </th>
				<th width="15%" style="text-align:right;"> Expense </th>
				            <td width="10%" nowrap align="right"><b> Net Total </b></td>        
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
				

<?php

//print_r(list_days($date_from_,$date_to_));
$arr = list_days($date_from_,$date_to_);
				
				foreach($arr as $value)
				{ 
				?>

                                        <tr class="odd gradeX">
										<td width="3%"> <?php echo $i = $i + 1; ?> </td>
                                            <td width="10%" nowrap><?php echo date("jS F, Y", strtotime("$value")); ?></td>
                                          
				<?php 
				
				$restaurant 	= number_format(get_sum(restaurant,$value),2); 
				$hotel			= number_format(get_sum(hotel,$value),2); 
				$hall 			= number_format(get_sum(hall,$value),2); 
				
				///////////////////////income//////////////////////////
				
				$sub_exp_amounts = get_sum(restaurant,$value) + get_sum(hotel,$value) + get_sum(hall,$value);
				$col_res_total = $col_res_total + get_sum(restaurant,$value);
				$col_hotel_total = $col_hotel_total + get_sum(hotel,$value);
				$col_hall_total = $col_hall_total + get_sum(hall,$value);
				$col_sub_total = $col_sub_total + $sub_exp_amounts;
				
				////////////////expenses/////////////////////
				
				$exp_total = get_sum(expense,$value);
				$exp_sub_total = $exp_sub_total + $exp_total;
				
				/////////////////////net total/////////////////////
				
				$net_total = $sub_exp_amounts - $exp_sub_total;
				
				?>	
				<td align="right"><?php echo number_format($sub_exp_amounts,2); ?></td>
				<td align="right"><?php echo number_format(get_sum(expense,$value),2); ?></td>
				<td align="right"><?php echo number_format($net_total,2); ?></td>
					
                                        </tr>
										
                <?php 
				$exp_sub_total__ = $exp_sub_total__ + $exp_sub_total;
				$net_sub_total = $net_sub_total + $net_total;
				
				$sub_exp_amounts = 0;
				$exp_sub_total = 0;
				$exp_total = 0;
				$net_total = 0;
				/////////foreach//////////////
				} 
				
				$net_sub_total__ = $col_sub_total - $exp_sub_total__;
				?>					
									<tr class="odd gradeX">
										<th colspan="2"> Sub Total </th>
										<td align="right"><b><?php echo number_format($col_sub_total,2); ?></b></td>
										<td align="right"><b><?php echo number_format($exp_sub_total__,2); ?></b></td>
										<td align="right"><b><?php echo number_format($net_sub_total__,2); ?></b></td>
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
