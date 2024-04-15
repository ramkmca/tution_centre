<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';



if(isset($_POST['change_pwd'])){
    
    
    
    $old_pwd = $_POST['old_pwd'];
    $conf_new_pwd = $_POST['conf_new_pwd'];
   $where = array('id'=>'1');
       $change_pass = array(
	  'pswd' => $_POST['conf_new_pwd']);
      // print_r($change_pass); 
       //die;
       $result = $db->update_query('ts_admin_login', $change_pass, $where, $exc); 
	  $msg = 'Password Succefullly Changed.';
           $_SESSION['msg'] = $msg;
          header("location:../../admin/edit-profile.php"); 
       
  
 
       
  
}

if(isset($_POST['complaint_register'])){
$ticket_no = $_POST['ticket_no'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$uphone = $_POST['uphone'];
$uemail = $_POST['uemail'];
$complainant_company = $_POST['complainant_company'];
$cmp_desc = $_POST['cmp_desc'];
$date = date("Y-m-d");

  $post_array = array(
       'cmp_no' => $_POST['ticket_no'],
	  'cmp_first_name' => $_POST['f_name'],
	  'cmp_last_name' => $_POST['l_name'],
	  'cmp_full_name' => $_POST['f_name']." ".$_POST['l_name'],
	  'cmp_phn_no' => $_POST['uphone'],
	  'cmp_emailid' => $_POST['uemail'],
	  'cmp_company' => $_POST['complainant_company'],
	  'cmp_dep' => $_POST['udep'],
	  'cmp_group' => $_POST['ugrp'],
	   'cmp_dep' => $_POST['uadep'],
	   'cmp_group' => $_POST['uagrp'],
	   'cmp_desc' => $_POST['cmp_desc'],
       'cmp_status' => 'In Process', 
	  'cmp_date' => date("Y-m-d")
  );
  
 $result = $db->insert_query('ts_tickets', $post_array, '');
 $query_id='SELECT `cmp_no` FROM ts_tickets order by  `id` DESC LIMIT 0,1';
 $r_id = $db->fetchRow($query_id);
 $ticket_id = $r_id['cmp_no'];	
 $msg = "Ticket successfully raised, Ticket No: ". $ticket_id;
    $ToEmail = $_POST['uemail'];
	$emailid = 'contact@telco-soft.in';
    $EmailSubject = 'Ticketing System';
    $mailheader = "From: ".$emailid."\r\n";
    $mailheader .= "Reply-To: ".$ToEmail."\r\n";
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
    
    $MESSAGE_BODY = "<table>
		<tr>
		<td><b>Your Complaint Number (Complaint ID )</b><br></td><td>:</td><td>&nbsp;<b>$ticket_no</b></td>
		</tr>
	    <tr>
		<td colspan='2'>Your Detail</td>
		</tr>
		<tr>
		<td>Complainant First Name</td><td>:</td><td>&nbsp;$f_name</td>
		</tr>
		<tr>
		<td>Complainant Last Name</td><td>:</td><td>&nbsp;$l_name</td>
		</tr>
		<tr>
		<td>Complainant Phone No</td><td>:</td><td>&nbsp;$uphone</td>
		</tr>
		<tr>
		<td>Complainant Email</td><td>:</td><td>&nbsp;$uemail</td>
		</tr>
		
		<tr>
		<td>Complainant Company</td><td>:</td><td>&nbsp;$complainant_company</td>
		</tr>
		
		<tr>
		<td>Complaint Status</td><td>:</td><td>&nbsp;In Process</td>
		</tr>
		<tr>
		<td>Complaint Date</td><td>:</td><td>&nbsp; $date</td>
		</tr>
		<tr>
		<td>Complaint Description</td><td>:</td><td>&nbsp;$cmp_desc</td>
		</tr>
		
		
		</table>		
		";
	
		
   mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure");
	 $msg = "Thank you. Your mail has been sent."; 
         
  $_SESSION['msg'] = $msg;
  header("location:../../index.php"); 
  
  }
  

