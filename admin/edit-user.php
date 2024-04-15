      <?php 
   require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
$rec_id = $_POST['rec_id'];
$query_id='SELECT * FROM ts_user_login where id = "'.$rec_id.'"';
$r_id = $db->fetchRow($query_id);

// echo $r_admin_list['full_name']; ?>

     <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User<?php //echo $department_id;?></h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" id="register-form1" action="../app/action/agent.php" method="post">
                                      <div class="col-lg-12">
									 <div class="col-lg-6">
									    <div class="form-group">
										<input type="hidden" name="id" value="<?php echo $rec_id; ?>">
                                            <label>First Name</label>
                                            <input type="text" name="f_name" value="<?php echo $r_id['first_name']; ?>" class="form-control" id="fname1" placeholder="Enter first name" onblur="user_concat('fname1','lname1','uname1');">
                                        </div>
										 <div class="form-group">
                                                <label for="disabledSelect">User Name</label>
                                                <input  type="text" name="unam" value="<?php echo $r_id['user_name']; ?>" class="form-control" id="uname1" type="text" readonly>
                                            </div>
											  <div class="form-group">
                                            <label>Telephone Number</label>
                                            <input  type="text" name="uphone" value="<?php echo $r_id['mob_no']; ?>" class="form-control" placeholder="Enter Phone Number">
                                        </div>
										
										
										
                                             
									 </div>
									 <div class="col-lg-6">
									 <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="l_name" value="<?php echo $r_id['last_name']; ?>" class="form-control" id="lname1" placeholder="Enter last name" onblur="user_concat('fname1','lname1','uname1');">
                                        </div>
										 <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="upass" value="<?php echo $r_id['pwd']; ?>" class="form-control" type="text" placeholder="Enter Password" >
                                        </div>
										<div class="form-group">
                                            <label>Email ID</label>
                                            <input type="text" name="uemail" value="<?php echo $r_id['email_id']; ?>" class="form-control" type="email">
                                            
                                        </div>
										 
										
										<div class="form-group">
                                            <label>Status</label>
                                         <select  name="ustatus" class="form-control">
                                                <option value="1" <?php if($r_id['status']==1){?> <?php }?>>Activate</option>
                                                <option value="2" <?php if($r_id['status']==2){?> <?php }?>>Suspend</option>
                                                
                                            </select>
                                        </div>
									 </div>
									 </div>
                                        
                                        
                                      
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="add_agent" id="submit_btn_id" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
                                    </form>
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
	
	
<script>
$(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form1").validate({
    
        
        // Specify the validation rules
        rules: {
            f_name: "required",
           
			upass: "required",
            
            unam: "required"
			
			
			
        },
        
        // Specify the validation error messages
        messages: {
            f_name: "Please enter first name",
                       
           
			upass: "Please enter password",
			
			unam: "Please enter user name"
			//uagrp: "Please select complaint against group"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });

</script>
<script type="text/javascript">
 
	  $( "#submit_btn_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});

	


</script>
   <?php //include_once('footer.php'); ?>
