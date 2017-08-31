<?php include("../../conn/db.php"); 
 include("../../functions.php"); 

	if((isset($_GET["bd_id"])) and (isset($_GET["bh_id"])))
	{
		$insertSQL = "SELECT * FROM booking_detail c,booking_hall d where c.bd_id='".$_GET["bd_id"]."' and c.bd_status = 0 and c.bh_id=d.bh_id";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bh_id = $row["bh_id"];
		$hl_id = $row["hl_id"];
		$mn_id = $row["mn_id"];
		$total_person = $row["total_person"];
		$head_rate = $row["head_rate"];
		$other_desc = $row["other_desc"];
		$other_rate = $row["other_rate"];
		$tax = $row["tax"];
		$discount = $row["discount"];
		$time_in = $row["time_in"];
		$time_out = $row["time_out"];
		$b_date = $row["b_date"];
		$advance = $row["advance"];
		$total = $row["total"];
		$options = $row["options"];
		$per_person = $row["per_person"];
	}
	else 
	{
		$insertSQL = "SELECT * FROM booking_detail c,booking_hall d where c.bh_id='".$_GET["bh_id"]."' and c.bd_status = 0 and c.bh_id=d.bh_id";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$bh_id = $row["bh_id"];
		$tax = $row["tax"];
		$discount = $row["discount"];
		$advance = $row["advance"];
		$total = $row["total"];
	}
		
		
		
	
	
	
	$now = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin HMS</title>

      <?php include("header.php"); ?>

	  <style>
.form-group{
	width: 30%;
    float: left;
    margin-right: 10px;
}
</style>



</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin HMS</a>
            </div>
            <!-- /.navbar-header -->

           <?php include("topbar.php") ?>
           
		<?php include("sidebar.php"); ?>
		
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hall Booking</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Hall Booking
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" id="userForm" >
										
										<div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="b_date" 
											 <?php if(isset($_GET["bd_id"]))
						 { ?>
						 value="<?php echo $b_date; ?>"
						 <?php } else { ?>
						 value="<?php echo $now; ?>"
						 <?php } ?>
						 />
                                        </div>
										
                                        <div class="form-group">
                                            <label> Hall </label>
                                              <select name="hl_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM halls where hl_status=0 order by hl_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["hl_id"]; ?>" <?php if($hl_id==$rowsu["hl_id"]){ echo "selected";} ?>><?php echo $rowsu["hl_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
	<div class="form-group">
                                            <label> Menu </label>
											</br>
        <input type="radio" name="option" value="1"  <?php if($options==1){ echo "checked";} ?>> Yes</br>
        <input type="radio" name="option" value="0" <?php if($options==0){ echo "checked";} ?>> No
       
    </div>
    <div class="red box form-group">
                                          <label> Menu </label>
											  <select name="mn_id" <?php if(!isset($_GET["bd_id"])){ ?> id="mn_id" <?php } ?> class="form-control">
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM menu_hall where mn_status=0 order by mn_desc";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["mn_id"]; ?>" <?php if($mn_id==$rowsu["mn_id"]){ echo "selected";} ?>><?php echo $rowsu["mn_id"]." - "; 
				$mn_desc = get_title(menu,$rowsu["mn_id"]);
				$myArray = explode('#', $mn_desc);	
						foreach ($myArray as $item) {
							$resultstr[] = get_title(item,$item);
						 } 
						 array_shift($resultstr); ///skip 1st element//
						 $result = implode(",",$resultstr); //remove last comma//
						 echo $result; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        
	</div>
	
	
	 <div class="green box form-group">
                                          <label> Per Person </label>
		  <input type="text" name="per_person" 
		  <?php if(isset($_GET["bd_id"])){ ?> value="<?php echo $per_person; ?>" <?php } else { ?> id="per_person" <?php } ?>   
		  class="form-control" />									
                                        
	</div>									 
										
										<div class="form-group">
                                            <label>Time in </label>
                                            <input type="time" class="form-control" name="time_in" value="<?php echo $time_in; ?>"  />
										</div>
										
										<div class="form-group">
                                            <label>Time out </label>
											<input type="time" class="form-control" name="time_out" value="<?php echo $time_out; ?>"  />
										</div>
										
										<div class="form-group">
                                            <label>Total Persons </label>
											<input type="text" class="form-control" name="total_person" value="<?php echo $total_person; ?>" required />
										</div>
										
										<div class="form-group">
                                            <label>Other Detail</label>
                                            <input type="text" class="form-control" name="other_desc" value="<?php echo $other_desc; ?>"  />
                                        </div>
										
										<div class="form-group">
                                            <label>Other Rate</label>
                                            <input type="text" class="form-control" name="other_rate" value="<?php echo $other_rate; ?>" />
                                        </div>
										
										
                                            <input type="hidden" class="form-control" name="tax" value="<?php echo $tax; ?>" />
                                            <input type="hidden" class="form-control" name="discount" value="<?php echo $discount; ?>" />
                                            <input type="hidden" class="form-control" name="advance" value="<?php echo $advance; ?>" />
                                            <input type="hidden" class="form-control" name="total" value="<?php echo $total; ?>" />
                                        
										
										<input type="hidden" name="bh_id" value="<?php echo $_GET["bh_id"]; ?>">
										
										<div class="form-group" style="width:80%">
										 <?php if(isset($_GET["bd_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="bd_id" value="<?php echo $_GET["bd_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["bd_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="booking_details.php?bh_id=<?php echo $_GET["bh_id"]; ?>" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="booking_details.php?bh_id=<?php echo $_GET["bh_id"]; ?>" class="btn btn-default">  New  </a>
										<?php } ?>	
										<button type="button" title="Back" class="btn btn-default btn-circle" style="float: right;">
										<a href="bookings.php?bh_id=<?php echo $_GET["bh_id"]; ?>"> <i class="fa fa-chevron-circle-left"></i> </a></button>
									</form>
									
									</div>
									
								<span id="response"> </span>
								<span id="response_bh"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_bookings_detail.php"); ?>
							
							</div>
							
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include("scripts.php"); ?>
	
	<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "save_booking_detail.php",	  // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#loader").hide();
$('#userForm')[0].reset();
//window.location = 'add_category.php';
$("#response").html(data);


if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
        };
		
		var bh_id = <?php echo $_GET["bh_id"]; ?>;
		//alert(o_id);
        xmlhttp.open("GET","view_bookings_detail.php?bh_id="+bh_id,true);
		xmlhttp.send();
		
		
}
});

}));
});


</script>

<script type="text/javascript">
$(document).ready(function(){
	
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="1"){
            $(".box").not(".red").hide();
            $(".red").show();
			document.getElementById('per_person').value=null;
			
        }
        if($(this).attr("value")=="0"){
            $(".box").not(".green").hide();
            $(".green").show();
			$("#mn_id").removeAttr('required');
			document.getElementById("per_person").required = true;
        }
        
    });
});

$( window ).load(function() {
       // console.log( "window loaded" );
		<?php if($_GET["opt"]==1){ ?>
	$(".box").not(".red").hide();
	//alert("1");
	<?php } else if($_GET["opt"]==0){ ?>
	$(".box").not(".green").hide();
	//alert("0");
	<?php } ?>
    });
	
</script>


</body>

</html>
