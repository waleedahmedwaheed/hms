<?php
require_once('../../conn/db.php');

$hl_id = $_GET["hl_id"];

$insertSQL = "Update halls set hl_status = '1' where hl_id = '$hl_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
	
?>