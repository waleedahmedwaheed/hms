<?php
require_once('../../conn/db.php');

$cs_id = $_GET["cs_id"];

$insertSQL = "Update cuisine set cs_status = '1' where cs_id = '$cs_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_cuisine.php' </script>";
	
?>