<?php
require_once '../classes/config.php';
require_once '../classes/dbclass.php';
require_once '../classes/users.php';

  //  $user = new dbclass;

    $user = new users;
$result = $user->destroyAdminUserSession();
