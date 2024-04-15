<?php    
	
  require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	} 
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$month = $_REQUEST['month'];
	if($month!=""){
	$month1 = '-'.$month.'-';
	$month_qur = "AND  date LIKE '%".$month1."%'";	
	}
	$att_date = $_REQUEST['att_date'];
	if($att_date!=""){
	$att_date_qur = "AND  date LIKE '%".$att_date."%'";	
	}
	$attendance = $_REQUEST['attendance'];
	if($attendance!=""){
	$attendance_qur = "AND  present ='".$attendance."'";	
	}
	
    $query_user_list="SELECT registration_no, student_name, class, batch_id, subject_name, present, date FROM ts_attendance
	INNER JOIN ts_class ON  ts_attendance.class_id=ts_class.id 
	
	WHERE registration_no ='".$_SESSION['user_name']."' $month_qur $att_date_qur $attendance_qur
	";
    $r_user_list = $db->fetchResult($query_user_list);
	
	$query_class_list = "SELECT * FROM ts_class";
	$r_class_list = $db->fetchResult($query_class_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">
<link rel="stylesheet" type="text/css" media="all" href="admin/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="admin/jsDatePick.min.1.3.js"></script>
    <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"att_date",
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
                    <h1 class="page-header">Attendance Chart </h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:right;">
                          <form name="frm1" id="frm1" method="get">
							   <table class="table table-bordered table-hover">
							   
							   <tr>
							   <td><label>Month</label></td>
							   <td>
							   <select name="month" id="month" class="form-control" >
							   <option value="">--Select Month--</option>
							   <option value="01" <?php if($month=="01"){?> selected <?php }?>>January</option>
							   <option value="02" <?php if($month=="02"){?> selected <?php }?>>February</option>
							   <option value="03" <?php if($month=="03"){?> selected <?php }?>>March</option>
							   <option value="04" <?php if($month=="04"){?> selected <?php }?>>April</option>
							   <option value="05" <?php if($month=="05"){?> selected <?php }?>>May</option>
							   <option value="06" <?php if($month=="06"){?> selected <?php }?>>June</option>
							   <option value="07" <?php if($month=="07"){?> selected <?php }?>>July</option>
							   <option value="08" <?php if($month=="08"){?> selected <?php }?>>August</option>
							   <option value="09" <?php if($month=="09"){?> selected <?php }?>>September</option>
							   <option value="10" <?php if($month=="10"){?> selected <?php }?>>October</option>
							   <option value="11" <?php if($month=="11"){?> selected <?php }?>>November</option>
							   <option value="12" <?php if($month=="12"){?> selected <?php }?>>December</option>
							   </select>
							   </td>
							   <td><label>Date</label></td>
							   <td><input type="text" name="att_date" id="att_date" value="<?php echo $att_date; ?>" ></td>
							   <td><label>Attendance</label></td>
							   <td>
							   <select name="attendance" id="attendance" class="form-control" >
							   <option value="">--Attendance--</option>
							   <option value="1" <?php if($attendance=="1"){?> selected <?php }?>>Present</option>
							   <option value="0" <?php if($attendance=="0"){?> selected <?php }?>>Not Present</option>
							   <option value="2" <?php if($attendance=="2"){?> selected <?php }?>>Off by Teacher</option>
							   
							   </select>
							   </td>
							    <td><input class="btn btn-primary btn-xs" type="submit" name="submit" id="submit" value="Submit"></td>
							   </tr>
							   </table>
							 </form>
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
                                             	
										    <th>Registration No</th>
                                            <th>Student Name</th>
                                           	<th>Class</th>
											<th>Batch</th>
											<th>Subject</th>
											<th>Present</th>
											<th>Date</th>
											
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                              <?php foreach($r_user_list as $value)
											{
												$query_branch_list = "SELECT batch_name FROM ts_batch WHERE id in(".$value['batch_id'].")";
											$r_branch_list = $db->fetchResult($query_branch_list);
											$i = 0;
											$batch_name = "";
											foreach($r_branch_list as $value_batch)
												{
													if($i==0){
												 $batch_name.= $value_batch['batch_name'];
													}else{
												 $batch_name.= ', '.$value_batch['batch_name'];
													}
													$i++;
												}
											
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['registration_no']; ?></td>
											<td><?php echo ucwords($value['student_name']); ?></td>
											<td><?php echo ucwords($value['class']); ?></td>
											<td><?php echo $batch_name; ?></td>
											<td><?php echo ucwords($value['subject_name']); ?></td>
											<td><?php if($value['present']==1){ ?> <img src="yes.jpg" width="42" height="42">
											<?php }else if($value['present']==0){ ?><img src="no.jpg" width="42" height="42">
											<?php } else{ ?><img src="byt.jpg" width="42" height="42"><?php } ?></td>
											<td><?php echo $value['date']; ?></td>
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

   
   <script src="assets/plugins/jquery-1.10.2.js"></script>
  <script src="assets/plugins/jquery.validate.min.js"></script>
        
   <?php include_once('footer.php'); ?>
