<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );
		$he_id 			= $_POST["he_id"];
		$exp_desc 		= $_POST["exp_desc"];
		$exp_price 		= $_POST["exp_price"];
		$bh_id 			= $_POST["bh_id"];
		$opt 			= $_POST["opt"];

if($opt=="update")
{
	$insertSQL = "Update hall_exp set exp_desc = '$exp_desc' , exp_price = '$exp_price'  
	where he_id = '$he_id'";
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
	
	$insertSQL = "INSERT INTO hall_exp (exp_desc, exp_price, bh_id) 
VALUES ('".$exp_desc."','".$exp_price."','".$bh_id."')";
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
?>
