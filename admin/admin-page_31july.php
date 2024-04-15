<?php 
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
if(!isset($_SESSION['adminuser_name'])){
    header("location: index.php"); 
}
if(isset($_GET['id'])){
   $where = array('id'=>$_GET["id"]);
   //echo $_GET['id']; 
    $result = $db->delete_query('ts_user_login', $where); 
      $msg = 'Record Deleted';
      $_SESSION['msg'] = $msg;
       
	
    
}

$query="SELECT * FROM ts_department";
$r = $db->fetchResult($query);
$query_grp="SELECT * FROM ts_group";
$r_grp = $db->fetchResult($query_grp);
$query_rol="SELECT * FROM ts_user_role";
$r_rol = $db->fetchResult($query_rol);
$query_user_list="SELECT * FROM ts_user_login";
$r_user_list = $db->fetchResult($query_user_list);

?>

      <?php include_once('header.php'); ?>
   <?php include_once('left-sidebar.php'); ?>

        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">User List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="msg"> <?php if(isset($_SESSION['msg'])){
                                               echo $_SESSION['msg'];
                                               
                                               
                                           } ?>
                            </span>
                            All User List
                            <button type="button" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#add_new_user">Add New</button>
                             

                        </div>
                        <div class="modal fade" id="add_new_user" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New User</h4>
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
                                    <form role="form" id="register-form" action="../app/action/agent.php" method="post">
                                      <div class="col-lg-12">
									 <div class="col-lg-6">
									    <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="f_name" class="form-control" id="fname" placeholder="Enter first name" onblur="user_concat('fname','lname','uname');">
                                        </div>
										 <div class="form-group">
                                                <label for="disabledSelect">User Name</label>
                                                <input  type="text" name="unam" class="form-control" id="uname" type="text" readonly>
                                            </div>
											  <div class="form-group">
                                            <label>Telephone Number</label>
                                            <input  type="text" name="uphone" class="form-control" placeholder="Enter Phone Number">
                                        </div>
										<div class="form-group">
                                            <label>Role</label>
                                            <select  name="urole" id="role" class="form-control" onchange="display_hide_group('role','group_block');">
                                                 <option value="0" selected disabled>Select</option>
                                                <?php foreach($r_rol as $value)
				{
				?>
                                                <option value="<?php echo $value['role_id'];?>"><?php echo $value['role_cat'];?></option>
                                <?php } ?>
                                            </select>
                                            </div>
											<div class="form-group" id="group_block">
                                                <label for="disabledSelect">Group</label>
                                                <select name="ugrp" class="form-control" id="grp">
                                                    <option value="0" selected disabled>Select</option>
                                                </select>
                                            </div>
                                             
									 </div>
									 <div class="col-lg-6">
									 <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="l_name" class="form-control" id="lname" placeholder="Enter last name" onblur="user_concat('fname','lname','uname');">
                                        </div>
										 <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="upass" class="form-control" type="text" placeholder="Enter Password" >
                                        </div>
										<div class="form-group">
                                            <label>Email ID</label>
                                            <input type="text" name="uemail" class="form-control" type="email">
                                            
                                        </div>
										 <div class="form-group">
                                            <label>Department</label>
                                            
                                            <select  name="udep" class="form-control" id="dep" onchange="display_group('dep','grp');">
                                                <option value="0" selected disabled>Select</option>
                                                <?php foreach($r as $value)
				{
				?>
                                                <option value="<?php echo $value['dep_id'];?>"><?php echo $value['dep_name'];?></option>
                                <?php } ?>
                                            </select>
                                        </div>
										
										<div class="form-group">
                                            <label>Status</label>
                                         <select  name="ustatus" class="form-control">
                                                <option value="1">Activate</option>
                                                <option value="2">Suspend</option>
                                                
                                            </select>
                                        </div>
									 </div>
									 </div>
                                        
                                        
                                      
                                        <button type="submit" name="add_agent" id="submit_btn_id" class="btn btn-primary">Submit</button>
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
  </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User Full Name</th>
                                            <th>Mobile No.</th>
                                            <th>Email ID</th>
                                            <th>Department</th>
                                            <th>Group</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                             <th>Edit|Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          
                                          <?php foreach($r_user_list as $value)
				{
				?>
                                        
                                        <tr class="gradeA">
                                            <td><?php echo $value['full_name']; ?></td>
                                            <td><?php echo $value['mob_no']; ?></td>
                                            <td><?php echo $value['email_id']; ?></td>
                                            <td class="center"><?php foreach($r as $val) { if($value['department'] == $val['dep_id']){ echo $val['dep_name']; } } ?></td>
                                            <td class="center"><?php foreach($r_grp as $val) { if($value['dp_group'] == $val['group_id']){ echo $val['group_name']; } }  ?></td>
                                             <td class="center"><?php foreach($r_rol as $val) { if($value['role'] == $val['role_id']){ echo $val['role_cat']; } }  ?></td>
                                              <td class="center"><?php if($value['status'] == '1') { echo 'Active'; } else { echo 'Suspended'; }?></td>
                                            <td class="center">
                                <a href="edit-user.php?user_id=<?php echo $val['id']; ?>" class="btn btn-outline btn-link">Edit</a> |
                                <a href="?id=<?php echo $value['id']; ?>" class="btn btn-outline btn-link" onclick="return confirm('Are you shure you want to delete!')">Delete</a>
</td>
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
        </div>
        <!-- end page-wrapper -->
       <div class="modal fade" id="edit_user_pop_up_new" role="dialog">
    
      </div>
         <?php unset($_SESSION['msg']); ?>
           
<script src="../assets/plugins/jquery-1.10.2.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>
$(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        
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
   <?php include_once('footer.php'); ?>
