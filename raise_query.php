<?php    
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	} 
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	
	if($_REQUEST['group_id']=="" && isset($_POST['submit']))
    {
	$query="SELECT count(id) as ticket_count FROM ts_raise_query"; 
    $r_ticketcount = $db->fetchRow($query);
	$ticketcount     = trim($r_ticketcount['ticket_count'])+100000;
	
	$ticket_no = date('ymd');
	$ticket_no1 = date('ymd').$ticketcount;
    $information	=  trim(addslashes($_POST["information"]));	
	$cmp_name   	=  trim(addslashes($_POST["cmp_name"]));
	$mobile_no  	=  trim(addslashes($_POST["mobile_no"]));
	$address    	=  trim(addslashes($_POST["address"]));
	$date			=  date('Y-m-d H:i:s');
	$raise_by   	= $_SESSION['user_id'];
	
	$post_array = array(
	   'complaint_no' => $ticket_no1,
       'information_id' => trim(addslashes($_POST["information"])),
	   'cmp_name' => trim(addslashes($_POST["cmp_name"])),
	   'mobile_no' => trim(addslashes($_POST["mobile_no"])),
	   'address' => trim(addslashes($_POST["address"])),
	   'date' => $date,
	   'raise_by' => $raise_by
	   
	   );
  
	$result = $db->insert_query('ts_raise_query', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully Complaint No $ticket_no1";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='raise_query_list.php';
    </SCRIPT>");

	
	
    }
	

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Raise Query</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                      <div class="panel-heading" style="text-align:right;">
                            <a href="raise_query_list.php" class="btn btn-primary btn-xs">Information/Query List</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" id="department-form" action="" method="post">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <div class="form-group">
									
                                            <label>Information/Query </label>
											<select name="information" id="information" class="form-control">
											<option value="">--Select Department--</option>
											<?php 
												$query_user_list="SELECT * FROM ts_information";
												$r_user_list = $db->fetchResult($query_user_list);
												foreach($r_user_list as $value)
												{
											?>
											
											<option value="<?php echo $value['id'];?>" <?php if($value['id']==$information_id){ ?> selected <?php }?> ><?php echo $value['information'];?></option>
											<?php } ?>
											</select>
                                           
											</div>
											<div class="form-group">
									 
                                            <label>Name </label>
                                            <input type="text" name="cmp_name" id="cmp_name" value="<?php echo $cmp_name; ?>" class="form-control" >
											</div>
											<div class="form-group">
									 
                                            <label>Mobile No </label>
                                            <input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>" class="form-control" >
											</div>
											<div class="form-group">
									 
                                            <label>Address </label>
                                            <input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control" >
											</div>
											
										
									 </div>
									 <div class="clearfix"></div>
									
									 </div>
									 
										<div class="clearfix"></div>
										 
                                       
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="submit"  id="department_submit_id" class="btn btn-primary">Submit</button>
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
  <script src="assets/plugins/jquery.validate.min.js"></script>
  
  
  <!-- jQuery Form Validation code -->
  
  <script>
    jQuery(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            information: "required",
			cmp_name: "required",
			mobile_no: "required",
			address: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            information: "Please select query",
			cmp_name: "Please enter  name",
			mobile_no: "Please enter  mobile no",
			address: "Please enter  address"
			
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
