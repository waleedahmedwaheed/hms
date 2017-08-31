<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$o_id = $_POST["o_id"];
$u_id = $_POST["u_id"];
$waiter = $_POST["waiter"];
$tbl_id = $_POST["tbl_id"];
$res_id = $_POST["res_id"];
$opt = $_POST['opt'];
$date = $_POST["date"];
$time = $_POST["time"];
$bill = $_POST["bill"];
$extra = $_POST["extra"];
$discount = $_POST["discount"];

if($opt=="update")
{
	$insertSQL = "Update `order` set tbl_id = '$tbl_id' , date = '$date' , waiter = '$waiter' , time = '$time' , bill = '$bill' , extra = '$extra' , discount = '$discount'   
	where o_id = '$o_id'";
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
	//echo "<script type='text/javascript'> window.location='view_orders.php' </script>";
}
else
{

if($res_id<>"")
{
	
		 $insertSQL = "INSERT INTO `order` (`tbl_id`, `date`, `u_id`, `waiter`, `status`, `bill`, `discount`, `time`, `extra`, `res_id`) 
VALUES ('','".$date."','','".$waiter."','0','".$bill."','".$discount."','".$time."','".$extra."','".$res_id."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

if($Result1)
{
	//echo "Order Added";
}
else
{
	//echo "Order Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
		
}
else
{	

	$insertSQL = "SELECT * FROM `order` where `tbl_id` = '".$tbl_id."' and bill = 0";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
	if($row>0)
	{
		echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Table is reserved'
                });
           
           
			 })();
		</script>	";
		//echo "<script type='text/javascript'> window.location='add_order.php' </script>";
	}
	else
	{
	 $insertSQL = "INSERT INTO `order` (`tbl_id`, `date`, `u_id`, `waiter`, `status`, `bill`, `discount`, `time`, `extra`) 
VALUES ('".$tbl_id."','".$date."','','".$waiter."','0','".$bill."','".$discount."','".$time."','".$extra."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

if($Result1)
{
	//echo "Order Added";
}
else
{
	//echo "Order Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_order.php' </script>";
	}
}		
}

?>
