<?php 
	date_default_timezone_set('Asia/Kolkata');
	require_once '../app/classes/config.php';
	require_once '../app/classes/dbclass.php'; 
	
    $class_id = $_POST['class_id'];
	$batch_id = $_POST['batch_id'];
    $batch_id = explode(',',$batch_id);	
	
	    $query_user_list="SELECT * FROM ts_batch WHERE class_id='".$class_id."'"; 
		$r_batch_list = $db->fetchResult($query_user_list);
		?>
		
		
		<div class="form-group">

		<label>Batch Name </label>
		<select name="batch_name[]" id="batch_name" class="form-control" multiple tabindex="7">
		<option value="">--Select Class--</option>
		<?php 
		
		foreach($r_batch_list as $value)
		{
		?>

		<option value="<?php echo $value['id'];?>" <?php if(in_array($value['id'],$batch_id)){ ?> selected <?php }?> ><?php echo ucwords($value['batch_name']);?></option>
		<?php } ?>
		</select>

		</div>
                                              
