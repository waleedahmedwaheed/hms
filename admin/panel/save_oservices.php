<?php require_once('../../conn/db.php'); 
 require_once('../../functions.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$hs_id = $_POST["hs_id"];
$bd_id = $_POST["bd_id"];
$sr_id = $_POST["sr_id"];
$res_id = $_POST["res_id"];

$opt = $_POST['opt'];

if($opt=="update")
{
	$insertSQL = "Update `service_rec` set hs_id = '$hs_id' 
	where sr_id = '$sr_id'";
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
	//echo "<script type='text/javascript'> window.location='add_oservices.php?bh_id=$bh_id' </script>"; 
}
else
{
	$insertSQL = "INSERT INTO `service_rec` (`hs_id`, `bd_id`, `res_id`) VALUES ('".$hs_id."','".$bd_id."','".$res_id."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

if($Result1)
{
	//echo "Service Added";
}
else
{
	//echo "Service Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
		
//echo "<script type='text/javascript'> window.location='add_oservices.php?bh_id=$bh_id' </script>";

}
	

?>
