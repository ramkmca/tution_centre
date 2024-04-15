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
	 $query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_name, father_name, address, mobile_no, reg_date, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	INNER JOIN ts_batch ON  ts_student.batch_id=ts_batch.id
	where ts_student.id = '".$rec_id."'
	";
   	
	$r_id = $db->fetchRow($query_user_list);
	
	
   
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Student <?php //echo $back_page_name; ?></h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Student Details
                        </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<tr>
							<td>Registration No  :</td><td><?php echo $r_id['registration_no']; ?></td>
							</tr>
							<tr>
							<td>Student Name  :</td><td><?php echo $r_id['student_name']; ?></td>
							</tr>
							<tr>
							<td>DOB :</td><td><?php echo $r_id['dob']; ?></td>
							</tr>
							<tr>
							<td>Father/Mother Name  :</td><td><?php echo $r_id['father_name']; ?></td>
							</tr>
							
							<tr>
							<td>Address  :</td><td><?php echo$r_id['address']; ?></td>
							</tr>
							<tr>
							<td>Mobile No  : </td><td><?php echo $r_id['mobile_no']; ?></td>
							</tr>
							<tr>
							<td>Class Name   :</td><td><?php echo $r_id['class']; ?></td>
							</tr>
							<tr>
							<td>Batch Name   :</td><td><?php echo $r_id['batch_name']; ?></td>
							</tr>
							<tr>
							<td>Registration Date   :</td><td><?php echo $r_id['reg_date']; ?></td>
							</tr>
							<tr>
							<td>Status  :</td><td><?php echo ucwords($r_id['status']); ?></td>
							</tr>
							
							</table>								
                            
                                                   
                           
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
            cmp_comment: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            cmp_comment: "Please enter comment"
			
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
                          