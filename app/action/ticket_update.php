<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';
require '../../PHPMailerAutoload.php';
require '../../class.phpmailer.php';


if(isset($_POST['complaint_register'])){
	
	$current_date_time = date("Y-m-d H:i:s");
	$cmp_id = $_POST['cmp_id'];
	
	
	$where = array('id'=>$cmp_id);
	//$cmp_id_update = "id=".$cmp_id; 
    $post_array = array(
     
      'cmp_status' => $_POST['ugrp'], 
	  'cmp_comment' => $_POST['cmp_comment']
  );
  
    $result = $db->update_query('ts_tickets', $post_array, $where, $exc);
	 
    $msg = 'Complaint Succeffully Update';
  
         
	$_SESSION['sess_mess'] = $msg;
	header("location:../../agent-view.php"); 
  
  }
  

