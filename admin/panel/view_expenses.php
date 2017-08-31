<?php require_once('../../conn/db.php');
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
                            
							<div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th width="20%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				if(isset($_GET["exp_id"]))
				{
				$insertSQL = "SELECT * FROM expenses where exp_id='".$_GET["exp_id"]."' and exp_status=0";	
				}
				else
				{									 
				$insertSQL = "SELECT * FROM expenses where exp_status=0";
				}
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$exp_id = $row["exp_id"];
				$ei_id = $row["ei_id"];
				$exp_amount = $row["exp_amount"];
				$exp_date = $row["exp_date"];
				?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(exp_item,$ei_id); ?></td>
                                            <td><?php echo $exp_date; ?></td>
                                            <td><?php echo number_format($exp_amount,2); ?></td>
                                            <td align="center"><a href="expenses.php?exp_id=<?php echo $exp_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  
											<a href="#" class="delete_class<?php echo $exp_id; ?>" id="confirm<?php echo $exp_id; ?>" value="<?php echo $exp_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											</td>
										</tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $exp_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_expenses.php?exp_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="expenses.php";
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
                           
                       