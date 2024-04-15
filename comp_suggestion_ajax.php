<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
if(isset($_POST['address']))
{
$address=trim($_POST['address']);
$con_name=trim($_POST['con_name']);
$query2="SELECT * FROM ts_account WHERE name LIKE '%$con_name%' AND address LIKE '%$address%' LIMIT 0,20 ";
$r_user_list = $db->fetchResult($query2);
foreach($r_user_list as $value)
{
?>


<div class="sugessionbox" onclick='fill("<?php echo $value['address']; ?>")'><?php echo $value['address']; ?></div>
<?php
}
}
?>

