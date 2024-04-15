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

<style type="text/css">

.sugessionbox
{
list-style: none;
margin: 17px 20px 20px 24px;
width: 400px;

display: block;
padding: 5px;
background-color: #ccc;
border-bottom: 1px solid #367;
}

</style>
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
							   <td><input type="text" name="con_name"  id="con_name" class="form-control" placeholder="name"><br>
							   <input type="text" name="address"  id="address" class="form-control" placeholder="Address">
							  
							   </td>
							    </tr>
								<tr>
							   
							   <td colspan="5" align="right">
							   <div id="displaycon"></div>
							   </td>
							   </tr>
							   <tr>
							   
							   <td colspan="5" align="right">
							   <div id="display"></div>
							   </td>
							   </tr>
							  
							  
							   
							   
							   <tr>
							   <td class="center" colspan="8"><a href="#" class="btn btn-success" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_account();">Get Acct Detail</a> &nbsp;<a href="#" class="btn btn-success" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_substation();">33/11 KV SUB-STATION</a></td>
							     </tr>
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
  <script src="assets/plugins/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  
  <script>
    

 
  
 function view_account(){
          
         // alert(id);
        //  return false;
var record_id = $("#acct_id").val();
var mobileno = $("#mobileno").val();
var address = $("#address").val();
var con_name = $("#con_name").val();

		
jQuery.ajax({
type: "POST",
url: "account-ajax-val.php",
data:'view_comp_id='+record_id+'&mobileno='+mobileno+'&con_name='+con_name+'&address='+address,

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
	function fill(Value)
{
	
$('#address').val(Value);
$('#display').hide();
}

$(document).ready(function(){
$("#address").keyup(function() {
var address = $('#address').val();
var con_name = $('#con_name').val();
//alert(address);
if(address=="")
{
$("#display").html("");
}
else
{
$.ajax({
type: "POST",
url: "comp_suggestion_ajax.php",

data: 'address='+ address+'&con_name='+con_name,
success: function(html){
$("#display").html(html).show();
}
});
}
});
});


	function fillcon(Value)
{
	
$('#con_name').val(Value);
$('#displaycon').hide();
}

$(document).ready(function(){
$("#con_name").keyup(function() {
var con_name = $('#con_name').val();
//alert(con_name);
if(address=="")
{
$("#displaycon").html("");
}
else
{
$.ajax({
type: "POST",
url: "comp_suggestioncon_ajax.php",
data: "con_name="+ con_name ,
success: function(html){
$("#displaycon").html(html).show();
}
});
}
});
});


        </script>
        
   <?php include_once('footer.php'); ?>
