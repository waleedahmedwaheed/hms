<?php
require_once('../../conn/db.php');

$mc_id = $_GET["id"];

	echo $insertSQL = "Update menu_category set mc_status = '1' where mc_id = '$mc_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='add_category.php' </script>";
	
?>