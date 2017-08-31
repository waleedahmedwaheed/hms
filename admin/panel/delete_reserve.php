<?php
require_once('../../conn/db.php');

$res_id = $_GET["res_id"];

$insertSQL = "Update reserve set res_status = '1' where res_id = '$res_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_reserve.php' </script>";
	
?>