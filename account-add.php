<?php    
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	} 
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
   
	
	if(isset($_POST['submit']))
		
    {
			
	$account_id    =  trim(addslashes($_POST["account_id"]));
	$scno    =  trim(addslashes($_POST["scno"]));
	$ahname    =  trim(addslashes($_POST["ahname"]));
	$address    =  trim(addslashes($_POST["address"]));
	$div_code    =  trim(addslashes($_POST["div_code"]));
	$book_no    =  trim(addslashes($_POST["book_no"]));
	$mobile_no    =  trim(addslashes($_POST["mobile_no"]));
	$last_pay_amt    =  trim(addslashes($_POST["last_pay_amt"]));
	$last_pay_date    =  trim(addslashes($_POST["last_pay_date"]));
	
	$post_array = array(
       'acct_id' => trim(addslashes($_POST["account_id"])),
	   'scno' => trim(addslashes($_POST["scno"])),
	   'name' => trim(addslashes($_POST["ahname"])),
	   'address' => trim(addslashes($_POST["address"])),
	   'div_code' => trim(addslashes($_POST["div_code"])),
	   'book_no' => trim(addslashes($_POST["book_no"])),
	   'mobile_no' => trim(addslashes($_POST["mobile_no"])),
	   'last_pay_amt' => trim(addslashes($_POST["last_pay_amt"])),
	   'last_pay_date' => trim(addslashes($_POST["last_pay_date"])),
	   'status' => 'new'
	   
	   );
  
	$result = $db->insert_query('ts_new_account', $post_array, '');
	$_SESSION['sess_mess']="Record saved successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='raise_complaint.php';
    </SCRIPT>");
	
	
    }
	
	if(isset($_POST['uploadxls']))
    {
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$file = $_FILES['file']['tmp_name'];
$inputFileName = $file; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=2;$i<=$arrayCount;$i++){

$acct_id    =  trim($allDataInSheet[$i]["A"]);
$scno    =  trim($allDataInSheet[$i]["B"]);
$ahname    =  trim($allDataInSheet[$i]["C"]);
$address    =  trim($allDataInSheet[$i]["D"]);
$div_code    =  trim($allDataInSheet[$i]["E"]);
$book_no    =  trim($allDataInSheet[$i]["F"]);
$mobile_no    =  trim($allDataInSheet[$i]["G"]);
$last_pay_amt    =  trim($allDataInSheet[$i]["H"]);
$last_pay_date    =  trim($allDataInSheet[$i]["I"]);


//$insertTable= mysql_query("insert into xltest (name, email) values('".$userName."', '".$userMobile."');");

$post_array = array(
       'acct_id' => $acct_id,
	   'scno' => $scno,
	   'name' => $ahname,
	   'address' => $address,
	   'div_code' => $div_code,
	   'book_no' => $book_no,
	   'mobile_no' => $mobile_no,
	   'last_pay_amt' => $last_pay_amt,
	   'last_pay_date' => $last_pay_date
	   
	   
	   );
	   $post_array_update = array(
       
	   'scno' => $scno,
	   'name' => $ahname,
	   'address' => $address,
	   'div_code' => $div_code,
	   'book_no' => $book_no,
	   'mobile_no' => $mobile_no,
	   'last_pay_amt' => $last_pay_amt,
	   'last_pay_date' => $last_pay_date
	   
	   
	   );
	$query="SELECT count(id) as acct_count FROM ts_account WHERE acct_id='".$acct_id."'"; 
    $acc_count_qur = $db->fetchRow($query);
	$acct_count     = trim($acc_count_qur["acct_count"]);
	
    if($acct_count > 0){
		
	$where = array('acct_id'=>$acct_id);
	$result = $db->update_query('ts_account', $post_array_update, $where, $exc);
	}else{
	$result = $db->insert_query('ts_account', $post_array, '');
	}
	
    
} 

$_SESSION['sess_mess']="Record uploaded successfully";

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='raise_complaint.php';
    </SCRIPT>");
 
	
	}
	

?>
        <!--  page-wrapper -->
<link rel="stylesheet" type="text/css" media="all" href="admin/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="admin/jsDatePick.min.1.3.js"></script>
    <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"last_pay_date",
			dateFormat:"%Y-%m-%d"
			
		});
		
	};
</script>        
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if($_GET['group_id']=='')
    { echo "Add Group";}else{echo "Edit Group"; }?></h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<form name="import" method="post" enctype="multipart/form-data">
						<input type="file" name="file" /><br />
						<input type="submit" name="uploadxls" value="Submit" />
						</form>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" id="department-form" action="" method="post">
                                     <div class="col-lg-12">
									 <div class="col-lg-6">
									 <div class="form-group">
									
                                            <label>Account Id </label>
											
											<input type="text" name="account_id" id="account_id" value="<?php echo $account_id; ?>" class="form-control"  placeholder="Account Id">
                                           
											</div>
											 <div class="form-group">
									
                                            <label>Name</label>
											
											<input type="text" name="ahname" id="ahname" value="<?php echo $ahname; ?>" class="form-control" placeholder="Name" >
                                           
											</div>
											<div class="form-group">
									
                                            <label>Div Code</label>
											
											<input type="text" name="div_code" id="div_code" value="<?php echo $div_code; ?>" class="form-control" placeholder="Div Code">
                                           
											</div>
											<div class="form-group">
									
                                            <label>Mobile No</label>
											
											<input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>" class="form-control" placeholder="Mobile No">
                                           
											</div>
											<div class="form-group">
									
                                            <label>Last Pay Date</label>
											
											<input type="text" name="last_pay_date" id="last_pay_date" value="<?php echo $last_pay_date; ?>" class="form-control" placeholder="Last Pay Date">
                                           
											</div>
											
										
									 </div>
									 
									 <div class="col-lg-6">
									 <div class="form-group">
									
                                            <label>SCNO </label>
                                            <input type="text" name="scno" id="scno" value="<?php echo $scno; ?>" class="form-control" placeholder="SCNO" >
											</div>
											 <div class="form-group">
									
                                            <label>Address</label>
											
											<input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control" placeholder="Address">
                                           
											</div>
											<div class="form-group">
									
                                            <label>Book No</label>
											
											<input type="text" name="book_no" id="book_no" value="<?php echo $book_no; ?>" class="form-control" placeholder="Book No" >
                                           
											</div>
											<div class="form-group">
									
                                            <label>Last Pay Amt</label>
											
											<input type="text" name="last_pay_amt" id="last_pay_amt" value="<?php echo $last_pay_amt; ?>" class="form-control" placeholder="Last Pay Amt">
                                           
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
  <script src="assets/plugins/jquery.validate.min.js"></script>
  
  
  <!-- jQuery Form Validation code -->
  
  <script>
    jQuery(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
    
        
        // Specify the validation rules
        rules: {
           
			ahname: "required",
			address: "required",
			
			mobile_no: "required"
			
			
         },
        
        // Specify the validation error messages
        messages: {
           
			ahname: "Please enter name",
			address: "Please enter address",
			
			mobile_no: "Please enter mobile no"
			
			
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
