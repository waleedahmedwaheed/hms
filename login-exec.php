<?php
include_once('conn/db.php');
session_start();
$email 			= $_REQUEST["email"];
$password		= $_REQUEST["password"];


		$qry = "SELECT * FROM users WHERE username='$email' and pass='$password'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$result = mysql_query($qry, $dbconfig) or die(mysql_error());
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$member = mysql_fetch_assoc($result);
				$_SESSION['SESS_NAME'] = $member['username'];
				session_write_close();
  				echo "<script type='text/javascript'>window.location='admin/panel/index.php';</script>";
				}
			else
			{
				
					echo "<script>
		 (function () {
		 
                Lobibox.alert('error', {
                    msg: 'Invalid Username or Password'
                });
           
           
			 })();
		</script>	";
		
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
		
		//mysqli_close($conn);
?>