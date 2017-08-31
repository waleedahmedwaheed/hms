 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="images/avatar2.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
         
        </li>
   
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>HR Module</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           
             <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Designations</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="add_designation.php"><i class="fa fa-circle-o"></i>Add Designation</a></li>
                  <li><a href="view_designation.php"><i class="fa fa-circle-o"></i>View Designations</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Departments</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="add_department.php"><i class="fa fa-circle-o"></i>Add Department</a></li>
                  <li><a href="view_department.php"><i class="fa fa-circle-o"></i>View Departments</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Employees</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="add_employee.php"><i class="fa fa-circle-o"></i>Add Employes</a></li>
                  <li><a href="view_employees.php"><i class="fa fa-circle-o"></i>View Employes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Attendes</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="emp_attendes.php"><i class="fa fa-circle-o"></i>Employes Attendes</a></li>
                  <!-- <li><a href="view_employees.php"><i class="fa fa-circle-o"></i>View Employes</a></li> -->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Reports</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="emp_attendes_report.php"><i class="fa fa-circle-o"></i>Attendes Report</a></li>
                  <!-- <li><a href="view_employees.php"><i class="fa fa-circle-o"></i>View Employes</a></li> -->
                </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Users</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_user.php"><i class="fa fa-circle-o"></i> Add User</a></li>
            <li><a href="view_users.php"><i class="fa fa-circle-o"></i> View Users</a></li>
            
          </ul>
        </li>

        <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Bills</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="add_bills.php"><i class="fa fa-circle-o"></i>Add Bill</a></li>
                   <li><a href="bill_report.php"><i class="fa fa-circle-o"></i>Bill Report</a></li>
                </ul>
            </li>
       
        <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Salary</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="salary.php"><i class="fa fa-circle-o"></i>Salary</a></li>
                   <li><a href="salary_report.php"><i class="fa fa-circle-o"></i>Salary Report</a></li>
                </ul>
            </li>
       
       
    
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>