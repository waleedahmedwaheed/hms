<?php 
include("include/connection.php");
session_start();
unset($_SESSION['username']); 
unset($_SESSION['userid']); 
if(session_destroy()){
	header("location:login.php");
}else{
	echo "not destroy";
}
?>
