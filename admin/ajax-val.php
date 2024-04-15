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
   	$query_id='SELECT * FROM ts_tickets where id = "'.$rec_id.'"';
	$r_id = $db->fetchRow($query_id);
	
	$query="SELECT complaint_type FROM ts_complaint_type WHERE id='".$r_id['complaint']."'"; 
	$r_complaint = $db->fetchRow($query);
	$complaint = 	trim($r_complaint['complaint_type']);
	$query="SELECT je_area, sub_station_name FROM ts_je WHERE id='".$r_id['respective_area']."'"; 
	$r_area = $db->fetchRow($query);
	$respected_area = 	trim($r_area['je_area']);
	$sub_station_name = 	trim($r_area['sub_station_name']);
	$query="SELECT div_code FROM ts_zone WHERE id='".$r_id['div_id']."'"; 
	$r_divid = $db->fetchRow($query);
	$div_code = 	trim($r_divid['div_code']);

   
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Ticket <?php //echo $back_page_name; ?></h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Complaint Details
                        </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<tr>
							<td>Complaint No  :</td><td><?php echo $r_id['cmp_no']; ?></td>
							</tr>
							<tr>
							<td>Acct ID  :</td><td><?php echo $r_id['acct_id']; ?></td>
							</tr>
							<tr>
							<td>Div Code :</td><td><?php echo $div_code; ?></td>
							</tr>
							<tr>
							<td>Sub Station Name :</td><td><?php echo $sub_station_name; ?></td>
							</tr>
							
							<tr>
							<td>Complaint  :</td><td><?php echo $complaint; ?></td>
							</tr>
							<tr>
							<td>Complaint Type  : </td><td><?php echo $r_id['complaint_type']; ?></td>
							</tr>
							<tr>
							<td>Date  :</td><td><?php echo $r_id['cmp_date']; ?></td>
							</tr>
							<tr>
							<td>Mobile No  :</td><td><?php echo $r_id['mobileno']; ?></td>
							</tr>
							<tr>
							<td>Status  :</td><td><?php echo ucwords($r_id['cmp_status']); ?></td>
							</tr>
							<tr>
							<td>Respective Area  :</td><td><?php echo $respected_area; ?></td>
							</tr>
							
							<tr>
							<td>Description  :</td><td><?php echo $r_id['cmp_desc']; ?></td>
							</tr>
							<?php if($r_id['cmp_comment']!=""){?>
							<tr>
							<td>Comment  :</td><td><?php echo $r_id['cmp_comment']; ?></td>
							</tr>
							<?php } ?>
							
							</table>								
                            
                                                   
                           
                                    </div>
									<div class="col-lg-6">
                    <form role="form" id="register-form" action="../app/action/ticket_update.php" method="post">
                                    
                                        
                                         <input type="hidden" name="cmp_id" value=<?php echo $rec_id;?>>
										
                                         <div class="form-group" id="complainant_group">
                                                <label for="disabledSelect"> Status</label>
                                                <select name="ugrp" class="form-control" id="ugrp">
												    <option value="" selected disabled>--Select--</option>
                                                    <option value="Open" <?php if($r_id['cmp_status']=='Open'){ ?>selected <?php }?> >Open</option>
													<option value="In Process" <?php if($r_id['cmp_status']=='In Process'){ ?>selected <?php }?> >In Process</option>
													<option value="Close" <?php if($r_id['cmp_status']=='Close'){ ?>selected <?php }?>>Close</option>
                                                </select>
                                            </div>
                                              
                                                                              
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <textarea name="cmp_comment" id="cmp_comment" class="form-control" rows="3"></textarea>
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
                          