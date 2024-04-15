<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$del = $_REQUEST['del'];
	if($_REQUEST['del']!="")
    {
		$where = array('id'=>$del);
		
		$db->delete_query('ts_class',$where);
	}
    $query_user_list="SELECT * FROM `ts_class` WHERE 1";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Class List </h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:right;">
                            <a href="class-add.php" class="btn btn-primary btn-xs">Add New Class</a>
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
                                             	
										    <th>SNo</th>
                                            <th>Class Name</th>
                                           	<th>Edit</th>
											<th>Delete</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $num = 0; ?>
                                              <?php foreach($r_user_list as $value)
											{
											$num++;
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $num; ?></td>
											<td><?php echo ucwords($value['class']); ?></td>
											<td class="center"><a href="class-add.php?id=<?php echo $value['id']; ?>">Edit</a></td>
											<td class="center"><a href="class-list.php?del=<?php echo $value['id']; ?>" onClick="return confirm('Delete this record?')">Delete</a></td>
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

   
   <script src="../assets/plugins/jquery-1.10.2.js"></script>     
        
   <?php include_once('footer.php'); ?>
