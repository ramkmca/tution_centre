<?php    
	
  require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	} 
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_id, father_name, address, mobile_no, reg_date, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	where ts_student.id = '".$_SESSION['user_id']."'
	";
   	
	$r_id = $db->fetchRow($query_user_list);
	
	$reg_date = $r_id['reg_date'];
	$current_date = date('Y-m-d');
	$diff = abs(strtotime($current_date) - strtotime($reg_date));

	$month = floor($diff / (30*60*60*24));
	$fee_month = $month+1;
	
	$query_total_fee="SELECT  sum(fee) as total_fee FROM ts_batch 
	WHERE id in(".$r_id['batch_id'].")";
	$r_total_fee = $db->fetchRow($query_total_fee);
	
	$query_add_fee="SELECT  sum(paid_fee) as paid_fee FROM ts_fee 
	group by student_id
	having student_id = '".$_SESSION['user_id']."'
	";
   	
	$r_fee = $db->fetchRow($query_add_fee);
	$paid_fee = $r_fee['paid_fee'];
	$remaining_fee = ($r_total_fee['total_fee']*$fee_month)-$paid_fee;
	
	 $query_user_list="SELECT * FROM ts_fee WHERE registration_no ='".$_SESSION['user_name']."'";
	
     $r_user_list = $db->fetchResult($query_user_list);
	

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Fee Detail <?php //echo $query_user_list1;?></h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                          
							<div class="form-group" style="font-size:20px;  padding:0px 20px 0px 400px; ">Total Fee  :<?php echo $r_total_fee['total_fee']*$fee_month; ?></div>
							
							<div class="form-group" style="font-size:20px;  padding:0px 20px 0px 400px; ">Paid Fee   :<?php echo $paid_fee; ?></div>
							
							<div class="form-group" style="font-size:20px;  padding:0px 20px 0px 400px;">Remaing Fee   :<?php echo $remaining_fee; ?></div>
						
                        </div>
						
                        <div class="panel-body">
						 
									
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                    <thead>
                                       <tr>
										    <th>Registration No</th>
                                            <th>Paid Fee</th>
											<th>Date</th>
											
                                           
                                            
                                        </tr>
                                    </thead>
                                   <tbody>
									 <?php foreach($r_user_list as $value)
											{
											
				                        ?>
									<tr>
									<td><?php echo $value['registration_no'];?></td><td><?php echo $value['paid_fee'];?></td><td><?php echo $value['date'];?></td>
									</tr>
										<?php } ?>
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

   
   <script src="assets/plugins/jquery-1.10.2.js"></script>
  <script src="assets/plugins/jquery.validate.min.js"></script>
        
   <?php include_once('footer.php'); ?>
