<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';

$rec_id = $_POST['view_comp_id'];
$query="SELECT * FROM ts_department";
$r = $db->fetchResult($query);
		
?>


   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reassign Ticket<?php// echo $rec_id;?></h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-6">
                    <!-- Form Elements -->
                    <form role="form" id="reassign-form" action="app/action/ticket_reassign.php" method="post">
                                    
                                        
                                         <input type="hidden" name="cmp_id" value=<?php echo $rec_id;?>>
                                         <div class="form-group">
                                            <label>Complaint Department</label>
                                           <select  name="uadep_ra" class="form-control" id="uadep_ra" onchange="display_comp_agent_group(this.value,'complainant_againt_group');">
                                                <option value="0" selected disabled>Select</option>
                                                <?php foreach($r as $value)
				{
				?>
                                                <option value="<?php echo $value['dep_id'];?>"><?php echo $value['dep_name'];?></option>
                                <?php } ?>
                                            </select>
                                        </div>
										<div class="form-group" id="complainant_againt_group">
                                                <label for="disabledSelect">Complaint Group</label>
                                                <select name="uagrp" id="uagrp" class="form-control" >
                                                    <option value="0" selected disabled>Select</option>
                                                </select>
                                            </div>
                                              
                                                                              
                                      
                                        <button type="submit" name="complaint_register"  id="submit_btn_id" class="btn btn-primary">Reassign</button>
                                        
                                    </form>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
	
	
	 <script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#reassign-form").validate({
    
        
        // Specify the validation rules
        rules: {
            uadep_ra: "required",
			uagrp: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            uadep_ra: "Please select department",
			uagrp: "Please select group"
			
           },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
    $( "#submit_btn_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});

        </script>
                            
<script>
  function display_comp_group(dept,grpid)
  {
	  var grpid = grpid;
	  //alert(grpid);
	var urlAdd = 'group.php';
    var urlData;

    var targetDiv = $("#"+grpid);
     //alert(targetDiv);
   urlData = "dept="+dept;
     
    $.ajax({
        type: "GET", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
            targetDiv.html(data.responseText);
        }
    });
  }
  function display_comp_agent_group(dept,grpid)
  {
	  var grpid = grpid;
	  //alert(grpid);
	var urlAdd = 'agent-group.php';
    var urlData;

    var targetDiv = $("#"+grpid);
     //alert(targetDiv);
   urlData = "dept="+dept;
     
    $.ajax({
        type: "GET", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
            targetDiv.html(data.responseText);
        }
    });
  }
  </script>
