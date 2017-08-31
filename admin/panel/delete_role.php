<?php
require_once('../../conn/db.php');

$role_id = $_GET["role_id"];

$insertSQL = "Update roles set role_status = '1' where role_id = '$role_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_roles.php' </script>";
	
?>