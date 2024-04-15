<?php 
date_default_timezone_set('Asia/Kolkata');
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php'; 
if(isset($_SESSION['user_name'])){
    header("location: agent-view.php"); 
} 


$query="SELECT * FROM ts_home_setting WHERE id=1"; 
$r_id = $db->fetchRow($query);
$project_name     = trim($r_id["project_name"]);
$project_title     = trim($r_id["project_title"]);
$image     = trim($r_id["image"]);
?>

<!DOCTYPE html>
<html>
<style type="text/css">


#slideshow > div { 
    position: absolute; 
    
}
</style>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project_title;?></title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

</head>

  
<style>
.center {
    text-align: center;
    
	position: absolute;
	left: 40%;
    margin-left: -50px;
   
 
  
}
.panel-title-login{ color:#333333;}
 body {
    background-color: #ffffff !important;
}

</style>
<body class="login-body">
             <?php 
				$query="SELECT * FROM ts_home_setting WHERE id=1"; 
				$r_id = $db->fetchRow($query);
				$project_name     = trim($r_id["project_name"]);
				$image     = trim($r_id["image"]);
				?>
       
			<br><br><br>
    <div class="container">
    
               	
		  <div>
           
				
			
				
                <div>
                 <div class="center">
					<div>
                        <h3 class="panel-title"><a  href="index.php">
                    <img  src="upload/<?php echo $image; ?>" height="120px">
					
                </a>	</h3>
                    </div>	
              <div class="clearfix"></div>			
			
                    <div class="panel-heading">
                        <h3 class="panel-title-login">Member Login</h3>
                    </div>
					<?php if(isset($_SESSION['msg'])){?>
                    <span class="msg_ticket"> 
					<?php
                                               echo $_SESSION['msg'];
                                               unset($_SESSION['msg']);
                      ?>                         
                                          
                            </span>
				    <?php } ?>
					
                    <div class="panel-body">
                        <form role="form" action="app/action/user-login.php" method="post">
                            
                                <div class="form-group">
								 <input id="registration_no" name="registration_no" class="form-control-login" type="text" placeholder="Registration No">
                                </div>
                                <div class="form-group">
								<input id="dob" name="dob" class="form-control-login"  type="password" placeholder="DOB">
								<div style="text-align: left;">DOB Should(YYYY-mm-dd) format</div>
                                </div>
                                
                                <span class="pwd_msg"><?php if(isset($_REQUEST['msg'])){
                                    
                                    echo $_REQUEST['msg'];
                                  }  ?></span>
                                
                                <!-- Change this to a button or input when using this as a form -->
							  <input type="submit" name="users_login" class="btn btn-lg btn-success btn-block" value="Login" onclick="return user_login('registration_no','dob','pwd_msg');" />
                                
                                <!--<div style="text-align:center;"> <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#register_complaint">Raise Ticket</button>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#track_complaint">Track Complaint</button></div>-->
						   
                            
                                    <!--<label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>-->
									
									
                                
                            
                        </form>
						<div style="width:360px; text-align:left; margin:20px 0px;">
						
						<a href="#"  data-toggle="modal" data-target="#user_forget_password" >Forget Login or Password</a>
						
						</div>
						
                  </div> 
                  </div>    				  
                         <!-- Modal -->
 
    
   <div class="modal fade" id="user_forget_password" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forget Login or Password</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Email ID
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                        <div class="form-group">
                                            
                                            <input type="text" class="form-control" name="forget_email" id="forget_email">
                                            
                                        </div>
                                                                             
                                        <button class="btn btn-primary" id="user_forget_email">Get Password</button>
                                        
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
					
                     <!-- End Form Elements -->
                </div>
            </div>
			<div id="forget_password_response">
			
			</div>
			
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>          
                    </div>
                </div>
            
        </div>
		
      
       

    </div>
  
     <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
     <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  <script>
$("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow');
},  3000);
</script>
  <script>
  $("#submit_complaint").click(function(){
    var ticketcmp = $('#user_track_complaint').val();
	if(ticketcmp=="")
	{
	 alert('Plese Enter Complaint ID ');
	}
	//alert(ticketcmp);
	var urlAdd = 'ticket_complaint.php';
    var urlData;

    urlData = "ticketcmp="+ticketcmp;
     //alert(urlData);
    $.ajax({
        type: "GET", url: urlAdd, data: urlData,

        complete: function(data)
        {
           // alert(data.responseText);
			$('#track_complaint_detail').html(data.responseText);
            
        }
    });
	
  });
  
   $("#user_forget_email").click(function(){
	 
    var forgetemail = $('#forget_email').val();
	if(forgetemail=="")
	{
	 alert('Plese Enter Your Email ID');
	}else{
	$(this).hide();		
		}
	var urlAdd = 'forget_password.php';
    var urlData;
    
    urlData = "forgetemail="+forgetemail;
     //alert(urlData);
	 alert('Your detail is send on your  mail.');
    $.ajax({
        type: "GET", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
			
			$('#forget_password_response').html(data.responseText);
			
            
        }
    });
	
  });

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
  // When the browser is ready...

    $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        
        // Specify the validation rules
        rules: {
			crn_number: "required",
            f_name: "required",
            address: "required",
            
            uphone: {
                required: true,
                minlength: 10,
				maxlength: 10
            },
			
           
			complaint_type:"required",
			
			priority: "required",
			zone: "required",
			disposition: "required"
			
			//uagrp: "required"
			
			
        },
        
        // Specify the validation error messages
        messages: {
			crn_number: "Please enter crn number",
            f_name: "Please enter name",
                       
            address: "Please enter address",
			uphone: "Please enter phone number",
			complaint_type: "Please select complaint type",
			
			priority: "Please select priority",
			zone: "Please select zone",
			disposition: "Please select disposition"
			
			
			//uagrp: "Please select complaint against group"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });

  
  
  </script>
  <script type="text/javascript">
 
	  $( "#submit_btn_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});
      function user_login(usrid,pswdid,msg){
         
         //return false;
        // alert();
        var new_user =  jQuery("#"+usrid).val();
        var user_pass =  jQuery("#"+pswdid).val();
        
          if((new_user == '') || (user_pass == '')){
               
               var message = 'Please fill in the field';
              $("."+msg).html(message);
              return false;
          }
         
    }
</script>

</body>

</html>
