
<?php
		$username = "639828";
		$password = "Upp123";
		$from     = "PVVNLT";
     // Config variables. Consult http://api.textlocal.in/docs for more

     $new_mobile_no="2222222";
	 $acct_id= "3333333333";
	 $ticket_no = "3344444";
	 $je_complaint_type ="comp";
	 $je_area ="SECTOR-32A,25A,33,34,35, s-asd-,salasdbkjh7h=-88/123-900 VILL-MORNA";

    
     $numbers = 9958780501;
	 $numbers1 = 9873241799;
	
     
	// $message = "your complaint detail mobile no ".$new_mobile_no." Acc ID ".$acct_id." complaint no ".$ticket_no." complaint
//type ".$je_complaint_type." address  ".$je_area." .";
$message = "Your complaint detail, Mobile No: ".$new_mobile_no.", Acc ID: ".$acct_id.", Complaint  No: ".$ticket_no.", Complaint Type: ".$je_complaint_type.", Address: ".$je_area."";
   
	 $data ="aid=".$username."&pin=".$password."&mnumber=".$numbers.",".$numbers1."&message=".$message."&signature=PVVNLT";
     $ch = curl_init('http://httpapi.zone:7501/failsafe/HttpLink?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
	 echo $result;
     curl_close($ch);
	// Authorisation details. 
	
	
	?>