<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Res Date</th>
                                            <th>Arr Date</th>
                                            <th>Name</th>
                                            <th class="hide">Accompany</th>
                                            <th class="hide">NIC</th>
                                            <th class="hide">Address</th>
                                            <th>Room</th>
                                            <th>Rent</th>
                                            <th class="hide">Purpose</th>
                                            <th class="hide">Reference</th>
                                            <th class="hide">Days</th>
                                            <th>Mobile</th>
                                            <th class="hide">Vehicle</th>
                                            <th>CO Date</th>
                                            <th>CO Time</th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				$insertSQL = "SELECT * FROM reserve where res_status = 0 order by res_id desc";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$res_id 	= $row["res_id"];
				$res_date 	= $row["res_date"];
				$arrival 	= $row["arrival"];
				$guest_name = $row["guest_name"];
				$accompany	= $row["accompany"];
				$nic		= $row["nic"];
				$address	= $row["address"];
				$room_no	= $row["room_no"];
				$rent		= $row["rent"];
				$purpose	= $row["purpose"];
				$reference	= $row["reference"];
				$total_days	= $row["total_days"];
				$mobile_no	= $row["mobile_no"];
				$vehicle_no	= $row["vehicle_no"];
				$check_out	= $row["check_out"];
				$check_out_date	= $row["check_out_date"];
						?>

                                        <tr class="odd gradeX">
                                            <td><a href="reservation_detail.php?res_id=<?php echo $res_id; ?>"><?php echo $res_id; ?></a></td>
                                            <td><?php echo $res_date; ?></td>
                                            <td><?php echo $arrival; ?></td>
                                            <td><?php echo $guest_name; ?></td>
                                            <td class="hide"><?php echo $accompany; ?></td>
                                            <td class="hide"><?php echo $nic; ?></td>
                                            <td class="hide"><?php echo $address; ?></td>
                                            <td><?php echo $room_no; ?></td>
                                            <td><?php echo $rent; ?></td>
                                            <td class="hide"><?php echo $purpose; ?></td>
                                            <td class="hide"><?php echo $reference; ?></td>
                                            <td class="hide"><?php echo $total_days; ?></td>
                                            <td><?php echo $mobile_no; ?></td>
                                            <td class="hide"><?php echo $vehicle_no; ?></td>
                                            <td><?php echo $check_out_date; ?></td>
											<td><?php echo $check_out; ?></td>
                                            <td>
											<a href="oservices.php?res_id=<?php echo $res_id; ?>" title="Services">
											<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list fa-fw"></i>
											</button>
											</a>
											<a href="orders.php?res_id=<?php echo $res_id; ?>" title="Order"> 
											<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-building fa-fw"></i>
											</button>
											</a></td>
                                            <td align="center"><a href="reservation.php?res_id=<?php echo $res_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  <a href="#" class="delete_class<?php echo $res_id; ?>" id="confirm<?php echo $res_id; ?>" value="<?php echo $res_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a>
											&nbsp;  <a href="print_res.php?res_id=<?php echo $res_id; ?>" title="Print"> <img src="img/print.png" alt="HMS" /></a>
											</td>
										</tr>
                                        
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $res_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_reserve.php?res_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="reservation.php";
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
                           
                        