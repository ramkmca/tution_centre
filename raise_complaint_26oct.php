<?php    
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	} 
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	$dept_id = $_REQUEST['dept_id'];
	if($_REQUEST['dept_id']=="" && isset($_POST['submit']))
    {
			
	$department_name    =  trim(addslashes($_POST["department_name"]));
	
	$post_array = array(
       'dep_name' => trim(addslashes($_POST["department_name"]))
	   );
  
	$result = $db->insert_query('ts_department', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='department-list.php';
    </SCRIPT>");

	
	
    }
	if($_REQUEST['dept_id']!="" && isset($_POST['submit']))
    {
			
	$department_name    =  trim(addslashes($_POST["department_name"]));
	
	$post_array = array(
       'dep_name' => $department_name
	   );
    $where = array('dep_id'=>$dept_id);
	//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
	$result = $db->update_query('ts_department', $post_array, $where, $exc);
	
	$_SESSION['sess_mess']="Record updated successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='department-list.php';
    </SCRIPT>");

	
    }
	if($_GET['dept_id']!='')
    {
    $query="SELECT * FROM ts_department WHERE dep_id='".$dept_id."'"; 
    $r_id = $db->fetchRow($query);
	$department_name     = trim($r_id["dep_name"]);

	}

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Raise Complaint</h1>
                </div>
				<div class="col-lg-12" style="text-align:center;">
				<?php
				$query="SELECT  scheduled_downtime_msg,scheduled_downtime_add FROM ts_home_setting where id=1"; 
				$r_homesetting = $db->fetchRow($query);
				echo "<b> Msg : </b>". $r_homesetting['scheduled_downtime_msg'];
				echo "<br><br>";
				echo "<b>Address : </b>".$r_homesetting['scheduled_downtime_add'];
				?>
				<br><br>
				</div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading">
                              <div class="panel-heading" style="text-align:right;">
                            <a href="account-add.php" class="btn btn-primary btn-xs">Add New Account</a>
                             </div>
							 <?php if(isset($_SESSION['msg'])){?>
							  <div style="text-align:center;">
                    <span class="msg_ticket"> 
					<?php
                                               echo $_SESSION['msg'];
                                               unset($_SESSION['msg']);
                      ?>                         
                                          
                            </span>
							</div>
				    <?php } ?>
					
							 <?php if(isset($_SESSION['sess_mess'])){ ?>
						 <div style="text-align:center;">
                           
                        
                             
<span class="msg"> <?php if(isset($_SESSION['sess_mess'])){
                                               echo $_SESSION['sess_mess'];
                                               
                                               
                                           } ?>
                            </span>
                        </div>
						<?php } ?>
							   <table class="table table-bordered table-hover">
							   <tr><td><input type="text" name="acct_id" value="<?php echo $acct_id; ?>" id="acct_id" placeholder="ACCT ID"></td><td><b>OR</b></td>
							   <td><input type="text" name="mobileno" value="<?php echo $mobileno;?>" id="mobileno" placeholder="Mobile No"></td><td><b>OR</b></td>
							   <td><input type="text" name="address" value="<?php echo $address;?>" id="address" class="form-control" placeholder="Address"></td>
							   </tr>
							   <tr>
							   <td class="center" colspan="8"><a href="#" class="btn btn-success" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_account();">Get Acct Detail</a> &nbsp;<a href="#" class="btn btn-success" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_substation();">33/11 KV SUB-STATION</a></td>
							      <tr>
							   </table>
							 
                        </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
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
  
  <script src="assets/plugins/jquery-1.10.2.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  
  <script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        
        // Specify the validation rules
        rules: {
            new_mobile_no: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            new_mobile_no: "Please enter department name"
			
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

 
  function display_jedetail(je_id)
  {
	  var je_id = je_id;
	  
	  //alert(je_id);
	  //alert(sdo_id);
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
 function view_account(){
          
         // alert(id);
        //  return false;
var record_id = $("#acct_id").val();
var mobileno = $("#mobileno").val();
		
jQuery.ajax({
type: "POST",
url: "account-ajax-val.php",
data:'view_comp_id='+record_id+'&mobileno='+mobileno,

success: function(data){

$("#view_cmp").html(data);
}
});   
  
    }
	function view_substation(){
          
         // alert(id);
        //  return false;
var record_id = 'substation';
		
jQuery.ajax({
type: "POST",
url: "account-ajax-val.php",
data:'view_comp_id='+record_id,

success: function(data){

$("#view_cmp").html(data);
}
});   
  
    }
        </script>
        
   <?php include_once('footer.php'); ?>
