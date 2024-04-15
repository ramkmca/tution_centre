<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
//require_once 'assets/scripts/validation.js';

$query="SELECT * FROM ts_complaint_type";
$r = $db->fetchResult($query);
if(isset($_POST['view_comp_id']))
{
  
    $rec_id = trim($_POST['view_comp_id']);
	$mobileno = trim($_POST['mobileno']);
	$address = trim($_POST['address']);
	$con_name = trim($_POST['con_name']);
	if($con_name!="")
	{
		$con_name_qur = "AND name = '".$con_name."'";
		
	}
	
	if($rec_id!=""){
	$query_id='SELECT * FROM ts_account where acct_id = "'.$rec_id.'"';	
	}if($mobileno!=""){
	$query_id='SELECT * FROM ts_account where mobile_no = "'.$mobileno.'"';		
	}if($address!=""){
	$query_id="SELECT * FROM ts_account where 1 $con_name_qur AND address = '".$address."'";		
	}
   	
	$r_id = $db->fetchRow($query_id);
	//$ticket_no = time();
	$query="SELECT count(id) as ticket_count FROM ts_tickets"; 
    $r_ticketcount = $db->fetchRow($query);
	$ticketcount     = trim($r_ticketcount['ticket_count'])+100000;
	
	$ticket_no = date('ymd');
	$ticket_no1 = date('ymd').$ticketcount;
	$date 	   = date("Y-m-d H:i:s");
   if($r_id['div_code'] =="DIV141011"){
	   $div_number = "DIV-1";
   }else if($r_id['div_code'] =="DIV141012"){
	   $div_number = "DIV-2"; 
   }else if($r_id['div_code'] =="DIV141013"){
	   $div_number = "DIV-3"; 
   }else if($r_id['div_code'] =="DIV141014"){
	   $div_number = "DIV-4"; 
   }else if($r_id['div_code'] =="DIV141017"){
	   $div_number = "DIV-5"; 
   }else if($r_id['div_code'] =="DIV141016"){
	   $div_number = "DIV-6"; 
   }
   
   
   $query="SELECT id, div_code FROM ts_zone WHERE div_code='".$r_id['div_code']."'";
    $r_zone = $db->fetchRow($query);
	$division_no = $r_zone['id'];
	if($division_no!=""){
		$qur_division_no = "AND div_code = '".$division_no."'";
	}
   $query="SELECT * FROM ts_je WHERE 1 $qur_division_no";
   $r_je = $db->fetchResult($query);
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Raise Ticket <?php //echo $query_id; ?></h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Account Details
                        </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
								<?php if($rec_id!='substation'){?>
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<tr>
							<td><b>DIV Code :</b></td><td><?php echo $r_id['div_code']; ?></td>
							<td><b>DIV Number  :</b></td><td><?php echo $div_number; ?>
							
							
							</td>
							</tr>
							
							<tr>
							<td><b>Acct ID  :</b></td><td><?php echo $r_id['acct_id']; ?></td>
							<td><b>SCNO  :</b></td><td><?php echo $r_id['scno']; ?></td>
							</tr>
							<tr>
							
							<td><b>Book No: </b></td><td><?php echo $r_id['book_no']; ?></td>
							<td><b>Mobile No  :</b></td><td><?php echo $r_id['mobile_no']; ?></td>
							</tr>
							
							
							<tr>
							<td><b>Name  :</b></td><td><?php echo $r_id['name']; ?></td>
							<td><b>Address  :</b></td><td><?php echo $r_id['address']; ?></td>
							</tr>
							<tr>
							<td><b>Last_Pay_Amt :</b></td><td><?php echo $r_id['last_pay_amt']; ?></td>
							<td><b>Last_Pay_Date: </b></td><td><?php echo $r_id['last_pay_date']; ?></td>
							</tr>
							
													
							
							</table>								
								<?php  } ?>
                                                   
                           
                                    </div>
					 <div class="col-lg-12">   				
					
                    <form role="form" id="register-form" action="app/action/complaint_register.php" method="post">
									<input type="hidden" name="acct_mat_id" value=<?php echo $r_id['id'];?>>
									<input type="hidden" name="acct_id" value=<?php echo $r_id['acct_id'];?>>
					                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>"/> 
			                        <input type="hidden" name="ticket_no" id="ticket_no" value="<?php echo $ticket_no;?>">
									<input type="hidden" name="con_address" id="con_address" value="<?php echo $r_id['address']; ?>">
									
                                     <div class="col-lg-6">
									       <div class="form-group">
                                            <label> Complaint Number</label>
                                            <input type="text" name="ticket_no1" id="ticket_no1" class="form-control" value="<?php echo $ticket_no1;?>" readonly>
                                        </div>
										<div class="form-group">
                                            <label> Complaint</label>
                                           <select  name="complaint_name" class="form-control" id="complaint_name" >
                                                <option value="0" selected disabled>Select</option>
                                                <?php foreach($r as $value)
				{
				?>
                                                <option value="<?php echo $value['id'];?>"><?php echo $value['complaint_type'];?></option>
                                <?php } ?>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>New Mobile No</label>
                                            <input type="text" name="new_mobile_no" id="new_mobile_no" class="form-control" placeholder="New Mobile Number">
                                        </div>
										
										
										 </div>
										 
										 <div class="col-lg-6">
									       <div class="form-group">
									 
                                            <label> Date/Time </label>
                                            <input type="text" name="date" id="date" class="form-control" value="<?php echo $date; ?>" readonly>
											</div>
											<div class="form-group">
                                            <label> Complaint Type </label>
                                           <select  name="complaint_type" class="form-control" id="complaint_type" >
                                                <option value="0" selected disabled>Select</option>
                                              <?php if($rec_id!='substation'){?>
                                                <option value="single house">Single House</option>
												
												<option value="complete area">Complete Area</option>
											  <?php }else{ ?>
												<option value="scheduled downtime">Scheduled Downtime</option>
                                              <?php } ?>
                                            </select>
                                        </div>
										
										
										<div class="form-group">
                                            <label>Sub Station</label>
                                            <input type="text" name="respective_area" id="respective_area" class="form-control" placeholder="Respective Area" >
                                        </div>
										<div class="form-group" id="displayje"></div>
										
										<div class="form-group" id="id_jedetail">
                                            
                                        </div>
                                        </div>
                                         <div class="clearfix"></div>
										                      
                                        <div class="form-group">
                                            <label>Comment/Query</label>
                                            <textarea name="cmp_desc" id="cmp_desc" class="form-control" rows="3"></textarea>
                                        </div>
										
                                        <button type="submit" name="complaint_register"  id="submit_btn_id" class="btn btn-primary">Raise</button>
                                        
                                    </form>
                     <!-- End Form Elements -->
                         </div>
                                    </div>
                                    </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
                                <?php  

}
?>
<script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        
        // Specify the validation rules
        rules: {
            new_mobile_no: "required",
			respective_area: "required",
			cmp_desc: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            new_mobile_no: "Please enter mobile no",
			respective_area: "Please select area",
			cmp_desc: "Enter detail"
			
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

	function fillje(Value)
{
	
$('#respective_area').val(Value);
$('#displayje').hide();
display_jedetail();
}

$(document).ready(function(){
	//alert('ssss');
$("#respective_area").keyup(function() {
var respective_area = $('#respective_area').val();
//alert(respective_area);
if(respective_area=="")
{
$("#displayje").html("");
}
else
{
$.ajax({
type: "POST",
url: "comp_suggestionje_ajax.php",
data: "respective_area="+ respective_area ,
success: function(html){
$("#displayje").html(html).show();

}
});
}
});
});

function display_jedetail()
  {
	  
	  var je_id = $('#respective_area').val();
	  //alert(je_id);
	  
	var urlAdd = 'get_je.php';
    var urlData;

   urlData = "je_id="+je_id;
     
    $.ajax({
        type: "GET", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
            $('#id_jedetail').html(data.responseText);
        }
    });
  }
  
</script>