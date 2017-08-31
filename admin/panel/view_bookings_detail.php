<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 
 $bh_ids = $_GET["bh_id"];
 ?>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>


<script type="text/javascript">
$(document).ready(function()
{
$(".pcl_button").click(function(){

var element = $(this);
var I = element.attr("id");

$("#slidepanel"+I).slideToggle(300);
$(this).toggleClass("active"); 

return false;});});
</script>
<style type="text/css">
	.paneltest
	{
		display:none;
	}
	
</style>


                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Hall</th>
                                            <th>Persons</th>
                                            <th>Time in - out</th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									                 <?php
				$selectSQL = "SELECT * FROM booking_detail c,booking_hall d where c.bh_id='".$bh_ids."' and c.bd_status = 0 and c.bh_id=d.bh_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{
				$bd_id = $row["bd_id"];
				$bh_id = $row["bh_id"];
				$hl_id = $row["hl_id"];
				$mn_id = $row["mn_id"];
				$total_person = $row["total_person"];
				$head_rate = $row["head_rate"];
				$other_desc = $row["other_desc"];
				$other_rate = $row["other_rate"];
				$time_in = $row["time_in"];
				$time_out = $row["time_out"];
				$b_date = $row["b_date"];
				$tax = $row["tax"];
				$discount = $row["discount"];
				$advance = $row["advance"];
				$total = $row["total"];
				$options = $row["options"];
				$per_person = $row["per_person"];
				
				$new_total = ($total + $tax) - ($advance + $discount);
				
				$mn_desc = get_title(menu,$mn_id);
				$mn_rate = get_title(mn_rate,$mn_id);
				$mn_person = get_title(mn_person,$mn_id);
				
				$selectSQL = "SELECT * FROM service_rec where bd_id='".$bd_id."'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Results = mysql_query($selectSQL, $dbconfig) or die(mysql_error());
				while($rows = mysql_fetch_assoc($Results))
				{
					$hs_id = $rows["hs_id"];
					$hamount = get_title(hamount,$hs_id);
					$hamount_total = $hamount_total + $hamount;
					$hs_name_arr[] = get_title(hservice,$hs_id);
				}
				
				if($options==1)
				{
				$menu_amt_tax = $mn_rate * ($mn_person/100); // tax //
				$menu_amount = $mn_rate + $menu_amt_tax; // added tax //
				$menu_pers_amt = $menu_amount * $total_person; // total person //
				$menu_total = $menu_total + $menu_pers_amt; // menu total //
				}
				else
				{
				$menu_pers_amt = $per_person * $total_person;	
				$menu_total = $menu_total + $menu_pers_amt;	
				}
				
				$total_amt = $menu_total + $hamount_total + $other_rate; // total //
				//echo $menu_amt_tax."//".$menu_amount."//".$menu_pers_amt."//".$menu_total."//".$hamount_total;
				
				
						?>

                                        <tr class="odd gradeX">
                                            <td><input type="button" onclick="changeValue(this.value,this.id)"  value="+"  class="pcl_button" id="<?php echo $bd_id; ?>" /></td>
                                            <td nowrap><?php echo date("jS F, Y", strtotime("$b_date")); ?></td>
                                            <td><?php echo get_title(hall,$hl_id); ?></td>
                                            <td><?php echo $total_person; ?></td>
                                            <td><?php echo date('h:i:s A',strtotime("$time_in"))." -- ".date('h:i:s A',strtotime("$time_out")); ?></td>
											
                                            <td><a href="oservices.php?bd_id=<?php echo $bd_id; ?>"> Add/View Services </a></td>
                                            <td nowrap align="center"><a href="booking_details.php?bh_id=<?php echo $bh_id; ?>&bd_id=<?php echo $bd_id; ?>&opt=<?php echo $options; ?>" title="Edit"> <img src="img/edit.gif" alt="HMS" /></a>
											&nbsp;  <a href="#" class="delete_class<?php echo $bd_id; ?>" id="confirm<?php echo $bd_id; ?>" value="<?php echo $bd_id; ?>"  title="Delete" > <img src="img/delete.png" alt="HMS" /></a>
											<!-- &nbsp;  <a href="delete_booking_details.php?bd_id=<?php echo $bd_id; ?>&bh_id=<?php echo $bh_id; ?>" title="Delete" > <img src="img/delete.png" alt="HMS" /></a>
										 --> </td>
                                        </tr>
                                        
										  <tr class='paneltest' id="slidepanel<?php echo $bd_id; ?>" >

                      
<td id="<?php echo $bd_id; ?>" colspan="8"> <!-- Print Voucher -->

<table class="table table-striped table-bordered table-hover">

	<tbody>

	<tr class="info">
		<th width="20%">Booking Date</th>
		<td><?php echo date("jS F, Y", strtotime("$b_date")); ?></td>
	</tr>
	
	<?php if($options==1){ ?>
	
	<tr class="danger">
		<th>Menu </th>
		<td><?php  $myArrays = explode('#', $mn_desc);	
						foreach ($myArrays as $items) {
							$resultstrs[] = get_title(item,$items);
						 } 
						 array_shift($resultstrs); ///skip 1st element//
						 $result_menu = implode(",",$resultstrs); //remove last comma//
						 echo $result_menu; ?></td>
	</tr>
	<tr class="success">
		<th>Menu Rate + Per Head</th>
		<td><?php echo number_format($mn_rate,2)." + ".$mn_person."% Per Head"; ?></td>
	</tr>
	
	<?php } else { ?>
	<tr class="succees">
		<th>Per Person</th>
		<td><?php echo $per_person; ?></td>
	</tr>
	<?php } ?>
	<tr class="warning">
		<th>Other Detail</th>
		<td><?php echo $other_desc; ?></td>
	</tr>
	<tr class="info">
		<th>Other Rate</th>
		<td><?php echo number_format($other_rate,2); ?></td>
	</tr>
	<tr class="danger">
		<th>Services</th>
		<td><?php $hs_names = implode(",",$hs_name_arr);
			echo $hs_names; ?></td>
	</tr>
	
	<?php if($options==1){ ?>
	<tr>
		<th>Menu Charges</th>
		<td align="right"><?php echo number_format($menu_amount,2); ?></td>
	</tr>
	<?php } ?>
	<tr>
		<th>Person Charges</th>
		<td align="right"><?php echo number_format($menu_pers_amt,2); ?></td>
	</tr>
	<tr>
		<th>Service Charges</th>
		<td align="right"><?php echo number_format($hamount_total,2); ?></td>
	</tr>
	<tr>
		<th>Total Charges</th>
		<td align="right"><b><?php 
		$total_hall = $menu_total + $hamount_total + $other_rate;
		
		echo number_format($total_hall,2); ?></b></td>
	</tr>

</tbody>
	</table>	 				  

</td>
</tr>	

										<script>
									
									 //$('.delete_class').click(function(){
										 
//				$(document).on("click", ".delete_class<?php echo $mc_id; ?>", function(event){
				$(document).delegate('.delete_class<?php echo $bd_id; ?>', 'click', function(){
					
//		$('.delete_class<?php echo $mc_id; ?>').bind('click', function(event){
		
				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');	
				var bh_id = <?php echo $bh_id; ?>;	
				//alert(del_id);	
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete_booking_details.php?bd_id="+ del_id +"&bh_id="+ bh_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="booking_details.php?bh_id=<?php echo $bh_id; ?>";
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
                       
					 

					   <?php 
		$final_total = $final_total + $total_hall;
		$menu_amount = 0;			   
		$menu_pers_amt = 0;	
		$hamount_total = 0;	
		$total_hall = 0;	
		$menu_total = 0;	
		unset($hs_name_arr); 
		unset($myArrays); 
		unset($resultstrs); 
		unset($result_menu); 
		  
		  
					   } 
	//echo $total;
	//echo $final_total;
	if($final_total<>$total)
	{		
	$updateSQL = "Update booking_hall set total = '$final_total' where bh_id = '$bh_id'";
	//echo $updateSQL;
	//exit;
	mysql_select_db($database_dbconfig, $dbconfig);
	$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
	//header('Location: booking_details.php?bh_id=$bh_id');
	echo "<script type='text/javascript'> window.location='booking_details.php?bh_id=$bh_id' </script>";	
	}
					 ?>		
									
									
					   
                                     </tbody>
									  
									 <tr>
									<td colspan="7"> &nbsp; </td>
									</tr>
									
									 <tr>
									<td colspan="6">
									<b style="font-size: 16px;">Total</b>
									</td>
									<td><b style="font-size: 16px;"><?php echo number_format($final_total,2)." Rs"; ?></b></td>
									</tr>
									<tr>
									<td colspan="7">
									<?php echo convert_number_to_words($final_total)." RUPEES"; ?>
									</td> 
									</tr>
									
									
									<tr>
									<td colspan="7"> &nbsp; </td>
									</tr>
		 <table class="table table-striped table-bordered table-hover">
		 <form method="post" id="bh_detail">	
		 <tr>
		<th align="left" style="font-size: 16px;"> Tax </th>
		<td width="15%"> <input type="text" name="tax" value="<?php echo $tax; ?>" class="form-control" /> </td>
		</tr>
		<tr>
		<th align="left" style="font-size: 16px;"> Discount </th>
		<td width="15%"> <input type="text" name="discount" value="<?php echo $discount; ?>" class="form-control" /> </td>
		</tr>				
		<tr>
		<th align="left" style="font-size: 16px;"> Advance </th>
		<td width="15%"> <input type="text" name="advance" value="<?php echo $advance; ?>" class="form-control" /> </td>
		</tr>
		<tr>
		<th align="left" style="font-size: 16px;"> Expenses <a href="hall_exp.php?bh_id=<?php echo $_GET["bh_id"]; ?>" class="btn btn-success btn-circle"> Add </a>  </th>
		
		<td width="15%" style="font-size: 16px;"> <b> <?php echo number_format(get_title(hall_exp,$bh_ids),2)." Rs"; ?></b> </td>
		</tr>
		<tr>
		<th align="left" style="font-size: 16px;"> Remaining Total </th>
		<td width="15%" style="font-size: 16px;"> <b> <?php echo number_format($new_total,2)." Rs"; ?> </b> </td>
		</tr>
		
		<tr>
		<th align="left" style="font-size: 16px;"> Total - Expenses </th>
		<td width="15%" style="font-size: 16px;"> <b> <?php echo number_format($new_total-(get_title(hall_exp,$bh_ids)),2)." Rs"; ?> </b> </td>
		</tr>
		
		<input type="hidden" name="total" value="<?php echo $total_amt; ?>" class="form-control" /> 	
		<input type="hidden" name="bh_id" value="<?php echo $bh_id; ?>" class="form-control" /> 	
		<tr>
		<td align="right" colspan="2"><button type="submit" class="btn btn-primary">Update </button></td>
		</tr>
		</form>
		</table>
		
		
		
									<tr>
									<td colspan="7"> &nbsp; </td>
									</tr>
									
									
                                </table>
                            </div>
                            <!-- /.table-responsive -->
     <script>

$(document).ready(function (e) {
$("#bh_detail").on('submit',(function(e) {
e.preventDefault();
$('#response_bh').show();
$("#loader").show();
$.ajax({
url: "save_bhdetail.php",	  // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#loader").hide();
$('#bh_detail')[0].reset();
//window.location = 'add_category.php';
$("#response_bh").html(data);

}
});

}));
});

</script>                      
                       