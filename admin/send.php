<?php
date_default_timezone_set('Etc/UTC');


require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';
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
	$mail->addAddress('ramkmca6@gmail.com');
    //$mail->addAddress('ram.kumar@caretelindia.com');
	$mail->WordWrap = 150;                                 // Set word wrap to 50 characters
	//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
	//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'PVVNL New Complaint';
$mail->Body = "example";
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
} else {
	//$mail->send();
echo "Message sent11!";
}

?>