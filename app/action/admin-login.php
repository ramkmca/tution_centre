<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';
require_once '../classes/users.php';
//echo ADMIN_URL;


if(isset($_POST['admin_login'])){
    
    $usrname = $_POST['usrname'];
     $pswd = $_POST['pswd'];
     $sql = "SELECT id, first_name,pswd FROM ts_admin_login WHERE user_name='$usrname' AND pswd ='$pswd' AND status='1'";
     $type = 'admin';
  //  $user = new dbclass;
    $user = new users;
$result = $user->userLogin($usrname , $pswd , $sql ,$type);


    
}