<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 
 
 $res_id = $_GET["res_id"];
 
 $insertSQL = "SELECT * FROM restaurant limit 1 ";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
				$r_id 		 = $row["r_id"];
				$r_name	 	 = $row["r_name"];
				$phone	 	 = $row["phone"];
				$mobile	 	 = $row["mobile"];
				$email	 	 = $row["email"];
				$address	 = $row["address"];

				 
		$insertSQL = "SELECT * FROM reserve where res_id = '".$_GET["res_id"]."' and res_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
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
				
date_default_timezone_set("Asia/Karachi");				
				
?>

<!DOCTYPE html>
<html lang="en">

<head>


     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin HMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
table {
    font-family: arial, sans-serif;
	font-size: 10px;
    border-collapse: collapse;
    width: 45%;
	margin-left:auto; 
    margin-right:auto;
}

td {
    text-align: left;
    padding: 4px;
}

th {
    text-align: center;
    padding: 0px;
}

tr:nth-child(even) {
    background-color: #dddddd;
	line-height: 14px;
}
h3{
	font-size: 14px;
}
h4{
	font-size: 11px;
}
hr
{
	margin-top: 2px;
    margin-bottom: 2px;
}
</style>
	
	<script type="text/javascript" src="../../js/jquery.min.js"></script>

	 <script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>



</head>

<body>

<table width="45%" style="margin-left:auto;margin-right:auto;">
<tr><td>
<button style="float:right;"  onclick="printDiv('printableArea')"><img src="img/print.png" title="Print" width='25'></button>	
</td></tr>
</table>

<div id="printableArea">
<table width="45%" style="margin-left:auto;margin-right:auto;">
<thead>
	<tr>
	<th align="center"> <h3> Hotel <?php echo $r_name; ?> </h3> </th>
	</tr>
	<tr>
	<th align="center"> <h4> Telephone #: <?php echo $phone; ?> </h4>  
	<!-- <span style="text-align:left;float: left;padding-bottom:2px;padding-left: 2px;"> <?php //echo date("jS F, Y", strtotime("$res_date")); ?> </span> -->
	 <span style="text-align:left;float: left;padding-bottom:2px;padding-left: 2px;"> <?php echo date("Y-m-d");?>  <?php echo date("h:i:sa"); ?>  </span> 
	<span style="float: right;padding-bottom:2px;padding-right: 2px;"> Check Out: <?php echo date("jS F, Y", strtotime("$check_out_date")); ?> -- <?php echo date('h:i:s A',strtotime("$check_out"));  ?>   </span>  
	</th>
	
	</tr>

	</thead>
</table>

<table cellpadding="3" id="printTable">
	
	<tbody>
	
	 

                         <?php $myArray = explode('#', $mn_desc);	
						foreach ($myArray as $item) {
							$resultstr[] = get_title(item,$item);
						 } 
						 array_shift($resultstr); ///skip 1st element//
						 $result = implode(",",$resultstr); //remove last comma//
						
						 ?>
						 
	<tr>
		<td colspan="3"><b>Guest :</b><hr><b>Accompanied by:</b><hr><b>NIC:</b><hr><b>Address:</b><hr><b>Total Days:</b></td>		
		<td style="text-align:right;"><?php echo $guest_name; ?><hr><?php echo $accompany; ?><hr><?php echo $nic; ?><hr><?php echo $address; ?><hr><?php echo $total_days; ?></td>		
	</tr>
	
	
	
	<tr>
		<td colspan="3"><b>Rent per night:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($rent,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Services:</b> <br>
		<?php
		$insertSQL = "SELECT * FROM service_rec where res_id = '$res_id'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		while($rowsh = mysql_fetch_assoc($Result1))
		{
		$hs_id = $rowsh["hs_id"];
		?>
		<?php echo $j = $j+1; echo ") ".get_title(hservice,$hs_id); ?><br>
		<?php		
		}
		?>
		</td>		
		<td style="text-align:right;"> <br>
		<?php
		$insertSQL = "SELECT * FROM service_rec where res_id = '$res_id'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		while($rowsh = mysql_fetch_assoc($Result1))
		{
		$hs_id = $rowsh["hs_id"];
		$hamount = get_title(hamount,$hs_id);
		?>
		<b><?php echo $hamounts = number_format($hamount,2); ?></b><br>
		<?php	
		$tot_hamount = $tot_hamount + $hamounts; 	
		}
		?>
		</td>		
	</tr>
	
<?php
		//echo $rent;
		$tot_price = ($total_days * $rent);
		//echo $tot_price."priceeeee";

?>	
	<tr>
		<td colspan="3"><b>Service Charges:</b></td>		
		<td style="text-align:right;"><b><?php 
		if($tot_price>500)
		{
		//$sv_charges = 0.05 * $tot_price;
		$sv_charges = 0;
		echo $sv_charges = number_format($sv_charges,2); 
		}
		?></b></td>		
	</tr>
	
	
	<tr>
		<td colspan="3"><b>Restaurant Charges:</b></td>		
		<td style="text-align:right;"><b><?php 
		$insertSQL = "SELECT * FROM `order` c where c.res_id = '".$res_id."' ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		while($row = mysql_fetch_assoc($Result1))
		{
		$o_id 		= $row["o_id"];
		$bill 		= $row["bill"];
		$extras		= $row["extra"];
		$discounts 	= $row["discount"];
		
		$selectSQL = "SELECT * FROM `order_detail` where o_id = '".$o_id."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Results = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
		while($rows = mysql_fetch_assoc($Results))
		{
		$price 		= $rows["price"];
		$total_price 	= $total_price + $price;
		}
		
		$tot_extra 		= $tot_extra + $extras;
		$tot_discount 	= $tot_discount + $discounts;
		
		
		}
		
		/* echo $tot_extra;
		echo "//";
		echo $tot_discount;
		echo "//";
		echo $total_price; */
		
		$res_total_amt = ($total_price + $tot_extra) - $tot_discount;
		
		if($res_total_amt>500)
		{
		$sv_charges_res = 0.05 * $res_total_amt;
		//echo $sv_charges_res = number_format($sv_charges_res,2); 
		}
		else 
		{
		$sv_charges_res = 0;
		}
		
		$res_total = $res_total_amt + $sv_charges_res;
		
		echo number_format($res_total,2);
		?></b></td>		
	</tr>
	
	
	
	<?php
	//////total
	$total = $tot_price + $sv_charges + $hamount + $res_total;
	
	?>
	
	<tr>
		<td colspan="3" style="border-top: 2px solid black;"><b>Net Total Rs:</b></td>		
		<td style="text-align:right;border-top: 2px solid black;"><b><?php echo number_format($total,2); ?></b></td>		
	</tr>
	
	
	
	<tr>
		<td colspan="4" style="text-align:center;"><p>Hope to see you Soon <br> Thank You for your visit </p></td>		
	</tr>
	
	
	<tr>
		<td colspan="4"> &nbsp; </td>	
	</tr>
	
</tbody>
</table>
</div>

</body>
</html>