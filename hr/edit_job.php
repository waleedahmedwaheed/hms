<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>
<?php
 $time=time();
 if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "select * from jobs where emp_id = '$id' order by id DESC limit 1";
  $result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    $dept_id = $row['dept_id'];
    $desig_id = $row['desig_id'];
    $salary = $row['salary'];

    $start_date = $row['start_date'];
    $start_date=date('m/d/Y',strtotime($start_date) );
     $end_date = $row['end_date'];
     $status = $row['status'];
     $job_id = $row['id'];
   

  }
 }

 if(isset($_POST['submit']))
{
	    $designation =  $_POST['designation'];
      $department =  $_POST['department'];
      $status =  $_POST['status'];
      $startdate =      date('Y/m/d',strtotime( $_POST['startdate']));
      $salary = $_POST['salary'];
      $emp_id = $_POST['emp_id'];
      $end_date = date('Y/m/d');
      $job_id = $_POST['job_id'];
	  if(($status == "")||($department == "")||($designation == "")||($emp_id == "")||($salary == "")||($startdate == ""|| ($job_id == ""))){
      header('location:edit_job.php?error=Please Fill All Mandatory Fields&id='.$emp_id);
    }
	else
	{
       $edit_job = "update jobs set end_date = '$end_date' where id = '$job_id' and emp_id = '$emp_id'";
    
    if(mysqli_query($con,$edit_job)){
       $sql = "INSERT INTO `jobs`(`dept_id`, `desig_id`, `salary`, `start_date`, `status`, `emp_id`) VALUES ('$department','$designation','$salary','$startdate','$status','$emp_id')";
     
    if(mysqli_query($con,$sql)){
     
      header('location:edit_job.php?success=Job has been updated.&id='.$emp_id);

    }
    

    }



	   
		 
	
}
}

?>  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include("include/top_header.php");?>

<?php include("include/nav.php");?>
  <!-- Left side column. contains the logo and sidebar -->
 

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
     <h3 style="background:#3c8dbc; padding:10px;">Edit Job</h3>
       
                    <div style="width:50%; padding-top:20px;" class="container">
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
             <form method="post" action="edit_job.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
			 
			      
				   <input type="hidden" name="emp_id" value="<?php echo $id; ?>" >
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" >
       
            
				  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Designation*:</label>
                    <div class="col-sm-10">
                      <!-- <input class="form-control" id="heading" name="designation" type="text"> -->
                      <select name="designation" id="designation" class="form-control">
                        <?php $sql = "select * from designation where status = '1'";
                              $result = mysqli_query($con,$sql);
                              if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_array($result)) { ?>
                                   <option <?php if($desig_id == $row['id']){echo "selected";} ?> value="<?php echo $row['id']; ?>"><?php echo $row['desig_name']; ?></option>
                               <?php }
                              }
                         ?>
                       
                        
                     </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Department*:</label>
                    <div class="col-sm-10">
                      <!-- <input class="form-control" id="heading" name="designation" type="text"> -->
                      <select name="department" id="department" class="form-control">
                        <?php $sql = "select * from departments where status = '1'";
                              $result = mysqli_query($con,$sql);
                              if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_array($result)) { ?>
                                   <option <?php if($dept_id == $row['id']){echo "selected";} ?> value="<?php echo $row['id']; ?>"><?php echo $row['dept_name']; ?></option>
                               <?php }
                              }
                         ?>
                       
                        
                     </select>
                    </div>
                  </div>
				  

				  
          				<div class="form-group">
                    <label class="control-label col-sm-2" for="email">Start Date*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="startdate" name="startdate" type="text" value="<?php echo $start_date; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Salary*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="salary" name="salary" type="text" value="<?php echo $salary; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Status*:</label>
                    <div class="col-sm-10">
                      <!-- <input class="form-control" id="heading" name="designation" type="text"> -->
                      <select name="status" id="status" class="form-control">
                                   <option <?php if($status == '1'){echo "selected";} ?> value="1">Enable</option>
                                   <option <?php if($status == '0'){echo "selected";} ?> value="1">Disable</option>
                               
                        
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
      <div class="row">
         
      </div>
</section>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        
      
      </div>
     
  
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
  <?php 
   include("include/footer.php");
   ?>
<!-- ./wrapper -->

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
<script>
  $('#startdate').datepicker();

</script>
</body>
</html>
