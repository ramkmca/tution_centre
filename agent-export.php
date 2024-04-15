<?php 
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';

$file = date('dmY-His');

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=Ticket-Report-$file.csv");
header("Pragma: no-cache");
header("Expires: 0");
$user_id = $_SESSION['user_id'];
$valid_list_qur = "SELECT * FROM ts_user_login WHERE id ='".$user_id."'";
$valid_user_rec = $db->fetchRow($valid_list_qur);
$user_role = $valid_user_rec['role'];
$user_department = $valid_user_rec['department'];
$user_group = $valid_user_rec['dp_group'];
if($user_role==2 && $user_department!="" && $user_group=="")
{
	$valid_user = " AND role=3";
}
if($user_role==1 && $user_department=="")
{
	$valid_user = " AND role in(2,3)";
}

$sql="SELECT `full_name`, `mob_no`, `dep_name`, `group_name` 
FROM ts_user_login INNER JOIN ts_department ON ts_user_login.department=ts_department.dep_id
INNER JOIN ts_group ON ts_user_login.dp_group=ts_group.group_id WHERE 1 $valid_user";
$r_user_list = $db->fetchResult($sql); 
 
$data = array();
$data[] = array('User Full Name', 'Mobile No', 'Department',  'Group');
foreach($r_user_list as $value) {
    $data[] = array_values($value);
}

$output = fopen("php://output", "w");
foreach ($data as $val) {
    fputcsv($output, $val);
}
fclose($output);
?>

