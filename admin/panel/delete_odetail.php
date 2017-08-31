<?php
require_once('../../conn/db.php');

$or_id = $_GET["or_id"];

	$insertSQL = "Update `order_detail` set or_status = '1' where or_id = '$or_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
?>