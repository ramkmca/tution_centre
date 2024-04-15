<?php    
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	}
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$group_del = $_REQUEST['group_del'];
	if($_REQUEST['group_del']!="")
    {
		$where = array('group_id'=>$group_del);
		
		$db->delete_query('ts_group',$where);
		$_SESSION['sess_mess']="Record deleted successfully";
	}
    $query_user_list="SELECT * FROM ts_group";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Group List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="group-add.php">Add New Group</a>
                        </div>
						
                        <div class="panel-body">
						
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<?php

							if($_SESSION['sess_mess'])

							{

							?>

							 <thead><tr> <td height="29" colspan="5" align="center" class="h12" ><?php echo $_SESSION['sess_mess'];?></td></tr> </thead>

							<?php  //session_unset(sess_mess);	?>

							<?php

							}

							?>
                                    <thead>
                                        <tr>
                                             	
										    <th>No</th>
                                            <th>Department Name</th>
											 <th>Group Name</th>
                                           	<th>Edit</th>
											<th>Delete</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $num = 0; ?>
                                              <?php foreach($r_user_list as $value)
											{
											$num++;
											$query="SELECT * FROM ts_department WHERE dep_id='".$value['dept_id']."'"; 
											$r_id = $db->fetchRow($query);
											$department_name     = trim($r_id["dep_name"]);
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $num; ?></td>
											<td><?php echo $department_name; ?></td>
											<td><?php echo $value['group_name']; ?></td>
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
           
            
            
        </div>
        <!-- end page-wrapper -->
<div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
  <div class="modal fade" id="edit_cmp" role="dialog">
    
  </div>
  
   
        
    <script src="assets/plugins/jquery-1.10.2.js"></script>    
   <?php include_once('footer.php'); ?>
