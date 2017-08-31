<?php
require_once('../../conn/db.php');

$hs_id = $_GET["hs_id"];

$insertSQL = "Update hall_service set hs_status = '1' where hs_id = '$hs_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_hservices.php' </script>";
	
?>