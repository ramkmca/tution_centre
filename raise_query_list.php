<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$del = $_REQUEST['del'];
	$from_date = $_REQUEST['from_date'];
	if($from_date!=""){
	$from_date_qur = "AND date >='".$from_date."'";	
	}
	$to_date = $_REQUEST['to_date'];
	$to_date_new= date("Y-m-d", strtotime($to_date . " +24 hours"));
	if($to_date_new!=""){
	$to_date_qur = "AND date <'".$to_date_new."'";	
	}
    $query_user_list="SELECT * FROM ts_raise_query WHERE 1 $from_date_qur $to_date_qur";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">
<link rel="stylesheet" type="text/css" media="all" href="admin/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="admin/jsDatePick.min.1.3.js"></script>
    <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"from_date",
			dateFormat:"%Y-%m-%d"
			
		});
		new JsDatePick({
			useMode:2,
			target:"to_date",
			dateFormat:"%Y-%m-%d"
			
		});
	};
</script>        
            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Raise Query List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
					<div class="panel-heading">
                             <form name="frm1" id="frm1" method="get">
							   <table class="table table-bordered table-hover">
							   <tr><td>From Date</td><td><input type="text" name="from_date" value="<?php echo $from_date; ?>" id="from_date"></td><td>To Date</td><td><input type="text" name="to_date" value="<?php echo $to_date;?>" id="to_date"></td>
							  
							   
							   
							   <td colspan="2"><input class="btn btn-primary btn-xs" type="submit" name="submit" id="submit" value="Search"></td>
							   </tr>
							   </table>
							 </form>
                        </div>
                        <div class="panel-heading" style="text-align:right;"><a href="query_export.php?from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date_new;?>">Download Excel</a></div>
						
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
                                             	
										    
                                            <th>Complaint No</th>
											<th>Information/Query</th>
											
											 <th>Name</th>
											 <th>Mobile No</th>
											 <th>Address</th>
											 <th>Date</th>
											 <th>Raise By</th>
											  
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                              <?php foreach($r_user_list as $value)
											{
												
										$query="SELECT information FROM ts_information WHERE id='".$value['information_id']."'"; 
										$r_info = $db->fetchRow($query);
										$information = 	trim($r_info['information']);
										
										$query="SELECT full_name FROM ts_user_login WHERE id='".$value['raise_by']."'"; 
										$r_user = $db->fetchRow($query);
										$raise_by = 	trim($r_user['full_name']);
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['complaint_no']; ?></td>
											<td><?php echo ucwords($information); ?></td>
											<td><?php echo $value['cmp_name']; ?></td>
											<td><?php echo $value['mobile_no']; ?></td>
											<td><?php echo $value['address']; ?></td>
											<td><?php echo $value['date']; ?></td>
											<td><?php echo $raise_by; ?></td>
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
