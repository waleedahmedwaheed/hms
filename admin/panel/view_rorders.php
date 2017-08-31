<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Room</th>
                                            <th>Waiter</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Extra Charges</th>
                                            <th>Discount</th>
                                            <th>Bill</th>
                                            <th></th>
											<th width="20%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
						<?php
				if(isset($_GET["o_id"]))
				{		
				$insertSQL = "SELECT * FROM `order` where status = '0' and o_id = '".$_GET["o_id"]."' and res_id <> 0";
				}
				else
				{
				$insertSQL = "SELECT * FROM `order` where status = '0' and res_id <> 0";	
				}
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
				$res_id		 = $row["res_id"];
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(res_room,$res_id); ?></td>
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
                                            <td><a href="order_detail.php?o_id=<?php echo $o_id; ?>"> Add/View Details </a></td>
                                            <td align="center">
											<?php if($res_id<>0){ ?>
											<a href="orders.php?o_id=<?php echo $o_id; ?>&res_id=<?php echo $res_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											<?php } else { ?>
											<a href="orders.php?o_id=<?php echo $o_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											<?php } ?>
											&nbsp;&nbsp;  <a href="#" class="delete_class<?php echo $o_id; ?>" id="confirm<?php echo $o_id; ?>" value="<?php echo $o_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											&nbsp;&nbsp;  <a href="print_order.php?o_id=<?php echo $o_id; ?>" title="Print"> <img src="img/print.png" alt="HMS" /></a> </td>
                                        </tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $o_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_order.php?o_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="rorders.php";
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
                           
                       