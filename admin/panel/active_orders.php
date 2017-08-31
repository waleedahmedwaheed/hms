<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Table</th>
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
                                        </tr>
										
									
                                        
				<?php } ?>					
                                     </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                       