<?php    

    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	require 'PHPMailerAutoload.php';
    require 'class.phpmailer.php';
	//error_reporting(E_ALL);

	$user_id = $_SESSION['user_id'];

	$from_date = $_REQUEST['from_date'];
	if($from_date!=""){
	$from_date_qur = "AND cmp_date >='".$from_date."'";	
	}
	$to_date = $_REQUEST['to_date'];
	$to_date_new= date("Y-m-d", strtotime($to_date . " +24 hours"));
	if($to_date_new!=""){
	$to_date_qur = "AND cmp_date <'".$to_date_new."'";	
	}
	
	$div_code = trim($_REQUEST['div_code']);
	
	if($_REQUEST['div_code']!=""){
	$div_coded_qur = "AND div_id ='".$div_code."'";	
	}
	$status = $_REQUEST['status'];
	if($status!=""){
	$status_qur = "AND cmp_status ='".$status."'";	
	}
	$sub_station_name = $_REQUEST['sub_station_name'];
	if($sub_station_name!=""){
	$sub_station_name_qur = "AND respective_area ='".$sub_station_name."'";	
	}
	
	
	$query_user_list="SELECT * FROM ts_tickets WHERE 1 $from_date_qur $to_date_qur $div_coded_qur $status_qur $sub_station_name_qur";	
	
    $r_user_list = $db->fetchResult($query_user_list);
	$current_date_time = date("Y-m-d H:i:s");
	
	


?>
        <!--  page-wrapper -->
        <div id="page-wrapper">
<link rel="stylesheet" type="text/css" media="all" href="admin/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="admin/jsDatePick.min.1.3.js"></script>
    <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"from_date",
			dateFormat:"%Y-%m-%d"
			
		});
		new JsDatePick({
			useMode:2,
			target:"to_date",
			dateFormat:"%Y-%m-%d"
			
		});
	};
</script>        
            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Ticket List<?php //echo $query_user_list; ?></h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
					<div class="panel-heading">
                             <form name="frm1" id="frm1" method="get">
							   <table class="table table-bordered table-hover">
							   <tr><td>From Date</td><td><input type="text" name="from_date" value="<?php echo $from_date; ?>" id="from_date"></td><td>To Date</td><td><input type="text" name="to_date" value="<?php echo $to_date;?>" id="to_date"></td>
							   <td>Div Code</td><td>
							   <select name="div_code" id="div_code" class="form-control" width="100px">
							    <option value="">--Select--</option>
								<?php 
								$query_zone_list="SELECT * FROM ts_zone";
								$r_zone_list = $db->fetchResult($query_zone_list);
								foreach($r_zone_list as $value)
								{
								?>
							   <option value="<?php echo $value['id'];?>" <?php if($value['id']==$div_code){ ?> selected <?php } ?> ><?php echo $value['div_code'];?></option>
							   
							   
								<?php } ?>
							   </select>
							   </td>
							   </tr>   <tr>
							   <td>Status</td><td><select name="status" id="status" class="form-control" width="100px">
							    <option value="">--Select--</option>
							   <option value="Open" <?php if($status=='Open'){ ?> selected <?php } ?> >Open</option>
							   <option value="In Process" <?php if($status=='In Process'){ ?> selected <?php } ?> >In Process</option>
							   <option value="Close" <?php if($status=='Close'){ ?> selected <?php } ?> >Close</option>
							   
							   </select>
							   </td>
							   <td>Sub Station Name</td><td>
							   <select name="sub_station_name" id="sub_station_name" class="form-control" width="100px">
							    <option value="">--Select--</option>
								<?php 
								$query_je_list="SELECT * FROM ts_je";
								$r_je_list = $db->fetchResult($query_je_list);
								foreach($r_je_list as $value)
								{
								?>

								<option value="<?php echo $value['id'];?>" <?php if($value['id']==$sub_station_name){ ?> selected <?php }?> ><?php echo $value['sub_station_name'];?></option>
								<?php } ?>
							   
							   
							   </select>
							   </td>
							   
							   
							  
							   <td colspan="2"><input class="btn btn-primary btn-xs" type="submit" name="submit" id="submit" value="Search"></td>
							   <tr>
							   </table>
							 </form>
                        </div>
						<div class="panel-heading" style="text-align:right;"><a href="export.php?from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date_new;?>&div_code=<?php echo $div_code;?>&status=<?php echo $status;?>&sub_station_name=<?php echo $sub_station_name;?>">Download Excel</a></div>
                        <?php if(isset($_SESSION['msg'])){?>
							  <div style="text-align:center;">
                    <span class="msg_ticket"> 
					<?php
                                               echo $_SESSION['msg'];
                                               unset($_SESSION['msg']);
                      ?>                         
                                          
                            </span>
							</div>
				    <?php } ?>
						<?php if(isset($_SESSION['sess_mess'])){ ?>
						 <div style="text-align:center;">
                           
                        
                             
<span class="msg"> <?php if(isset($_SESSION['sess_mess'])){
                                               echo $_SESSION['sess_mess'];
                                               
                                               
                                           } ?>
                            </span>
                        </div>
						<?php } ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                             	
										    <th>Complaint_no</th>
											<th>Acct ID</th>
											<th>Div Code</th>
                                            <th>Complaint</th>
											<th>SS_Name</th>
											<th> Date</th>
                                            <th>Mobile No</th>
											<!--<th>Respective Area</th>-->
                                            
                                            <th>View </th>
											<th>Status</th>
											
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                              <?php foreach($r_user_list as $value)
				{
				  
				
				$query="SELECT complaint_type FROM ts_complaint_type WHERE id='".$value['complaint']."'"; 
				$r_complaint = $db->fetchRow($query);
				$complaint = 	trim($r_complaint['complaint_type']);
				
				
				$query="SELECT div_code,email,phone_no FROM ts_zone WHERE id='".$value['div_id']."'"; 
				$r_divcode = $db->fetchRow($query);
				$div_code_area	= 	trim($r_divcode['div_code']);
				$ee_phone_no 	= 	trim($r_divcode['phone_no']);
				$ee_email 	    = 	trim($r_divcode['email']);
				
				$query="SELECT sub_station_name, je_area FROM ts_je WHERE id='".$value['respective_area']."'"; 
				$r_respective_area = $db->fetchRow($query);
				$sub_station_name = 	trim($r_respective_area['sub_station_name']);
				$je_area = 	trim($r_respective_area['je_area']);
				
				$query="SELECT address FROM ts_account WHERE acct_id='".$value['acct_id']."'"; 
				$r_con_address = $db->fetchRow($query);
				$con_address = 	trim($r_con_address['address']);
				
					$date2 = date("Y-m-d H:i:s");
					$seconds = strtotime($date2) - strtotime($value['cmp_date']);
					$diff_minut = ceil($seconds / 60);


				
				if(($value['cmp_status']=='Open')&&($diff_minut > 240)&&($value['mail_delay']==0)){
					
					 $ticket_no = $value['cmp_no'];
					 $new_mobile_no = $value['mobileno'];
					 $cmp_desc =  $value['cmp_desc'];
					 $acct_id = $value['acct_id'];
					 

					// Authorisation details.

					$username = "639828";
					$password = "Upp123";
					//$from     = "PVVNLN";
					
					
	 

    
     //$numbers = 9953046368;
	 $numbers = $ee_phone_no;
	
	
     
	 //$message = "your complaint detail mobile no ".$new_mobile_no." Acc ID ".$acct_id." complaint no ".$ticket_no." complaint
//type ".$complaint." address  ".$je_area." .";
$message = "Your complaint detail, Mobile No: ".$new_mobile_no.", Acc ID: ".$acct_id.", Complaint  No: ".$ticket_no.", Complaint Type: ".$je_complaint_type.", Address: ".$con_address."";

   
	 $data ="aid=".$username."&pin=".$password."&mnumber=".$numbers.",".$numbers1."&message=".$message."&signature=PVVNLT";
     $ch = curl_init('http://httpapi.zone:7501/failsafe/HttpLink?');
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch); // This is the result from the API
	 echo $result;
     curl_close($ch);
					// Authorisation details. 
	
					 
					 
					$mail = new PHPMailer(); 
					$mail->isSMTP();  
					//$mail->SMTPSecure = 'tls';                                    // Set mailer to use SMTP
					$mail->Host = 'mail.caretelindia.com';                       // Specify main and backup server
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'pvnl@caretelindia.com';                   // SMTP username
					$mail->Password = '$#pv44PV44';              // SMTP password
									   // Enable encryption, 'ssl' also accepted
					$mail->Port = 25 ;                                   //Set the SMTP port number - 587 for authenticated TLS
					$mail->setFrom('pvnl@caretelindia.com');    //Set who the message is to be sent from
					//Set an alternative reply-to address
					$mail->addReplyTo('pvnl@caretelindia.com');
					$mail->addAddress($ee_email);
					// $mail->addAddress($ee_email);
					$mail->WordWrap = 150;                                 // Set word wrap to 50 characters
					//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
					//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
					$mail->isHTML(true);                                  // Set email format to HTML

					$mail->Subject = 'PVVNL New Complaint';

					$mail->Body    = "<table>
						<tr>
						<td><b>Complaint Number (Complaint ID )</b><br></td><td>:</td><td>&nbsp;<b>$ticket_no</b></td>
						</tr>
						
						<tr>
						<td>Complaint</td><td>:</td><td>&nbsp;$complaint</td>
						</tr>
						
											
						<tr>
						<td>Mobile No</td><td>:</td><td>&nbsp;$new_mobile_no</td>
						</tr>
						
						<tr>
						<td>Address</td><td>:</td><td>&nbsp;$con_address</td>
						</tr>
						
						<tr>
						<td>Disposition</td><td>:</td><td>&nbsp;$cmp_desc</td>
						</tr>
						
						
						
						</table>		
						";
					$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
					);
					//echo "wwwwwwwwww11"; exit;	
					if (!$mail->send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
					}  
					
                    $id =   $value['id'];
					$post_array = array(
					'mail_delay' => 1
					);
					$where = array('id'=>$id);
					//$result = $db->updare_query('ts_department', $post_array, $where, $exc);
					$result = $db->update_query('ts_tickets', $post_array, $where, $exc);
						
					}
				   
				
				
				
				   
				?>
                                       
										 <tr class="odd gradeX">
										
                                            <td><?php echo $value['cmp_no']; ?></td>
											<td><?php echo $value['acct_id']; ?></td>
											<td><?php echo $div_code_area; ?></td>
											<td><?php echo $complaint; ?></td>
										    <td><?php echo $sub_station_name; ?></td>
											<td class="center"><?php echo $value['cmp_date']; ?></td>
											<td><?php echo $value['mobileno']; ?></td>
											<!--<td><?php echo $value['respective_area']; ?></td>-->
											
											<td class="center"><a href="#" class="btn btn-outline btn-link" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_complaint('<?php echo $value['id']; ?>','view_cmp');">View Detail</a></td>
											<td class="center"><?php echo $value['cmp_status']; ?></td>
											
											</tr>
                                <?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
           
           <?php unset($_SESSION['sess_mess']); ?>   
            
        </div>
        <!-- end page-wrapper -->

   <script src="assets/plugins/jquery-1.10.2.js"></script>   
   <script src="assets/plugins/jquery.validate.min.js"></script>
   <div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
  <div class="modal fade" id="edit_cmp" role="dialog">
    
  </div>
  <div class="modal fade" id="reassign_complaint" role="dialog">
    
  </div>
   
        
   
	
   <?php include_once('footer.php'); ?>
