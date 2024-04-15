<?php

class users extends dbclass {

	
	public function createUserSession($id,$first_name,$type){
            if($type == 'admin')
            {	$_SESSION['type'] = $type;
                $_SESSION['admin_id'] = $id;
		$_SESSION['adminuser_name'] = $first_name;
            }
            else
            { 
                $_SESSION['type'] = $type;
                $_SESSION['user_id'] = $id;
		        $_SESSION['user_name'] = $first_name;
            }
	}

	public function destroyUserSession(){
               
                    unset($_SESSION['type']);
                    unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		//session_destroy();
                  header("location:../../index.php?msg=You have been successfully logged out"); 
               
                    
                }
	
	
	public function destroyAdminUserSession(){
               
                    unset($_SESSION['type']);
		unset($_SESSION['admin_id']);
		unset($_SESSION['adminuser_name']);
		
		//session_destroy();
                  header("location:../../admin/index.php?msg=You have been successfully logged out"); 
                }
                
              
	
	public function validateSession(){
		if(!empty($_SESSION['ADMIN']['ID']) && !empty($_SESSION['ADMIN']['NAME'])){
			return true;
		} else {
			header('location:'.ADMIN_URL.'/admin');
		}
		
	}

    // USER LOGIN CHECK
	public function userLogin($username, $password, $query , $type){
		$error='';
		if( empty($username) || empty($password) ){
			$error = 'Please Fill all Details.';
		} else {

			//$password = $password;
			//$password = filter_var($password, FILTER_SANITIZE_STRING);

			//$query = "SELECT id, first_name,pswd FROM ts_admin_login WHERE user_name='$username' AND pswd ='$password' AND status='1'"; 
                       // echo $query; die;
			$responce = $this->NumRows($query);
                        
			
                       // echo $responce; die;
			if($responce>=1){
				//$error = 'Invalid username or password';
		        $row_data = $this->fetchRow($query);
                        if($type == 'admin'){
                            
                        
				$this->createUserSession($row_data['id'],$row_data['first_name'],$type);
				  header("location:../../admin/dashboard.php"); 
                        }
                        else{
                            $this->createUserSession($row_data['id'],$row_data['registration_no'],$type);
				  header("location:../../dashboard.php"); 
                        }
			}
			else {
			 if($type == 'admin'){
                            
                        
				header("location:../../admin/index.php?msg=Username Passord does not match."); 
                        }
                        else{
                           header("location:../../index.php?msg=Username Passord does not match."); 
                        }
                        }  
		}

		
	}
// CHECK EMAIL ALREADY EXIST



// CHECK EMAIL ALREADY EXIST
	public function userExist($id){
		$query="SELECT id FROM qa_details WHERE id ='$id'"; 
		$responce = $this->fetchRow($query);
		if(!$responce){
			return false;
		} else {
			return true;
		}
	}

// VALIDATE EMAIL VARIFICATION CODE
	public function validateEmailToken($token){

		$check = $this->fetchRow("SELECT  FROM qa_details");
		if($check){

			$uid  = $check['uid'];
			$this->activateSignUp($uid);
			$rr = $this->fetchRow("SELECT FROM qa_details");
			$this->createUserSession($rr);

			return true;
		} else {
			return false;
		}
	}



// GET USER DATA
        
        
	public function getUserData($id, $colums=array()){
		$sql = "SELECT ".implode(', ', $colums)." FROM `qa_details` WHERE id='$id'";
		return $this->fetchRow($sql);
	}

// FETCH ROWS COUNT
        
      
        
        
// GET USER META DATA
	public function get_user_meta($key, $uid){	
		$sql = "SELECT  FROM `qa_details`";
		$r=$this->fetchRow($sql);
		if($r){
			return $r['meta_value'];
		} else {
			return NULL;
		}
	}
	
} // END USER CLASS


?>