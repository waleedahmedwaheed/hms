<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 
 $o_id = $_GET["o_id"];
 ?>
 
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
 
 <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    <tbody>
									                 <?php
				$insertSQL = "SELECT * FROM `order_detail` where or_status = '0' and o_id = '$o_id'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$o_id 		 = $row["o_id"];
				$or_id		 = $row["or_id"];
				$quantity	 = $row["quantity"];
				$price		 = $row["price"];
				$mc_id		 = $row["mc_id"];
				$i_id		 = $row["i_id"];
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(item,$i_id); ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td align="center"><a href="order_detail.php?o_id=<?php echo $o_id; ?>&or_id=<?php echo $or_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;
										<a href="#" class="delete_class<?php echo $or_id; ?>" id="confirm<?php echo $or_id; ?>" value="<?php echo $or_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a>											
										</td>
                                        </tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $or_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
				var o_id = <?php echo $o_id; ?>;
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_odetail.php?or_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="order_detail.php?o_id=<?php echo $o_id; ?>";
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