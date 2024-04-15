<?php 
date_default_timezone_set('Asia/Kolkata');
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php'; 
if(isset($_SESSION['user_name'])){
    header("location: agent-view.php"); 
} 


$query="SELECT * FROM ts_home_setting WHERE id=1"; 
$r_id = $db->fetchRow($query);
//$project_name     = trim($r_id["project_name"]);
$project_title     = trim($r_id["project_title"]);
$image     = trim($r_id["image"]);
?>

<!doctype html>
<html>
  <head>
 
    <meta charset="utf-8">
    <link rel="icon" href="/favicon.ico?v=1">

    <title><?php echo $project_title; ?></title>
    <meta name="description" CONTENT="Find diagnostic labs in Delhi NCR for the blood tests, preventive health checkup. Book home sample collection facility, ask an expert and get useful health tips.">

     <link rel="stylesheet" href="css/bootstrap.min.css">
	 <link rel="stylesheet" href="css/styletws.css"> 

<link href="assets/css/style.css" rel="stylesheet" />

</head>
<body>
 <?php 
				$query="SELECT * FROM ts_home_setting WHERE id=1"; 
				$r_id = $db->fetchRow($query);
				//$project_name     = trim($r_id["project_name"]);
				$image     = trim($r_id["image"]);
				?>
       
   
  <div class="main-head_border">
    <div class="container-fluid">
     <div class="col-md-12 col-xs-12 mange_minhei">
	   <div class="col-md-6 col-xs-12 right_border">
	    <div class="logo_student"><a href="index.php"><img src="upload/<?php echo $image; ?>" /></a></div> 
	   <div class="student"><img src="img/bannerimgstu.jpg" alt="" /></div>
	   
	   
	   
	   </div>
	 
	 	   <div class="col-md-6 col-xs-12">
		   <div class="center_divine">
		   <h3>Login</h3>
		 <?php if(isset($_SESSION['msg'])){?>
                    <span class="msg_ticket"> 
					<?php
                                               echo $_SESSION['msg'];
                                               unset($_SESSION['msg']);
                      ?>                         
                                          
                            </span>
				    <?php } ?>
		<form role="form" action="app/action/user-login.php" method="post">
		  <div class="phAnimate">
 
    <input type="text" class="form-control usr_radius" id="registration_no" name="registration_no" placeholder="Registration No">
  </div>

<div class="phAnimate">

    <input type="password" class="form-control usr_radius" id="dob" name="dob"   placeholder="DOB">
	(yyyy-mm-dd) format
  </div>
  <span class="pwd_msg"><?php if(isset($_REQUEST['msg'])){
                                    
                                    echo $_REQUEST['msg'];
                                  }  ?></span>

<input type="submit" name="users_login" class="btn_log_orng" value="Login" onclick="return user_login('registration_no','dob','pwd_msg');" />

		</form> 
		 
		 </div>
	 </div>
	 
	 </div>      


      
    </div>
	
	  
</div>
<script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
     <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script>
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
</html></div>

