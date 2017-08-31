<?php
include("include/connection.php");
if(isset($_POST['emp_id']) && strlen($_POST['emp_id']) && isset($_POST['to']) && strlen($_POST['to']) && isset($_POST['from']) && strlen($_POST['from'])&& isset($_POST['leaves']) && strlen($_POST['leaves'])&& isset($_POST['presents']) && strlen($_POST['presents'])&& isset($_POST['absents']) && strlen($_POST['absents'])&& isset($_POST['salary']) && strlen($_POST['salary'])&& isset($_POST['tot_sal']) && strlen($_POST['tot_sal']))
{
	$to= $_POST['to'];
	$from= $_POST['from'];
	$to = date('Y-m-d',strtotime($to) );
    $from = date('Y-m-d',strtotime($from) );

	$emp_id= $_POST['emp_id'];
	$leaves= $_POST['leaves'];
	$bonus= $_POST['bonus'];
	$absents= $_POST['absents'];
	$presents= $_POST['presents'];
	$salary= $_POST['salary'];
    $tot_sal= $_POST['tot_sal'];
	
	//$sql1 = "select * from salaries where to_date >= '$to' and to_date <= '$to' and from_date >= '$from' and from_date <= '$from' and emp_id = '$emp_id'";
   $sql1 = "select * from salaries where   
			(STR_TO_DATE(from_date,'%Y-%m-%d') <= STR_TO_DATE('$from','%Y-%m-%d') and 
			STR_TO_DATE(to_date,'%Y-%m-%d') >= STR_TO_DATE('$to','%Y-%m-%d')) 
			and emp_id = '$emp_id'";
	$result1 = mysqli_query($con,$sql1);
	if(mysqli_num_rows($result1)>0){
		echo "Already Exist";
	}else{
		$sql = "INSERT INTO `salaries`(`emp_id`, `to_date`, `from_date`, `presents`, `absents`, `leaves`, `salary`, `bonus`, `total_salary`) VALUES ('$emp_id','$to','$from','$presents','$absents','$leaves','$salary','$bonus','$tot_sal')";
		$result = mysqli_query($con,$sql);
	if($result){
		echo "1";
	}else{
		echo "0";
	}
	}

	
}else{
	echo '00';
}
?>