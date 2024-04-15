<?php    
	require_once 'app/classes/config.php';
	require_once 'app/classes/dbclass.php';
	if(!isset($_SESSION['user_name'])){
	header("location: index.php"); 
	}
    include_once('header.php'); 
    include_once('left-sidebar.php'); 
	
    $query_user_list="SELECT * FROM ts_account";
    $r_user_list = $db->fetchResult($query_user_list);

?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Account List</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                            <a href="group-add.php">Add New Group</a>
                        </div>-->
						
                        <div class="panel-body">
						
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<?php

							if($_SESSION['sess_mess'])

							{

							?>

							 <thead><tr> <td height="29" colspan="5" align="center" class="h12" ><?php echo $_SESSION['sess_mess'];?></td></tr> </thead>

							<?php  //session_unset(sess_mess);	?>

							<?php

							}

							?>
                                    <thead>
                                        <tr>
                                             	
										    <th>S.No</th>
                                            <th>DIV Code</th>
											 <th>SDO Code</th>
                                           	<th>Acct ID</th>
											<th>KNO</th>
											<th>Name</th>
											<th>Address</th>
											<th>Mobile No</th>
											<th>Landline No</th>
											<th>Raise Ticket</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $num = 0; ?>
                                              <?php foreach($r_user_list as $value)
											{
											$num++;
											
				                        ?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo $num; ?></td>
											<td><?php echo $value['div_code']; ?></td>
											<td><?php echo $value['sdo_code']; ?></td>
											<td><?php echo $value['acct_id']; ?></td>
											<td><?php echo $value['kno']; ?></td>
											<td><?php echo $value['name']; ?></td>
											<td><?php echo $value['address']; ?></td>
											<td><?php echo $value['mobile_no']; ?></td>
											<td><?php echo $value['land_line_no']; ?></td>
											<td class="center"><a href="#" class="btn btn-primary btn-xs" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_account('<?php echo $value['id']; ?>','view_cmp');">Raise Ticket</a></td>
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
           
            
            
        </div>
        <!-- end page-wrapper -->

<div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
  
  <div class="modal fade" id="edit_cmp" role="dialog">
    
  </div>
  
   
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
 <script>
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        
        // Specify the validation rules
        rules: {
            cmp_comment: "required",
			ticket_no: "required"
			
         },
        
        // Specify the validation error messages
        messages: {
            cmp_comment: "Please enter comment",
			ticket_no: "Please enter comment1"
			
           },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
    $( "#submit_btn_id" ).click(function() {
		  setTimeout( function(){ 
    // Do something after 1 second 
	 $('input[type=text]').removeClass('form-control error');
      $('input[type=text]').addClass('form-control');
  }  , 2000 );
     
});

        </script>	
   <?php include_once('footer.php'); ?>
