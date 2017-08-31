<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$hs_name = $_POST['hs_name'];
$hs_amount = $_POST['hs_amount'];
$opt = $_POST['opt'];
$hs_id = $_POST['hs_id'];

if($opt=="update")
{
	$insertSQL = "Update hall_service set hs_name = '$hs_name' where hs_id = '$hs_id'";
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
	//echo "<script type='text/javascript'> window.location='view_hservices.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO hall_service (hs_name, hs_amount, hs_status) 
VALUES ('".$hs_name."','".$hs_amount."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Category Added";
}
else
{
	//echo "Category Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_hservices.php' </script>";
}
	

?>
