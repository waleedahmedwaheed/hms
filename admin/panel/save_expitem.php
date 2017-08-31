<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );
		$ei_name 		= $_POST["ei_name"];
		$ei_id 			= $_POST["ei_id"];
		$opt 			= $_POST["opt"];

if($opt=="update")
{
	$insertSQL = "Update exp_items set ei_name = '$ei_name'  
	where ei_id = '$ei_id'";
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
	
	$insertSQL = "INSERT INTO exp_items (ei_name) 
VALUES ('".$ei_name."')";
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
