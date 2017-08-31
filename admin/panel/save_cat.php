<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$mc_name = $_POST['mc_name'];
$opt = $_POST['opt'];
$mc_id = $_POST['mc_id'];

if($opt=="update")
{
	$insertSQL = "Update menu_category set mc_name = '$mc_name' where mc_id = '$mc_id'";
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
	//echo "<script type='text/javascript'> window.location='add_category.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO menu_category (mc_name, mc_status) 
VALUES ('".$mc_name."','0')";
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
//echo "<script type='text/javascript'> window.location='add_category.php' </script>";
}
	

?>
