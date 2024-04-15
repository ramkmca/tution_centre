<?php 
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';

$file = date('dmY-His');

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Ticket-Report-$file.csv");
header("Pragma: no-cache");
header("Expires: 0");
$user_id = $_SESSION['user_id'];

	$from_date = $_REQUEST['from_date'];
	if($from_date!=""){
	$from_date_qur = "AND cmp_date >='".$from_date."'";	
	}
	$to_date = $_REQUEST['to_date'];
	$to_date_new= date("Y-m-d", strtotime($to_date . " +24 hours"));
	if($to_date_new!=""){
	$to_date_qur = "AND cmp_date <'".$to_date_new."'";	
	}
	$div_code = trim($_REQUEST['div_code']);
	
	if($_REQUEST['div_code']!=""){
	$div_coded_qur = "AND div_id ='".$div_code."'";	
	}
	$status = $_REQUEST['status'];
	if($status!=""){
	$status_qur = "AND cmp_status ='".$status."'";	
	}
	$sub_station_name = $_REQUEST['sub_station_name'];
	if($sub_station_name!=""){
	$sub_station_name_qur = "AND respective_area ='".$sub_station_name."'";	
	}
	
	$sql="select  `cmp_no`, `acct_id`, ts_zone.div_code, ts_complaint_type.complaint_type, sub_station_name, `mobileno`, `cmp_date`, `cmp_status` from ts_tickets INNER JOIN ts_zone ON ts_tickets.div_id=ts_zone.id
	INNER JOIN ts_complaint_type ON ts_tickets.complaint=ts_complaint_type.id INNER JOIN ts_je ON ts_tickets.respective_area=ts_je.id
	WHERE 1 $from_date_qur $to_date_qur  $div_coded_qur $status_qur $sub_station_name_qur";	
	


$r_user_list = $db->fetchResult($sql);
 
$data = array();
$data[] = array('Complainant No', 'Acct ID', 'Div Code', 'Complaint', 'SS_Name', 'Mobile No',  'Date', 'Status');
foreach($r_user_list as $value) {

    $data[] = array_values($value);
}

$output = fopen("php://output", "w");
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>

