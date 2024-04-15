<?php 
date_default_timezone_set('Asia/Kolkata');
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php'; 
if(isset($_SESSION['user_name'])){
    header("location: agent-view.php"); 
} 

$query="SELECT * FROM ts_department";
$r = $db->fetchResult($query);
$query_grp="SELECT * FROM ts_group";
$r_grp = $db->fetchResult($query_grp);
$query_rol="SELECT * FROM ts_user_role";
$r_rol = $db->fetchResult($query_rol);
$query_user_list="SELECT * FROM ts_user_login";
$r_user_list = $db->fetchResult($query_user_list);
$ticket_no = time();

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

   

<body >
             <?php 
				$query="SELECT * FROM ts_home_setting WHERE id=1"; 
				$r_id = $db->fetchRow($query);
				$project_name     = trim($r_id["project_name"]);
				$image     = trim($r_id["image"]);
				?>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar" style="height:81px">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img  src="upload/<?php echo $image; ?>">
					
                </a>
            </div>
			             <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
               

                <li class="dropdown">
				<h3><a style="color:#FFF;" href="admin">Admin Login</a></h3> 
				
                   
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->
			</nav>
			<br><br><br><br><br>
    <div class="container">
      <?php 
	  $query_slider_list="SELECT * FROM ts_slider WHERE status='activate'";
      $r_slider_list = $db->fetchResult($query_slider_list);
	  ?>
		<div class="col-lg-6" style="padding:35px 0px 0px 0px;">
			
            <div class="row">
			<div id="slideshow">
			 <?php foreach($r_slider_list as $value){
				?> 
				
   <div>
     <img src="upload/<?php echo $value['image']; ?>" width="530" height="320">
   </div>
   

			<?php	 
			 }
			
            ?>
			</div>
			</div>
		
		</div>
		
		<div class="col-lg-6" style="padding:10px 40px;">
         

		  <div class="row">
           
            
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Agent Login</h3>
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
                                    <input id="usrname" name="usrname" class="form-control" placeholder="Username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="pswd" name="pswd" class="form-control" placeholder="Password" type="password">
                                </div>
                                
                                <span class="pwd_msg"><?php if(isset($_REQUEST['msg'])){
                                    
                                    echo $_REQUEST['msg'];
                                  }  ?></span>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="users_login" class="btn btn-lg btn-success btn-block" value="Login" onclick="return user_login('usrname','pswd','pwd_msg');" />
                           
                            
                                    <!--<label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>-->
									
									
                                
                            
                        </form>
						<div style="width:480px; text-align:right; margin:20px;">
						
						<a href="#"  data-toggle="modal" data-target="#user_forget_password" >Forget Login or Password</a>
						
						</div>
						
                          <div style="width:318px text-align:left;"><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#register_complaint">Raise Ticket</button>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#track_complaint">Track Complaint</button></div>
						  
                         <!-- Modal -->
  <div class="modal fade" id="register_complaint" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Raise Ticket</h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Register Complaint
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" id="register-form" action="app/action/complaint_register.php" method="post">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <div class="form-group">
									 <input type="hidden" name="ticket_no" value="<?php echo $ticket_no;?>">
                                            <label>Complainant First Name </label>
                                            <input type="text" name="f_name" id="f_name" class="form-control"  placeholder="Enter first name">
											</div>
											<div class="form-group">
                                            <label>Complainant Number</label>
                                            <input type="text" name="uphone" id="uphone" class="form-control" placeholder="Enter Phone Number">
                                        </div>
										<div class="form-group">
                                            <label>Complainant Company</label>
                                            <input type="text" name="complainant_company" id="complainant_company" class="form-control" placeholder="Enter Complainant Company">
                                        </div>
										 <div class="form-group" id="complainant_againt_group">
                                                <label for="disabledSelect">Complaint Group</label>
                                                <select name="uagrp" id="uagrp" class="form-control" id="ugrp">
                                                    <option value="0" selected disabled>Select</option>
                                                </select>
                                            </div>
									 </div>
									 <div class="col-lg-6"> 
                                        <div class="form-group">
                                            <label>Complainant Last Name</label>
                                            <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Enter last name">
                                        </div>
										<div class="form-group">
                                            <label>Complainant Email</label>
                                            <input type="text" name="uemail" id="uemail" class="form-control">
                                            </div>
										  <div class="form-group">
                                            <label>Complaint Department</label>
                                           <select  name="uadep" class="form-control" id="uadep" onchange="display_comp_agent_group(this.value,'complainant_againt_group');">
                                                <option value="0" selected disabled>Select</option>
                                                <?php foreach($r as $value)
				{
				?>
                                                <option value="<?php echo $value['dep_id'];?>"><?php echo $value['dep_name'];?></option>
                                <?php } ?>
                                            </select>
                                        </div>
										
										
										</div>
										<div class="clearfix"></div>
										 <div class="form-group">
                                            <label>Complaint Description</label>
                                            <textarea name="cmp_desc" id="cmp_dis" class="form-control" rows="3"></textarea>
                                        </div>
                                       
                                        <button type="submit" name="complaint_register"  id="submit_btn_id" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>
									 
									 </div>
                                        
                                 
                                       
                                       
                                    </form>
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
  </div>
                          <div class="modal fade" id="track_complaint" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Track Complaint</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Enter Complaint ID
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                        <div class="form-group">
                                            
                                            <input type="text" class="form-control" name="user_track_complaint" id="user_track_complaint">
                                            
                                        </div>
                                                                             
                                        <button class="btn btn-primary" id="submit_complaint">Get Detail</button>
                                        
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
					
                     <!-- End Form Elements -->
                </div>
            </div>
			
			<div id="track_complaint_detail">
			
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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
            f_name: "required",
            l_name: "required",
            
            uphone: {
                required: true,
                minlength: 10,
				maxlength: 10
            },
			
            uemail: {
                required: true,
                email: true
            },
			complainant_company:"required",
			udep: "required",
			//ugrp: "required",
			uadep: "required",
			uagrp: "required"
			//uagrp: "required"
			
			
        },
        
        // Specify the validation error messages
        messages: {
            f_name: "Please enter first name",
                       
            l_name: "Please enter last name",
			
			uphone: "Please enter phone number",
			
            uemail: "Please valid email id",
			complainant_company: "Please complainant company",
			
			udep: "Please select complainant department",
			//ugrp: "Please select complainant group",
			uadep: "Please select complaint against department",
			uadep: "Please select complaint against department",
			uagrp: "Please select complaint against group"
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
