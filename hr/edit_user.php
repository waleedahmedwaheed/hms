<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>
<?php

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $sql = "select * from tbl_user where id = '$id'";
  $result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    $name = $row['strUName'];
    $email = $row['strUEmail'];
    $code = $row['strUCode'];
  }

}

 $time=time();

 if(isset($_POST['submit']))
{
	    $name =     $_POST['name'];
		  //$pass =  $_POST['pass'];
      //$cpass =  $_POST['cpass'];
      $email =  $_POST['email'];
      $code =       $_POST['code'];
      $uid = $_POST['uid'];
	  if(($name == "")||($email == "")||($code == "")){
      header('location:edit_user.php?error=Please Fill All Mandatory Fields&id='.$uid);
    }
	else
	{
  // if($pass != $cpass){
  //   header("location:edit_user.php?error=Password Does Not Match Please Enter Again.!");
  //   exit();
  // }else{
   // $inc_pass = md5(md5($pass));
     $sql = "select * from tbl_user where strUEmail = '$email' and id != '$uid'";  
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result) > 0){
        header("location:edit_user.php?error=Email Already Exist.!id=".$uid);
        exit();
      }
      $sql = "select * from tbl_user where strUCode = '$code' and id != $uid";  
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result) > 0){
        header("location:edit_user.php?error=User Code Already Exist.!&id=".$uid);
        exit();
      }
      //$sql = "INSERT INTO `tbl_user`(`strUName`, `strUEmail`, `strUPass`, `strUCode`, `nH_id`, `level`) VALUES ('$name','$email','$inc_pass','$code','1','1')";
     $sql = "update tbl_user set
              strUName = '$name',
              strUEmail = '$email',
              strUCode = '$code'
              where id = '$uid'";
    if(mysqli_query($con,$sql)){
       header('location:edit_user.php?success=User has been Updated&id='.$uid);

    } else {
      header('location:edit_user.php?error=There was an error updating User&id='.$uid);
    }


  //}
	
}
}
if(isset($_POST['chng_pas'])){
  $pass =  $_POST['pass'];
  $cpass =  $_POST['cpass'];
  $opass =  $_POST['opass'];
  $uid =  $_POST['uid'];
  if($pass !='' && $cpass != '' && $opass != ''){
  if($pass == $cpass){
    $o_inc_pass = md5(md5($opass));
     $sql = "select * from tbl_user where strUPass = '$o_inc_pass' and id = '$uid'";  
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result) > 0){

        $inc_pass = md5(md5($pass));
        $sql = "update tbl_user set
              strUPass = '$inc_pass'
              where id = '$uid'";
        if(mysqli_query($con,$sql)){
            header('location:edit_user.php?success=User has been Updated&id='.$uid);

        } else {
          header('location:edit_user.php?error=There was an error updating User&id='.$uid);
        }
            
      } else{
        header("location:edit_user.php?error=Password Does Not Match With Database Password.!&id=".$uid);
        exit();
      } 
    }else{
    header("location:edit_user.php?error=Password Does Not Match Please Enter Again.!&id=".$uid);
    exit();
  }
}else{
  header('location:edit_user.php?error=Please Fill All Mandatory Fields&id='.$uid);
  exit();
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
     <h3 style="background:#3c8dbc; padding:10px;">Edit User</h3>
       
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
             <form method="post" action="edit_user.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             <input type="hidden" name="cmd" value="cmd" >
			 
			      <input type="hidden" name="uid" value="<?php echo $id; ?>">
				  
				   <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Name*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="name" name="name" type="text" value="<?php echo $name;?>">
                    </div>
                  </div>
				          <div class="form-group">
                    <label class="control-label col-sm-2" for="email">email:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="fb" name="email" type="email" value="<?php echo $email;?>">
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Code*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="code" name="code" type="text" value="<?php echo $code;?>">
                    </div>
                  </div>
                  
                  <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                      <button name="submit" type="submit" class="btn btn-default">Submit</button>
                    </div>
                  </div>
			</form>
             </div>


                    <div class="col-lg-12">   
                    <h2>Change Password</h2>
             <form method="post" action="edit_user.php" class="form-horizontal" role="form" enctype="multipart/form-data">
            <input type="hidden" name="uid" value="<?php echo $id; ?>">

             <input type="hidden" name="cmd" value="cmd" >
                         <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Old Password*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="opass" name="opass" type="password">
                    </div>
                  </div>
           
            
          
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Password*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="pass" name="pass" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Confirm Password*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="cpass" name="cpass" type="password">
                    </div>
                  </div>
                  
                  <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                      <button name="chng_pas" type="submit" class="btn btn-default">Submit</button>
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
