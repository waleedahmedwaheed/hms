<?php
require_once('../../conn/db.php');

$rm_id = $_GET["rm_id"];

$insertSQL = "Update rooms set rm_status = '1' where rm_id = '$rm_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_rooms.php' </script>";
	
?>