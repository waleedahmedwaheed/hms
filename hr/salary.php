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
         
         <h3 style="background:#3c8dbc; padding:10px;">Salary</h3>
       
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
         <div  class="row" style="padding-bottom:20px;">
         <div  id="print_report" class="col-lg-12 table-responsive">   
          <?php if(isset($_POST['report'])){ 
            $employee = $_POST['emp'];
            $to = $_POST['to'];
            $from = $_POST['from'];

            $to = date('Y/m/d',strtotime($to) );
             $from = date('Y/m/d',strtotime($from) );


             $sql1 = "select count(*) as absents from attendes where emp_id ='$employee' and date <= '$to' AND date >= '$from' and attendes.type='2'";
                         $result1 = mysqli_query($con , $sql1);
                          $absents=mysqli_fetch_array($result1);

              $sql2 = "select count(*) as Leaves from attendes where emp_id ='$employee' and date <= '$to' AND date >= '$from' and attendes.type='3'";
                         $result2 = mysqli_query($con , $sql2);
                          $Leaves=mysqli_fetch_array($result2);


                $sql3 = "select * from jobs where emp_id ='$employee' order by id DESC limit 1";
                         $result3 = mysqli_query($con , $sql3);
                          $jobs=mysqli_fetch_array($result3);   
                
          ?><table class="table table-striped">
            <thead>
              <tr>
                <th>Image</th>
				        <th>Name</th>
                <th>Presents</th>
                <th>Absents</th>
                <th>Leaves</th>
                <th>Salary</th>
                <th>include Bonus</th>
                <th>Total Salary</th>
                
              </tr>
            </thead>
            <tbody>
            <?php  
                         $sql = "select count(attendes.id) as presents,attendes.*,employee.* from attendes
                         INNER JOIN employee ON attendes.emp_id = employee.id
                         where attendes.emp_id ='$employee' and attendes.date <= '$to' AND attendes.date >= '$from' and attendes.type='1'
                         "
                         ; 
                         
                        
                  $result = mysqli_query($con , $sql);
                  if(mysqli_num_rows($result)>0){
                     while ($row = mysqli_fetch_array($result)) { 
                       $salary_tot = ($jobs['salary']/30)*$row['presents'];
                      ?>
                        <tr>
                          <td>
                              <?php if($row['emp_image'] != ''){ ?>
                              <img width="50" src="images/<?php echo $row['emp_image']; ?>">
                              <?php }else{ ?>
                                    <img width="50" src="images/avatar2.jpg">

                             <?php }
                              ?>
                          </td>
                          <td><?php echo $row['emp_name']; ?></td>
                          <td><?php echo $row['presents']; ?></td>
                          <td><?php echo $absents['absents']; ?></td>
                          <td><?php echo $Leaves['Leaves']; ?></td>
                          <td id="" ><?php echo $salary_tot; ?></td>
                           <td id ="bonusdiv"><label><input id="include_bonus" type="checkbox"></label>
                          <td id="salary_box" ><?php echo $salary_tot; ?></td>
                         </td>
                          
                        </tr>
                        <tr><td colspan="7">
                          
             <input type="hidden" id="salary_total" name="salary_total" value="<?php echo $salary_tot; ?>" >
             <input type="hidden" id="presents_input" name="presents_input" value="<?php echo  $row['presents']; ?>" >
             <input type="hidden" id="absents_input" name="absents_input" value="<?php echo  $Leaves['Leaves']; ?>" >
             <input type="hidden" id="leaves_input" name="leaves_input" value="<?php echo  $absents['absents']; ?>" >

            <input type="hidden" id="to_input" name="to_input" value="<?php echo  $to; ?>" >
             <input type="hidden" id="from_input" name="from_input" value="<?php echo  $from; ?>" >
             <input type="hidden" id="emp_input" name="emp_input" value="<?php echo  $employee; ?>" >       
          
           <div id="bonus_box" class="form-group">
                    <label class="control-label col-sm-2" for="email">Bonus:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="bonus" name="bonus" type="text">
                    </div>
                  </div>
                  
                  <!--<div class="form-group">
                    <label class="control-label col-sm-2" for="email">Code*:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="code" name="code" type="text">
                    </div>
                  </div>
                  
                  -->
               </td></tr>
                      <?php 
                  } ?>
                 
                    <tr id="slip_btn">
                      <td  colspan="7"></td>
                      <td><button id="slip" name="submit" type="button" class="btn btn-default">Add Bonus</button></td>
                    </tr>
                  <?php }else{
                    echo "<tr><td colspan='7'>No Record Found</td></tr>";
                  }
            ?>
            </tbody>
          </table>
          
      </div>
          <button id="print" type="button" style="float:right; margin-right:20px;" class="btn btn-info" onclick="printDiv('print_report')" >Generate and Print Pay Slip</button>
          <?php } ?>
      <?php   // echo pagination('employee',$per_page,$page,$url='?');?>
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
   $('#bonus_box').hide();
$('#slip_btn').hide();
$('#include_bonus').click(function() {
    $("#bonus_box").toggle(this.checked);
    $('#slip_btn').toggle(this.checked);
     $('#slip').show();
     $('#print').hide();


});
$('#slip').click(function(){
  var salary = parseInt($('#salary_total').val());
  var bonus = parseInt($('#bonus').val());
  var tot_sal = salary + bonus;
   $('#print').show();
  if(isNaN(bonus)){
     $('#salary_box').html(salary);
     $('#include_bonus').hide();
     $('#bonusdiv').html('Not Included');
     
    
  }else{
     $('#salary_box').html(tot_sal);
     $('#include_bonus').hide();
     $('#bonusdiv').html('Included'+'('+bonus+')');
     
  }
  
  $("#bonus_box").hide();
    
   $('#slip').hide();
  $('#include_bonus').prop('checked', true);


  //alert(tot_sal);

});
</script>
<script type="text/javascript">
//    $('#to').datepicker();
//    $('#from').datepicker();
// $('#bonus_box').hide();
// $('#slip_btn').hide();
// $('#include_bonus').click(function() {
//     $("#bonus_box").toggle(this.checked);
//     $('#slip_btn').toggle(this.checked);
//      $('#slip').show();
//      $('#print').hide();


// });

   function printDiv(divName) {
    $('#include_bonus').hide();
     var bonus = parseInt($('#bonus').val());
     var emp_id = $("#emp_input").val();
     var to = $("#to_input").val();
     var from =$("#from_input").val(); 
     var presents = $("#presents_input").val();
     var absents = $("#absents_input").val();
     var leaves = $("#leaves_input").val();
     var salary = parseInt($('#salary_total').val());
  
 if(isNaN(bonus)){
      var bonus = '0';
      var tot_sal = salary;
 
     $('#bonusdiv').html('Not Included');
    }else{
      var tot_sal = salary + bonus;
 
      $('#bonusdiv').html('Included'+'('+bonus+')');
     
    }

     $.ajax({
          type:"POST",
          url:"add_salary.php",
          data:{
            bonus : bonus,
            emp_id : emp_id,
            to : to,
            from : from,
            leaves : leaves,
            presents : presents,
            absents : absents,
            salary : salary,
            tot_sal : tot_sal

          },
          
          success: function(msg){
           alert(msg);
             if(msg == '1'){
               var printContents = document.getElementById(divName).innerHTML;
               var originalContents = document.body.innerHTML;

               document.body.innerHTML = printContents;

               window.print();

               document.body.innerHTML = originalContents;
             }else if(msg == "Already Exist"){
              alert('Pay Slip Already Generated');

             }
             else{
              alert("Some thing going wrong please try again");
             }
         
            
          },
          
          error: function(){
            alert('error');
          }
        });
     
    
    

}

</script>
</body>
</html>