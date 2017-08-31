<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>
<?php
 $time=time();

 if(isset($_POST['submit']))
{
	    $ename =     $_POST['name'];
		  $designation =  $_POST['designation'];
      $department =  $_POST['department'];
      $address = $_POST['address'];
		  $status = '1';
      $phone_no =  $_POST['phone_no'];
      $email =  $_POST['email'];
      $dob =       $_POST['dob'];
      $country =  $_POST['country'];
      $city =  $_POST['city'];
      $salary = $_POST['salary'];
      $state =       $_POST['state'];
	  if(($status == "")||($department == "")||($designation == "")||($ename == "")||($phone_no == "")||($dob == "")||($address == "")){
      header('location:add_employee.php?error=Please Fill All Mandatory Fields');
    }
	else
	{

   $sql = "select * from employee where emp_email = '$email'";  
  $result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result) > 0){
    header("location:add_employee.php?error=Email Already Exist.!");
    exit();
  }
  
	$target_dir = "images/";
	$target_file = $target_dir . $time . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



// Checking file type....
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //header('location:add_employee.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
		$uploadOk = 0;
	}

if ($uploadOk == 0) {
    $sql = "INSERT INTO `employee`(`emp_name`, `emp_email`, `emp_phone_no`, `emp_country`, `emp_state`, `emp_city`, `emp_dob`, `emp_address`, `status`) VALUES ('$ename','$email','$phone_no','$country','$state','$city','$dob','$address','$status')";
    if(mysqli_query($con,$sql)){
      $emp_id = mysqli_insert_id($con);

      $start_date = date("Y/m/d");
        $sql= "INSERT INTO jobs(emp_id,desig_id,salary,start_date,status,dept_id)VALUES('$emp_id','$designation','$salary','$start_date','$status','$department')";
            mysqli_query($con,$sql);
      header('location:add_employee.php?success=Employee has been added');


    }else{
      header('location:add_employee.php?error=There was an error');
    }

 // header('location:add_employee.php?error=Sorry, your file was not uploaded..');
		//echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			
       $name  = $time.basename( $_FILES["file"]["name"]);
		
		// echo $sql= "INSERT INTO employee(emp_name,emp_image,emp_email,emp_phone_no,emp_country,emp_state,emp_city,emp_dob,emp_address,dept_id,status)VALUES('$ename',$name','$email','$phone_no','$country','$state','$city','$dob','$address','$department','$status')";

      $sql = "INSERT INTO `employee`(`emp_name`, `emp_image`, `emp_email`, `emp_phone_no`, `emp_country`, `emp_state`, `emp_city`, `emp_dob`, `emp_address`, `status`) VALUES ('$ename','$name','$email','$phone_no','$country','$state','$city','$dob','$address','$status')";
     
		if(mysqli_query($con,$sql)){
      $emp_id = mysqli_insert_id($con);

      $start_date = date("Y/m/d");
        $sql= "INSERT INTO jobs(emp_id,desig_id,salary,start_date,status,dept_id)VALUES('$emp_id','$designation','$salary','$start_date','$status','$department')";
            mysqli_query($con,$sql);
      header('location:add_employee.php?success=Employee has been added');

    }
		
		} else {
			header('location:add_employee.php?error=There was an error adding team member');
		}
}

	
}}

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
     <h3 style="background:#3c8dbc; padding:10px;">Add Employees</h3>
       
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
             <form method="post" action="add_employee.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
			 
			       <div class="form-group" id="image_box">
                    <label class="control-label col-sm-2" for="email">Photograph*:</label>
                    <div class="col-sm-10">
                      <input type="file" name="file" id="file">
                    </div>
                  </div>

				  
				  
				   <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Name*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="name" name="name" type="text">
                    </div>
                  </div>
				  
				  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Designation*:</label>
                    <div class="col-sm-10">
                      <!-- <input class="form-control" id="heading" name="designation" type="text"> -->
                      <select name="designation" id="designation" class="form-control">
                        <?php $sql = "select * from designation where status = '1'";
                              $result = mysqli_query($con,$sql);
                              if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_array($result)) { ?>
                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['desig_name']; ?></option>
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
                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['dept_name']; ?></option>
                               <?php }
                              }
                         ?>
                       
                        
                     </select>
                    </div>
                  </div>
				  

				  
          				 <div class="form-group">
                              <label class="control-label col-sm-2" for="email">Address*:</label>
                              <div class="col-sm-10">
          					<textarea class="form-control" id="address" name="address" rows="5"></textarea>

                    </div>
                  </div>
						
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">email:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="fb" name="email" type="email">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Phone No*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="phone_no" name="phone_no" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Date of Birth*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="dob" name="dob" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Country:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="country" name="country" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">City:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="city" name="city" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">State:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="state" name="state" type="text">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Salary:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="salary" name="salary" type="text">
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
  $('#dob').datepicker();

</script>
</body>
</html>
