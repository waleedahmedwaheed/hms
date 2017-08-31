<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 
 $bd_id = $_GET["bd_id"];
 ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
 
 <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Name</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    <tbody>
									                 <?php
				$insertSQL = "SELECT * FROM `service_rec` where bd_id = '$bd_id'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$sr_id 		 = $row["sr_id"];
				$hs_id		 = $row["hs_id"];
				$bd_id		 = $row["bd_id"];
				$res_id		 = $row["res_id"];
						?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $mc = $mc + 1; ?></td>
                                            <td><?php echo get_title(hservice,$hs_id); ?></td>
                                            <td align="center">
											<?php if($res_id<>0){ ?>
											<a href="oservices.php?sr_id=<?php echo $sr_id; ?>&res_id=<?php echo $res_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											<?php } else { ?>
											<a href="oservices.php?sr_id=<?php echo $sr_id; ?>&bd_id=<?php echo $bd_id; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											<?php } ?>
											&nbsp;  <a href="#" class="delete_class<?php echo $sr_id; ?>" id="confirm<?php echo $sr_id; ?>" value="<?php echo $sr_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a>
											</td>
                                        </tr>
										
										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $sr_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
				var bd_id = <?php echo $bd_id; ?>;
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_oservices.php?sr_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="oservices.php?bd_id=<?php echo $bd_id; ?>";
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