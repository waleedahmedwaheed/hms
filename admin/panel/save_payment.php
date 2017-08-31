<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$payment_option = $_POST['payment_option'];
$opt = $_POST['opt'];
$paymentid = $_POST['paymentid'];

if($opt=="update")
{
	$insertSQL = "Update payment_mode set payment_option = '$payment_option' where paymentid = '$paymentid'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "
			<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Updated'
                });
           
           
			 })();
		</script>	
		
			";
//	echo "<script type='text/javascript'> window.location='view_payments.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO payment_mode (payment_option, pay_status) 
VALUES ('".$payment_option."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

if($Result1)
{
	echo "Payment Type Added";
}
else
{
	echo "Payment Type Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_payment.php' </script>";
}
	

?>
