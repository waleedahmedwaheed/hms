<?php
require_once('../../conn/db.php');

$exp_id = $_GET["exp_id"];

	$insertSQL = "Update expenses set exp_status = '1' where exp_id = '$exp_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	
?>