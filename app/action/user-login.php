<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';
require_once '../classes/users.php';
//echo ADMIN_URL;


if(isset($_POST['users_login'])){
    
    $registration_no = $_POST['registration_no'];
     $dob = $_POST['dob'];
      $sql = "SELECT id, registration_no,student_name,dob FROM ts_student WHERE registration_no='$registration_no' AND dob ='$dob' AND status='Activeted'";
      $type = 'user';
  //  $user = new dbclass;
    $user = new users;
$result = $user->userLogin($registration_no , $dob , $sql , $type);

}