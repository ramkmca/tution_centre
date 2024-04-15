<?php    
	
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$event_id = $_REQUEST['event_id'];
	if($_REQUEST['event_id']=="" && isset($_POST['submit']))
    {
			
	$event_type    =  trim(addslashes($_POST["event_type"]));
	$event_title    =  trim(addslashes($_POST["event_title"]));
	$event_date    =  trim(addslashes($_POST["event_date"]));
	$status    =  trim(addslashes($_POST["status"]));
	
	
	$post_array = array(
       'event_type' => trim(addslashes($_POST["event_type"])),
	   'event_title' => trim(addslashes($_POST["event_title"])),
	   'event_date' => $event_date,
	    'status' => trim(addslashes($_POST["status"]))
	    );
  
	$result = $db->insert_query('ts_events', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='event-list.php';
    </SCRIPT>");

	
	
    }
	if($_REQUEST['event_id']!="" && isset($_POST['submit']))
    {
			
	$event_type    =  trim(addslashes($_POST["event_type"]));
	$event_title    =  trim(addslashes($_POST["event_title"]));
	$event_date    =  trim(addslashes($_POST["event_date"]));
	$status    =  trim(addslashes($_POST["status"]));
	$post_array = array(
       'event_type' => trim(addslashes($_POST["event_type"])),
	   'event_title' => trim(addslashes($_POST["event_title"])),
	   'event_date' => $event_date,
	    'status' => trim(addslashes($_POST["status"])),
	    );
    $where = array('id'=>$event_id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_events', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='event-list.php';
    </SCRIPT>");

	
    }
	if($_GET['event_id']!='')
    {
    $query="SELECT * FROM ts_events WHERE id='".$event_id."'"; 
    $r_id = $db->fetchRow($query);
	$event_type     = trim($r_id["event_type"]);
	$event_title    	   = trim($r_id["event_title"]);
	$event_date    	   = trim($r_id["event_date"]);
	$status    	   = trim($r_id["status"]);
	

	}
$current_date = date('Y-m-d');
?>
        <!--  page-wrapper -->
		<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if($_GET['event_id']=='')
    { echo "Add Event";}else{echo "Edit Event"; }?><?php print_r($post_array);?></h1>
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
                                            <label>Event Type </label>
											<select name="event_type" id="event_type" class="form-control">
											<option value="">--Select Event Type--</option>
											<?php 
												$query_user_list="SELECT * FROM ts_event_type";
												$r_user_list = $db->fetchResult($query_user_list);
												foreach($r_user_list as $value)
												{
											?>
											
											<option value="<?php echo $value['id'];?>" <?php if($value['id']==$event_type){ ?> selected <?php }?> ><?php echo ucwords($value['event_type']);?></option>
											<?php } ?>
											</select>
                                           
											</div>
											
										
									 </div>
									 <div class="clearfix"></div>
									 <div class="col-lg-6">
									 <div class="form-group">
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Event Title </label>
                                            <input type="text" name="event_title" id="event_title" value="<?php echo $event_title; ?>" class="form-control" >
											</div>
										
										
									 </div>
									 <div class="clearfix"></div>
									 <div class="col-lg-6">
									 <div class="form-group">
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Event Date Time</label>
                                            <input type="text" name="event_date" id="datetimepicker" value="<?php echo $event_date; ?>" class="form-control" >
											
											</div>
										
										
									 </div>
									 <div class="clearfix"></div>
									 <div class="col-lg-6">
									 <div class="form-group">
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
											<option value="Activate" <?php if($status=='Activate'){?> selected <?php } ?> >Activate</option>
											<option value="Deactivate" <?php if($status=='Deactivate'){?> selected <?php } ?> >Deactivate</option>
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
  <script src="assets/plugins/jquery-1.10.2.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  
  <script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2016/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'<?php echo $current_date;?>'
});
$('#datetimepicker').datetimepicker({value:'',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});




</script>
  <!-- jQuery Form Validation code -->
  
  <script>
    jQuery(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
            event_type: "required",
			event_title: "required",
			event_date: "required"
			
			
         },
        
        // Specify the validation error messages
        messages: {
            event_type: "Please select event type",
			event_title: "Please enter event title",
			event_date: "Please select date time"
			
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
