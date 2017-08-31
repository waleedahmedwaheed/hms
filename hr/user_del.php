<?php
 include("include/connection.php");
?>
<?php 
	/*--Check User is Loged In or Not-End --*/
	     
		 
	if(isset($_GET['id']) && $_GET['id']!=""){
		 $id = $_GET['id'];
	     $sql = "delete from tbl_user where id = '$id'";

		if(mysqli_query($con,$sql))
		{
		header ("location:view_users.php?success=User has been deleted successfully");
		}
		else{ echo "errors";}
		exit();
	}else{
		header ("location:view_users.php?error=User has not been deleted");
		exit();
	}
?>

