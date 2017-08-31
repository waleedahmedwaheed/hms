<?php //include("../../functions.php"); ?>
		


 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Dashboard</h1>
                </div>
				<div class="col-lg-12">
                    <marquee behavior="alternate"><h4 style="color:red;">*** Hotel Hillock - Mansehra ***</h4></marquee>
					<hr style="margin-top: -8px;">
				</div>
				<!-- /.col-lg-12 -->
            </div>
			
			
			<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="upload/order.jpg" height="60" width="60">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo get_count(t_porder); ?></div>
                                    <div>Pending Order</div>
                                </div>
                            </div>
                        </div>
                        <a href="rec_orders.php?id=1">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <img src="upload/order.jpg" height="60" width="60">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo get_count(t_order); ?></div>
                                    <div>Total Order</div>
                                </div>
                            </div>
                        </div>
                        <a href="rec_orders.php?id=2">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="upload/active.jpg" height="60" width="60">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo get_count(active); ?></div>
                                    <div>Active Tables</div>
                                </div>
                            </div>
                        </div>
                        <a href="rec_orders.php?id=3">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="upload/inactivetb.jpg" height="60" width="60">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo get_count(inactive); ?></div>
                                    <div>Inactive Tables</div>
                                </div>
                            </div>
                        </div>
                        <a href="rec_orders.php?id=4">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			
			<!------------------------------------------------------>
			
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        
						<div id="containers" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        
						<div id="containers3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						
                    </div>
                   
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        
						<div id="container2" style="height: 400px"></div>
						
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        
						<div class="panel-heading">
                            Daily Record
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr class="success">
                                            <td>Restaurant Orders</td>
                                            <th><?php echo get_count(cur_orders); ?></th>
										</tr>
                                        <tr class="info">
                                            <td>Hall Bookings</td>
                                            <th><?php echo get_count(cur_bookings); ?></th>
                                        </tr>
                                        <tr class="warning">
                                            <td>Room Reservations</td>
                                            <th><?php echo get_count(cur_reserve); ?></th>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
						
						<div class="panel-heading">
                            Daily Income & Expenses
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
										<tr class="danger">
                                            <td>Opening Balance</td>
                                            <th><?php  
							$open_restaurant 	=  get_sum(open_restaurant,$ddate);
							 $open_hotel			=  get_sum(open_hotel,$ddate);
							 $open_hall 			=  get_sum(open_hall,$ddate);
							 $open_expense 			= get_sum(open_expense,$ddate);
							$open_income = $open_restaurant + $open_hotel + $open_hall;
							$open_bal = $open_income - $open_expense; 
							echo number_format($open_bal,2);
							?></th>
										</tr>
										<tr class="warning">
                                            <td>Closing Balance</td>
                                            <th>
							<?php
				$arr = list_days($date_from_,$date_to_);
				
				foreach($arr as $value)
				{			
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
				
				$exp_sub_total__ = $exp_sub_total__ + $exp_sub_total;
				$net_sub_total = $net_sub_total + $net_total;
				
				$sub_exp_amounts = 0;
				$exp_sub_total = 0;
				$exp_total = 0;
				$net_total = 0;
				
				}
				$net_sub_total__ = $col_sub_total - $exp_sub_total__;
				echo number_format($net_sub_total__,2);
							?>	
											</th>
										</tr>	
                                        <tr class="success">
                                            <td>Income</td>
                                            <th><?php 
											
				/* $ordSQL = "SELECT COALESCE(SUM(price),0) as price,COALESCE(SUM(extra),0) as extra FROM `order_detail` c,`order` d where c.or_status = '0' 
				and c.o_id=d.o_id and `date` = '".date('Y-m-d')."'";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultord = mysql_query($ordSQL, $dbconfig) or die(mysql_error());	 
				$roword = mysql_fetch_assoc($Resultord);
				
				$price_ord = $roword["price"];	
				$extra_ord = $roword["extra"];	
		
				$daily_ord = $price_ord + $extra_ord;
				
				////////////////////////
				
				$halldSQL = "SELECT COALESCE(SUM(total),0) as price
								FROM booking_hall
								WHERE bh_status =  '0'
								AND entry_date >= date('Y-m-d 00:00:00') AND entry_date <= date('Y-m-d 23:59:59')
								";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resulthd = mysql_query($halldSQL, $dbconfig) or die(mysql_error());	 
				$rowhd = mysql_fetch_assoc($Resulthd);
				
				$price_halld = $rowhd["price"];
				
				////////////////////////
				
				$hoteldSQL = "SELECT * FROM reserve where res_status = 0
				and entry_date >= date('Y-m-d 00:00:00') AND entry_date <= date('Y-m-d 23:59:59')";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resulthod = mysql_query($hoteldSQL, $dbconfig) or die(mysql_error());	 
		$rowhod = mysql_fetch_assoc($Resulthod);
		$res_id_d 	 = $rowhod["res_id"];
		$rent_d		 = $rowhod["rent"];
		$total_days_d = $rowhod["total_days"];
				
				if($res_id_d<>"")
				{
				$serdSQL = "SELECT * FROM service_rec where res_id = '$res_id_d'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultserd = mysql_query($serdSQL, $dbconfig) or die(mysql_error());
				while($rowserd = mysql_fetch_assoc($Resultserd))
				{
				$hs_id_d = $rowserd["hs_id"];
				$hamount_d = get_title(hamount,$hs_id_d);
				$tot_hamount_d = $tot_hamount_d + $hamount_d; 	
				} 
				}
		$tot_price_d = ($total_days_d * $rent_d);
		$sv_charges_d = 0.05 * $tot_price_d;
		$total_d = $tot_price_d + $sv_charges_d + $tot_hamount_d;
		
				 $total_d;
				 
				 /////////////////////////////////total////////////////////////
				 
				 $income = $daily_ord + $price_halld + $total_d;
				 echo number_format($income,2);*/
				
				$sub_exp_amounts = get_sum(restaurant,$ddate) + get_sum(hotel,$ddate) + get_sum(hall,$ddate);
				echo number_format($sub_exp_amounts,2);
											?></th>
										</tr>
                                        <tr class="info">
                                            <td>Expenses</td>
                                            <th><?php 
				/*$selectexSQL = "SELECT COALESCE(SUM(total_amount),0) as expense FROM waleed.expendeture where to_char(entry_date,'YYYY-MM-DD') = '$ddate'";
				$stidex = oci_parse($conn_o, $selectexSQL);
				oci_execute($stidex);
				$rowex = oci_fetch_assoc($stidex);
				
				$EXPENSE 		 = $rowex["EXPENSE"];
				echo number_format($EXPENSE,2);*/
									
									$exp_total = get_sum(expense,$ddate);
									echo number_format($exp_total,2);
											?></th>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
						
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
						<div id="container4" style="height: 400px"></div>
						
                    </div>
                </div>
				<!-- /.col-lg-12 -->
            </div>
			
        </div>
        <!-- /#page-wrapper -->

  <!-- /.row -->
            
			<!--/////////////////////////////////////////////////////////////////////////////-->
			
			