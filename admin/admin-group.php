<?php 
require_once '../app/classes/config.php';
require_once '../app/classes/dbclass.php';
 $dept = $_GET['dep_val'];
	
		$query="SELECT * FROM ts_group WHERE dept_id='".$dept."'"; 
		$group_query = $db->fetchResult($query);
		?>
		
			<?php foreach($group_query as $value)
			{
			?>
			<option value="<?php echo $value['group_id'];?>"><?php echo $value['group_name'];?></option>
			<?php } ?>
		
		