<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';
if(@$_REQUEST['action']=="remove")
{
       @$id = $_REQUEST['id'];
      $where = array('id'=>$id);
	  $post_array = array(
	  'status' =>0);
	  $result = $db->update_query('auditor_sheet', $post_array, $where); 
	  $msg = 'Information successfully remove.';
}
else
{
  @$editId = $_POST['id']; 
  $post_array = array(
	  'qa_id' => $_POST['qa_id'],
	  'login_id' => $_POST['login_id'],
	  'agent_name' => $_POST['agent_name'],
	  'TLname' => $_POST['TLname'],
	  'DOJ' => $_POST['DOJ'],
	  'AON' => $_POST['AON'],
	  'bucket' => $_POST['bucket'],
	  'manager' => $_POST['manager'],
	  'month' => $_POST['month'],
	  'week' => $_POST['week'],
	  'OJT' => $_POST['OJT'],
	  'grade' => $_POST['grade'],
	  'CRM_id' => $_POST['CRM_id'],
	  'track_id' => $_POST['track_id'],
	  'mobile_no' => $_POST['mobile_no'],
	  'eval_date' => $_POST['eval_date'],
	  'qa_name' => $_POST['qa_name'],
	  'call_dur_mnts' => $_POST['call_dur_mnts'],
	  'call_dur_sec' => $_POST['call_dur_sec'],
	  'total_call_time' => $_POST['total_call_time'],
	  'process' => $_POST['process'],
	  'date_of_call' => $_POST['date_of_call'],
	  'type_of_call' => $_POST['type_of_call'],
	  'beneficiary' => $_POST['beneficiary'],
	  'courteous' => $_POST['courteous'],
	  'court_asign_value' => $_POST['court_asign_value'],
	  'court_come_value' => $_POST['court_come_value'],
	  'rate_of_speech' => $_POST['rate_of_speech'],
	  'rate_asign_value' => $_POST['rate_asign_value'],
	  'rate_come_value' => $_POST['rate_come_value'],
	  'active_listening' => $_POST['active_listening'],
	  'active_asign_value' => $_POST['active_asign_value'],
	  'active_come_value' => $_POST['active_come_value'],
	  'voice_clarity' => $_POST['voice_clarity'],
	  'voice_asign_value' => $_POST['voice_asign_value'],
	  'voice_come_value' => $_POST['voice_come_value'],
	  'verificatio_no_qa' => $_POST['verificatio_no_qa'],
	  'veri_asign_value' => $_POST['veri_asign_value'],
	  'veri_come_value' => $_POST['veri_come_value'],
	  'complete_info_provide' => $_POST['complete_info_provide'],
	  'complete_asign_value' => $_POST['complete_asign_value'],
	  'complete_come_value' => $_POST['complete_come_value'],
	  'apropriate_ques_asked' => $_POST['apropriate_ques_asked'],
	  'apropriate_asign_value' => $_POST['apropriate_asign_value'],
	  'apropriate_come_value' => $_POST['apropriate_come_value'],
	  'correct_entry_time' => $_POST['correct_entry_time'],
	  'correct_asign_value' => $_POST['correct_asign_value'],
	  'correct_come_value' => $_POST['correct_come_value'],
	  'talk_time_taken' => $_POST['talk_time_taken'],
	  'talk_asign_value' => $_POST['talk_asign_value'],
	  'talk_come_value' => $_POST['talk_come_value'],
	  'QA_score' => $_POST['QA_score'],
	  'overall_call_performance' => $_POST['overall_call_performance'],
	  'area_of_improvement' => $_POST['area_of_improvement']);
  
  if(empty($editId)){
	  $result = $db->insert_query('auditor_sheet', $post_array,'');
	  $msg = 'New auditor sheet successfully added.';
  } else {
	    
	  $where = array('id'=>$editId);
	  $result = $db->update_query('auditor_sheet', $post_array, $where, $exc); 
	  $msg = 'Information successfully updated.';
  }
  $_SESSION['msg'] = $msg;
  
 } 
header("location:../../audit.php");



