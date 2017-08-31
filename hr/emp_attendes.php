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
          <h3 style="background:#3c8dbc; padding:10px;">Edit Attendes</h3>
       
        
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
                <th>Image</th>
				        <th>Name</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Attendes</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $sql = "select * from employee where status = '1'  LIMIT {$startpoint} , {$per_page}"; 
				  $result = mysqli_query($con,$sql);
				  $n = 1;
				  if($result){
					  while($row = mysqli_fetch_array($result)){
						 if(mysqli_num_rows($result) != 0){ 
               $sql_attendes = "select * from attendes where emp_id =".$row['id']." and date='$date'";
              $attende_result = mysqli_query($con,$sql_attendes);
              if(mysqli_num_rows($attende_result)>0){
                $flag = '1';
                $row_att = mysqli_fetch_array($attende_result);
                $timein_att = $row_att['time_in']; 
                $attendes = $row_att['type'];
                $timeout_att = $row_att['time_out'];
              }else{
                $flag = '0';
                $timein_att = ''; 
                $attendes = '';
                 $timeout_att = '';
              }

			?>
						  <tr>
							<td><?php echo $n; ?></td>
							<td><?php if($row['emp_image'] != ''){ ?>
                <img width="50" src="images/<?php echo $row['emp_image']; ?>">
                <?php }else{ ?>
                      <img width="50" src="images/avatar2.jpg">

               <?php }
                ?></td>
              <td><?php echo $row['emp_name']; ?></td>
              <td>
                <input <?php if($flag == '1'){echo "disabled";} ?> type="text" name="timein" id="timein<?php echo $row['id'] ?>" value="<?php echo $timein_att; ?>">
              </td>
              <td id="timeout_td<?php echo $row['id'] ?>">
                <input <?php if($flag == '1' && $timeout_att != '' || $attendes == '2' || $attendes == '3'){echo "disabled";} ?> type="text" name="timeout" id="timeout<?php echo $row['id'] ?>" value="<?php echo $timeout_att; ?>">
              </td>
              
              <input type="hidden" name="emp_id" id="emp_id<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="date" id="date<?php echo $row['id']; ?>" value="<?php echo date('Y/m/d'); ?>">
              
              <td>
               <div class="btn btn-success" name="timeout_btn" id="timeout_btn<?php echo $row['id']; ?>">Set Time Out</div>
              <?php if($attendes == '1'){ ?>
                 <div class="btn btn-success" name="timeout_btn1" id="timeout_btn1<?php echo $row['id']; ?>"><?php if($timeout_att != ''){ echo "Present"; }else{echo "Set Time Out";}?></div>
             <?php }else{ ?>  
                <select <?php if($flag == '1'){echo "disabled";} ?> name="attendes" id="attendes<?php echo $row['id'] ?>" class="form-control">
                 <option value=" ">Select Option</option>
                                 
                        <?php $sql1 = "select * from attendes_type where status = '1'";
                              $result1 = mysqli_query($con,$sql1);

                              if(mysqli_num_rows($result1) > 0){
                                while ($row1 = mysqli_fetch_array($result1)) { ?>
                                   <option <?php if($attendes == $row1['id']){echo "selected";} ?> value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                               <?php }
                              }
                         ?>
                       
                        
                     </select>
                     <?php } ?>
                     
              </td>
             <td><a href="edit_attendes.php?eid=<?php echo $row['id']; ?>&today=<?php echo $date; ?>">Edit</a>&nbsp;</td>
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

<script>
$(document).ready(function() {
  //$('#h_timeout').hide();

<?php $sql2 = "select * from employee where status = '1' "; 
  $result2 = mysqli_query($con,$sql2);
  if(mysqli_num_rows($result2) > 0){
    while ($row2 = mysqli_fetch_array($result2)) {

        ?>
         //$("#timeout<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
       $("#timeout_btn<?php echo $row2['id']; ?>").hide();
            
 

  $("#timeout_btn<?php echo $row2['id']; ?>").click(function(){
        var timeout = $("#timeout<?php echo $row2['id']; ?>").val();
         var emp_id = $("#emp_id<?php echo $row2['id']; ?>").val();
         var todaydate = $("#date<?php echo $row2['id']; ?>").val();
     
        if(timeout == ""){
          alert('Please enter time out first.');
        }else{
          $.ajax({
          type:"POST",
          url:"add_emp_attendes.php",
          data:{
            timeout : timeout,
            emp_id : emp_id,
            todaydate : todaydate
            
          },
          
          success: function(msg){
           
             $("#timeout<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timeout_btn<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timeout_btn<?php echo $row2['id']; ?>").html("Present");
           },
          
          error: function(){
            alert('error');
          }
        });
        }

    });


   $("#timeout_btn1<?php echo $row2['id']; ?>").click(function(){
        var timeout = $("#timeout<?php echo $row2['id']; ?>").val();
         var emp_id = $("#emp_id<?php echo $row2['id']; ?>").val();
         var todaydate = $("#date<?php echo $row2['id']; ?>").val();
     
        if(timeout == ""){
          alert('Please enter time out first.');
        }else{
          $.ajax({
          type:"POST",
          url:"add_emp_attendes.php",
          data:{
            timeout : timeout,
            emp_id : emp_id,
            todaydate : todaydate
            
          },
          
          success: function(msg){
           
             $("#timeout<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timeout_btn1<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timeout_btn1<?php echo $row2['id']; ?>").html("Present");
           },
          
          error: function(){
            alert('error');
          }
        });
        }

    });



   $("#attendes<?php echo $row2['id']; ?>").change(function() {
       var attendes = $("#attendes<?php echo $row2['id']; ?>").val();
      var timein = $("#timein<?php echo $row2['id']; ?>").val();
      var emp_id = $("#emp_id<?php echo $row2['id']; ?>").val();
      var todaydate = $("#date<?php echo $row2['id']; ?>").val();
      if(attendes == '2' || attendes == '3'){
        $("#timein<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
        $.ajax({
          type:"POST",
          url:"add_emp_attendes.php",
          data:{
            attendes : attendes,
            timein : timein,
            emp_id : emp_id,
            todaydate : todaydate
            
          },
          
          success: function(msg){
           
             $("#attendes<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timein<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timeout<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
           //  $('#timeout_td_dis<?php echo $row2['id']; ?>').show();

         
            
          },
          
          error: function(){
            alert('error');
          }
        });
      }else{
        if(attendes=='' || timein == '' || emp_id == '' || todaydate == ''){
        alert('Please Enter Time In First.');
        $("#attendes<?php echo $row2['id']; ?>").val(' ');

      }else{
         $.ajax({
          type:"POST",
          url:"add_emp_attendes.php",
          data:{
            attendes : attendes,
            timein : timein,
            emp_id : emp_id,
            todaydate : todaydate
            
          },
          
          success: function(msg){
           
             $("#attendes<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timein<?php echo $row2['id']; ?>").prop('disabled', 'disabled');
             $("#timeout<?php echo $row2['id']; ?>").prop('disabled', false);
             $("#attendes<?php echo $row2['id']; ?>").hide();
             $("#timeout_btn<?php echo $row2['id']; ?>").show();
             
        
             

          },
          
          error: function(){
            alert('error');
          }
        });
          
      }
      }
      
  });    
   <?php   }
  } ?>
});
</script>

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
