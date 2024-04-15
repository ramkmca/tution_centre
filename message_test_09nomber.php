
<?php
		$username = "caretlhttp";
		$password = "care1234";
		$from     = "PVVNLN";
     // Config variables. Consult http://api.textlocal.in/docs for more

     $new_mobile_no="2222222";
	 $acct_id= "3333333333";
	 $ticket_no = "3344444";
	 $je_complaint_type ="comp";
	 $je_area ="area";

    
     $numbers = 9953046368;
	 $numbers1 = 9953046367;
	
     
	 $message = "your complaint detail mobile no ".$new_mobile_no." Acc ID ".$acct_id." complaint no ".$ticket_no." complaint
type ".$je_complaint_type." address  ".$je_area." .";
   
	 $data ="username=".$username."&password=".$password."&to=".$numbers.",".$numbers1."&from=".$from."&text=".$message."&category=bulk";
     $ch = curl_init('http://www.myvaluefirst.com/smpp/sendsms?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
	 echo $result;
     curl_close($ch);
	// Authorisation details. 
	
	?>