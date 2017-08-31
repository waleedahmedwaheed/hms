<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );
		$date 			= date('Y-m-d H:i:s');
		$i_id 			= $_POST["i_id"];
		$i_quantity		= $_POST["i_quantity"];
		$st_id		 	= $_POST["st_id"];
		$opt 			= $_POST["opt"];

if($opt=="update")
{
	$insertSQL = "Update stock set i_quantity = '$i_quantity'  
	where st_id = '$st_id'";
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
	//echo "<script type='text/javascript'> window.location='items.php' </script>";
}
else
{	
	/*$insertSQL = "SELECT * FROM stock where i_id = '".$i_id."'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
	if($row>0)
	{
		echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Stock of this item is already added'
                });
           
           
			 })();
		</script>	";
	}
	else
	{*/
	$insertSQL = "INSERT INTO stock (i_id, i_quantity, stock_dt) 
VALUES ('".$i_id."','".$i_quantity."','".$date."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='items.php' </script>";
//}
	
}
?>
