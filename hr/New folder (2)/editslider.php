<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>


<?php 
if(isset($_GET['id'])){
  $id = $_GET['id'];

  $sql = "select * from slider where id = '$id' and status = '1'";
  $slider_result = mysqli_query($con,$sql);
  if($slider_result){
    if(mysqli_num_rows($slider_result) > 0){
      $slider_row = mysqli_fetch_array($slider_result);
      $front = $slider_row['img2'];
      $background = $slider_row['img'];
      $title = $slider_row['title'];
      $title2 = $slider_row['title2'];
      $status = $slider_row['status'];
       
    }
  }

}

 ?>

<?php
if(isset($_POST['submit']))
{
	$title =  $_POST['title'];
	$sub_title = $_POST['sub_title'];
    $status = $_POST['status'];
    $id = $_POST['id'];
	  if(($status == "")||($title == "")||($sub_title == "")){
      header('location:addslider.php?error=Please Fill All Mandatory Fields');
    }
	else
	{
	
	$target_dir = "../assets/images/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


  $target_file1 = $target_dir . basename($_FILES["file1"]["name"]);
  $uploadOk1 = 1;
  $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);

  if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
  && $imageFileType1 != "gif" ) {
   header("location:addslider.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk1 = 0;
  }
  if ($uploadOk1 == 0) {
    header("location:addslider.php?error=Sorry,Front Image was not uploaded..");
  // if everything is ok, try to upload file
  } 
else {
  if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file1)) {
       $name1  = basename( $_FILES["file1"]["name"]);
    
      $sql = "update slider set title = '$title' , title2 = '$sub_title' , img2 = '$name1' , status = '$status' where id = '$id'";
      
    mysqli_query($con,$sql);
    header("location:slider.php?success=Contents has been successfully Uploded....");
    }else {
       $msg = "Sorry, there was an error uploading your file.";
       header("location:addslider.php?error=Sorry, there was an error uploading Front Image..");
    }
}

// Checking file type....
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		header("location:addslider.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
	}

if ($uploadOk == 0) {
		$sql = "update slider set title = '$title' , title2 = '$sub_title' , status = '$status' where id = '$id'";
    mysqli_query($con,$sql);
      //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    header("location:slider.php?success=Contents has been successfully Uploded....");
	} else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			 $name  = basename( $_FILES["file"]["name"]);
		
      $sql = "update slider set title = '$title' , title2 = '$sub_title' , img = '$name', status = '$status' where id = '$id'";
		  //$sql= "INSERT INTO slider(title,title2,img,img2,status) VALUES ('$title','$sub_title','$name','$name1','$status')";
		mysqli_query($con,$sql);
		  //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    header("location:slider.php?success=Contents has been successfully Uploded....");
		    //$show = "Contents has been successfully Uploded....";
		} else {
			 header("location:slider.php?error=Some thing going wrong please try again");
    
		}
}}}

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
                    <div style="width:50%; padding-top:20px;" class="container">
		    
           </div>
          
         <div class="row" style="padding-bottom:20px;">
             <div class="col-lg-12">   
             <form method="post" action="editslider.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
             <input type="hidden" name="id" value="<?php echo $id; ?>" >
             	  <div class="form-group" id="image_box">
                    <label class="control-label col-sm-2" for="email">Background Image:</label>
                    <div class="col-sm-6">
                      <input type="file" name="file" id="file">
                    </div>
                    <div class="col-sm-6">
                      <img width="100" src="../assets/images/<?php echo $background; ?>">
                    </div>
                  </div>
				    <div class="form-group" id="image_box">
                    <label class="control-label col-sm-2" for="email">Front Image:</label>
                    <div class="col-sm-6">
                      <input type="file" name="file1" id="file1">
                    </div>
                    <div class="col-sm-6">
                      <img width="100" src="../assets/images/<?php echo $front; ?>">
                    </div>
                  </div>
          
				  
				   <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Title:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="heading" name="title" type="text" value="<?php echo $title; ?>">
                    </div>
                  </div>
				  
				  
				 <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Sub Title:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="heading" name="sub_title" type="text" value="<?php echo $title2; ?>">
                    </div>
                  </div>
						
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Status:</label>
                    <div class="col-sm-10"> 
                     <select name="status" id="status" class="form-control">
                     	<option <?php if($status == '1'){echo "selected";} ?> value="1">Enabled</option>
                        <option <?php if($status == '0'){echo "selected";} ?> value="0">Disabled</option>
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
</body>
</html>
