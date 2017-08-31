<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

		$i_id 		= $_POST["i_id"];
		$mc_id 		= $_POST["mc_id"];
		$i_name 	= $_POST["i_name"];
		$i_price 	= $_POST["i_price"];
		$i_status 	= $_POST["i_status"];
		$cs_id 	= $_POST["cs_id"];
		$opt 		= $_POST["opt"];

if($opt=="update")
{
	$insertSQL = "Update items set mc_id = '$mc_id',i_name = '$i_name',i_price = '$i_price',i_status = '$i_status' , cs_id = '$cs_id'  
	where i_id = '$i_id'";
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
	$insertSQL = "INSERT INTO items (mc_id, i_name, i_price, i_status , cs_id) 
VALUES ('".$mc_id."','".$i_name."','".$i_price."','0', '".$cs_id."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Item Added";
}
else
{
	//echo "Item Not Added";
	//echo $insertSQL;

}

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
