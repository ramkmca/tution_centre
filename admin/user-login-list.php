<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	if($_SESSION['admin_id']>1){
		$company  = "AND company='".$_SESSION['admin_id']."'";
	}
    $query_user_list="SELECT * FROM login_detail WHERE 1 $company";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Member Login List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        
						<div class="panel-heading" style="text-align:right;">
                            
							Member Login List
                        </div>
						<?php if($_REQUEST['msg']!=""){ ?>
						 <div style="text-align:center;">
                           
                        
                             
<span class="msg"> <?php  echo $_REQUEST['msg'];?>
                            </span>
                        </div>
						<?php } ?>
						
                        <div class="panel-body">
						
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                    <thead>
                                        <tr>
                                             	
										    
                                            <th>User Id</th>
											<th>User Name</th>
											 <th>Ip Address</th>
											  <th>User Type</th>
                                           	<th>Company</th>
											<th>Date/Time</th>
											<th>Status</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                              <?php foreach($r_user_list as $value)
											{
											
											$query="SELECT full_name FROM ts_user_login WHERE id='".$value['user_id']."'"; 
											$r_id = $db->fetchRow($query);
											$full_name     = trim($r_id['full_name']);
											$query="SELECT company FROM ts_admin_login WHERE id='".$value['company']."'"; 
											$r_id = $db->fetchRow($query);
											$company     = trim($r_id['company']);
											$current_time = date('Y-m-d H:i:s');

											$diff_second = (strtotime($current_time) - strtotime($value['current_time']));
											
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                           
											<td><?php echo $value['user_id']; ?></td>
											
											<td class="center"><a href="logout-user.php?user_id=<?php echo $value['id']; ?>"><?php echo ucwords($full_name); ?></a></td>
											<td><?php echo $value['ip_address']; ?></td>
											<td><?php echo ucwords($value['user_type']); ?></td>
											<td><?php echo ucwords($company); ?></td>
											<td><?php echo $value['time']; ?></td>
											<td><?php if($diff_second <= 300){echo ucwords($value['login']);}else{ echo Logout;} ?></td>
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
