<?php
 include("include/connection.php");
?>
<?php 
	/*--Check User is Loged In or Not-End --*/
	     
		 
	if(isset($_GET['id']) && $_GET['id']!=""){
		 $id = $_GET['id'];
	     $sql = "delete from services_menu where id = '$id'";

		if(mysqli_query($con,$sql))
		{
		header ("location:services_menu.php?success=deleted");
		}
		else{ echo "errors";}
		exit();
	}else{
		header ("location:services_menu.php?error=not deleted");
		exit();
	}
?>

