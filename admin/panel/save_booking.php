<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$bh_id = $_POST["bh_id"];
//$date 			= date('Y-m-d H:i:s');
$date 			= $_POST["entry_date"];
$cus_name 		= $_POST["cus_name"];
$cus_cnic 		= $_POST["cus_cnic"];
$cus_phone		= $_POST["cus_phone"];
$opt 			= $_POST['opt'];


if($opt=="update")
{
	$insertSQL = "Update booking_hall set cus_name = '$cus_name' , cus_cnic = '$cus_cnic' ,cus_phone = '$cus_phone' , entry_date = '$date'
	where bh_id = '$bh_id'";
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
//	echo "<script type='text/javascript'> window.location='view_bookings.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO booking_hall (entry_date, bh_status, cus_name , cus_cnic, cus_phone) 
VALUES
 ('".$date."' , '0' ,'".$cus_name."' ,'".$cus_cnic."' ,'".$cus_phone."')";
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
//echo "<script type='text/javascript'> window.location='add_booking.php' </script>";
}
	

?>
