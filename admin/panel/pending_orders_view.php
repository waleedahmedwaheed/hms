<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Table</th>
                                            <th>Waiter</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Extra Charges</th>
                                            <th>Discount</th>
                                            <th>Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
						<?php
				$insertSQL = "SELECT * FROM `order` where status = '0' and bill = '0'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$o_id 		 = $row["o_id"];
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
                                            <td><?php echo get_title(table,$tbl_id); ?></td>
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
                                         </tr>
										
									
                                        
				<?php } ?>					
                                     </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                       