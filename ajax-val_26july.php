<?php
require_once 'app/classes/config.php';
require_once 'app/classes/dbclass.php';
//require_once 'assets/scripts/validation.js';

  if(isset($_POST['dep_val']))
{
    
   $dep_val = $_POST['dep_val'];
   $query='SELECT * FROM ts_group where dept_id = "'.$dep_val.'"';
$r = $db->fetchResult($query);
   
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 foreach($r as $value)
				{
				?>
    
   <option value="<?php echo $value['group_id']; ?>"><?php echo $value['group_name']; ?></option>
                                <?php  }

}

 if(isset($_POST['rec_id']))
{
     $query="SELECT * FROM ts_department";
$r = $db->fetchResult($query);

$query_rol="SELECT * FROM ts_user_role";
$r_rol = $db->fetchResult($query_rol);
   $rec_id = $_POST['rec_id'];
   
   $query_id='SELECT * FROM ts_user_login where id = "'.$rec_id.'"';
   //echo $query_id; die;
$r_id = $db->fetchRow($query_id);
$query_grp='SELECT * FROM ts_group where dept_id="'.$r_id["department"].'"';
$r_grp = $db->fetchResult($query_grp);

   
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit User
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="../app/action/agent.php" method="post">
                                        <input  type="hidden" name="id" value="<?php echo $r_id['id']; ?>">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="f_name" class="form-control" id="e_fname" placeholder="Enter first name" onblur="user_concat('e_fname','e_lname','e_uname');" value="<?php echo $r_id['first_name']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="l_name" class="form-control" id="e_lname" placeholder="Enter last name" onblur="user_concat('e_fname','e_lname','e_uname');" value="<?php echo $r_id['last_name']; ?>">
                                        </div>
                                        <div class="form-group">
                                                <label for="disabledSelect">User Name</label>
                                                <input  name="unam" class="form-control" id="e_uname" type="text" readonly value="<?php echo $r_id['user_name']; ?>">
                                            </div>
                                          <div class="form-group">
                                            <label>Password</label>
                                            <input  name="upass" class="form-control" type="text" placeholder="Enter Password" value="<?php echo $r_id['pwd']; ?>">
                                        </div>
                                          <div class="form-group">
                                            <label>Telephone Number</label>
                                            <input  name="uphone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $r_id['mob_no']; ?>">
                                        </div>
                                       
                                          <div class="form-group">
                                            <label>Email ID</label>
                                            <input  name="uemail" class="form-control" type="email" value="<?php echo $r_id['email_id']; ?>" type="email">
                                            <p class="help-block">Example abc@gmail.com</p>
                                        </div>
                                        
                                            <div class="form-group">
                                            <label>Role</label>
                                            <select  name="urole" id="urole" class="form-control" onchange="display_hide_group('urole','groupe_block');">
                                                
                                                <?php foreach($r_rol as $value)
				{
				?>
                                                <option <?php if(($r_id['role']) == ($value['role_id'])) { ?> selected <?php } ?> value="<?php echo $value['role_id'];?>"><?php echo $value['role_cat'];?></option>
                                <?php } ?>
                                            </select>
                                            </div>
                                        
                                         <div class="form-group">
                                            <label>Department</label>
                                            
                                            <select  name="udep" class="form-control" id="edep" onchange="display_group('edep','egrp');">
                                               
                                                <?php foreach($r as $value)
				{
				?>
                                                <option <?php if(($r_id['department']) == ($value['dep_id'])) { ?> selected <?php } ?> value="<?php echo $value['dep_id'];?>" ><?php echo $value['dep_name'];?></option>
                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                       <?php //echo $r_id['dp_group'];  ?>
                                          <?php if($r_id['dp_group'] == '') {
                                              
                                          }
                                          
                                          else {?>
                                        
                                         <div class="form-group" id="groupe_block">
                                                <label for="disabledSelect">Group</label>
                                                <select name="ugrp" class="form-control" id="egrp">
                                                     <?php foreach($r_grp as $value)  { ?>
                                                    <option <?php if(($r_id['dp_group']) == ($value['group_id'])) { ?> selected <?php } ?> value="<?php echo $value['group_id'];?>" ><?php echo $value['group_name'];?></option>
                                                     <?php } ?>
                                                </select>
                                            </div>
                                          <?php } ?>
                                             
                                    
                                        <div class="form-group">
                                            <label>Status</label>
                                         <select name="ustatus" class="form-control">
                                                <option <?php if(($r_id['status']) == '1' ) { ?> selected <?php } ?> value="1">Activate</option>
                                                <option <?php if(($r_id['status']) == '2' ) { ?> selected <?php } ?> value="2">Suspend</option>
                                                
                                            </select>
                                        </div>
                                        <button type="submit" name="edit_user" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
                                <?php  

}

if(isset($_POST['view_comp_id']))
{
     $query="SELECT * FROM ts_department";
$r = $db->fetchResult($query);

$query_rol="SELECT * FROM ts_user_role";
$r_rol = $db->fetchResult($query_rol);
   $rec_id = $_POST['view_comp_id'];
   
   $query_id='SELECT * FROM ts_tickets where id = "'.$rec_id.'"';
$r_id = $db->fetchRow($query_id);
$query_grp='SELECT * FROM ts_group where dept_id="'.$r_id["department"].'"';
$r_grp = $db->fetchResult($query_grp);

   
//echo $r_id['first_name']; die;
   //$query = 'select zone from tb_road_map where name_of_road = "'.$mini_zone.'"';
   
//echo $query; die;
 
				?>
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
       <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Complaint Details
                        </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
                            <div class="form-group">
                                            <label>Complaint Id  : <?php echo $r_id['id']; ?> </label>
                                            </div>
                              <div class="form-group">
                                            <label>Complainant Name  :  <?php echo $r_id['cmp_full_name']; ?>  </label>
                                            </div>
                             <div class="form-group">
                                            <label>Complainant Number  :  <?php echo $r_id['cmp_phn_no']; ?> </label>
                                            </div>
                             <div class="form-group">
                                            <label>Complainant Email  :  <?php echo $r_id['cmp_emailid']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                            <label>Complainant Department  :  <?php echo $r_id['cmp_dep']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                            <label>Complainant Group  :  <?php echo $r_id['cmp_group']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                            <label>Complaint Against Department  :  <?php echo $r_id['cmp_against_dep']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                            <label>Complainant Against Group  :  <?php echo $r_id['cmp_against_group']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                            <label>Complaint Description  :  <?php echo $r_id['cmp_desc']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                            <label>Complainant Status  :  <?php echo $r_id['cmp_status']; ?>  </label>
                                            </div>
                            <div class="form-group">
                                    <label>Complainant Date  :  <?php echo $r_id['cmp_date']; ?>  </label>
                                    </div>
                            <button type="submit" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>
                                    </div>
                                    </div>
                                    </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
                                <?php  

}

