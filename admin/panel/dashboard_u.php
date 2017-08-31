   <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Dashboard</h1>
                </div>
				<div class="col-lg-12">
                    <marquee behavior="alternate"><h4 style="color:red;">*** Hotel Hillock - Mansehra ***</h4></marquee>
					<hr style="margin-top: -8px;">
				</div>
				<!-- /.col-lg-12 -->
            </div>
			
  <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="upload/res.png" height="60" width="60">
                                </div>
                                <div class="col-xs-2 text-right">
                                    <div class="huge"> Restaurant </div>
                                    <div> </div>
                                </div>
                            </div>
                        </div>
                        <a href="orders.php">
                            <div class="panel-footer">
                                <span class="pull-left">Order</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <img src="upload/order.jpg" height="60" width="60">
                                </div>
                                <div class="col-xs-2 text-right">
                                    <div class="huge"> Hall </div>
                                    <div> </div>
                                </div>
                            </div>
                        </div>
                        <a href="bookings.php">
                            <div class="panel-footer">
                                <span class="pull-left">Booking</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img src="upload/active.jpg" height="60" width="60">
                                </div>
                                <div class="col-xs-2 text-right">
                                    <div class="huge"> Hotel </div>
                                    <div> </div>
                                </div>
                            </div>
                        </div>
                        <a href="reservation.php">
                            <div class="panel-footer">
                                <span class="pull-left">Reservation</span>
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
                    <div class="panel panel-default hide">
                        
						<div id="containers" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        
						<div id="containers3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						
                    </div>
                   
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                    <div class="panel panel-default hide">
                        
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
						
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
			
			<div class="row hide">
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
			
			