<?php 
	date_default_timezone_set('Asia/Kolkata');
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php'; 
	//echo "ggg";
    $ticketcmp = $_GET['ticketcmp'];
	
	    $query="SELECT * FROM ts_tickets WHERE cmp_no='".$ticketcmp."'";
		
		$r_id = $db->fetchRow($query);
		$query="SELECT * FROM ts_complaint_type WHERE id='".$r_id['complaint_type']."'"; 
		$complaint_type_qur = $db->fetchRow($query);
		$complaint_type = $complaint_type_qur['complaint_type'];
		$complant_count =  count($complaint_type_qur);
	
		$query="SELECT * FROM ts_priority WHERE id='".$r_id['priority']."'"; 
		$priority_qur = $db->fetchRow($query);
		$priority = $priority_qur['priority'];
		
		$query="SELECT * FROM ts_zone WHERE id='".$r_id['zone']."'"; 
		$zone_qur = $db->fetchRow($query);
		$zone = $zone_qur['zone'];
		
		$query="SELECT * FROM ts_disposition WHERE id='".$r_id['disposition']."'"; 
		$disposition_qur = $db->fetchRow($query);
		$disposition = $disposition_qur['disposition'];
		
	if($ticketcmp!=""){
		if($complant_count >0){
	
		?>




<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<tr>
							<td>Complaint No  :</td><td><?php echo $r_id['cmp_no']; ?></td>
							</tr>
							<tr>
							<td>CRN No  :</td><td><?php echo $r_id['crn_number']; ?></td>
							</tr>
							<tr>
							<td>Name  :</td><td><?php echo $r_id['cmp_first_name']; ?></td>
							</tr>
							<tr>
							<td>Address  :</td><td><?php echo $r_id['address']; ?></td>
							</tr>
							<tr>
							<td>Phone Number  :</td><td><?php echo $r_id['cmp_phn_no']; ?></td>
							</tr>
							<tr>
							<td>Email  : </td><td><?php echo $r_id['cmp_emailid']; ?></td>
							</tr>
							<tr>
							<td>Complaint Type  :</td><td><?php echo $complaint_type; ?></td>
							</tr>
							<tr>
							<td>Priority  :</td><td><?php echo priority; ?></td>
							</tr>
							<tr>
							<td>Zone  :</td><td><?php echo $zone; ?></td>
							</tr>
							<tr>
							<td>Disposition  :</td><td><?php echo $disposition; ?></td>
							</tr>
							<tr>
							<td>Description  :</td><td><?php echo $r_id['cmp_desc']; ?></td>
							</tr>
							<tr>
							<td>Status  :</td><td><?php echo ucwords($r_id['cmp_status']); ?></td>
							</tr>
							<tr>
							<td>Date  :</td><td><?php echo $r_id['cmp_date']; ?></td>
							</tr>
							<?php 	if($r_id['cmp_comment']!=""){ ?>
							<tr>
							<td>Resolution Given  :</td><td><?php echo $r_id['cmp_comment']; ?></td>
							</tr>
							<?php } ?>
							</table>
		<?php } else{ ?>
			
			<div class="pwd_msg">Wrong Complaint ID </div>
		<?php }	?>						
							
	<?php }?>							