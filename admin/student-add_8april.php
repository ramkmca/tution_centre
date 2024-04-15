<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$id = $_REQUEST['id'];
	if($_REQUEST['id']=="" && isset($_POST['submit']))
    {
			
	$registration_no    =  trim(addslashes($_POST["registration_no"]));
	$student_name    	=  trim(addslashes($_POST["student_name"]));
	$dob    	   		=  trim(addslashes($_POST["dob"]));
	$class_name    		=  trim(addslashes($_POST["class_name"]));
	$batch_name 		= implode(',', $_POST['batch_name']);
	$father_name    	=  trim(addslashes($_POST["father_name"]));
	$address    		=  trim(addslashes($_POST["address"]));
	$mobile_no    		=  trim(addslashes($_POST["mobile_no"]));
	$reg_date    		=  date('Y-m-d');
	
	$status		  		=  trim(addslashes($_POST["status"]));
	
	
	$post_array = array(
       'registration_no' => $registration_no,
	   'student_name' => $student_name,
	   'dob' => $dob,
	   'class_id' => $class_name,
	   'batch_id' => $batch_name,
	   'father_name' => $father_name,
	   'address' => $address,
	   'mobile_no' => $mobile_no,
	   'reg_date' => $reg_date,
	   'status' => $status
	   );
	   
	$query_fee="SELECT sum(fee) as total_fee FROM ts_batch WHERE class_id='".$class_name."' AND id in(".$batch_name.")"; 
	$r_fee = $db->fetchRow($query_fee);
	$total_fee =  trim($r_fee["total_fee"]); 
	
	$query_mail="SELECT * FROM ts_mailcontent WHERE mail_type='add new student'"; 
	$r_mail = $db->fetchRow($query_mail);
	$mail_content =  trim($r_mail["mail_content"]); 
	   
	 $username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $mobile_no; // A single number or a comma-seperated
	  $numbers = $mobile_no; // A single number or a comma-seperated
	 $message = $mail_content;	
     
     $message = str_replace("<student name>",$student_name,$message);
	 $message = str_replace("<registration no>",$registration_no,$message);
	 $message = str_replace("<dob>",$dob,$message);


	 //$message = "Dear ".$student_name.", Your Registration no: ".$registration_no.", DOB: ".$dob.", Fee: ".$total_fee;
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message);
     $data =
"username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
  
	$result = $db->insert_query('ts_student', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";
	
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='student-list.php';
    </SCRIPT>");
	
    }
	if($_REQUEST['id']!="" && isset($_POST['submit']))
    {
			
	$registration_no    =  trim(addslashes($_POST["registration_no"]));
	$student_name    	=  trim(addslashes($_POST["student_name"]));
	$dob    	   		=  trim(addslashes($_POST["dob"]));
	$class_name    		=  trim(addslashes($_POST["class_name"]));
	$batch_name    		=  trim(addslashes($_POST["batch_name"]));
	$batch_name 		= implode(',', $_POST['batch_name']);
	$father_name    	=  trim(addslashes($_POST["father_name"]));
	$address    		=  trim(addslashes($_POST["address"]));
	$mobile_no    		=  trim(addslashes($_POST["mobile_no"]));
	
	$status		  		=  trim(addslashes($_POST["status"]));
	
	
	$post_array = array(
       'registration_no' => $registration_no,
	   'student_name' => $student_name,
	   'dob' => $dob,
	   'class_id' => $class_name,
	   'batch_id' => $batch_name,
	   'father_name' => $father_name,
	   'address' => $address,
	   'mobile_no' => $mobile_no,
	   'status' => $status
	   );
  
    $where = array('id'=>$id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_student', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='student-list.php';
    </SCRIPT>");

	
    }
	
	$query="SELECT count(id) as student_count FROM ts_student"; 
	$r_id = $db->fetchRow($query);
	$student_count =  trim($r_id["student_count"]);
	$registration_no     	= date('Ym').(100000+$student_count);
	if($_GET['id']!='')
    {
    $query="SELECT * FROM ts_student WHERE id='".$id."'"; 
    $r_id = $db->fetchRow($query);
	$registration_no     	= trim($r_id["registration_no"]);
	$student_name     		= trim($r_id["student_name"]);
	$dob     				= trim($r_id["dob"]);
	$father_name     		= trim($r_id["father_name"]);
	$address     			= trim($r_id["address"]);
	$mobile_no     			= trim($r_id["mobile_no"]);
	$class_id     		= trim($r_id["class_id"]);
	$batch_id     		= trim($r_id["batch_id"]);
	//$batch_id			= str_replace(",","_",$batch_id);

	}

?>
 
        <!--  page-wrapper -->
        <div id="page-wrapper">

    <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>        
    <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
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
				<?php if($_GET['id']=='') {?>
                    <h1 class="page-header">Add Student<?php// echo "gg".$query_fee;?></h1>
				<?php } else{?>
					<h1 class="page-header">Edit Student<?php// echo $batch_id;?></h1>
				<?php } ?>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="">&nbsp</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" name="department-form" id="department-form" action="" method="post">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <div class="form-group">
									         
                                            <label>Registration No </label>
                                            <input type="text" name="registration_no" id="registration_no" value="<?php echo $registration_no; ?>" class="form-control" readonly >
											</div>
											
											<div class="form-group">
									         
                                            <label>DOB </label>
                                            <input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" class="form-control" tabindex="2" placeholder="DOB" >
											</div>
											
											<div class="form-group">
									         
                                            <label>Address</label>
                                            <input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control"  tabindex="4" placeholder="Address">
											</div>
										
											<div class="form-group">
									 
                                            <label>Class Name </label>
											<select name="class_name" id="class_name" class="form-control" tabindex="6" onchange="display_batch(this.value, '');">
											<option value="">--Select Class--</option>
											<?php 
												$query_user_list="SELECT * FROM ts_class";
												$r_class_list = $db->fetchResult($query_user_list);
												foreach($r_class_list as $value)
												{
											?>
											
											<option value="<?php echo $value['id'];?>" <?php if($value['id']==$class_id){ ?> selected <?php }?> ><?php echo ucwords($value['class']);?></option>
											<?php } ?>
											</select>
                                           
                                           </div>
										   
											<?php
										    if($id!=""){
											echo "<script>";
											echo "display_batch($class_id, '".$batch_id."');";
											echo "</script>";
											}		
										?>
											<div class="form-group">
									 
                                            <label>Status </label>
											<select name="status" id="status" class="form-control" tabindex="8">
											
											<option value="Activeted" <?php if($status=='Activeted'){?> selected <?php }?>>Activeted</option>
											<option value="Deactiveted" <?php if($status=='Deactiveted'){?> selected <?php }?>>Deactiveted</option>
											
											</select>
                                            
											</div>
											
											
									 </div>	
									 
									 <div class="col-lg-6">
									 <div class="form-group">
									         
                                            <label>Student Name </label>
                                            <input type="text" name="student_name" id="student_name" value="<?php echo $student_name; ?>" class="form-control" tabindex="1" placeholder="Student Name" >
											</div>
											<div class="form-group">
									         
                                            <label>Father/Mother Name </label>
                                            <input type="text" name="father_name" id="father_name" value="<?php echo $father_name; ?>" class="form-control" tabindex="3" placeholder="Father/Mother Name">
											</div>
											<div class="form-group">
									         
                                            <label>Mobile No</label>
                                            <input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>" class="form-control" tabindex="5" placeholder="Mobile No">
											</div>
											<div id="batchid">
											<div class="form-group">
									 
                                            <label>Batch Name </label>
											<select name="batch_name[]" id="batch_name" class="form-control" tabindex="7" multiple>
											<option value="">--Select Class--</option>
											
											</select>
                                           
                                           </div>
										   </div>
										   <div id="error_batch_name" class="error"></div>
										   
											
									 
									 </div>
									 
										<div class="clearfix"></div>
										 
                                       
                                        &nbsp;&nbsp;&nbsp;<button type="submit" name="submit"  id="department_submit_id" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
									 
									 </div>
                                   
                                       
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
           
            
            
        </div>
        <!-- end page-wrapper -->

 
  
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
 
  
  <script>
 $(function(){
    $('#department-form').submit(function(){
         var options = $('#batch_name > option:selected');
		 
		 $('#error_batch_name').text('');
         if(options.length == 0){
            
			 $('#error_batch_name').text('Please select batch');
			 
             return false;
         }
    });
});
  
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            student_name: "required",
			dob: "required",
			father_name: "required",
			address: "required",
			mobile_no: "required",
			class_name: "required",
			batch_name: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            student_name: "Please select class name",
			dob: "Please enter dob",
			father_name: "Please enter patent name",
			address: "Please enter address",
			mobile_no: "Please enter mobile no",
			class_name: "Please select class name",
			batch_name: "Please select batch name"
			
			
           },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
    $( "#department_submit_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});


        </script>
		
        
   <?php include_once('footer.php'); ?>
