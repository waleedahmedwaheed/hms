<?php
include("include/connection.php");
if(isset($_POST['attendes']) && strlen($_POST['attendes']) && isset($_POST['emp_id']) && strlen($_POST['emp_id']) && isset($_POST['todaydate']) && strlen($_POST['todaydate']))
{
	$timein= $_POST['timein'];
	$todaydate= $_POST['todaydate'];
	$emp_id= $_POST['emp_id'];
	$attendes= $_POST['attendes'];

	$sql = "insert into attendes (`emp_id`,`date`,`time_in`,`type`,`status`) values ('$emp_id','$todaydate','$timein','$attendes','1')";
	$result = mysqli_query($con,$sql);
	if($result){
		echo "1";
	}else{
		echo "0";
	}
}else if(isset($_POST['timeout']) && strlen($_POST['timeout'])&& isset($_POST['emp_id']) && strlen($_POST['emp_id']) && isset($_POST['todaydate']) && strlen($_POST['todaydate'])){

$todaydate= $_POST['todaydate'];
	$emp_id= $_POST['emp_id'];
	$timeout= $_POST['timeout'];

	 $sql = "update attendes set  time_out = '$timeout' where emp_id = '$emp_id' and date = '$todaydate'";
	$result = mysqli_query($con,$sql);
	if($result){
		echo "1";
	}else{
		echo "0";
	}

} 
?>