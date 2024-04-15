<?php    
	
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	
	if(isset($_POST['submit']))
    {
			
	$scheduled_downtime_msg = trim(addslashes($_POST["scheduled_downtime_msg"]));
	$scheduled_downtime_add = trim(addslashes($_POST["scheduled_downtime_add"]));
	$project_title   =  trim(addslashes($_POST["project_title"]));
	$footer_content   =  trim(addslashes($_POST["footer_content"]));
	
	
	 if($_FILES['image']['tmp_name']!="")

	   { 	

		$Thumbnail_Name   = time()+1;

		$Thumbnail_Name  .=  basename($_FILES['image']['name']);

		$uploadfile       = "../upload/" .$Thumbnail_Name;

		$img_path         = $_FILES['image']['tmp_name'];

		move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

        if($error!='yes')

	     {	

		$sql="Select * from ts_home_setting where 1 and  id=1";

		$r_id = $db->fetchRow($sql);
	    $image     = trim($r_id["image"]);

		
		if (file_exists("../upload/".$image) && $image!="") 

		{

			@unlink("../upload/".$image);

		}

       	//executeQuery("UPDATE ts_home_setting SET banner_image='".$Thumbnail_Name."' where 1 and banner_id='".$_POST['banner_id']."'");
		$post_array = array(
       'image' => trim($Thumbnail_Name)
	   
	   );
     $where = array('id'=>1);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_home_setting', $post_array, $where, $exc);

        }

     }


	
	$post_array = array(
	
       'scheduled_downtime_msg' => trim(addslashes($_POST["scheduled_downtime_msg"])),
	   'scheduled_downtime_add' => trim(addslashes($_POST["scheduled_downtime_add"])),
	   'project_title' => trim(addslashes($_POST["project_title"])),
	   'footer_content' => trim(addslashes($_POST["footer_content"]))
	   );
    $where = array('id'=>1);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_home_setting', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

		
    }
	
    $query="SELECT * FROM ts_home_setting WHERE id=1"; 
    $r_id = $db->fetchRow($query);
	$scheduled_downtime_msg     = trim($r_id["scheduled_downtime_msg"]);
	$scheduled_downtime_add     = trim($r_id["scheduled_downtime_add"]);
	
	$project_title     = trim($r_id["project_title"]);
	$footer_content     = trim($r_id["footer_content"]);
	$image     = trim($r_id["image"]);
	

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Home Setting <?php //print_r($result);?></h1>
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
                                    <form role="form" id="department-form" action="" method="post" enctype="multipart/form-data">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <!--<div class="form-group">
									 
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Scheduled Downtime Msg </label>
											<input type="text" name="scheduled_downtime_msg" id="scheduled_downtime_msg" value="<?php echo $scheduled_downtime_msg; ?>" class="form-control" >
                                           
											</div>
											<div class="form-group">
									 
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Scheduled Downtime Add </label>
											<input type="text" name="scheduled_downtime_add" id="scheduled_downtime_add" value="<?php echo $scheduled_downtime_add; ?>" class="form-control" >
                                           
											</div>-->
											<div class="form-group">
									 
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Project Title </label>
											<input type="text" name="project_title" id="project_title" value="<?php echo $project_title; ?>" class="form-control" >
                                           
											</div>
											<div class="form-group">
									 
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Footer Content </label>
											<input type="text" name="footer_content" id="footer_content" value="<?php echo $footer_content; ?>" class="form-control" >
                                           
											</div>	
										
										
									 </div>
									 <div class="clearfix"></div>
									 <div class="col-lg-6">
									 <div class="form-group">
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Projct Logo</label>
                                            <input type="file" name="image" id="image_id" class="form-control" ><br>
											<img src="../upload/<?php echo $image; ?>">  
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
           
            
            <?php unset($_SESSION['sess_mess']); ?>
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
            project_name: "required",
			project_title: "required"
			
			
         },
        
        // Specify the validation error messages
        messages: {
            project_name: "Please enter project name",
			project_title: "Please enter project title"
			
			
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
