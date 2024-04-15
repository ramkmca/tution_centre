<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$id = $_REQUEST['id'];
	if($_REQUEST['id']=="" && isset($_POST['submit']))
    {
			
	$mail_type    =  trim(addslashes($_POST["mail_type"]));
	$mail_content    =  trim(addslashes($_POST["mail_content"]));
	
	$post_array = array(
       'mail_type' => $mail_type,
	   'mail_content' => $mail_content
	   );
  
	$result = $db->insert_query('ts_mailcontent', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='mailcontent-list.php';
    </SCRIPT>");

	
	
    }
	if($_REQUEST['id']!="" && isset($_POST['submit']))
    {
			
	$mail_type    =  trim(addslashes($_POST["mail_type"]));
	$mail_content    =  trim(addslashes($_POST["mail_content"]));
	
	$post_array = array(
       
	   'mail_content' => $mail_content
	   );
    $where = array('id'=>$id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_mailcontent', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='mailcontent-list.php';
    </SCRIPT>");

	
    }
	if($_GET['id']!='')
    {
    $query="SELECT * FROM ts_mailcontent WHERE id='".$id."'"; 
    $r_id = $db->fetchRow($query);
	$mail_type     = trim($r_id["mail_type"]);
	$mail_content     = trim($r_id["mail_content"]);

	}

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
				<?php if($_GET['id']=='') {?>
                    <h1 class="page-header">Add Message Content</h1>
				<?php } else{?>
					<h1 class="page-header">Edit Message Content</h1>
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
                                    <form role="form" id="department-form" action="" method="post">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <div class="form-group">
									 
                                            <label>Message Type</label>
                                            <input type="text" name="mail_type" id="mail_type" value="<?php echo $mail_type; ?>" class="form-control" >
											</div>
										<div class="form-group">
									 
                                            <label>Message Content</label>
                                            
											<textarea name="mail_content" id="mail_content" class="form-control" cols="30" rows="5"><?php echo $mail_content; ?></textarea>
											</div>	
										
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
<div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
  <div class="modal fade" id="edit_cmp" role="dialog">
    
  </div>
  <script src="../assets/plugins/jquery-1.10.2.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  
  <script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            mail_type: "required",
			mail_content: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            mail_type: "Please enter message type",
			mail_content: "Please enter message content"
			
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
