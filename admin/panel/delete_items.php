<?php
require_once('../../conn/db.php');

$i_id = $_GET["i_id"];

$insertSQL = "Update items set i_status = '1' where i_id = '$i_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_items.php' </script>";
	
?>