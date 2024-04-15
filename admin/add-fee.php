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
	$query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_id, father_name, address, mobile_no, reg_date, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	where ts_student.id = '".$rec_id."'
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
	having student_id = '".$rec_id."'
	";
   	
	$r_fee = $db->fetchRow($query_add_fee);
	$paid_fee = $r_fee['paid_fee'];
	$remaining_fee = ($r_total_fee['total_fee']*$fee_month)-$paid_fee;
   
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Student Fee <?php //echo $query_add_fee; ?></h4>
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
                                <div class="col-lg-8">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<tr>
							<td>Total Fee  :</td><td><?php echo $r_total_fee['total_fee']*$fee_month; ?></td>
							</tr>
							<tr>
							<td>Paid Fee   :</td><td><?php echo $paid_fee; ?></td>
							</tr>
							<tr>
							<td>Remaing Fee   :</td><td><?php echo $remaining_fee; ?></td>
							</tr>
														
							</table>								
                            
                                                   
                           
                                    </div>
									<br>
									<div class="col-lg-6">
                    <form role="form" id="register-form" action="../app/action/add_fee.php" method="post">
                                          <input type="hidden" name="student_id" id="student_id" value="<?php echo $r_id['id']; ?>">
										  <input type="hidden" name="registration_no" id="registration_no" value="<?php echo $r_id['registration_no']; ?>">
										  <input type="hidden" name="mobile_no" id="mobile_no" value="<?php echo $r_id['mobile_no']; ?>">
										  <input type="hidden" name="fee_date" id="fee_date" value="<?php echo date('Y-m-d'); ?>">
                                         <div class="form-group">
                                            <label>Current Deposit Fee</label>
                                            <input type="text" name="current_deposit_fee" id="current_deposit_fee"  class="form-control" >
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
                          