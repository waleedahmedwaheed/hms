<?php require_once('../../conn/db.php');
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
                            
							<div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dish Type</th>
                                            <th>Cuisine</th>
                                            <th>Name</th>
                                            <th>Price</th>
 											<th width="20%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				if(isset($_GET["mc_id"]))
				{
				$insertSQL = "SELECT * FROM items where mc_id='".$_GET["mc_id"]."' and i_status = 0";	
				}
				else
				{									 
				$insertSQL = "SELECT * FROM items where i_status = 0";
				}
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$i_id = $row["i_id"];
				$cs_id = $row["cs_id"];
				$mc_id = $row["mc_id"];
				$i_name = $row["i_name"];
				$i_price = $row["i_price"];
				$i_status = $row["i_status"];
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(category,$mc_id); ?></td>
                                            <td><?php echo get_title(cuisine,$cs_id); ?></td>
                                            <td><?php echo $i_name; ?></td>
                                            <td><?php echo number_format($i_price,2); ?></td>
                                            <td align="center"><a href="items.php?i_id=<?php echo $i_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  
											<a href="#" class="delete_class<?php echo $i_id; ?>" id="confirm<?php echo $i_id; ?>" value="<?php echo $i_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											</td>
										</tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $i_id; ?>', 'click', function(){
					
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
                           
                       