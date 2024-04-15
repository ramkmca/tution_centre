

function user_concat(fid,lid,uid){
   var fname = jQuery( "#"+fid).val();
    //alert(fname);
   var lname = jQuery("#"+lid).val();
   //alert(fname);
   var uname = fname+"."+lname;
   if(fname !='' && lname !='')
   {
      jQuery( "#"+uid).val(uname);
   }
  
    }
    
    function display_hide_group(roleid,grpid,dept_block){
         
    var role_val =  jQuery("#"+roleid).val();
   // alert(role_val);
    //alert(dept_block);
    if(role_val == '1')
    {   
        $("#"+grpid).hide();
		
		$("#"+dept_block).hide();
    }
    else if(role_val == '2')
    {
     $("#"+grpid).hide();
	 $("#"+dept_block).show();
    } 
	 else
    {
     $("#"+grpid).show();
	 $("#"+dept_block).show();
    } 
    }
    
    
       function display_group(depid,grp){
          
    var dep_val =  jQuery("#"+depid).val();
	
   var group_id =  jQuery('#group_id').val();
   //alert(dep_val);
   //alert(group_id);
      jQuery.ajax({
	type: "GET",
	url: "admin-group.php",
	data:'dep_val='+dep_val+'&group_id='+group_id,
	success: function(data){
		
		$("#"+grp).html(data);
	}
	});   
  
    }
    
    function display_comp_group(depid,grpid){
          // alert(depid);
    var dep_val =  jQuery("#"+depid).val();
    //alert(dep_val);
      jQuery.ajax({
	type: "POST",
	url: "ajax-val.php",
	data:'dep_val='+dep_val,
	success: function(data){
		$("#"+grpid).html(data);
	}
	});   
  
    }
     function display_batch(class_id,batch_id)
  {
	  
	  var class_id = class_id;
	  var batch_id = batch_id;
	  //alert(batch_id);
	var urlAdd = 'get_batch.php';
    var urlData;

   
   urlData = "class_id="+class_id+"&batch_id="+batch_id;
     //alert(urlData);
    $.ajax({
        type: "POST", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
            $("#batchid").html(data.responseText);
			
        }
    });
  }
  
      function edit_agent_record(id,popid){
          var record_id = id;
		  //alert(record_id);
      jQuery.ajax({
	type: "POST",
	url: "edit-user.php",
	data:'rec_id='+record_id,
	success: function(data){
		$("#"+popid).html(data);
	}
	});   
  
    }
    
     function view_complaint(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "ajax-val.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
	 function view_student(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "student-val.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
	 function add_fee(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "add-fee.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
	function add_marks(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "add-marks.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
	 
	  function view_fee(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "view-fee.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
	function view_marks(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "view-marks.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
	function get_batch_list(class_id, batch_id)
{
	 var class_id = class_id;
	 var batch_id = batch_id;
	 //alert(class_id);
	 
	var urlAdd = 'get_batch_list.php';
    var urlData;

   
   urlData = "class_id="+class_id+"&batch_id="+batch_id;
     //alert(urlData);
    $.ajax({
        type: "POST", url: urlAdd, data: urlData,

        complete: function(data)
        {
            //alert(data.responseText);
            $("#id_getbatch").html(data.responseText);
			
        }
    });
}
	 function reassign_complaint(id,popid){
          
          //alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "edit-ticket.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
    function edit_complaint(id,popid){
          
         // alert(id);
        //  return false;
var record_id = id;
jQuery.ajax({
type: "POST",
url: "edit-ticket.php",
data:'view_comp_id='+record_id,
success: function(data){
$("#"+popid).html(data);
}
});   
  
    }
    
     function validate_pass(newpassid,confpassid,msg){
         // alert(2);
        // return false;
         // alert(id);
        //  return false;
        var new_pass =  jQuery("#"+newpassid).val();
        var conf_new_pass =  jQuery("#"+confpassid).val();
          if((new_pass!='') && (conf_new_pass!='') && (new_pass == conf_new_pass)){
              var message = 'Password Matched';
              $("."+msg).html(message);
        
          }
          else if((new_pass == '') || (conf_new_pass == '')){
               var message = 'Please fill the field';
              $("."+msg).html(message);
              return false;
          }
         else {
                var message = 'Password Did Not Match';
              $("."+msg).html(message);
        return false;
          }
              
  
    }
    
     function user_login(usrid,pswdid,msg){
         
         //return false;
        // alert();
        var new_user =  jQuery("#"+usrid).val();
        var user_pass =  jQuery("#"+pswdid).val();
        
          if((new_user == '') || (user_pass == '')){
               
               var message = 'Please fill in the field';
              $("."+msg).html(message);
              return false;
          }
         
    }