<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>CNIC</th>
                                            <th>Phone</th>
                                            <th class="hide">Persons</th>
                                            <th class="hide">% per head</th>
                                            <th class="hide">Other Detail</th>
                                            <th class="hide">Other Amount</th>
                                            <th>Date</th>
                                            <th class="hide">Time in - out</th>
                                            <th> </th>
                                            <th class="hide"> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				if(isset($_GET["bh_id"]))
				{									 
				$insertSQL = "SELECT * FROM booking_hall where bh_status = 0 and bh_id='$bh_id' order by bh_id desc";
				}
				else
				{									 
				$insertSQL = "SELECT * FROM booking_hall where bh_status = 0 order by bh_id desc";
				}
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$bh_id = $row["bh_id"];
				$hl_id = $row["hl_id"];
				$tax = $row["tax"];
				$discount = $row["discount"];
				$time_in = $row["time_in"];
				$time_out = $row["time_out"];
				$entry_date = $row["entry_date"];
				$cus_name = $row["cus_name"];
				$cus_cnic = $row["cus_cnic"];
				$cus_phone = $row["cus_phone"];
				
				$mn_desc = get_title(menu,$mn_id);
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $bh_id; ?></td>
                                            <td><?php echo $cus_name; ?></td>
                                            <td><?php echo $cus_cnic; ?></td>
                                            <td><?php echo $cus_phone; ?></td>
                                             <?php  $myArray = explode('#', $mn_desc);	
						foreach ($myArray as $item) {
							$resultstr[] = get_title(item,$item);
						 } 
						 array_shift($resultstr); ///skip 1st element//
						 $result = implode(",",$resultstr); //remove last comma//
						 //echo $result;
						 
											?>
                                            <td class="hide"><?php echo $total_person; ?></td>
                                            <td class="hide"><?php echo $head_rate; ?></td>
                                            <td class="hide"><?php echo $other_desc; ?></td>
                                            <td class="hide"><?php echo $other_rate; ?></td>
                                            <td><?php echo date("jS F, Y", strtotime("$entry_date")); ?></td>
                                            <td class="hide"><?php echo $time_in."--".$time_out; ?></td>
                                            <td class="hide"><a href="oservices.php?bh_id=<?php echo $bh_id; ?>"> Add/View Services </a></td>
                                            <td nowrap align="center"><a href="bookings.php?bh_id=<?php echo $bh_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;  <a href="#" class="delete_class<?php echo $bh_id; ?>" id="confirm<?php echo $bh_id; ?>" value="<?php echo $bh_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a>
											&nbsp;  <a href="print_hbill.php?bh_id=<?php echo $bh_id; ?>" title="Print"> <img src="img/print.png" alt="HMS" /></a> </td>
											<td><a href="booking_details.php?bh_id=<?php echo $bh_id; ?>">Add Detail</a></td>
										</tr>
                                        
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $bh_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_booking.php?bh_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="bookings.php";
                    });
                }
            });
			
                        } else if (type === 'no') {
                            /* Lobibox.notify('info', {
                                msg: 'You have clicked "No" button.'
                            }); */
                        }
                    }
                });
				
				


		});
		
									</script>
                       
					   <?php } ?>					
                                     </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                       