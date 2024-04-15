<?php
$email_to="ramkmca6@gmail.com";
$email_subject="It works";
$email_message="Hello. I can send mail!";
$headers = "From: Beacze\r\n".
"Reply-To: address@gmail.com\r\n'" .
"X-Mailer: PHP/" . phpversion();
//mail($email_to, $email_subject, $email_message, $headers);  
if (mail ($email_to, $email_subject, $email_message, $headers)) { 
            echo '<p>Your message has been sent!</p>';
        } else { 
            echo '<p>Something went wrong, go back and try again!</p>'; 
        }

?>