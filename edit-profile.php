<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
    $user_id = $_SESSION['user_id']; 
	if(isset($_POST['submit']))
    {
			
	$fname    =  trim(addslashes($_POST["fname"]));
	$lname    =  trim(addslashes($_POST["lname"]));
	$uname    =  $fname.'.'.$lname;
	
	$telno    =  trim(addslashes($_POST["telno"]));
	$emailid    =  trim(addslashes($_POST["emailid"]));
	$full_name  =  $fname.' '.$lname;
	$post_array = array(
       'first_name' => $fname,
	   'last_name' => $lname,
	   'user_name' => $uname,
	   
	   'full_name' => $full_name,
	   'mob_no' => $telno,
	   'email_id' => $emailid
	   );
    $where = array('id'=>$user_id);
	$result = $db->update_query('ts_user_login', $post_array, $where, $exc);
	$_SESSION['sess_mess']="Record updated successfully";

    }
   
	
    $query="SELECT * FROM ts_user_login WHERE id='".$user_id."'"; 
    $r_id = $db->fetchRow($query);
	$first_name     = trim($r_id["first_name"]);
	$last_name      = trim($r_id["last_name"]);
	$mob_no         = trim($r_id["mob_no"]);
	$email_id       = trim($r_id["email_id"]);
	$user_name      = trim($r_id["user_name"]);

	

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
                                <div class="col-lg-12">
                                    <form role="form" id="department-form" action="" method="post">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text"  name="fname" value="<?php echo $first_name;?>" class="form-control" id="fname" onblur="user_concat('fname','lname','uname');">
                                        </div> 
                                          <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text"  name="lname" value="<?php echo $last_name;?>" class="form-control" id="lname" onblur="user_concat('fname','lname','uname');" >
                                        </div>
                                         <div class="form-group">
                                            <label>Username</label>
                                            <input type="text"  name="uname" value="<?php echo $user_name;?>" class="form-control" id="uname" disabled>
                                        </div>
                                      
                                         <div class="form-group">
                                            <label>Mobile No</label>
                                            <input type="text"  name="telno" value="<?php echo $mob_no;?>" id="telno" class="form-control">
                                        </div>
                                         <div class="form-group">
                                            <label>Email ID</label>
                                            <input  type="text"  name="emailid" id="emailid" value="<?php echo $email_id;?>" class="form-control">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <!--<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" placeholder="Enter password">
                                        </div>-->
										<div class="clearfix"></div>
										 
                                       
                                        <button type="submit" name="submit"  id="department_submit_id" class="btn btn-primary">Submit</button>
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
            fname: "required",
			lname: "required",
			telno: "required",
			emailid: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            fname: "Please enter first name",
			lname: "Please enter last name",
			telno: "Please enter mobile no",
			emailid: "Please enter email id"
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
