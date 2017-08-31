<?php
require_once('../../conn/db.php');

$bh_id = $_GET["bh_id"];

$insertSQL = "Update booking_hall set bh_status = '1' where bh_id = '$bh_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_bookings.php' </script>";
	
?>