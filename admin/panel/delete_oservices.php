<?php
require_once('../../conn/db.php');

$sr_id = $_GET["sr_id"];
$bh_id = $_GET["bh_id"];

	$insertSQL = "Delete from `service_rec` where sr_id = '$sr_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='add_oservices.php?bh_id=$bh_id' </script>";
	
?>