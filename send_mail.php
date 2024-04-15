<?php 

$message = "<html><head></head><body>";
$message .= "<img src='http://localhost/tuition-centre/yes.jpg' alt='' /></body></html>";

$headers = "From: ramkmca6@gmail.com";
$headers .= "Content-type: text/html";

mail('ramkmca6@gmail.com', 'test', $message, $headers);


?>