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
    <h3 style="background:#3c8dbc; padding:10px;">Bill Report</h3>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
		<div style="width:100%;" class="container">
         
        
		    <br><br>
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
            <?php if(isset($_POST['report'])){ 
            $month = $_POST['month'];
            $year = $_POST['year'];
            $type = $_POST['type'];}

            //$to = date('Y/m/d',strtotime($to) );
             //$from = date('Y/m/d',strtotime($from) );

          ?>
           
        <div class="row" style="padding-bottom:20px;">
          <form method="post" action="">
            <div class="col-md-3"><div class="form-group">
                    <label class="control-label col-sm-2" for="email"> Type*:</label>
                    <div class="col-sm-10">
                      <select name="type" id="type" class="form-control">
                                       
                              <?php $sql1 = "select * from bill_type where status = '1'";
                                    $result1 = mysqli_query($con,$sql1);

                                    if(mysqli_num_rows($result1) > 0){
                                      while ($row1 = mysqli_fetch_array($result1)) { ?>
                                         <option <?php if(isset($_POST['report'])){  if($type == $row1['id']){echo "selected";} }?> value="<?php echo $row1['id']; ?>"><?php echo $row1['title']; ?></option>

                                     <?php }
                                    }
                               ?>
                             
                              
                           </select>
                    </div>
                  </div></div>
            <div class="col-md-3"><div class="form-group">
                    <label class="control-label col-sm-2" for="email">Month*:</label>
                    <div class="col-sm-10">
                      
                      <select class="form-control" id="month" name="month">
                       <option value="">Select Month</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'jan'){echo "selected";} }?> value="jan">Jan</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'feb'){echo "selected";} }?> value="feb">Feb</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'mar'){echo "selected";} }?> value="mar">Mar</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'apr'){echo "selected";} }?> value="apr">Apr</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'may'){echo "selected";} }?> value="may">May</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'jun'){echo "selected";} }?> value="jun">Jun</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'jul'){echo "selected";} }?> value="jul">Jul</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'aug'){echo "selected";} }?> value="aug">Aug</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'sep'){echo "selected";} }?> value="sep">Sep</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'oct'){echo "selected";} }?> value="oct">Oct</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'nov'){echo "selected";} }?>  value="nov">Nov</option>
                        <option <?php if(isset($_POST['report'])){  if($month == 'dec'){echo "selected";} }?> value="dec">Dec</option>
 
                        
                        
                      </select>
                    </div>
                  </div></div>
            <div class="col-md-3"><div class="form-group">
                    <label class="control-label col-sm-2" for="email">Year*:</label>
                    <div class="col-sm-10">
                     <select class="form-control" id="year" name="year">
                        <option value="">Select Year</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2016'){echo "selected";} }?> value="2016">2016</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2017'){echo "selected";} }?> value="2017">2016</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2018'){echo "selected";} }?> value="2018">2018</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2019'){echo "selected";} }?> value="2019">2019</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2020'){echo "selected";} }?> value="2020">2020</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2021'){echo "selected";} }?> value="2021">2021</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2022'){echo "selected";} }?> value="2022">2022</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2023'){echo "selected";} }?> value="2023">2023</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2024'){echo "selected";} }?> value="2024">2024</option>
                        <option <?php if(isset($_POST['report'])){  if($year == '2025'){echo "selected";} }?> value="2025">2025</option>
                        
                      </select>
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
            $year = $_POST['year'];
            $month = $_POST['month'];
            $type = $_POST['type'];

            

          ?><table class="table table-striped">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Bill Type</th>
				        <th>Bill Month</th>
                <th>Bill Year</th>
                <th>Bill Amount</th>
                <th>Bill Date</th>
                
                
              </tr>
            </thead>
            <tbody>
            <?php   //$sql= "select attendes.*,employee.*,attendes_type.name as att_type,attendes_type.id from attendes
                         //INNER JOIN employee ON
                         //attendes.emp_id = employee.id
                         //INNER JOIN attendes_type ON
                         //attendes.type = attendes_type.id
                         //where attendes.emp_id ='$employee' and attendes.date >= '$to' AND a//ttendes.date <= '$from'"; 
          
           $sql= "select bills.*,bill_type.* from bills
                         INNER JOIN bill_type ON
                         bills.type = bill_type.id
                         where bills.type ='$type' "; 
              if($_POST['month'] != ''){
                $sql .= "and bills.month = '$month' ";
              }
              if($_POST['year'] != ''){
                $sql .= "AND bills.year = '$year' ";
              }

                  $result = mysqli_query($con , $sql);
                  $n = 1;
                  if(mysqli_num_rows($result)>0){
                     while ($row = mysqli_fetch_array($result)) { 

                      $bill_date = strtotime($row['bill_date']);
                      $bill_date = date('m/d/Y',$bill_date);
                      ?>
                        <tr>
                          <td><?php echo $n; ?></td>
                          
                          <td><?php echo $row['title']; ?></td>
                          <td><?php echo $row['month']; ?></td>
                          <td><?php echo $row['year']; ?></td>
                          <td><?php echo $row['amount']; ?></td>
                          <td><?php echo $bill_date; ?></td>
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