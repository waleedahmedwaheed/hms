<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );
		$exp_id 			= $_POST["exp_id"];
		$ei_id 			= $_POST["ei_id"];
		$exp_date 		= $_POST["exp_date"];
		$exp_amount		= $_POST["exp_amount"];
		$opt 			= $_POST["opt"];

if($opt=="update")
{
	$insertSQL = "Update expenses set exp_date = '$exp_date' , exp_amount = '$exp_amount' , ei_id = '$ei_id'  
	where exp_id = '$exp_id'";
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
	
	$insertSQL = "SELECT * FROM expenses where exp_date = '".$exp_date."' and ei_id = '".$ei_id."' and exp_status = 0";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
	if($row>0)
	{
		echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Item is already added'
                });
           
           
			 })();
		</script>	";
	}
	else
	{
	
	$insertSQL = "INSERT INTO expenses (exp_date, exp_amount, ei_id) 
VALUES ('".$exp_date."','".$exp_amount."','".$ei_id."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='items.php' </script>";
	}
}
?>
