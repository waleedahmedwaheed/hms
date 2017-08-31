<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$hl_name = $_POST['hl_name'];
$opt = $_POST['opt'];
$hl_id = $_POST['hl_id'];

if($opt=="update")
{
	$insertSQL = "Update halls set hl_name = '$hl_name' where hl_id = '$hl_id'";
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
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO halls (hl_name, hl_status) 
VALUES ('".$hl_name."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Hall Added";
}
else
{
	//echo "Hall Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_hall.php' </script>";
}
	

?>
