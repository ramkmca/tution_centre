<?php 
	date_default_timezone_set('Asia/Kolkata');
	require_once '../app/classes/config.php';
	require_once '../app/classes/dbclass.php'; 
	//echo "ggg";
    $div_id = $_GET['div_id'];
	$sdo_id = $_GET['sdo_id'];
	
		
		$query_user_list="SELECT * FROM ts_sdo WHERE div_code='".$div_id."'";
		$r_user_list = $db->fetchResult($query_user_list);
		?>
		
                                              
		<div class="form-group">

		<label>SDO Name </label>

		<select name="sdo_name" id="sdo_name" class="form-control">
		<option value="">--Select SDO Name--</option>
		<?php 

		foreach($r_user_list as $value)
		{
		?>

		<option value="<?php echo $value['id'];?>" <?php if($value['id']==$sdo_id){ ?> selected <?php }?> ><?php echo $value['sdo_name'];?></option>
		<?php } ?>
		</select>

		</div>