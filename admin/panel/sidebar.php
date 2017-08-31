<?php
include_once('../../conn/db.php'); 
 include_once('../../functions.php'); 

session_start();
if ( !isset($_SESSION['SESS_NAME']) ) {
	header('location: ../../index.php');
} else {
	
	$qry = "SELECT * FROM users WHERE username = '{$_SESSION['SESS_NAME']}'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$result = mysql_query($qry, $dbconfig) or die(mysql_error());
	$user_arr = mysql_fetch_assoc($result);
	$role_id = $user_arr["role_id"];
}


switch($role_id)
{

case 1: include("sa_sidebar.php"); break;
case 2: include("sa_sidebar.php"); break;
case 3: include("u_sidebar.php"); break;
case 4: include("u_sidebar.php"); break;
case 5: include("u_sidebar.php"); break;
case 6: include("hm_sidebar.php"); break;

}

?>