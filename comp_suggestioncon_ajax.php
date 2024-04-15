<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
if(isset($_POST['con_name']))
{
$con_name=trim($_POST['con_name']);
$query2="SELECT * FROM ts_account WHERE name LIKE '$con_name%' LIMIT 0,30 ";
$r_user_list = $db->fetchResult($query2);
foreach($r_user_list as $value)
{
?>


<div class="sugessionbox" onclick='fillcon("<?php echo $value['name']; ?>")'><?php echo $value['name']; ?></div>
<?php
}
}
?>

