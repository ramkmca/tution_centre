<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
    $user_id = $_SESSION['user_id']; 
	$error_msg ="";
	
	if(isset($_POST['submit']))
    {
	
	$opassword    =  trim(addslashes($_POST["opassword"]));
	$npassword    =  trim(addslashes($_POST["npassword"]));
	$cpassword    =  trim(addslashes($_POST["cpassword"]));
	$query="SELECT * FROM ts_user_login WHERE id='".$user_id."'"; 
    $r_id = $db->fetchRow($query);	
    if($r_id['pwd']!=$opassword){
	$error_msg = "Incorrect old password. ";	
	}	
	if($npassword!=$cpassword){
	$error_msg = "Your new password and conform password should be same. ";	
	}
    if($error_msg=="")
	{		
	$post_array = array(
       'pwd' => $npassword
	   
	   );
    $where = array('id'=>$user_id);
	$result = $db->update_query('ts_user_login', $post_array, $where, $exc);
	$_SESSION['sess_mess']="Password updated successfully";
    }
    }
   
	

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Profile</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           &nbsp;
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
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                      <form role="form" id="department-form" action="" method="post">
                                      <?php if($error_msg!=""){?>
									   <div class="form-group">
                                           <thead><tr> <td height="29" colspan="5" align="center" class="h12" ><font color="red"><?php echo $error_msg;?></font></td></tr> </thead> 
                                        </div>
									  <?php } ?>
                                        <div class="form-group">
                                            <label>Enter Old Password</label>
                                            <input type="password" name="opassword" class="form-control" placeholder="Old password">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter New Password</label>
                                            <input type="password" name="npassword" class="form-control"  placeholder="New password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" name="cpassword" class="form-control" placeholder="Conform password">
                                        </div>
                                         
                                        <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
                                    
                                    </form>
                                </div>
                                
                            </div>
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
  <div class="modal fade" id="edit_cmp" role="dialog">
    
  </div>
  <script src="assets/plugins/jquery-1.10.2.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  
  <!-- jQuery Form Validation code -->
  
  <script>
    jQuery(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            opassword: "required",
			npassword: "required",
			cpassword: "required"
			
			
         },
        
        // Specify the validation error messages
        messages: {
            opassword: "Please enter old password",
			npassword: "Please enter new password",
			cpassword: "Please enter conform password"			
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
