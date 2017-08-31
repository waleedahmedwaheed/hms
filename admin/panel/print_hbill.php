<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 
 
 $bh_id = $_GET["bh_id"];
 
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

				 
		$insertSQL = "SELECT * FROM booking_hall where bh_id='".$_GET["bh_id"]."' and bh_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bh_id = $row["bh_id"];
		$tax = $row["tax"];
		$discount = $row["discount"];
		$advance = $row["advance"];
		$total = $row["total"];
		$entry_date = $row["entry_date"];
		$cus_name = $row["cus_name"];
		$cus_cnic = $row["cus_cnic"];
		$cus_phone = $row["cus_phone"];		 
		
		$new_total = ($total + $tax) - ($advance + $discount);
				
				
$selectSQL = "SELECT * FROM booking_detail c,booking_hall d where c.bh_id='".$bh_id."' and c.bd_status = 0 and c.bh_id=d.bh_id";
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
				$menu_pers_amts = $per_person * $total_person;	
				$menu_totals = $menu_totals + $menu_pers_amts;	
				}
				
				$final_total = $final_total + $total_hall;
		
		  
		  
				}

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
	<th align="center"> <h3> Hall <?php echo $r_name; ?> </h3> </th>
	</tr>
	<tr>
	<th align="center"> <h4> Telephone #: <?php echo $phone; ?> </h4>  </th>
	</tr>
	<tr>
	<!--<th> <span style="text-align:left;float: right;"> <?php //echo date("jS F, Y h:i:s A", strtotime("$entry_date")); ?> </span>--> 
	<th> <span style="text-align:left;float: right;"> <?php echo date("Y-m-d");?>  <?php echo date("h:i:sa"); ?> </span> 
	
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
		<td colspan="3"><b>Name</b><hr><b>CNIC</b><hr><b>Phone</b></td>		
		<td style="text-align:right;"><?php echo $cus_name; ?><hr><?php echo $cus_cnic; ?><hr><?php echo $cus_phone; ?></td>		
	</tr>
	
	<tr style="line-height: 1px;">
		<td colspan="4"> &nbsp; </td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Menu Charges:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($menu_pers_amt,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Person Charges:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($menu_totals,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Service Charges:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($hamount_total,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Other Charges:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($other_rate,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Tax:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($tax,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Discount:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($discount,2); ?></b></td>		
	</tr>
		
	<tr style="line-height: 1px;">
		<td colspan="4"> &nbsp; </td>		
	</tr>
	
	<?php
	//////total
	$totals = ($total + $tax ) - $discount;
	
	?>
	
	<tr>
		<td colspan="3" style="border-top: 2px solid black;"><b>Total Rs:</b></td>		
		<td style="text-align:right;border-top: 2px solid black;"><b><?php echo number_format($totals,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3"><b>Advance:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($advance,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="3" style="border-top: 2px solid black;"><b>Remaining Total Rs:</b></td>		
		<td style="text-align:right;border-top: 2px solid black;"><b><?php echo number_format($new_total,2); ?></b></td>		
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