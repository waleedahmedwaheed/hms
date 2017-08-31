<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$tbl_name = $_POST['tbl_name'];
$opt = $_POST['opt'];
$tbl_id = $_POST['tbl_id'];

if($opt=="update")
{
	$insertSQL = "Update tables set tbl_name = '$tbl_name' where tbl_id = '$tbl_id'";
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
	//echo "<script type='text/javascript'> window.location='view_tables.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO tables (tbl_name, tbl_status) 
VALUES ('".$tbl_name."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Table Added";
}
else
{
	//echo "Table Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_tables.php' </script>";
}
	

?>
