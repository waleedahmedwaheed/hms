<?php
require_once('../../conn/db.php');

$ei_id = $_GET["ei_id"];

	$insertSQL = "Update exp_items set ei_status = '1' where ei_id = '$ei_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	
?>