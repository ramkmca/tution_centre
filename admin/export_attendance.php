<?php 
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';

$file = date('dmY-His');

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Ticket-Report-$file.csv");
header("Pragma: no-cache");
header("Expires: 0");



	$registration_no = trim($_REQUEST['registration_no']);
	if($registration_no!=""){
	$registration_no_qur = "AND  registration_no ='".$registration_no."'";	
	}
	$class_id = $_REQUEST['class_id'];
	if($class_id!=""){
	$class_id_qur = "AND  ts_attendance.class_id='".$class_id."'";	
	}
	$batch_id = $_REQUEST['batch_name'];
	if($batch_id!=""){
	$batch_id_qur = "AND  ts_attendance.batch_id='".$batch_id."'";	
	}
	$month = $_REQUEST['month'];
	if($month!=""){
	$month1 = '-'.$month.'-';
	$month_qur = "AND  date LIKE '%".$month1."%'";	
	}
	$att_date = $_REQUEST['att_date'];
	if($att_date!=""){
	$att_date_qur = "AND  date LIKE '%".$att_date."%'";	
	}
	$attendance = $_REQUEST['attendance'];
	if($attendance!=""){
	$attendance_qur = "AND  present ='".$attendance."'";	
	}
    $query_user_list="SELECT registration_no, student_name, class, batch_id, subject_name, present, date FROM ts_attendance
	INNER JOIN ts_class ON  ts_attendance.class_id=ts_class.id 
	WHERE 1 $registration_no_qur  $class_id_qur $batch_id_qur $month_qur $att_date_qur $attendance_qur
	";
    $r_user_list = $db->fetchResult($query_user_list);
 
$data = array();
$data[] = array('Registration No', 'Student Name',  'Class', 'Batch', 'Subject',  'Present', 'Date');
foreach($r_user_list as $value) {

    $data[] = array_values($value);
}


$output = fopen("php://output", "w");
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>

