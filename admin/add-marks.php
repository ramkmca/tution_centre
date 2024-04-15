<?php
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
//require_once 'assets/scripts/validation.js';



$back_page_name = $_SERVER['HTTP_REFERER'];

$back_page_name = explode('/',$back_page_name);
$back_page_name = end($back_page_name);
if(isset($_POST['view_comp_id']))
{
  
    $rec_id = $_POST['view_comp_id'];
	$query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_name, fee, father_name, address, mobile_no, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	INNER JOIN ts_batch ON  ts_student.batch_id=ts_batch.id
	where ts_student.id = '".$rec_id."'
	";
   	
	$r_id = $db->fetchRow($query_user_list);
	
	$query_subject_list="SELECT * from ts_batch WHERE 1 GROUP BY batch_name";
	$batch_name_id = $db->fetchResult($query_subject_list);
	
   
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Student Marks <?php //echo $query_add_fee; ?></h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registration No : <?php echo $r_id['registration_no']; ?>
                        </div>
                          <div class="panel-body">
                            <div class="row">
                                
									<div class="col-lg-6">
                                 <form role="form" id="register-form" action="../app/action/add_marks.php" method="post">
                                          <input type="hidden" name="student_id" id="student_id" value="<?php echo $r_id['id']; ?>">
										  <input type="hidden" name="registration_no" id="registration_no" value="<?php echo $r_id['registration_no']; ?>">
										  <input type="hidden" name="test_date" id="test_date" value="<?php echo date('Y-m-d'); ?>">
										  <div class="form-group">
                                            <label>Subject</label>
											<select name="subject" id="subject" class="form-control">
											<option value="">--Subject--</option>
											<?php foreach($batch_name_id as $sub)
											{?>
												<option value="<?php echo $sub['batch_name'];?>"><?php echo $sub['batch_name'];?></option>
											<?php } ?>
											</select>
                                           
                                        </div>
                                         <div class="form-group">
                                            <label>Total Marks</label>
                                            <input type="text" name="total_marks" id="total_marks"  class="form-control" >
                                        </div>
										 <div class="form-group">
                                            <label>Obtained Marks</label>
                                            <input type="text" name="obtained_marks" id="obtained_marks"  class="form-control" >
                                        </div>
                                        
                                        
                                              
                                                                              
                                       
										
                                        <button type="submit" name="complaint_register"  id="submit_btn_id" class="btn btn-primary">Update</button>
                                        
                                    </form>
                     <!-- End Form Elements -->
                </div>
									
									
					
                                    </div>
                                    </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
                                <?php  

}
?>
<script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        
        // Specify the validation rules
       rules: {
            subject: "required",
			total_marks: "required",
			obtained_marks: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            subject: "Please select suject",
			total_marks: "Please enter total marks",
			obtained_marks: "Please enter obtained marks"
			
           },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
    $( "#submit_btn_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});

        </script>
                          