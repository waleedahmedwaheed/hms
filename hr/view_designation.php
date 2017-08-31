<!DOCTYPE html>
<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>

<?php


?>  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!----header----->
  <?php 
  include("include/top_header.php");
  ?>

  <!-- Left side column. contains the logo and sidebar -->
  <!--------------left menu------------>
  <?php 
  
  include('functions/function.php');

  ?>
  
<?php  $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) 
	{
		$page = 1;
	}
$per_page = 5; // Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page;
 ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<?php include("include/nav.php");?>
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
        
		<div style="width:100%;" class="container">
         <h3 style="background:#3c8dbc; padding:10px;">View Designation</h3>
       
        
		     <?php if(isset($_GET['error'])){ ?>
          <br><br>
       
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?php echo $_GET['error']; ?>
           </div>
        <?php } ?>
        <?php if(isset($_GET['success'])){ ?>
           <br><br>
       
           <div class="alert alert-success" role="alert">
                <strong>Success!</strong> <?php echo $_GET['success']; ?>
           </div>
        <?php } ?>   
           
           
       
         <div class="row" style="padding-bottom:20px;">
         <div class="col-lg-12 table-responsive">   
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Code</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $sql = "select * from designation where status = '1'  LIMIT {$startpoint} , {$per_page}"; 
				  $result = mysqli_query($con,$sql);
				  $n = 1;
				  if($result){
					  while($row = mysqli_fetch_array($result)){
						 if(mysqli_num_rows($result) != 0){ 
			?>
						  <tr>
							<td><?php echo $n; ?></td>
							<td><?php echo $row['desig_name']; ?></td>
              <td><?php echo $row['desig_code']; ?></td>
              <td><a href="edit_designation.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;|&nbsp;<a onClick="javascript: confdel('<?php echo $row['id']; ?>');" href="#">Delete</a></td>
						  </tr>
				 <?php }
				 	$n++;
					  }
				  }?>
            </tbody>
          </table>
      <?php    echo pagination('employee',$per_page,$page,$url='?');?>
       	</div>
       	</div>
       </div>
                
       
      </div>
      

              

        </section>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>
  <script language="JavaScript">
<!--
function confdel(id){
  var cf = confirm('Are you sure to delete this Designation?');
  if(cf){
    window.location = 'desg_del.php?id=' + id;
  }
}
-->
</script>  
  <script language="JavaScript">
<!--

-->
</script>
  
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
