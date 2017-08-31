<?php
 include("include/connection.php");
?>
<?php 
	/*--Check User is Loged In or Not-End --*/
	     
		 
	if(isset($_GET['id']) && $_GET['id']!=""){
		 $id = $_GET['id'];

		  $get_file = "select emp_image from employee where id = '$id'";
		 $res = mysqli_query($con,$get_file);
		 if(mysqli_num_rows($res) >0){
		 	$row = mysqli_fetch_array($res);
		 	 $emp_image = $row['emp_image'];
		 }
		 

	     $sql = "delete from employee where id = '$id'";

		if(mysqli_query($con,$sql))
		{
			unlink('images/'.$emp_image);
		header ("location:view_employees.php?success=deleted");
		}
		else{ echo "errors";}
		exit();
	}else{
		header ("location:view_employees.php?error=not deleted");
		exit();
	}
?>

