<?php
date_default_timezone_set('Asia/Kolkata');

require_once '../classes/config.php';
require_once '../classes/dbclass.php';

if(isset($_POST['complaint_register'])){
$student_id 			= $_POST['student_id'];
$registration_no 		= $_POST['registration_no'];
$subject      			= $_POST['subject'];
$total_marks 			= $_POST['total_marks'];
$obtained_marks 		= $_POST['obtained_marks'];
$fee_date 				= $_POST['test_date'];


  $post_array = array(
      'student_id' => $student_id,
	  'registration_no' => $registration_no,
	  'subject' => $subject,
	  'total_marks' => $total_marks,
	  'obtained_marks' => $obtained_marks,
	  'date' => $fee_date	   
	  
  );
  $result = $db->insert_query('ts_marks', $post_array, '');

 
  $message = "Marks added Sucessfully";	
  $_SESSION['sess_mess'] = $message;
  header("location:../../admin/student-list.php"); 
 
  }
  

