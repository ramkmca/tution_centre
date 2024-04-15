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

if(isset($_POST['add_agent']) || isset($_POST['edit_user'])){


  @$editId = $_POST['id']; 
 // echo '--'.@$editId; 
  //echo '--'.$editId; 
  //die;
  //echo $_POST['urole']; die;
  if($_POST['urole'] == '1' ||  $_POST['urole'] == '2'){
      
      $post_array = array(
	  'first_name' => $_POST['f_name'],
	  'last_name' => $_POST['l_name'],
	  'full_name' => $_POST['f_name']." ".$_POST['l_name'],
	  'user_name' => $_POST['unam'],
	  'pwd' => $_POST['upass'],
	  'mob_no' => $_POST['uphone'],
	  'email_id' => $_POST['uemail'],
	  'department' => $_POST['udep'],
	   'role' => $_POST['urole'],
	   'status' => $_POST['ustatus'],
	  'date' => date("Y-m-d")
  );
      
      
  }
  
  else{
  $post_array = array(
	  'first_name' => $_POST['f_name'],
	  'last_name' => $_POST['l_name'],
	  'full_name' => $_POST['f_name']." ".$_POST['l_name'],
	  'user_name' => $_POST['unam'],
	  'pwd' => $_POST['upass'],
	  'mob_no' => $_POST['uphone'],
	  'email_id' => $_POST['uemail'],
	  'department' => $_POST['udep'],
	   'dp_group' => $_POST['ugrp'],
	   'role' => $_POST['urole'],
	   'status' => $_POST['ustatus'],
	  'date' => date("Y-m-d")
  );
  
  
  }
   if(empty($editId)){
  //print_r($post_array);
	  
    $result = $db->insert_query('ts_user_login', $post_array, '');
	  $msg = 'New agent successfully added.';
          
           } else {
	    
  $where = array('id'=>$editId);
	  $result = $db->update_query('ts_user_login', $post_array, $where, $exc); 
	  $msg = 'Information successfully updated.';
  }
  $_SESSION['msg'] = $msg;
  header("location:../../admin-page.php"); 
}
  

