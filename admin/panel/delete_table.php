<?php
require_once('../../conn/db.php');

$tbl_id = $_GET["tbl_id"];

$insertSQL = "Update tables set tbl_status = '1' where tbl_id = '$tbl_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
?>