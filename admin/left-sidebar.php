  <!-- navbar side -->
  
   <?php 
  $page_name = basename($_SERVER['PHP_SELF']);
  
	$sql = "SELECT * from ts_admin_login where id='".$_SESSION['admin_id']."'";
	$comp_user_qur = $db->fetchRow($sql);
  ?>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <!--<div class="user-section-inner">
                                <img src="../assets/img/user.jpg" alt="">
                            </div>-->
                            <div class="user-info">
                                <div><?php echo ucwords($comp_user_qur['first_name']).' '.ucwords($comp_user_qur['last_name']); ?></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!--end search section-->
                    </li>
					
					<li <?php if($page_name=="dashboard.php"){?>class="selected" <?php } ?>>
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <!--<li <?php if($page_name=="admin-page.php"){?>class="selected" <?php } ?> >
                        <a href="admin-page.php"><i class="fa fa-bar-chart-o fa-fw"></i>Users</a>
                    </li>-->
					 <li <?php if($page_name=="class-list.php"){?>class="selected" <?php } ?> >
                        <a href="class-list.php"><i class="fa fa-flask fa-fw"></i>Class List</a>
                    </li>
					 <li <?php if($page_name=="classbach-list.php"){?>class="selected" <?php } ?> >
                        <a href="classbach-list.php"><i class="fa fa-table fa-fw"></i>Batch List</a>
                    </li>
					 <li <?php if($page_name=="student-list.php"){?>class="selected" <?php } ?> >
                        <a href="student-list.php"><i class="fa fa-edit fa-fw"></i>Student List</a>
                    </li>
					<li <?php if($page_name=="attendance-list.php"){?>class="selected" <?php } ?> >
                        <a href="attendance-list.php"><i class="fa fa-wrench fa-fw"></i>Attendance List</a>
                    </li>
					<li <?php if($page_name=="mailcontent-list.php"){?>class="selected" <?php } ?> >
                        <a href="mailcontent-list.php"><i class="fa fa-wrench fa-fw"></i>Message Content</a>
                    </li>
					 <li <?php if($page_name=="home-setting.php"){?>class="selected" <?php } ?> >
                        <a href="home-setting.php"><i class="fa fa-sitemap fa-fw"></i>Home Setting</a>
                    </li>
					
					
					
					 <li <?php if($page_name=="edit-profile.php"){?>class="selected" <?php } ?> >
                        <a href="edit-profile.php"><i class="fa fa-files-o fa-fw"></i>Edit Profile</a>
                    </li>
                     <li <?php if($page_name=="change-password.php"){?>class="selected" <?php } ?> >
                        <a href="change-password.php"><i class="fa fa-bar-chart-o fa-fw"></i>Change Password</a>
                    </li>
                    
					  <!--<li>
                        <a href="admin-add-user.php"><i class="fa fa-dashboard fa-fw"></i>&nbsp;</a>
                    </li>
                    <li>
                        <a href="admin-edit-user.php"><i class="fa fa-dashboard fa-fw"></i>&nbsp;</a>
                    </li>-->
                    
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->