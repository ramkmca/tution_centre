<?php
date_default_timezone_set('Asia/Kolkata');

require_once '../classes/config.php';
require_once '../classes/dbclass.php';
require '../../PHPMailerAutoload.php';
require '../../class.phpmailer.php';
if(isset($_POST['change_pwd'])){
    
    
    
    $old_pwd = $_POST['old_pwd'];
    $conf_new_pwd = $_POST['conf_new_pwd'];
   $where = array('id'=>'1');
       $change_pass = array(
	  'pswd' => $_POST['conf_new_pwd']);
      // print_r($change_pass); 
       //die;
       $result = $db->update_query('ts_admin_login', $change_pass, $where, $exc); 
	  $msg = 'Password Succefullly Changed.';
           $_SESSION['msg'] = $msg;
          header("location:../../admin/edit-profile.php"); 
       
  
 
       
  
}

if(isset($_POST['complaint_register'])){
$ticket_no 				= $_POST['ticket_no'];
$acct_id 				= $_POST['acct_id'];
$div_code 				= $_POST['div_code'];
$user_id 				= $_POST['user_id'];
$complaint_name 		= $_POST['complaint_name'];
$complaint_type 		= $_POST['complaint_type'];
$new_mobile_no 			= $_POST['new_mobile_no'];
$respective_area 		= $_POST['respective_area'];
/***************************************************************************/
$query="SELECT id FROM ts_je WHERE je_area='".$respective_area."'"; 
$r_je = $db->fetchRow($query);
$respective_area 		= $r_je['id'];

/***************************************************************************/

if($_POST['acct_id']!='')
{
	$acct_mat_id= $_POST['acct_id'];
}else{
	$acct_mat_id= '33/11 KV SUB-STATION';
}
$query="SELECT count(id) as ticket_count FROM ts_tickets"; 
$r_ticketcount = $db->fetchRow($query);
$ticketcount     = trim($r_ticketcount['ticket_count'])+100000;
$ticket_no = $ticket_no.$ticketcount;
$query="SELECT * FROM ts_complaint_type WHERE id='".$complaint_name."'"; 
$r_complaint = $db->fetchRow($query);
$je_complaint_type 	= $r_complaint['complaint_type'];

$cmp_desc 		= $_POST['cmp_desc'];
$date 			= date("Y-m-d H:i:s");

$query="SELECT * FROM ts_je WHERE id='".$respective_area."'"; 
$r_je = $db->fetchRow($query);
$je_mobile 	    = $r_je['je_mobile'];
$je_area 	    = $r_je['je_area'];
$sdo_name_id 	= $r_je['sdo_name'];
$div_code_id 	= $r_je['div_code'];
$query="SELECT * FROM ts_sdo WHERE id='".$sdo_name_id."'"; 
$r_sdo = $db->fetchRow($query);
$sdo_mobile 	= $r_sdo['sdo_mobile'];
$sdo_email 	    = $r_sdo['sdo_email'];
$query="SELECT * FROM ts_zone WHERE id='".$div_code_id."'"; 
$r_zone = $db->fetchRow($query);
$ee_phone_no 	= $r_zone['phone_no'];
$ee_email 	    = $r_zone['email'];

  $post_array = array(
      'user_id' => $_POST['user_id'],
	  'cmp_no' => $ticket_no,
	  'acct_id' => $acct_mat_id,
	  'div_id' => $div_code,
	  
	  'complaint' => $_POST['complaint_name'],
	  'complaint_type' => $_POST['complaint_type'],
	  'mobileno' => $_POST['new_mobile_no'],
	  'respective_area' => $respective_area,
	  'cmp_desc' => $_POST['cmp_desc'],
	  'cmp_status' => 'Open',
      'cmp_date' => $date	   
	  
  );
  $result = $db->insert_query('ts_tickets', $post_array, '');

 // Authorisation details.
	
     $username = "contact@telco-soft.in";
     $hash = "76ff06d6ce41144744122f4bb2541f18d9dc5944";

     // Config variables. Consult http://api.textlocal.in/docs for more

     $test = "0";

     // Data for text message. This is the text message data.
     $sender = "TXTLCL"; // This is who the message appears to be from.
     //$numbers = $je_mobile; // A single number or a comma-seperated
     //$numbers = 9871998166;
     
	 $message = "Your Complain Detail, Mobile No: ".$new_mobile_no." Acc ID: ".$acct_id." Complaint Number: ".$ticket_no." Complaint Type: ".$je_complaint_type." Address: ".$je_area;
     // 612 chars or less
     // A single number or a comma-seperated list of numbers
     $message = urlencode($message);
     $data ="username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
     $ch = curl_init('http://api.textlocal.in/send/?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
     curl_close($ch);
	// Authorisation details. 
	
    
	
		
    $mail = new PHPMailer(); 
	$mail->isSMTP();  
	//$mail->SMTPSecure = 'tls';                                    // Set mailer to use SMTP
	$mail->Host = 'mail.caretelindia.com';                       // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'pvnl@caretelindia.com';                   // SMTP username
	$mail->Password = '$#pv44PV44';              // SMTP password
					   // Enable encryption, 'ssl' also accepted
	$mail->Port = 25 ;                                   //Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('pvnl@caretelindia.com');    //Set who the message is to be sent from
	//Set an alternative reply-to address
	$mail->addReplyTo('pvnl@caretelindia.com');
	$mail->addAddress($sdo_email);
    //$mail->addAddress('ram.kumar@caretelindia.com');
	$mail->WordWrap = 150;                                 // Set word wrap to 50 characters
	//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
	//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'PVVNL New Complaint';
	
    $mail->Body    = "<table>
		<tr>
		<td><b>Complaint Number (Complaint ID )</b><br></td><td>:</td><td>&nbsp;<b>$ticket_no</b></td>
		</tr>
	    
		<tr>
		<td>Complaint</td><td>:</td><td>&nbsp;$je_complaint_type</td>
		</tr>
		
		<tr>
		<td>Complaint Type </td><td>:</td><td>&nbsp;$complaint_type</td>
		</tr>
		
		<tr>
		<td>Mobile No</td><td>:</td><td>&nbsp;$new_mobile_no</td>
		</tr>
		
		<tr>
		<td>Respective Area</td><td>:</td><td>&nbsp;$je_area</td>
		</tr>
		
		<tr>
		<td>Disposition</td><td>:</td><td>&nbsp;$cmp_desc</td>
		</tr>
		
		
		
		</table>		
		";
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
	//echo "wwwwwwwwww11"; exit;	
  if (!$mail->send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
}  
	 

  $message = "Thank You! Your Ticket successfully raised";	
  $_SESSION['msg'] = $message;
  header("location:../../agent-view.php"); 
 
         
 
  
  }
  

