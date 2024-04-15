<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
if(isset($_POST['respective_area']))
{
$respective_area=trim($_POST['respective_area']);
$query2="SELECT * FROM ts_je WHERE je_area LIKE '%$respective_area%' LIMIT 0,8 ";
$r_user_list = $db->fetchResult($query2);
foreach($r_user_list as $value)
{
?>


<div class="sugessionbox" onclick='fillje("<?php echo $value['je_area']; ?>")'><?php echo $value['je_area']; ?></div>
<?php
}
}
?>

