<?php    
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	} 
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$dept_id = $_REQUEST['dept_id'];
	if($_REQUEST['dept_id']=="" && isset($_POST['submit']))
    {
			
	$department_name    =  trim(addslashes($_POST["department_name"]));
	
	$post_array = array(
       'dep_name' => trim(addslashes($_POST["department_name"]))
	   );
  
	$result = $db->insert_query('ts_department', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='department-list.php';
    </SCRIPT>");

	
	
    }
	if($_REQUEST['dept_id']!="" && isset($_POST['submit']))
    {
			
	$department_name    =  trim(addslashes($_POST["department_name"]));
	
	$post_array = array(
       'dep_name' => $department_name
	   );
    $where = array('dep_id'=>$dept_id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_department', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='department-list.php';
    </SCRIPT>");

	
    }
	if($_GET['dept_id']!='')
    {
    $query="SELECT * FROM ts_department WHERE dep_id='".$dept_id."'"; 
    $r_id = $db->fetchRow($query);
	$department_name     = trim($r_id["dep_name"]);

	}

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Add Department</h1>
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
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Department Name </label>
                                            <input type="text" name="department_name" id="department_name" value="<?php echo $department_name; ?>" class="form-control" >
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
  <script src="assets/plugins/jquery-1.10.2.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  
  <script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            department_name: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            department_name: "Please enter department name"
			
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
