<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$rt_name = $_POST['rt_name'];
$opt = $_POST['opt'];
$rt_id = $_POST['rt_id'];

if($opt=="update")
{
	$insertSQL = "Update rooms_types set rt_name = '$rt_name' where rt_id = '$rt_id'";
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
	//echo "<script type='text/javascript'> window.location='view_roomty.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO rooms_types (rt_name, rt_status) 
VALUES ('".$rt_name."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
//	echo "Category Added";
}
else
{
//	echo "Category Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_roomty.php' </script>";
}
	

?>
