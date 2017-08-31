<?php include("../../conn/db.php"); 

	if(isset($_GET["i_id"]))
	{
		$insertSQL = "SELECT * FROM items where i_id = '".$_GET["i_id"]."' and i_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$i_id = $row["i_id"];
		$mc_id = $row["mc_id"];
		$i_name = $row["i_name"];
		$i_price = $row["i_price"];
		$i_status = $row["i_status"];
		$cs_id = $row["cs_id"];
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
                    <h1 class="page-header">Items</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Item
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" id="userForm">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <input class="form-control" type="text" name="i_name" value="<?php echo $i_name; ?>">
                                        </div>
										
										<div class="form-group">
                                            <label>Dish Type</label>
                                             <select name="mc_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM menu_category where mc_status = 0 order by mc_name";
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
                                            <label>Cuisine</label>
                                             <select name="cs_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM cuisine where cs_status = 0 order by cs_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["cs_id"]; ?>" <?php if($cs_id==$rowsu["cs_id"]){ echo "selected";} ?>><?php echo $rowsu["cs_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Price</label>
                                            <input class="form-control" type="text" name="i_price" value="<?php echo $i_price; ?>">
                                        </div>
										
										 <?php if(isset($_GET["i_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="i_id" value="<?php echo $_GET["i_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["i_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-primary">Update </button>
										<a href="items.php" class="btn btn-default">  New  </a>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-success">Insert </button>
										<a href="items.php" class="btn btn-default">  New  </a>
										<?php } ?>	
									</form>
									
									<span id="response"> </span>
									
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
							<hr>
						<div id="txtHint" style="margin-top:20px;">
							
							<?php include("view_items.php"); ?>
							
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
url: "save_item.php",	  // Url to which the request is send
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
		
        xmlhttp.open("GET","view_items.php",true);
        xmlhttp.send();
		
		
}
});

}));
});


</script>


</body>
</html>
