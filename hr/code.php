 <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Designation*:</label>
                    <div class="col-sm-10">
                      <!-- <input class="form-control" id="heading" name="designation" type="text"> -->
                      <select name="designation" id="designation" class="form-control">
                        <?php $sql = "select * from designation where status = '1'";
                              $result = mysqli_query($con,$sql);
                              if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_array($result)) { ?>
                                   <option <?php if($desg == $row['id']){echo 'selected';} ?>  value="<?php echo $row['id']; ?>"><?php echo $row['desig_name']; ?></option>
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
                                   <option <?php if($dept == $row['id']){echo 'selected';} ?> value="<?php echo $row['id']; ?>"><?php echo $row['dept_name']; ?></option>
                               <?php }
                              }
                         ?>
                       
                        
                     </select>
                    </div>
                  </div>
          

          
         <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Salary:</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="salary" name="salary" type="text" value="<?php echo $salary; ?>" >
                    </div>
                  </div>