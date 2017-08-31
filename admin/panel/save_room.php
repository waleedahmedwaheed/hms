<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$room_no = $_POST['room_no'];
$opt = $_POST['opt'];
$rt_id = $_POST['rt_id'];
$rm_id = $_POST['rm_id'];

if($opt=="update")
{
	$insertSQL = "Update rooms set room_no = '$room_no' , rt_id = '$rt_id' 
	where rm_id = '$rm_id'";
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
	//echo "<script type='text/javascript'> window.location='view_rooms.php' </script>";
}
else
{
	$insertSQL = "SELECT * FROM rooms where room_no = '".$room_no."' and rm_status = 0";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
	if($row>0)
	{
		echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Room is already added'
                });
           
           
			 })();
		</script>	";
	}
	else
	{
	$insertSQL = "INSERT INTO rooms (room_no, rt_id, rm_status) 
VALUES ('".$room_no."','".$rt_id."','0')";
  mysql_select_db($database_dbconfig, $dbconfig);
  $Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
//$qry = "INSERT INTO property(location)VALUES ('21122')";
//$result = mysql_query($qry);

if($Result1)
{
//	echo "Room Added";
}
else
{
//	echo "Room Not Added";
	//echo $insertSQL;

}

echo "<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Record Inserted'
                });
           
           
			 })();
		</script>	";
//echo "<script type='text/javascript'> window.location='add_room.php' </script>";
	}
}	

?>
