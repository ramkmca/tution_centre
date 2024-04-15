<?php
//error_reporting(0);
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';
// require_once('class.phpmailer.php');
 
$mail = new PHPMailer(); 
$mail->isSMTP();  
$mail->SMTPSecure = 'tls';                                    // Set mailer to use SMTP
$mail->Host = 'mail.telco-soft.in';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'anil@telco-soft.in';                   // SMTP username
$mail->Password = 'nimish@123';              // SMTP password
                           // Enable encryption, 'ssl' also accepted
$mail->Port = 21 ;                                   //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('anil@telco-soft.in', 'Anit');     //Set who the message is to be sent from
//$mail->addReplyTo('mukeshksinghh@gmail.com', 'mukesh');  //Set an alternative reply-to address
$mail->addAddress('vibhavkumar2013@gmail.com', 'kumar');  // Add a recipient
$mail->addAddress('mukeshksinghh@gmail.com', 'kumar');  // Add a recipient

$mail->WordWrap = 150;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
 
$mail->Subject = 'Formate html design';
$mail->Body    = '<table><tr><td colspan="3">Dear,</td></tr><tr>
		<td><b>Your Complaint Number (Complaint ID )</b><br></td><td>:</td><td>&nbsp;<b>$ticket_no</b></td>
		</tr>
	    <tr>
		<td colspan="2">Your Detail</td>
		</tr>
		<tr>
		<td>Complainant First Name</td><td>:</td><td>&nbsp;f_name</td>
		</tr>
		<tr>
		<td>Complainant Last Name</td><td>:</td><td>&nbsp;l_name</td>
		</tr>
		<tr>
		<td>Complainant Phone No</td><td>:</td><td>&nbsp;uphone</td>
		</tr>
		<tr>
		<td>Complainant Email</td><td>:</td><td>&nbsp;uemail</td>
		</tr>
		
		<tr>
		<td>Complainant Company</td><td>:</td><td>&nbsp;complainant_company</td>
		</tr>
		
		<tr>
		<td>Complaint Status</td><td>:</td><td>&nbsp;Open</td>
		</tr>
		<tr>
		<td>Complaint Date</td><td>:</td><td>&nbsp; date</td>
		</tr>
		<tr>
		<td>Complaint Description</td><td>:</td><td>&nbsp;cmp_desc</td>
		</tr>	
		<tr>
		<td colspan="2">Thanks &amp; Regards<br>......</td><td></td>
		</tr>	
		</table>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->SMTPDebug = 0;
//$mail->send();
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
else
{
 $mail->send();
echo 'Message has been sent';
}