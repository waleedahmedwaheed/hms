<?php require_once('../../conn/db.php');
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
                            
							<div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th class="hide">Quantity</th>
                                            <th>Stock In</th>
                                            <th>Stock Out</th>
                                            <th width="20%" class="hide"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				if(isset($_GET["st_id"]))
				{
				$insertSQL = "SELECT * FROM stock where st_id='".$_GET["st_id"]."'";	
				}
				else
				{									 
				$insertSQL = "SELECT SUM(IFNULL(i_quantity, 0)) as i_quantity,i_id FROM stock group by i_id";
				}
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$i_id = $row["i_id"];
				//$st_id = $row["st_id"];
				$i_quantity = $row["i_quantity"];
				?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(item,$i_id); ?></td>
                                            <td class="hide"><?php echo $i_quantity; ?></td>
											<td><?php $stk_in =  get_title(stock_in,$i_id); 
											if($stk_in==null)
											{
												echo $i_quantity;
											} 
											else 
											{
												echo $stk_in;
											}
											
											?></td>
											<td><?php 
											$stk_out = get_title(stock_out,$i_id);
											if($stk_out==null)
											{
												echo "0";
											} 
											else 
											{
												echo $stk_out;
											}
											?></td>
                                            <td align="center" class="hide">
											<!--<a href="stock.php?st_id=<?php echo $st_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  
											<!--<a href="#" class="delete_class<?php echo $st_id; ?>" id="confirm<?php echo $st_id; ?>" value="<?php echo $st_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											--></td>
										</tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $st_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_items.php?i_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="items.php";
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
                           
                       