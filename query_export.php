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
	$from_date_qur = "AND date >='".$from_date."'";	
	}
	$to_date = $_REQUEST['to_date'];
	$to_date_new= date("Y-m-d", strtotime($to_date . " +24 hours"));
	if($to_date_new!=""){
	$to_date_qur = "AND date <'".$to_date_new."'";	
	}
	
	
	$sql="select  `complaint_no`, `information`, `cmp_name`, mobile_no, address,  `date` from ts_raise_query INNER JOIN ts_information ON ts_raise_query.information_id=ts_information.id
	
	WHERE 1 $from_date_qur $to_date_qur ";	
	


$r_user_list = $db->fetchResult($sql);
 
$data = array();
$data[] = array('Complaint No', 'Information/Query', 'Name', 'Mobile No', 'Address', 'Date');
foreach($r_user_list as $value) {

    $data[] = array_values($value);
}

$output = fopen("php://output", "w");
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>

