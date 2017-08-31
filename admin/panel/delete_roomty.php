<?php
require_once('../../conn/db.php');

$rt_id = $_GET["rt_id"];

$insertSQL = "Update rooms_types set rt_status = '1' where rt_id = '$rt_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_roomty.php' </script>";
	
?>