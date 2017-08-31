<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$mn_descs = $_POST['mn_desc'];
for ($i = 0; $i < count($mn_descs); $i++) {
$mn_desc = $mn_desc.'#'.$mn_descs[$i];
}

$opt = $_POST['opt'];
$mn_id = $_POST['mn_id'];
$mn_rate = $_POST['mn_rate'];
$mn_person = $_POST['mn_person'];

if($opt=="update")
{
	$insertSQL = "Update menu_hall set mn_desc = '$mn_desc' , mn_rate = '$mn_rate' , mn_person = '$mn_person' where mn_id = '$mn_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Updated Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_menu.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO menu_hall (mn_desc, mn_status, mn_rate, mn_person) 
VALUES ('".$mn_desc."','0','".$mn_rate."','".$mn_person."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	echo "Menu Added";
}
else
{
	echo "Menu Not Added";
	//echo $insertSQL;

}

echo "<script type='text/javascript'> alert('Added Successfully') </script>";
echo "<script type='text/javascript'> window.location='add_menu.php' </script>";
}
	

?>
