<?php
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
$query="SELECT * FROM ts_home_setting WHERE id=1"; 
    $r_id = $db->fetchRow($query);
	$project_name     = trim($r_id["project_name"]);
	$project_title     = trim($r_id["project_title"]);
	$image     = trim($r_id["image"]);

//echo '--'.$_SESSION['adminuser_name']; die;
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project_title; ?></title>
    <!-- Core CSS - Include with every page -->
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="../assets/css/style.css" rel="stylesheet" />
      <link href="../assets/css/main-style.css" rel="stylesheet" />

</head>
<style>
.center {
    text-align: center;
    
	position: absolute;
	left: 40%;
    margin-left: -50px;
   
 
  
}
.login-body {
    
    background-image: url('../login_img.jpg');
 
  
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
					<div >
                        <h3 class="panel-title"><a  href="index.php">
                    <img  src="../upload/<?php echo $image; ?>" height="120px">
					
                </a>	</h3>
                    </div>	
              <div class="clearfix"></div>	             
                    <div class="panel-heading">
                        <h3 class="panel-title-login">Admin Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="../app/action/admin-login.php" method="post">
                            <fieldset>
                                <div class="form-group">
								
                                    <input id="usrname" name="usrname" class="form-control-login"  type="text">
                                </div>
                                <div class="form-group">
								
                                    <input id="pswd" name="pswd" class="form-control-login" type="password" >
                                </div>
                                <!--<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="1">Remember Me
                                    </label>
                                </div>-->
								
                                <span class="pwd_msg"><?php if(isset($_REQUEST['msg'])){
                                    
                                    echo $_REQUEST['msg'];
                                  }  ?></span>
                                
                                <!-- Change this to a button or input when using this as a form -->
                               <input name="admin_login" type="submit" class="btn btn-lg btn-success btn-block" value="Login" onclick="return user_login('usrname','pswd','pwd_msg');"/>
                            <div style="width:360px; text-align:left; margin:20px 0px;">
						
						<a href="#"  data-toggle="modal" data-target="#user_forget_password" >Forget Login or Password</a>
						
						</div>
							
							</fieldset>
                        </form>
						
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

     <!-- Core Scripts - Include with every page -->
    <script src="../assets/plugins/jquery-1.10.2.js"></script>
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
	 $("#user_forget_email").click(function(){
	   
    var forgetemail = $('#forget_email').val();
	if(forgetemail=="")
	{
	 alert('Plese Enter Your Email ID');
	}
	var urlAdd = 'forget_password.php';
    var urlData;
    
    urlData = "forgetemail="+forgetemail;
     //alert(urlData);
    $.ajax({
        type: "GET", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
			$('#forget_password_response').html(data.responseText);
            
        }
    });
	
  });
  </script>
  <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
     <script src="../assets/scripts/validation.js"></script>
</body>

</html>
