<?php require_once('../../conn/db.php');
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
                            
							<div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th width="20%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				if(isset($_GET["ei_id"]))
				{
				$insertSQL = "SELECT * FROM exp_items where ei_id='".$_GET["ei_id"]."' and ei_status=0";	
				}
				else
				{									 
				$insertSQL = "SELECT * FROM exp_items where ei_status=0";
				}
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$ei_id = $row["ei_id"];
				$ei_name = $row["ei_name"];
				?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo $ei_name; ?></td>
                                            <td align="center"><a href="exp_items.php?ei_id=<?php echo $ei_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  
											<a href="#" class="delete_class<?php echo $ei_id; ?>" id="confirm<?php echo $ei_id; ?>" value="<?php echo $ei_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											</td>
										</tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $ei_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_expitems.php?ei_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="exp_items.php";
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
                           
                       