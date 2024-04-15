<?php 
	date_default_timezone_set('Asia/Kolkata');
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php'; 
	//echo "ggg";
    $dept = $_GET['dept'];
	
		$query="SELECT * FROM ts_group WHERE dept_id='".$dept."'";
		$group_query = $db->fetchResult($query);
		?>
		<div class="form-group">
		<label for="disabledSelect">Complaint Group</label>
		<select name="uagrp" class="form-control" id="uagrp">
		<option value="0" selected disabled>Select</option>
			<?php foreach($group_query as $value)
			{
			?>
			<option value="<?php echo $value['group_id'];?>"><?php echo $value['group_name'];?></option>
			<?php } ?>
		
		</select>
		</div>
                                              
