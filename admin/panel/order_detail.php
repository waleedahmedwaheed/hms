<?php include("../../conn/db.php"); 
include("../../functions.php"); 

	if(isset($_GET["o_id"]))
	{
		$insertSQL = "SELECT * FROM `order` where o_id = '".$_GET["o_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$o_id = $row["o_id"];
		$u_id = $row["u_id"];
		$waiter = $row["waiter"];
		$tbl_id = $row["tbl_id"];
		$date = $row["date"];
		$time = $row["time"];

	}
	
	if(isset($_GET["or_id"]))
	{
		$insertSQL = "SELECT * FROM `order_detail` where or_id = '".$_GET["or_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$mc_id = $row["mc_id"];
		$i_id = $row["i_id"];
		$quantity = $row["quantity"];

	}

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
                    <h1 class="page-header">Order</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Order Detail
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" id="userForm">
                                        
										<div class="form-group">
                                            <label>Category</label>
                                             <select name="mc_id" id="mc_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM menu_category where mc_status=0 order by mc_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["mc_id"]; ?>" <?php if($mc_id==$rowsu["mc_id"]){ echo "selected";} ?>><?php echo $rowsu["mc_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
										
										<div class="form-group">
                                            <label>Items</label>
                                             <select name="i_id" id="i_id" class="form-control" required>
									<?php if($i_id!=""){ ?>
									<option value="<?php echo $i_id; ?>" ><?php echo get_title(item,$i_id); ?></option>
									<?php } else { ?>
									<option value="">--Select--</option>
									<?php } ?>									 
											</select>
                                        </div>
										
										 <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control" type="text" name="quantity" value="<?php echo $quantity; ?>">
                                        </div>
										
										<input type="hidden" id="o_id" name="o_id" value="<?php echo $o_id; ?>" />
										
										 <?php if(isset($_GET["or_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="or_id" value="<?php echo $_GET["or_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["or_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="order_detail.php?o_id=<?php echo $_GET["o_id"]; ?>" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="order_detail.php?o_id=<?php echo $_GET["o_id"]; ?>" class="btn btn-default">  New  </a>
										<?php } ?>	
										<button type="button" title="Back" class="btn btn-default btn-circle" style="float: right;">
										<a href="orders.php?o_id=<?php echo $_GET["o_id"]; ?>"> <i class="fa fa-chevron-circle-left"></i> </a></button>
									</form>
                                	
									<span id="response"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_oitems.php"); ?>
							
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
url: "save_odetail.php",	  // Url to which the request is send
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
		
		var o_id = <?php echo $_GET["o_id"]; ?>;
		//alert(o_id);
        xmlhttp.open("GET","view_oitems.php?o_id="+o_id,true);
        xmlhttp.send();
		
		
}
});

}));
});


</script>

	
<script>
$("select#mc_id").change(function(){

	var mc_id =  $("select#mc_id option:selected").attr('value'); 
// alert(mc_id);	
	$("#i_id").html( "" );
	
	if (mc_id.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-items.php",
			data: "mc_id="+mc_id,
			cache: false,
			beforeSend: function () { 
				$('#i_id').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#i_id").html( html );
			}
		});
	} 
});
</script>
	
</body>
</html>
