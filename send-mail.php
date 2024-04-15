
<?php
$to      = 'ramkmca6@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: ramkmca6@gmail.com' . "\r\n" .
    'Reply-To: ramkmca6@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

?>
