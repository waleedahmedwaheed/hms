<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$or_id = $_POST["or_id"];
$o_id = $_POST["o_id"];
$i_id = $_POST["i_id"];
$quantity = $_POST["quantity"];

$price = get_title(price,$i_id);

$opt = $_POST['opt'];
$mc_id = $_POST["mc_id"];

$tot_price = $price * $quantity ; 

if($opt=="update")
{
	$insertSQL = "Update `order_detail` set quantity = '$quantity' , price = '$tot_price' , mc_id = '$mc_id' , i_id = '$i_id' 
	where or_id = '$or_id'";
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
	//echo "<script type='text/javascript'> window.location='add_odetail.php?o_id=$o_id' </script>"; 
}
else
{
	$stock_in = get_title(stock,$i_id) - get_title(stock_out,$i_id);
	//exit;
	if($stock_in<=0)
	{
		echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'This item is out of stock'
                });
           
           
			 })();
		</script>	";
	}
	else
	{
	$insertSQL = "INSERT INTO `order_detail` (`quantity`, `price`, `mc_id`, `i_id`, `o_id`, `or_status` ) 
VALUES ('".$quantity."','".$tot_price."','".$mc_id."','".$i_id."','".$o_id."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_odetail.php?o_id=$o_id' </script>";
	}
}

?>
