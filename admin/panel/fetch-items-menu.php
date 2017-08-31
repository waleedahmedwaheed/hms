<?php require_once('../../conn/db.php'); 

//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE );

$mc_id = $_POST["mc_id"];

		$qry = "SELECT * FROM items where i_status=0 and mc_id = '$mc_id' order by i_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["i_id"]; ?>" <?php if($i_id==$rowsu["i_id"]){ echo "selected";} ?>><?php echo $rowsu["i_name"]; ?></option>
		
		<?php
		}
		
?>
