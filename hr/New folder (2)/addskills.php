<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>

<?php
if(isset($_POST['submit']))
{
	$percentage = $_POST['percentage'];
	$title = $_POST['title'];
    $status = $_POST['status'];
	  if(($percentage == "")||($title == "")||($status == "")){
      header('location:addskills.php?error=Please Fill All Mandatory Fields');
    }
	else
	{
		
		 $sql= "INSERT INTO skills(title,percentage,status) VALUES ('$title','$percentage','$status')";
	if(mysqli_query($con,$sql))
	     {
		  //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		  		  header('location:addskills.php?success=Data has been added');


		 } 
		else
		{
			header('location:addskills.php?error=There was an error adding Content');

		}
}
}
?>  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!----header----->
  <?php 
  include("include/top_header.php");
  ?>

  <!-- Left side column. contains the logo and sidebar -->
  <!--------------left menu------------>
  
<?php include("include/nav.php");?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
		
		    <div style=" padding-top:20px;" class="container">
          <?php if(isset($_GET['error'])){ ?>
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?php echo $_GET['error']; ?>
           </div>
          <?php } ?>
          <?php if(isset($_GET['success'])){ ?>
             <div class="alert alert-success" role="alert">
                  <strong>Success!</strong> <?php echo $_GET['success']; ?>
             </div>
          <?php } ?>  
           </div>
          
         <div class="row" style="padding-bottom:20px;">
             <div class="col-lg-12">   
             <form method="post" action="addskills.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
             	 
				   <div class="form-group">
                    <label class="control-label col-sm-2" for="query">Title:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="percentage" name="title" type="text">
                    </div>
                  </div>
				  
				  
				 <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Percentage:</label>
                    <div class="col-sm-10">
					           <input class="form-control" id="percentage" name="percentage" type="text">
                    </div>
                  </div>
				 
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Status:</label>
                    <div class="col-sm-10"> 
                     <select name="status" id="status" class="form-control">
                     	<option value="1">Enabled</option>
                        <option value="0">Disabled</option>
                     </select>
                    </div>
                  </div>
                  
                  <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                      <button name="submit" type="submit" class="btn btn-default">Submit</button>
                    </div>
                  </div>
			</form>
             </div>
       	 </div>
       </div>
       
      </div>
      

              

        </section>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>
   <?php 
   include("include/footer.php");
   ?>

</div><!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
