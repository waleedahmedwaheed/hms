<?php require_once('../../conn/db.php');
 require_once('../../functions.php'); ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
                            
							<div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th width="20%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				if(isset($_GET["he_id"]))
				{
				$insertSQL = "SELECT * FROM hall_exp where he_id='".$_GET["he_id"]."' and bh_id='".$_GET["bh_id"]."' and exp_status=0";	
				}
				else
				{									 
				$insertSQL = "SELECT * FROM hall_exp where bh_id='".$_GET["bh_id"]."' and exp_status=0";
				}
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$he_id = $row["he_id"];
				$exp_desc = $row["exp_desc"];
				$exp_price = $row["exp_price"];
				$bh_id = $row["bh_id"];
				?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo $exp_desc; ?></td>
                                            <td><?php echo $exp_price; ?></td>
											<td align="center"><a href="hall_exp.php?he_id=<?php echo $he_id; ?>&bh_id=<?php echo $bh_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;&nbsp;  
											<a href="#" class="delete_class<?php echo $he_id; ?>" id="confirm<?php echo $he_id; ?>" value="<?php echo $he_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a> 
											</td>
										</tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $he_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_exp.php?he_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="hall_exp.php?bh_id=<?php echo $bh_id; ?>";
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
                           
                       