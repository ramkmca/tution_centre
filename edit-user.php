      <?php 
   require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
$rec_id = $_POST['rec_id'];
$query_id='SELECT * FROM ts_user_login where id = "'.$rec_id.'"';
$r_id = $db->fetchRow($query_id);

$user_id = $_SESSION['user_id'];
$valid_list_qur = "SELECT * FROM ts_user_login WHERE id ='".$user_id."'";
$valid_user_rec = $db->fetchRow($valid_list_qur);
$user_role = $valid_user_rec['role'];
$user_department = $valid_user_rec['department'];
$user_group = $valid_user_rec['dp_group'];

if($user_role==2)
{
	$valid_role = " AND role_id = 3";
}
if($user_role==1)
{
	$valid_role = " AND role_id IN(2,3)";
}
if($user_role==2 && $user_department!="" && $user_group=="")
{
	$valid_user = " AND department='".$user_department."'";
}
if($user_department!="")
{
	$valid_department = " AND dep_id='".$user_department."'";
}
if($user_role==2)
{
	$valid_role = " AND role_id = 3";
}
if($user_role==1)
{
	$valid_role = " AND role_id IN(2,3)";
}
$query_rol="SELECT * FROM ts_user_role WHERE 1 $valid_role";
$r_rol = $db->fetchResult($query_rol);
$department_id = $r_id['department'];
$query="SELECT * FROM ts_department WHERE 1 $valid_department";
$r = $db->fetchResult($query);

$query_grp="SELECT * FROM ts_group";
$r_grp = $db->fetchResult($query_grp);

$role =$r_id['role'];
$query_id='SELECT * FROM ts_user_role where role_id = "'.$role.'"';
$role_qur = $db->fetchRow($query_id);
$role_name = $role_qur['role_id'];



// echo $r_admin_list['full_name']; ?>

     <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User<?php // echo $valid_role.$user_role;?></h4>
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
                                    <form role="form" id="register-form1" action="app/action/front-agent.php" method="post">
                                      <div class="col-lg-12">
									 <div class="col-lg-6">
									    <div class="form-group">
										<input type="hidden" name="id" value="<?php echo $rec_id; ?>">
										<input type="hidden" name="group_id" id="group_id" value="<?php echo $r_id['dp_group']; ?>">
										
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
										
										
										<div class="form-group">
                                            <label>Role</label>
                                            <select  name="urole" id="role1" class="form-control" onchange="display_hide_group('role1','group_block1','dept_block1');">
                                                 <option value="0" selected disabled>Select</option>
                                                <?php foreach($r_rol as $value)
				{
				?>
                                                <option value="<?php echo $value['role_id'];?>" <?php if($value['role_id']==$role_name){?> selected <?php } ?>><?php echo $value['role_cat'];?></option>
                                <?php } ?>
                                            </select>
                                            </div>
											<?php 
											if($rec_id!=""){


											echo "<script>";
											echo "display_hide_group('role1','group_block1','dept_block1');";
											echo "</script>";


											}
											?>
											<div class="form-group" id="group_block1">
                                                <label for="disabledSelect">Group</label>
                                                <select name="ugrp" class="form-control" id="grp1">
                                                    <option value="0" selected disabled>Select</option>
                                                </select>
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
										 <div class="form-group" id="dept_block1">
                                            <label>Department</label>
                                            
                                            <select  name="udep" class="form-control" id="dep1" onchange="display_group('dep1','grp1');">
                                                <option value="0" selected disabled>Select</option>
                                                <?php foreach($r as $value)
				{
				?>
                                                <option value="<?php echo $value['dep_id'];?>" <?php if($value['dep_id']==$department_id){?> selected <?php } ?>><?php echo $value['dep_name'];?></option>
                                <?php } ?>
                                            </select>
                                        </div>
										<?php 
											if($rec_id!=""){


											echo "<script>";
											echo "display_group('dep1','grp1');";
											echo "</script>";


											}
											?>
										
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
            l_name: "required",
			upass: "required",
            
            uphone: {
                required: true,
                minlength: 10,
				maxlength: 10
            },
			
            uemail: {
                required: true,
                email: true
            },
			urole: "required",
			
			udep: "required",
			//ugrp: "required",
			uadep: "required",
			uagrp: "required",
			ugrp: "required"
			//uagrp: "required"
			
			
        },
        
        // Specify the validation error messages
        messages: {
            f_name: "Please enter first name",
                       
            l_name: "Please enter last name",
			upass: "Please enter password",
			uphone: "Please enter phone number",
			
            uemail: "Please valid email id",
			urole: "Please select role",
			
			udep: "Please select complainant department",
			//ugrp: "Please select complainant group",
			uadep: "Please select complaint against department",
			uadep: "Please select complaint against department",
			uagrp: "Please select complaint against group",
			uagrp: "Please select user group"
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
