<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$cs_name = $_POST['cs_name'];
$opt = $_POST['opt'];
$cs_id = $_POST['cs_id'];

if($opt=="update")
{
	$insertSQL = "Update cuisine set cs_name = '$cs_name' where cs_id = '$cs_id'";
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
	//echo "<script type='text/javascript'> window.location='cuisine.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO cuisine (cs_name, cs_status) 
VALUES ('".$cs_name."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Cuisine Added";
}
else
{
	//echo "Cuisine Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='cuisine.php' </script>";
}
	

?>
