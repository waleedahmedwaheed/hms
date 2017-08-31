<style>
@media print{    
  font-size:xx-small
}
</style>
<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 
 
 $o_id = $_GET["o_id"];
 
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
				
				
				$insertsSQL = "SELECT * FROM `order` where `o_id` = '$o_id'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resulto = mysql_query($insertsSQL, $dbconfig) or die(mysql_error());	 
				$rowo = mysql_fetch_assoc($Resulto);
				
				$tbl_id		 = $rowo["tbl_id"];
				$date		 = $rowo["date"];
				$waiter		 = $rowo["waiter"];
				$time		 = $rowo["time"];
				$bill		 = $rowo["bill"];
				$extra		 = $rowo["extra"];
				$discount	 = $rowo["discount"];
				
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
	<th align="center"> <h3> Restaurant <?php echo $r_name; ?> </h3> </th>
	</tr>
	<tr>
	<th align="center"> <h4> Telephone #: <?php echo $phone; ?>   </h4>
	<span style="float:right;padding-bottom:2px;padding-right: 2px;"> <b> Date : </b> <?php echo date("Y-m-d"); ?>  <?php echo date("h:i:sa"); ?></span>
											</th>
	</tr>

	</thead>
</table>

<table cellpadding="3" id="printTable">
	
	<tbody>
	<tr style="border: 2px solid black;">
		<td nowrap><b>Item Name</b></td>
		<td style="text-align:center;"><b>Qty</b></td>		
		<td style="text-align:center;"><b>Price</b></td>
		<td style="text-align:right;"><b>Amount</b></td>
	</tr>
	
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
	
	<tr>
		<td><?php echo get_title(item,$i_id); ?></td>
		<td style="text-align:center;"><?php echo $quantity; ?></td>		
		<td style="text-align:center;"><?php echo $price; ?></td>
		<td style="text-align:right;"><?php echo number_format($price,2); ?></td>
	</tr>
	
				<?php  
		$qty = $qty + $quantity;		
		$tot_price = $tot_price + $price;		
		} ?>
	<tr>
		<td><b>Total</b></td>		
		<td style="text-align:center;border-top: 2px solid black;"><b><?php echo $qty; ?></b></td>		
		<td> &nbsp; </td>		
		<td style="text-align:right;border-top: 2px solid black;"><b><?php echo number_format($tot_price,2); ?></b></td>		
	</tr>
	
	
	
	<tr>
		<td colspan="3"><b>Service Charges:</b></td>		
		<td style="text-align:right;"><b><?php 
		if($tot_price>500)
		{
		$sv_charges = 0.05 * $tot_price;
		echo $sv_charges = number_format($sv_charges,2); 
		}
		else
		{
		 $sv_charges = 0;	
		 echo $sv_charges = number_format($sv_charges,2);
		}
		?></b></td>		
	</tr>
		
	<tr>
		<td colspan="3"><b>Extra Charges:</b></td>		
		<td style="text-align:right;"><b><?php echo $extra = number_format($extra,2); ?></b></td>		
	</tr>
	
	
	
	<tr>
		<td colspan="3"><b>Discount:</b></td>		
		<td style="text-align:right;"><b><?php echo $discount = number_format($discount,2); ?></b></td>		
	</tr>
	
	
	
	<?php
	///total
	$total = ($tot_price + $extra + $sv_charges) - ($discount);
	?>
	
	<tr>
		<td colspan="3" style="border-top: 2px solid black;"><b>Net Total Rs:</b></td>		
		<td style="text-align:right;border-top: 2px solid black;"><b><?php echo number_format($total,2); ?></b></td>		
	</tr>
	
	
	
	<tr>
		<td colspan="4" style="text-align:center;"><p>Hope to see you Soon <br> Thank You for your visit </p></td>		
	</tr>
	
	<tr>
		<td><b>Waiter</b></td>		
		<td><?php echo get_title(username,$waiter); ?></td>		
		<td><b>Table</b></td>		
		<td><?php echo get_title(table,$tbl_id); ?></td>		
	</tr>
	
	<tr>
		<td><b>Status</b></td>		
		<td><?php switch($bill)
											{
													case 0:
													echo "Unpaid";
													break;
													case 1:
													echo "Paid";
													break;	
											}	
											?></td>		
		<td><b> </b></td>		
		<td><?php //echo $qty; ?></td>		
	</tr>
	
</tbody>
</table>
</div>

</body>
</html>