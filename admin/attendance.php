<?php
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';	
//require_once 'assets/scripts/validation.js';


  
    /*$rec_id = $_POST['view_comp_id'];
	$query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_name, fee, father_name, address, mobile_no, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	INNER JOIN ts_batch ON  ts_student.batch_id=ts_batch.id
	where ts_student.id = '".$rec_id."'
	";
   	
	$r_id = $db->fetchRow($query_user_list);
	*/
	
	if(count($_POST['ids'])>0)
    {
	$subject_name = $_POST['subject'];	
	if ($_POST['present']=='present')  
	{
	  for($i=0;$i<count($_POST['ids']);$i++) 
	  {
	$query="SELECT * FROM ts_student WHERE id='".$_POST['ids'][$i]."'"; 
    $r_id = $db->fetchRow($query);
	$registration_no     	= trim($r_id["registration_no"]);
	$student_name     		= trim($r_id["student_name"]);
	$class_id     		= trim($r_id["class_id"]);
	$batch_id     		= trim($r_id["batch_id"]);
	   $date = date('Y-m-d');
		$post_array = array(
       'registration_no' => $registration_no,
	   'student_name' => $student_name,
	   
	   'class_id' => $class_id,
	   'batch_id' => $batch_id,	
       'subject_name' => $subject_name,	   
	   'present' => 1,
       'date' =>  $date
	   );
    
    $query_atten="SELECT count(id) as attcount FROM ts_attendance WHERE registration_no='".$registration_no."' AND date = '".$date."' "; 
    $r_query_atten = $db->fetchRow($query_atten);	
	$atten_count = $r_query_atten['attcount'];
	if($atten_count == 0){
	$result = $db->insert_query('ts_attendance', $post_array, '');
	  }
	  }
	  $_SESSION['sess_mess']="Attendance mark successfully";

	}
	
	if ($_POST['notpresent']=='notpresent')  
	{
	$query_mail="SELECT * FROM ts_mailcontent WHERE mail_type='not present'"; 
	$r_mail = $db->fetchRow($query_mail);
	$mail_content =  trim($r_mail["mail_content"]); 
	
	  for($i=0;$i<count($_POST['ids']);$i++) 
	  {
	$query="SELECT * FROM ts_student WHERE id='".$_POST['ids'][$i]."'"; 
    $r_id = $db->fetchRow($query);
	$registration_no     	= trim($r_id["registration_no"]);
	$email     				= trim($r_id["email"]);
	$student_name     		= trim($r_id["student_name"]);
	$mobile_no     		= trim($r_id["mobile_no"]);
	$class_id     		= trim($r_id["class_id"]);
	$batch_id     		= trim($r_id["batch_id"]);
	
	$query="SELECT class FROM ts_class WHERE id='".$class_id."'"; 
    $r_class = $db->fetchRow($query);
	$class_name = $r_class['class'];
	$query="SELECT batch_name FROM ts_batch WHERE id='".$batch_id."'"; 
    $r_batch = $db->fetchRow($query);
	$batch_name = $r_batch['batch_name'];
	   $date = date('Y-m-d');
		$post_array = array(
       'registration_no' => $registration_no,
	   'student_name' => $student_name,
	   
	   'class_id' => $class_id,
	   'batch_id' => $batch_id,	
       'subject_name' => $subject_name,	   
	   'present' => 0,
       'date' =>  $date
	   );
	$query_atten="SELECT count(id) as attcount FROM ts_attendance WHERE registration_no='".$registration_no."' AND date = '".$date."' "; 
    $r_query_atten = $db->fetchRow($query_atten);	
	$atten_count = $r_query_atten['attcount'];
	if($atten_count == 0){
	$result = $db->insert_query('ts_attendance', $post_array, '');
	}
	// Authorisation details.
	
     
	$username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $mobile_no; // A single number or a comma-seperated
	  $numbers = $mobile_no; // A single number or a comma-seperated

     $message = $mail_content;
	 $message = str_replace("<student name>",$student_name,$message);
	 $message = str_replace("<registration no>",$registration_no,$message);
	 $message = str_replace("<class name>",$class_name,$message);
	 $message_email = str_replace("<subject name>",$subject_name,$message);
	 

	 //$message = "Not present in the class, student name:".$student_name.",registration no:".$registration_no.",class name:".$class_name.",subject:".$subject_name."";
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message_email);
     $data =
"username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
	 
	 $mail = new PHPMailer;
	$mail->isSMTP();
	//$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = 'mail.telco-soft.in';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "support@telco-soft.in";
	$mail->Password = "nimish@123";
	$mail->setFrom('support@telco-soft.in');
	$mail->addReplyTo('support@telco-soft.in');
	$mail->addAddress($email);
	$mail->Subject = 'Student Registration';
	$mail->Body = $message_email;
	//$mail->AltBody = 'This is a plain-text message body';
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	
	} 
	
	  }
	  $_SESSION['sess_mess']="Attendance mark successfully";

	}
	
	if ($_POST['off_by_teacher']=='off_by_teacher')  
	{
	$query_mail="SELECT * FROM ts_mailcontent WHERE mail_type='off by teacher'"; 
	$r_mail = $db->fetchRow($query_mail);
	$mail_content =  trim($r_mail["mail_content"]); 
	  for($i=0;$i<count($_POST['ids']);$i++) 
	  {
	$query="SELECT * FROM ts_student WHERE id='".$_POST['ids'][$i]."'"; 
    $r_id = $db->fetchRow($query);
	$registration_no     	= trim($r_id["registration_no"]);
	$student_name     		= trim($r_id["student_name"]);
	$mobile_no     		= trim($r_id["mobile_no"]);
	$class_id     		= trim($r_id["class_id"]);
	$batch_id     		= trim($r_id["batch_id"]);
	
	$query="SELECT class FROM ts_class WHERE id='".$class_id."'"; 
    $r_class = $db->fetchRow($query);
	$class_name = $r_class['class'];
	$query="SELECT batch_name FROM ts_batch WHERE id='".$batch_id."'"; 
    $r_batch = $db->fetchRow($query);
	$batch_name = $r_batch['batch_name'];
	   $date = date('Y-m-d');
		$post_array = array(
       'registration_no' => $registration_no,
	   'student_name' => $student_name,
	   
	   'class_id' => $class_id,
	   'batch_id' => $batch_id,	
       'subject_name' => $subject_name,	   
	   'present' => 2,
       'date' =>  $date
	   );
    $query_atten="SELECT count(id) as attcount FROM ts_attendance WHERE registration_no='".$registration_no."' AND date = '".$date."' "; 
    $r_query_atten = $db->fetchRow($query_atten);	
	$atten_count = $r_query_atten['attcount'];
	if($atten_count == 0){
	$result = $db->insert_query('ts_attendance', $post_array, '');
	}
	// Authorisation details.
	
     
	$username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $mobile_no; // A single number or a comma-seperated
	  $numbers = $mobile_no; // A single number or a comma-seperated

     $message = $mail_content;
	
	 $message = str_replace("<class name>",$class_name,$message);
	 $message_email = str_replace("<subject name>",$subject_name,$message);
	 
	 //$message = "Off By teacher, class name:".$class_name.",subject:".$subject_name."";
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message_email);
     $data =
"username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
	 
	 
	 $mail = new PHPMailer;
	$mail->isSMTP();
	//$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = 'mail.telco-soft.in';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "support@telco-soft.in";
	$mail->Password = "nimish@123";
	$mail->setFrom('support@telco-soft.in');
	$mail->addReplyTo('support@telco-soft.in');
	$mail->addAddress($email);
	$mail->Subject = 'Student Registration';
	$mail->Body = $message_email;
	//$mail->AltBody = 'This is a plain-text message body';
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	
	} 
	
	  }
	  $_SESSION['sess_mess']="Attendance mark successfully";

	}
	
	if ($_POST['fee_not_paid']=='fee_not_paid')  
	{
	$query_mail="SELECT * FROM ts_mailcontent WHERE mail_type='fee not paid'"; 
	$r_mail = $db->fetchRow($query_mail);
	$mail_content =  trim($r_mail["mail_content"]); 
	  for($i=0;$i<count($_POST['ids']);$i++) 
	  {
	$query="SELECT * FROM ts_student WHERE id='".$_POST['ids'][$i]."'"; 
    $r_id = $db->fetchRow($query);
	$registration_no     	= trim($r_id["registration_no"]);
	$student_name     		= trim($r_id["student_name"]);
	$mobile_no     		= trim($r_id["mobile_no"]);
	$class_id     		= trim($r_id["class_id"]);
	$batch_id     		= trim($r_id["batch_id"]);
	
	$query="SELECT class FROM ts_class WHERE id='".$class_id."'"; 
    $r_class = $db->fetchRow($query);
	$class_name = $r_class['class'];
	
	$reg_date = $r_id['reg_date'];
	$current_date = date('Y-m-d');
	$diff = abs(strtotime($current_date) - strtotime($reg_date));

	$month = floor($diff / (30*60*60*24));
	$fee_month = $month+1;
	
	$query_fee="SELECT sum(fee) as total_fee FROM ts_batch WHERE class_id='".$class_id."' AND id in(".$batch_id.")"; 
	$r_fee = $db->fetchRow($query_fee);
	$total_fee =  ($r_fee["total_fee"]* $fee_month); 
	
	$query_pfee="SELECT sum(paid_fee) as total_paid_fee FROM ts_fee GROUP By registration_no having registration_no='".$registration_no."'"; 
	$r_pfee = $db->fetchRow($query_pfee);
	$total_paid_fee =  trim($r_pfee["total_paid_fee"]); 
	$remaining_fee = $total_fee - $total_paid_fee;
	
	// Authorisation details.
	
     
	$username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $mobile_no; // A single number or a comma-seperated
	  $numbers = $mobile_no; // A single number or a comma-seperated
     $message = $mail_content;
	 $message = str_replace("<remaining fee>",$remaining_fee,$message);
	 $message = str_replace("<class name>",$class_name,$message);
	 $message = str_replace("<student name>",$student_name,$message);
	 $message_email = str_replace("<registration no>",$registration_no,$message);
     
	 //$message = "Your remaining fee ".$remaining_fee.", class name:".$class_name.", student name:".$student_name.", Registration No:".$registration_no."";
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message_email);
     $data =
"username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
	 
	  $mail = new PHPMailer;
	$mail->isSMTP();
	//$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = 'mail.telco-soft.in';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "support@telco-soft.in";
	$mail->Password = "nimish@123";
	$mail->setFrom('support@telco-soft.in');
	$mail->addReplyTo('support@telco-soft.in');
	$mail->addAddress($email);
	$mail->Subject = 'Student Registration';
	$mail->Body = $message_email;
	//$mail->AltBody = 'This is a plain-text message body';
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	
	} 
	
	  }
	  $_SESSION['sess_mess']="Remaining fee sent";

	}
	
	if ($_POST['send_message']=='send_message')  
	{
	  for($i=0;$i<count($_POST['ids']);$i++) 
	  {
	$query="SELECT * FROM ts_student WHERE id='".$_POST['ids'][$i]."'"; 
    $r_id = $db->fetchRow($query);
	$registration_no     	= trim($r_id["registration_no"]);
	$student_name     		= trim($r_id["student_name"]);
	$mobile_no     		= trim($r_id["mobile_no"]);
	$class_id     		= trim($r_id["class_id"]);
	$batch_id     		= trim($r_id["batch_id"]);
	
	$query="SELECT class FROM ts_class WHERE id='".$class_id."'"; 
    $r_class = $db->fetchRow($query);
	$class_name = $r_class['class'];
	
	$urg_message = $_POST['urg_message'];
	
	// Authorisation details.
	
     
	$username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $mobile_no; // A single number or a comma-seperated
	  $numbers = $mobile_no; // A single number or a comma-seperated

     
	 $message_email = $urg_message;
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message_email);
     $data =
"username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
	 
	  $mail = new PHPMailer;
	$mail->isSMTP();
	//$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = 'mail.telco-soft.in';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "support@telco-soft.in";
	$mail->Password = "nimish@123";
	$mail->setFrom('support@telco-soft.in');
	$mail->addReplyTo('support@telco-soft.in');
	$mail->addAddress($email);
	$mail->Subject = 'Student Registration';
	$mail->Body = $message_email;
	//$mail->AltBody = 'This is a plain-text message body';
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	
	} 
	
	  }
	  $_SESSION['sess_mess']="Message sent";

	}
	
	
	
}	
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.location.href='student-list.php';
    </SCRIPT>");
?>
   