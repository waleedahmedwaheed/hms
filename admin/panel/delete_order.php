<?php
require_once('../../conn/db.php');

$o_id = $_GET["o_id"];

	$insertSQL = "Update `order` set status = '1' where o_id = '$o_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_orders.php' </script>";
	
?>