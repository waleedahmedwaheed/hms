<!DOCTYPE html>
<?php include("include/connection.php");?>
<?php include("include/header.php"); ?>

<?php
$date = date('Y/m/d');
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
         
         <h3 style="background:#3c8dbc; padding:10px;">Attendes Report</h3>
       
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
            <?php if(isset($_POST['report'])){ 
            $employee = $_POST['emp'];
            $to = $_POST['to'];
            $from = $_POST['from'];}

            //$to = date('Y/m/d',strtotime($to) );
             //$from = date('Y/m/d',strtotime($from) );

          ?>
           
        <div class="row" style="padding-bottom:20px;">
          <form method="post" action="">
            <div class="col-md-3"><div class="form-group">
                    <label class="control-label col-sm-2" for="email">Employee*:</label>
                    <div class="col-sm-10">
                      <select name="emp" id="emp" class="form-control">
                       <option value=" ">Select Option</option>
                                       
                              <?php $sql1 = "select * from employee where status = '1'";
                                    $result1 = mysqli_query($con,$sql1);

                                    if(mysqli_num_rows($result1) > 0){
                                      while ($row1 = mysqli_fetch_array($result1)) { ?>
                                         <option <?php if(isset($_POST['report'])){  if($employee == $row1['id']){echo "selected";} }?> value="<?php echo $row1['id']; ?>"><?php echo $row1['emp_name']; ?></option>
                                     <?php }
                                    }
                               ?>
                             
                              
                           </select>
                    </div>
                  </div></div>
                   <div class="col-md-3"><div class="form-group">
                    <label class="control-label col-sm-2" for="email">from*:</label>
                    <div class="col-sm-10">
                     <input class="form-control" id="from" name="from" type="text" value="<?php if(isset($_POST['report'])){  echo $from; } ?>">
                    </div>
                  </div></div>
            <div class="col-md-3"><div class="form-group">
                    <label class="control-label col-sm-2" for="email">To*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="to" name="to" type="text" value="<?php if(isset($_POST['report'])){ echo $to; } ?>">
                    </div>
                  </div></div>
           
                  <div class="col-md-3"><label class="control-label col-sm-2" for="email">
                    <br>
                  </label><div class="col-sm-10"><button name="report" type="submit" class="btn btn-primary">Submit</button></div></div>
          </form>
        </div>
         <div  id="print_report" class="row" style="padding-bottom:20px;">
         <div class="col-lg-12 table-responsive">   
          <?php if(isset($_POST['report'])){ 
            $employee = $_POST['emp'];
            $to = $_POST['to'];
            $from = $_POST['from'];

            $to = date('Y/m/d',strtotime($to) );
             $from = date('Y/m/d',strtotime($from) );

          ?><table class="table table-striped">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Image</th>
				        <th>Name</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Attendes</th>
                <th>Date</th>
                
              </tr>
            </thead>
            <tbody>
            <?php   $sql= "select attendes.*,employee.*,attendes_type.name as att_type,attendes_type.id from attendes
                         INNER JOIN employee ON
                         attendes.emp_id = employee.id
                         INNER JOIN attendes_type ON
                         attendes.type = attendes_type.id
                         where attendes.emp_id ='$employee' and attendes.date <= '$to' AND attendes.date >= '$from'"; 

                  $result = mysqli_query($con , $sql);
                  $n = 1;
                  if(mysqli_num_rows($result)>0){
                     while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                          <td><?php echo $n; ?></td>
                          <td>
                              <?php if($row['emp_image'] != ''){ ?>
                              <img width="50" src="images/<?php echo $row['emp_image']; ?>">
                              <?php }else{ ?>
                                    <img width="50" src="images/avatar2.jpg">

                             <?php }
                              ?>
                          </td>
                          <td><?php echo $row['emp_name']; ?></td>
                          <td><?php echo $row['time_in']; ?></td>
                          <td><?php echo $row['time_out']; ?></td>
                          <td><?php echo $row['att_type']; ?></td>
                          <td><?php echo $row['date']; ?></td>
                        </tr>
                      <?php 
                    $n++;} ?>
                    <tr>
                      <td colspan="7"><button style="float:right" class="btn btn-info" onclick="printDiv('print_report')" >Print</button></td>
                    </tr>
                  <?php }else{
                    echo "<tr><td colspan='7'>No Record Found</td></tr>";
                  }
            ?>
            </tbody>
          </table>
          <?php } ?>
      <?php   // echo pagination('employee',$per_page,$page,$url='?');?>
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
  var cf = confirm('Are you sure to delete this Employee?');
  if(cf){
    window.location = 'employee_del.php?id=' + id;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


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
<script type="text/javascript">
   $('#to').datepicker();
   $('#from').datepicker();

   function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
</body>
</html>