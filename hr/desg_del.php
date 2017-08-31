<?php
 include("include/connection.php");
?>
<?php 
	/*--Check User is Loged In or Not-End --*/
	     
		 
	if(isset($_GET['id']) && $_GET['id']!=""){
		 $id = $_GET['id'];
	     $sql = "delete from designation where id = '$id'";

		if(mysqli_query($con,$sql))
		{
		header ("location:view_designation.php?success=Designation has been deleted successfully");
		}
		else{ echo "errors";}
		exit();
	}else{
		header ("location:view_designation.php?error=Designation has not been deleted");
		exit();
	}
?>

