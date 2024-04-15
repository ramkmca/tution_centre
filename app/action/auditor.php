<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';
if(@$_REQUEST['action']=="remove")
{
       @$id = $_REQUEST['id'];
      $where = array('id'=>$id);
	  $post_array = array(
	  'status' =>0);
	  $result = $db->update_query('qa_details', $post_array, $where); 
	  $msg = 'Information successfully remove.';
}
else
{
  @$editId = $_POST['id']; 
  $post_array = array(
	  'first_name' => $_POST['first_name'],
	  'last_name' => $_POST['last_name'],
	  'login_id' => $_POST['login_id'],
	  'password' => $_POST['password'],
	  'contact_number' => $_POST['contact_number'],
	  'date' => date("Y-m-d")
  );
  
  if(empty($editId)){
	  $result = $db->insert_query('qa_details', $post_array, '');
	  $msg = 'New auditor successfully added.';
  } else {
	    
	  $where = array('id'=>$editId);
	  $result = $db->update_query('qa_details', $post_array, $where, $exc); 
	  $msg = 'Information successfully updated.';
  }
  $_SESSION['msg'] = $msg;
  
 } 
 // header("location:../../qa_details.php");



