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
	$class_id_qur = "AND  ts_student.class_id='".$class_id."'";	
	}
	$batch_id = $_REQUEST['batch_name'];
	if($batch_id!=""){
		
	$batch_id_qur = "AND  ts_student.batch_id LIKE '%".$batch_id."%'";	
	}
	
  $query_user_list="SELECT registration_no, student_name, dob, class, batch_id, father_name, mobile_no, reg_date FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	WHERE 1 $registration_no_qur  $class_id_qur $batch_id_qur
	
	";
	

$r_user_list = $db->fetchResult($query_user_list);
 
$data = array();
$data[] = array('Registration No', 'Student Name', 'DOB', 'Class', 'Batch', 'Father Name',  'Registration Date', 'Mobile No');
foreach($r_user_list as $value) {

    $data[] = array_values($value);
}


$output = fopen("php://output", "w");
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>

