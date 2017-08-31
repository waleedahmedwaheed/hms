<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$res_id 	= $_POST["res_id"];
$res_date 	= $_POST["res_date"];
$arrival 	= $_POST["arrival"];
$guest_name = $_POST["guest_name"];
$accompany	= $_POST["accompany"];
$nic		= $_POST["nic"];
$address	= $_POST["address"];
$room_no	= $_POST["room_no"];
$rent		= $_POST["rent"];
$purpose	= $_POST["purpose"];
$reference	= $_POST["reference"];
$total_days	= $_POST["total_days"];
$mobile_no	= $_POST["mobile_no"];
$vehicle_no	= $_POST["vehicle_no"];
$check_out	= $_POST["check_out"];
$check_out_date	= $_POST["check_out_date"];
$opt = $_POST['opt'];
$date 			= date('Y-m-d H:i:s');

if($opt=="update")
{
	$insertSQL = "Update reserve set res_date = '$res_date' , arrival = '$arrival', guest_name = '$guest_name', accompany = '$accompany', nic = '$nic', 
	address = '$address', room_no = '$room_no', rent = '$rent', purpose = '$purpose', reference = '$reference', total_days = '$total_days', mobile_no = '$mobile_no',
	vehicle_no = '$vehicle_no',check_out = '$check_out',check_out_date = '$check_out_date'
	where res_id = '$res_id'";
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
//	echo "<script type='text/javascript'> window.location='view_reserve.php' </script>";
}
else
{

				$selectSQL = "SELECT * FROM reserve WHERE res_status = 0
				AND room_no = '$room_no'
				AND  '$res_date' >= res_date
				AND  '$res_date' <= check_out_date";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
	if($row>0)
	{
		echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Room is already reserved'
                });
           
           
			 })();
		</script>	";
	}
	else
	{

	$insertSQL = "INSERT INTO reserve (res_date, arrival, guest_name, accompany, nic, address, room_no, rent, purpose, reference, total_days, mobile_no,
	vehicle_no, check_out, check_out_date, entry_date, res_status) 
VALUES ('".$res_date."','".$arrival."','".$guest_name."','".$accompany."','".$nic."','".$address."','".$room_no."','".$rent."','".$purpose."',
'".$reference."','".$total_days."','".$mobile_no."','".$vehicle_no."','".$check_out."','".$check_out_date."','".$date."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
//	echo "Reservation Added";
}
else
{
	//echo "Reservation Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_reserve.php' </script>";
	}
}	

?>
