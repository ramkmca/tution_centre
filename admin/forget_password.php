<?php
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
	$email = $_GET['forgetemail'];
	$query_id='SELECT * FROM ts_admin_login where email_id = "'.$email.'"';
	$r_id = $db->fetchRow($query_id);
    $email_count =  count($r_id);
	
	if($email_count >0){
		
	$first_name = $r_id['first_name'];	
	$email_id = $r_id['email_id'];
    $password = $r_id['pswd'];	
?>
<?php
    $ToEmail = $email;
	$emailid = 'contact@telco-soft.in';
    $EmailSubject = 'Forget Login or Password';
    $mailheader = "From: ".$emailid."\r\n";
    $mailheader .= "Reply-To: ".$ToEmail."\r\n";
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
    
    $MESSAGE_BODY = "<table>
		<tr>
		<td colspan='2'><b>Hi, $first_name Your login detail is as follows: </b></td>
		</tr>
	   
		<tr>
		<td>Your Name</td><td>:</td><td>&nbsp;$first_name</td>
		</tr>
		<tr>
		<td>Password</td><td>:</td><td>&nbsp;$password</td>
		</tr>
		
		
		</table>		
		";
	
		
   mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure");
	// $msg = "Your detail is send on your  mail."; 
	 //$msg = "Ticket successfully raised, Ticket No: ". $ticket_id;
         ?>
 <div class="msg">Your detail is send on your  mail.</div>
  <?php
  
  }else{ ?>
			
			<div class="pwd_msg">Wrong Email ID </div>
		<?php }	?>		
   
