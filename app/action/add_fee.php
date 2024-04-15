<?php
date_default_timezone_set('Asia/Kolkata');

require_once '../classes/config.php';
require_once '../classes/dbclass.php';

if(isset($_POST['complaint_register'])){
$student_id 			= $_POST['student_id'];
$registration_no 		= $_POST['registration_no'];
$mobile_no 				= $_POST['mobile_no'];

$current_deposit_fee 	= $_POST['current_deposit_fee'];
$fee_date 				= $_POST['fee_date'];


  $post_array = array(
      'student_id' => $student_id,
	  'registration_no' => $registration_no,
	  'paid_fee' => $current_deposit_fee,
	  'date' => $fee_date	   
	  
  );
  
  $username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $mobile_no; // A single number or a comma-seperated
	  $numbers = $mobile_no; // A single number or a comma-seperated

     
	 $message = "Your Registration no: ".$registration_no.", Date: ".$fee_date .", Paid Fee: ".$current_deposit_fee;
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message);
     $data =
"username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
  $result = $db->insert_query('ts_fee', $post_array, '');

 
  $message = "Fee added Sucessfully";	
  $_SESSION['sess_mess'] = $message;
  header("location:../../admin/student-list.php"); 
 
  }
  

