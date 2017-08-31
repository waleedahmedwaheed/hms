<?php
require_once('../../conn/db.php');

$paymentid = $_GET["paymentid"];

$insertSQL = "Update payment_mode set pay_status = '1' where paymentid = '$paymentid'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_payments.php' </script>";
	
?>