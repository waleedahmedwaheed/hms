<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>

<?php

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $sql = "select * from pages where id = '$id' and status = '1'";
  $slider_result = mysqli_query($con,$sql);
  if($slider_result){
    if(mysqli_num_rows($slider_result) > 0){
      $slider_row = mysqli_fetch_array($slider_result);
      $title = $slider_row['title'];
      $description = $slider_row['description'];
      $page_id = $slider_row['services_menu'];
      $status = $slider_row['status'];
       
    }
  }

}


if(isset($_POST['submit']))
{
	$page_id = $_POST['page_id'];
  $desc = $_POST['desc'];
	$title = $_POST['title'];
    $status = $_POST['status'];
    $id = $_POST['id'];
	  if(($page_id == "")||($title == "")||($status == "")||($desc == "")){
      header('location:editpages.php?error=Please Fill All Mandatory Fields');
    }
	else
	{
		$chk_page_sql = "select * from pages where services_menu = '$page_id' and id !='$id'";
    $result = mysqli_query($con,$chk_page_sql);
    if($result)

    {
      if(mysqli_num_rows($result)>0){
          header('location:editpages.php?error=This Service Page is alreday Exist&id='.$id);

      }else{
        $sql= "Update pages set title = '$title',description='$desc',services_menu='$page_id',status='$status' where id ='$id'";
  if(mysqli_query($con,$sql))
       {
      //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            header('location:view_pages.php?success=Data has been Updated');


     } 
    else
    {
      header('location:editpages.php?error=There was an error updating Content');

    }

      }
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
             <form method="post" action="editpages.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
             <input type="hidden" name="id" value="<?php echo $id; ?>" >
             	 
				   <div class="form-group">
                    <label class="control-label col-sm-2" for="query">Title:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="percentage" name="title" type="text" value="<?php echo $title; ?>">
                    </div>
                  </div>
				  
				  
				          <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Description:</label>
                    <div class="col-sm-10">
					           <textarea name="desc" id="desc"><?php echo $description; ?></textarea>
                    </div>
                  </div>
				          
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Service Page:</label>
                    <div class="col-sm-10"> 
                     <select name="page_id" id="page_id" class="form-control">
                     	<?php $sql = "select * from services_menu where status = '1'";
                      $result = mysqli_query($con,$sql);
                      if($result){
                        if(mysqli_num_rows($result)>0){
                          while($row = mysqli_fetch_array($result)){ ?>
                            <option  <?php if($page_id == $row['id']){echo "selected";} ?>  value="<?php echo $row['id']; ?>"><?php echo  $row['title']; ?></option>
                      <?php  }
                          }
                          }                      ?>
                      
                       
                     </select>
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

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js"></script>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script type="text/javascript">
  tinymce.init({
  selector: '#desc',
  height: 300,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
</script>
</body>
</html>
