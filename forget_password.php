<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';
	$email = $_GET['forgetemail'];
	$query_id='SELECT * FROM ts_user_login where email_id = "'.$email.'"';
	$r_id = $db->fetchRow($query_id);
    $email_count =  count($r_id);
	
	if(($email_count >0) && ($email!="")){
	$first_name = $r_id['first_name'];	
	$user_name = $r_id['user_name'];	
	$email_id = $r_id['email_id'];
    $password = $r_id['pwd'];	

    $ToEmail = $email;
	$mail = new PHPMailer(); 
	$mail->isSMTP();  
	//$mail->SMTPSecure = 'tls';                                    // Set mailer to use SMTP
	$mail->Host = 'mail.telco-soft.in';                       // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'support@telco-soft.in';                   // SMTP username
	$mail->Password = 'nimish@123';              // SMTP password
	// Enable encryption, 'ssl' also accepted
	$mail->Port = 587 ;                                   //Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('support@telco-soft.in');    //Set who the message is to be sent from
	//Set an alternative reply-to address
	$mail->addReplyTo($ToEmail);
	$mail->addAddress($ToEmail);  // Add a recipient
$mail->addAddress('ram.kumar@caretelindia.com'); 
	$mail->WordWrap = 150;                                 // Set word wrap to 50 characters
	//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
	//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

   $mail->Subject = 'Forget Login or Password';
   $mail->Body  = "<table>
		<tr>
		<td colspan='2'><b>Hi, $first_name Your login detail is as follows: </b></td>
		</tr>
	   
		<tr>
		<td>User Name</td><td>:</td><td>&nbsp;$user_name</td>
		</tr>
		
		<tr>
		<td>Password</td><td>:</td><td>&nbsp;$password</td>
		</tr>
		
		
		</table>";
				$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);
				if (!$mail->send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
					?>	
					 <div class="msg">Your detail is send on your  mail.</div>
					 <?php
					} 
	// $msg = "Your detail is send on your  mail."; 
	 //$msg = "Ticket successfully raised, Ticket No: ". $ticket_id;
         ?>
 
 
  <?php
  
  }	?>		
   
