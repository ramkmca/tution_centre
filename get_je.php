<?php 
	date_default_timezone_set('Asia/Kolkata');
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php'; 
	//echo "ggg";
    $je_id = $_GET['je_id'];
	
	
		
		$query_user_list="SELECT * FROM ts_je WHERE je_area='".$je_id."'";
		$r_user_list = $db->fetchRow($query_user_list);
		
		$query_sdo_list="SELECT * FROM ts_sdo WHERE id='".$r_user_list['sdo_name']."'";
		$r_sdo_list = $db->fetchRow($query_sdo_list);
		
		?>
		
                                              
		<?php 
		echo "<b>JE Name : &nbsp;</b>".$r_user_list['je_name'];
		echo "<br>";
		echo "<b>Mobile No : &nbsp;</b>".$r_user_list['je_mobile'];
		echo "<br>";
		echo "<b>Sub Station Name : &nbsp;</b>".$r_user_list['sub_station_name'];
		echo "<br>";
		echo "<b>Sub Station Mobile : &nbsp;</b>".$r_user_list['sub_station_mobile'];
		echo "<br>";
		echo "<b>SDO Name : &nbsp;</b>".$r_sdo_list['sdo_name'];
		echo "<br>";
		echo "<b>SDO Mobile : &nbsp;</b>".$r_sdo_list['sdo_mobile'];
		
		?>
		<input type="hidden" name="div_code" id="div_code" value="<?php echo $r_user_list['div_code']; ?>">

		

		