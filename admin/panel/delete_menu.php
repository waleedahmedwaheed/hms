<?php
require_once('../../conn/db.php');

$mn_id = $_GET["mn_id"];

$insertSQL = "Update menu_hall set mn_status = '1' where mn_id = '$mn_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_menu.php' </script>";
	
?>