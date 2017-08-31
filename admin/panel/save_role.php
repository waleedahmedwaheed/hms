<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$role_name = $_POST['role_name'];
$opt = $_POST['opt'];
$role_id = $_POST['role_id'];

if($opt=="update")
{
	$insertSQL = "Update roles set role_name = '$role_name' where role_id = '$role_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Updated Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_roles.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO roles (role_name, role_status) 
VALUES ('".$role_name."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	echo "Role Added";
}
else
{
	echo "Role Not Added";
	//echo $insertSQL;

}

echo "<script type='text/javascript'> alert('Added Successfully') </script>";
echo "<script type='text/javascript'> window.location='add_role.php' </script>";
}
	

?>
