<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$bd_id = $_POST["bd_id"];
$bh_id = $_POST["bh_id"];
$hl_id = $_POST["hl_id"];
$mn_id = $_POST["mn_id"];
$total_person = $_POST["total_person"];
//$head_rate = $_POST["head_rate"];
$other_desc = $_POST["other_desc"];
$other_rate = $_POST["other_rate"];
$tax = $_POST["tax"];
$discount = $_POST["discount"];
$advance = $_POST["advance"];
$total = $_POST["total"];
$time_in = $_POST["time_in"];
$time_out = $_POST["time_out"];
$b_date = $_POST["b_date"];
$option = $_POST["option"];
$per_person = $_POST["per_person"];
$date 			= date('Y-m-d H:i:s');
$opt = $_POST['opt'];

if($option==1)
{
	$per_person = "";
}
else
{
	$mn_id = "";
}

/* 
$selectSQL = "SELECT * FROM booking_detail c,booking_hall d where c.bh_id='".$bh_id."' and c.bd_status = 0 and c.bh_id=d.bh_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{			
$mn_ids = $row["mn_id"];			
$bd_ids = $row["bd_id"];			
$other_rates = $row["other_rate"];			
$total_persons = $row["total_person"];			
$mn_desc = get_title(menu,$mn_ids);
$mn_rate = get_title(mn_rate,$mn_ids);
$mn_person = get_title(mn_person,$mn_ids);

$selectSQL = "SELECT * FROM service_rec where bd_id='".$bd_ids."'";
mysql_select_db($database_dbconfig, $dbconfig);
$Results = mysql_query($selectSQL, $dbconfig) or die(mysql_error());
while($rows = mysql_fetch_assoc($Results))
{
	$hs_id = $rows["hs_id"];
	$hamount = get_title(hamount,$hs_id);
	$hamount_total = $hamount_total + $hamount;
	$hs_name_arr[] = get_title(hservice,$hs_id);
}

$menu_amt_tax = $mn_rate * ($mn_person/100); // tax //
$menu_amount = $mn_rate + $menu_amt_tax; // added tax //
$menu_pers_amt = $menu_amount * $total_persons; // total person //
$menu_total = $menu_total + $menu_pers_amt; // menu total //
echo $total_hall = $menu_amount + $menu_pers_amt + $hamount_total + $other_rates;

}


	
	$updateSQL = "Update booking_hall set total = '$total_hall' where bh_id = '$bh_id'";
	//echo $updateSQL;
	//exit;
	mysql_select_db($database_dbconfig, $dbconfig);
	$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
	
 */
if($opt=="update")
{


	
	$insertSQL = "Update booking_detail set hl_id = '$hl_id' , mn_id = '$mn_id' , total_person = '$total_person', other_desc = '$other_desc',
	other_rate = '$other_rate' ,time_in = '$time_in' ,time_out = '$time_out' ,b_date = '$b_date' , options = '$option' , per_person = '$per_person'
	where bd_id = '$bd_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "
			<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Updated'
                });
           
           
			 })();
		</script>	
		
			";
echo "<script type='text/javascript'> window.location='booking_details.php?bh_id=$bh_id' </script>";
}
else
{
	$insertSQL = "INSERT INTO booking_detail (bh_id, hl_id, mn_id, total_person, other_desc, other_rate, time_in, time_out, b_date, options, per_person) 
VALUES
 ('".$bh_id."','".$hl_id."','".$mn_id."','".$total_person."','".$other_desc."','".$other_rate."','".$time_in."','".$time_out."','".$b_date."','".$option."','".$per_person."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Booking Added";
}
else
{
	//echo "Booking Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
echo "<script type='text/javascript'> window.location='booking_details.php?bh_id=$bh_id' </script>";
}
	

?>
