<!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" ><img src="gridbq1i_logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden"><img src="images/G.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <!-- add Collapse Enquiries menu-->
                    <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo">Enquiries</a>
                    </li>
                    <!-- Collapse div for enquiries -->
                    <div id="demo" class="collapse" style="width: 100%;">
                   <li>
                        <a href="business_enquiries.php"> <i class="menu-icon fa fa-table"></i>Business Enquiries </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-email"></i>Contact Enquiries</a>
                        <ul class="sub-menu children dropdown-menu">
                           <!-- <li><i class="fa fa-table"></i><a href="business_enquiries.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Business Enquiries </a></li> -->
                            <li><i class="fa fa-table"></i><a href="partnership_enquiries.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Partnership Enquiries</a></li>
                            <li><i class="fa fa-table"></i><a href="career_enquiries.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Career Enquiries</a></li>
                            <li><i class="fa fa-table"></i><a href="internship_enquiries.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Internship Enquiries</a></li>
                            <li><i class="fa fa-table"></i><a href="support_enquiries.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Support Enquiries</a></li>
                        </ul>
                    </li>
           </div>    
 <!-- add Collapse Marketing menu-->
           <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo2">Marketing 
                    </a>
                </li>
<!-- Collapse div for Marketing -->
                <div class="collapse" id="demo2" style="width: 100%;">
                    <li>
                        <a href="#"> <i class="menu-icon ti-search"></i>Gridbots Tracker </a>
                    </li>
                    
                     <li>
                        <a href="add_campaign.php"> <i class="menu-icon ti-plus"></i>Create a Campaign </a>
                    </li>
                    
                     <li>
                        <a href="view_campaign.php"> <i class="menu-icon ti-eye"></i>View all Campaigns </a>
                    </li>
             
</div>
<!-- add Collapse Employee Management menu-->
                    <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo3">Employee Management</a></li>
<!-- Collapse div for Employee Management -->                  
                    <div class="collapse" id="demo3" style="width: 100%;">
                <!--    <li>
                        <a href="add_employee.php"> <i class="menu-icon ti-user"></i>Add an Employee  </a>
                    </li>
                    
                    <li>
                        <a href="view_employee.php"> <i class="menu-icon ti-write"></i>View & Edit Employee </a>
                    </li> -->
                    
                   
                     <?php if($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 1 ){?>
                   
                     <li>
                        <a href="leave_approval.php"> <i class="menu-icon ti-check"></i>Leaves For Approval</a>
                    </li>
                    
                    <?php } ?>
                    
                    
                    
                      <li>
                        <a href="employees_worklog.php"> <i class="menu-icon ti-book"></i>Employees Worklog </a>
                    </li>
                   </div>
                 <!--    <li>
                        <a href="message_everyone.php"> <i class="menu-icon ti-email"></i>Message For Everyone</a>
                    </li> -->
                    
                 <?php if($_SESSION['sales_authority'] == 3 || $_SESSION['sales_authority'] == 2){ ?>
<!-- add Collapse Lead Management menu-->                        
                    <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo4">Lead Management</a></li>
<!-- Collapse div for Lead Management -->
                          <div class="collapse" id="demo4" style="width: 100%;">
                             <li>
                        <a href="add_company.php"> <i class="menu-icon  fa  fa-plus"></i> Add a Company</a>
                    </li>
                       
                        
                        <li>
                        <a href="add_client.php"> <i class="menu-icon  fa  fa-plus"></i> Add a Client</a>
                    </li>
                          <li>
                        <a href="add_lead.php"> <i class="menu-icon  fa  fa-plus"></i> Add a Lead</a>
                    </li>
                    
                               <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-briefcase"></i> Manage Logs</a>
                        <ul class="sub-menu children dropdown-menu">
                           
                           <li><i class="menu-icon fa fa-plus"></i><a href="add_log.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Your Log</a></li>
                            <li><i class="menu-icon fa fa-eye"></i><a href="view_log.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Your Logs</a></li>
                           
                        </ul>
                    </li> 
                    
                 <?php if($_SESSION['sales_authority'] == 3) { ?>
                        <li>
                        <a href="manage_lead.php"> <i class="menu-icon  fa   fa-sun-o"></i>Manage Leads</a>
                    </li>
                <?php }   ?>
                    
                    
                    <li>
                        <a href="pipeline.php"> <i class="menu-icon  fa    fa-bar-chart-o"></i>My Pipeline</a>
                    </li>
                    
                  </div>
                    <?php } ?>
<!-- add Collapse Task Management menu--> 
                    <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo5">Task Management</a></li>
<!-- Collapse div for Task Management -->
                    <div class="collapse" id="demo5" style="width: 100%;">
                       <li>
                        <a href="assigning_task.php"> <i class="menu-icon  fa  fa-pencil-square-o"></i>Task Assigner</a>
                    </li>
                    
                    
                     <li>
                        <a href="check_task.php"> <i class="menu-icon  fa   fa-check-square-o"></i>Check Task Status</a>
                    </li>
                    
                    <li>
                        <a href="assigned_task_admin.php"> <i class="menu-icon  fa   fa-check-square-o"></i>Assigned Tasks</a>
                    </li>
                    </div>
                    
 <!-- add Collapse Project Managemen menu-->                    
                    <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo6">Project Management</a></li>
<!-- Collapse div for Project Management -->
                    <div class="collapse" id="demo6" style="width: 100%;">
                          <li>
                        <a href="add_customer.php"> <i class="menu-icon  fa  fa-plus"></i>Create Customer</a>
                    </li><li>
                        <a href="add_project_admin.php"> <i class="menu-icon  fa  fa-plus"></i>Create Project</a>
                    </li><li>
                        <a href="edit_project.php"> <i class="menu-icon  fa  fa-sun-o"></i>Edit Project</a>
                    </li>
                     <li>
                        <a href="project_tracker_main.php"> <i class="menu-icon  fa   fa-search"></i>Project Tracker</a>
                    </li>
                    

                    
               </div>
                    
                    
                    
<!-- add Collapse Account Information menu-->                      
                      <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#demo7">Account Information</a></li>
<!-- Collapse div for Account Information -->
                        <div class="collapse" id="demo7" style="width: 100%;">
                           <li >
                        
                        <a href="admin_profile.php"> <i class="menu-icon fa fa-user"></i> My Profile </a>
                    </li>
                        
                       <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i> My Account</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-download" ></i><a href="payslip_show_admin.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Download Payslips</a></li>
                            <li><i class="menu-icon fa fa-book"></i><a href="leave_in_account_admin.php" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leave in Accounts</a></li>
                            <li><i class="menu-icon fa fa-trophy"></i><a href="#" style="padding: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Awards & Recognitions</a></li>
                           
                        </ul>
                    </li> 
                    
</div>
            
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
