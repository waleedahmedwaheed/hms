<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>
<?php

if(isset($_GET['id'])){
  $id = $_GET['id'];

  // $sql = "select * from employee where 
  //         INNER JOIN jobs 
  //         ON jobs.emp_id=employee.id
  //         where
  //         employee.id = '$id' and employee.status = '1'";

      $sql =" SELECT *
            FROM employee
            INNER JOIN jobs
            ON jobs.emp_id=employee.id
            where employee.id = '$id' and employee.status = '1'";
  $slider_result = mysqli_query($con,$sql);
  if($slider_result){
    if(mysqli_num_rows($slider_result) > 0){
      $row = mysqli_fetch_array($slider_result);
      $img =$row['emp_image'];
      $name = $row['emp_name'];
      $email = $row['emp_email'];
      $phone_no = $row['emp_phone_no'];
      $country = $row['emp_country'];
      $state = $row['emp_state'];
      $city = $row['emp_city'];
      $dob = $row['emp_dob'];
     // strtotime($dob);
       $f_dob = date('m/d/Y',strtotime($dob) );
      $address = $row['emp_address'];
      $desg = $row['desig_id'];
      $salary = $row['salary'];
      $dept = $row['dept_id'];
      $status = $row['status'];
       
    }
  }

}

 $time=time();

 if(isset($_POST['submit']))
{
      $ename =     $_POST['name'];

      $id =     $_POST['eid'];

     // $designation =  $_POST['designation'];
     // $department =  $_POST['department'];
      $address = $_POST['address'];
      $status = '1';
      $phone_no =  $_POST['phone_no'];
      $email =  $_POST['email'];
      $dob =       $_POST['dob'];
      $country =  $_POST['country'];
      $city =  $_POST['city'];
     // $salary = $_POST['salary'];
      $state =       $_POST['state'];
    if(($status == "")||($ename == "")||($phone_no == "")||($dob == "")||($address == "")){
      header('location:edit_employee.php?error=Please Fill All Mandatory Fields&id='.$id);
    }
	else
	{
	
	$target_dir = "images/";
  $target_file = $target_dir . $time . basename($_FILES["file"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



// Checking file type....
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

if ($uploadOk == 0) {
		$sql = "update employee
            set
              emp_name = '$ename',
              emp_email = '$email',
              emp_phone_no = '$phone_no',
              emp_country = '$country',
              emp_state = '$state',
              emp_city = '$city',
              emp_dob='$dob',
              emp_address = '$address',
              status = '$status'
            where
              id = '$id'";
     // $sql= "INSERT INTO team(img,name,designation,introduction,facebook,linkedin,twitter,status)VALUES('$name','$employee','$designation','$description','$fb','$li','$twitter','$status')";
    mysqli_query($con,$sql);
      //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
              header('location:edit_employee.php?success=Employee has been Updated&id='.$id);
	} else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			// $name_img  = basename( $_FILES["file"]["name"]);
              $name  = $time.basename( $_FILES["file"]["name"]);

		$sql = "update employee
            set
              emp_name = '$ename',
              emp_email = '$email',
              emp_image = '$name',
              emp_phone_no = '$phone_no',
              emp_country = '$country',
              emp_state = '$state',
              emp_city = '$city',
              emp_dob='$dob',
              emp_address = '$address',
              status = '$status'
            where
              id = '$id'";
     // $sql= "INSERT INTO team(img,name,designation,introduction,facebook,linkedin,twitter,status)VALUES('$name','$employee','$designation','$description','$fb','$li','$twitter','$status')";
		mysqli_query($con,$sql);
		  //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		  		    header('location:edit_employee.php?success=Employee has been updated&id='.$id);

		} else {
			header('location:edit_employee.php?error=There was an error adding Employee&id='.$id);
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
    <h3 style="background:#3c8dbc; padding:10px;">Edit Employee</h3>
   
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
             <form method="post" action="edit_employee.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
            <input type="hidden" name="eid" value="<?php echo $id; ?>" >
       
             <div class="form-group" id="image_box">
                    <label class="control-label col-sm-2" for="email">Photograph*:</label>
                    <div class="col-sm-10">
                      <input type="file" name="file" id="file">
                      <?php if($img != ''){ ?><img width="92" src="images/<?php echo $img; ?>"><?php }?>
                    </div>
                  </div>

          
          
           <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Name*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="name" name="name" type="text" value="<?php echo $name; ?>">
                    </div>
                  </div>
          
                   <div class="form-group">
                              <label class="control-label col-sm-2" for="email">Address*:</label>
                              <div class="col-sm-10">
                    <textarea class="form-control" id="address" name="address" rows="5"><?php echo $address; ?></textarea>

                    </div>
                  </div>
            
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">email:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="fb" name="email" type="email" value="<?php echo $email; ?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Phone No*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="phone_no" name="phone_no" type="text" value="<?php echo $phone_no; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Date of Birth*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="dob" name="dob" type="text" value="<?php echo $dob; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Country:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="country" name="country" type="text" value="<?php echo $country; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">City:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="city" name="city" type="text" value="<?php echo $city; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">State:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="state" name="state" type="text" value="<?php echo $state; ?>">
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
var startdate = $("#dob").val();  
            
            $("#dob").datepicker("setDate",startdate);

  $('#dob').datepicker();

</script>
</body>
</html>
