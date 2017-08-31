<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$bh_id 		= $_POST["bh_id"];
$tax 		= $_POST["tax"];
$discount 	= $_POST["discount"];
$advance 	= $_POST["advance"];
$total 		= $_POST["total"];

$amount 	= $discount + $advance;
//$new_total = ($total + $tax) - $amount;


	$insertSQL = "Update booking_hall set tax = '$tax' , discount = '$discount' , advance = '$advance', total = '$total' where bh_id = '$bh_id'";
	//echo $insertSQL;
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
//echo "<script type='text/javascript'> window.location='booking_details.php?bh_id=$bh_id' </script>";

?>