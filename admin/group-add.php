<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$group_id = $_REQUEST['group_id'];
	if($_REQUEST['group_id']=="" && isset($_POST['submit']))
    {
			
	$department_name    =  trim(addslashes($_POST["department_name"]));
	$group_name    =  trim(addslashes($_POST["group_name"]));
	
	$post_array = array(
       'dept_id' => trim(addslashes($_POST["department_name"])),
	   'group_name' => trim(addslashes($_POST["group_name"])),
	   'sla' => trim(addslashes($_POST["sla"]))
	   );
  
	$result = $db->insert_query('ts_group', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='group-list.php';
    </SCRIPT>");

	
	
    }
	if($_REQUEST['group_id']!="" && isset($_POST['submit']))
    {
			
	$department_name    =  trim(addslashes($_POST["department_name"]));
	$group_name    =  trim(addslashes($_POST["group_name"]));
	
	$post_array = array(
       'dept_id' => trim(addslashes($_POST["department_name"])),
	   'group_name' => trim(addslashes($_POST["group_name"])),
	   'sla' => trim(addslashes($_POST["sla"]))
	   );
    $where = array('group_id'=>$group_id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_group', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='group-list.php';
    </SCRIPT>");

	
    }
	if($_GET['group_id']!='')
    {
    $query="SELECT * FROM ts_group WHERE group_id='".$group_id."'"; 
    $r_id = $db->fetchRow($query);
	$department_id     = trim($r_id["dept_id"]);
	$group_name    	   = trim($r_id["group_name"]);
	$db_sla     	   = trim($r_id["sla"]);

	}

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if($_GET['group_id']=='')
    { echo "Add Group";}else{echo "Edit Group"; }?></h1>
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
											<select name="department_name" id="department_name" class="form-control">
											<option value="">--Select Department--</option>
											<?php 
												$query_user_list="SELECT * FROM ts_department";
												$r_user_list = $db->fetchResult($query_user_list);
												foreach($r_user_list as $value)
												{
											?>
											
											<option value="<?php echo $value['dep_id'];?>" <?php if($value['dep_id']==$department_id){ ?> selected <?php }?> ><?php echo $value['dep_name'];?></option>
											<?php } ?>
											</select>
                                           
											</div>
											
										
									 </div>
									 <div class="clearfix"></div>
									 <div class="col-lg-6">
									 <div class="form-group">
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Group Name </label>
                                            <input type="text" name="group_name" id="group_name" value="<?php echo $group_name; ?>" class="form-control" >
											</div>
										<div class="form-group">
                                            <label>SLA</label>
                                           <select  name="sla" class="form-control" id="sla">
                                                <option value="0" selected disabled>Select</option>
                                                <?php for($sla=1; $sla<=48; $sla++)
				                      {
				?>
                                                <option value="<?php echo $sla;?>" <?php if($db_sla==$sla){?> selected <?php } ?>><?php echo $sla;?></option>
                                <?php } ?>
                                            </select>
                                        </div>	
										
									 </div>
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
  <script src="../assets/plugins/jquery-1.10.2.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  
  <!-- jQuery Form Validation code -->
  
  <script>
    jQuery(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            department_name: "required",
			group_name: "required",
			sla: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            department_name: "Please select department name",
			group_name: "Please enter group name",
			sla: "please select sla"
			
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
