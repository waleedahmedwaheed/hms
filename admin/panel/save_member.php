<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$username = $_POST['username'];
$pass = $_POST['password'];
$opt = $_POST['opt'];
$u_id = $_POST['u_id'];
$role_id = $_POST['role_id'];

if($opt=="update")
{
	$insertSQL = "Update users set username = '$username',pass = '$pass',role_id = '$role_id' where u_id = '$u_id'";
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
	//echo "<script type='text/javascript'> window.location='view_members.php' </script>";
}
else
{
	$insertSQLs = "SELECT * FROM users where username = '".$username."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1s = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1s);
		if($row>0)
		{
			echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Username Already Added'
                });
           
           
			 })();
		</script>	";
			//echo "<script type='text/javascript'> window.location='add_member.php' </script>";
		}
		else
		{
	$insertSQL = "INSERT INTO users (username, pass, role_id) 
VALUES ('".$username."','".$pass."','".$role_id."')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
	//echo "Member Added";
}
else
{
	//echo "Member Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_member.php' </script>";
}
	
}
?>
