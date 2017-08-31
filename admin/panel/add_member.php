<?php include("../../conn/db.php"); 

	if(isset($_GET["u_id"]))
	{
		$insertSQL = "SELECT * FROM users where u_id = '".$_GET["u_id"]."' and u_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		$row = mysql_fetch_assoc($Result1);
		$u_id = $row["u_id"];
		$username = $row["username"];
		$pass = $row["pass"];
		$role_id = $row["role_id"];
		$u_status = $row["u_status"];
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

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script type="text/javascript">
window.onload = function () {
	document.getElementById("password1").onchange = validatePassword;
	document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password1").value;
if(pass1!=pass2)
	document.getElementById("password2").setCustomValidity("Passwords Don't Match");
else
	document.getElementById("password2").setCustomValidity('');	 
//empty string means no validation error
}
</script>

<script type="text/javascript">
function AvoidSpace(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}

    </script>
	
	
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
                    <h1 class="page-header">Members</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Member
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="save_member.php">
									<div class="form-group">
										<label>Username</label>
										<input class="form-control" type="text" placeholder="Enter name" name="username" value="<?php echo $username; ?>">
									</div>
									
									<div class="form-group">
                                            <label>Roles</label>
                                             <select name="role_id" class="form-control" required>
											<option value="">--Select--</option>
											<?php 
			$qry = "SELECT * FROM roles where role_status=0 order by role_name";
		 mysql_select_db($database_dbconfig, $dbconfig);
		$results = mysql_query($qry);
		while($rowsu = mysql_fetch_assoc($results))
		{
											?>
				<option value="<?php echo $rowsu["cat"]; ?>" <?php if($role_id==$rowsu["cat"]){ echo "selected";} ?>><?php echo $rowsu["role_name"]; ?></option>
		
		<?php
		}
		?>						
											</select>
                                        </div>
										
									<div class="form-group">
                                    	<label>Password *</label>
                                        <input class="form-control" type="password" name="password" id="password1" value="<?php echo $pass; ?>" required onKeyPress="return AvoidSpace(event)" placeholder="Enter Your Password">
                                    </div>
									
                                    <div class="clearfix"></div>
                                    
                                    <div class="form-group">
                                    	<label>Confirm Password *</label>
                                        <input class="form-control" type="password" name="cpassword" id="password2" value="<?php echo $pass; ?>" required onKeyPress="return AvoidSpace(event)" placeholder="Re Enter Your Password">
                                    </div>
										
										 <?php if(isset($_GET["u_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="u_id" value="<?php echo $_GET["u_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       <?php if(isset($_GET["u_id"]))
										{ ?>
                                        <button type="submit" class="btn btn-default">Update </button>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-default">Insert </button>
										<?php } ?>	
									</form>
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
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

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
