<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>

                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="20%">Hall ID</th>
                                            <th>Name</th>
											<th width="20%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				$insertSQL = "SELECT * FROM halls where hl_status = 0";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$hl_id 		 = $row["hl_id"];
				$hl_name	 = $row["hl_name"];
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $hl_id; ?></td>
                                            <td><?php echo $hl_name; ?></td>
                                            <td align="center"><a href="halls.php?hl_id=<?php echo $hl_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  <a href="#" class="delete_class<?php echo $hl_id; ?>" id="confirm<?php echo $hl_id; ?>" value="<?php echo $hl_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											</td>
                                        </tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $hl_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_hall.php?hl_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="halls.php";
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
                           
                       