<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

		$r_id = $_POST["r_id"];
		$r_name = $_POST["r_name"];
		$mobile = $_POST["mobile"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$address = $_POST["address"];
		$opt 	= $_POST["opt"];

if($opt=="update")
{
	$insertSQL = "Update restaurant set r_name = '$r_name',phone = '$phone',mobile = '$mobile',email = '$email',address = '$address' 
	where r_id = '$r_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Updated Successfully') </script>";
	echo "<script type='text/javascript'> window.location='view_res.php' </script>";
}
else
{
	$insertSQL = "INSERT INTO restaurant (r_name, mobile, phone, email, address) 
VALUES ('".$r_name."','".$mobile."','".$phone."','".$email."','".$address."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	echo "Detail Added";
}
else
{
	echo "Detail Not Added";
	//echo $insertSQL;

}

echo "<script type='text/javascript'> alert('Added Successfully') </script>";
echo "<script type='text/javascript'> window.location='view_res.php' </script>";
}
	

?>
