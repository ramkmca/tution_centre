<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';



if(isset($_POST['complaint_register'])){
	
	
	$cmp_id = $_POST['cmp_id'];
	

	
	
	$where = array('id'=>$cmp_id);
	//$cmp_id_update = "id=".$cmp_id; 
    $post_array = array(
     
      'cmp_dep' => $_POST['uadep_ra'], 
	  'cmp_group' => $_POST['uagrp'],
	  'reassign_by' => $_SESSION['user_id'],
	  'reassign' => 'Reassign'
  );
  
    $result = $db->update_query('ts_tickets', $post_array, $where, $exc);
	 
    $msg = 'Complaint Succeffully Reassign';
  
         
	$_SESSION['sess_mess'] = $msg;
	header("location:../../agent-view.php"); 
  
  }
  

