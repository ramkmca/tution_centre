<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	$del = $_REQUEST['del'];
	if($_REQUEST['del']!="")
    {
		$where = array('id'=>$del);
		
		$db->delete_query('ts_student',$where);
	}
	$registration_no = trim($_REQUEST['registration_no']);
	if($registration_no!=""){
	$registration_no_qur = "AND  registration_no ='".$registration_no."'";	
	}
	$class_id = $_REQUEST['class_id'];
	if($class_id!=""){
	$class_id_qur = "AND  ts_student.class_id='".$class_id."'";	
	}
	$batch_id = $_REQUEST['batch_name'];
	if($batch_id!=""){
		
	$batch_id_qur = "AND  ts_student.batch_id LIKE '%".$batch_id."%'";	
	}
	
    $query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_id, father_name, address, mobile_no, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	WHERE 1 $registration_no_qur  $class_id_qur $batch_id_qur
	
	";
    $r_user_list = $db->fetchResult($query_user_list);
	
	$query_class_list = "SELECT * FROM ts_class";
	$r_class_list = $db->fetchResult($query_class_list);
	
	$query_subject_list="SELECT * from ts_batch WHERE 1 GROUP BY batch_name";
	$batch_name_id = $db->fetchResult($query_subject_list);

?>
<script>


</script>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Student List <?php //echo $query_user_list;?></h1>
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
							   <tr><td><label>Registration No</label></td><td><input type="text" name="registration_no" value="<?php echo $registration_no; ?>" ></td>
							   <td><label>Class</label></td><td>
							   
							   
							   <select  name="class_id" class="form-control" id="class_id" onchange="get_batch_list(this.value, '');">
                                                <option value="0" selected disabled>--Select Class--</option>
                                                <?php foreach($r_class_list as $value)
									{
									?>
                                                <option value="<?php echo $value['id'];?>" <?php if($value['id']==$class_id){ ?> selected <?php } ?>><?php echo $value['class'];?></option>
                                <?php } ?>
                               </select>
							   
							   </td>
							   <?php
										   
											echo "<script>";
											echo "get_batch_list($class_id, $batch_id);";
											echo "</script>";
											
										?>
							   <td><label>Batch</label></td><td>
							   <div id="id_getbatch">
							   <select name="batch_name" id="batch_name" class="form-control" tabindex="7">
		                        <option value="">--Select Batch--</option>
							    </select>
								</div>
							   </td>
							   
							   <td><input class="btn btn-primary btn-xs" type="submit" name="submit" id="submit" value="Submit"></td>
							   <tr>
							   </table>
							 </form>
							</div>
                        <div class="panel-heading" style="text-align:right;">
						<a href="export.php?registration_no=<?php echo $registration_no;?>&batch_name=<?php echo $batch_id;?>&class_id=<?php echo $class_id;?>">Download Excel</a>&nbsp;&nbsp;&nbsp;
                        <a href="student-add.php" class="btn btn-primary btn-xs">Add New Student</a>
							
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
						<form  name="form1" id="form1" method="post" action="attendance.php">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                    <thead>
                                        <tr>
										<th><input type="checkbox" id="checkAll"/> ALL</th>
										    <th>Registration No</th>
                                            <th>Student Name</th>
											<!--<th>DOB</th>-->
											
                                            <th>Class</th>
											<th>Batch</th>
											<!--<th>Father/Mother Name</th>
											<th>Address</th>
											<th>Mobile No</th>-->
											<th>View Fee | Marks</th>
											<th>Add Fee | Marks</th>
											
											<th>Status</th>
											<th>View</th>
                                           	<th>Edit</th>
											<th>Delete</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                              <?php foreach($r_user_list as $value)
											{
											$query_branch_list = "SELECT batch_name FROM ts_batch WHERE id in('".$value['batch_id']."')";
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
										    <td><input type="checkbox" name="ids[]" type="checkbox" value="<?php echo $value['id'];?>" class="cb-element"></td>
                                            <td><?php echo ucwords($value['registration_no']); ?></td>
											<td><?php echo ucwords($value['student_name']); ?></td>
											<!--<td><?php echo ucwords($value['dob']); ?></td>-->
											<td><?php echo ucwords($value['class']); ?></td>
											<td><?php echo $batch_name; ?></td>
											<!--<td><?php echo $value['father_name']; ?></td>
											<td><?php echo $value['address']; ?></td>
											<td><?php echo $value['mobile_no']; ?></td>-->
											<td> <a href="#" class="btn btn-primary btn-xs" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_fee" onclick="view_fee('<?php echo $value['id']; ?>','view_fee');">View Fee</a><br><br> <a href="#" class="btn btn-primary btn-xs" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_marks" onclick="view_marks('<?php echo $value['id']; ?>','view_marks');">View Marks</a></td>
											<td><a href="#" class="btn btn-primary btn-xs" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#add_fee" onclick="add_fee('<?php echo $value['id']; ?>','add_fee');">Add Fee</a><br><br> <a href="#" class="btn btn-primary btn-xs" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#add_marks" onclick="add_marks('<?php echo $value['id']; ?>','add_marks');">Add Marks</a> </td>
											<td><?php echo ucwords($value['status']); ?></td>
											<td class="center"><a href="#" class="btn btn-outline btn-link" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_student('<?php echo $value['id']; ?>','view_cmp');">View</a></td>
											<td class="center"><a href="student-add.php?id=<?php echo $value['id']; ?>">Edit</a></td>
											<td class="center"><a href="student-list.php?del=<?php echo $value['id']; ?>" onClick="return confirm('Delete this record?')">Delete</a></td>
                                        </tr>
										
                                <?php }  ?>
								
                                </table>
								<div style="width:400px;">
								<label>Subject </label>
								<select name="subject" id="subject" style="width:150px; height:30px;" >
								<option value="">--Select Subject--</option>
								<?php foreach($batch_name_id as $sub)
											{?>
												<option value="<?php echo $sub['batch_name'];?>"><?php echo $sub['batch_name'];?></option>
											<?php } ?>
								
								</select>
								</div>
                                <div>   <br>       
								<button type="submit" name="present" id="department_submit_id" value="present" class="btn btn-primary" onClick="return del_prompt('form1','Present')" >Present</button> 
								<button type="submit" name="notpresent" id="department_submit_id" value="notpresent" class="btn btn-primary" onClick="return del_prompt('form1','Present')" >Not Present</button>
								<button type="submit" name="off_by_teacher" id="department_submit_id" value="off_by_teacher" class="btn btn-primary" onClick="return del_prompt('form1','Present')" >Off By Teacher</button>
								
								<button type="submit" name="fee_not_paid" id="department_submit_id" value="fee_not_paid" class="btn btn-primary" onClick="return del_promptfee('form1','Present')" >Fee Not Paid</button>
								
						 											
								</div> 
								
								<div style="width:416px;"> <br>
								<textarea name="urg_message" id="urg_message" col="40" rows="3" style="width:416px;" placeholder="Message!"></textarea>
								
								</div>
								<div> <br>
								<button type="submit" name="send_message" id="send_message" value="send_message" class="btn btn-primary" onClick="return del_promptmessage('form1','Present')" >Send Message</button>
								</div>
								
							</div>
                            </form>
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
  <div class="modal fade" id="add_fee" role="dialog">
    
  </div>
  <div class="modal fade" id="add_marks" role="dialog">
    
  </div>
  <div class="modal fade" id="view_fee" role="dialog">
    
  </div>
  <div class="modal fade" id="view_marks" role="dialog">
    
  </div>
   
   <script src="../assets/plugins/jquery-1.10.2.js">  </script> 
   <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
   <script>  
   $("#checkAll").change(function () {
    $("input:checkbox.cb-element").prop('checked', $(this).prop("checked"));
});
$(".cb-element").change(function () {
        _tot = $(".cb-element").length                        
        _tot_checked = $(".cb-element:checked").length;

        if(_tot != _tot_checked){
            $("#checkAll").prop('checked',false);
        }
});


</script> 
<script>
function del_prompt(form1,comb)
{
	//var bla = $('#txt_name').val();	
    var bla = $('#subject').val();
	if(bla!=""){
	document.form1.submit();
	}else{
		$(function() {
  
    // Setup form validation on the #register-form element
    $("#form1").validate({
    
        
        // Specify the validation rules
        rules: {
            //subject: "required"
         },
        
        // Specify the validation error messages
        messages: {
           // subject: "Please select suject"
			},
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
	}
}
function del_promptfee(form1,comb)
{
	
	document.form1.submit();
	
}
function del_promptmessage(form1,comb)
{
	//var bla = $('#txt_name').val();	
    var bla = $('#urg_message').val();
	if(bla!=""){
	document.form1.submit();
	}else{
		$(function() {
  
    // Setup form validation on the #register-form element
    $("#form1").validate({
    
        
        // Specify the validation rules
        rules: {
            urg_message: "required"
         },
        
        // Specify the validation error messages
        messages: {
            urg_message: "Please enter message"
			},
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
	}
}
    
    $( "#submit_btn_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});

        </script> 
        
   <?php include_once('footer.php'); ?>
