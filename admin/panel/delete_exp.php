<?php
require_once('../../conn/db.php');

$he_id = $_GET["he_id"];

	$insertSQL = "Update hall_exp set exp_status = '1' where he_id = '$he_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_exp.php' </script>";
	
?>