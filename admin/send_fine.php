<?php
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
//require 'class.phpmailer.php';
$mail = new PHPMailer;
$mail->isSMTP();
//$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'mail.caretelindia.com';
$mail->Port = 25;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "mukesh.kumar@caretelindia.com";
$mail->Password = "MUkesh@1981";
$mail->setFrom('mukesh.kumar@caretelindia.com', 'First Last');
$mail->addReplyTo('ram.kumar@caretelindia.com', 'First Last');
$mail->addAddress('ram.kumar@caretelindia.com', 'first last');
$mail->addAddress('ramkmca6@gmail.com', 'first last');
$mail->Subject = 'PHPMailer GMail SMTP test';
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