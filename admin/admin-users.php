<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$group_del = $_REQUEST['group_del'];
	if($_REQUEST['group_del']!="")
    {
		$where = array('group_id'=>$group_del);
		
		$db->delete_query('ts_admin_login',$where);
		$_SESSION['sess_mess']="Record deleted successfully";
	}
    $query_user_list="SELECT * FROM ts_admin_login WHERE status='activate' AND company!=''";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Admin User List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        
						<div class="panel-heading" style="text-align:right;">
                            
							<a href="group-add.php" class="btn btn-primary btn-xs">Add New Admin User</a>
                        </div>
						<?php if(isset($_SESSION['sess_mess'])){ ?>
						 <div style="text-align:center;">
                           
                        
                             
<span class="msg"> <?php if(isset($_SESSION['sess_mess'])){
                                               echo $_SESSION['sess_mess'];
                                               
                                               
                                           } ?>
                            </span>
                        </div>
						<?php } ?>
						
                        <div class="panel-body">
						
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                    <thead>
                                        <tr>
                                             	
										   
                                             <th>First Name</th>
											 <th>Last Name</th>
											 <th>Company Name</th>
											 <th>User Name</th>
											 <th>Mobile No</th>
											 <th>Email</th>
											 <th>Password</th>
											 <th>Status</th>
											 
                                           	<th>Edit</th>
											<th>Delete</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                              <?php foreach($r_user_list as $value)
											{
											
											
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['first_name']; ?></td>
											<td><?php echo $value['last_name']; ?></td>
											<td><?php echo $value['company']; ?></td>
											<td><?php echo $value['user_name']; ?></td>
											<td><?php echo $value['mob_no']; ?></td>
											<td><?php echo $value['email_id']; ?></td>
											<td><?php echo $value['pswd']; ?></td>
											<td><?php echo $value['status']; ?></td>
											<td class="center"><a href="group-add.php?group_id=<?php echo $value['group_id']; ?>">Edit</a></td>
											<td class="center"><a href="group-list.php?group_del=<?php echo $value['group_id']; ?>" onClick="return confirm('Delete this Record?')">Delete</a></td>
                                        </tr>
                                <?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
           
            
          <?php unset($_SESSION['sess_mess']); ?>  
        </div>
        <!-- end page-wrapper -->
<div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
  <div class="modal fade" id="edit_cmp" role="dialog">
    
  </div>
  
   
        
    <script src="../assets/plugins/jquery-1.10.2.js"></script>    
   <?php include_once('footer.php'); ?>
