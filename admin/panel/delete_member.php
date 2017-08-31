<?php
require_once('../../conn/db.php');

$u_id = $_GET["u_id"];

$insertSQL = "Update users set u_status = '1' where u_id = '$u_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_members.php' </script>";
	
?>