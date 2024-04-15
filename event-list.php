<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$del = $_REQUEST['del'];
	if($_REQUEST['del']!="")
    {
		$where = array('id'=>$del);
		
		$db->delete_query('ts_events',$where);
		$_SESSION['sess_mess']="Record deleted successfully";
	}
    $query_user_list="SELECT * FROM ts_events";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Event List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        
						<div class="panel-heading" style="text-align:right;">
                            
							<a href="event-add.php" class="btn btn-primary btn-xs">Add New Event</a>
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
                                             	
										    <th>No</th>
                                            <th>Event Type</th>
											 <th>Event Title</th>
											  <th>Event Date/Time</th>
											  <th>Status</th>
											  
                                           	<th>Edit</th>
											<th>Delete</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $num = 0; ?>
                                              <?php foreach($r_user_list as $value)
											{
											$num++;
											$query="SELECT * FROM ts_event_type WHERE id='".$value['event_type']."'"; 
											$r_id = $db->fetchRow($query);
											$event_type     = trim($r_id["event_type"]);
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $num; ?></td>
											<td><?php echo ucwords($event_type); ?></td>
											<td><?php echo $value['event_title']; ?></td>
											<td><?php echo $value['event_date']; ?></td>
											<td><?php echo $value['status']; ?></td>
											<td class="center"><a href="event-add.php?event_id=<?php echo $value['id']; ?>">Edit</a></td>
											<td class="center"><a href="event-list.php?del=<?php echo $value['id']; ?>" onClick="return confirm('Delete this Record?')">Delete</a></td>
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
  
   
        
    <script src="assets/plugins/jquery-1.10.2.js"></script>    
   <?php include_once('footer.php'); ?>
