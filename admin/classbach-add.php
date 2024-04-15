<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$id = $_REQUEST['id'];
	if($_REQUEST['id']=="" && isset($_POST['submit']))
    {
			
	$class_name    =  trim(addslashes($_POST["class_name"]));
	$batch_name    =  trim(addslashes($_POST["batch_name"]));
	$fee    	   =  trim(addslashes($_POST["fee"]));
	$batch_type    =  trim(addslashes($_POST["batch_type"]));
	$batch_time    =  trim(addslashes($_POST["batch_time"]));
	$status		   =  trim(addslashes($_POST["status"]));
	
	
	$post_array = array(
       'class_id' => $class_name,
	   'batch_name' => $batch_name,
	   'fee' => $fee,
	   'batch_type' => $batch_type,
	   'batch_time' => $batch_time,
	   'status' => $status
	   );
  
	$result = $db->insert_query('ts_batch', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='classbach-list.php';
    </SCRIPT>");

    }
	if($_REQUEST['id']!="" && isset($_POST['submit']))
    {
			
	$class_name    =  trim(addslashes($_POST["class_name"]));
	$batch_name    =  trim(addslashes($_POST["batch_name"]));
	$fee    	   =  trim(addslashes($_POST["fee"]));
	$batch_type    =  trim(addslashes($_POST["batch_type"]));
	$batch_time    =  trim(addslashes($_POST["batch_time"]));
	$status		   =  trim(addslashes($_POST["status"]));
	
	
	$post_array = array(
       'class_id' => $class_name,
	   'batch_name' => $batch_name,
	   'fee' => $fee,
	   'batch_type' => $batch_type,
	   'batch_time' => $batch_time,
	   'status' => $status
	   );
  
    $where = array('id'=>$id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_batch', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='classbach-list.php';
    </SCRIPT>");

	
    }
	if($_GET['id']!='')
    {
    $query="SELECT * FROM ts_batch WHERE id='".$id."'"; 
    $r_id = $db->fetchRow($query);
	$class_id     	= trim($r_id["class_id"]);
	$batch_name     = trim($r_id["batch_name"]);
	$fee     		= trim($r_id["fee"]);
	$batch_type     = trim($r_id["batch_type"]);
	$batch_time     = trim($r_id["batch_time"]);
	$status     	= trim($r_id["status"]);

	}

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
				<?php if($_GET['id']=='') {?>
                    <h1 class="page-header">Add Batch</h1>
				<?php } else{?>
					<h1 class="page-header">Edit Batch</h1>
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
									 
                                            <label>Class Name </label>
											<select name="class_name" id="class_name" class="form-control">
											<option value="">--Select Class--</option>
											<?php 
												$query_user_list="SELECT * FROM ts_class";
												$r_class_list = $db->fetchResult($query_user_list);
												foreach($r_class_list as $value)
												{
											?>
											
											<option value="<?php echo $value['id'];?>" <?php if($value['id']==$class_id){ ?> selected <?php }?> ><?php echo ucwords($value['class']);?></option>
											<?php } ?>
											</select>
                                           
                                           </div>
											
											<div class="form-group">
									         
                                            <label>Batch Name </label>
                                            <input type="text" name="batch_name" id="batch_name" value="<?php echo $batch_name; ?>" class="form-control" >
											</div>
											<div class="form-group">
									         
                                            <label>Fee </label>
                                            <input type="text" name="fee" id="fee" value="<?php echo $fee; ?>" class="form-control" >
											</div>
											<div class="form-group">
									 
                                            <label>Batch Type </label>
											<select name="batch_type" id="batch_type" class="form-control">
											<option value="">--Select Class--</option>
											<option value="Daily" <?php if($batch_type=='Daily'){?> selected <?php }?>>Daily</option>
											<option value="MWF" <?php if($batch_type=='MWF'){?> selected <?php }?>>MWF</option>
											<option value="TTS" <?php if($batch_type=='TTS'){?> selected <?php }?>>TTS</option>
											</select>
                                           
                                           	</div>
											<div class="form-group">
									 
                                            <label>Batch Time </label>
                                            <input type="text" name="batch_time" id="batch_time" value="<?php echo $batch_time; ?>" class="form-control" >
											</div>
											<div class="form-group">
									 
                                            <label>Status </label>
											<select name="status" id="status" class="form-control">
											
											<option value="Activeted" <?php if($status=='Activeted'){?> selected <?php }?>>Activeted</option>
											<option value="Deactiveted" <?php if($status=='Deactiveted'){?> selected <?php }?>>Deactiveted</option>
											
											</select>
                                            
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
            class_name: "required",
			batch_name: "required",
			batch_type: "required",
			batch_time: "required"
			   
			    
			
         },
        
        // Specify the validation error messages
        messages: {
            class_name: "Please select class name",
			batch_name: "Please enter batch name",
			batch_type: "Please select batch type",
			batch_time: "Please enter batch time"
			
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
