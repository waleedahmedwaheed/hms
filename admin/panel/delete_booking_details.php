<?php
require_once('../../conn/db.php');
require_once('../../functions.php');

$bd_id = $_GET["bd_id"];
$bh_id = $_GET["bh_id"];

$insertSQL = "Update booking_detail set bd_status = '1' where bd_id = '$bd_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());


 /* $selectSQL = "SELECT * FROM booking_detail c,booking_hall d where c.bh_id='".$bh_id."' and c.bd_status = 0 and c.bh_id=d.bh_id";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
				while($row = mysql_fetch_assoc($Result1))
				{			
 $mn_ids = $row["mn_id"];			
$bd_ids = $row["bd_id"];			
$other_rates = $row["other_rate"];			
$total_person = $row["total_person"];			
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
 $menu_pers_amt = $menu_amount * $total_person; // total person //
$menu_total = $menu_total + $menu_pers_amt; // menu total //
  $total_hall = $menu_amount + $menu_pers_amt + $hamount_total + $other_rates;
}


	
	$updateSQL = "Update booking_hall set total = '$total_hall' where bh_id = '$bh_id'";
	//echo $updateSQL;
	//exit;
	mysql_select_db($database_dbconfig, $dbconfig);
	$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
		  */
?>